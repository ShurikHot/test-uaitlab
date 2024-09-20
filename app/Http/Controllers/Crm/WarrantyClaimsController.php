<?php

namespace App\Http\Controllers\Crm;

use App\Actions\CodeNumberAction;
use App\Actions\QueryBuilderAction;
use App\Enums\StatusEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarrantyClaimRequest;
use App\Http\Requests\UpdateWarrantyClaimRequest;
use App\Models\ServiceWorks;
use App\Models\WarrantyClaim;
use App\Models\WarrantyClaimServiceWork;
use App\Models\WarrantyClaimSparepart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WarrantyClaimsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, QueryBuilderAction $queryBuilderAction)
    {
        $sortField = $request->input('sort_field', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');

        $warranties = WarrantyClaim::query()
            ->tap(function ($query) use (&$authors) {
                $authors = $query->pluck('autor')->unique();
            })
            ->with(['serviceWorks', 'spareParts', 'technicalConclusions'])
            ->orderBy($sortField, $sortDirection);

        if ($request->filled('date-start') && !$request->filled('date-end')) {
            $warranties->whereBetween('date_of_claim', [$request->input('date-start'), date('Y-m-d')]);
        }

        if (!$request->filled('date-start') && $request->filled('date-end')) {
            $warranties->where('date_of_claim', '<=', $request->input('date-end'));
        }

        if ($request->filled('date-start') && $request->filled('date-end')) {
            $warranties->whereBetween('date_of_claim', [$request->input('date-start'), $request->input('date-end')]);
        }

        if ($request->filled('article')) {
            $warranties->where('product_article', 'like', '%' . $request->input('article') . '%');
        }

        if ($request->filled('status')) {
            $statusesInput = $request->input('status');
            $warranties->whereIn('status', $statusesInput);
        }

        if ($request->filled('author')) {
            $warranties->where('autor', $request->input('author'));
        }

        $warranties = $warranties->paginate(20);

        $queryString = $queryBuilderAction($request->input());

        $from = ($warranties->currentPage() - 1) * $warranties->perPage() + 1;
        $to = min($warranties->currentPage() * $warranties->perPage(), $warranties->total());
        $totalPages = ceil($warranties->total() / $warranties->perPage());

        $statuses = StatusEnums::getStatuses();
        $title = 'Гарантійні заяви';

        return view('front.warranty.index', compact(
            'warranties',
            'authors',
            'from',
            'to',
            'totalPages',
            'sortDirection',
            'statuses',
            'title',
            'queryString'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = WarrantyClaim::query()->pluck('autor')->unique();
        $serviceWorks = ServiceWorks::all();
        $title = 'Створення гарантійної заяви';

        return view('front.warranty.create', compact(
            'title',
            'authors',
            'serviceWorks'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarrantyClaimRequest $request, CodeNumberAction $codeNumberAction): RedirectResponse
    {
        $data = $request->validated();
        if (!empty($data['photo'])) {
            $filePaths = [];
            foreach ($data['photo'] as $photo) {
                if ($photo) {
                    $path = Storage::put('public/photos', $photo);
                    $filePaths[] = $path;
                }
            }
            $data['photo_path'] = implode(',', $filePaths);
            unset($data['photo']);
        }

        $data['code_1c'] = $codeNumberAction->getCode();
        $data['number_1c'] = $codeNumberAction->getNumber();

        if (array_key_exists('items', $data)) {
            $spareParts = $data['items'];
            unset($data['items']);
        }

        if (array_key_exists('works', $data)) {
            $serviceWorks = $data['works'];
            unset($data['works']);
        }

        try {
            $warrantyClaim = WarrantyClaim::query()->firstOrCreate(
                ['code_1c' => $data['code_1c'], 'number_1c' => $data['number_1c']],
                $data
            );

            $sumWorks = 0;
            if (!empty($serviceWorks)) {
                foreach ($serviceWorks as $serviceWork) {
                    if ($serviceWork['checked'] === 'on' && $serviceWork['price'] != null && $serviceWork['qty'] != null) {
                        $serviceWork['warranty_claims_number_1c'] = $warrantyClaim->number_1c;
                        $serviceWork['sum'] = $serviceWork['qty'] * $serviceWork['price'];
                        $sumWorks += $serviceWork['sum'];
                        unset($serviceWork['checked']);

                        WarrantyClaimServiceWork::query()->create($serviceWork);
                    }
                }
            }

            $sumParts = 0;
            if (!empty($spareParts)) {
                foreach ($spareParts as $sparePart) {
                    $sparePart['code_1c'] = $codeNumberAction->getCode();
                    $sparePart['warranty_claims_number_1c'] = $warrantyClaim->number_1c;
                    $sparePart['sum'] = $sparePart['qty'] * $sparePart['price'] * (1 - $sparePart['discount'] / 100);
                    $sumParts += $sparePart['sum'];

                    WarrantyClaimSparepart::query()->create($sparePart);
                }
            }

            $warrantyClaim->update([
                'spare_parts_sum' => $sumParts,
                'service_works_sum' => $sumWorks,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Помилка створення гарантійної заяви');
        }

        return redirect()->route('warranty.index')->with('success', 'Гарантійна заява успішно створена');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $warranty = WarrantyClaim::query()->where('id', $id)->first();
        $authors = WarrantyClaim::query()->pluck('autor')->unique();
        $serviceWorks = ServiceWorks::all();

        if ($warranty['photo_path']) {
            $warranty['photo_path'] = explode(',', $warranty['photo_path']);
        }

        $title = 'Редагування гарантійної заяви';

        return view('front.warranty.edit', compact(
            'warranty',
            'title',
            'authors',
            'serviceWorks'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarrantyClaimRequest $request, CodeNumberAction $codeNumberAction, string $id): RedirectResponse
    {
        $data = $request->validated();
        if (!empty($data['photo'])) {
            $filePaths = [];
            foreach ($data['photo'] as $photo) {
                if ($photo) {
                    $path = Storage::put('public/photos', $photo);
                    $filePaths[] = $path;
                }
            }
            unset($data['photo']);
        }

        if (array_key_exists('items', $data)) {
            $spareParts = $data['items'];
            unset($data['items']);
        }

        if (array_key_exists('works', $data)) {
            $serviceWorks = $data['works'];
            unset($data['works']);
        }

        try {
            WarrantyClaim::query()->where('id', $id)->update($data);
            $warrantyClaim = WarrantyClaim::query()->where('id', $id)->first();

            if (isset($filePaths)) {
                $photoPaths = $warrantyClaim->photo_path;
                $photoPaths .= ',' . implode(',', $filePaths);
            } else {
                $photoPaths = $warrantyClaim->photo_path;
            }

            WarrantyClaimSparepart::query()->where('warranty_claims_number_1c', $data['number_1c'])->delete();
            WarrantyClaimServiceWork::query()->where('warranty_claims_number_1c', $data['number_1c'])->delete();

            $sumWorks = 0;
            if (!empty($serviceWorks)) {
                foreach ($serviceWorks as $serviceWork) {
                    if ($serviceWork['checked'] === 'on' && $serviceWork['price'] != null && $serviceWork['qty'] != null) {
                        $serviceWork['warranty_claims_number_1c'] = $warrantyClaim->number_1c;
                        $serviceWork['sum'] = $serviceWork['qty'] * $serviceWork['price'];
                        $sumWorks += $serviceWork['sum'];
                        unset($serviceWork['checked']);

                        WarrantyClaimServiceWork::query()->create($serviceWork);
                    }
                }
            }

            $sumParts = 0;
            if (!empty($spareParts)) {
                foreach ($spareParts as $sparePart) {
                    $sparePart['code_1c'] = $codeNumberAction->getCode();
                    $sparePart['warranty_claims_number_1c'] = $warrantyClaim->number_1c;
                    $sparePart['sum'] = $sparePart['qty'] * $sparePart['price'] * (1 - $sparePart['discount'] / 100);
                    $sumParts += $sparePart['sum'];

                    WarrantyClaimSparepart::query()->create($sparePart);
                }
            }

            $warrantyClaim->update([
                'spare_parts_sum' => $sumParts,
                'service_works_sum' => $sumWorks,
                'photo_path' => $photoPaths,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Помилка оновлення гарантійної заяви');
        }

        return redirect()->route('warranty.index')->with('success', 'Гарантійна заява успішно оновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
