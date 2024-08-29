<?php

namespace App\Http\Controllers\Crm;

use App\Actions\CodeNumberAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarrantyClaimRequest;
use App\Http\Requests\UpdateWarrantyClaimRequest;
use App\Models\WarrantyClaim;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WarrantyClaimsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = $request->input('sort_field', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');

        $warranties = WarrantyClaim::query()
            ->tap(function ($query) use (&$authors, &$statuses) {
                $authors = $query->pluck('autor')->unique();
                $statuses = $query->pluck('status')->unique();
            })
            ->with(['serviceWorks', 'spareParts', 'technicalConclusions'])
            ->orderBy($sortField, $sortDirection);

        if ($request->filled('date-start') && !$request->filled('date-end')) {
            $warranties->whereBetween('date_of_claim', [$request->input('date-start'), date('Y-m-d')]);
        }

        if (!$request->filled('date-start') && $request->filled('date-end')) {
            $warranties->where('date_of_claim', '<', $request->input('date-end'));
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

        $from = ($warranties->currentPage() - 1) * $warranties->perPage() + 1;
        $to = min($warranties->currentPage() * $warranties->perPage(), $warranties->total());
        $totalPages = ceil($warranties->total() / $warranties->perPage());

        $title = 'Гарантійні заявки';

        return view('front.warranty.index', compact('warranties', 'authors', 'from', 'to', 'totalPages', 'sortDirection', 'statuses', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = WarrantyClaim::query()->pluck('autor')->unique();

        $title = 'Створення гарантійної заявки';

        return view('front.warranty.create', compact('title', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarrantyClaimRequest $request, CodeNumberAction $codeNumberAction): RedirectResponse
    {
        $data = $request->validated();
        $data['code_1c'] = $codeNumberAction->getCode();
        $data['number_1c'] = $codeNumberAction->getNumber();

        try {
            WarrantyClaim::query()->firstOrCreate(
                ['code_1c' => $data['code_1c'], 'number_1c' => $data['number_1c']],
                $data
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Помилка створення гарантійної заявки');
        }

        return redirect()->route('warranty.index')->with('success', 'Гарантійна заявка успішно створена');
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

        $title = 'Редагування гарантійної заявки';

        return view('front.warranty.edit', compact('warranty', 'title', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarrantyClaimRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        WarrantyClaim::query()->where('id', $id)->update($data);

        return redirect()->route('warranty.index')->with('success', 'Гарантійна заявка успішно оновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
