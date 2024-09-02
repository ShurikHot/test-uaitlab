<?php

namespace App\Http\Controllers\Crm;

use App\Actions\BuildTreeAction;
use App\Actions\CodeNumberAction;
use App\Actions\QueryBuilderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnicalConclusionRequest;
use App\Http\Requests\UpdateTechnicalConclusionRequest;
use App\Models\TechnicalConclusion;
use App\Models\WarrantyClaim;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TechnicalConclusionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, QueryBuilderAction $queryBuilderAction)
    {
        $sortField = $request->input('sort_field', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');

        $authors = WarrantyClaim::query()->pluck('autor')->unique();
        $statuses = WarrantyClaim::query()->pluck('status')->unique();

        $technicalConclusions = TechnicalConclusion::query()
            ->with(['warrantyClaim'])
            ->when($sortField == 'product_article', function ($query) use ($sortDirection) {
                $query->join('warranty_claims', 'technical_conclusions.warranty_claims_code_1c', '=', 'warranty_claims.code_1c')
                    ->orderBy('warranty_claims.product_article', $sortDirection);
            })
            ->when($sortField == 'product_name', function ($query) use ($sortDirection) {
                $query->join('warranty_claims', 'technical_conclusions.warranty_claims_code_1c', '=', 'warranty_claims.code_1c')
                    ->orderBy('warranty_claims.product_name', $sortDirection);
            })
            ->when($sortField == 'status', function ($query) use ($sortDirection) {
                $query->join('warranty_claims', 'technical_conclusions.warranty_claims_code_1c', '=', 'warranty_claims.code_1c')
                    ->orderBy('warranty_claims.status', $sortDirection);
            })
            ->when($sortField == 'autor', function ($query) use ($sortDirection) {
                $query->join('warranty_claims', 'technical_conclusions.warranty_claims_code_1c', '=', 'warranty_claims.code_1c')
                    ->orderBy('warranty_claims.autor', $sortDirection);
            })
            ->orderBy($sortField, $sortDirection);

        if ($request->filled('date-start') && !$request->filled('date-end')) {
            $technicalConclusions->whereBetween('date', [$request->input('date-start'), date('Y-m-d')]);
        }

        if (!$request->filled('date-start') && $request->filled('date-end')) {
            $technicalConclusions->where('date', '<', $request->input('date-end'));
        }

        if ($request->filled('date-start') && $request->filled('date-end')) {
            $technicalConclusions->whereBetween('date', [$request->input('date-start'), $request->input('date-end')]);
        }

        if ($request->filled('article')) {
            $article = $request->input('article');
            $technicalConclusions->whereHas('warrantyClaim', function ($query) use ($article) {
                $query->where('product_article', 'like', '%' . $article . '%');
            });
        }
        if ($request->filled('status')) {
            $statusesInput = $request->input('status');
            $technicalConclusions->whereHas('warrantyClaim', function ($query) use ($statusesInput) {
                $query->whereIn('status', $statusesInput);
            });
        }

        if ($request->filled('author')) {
            $author = $request->input('author');
            $technicalConclusions->whereHas('warrantyClaim', function ($query) use ($author) {
                $query->where('autor', $author);
            });
        }

        $technicalConclusions = $technicalConclusions->paginate(20);

        $queryString = $queryBuilderAction($request->input());

        $from = ($technicalConclusions->currentPage() - 1) * $technicalConclusions->perPage() + 1;
        $to = min($technicalConclusions->currentPage() * $technicalConclusions->perPage(), $technicalConclusions->total());
        $totalPages = ceil($technicalConclusions->total() / $technicalConclusions->perPage());

        $title = 'Журнал АТЕ';

        return view('front.ate.index', compact(
            'technicalConclusions',
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
    public function create(BuildTreeAction $buildTreeAction)
    {
        $technicalConclusion = TechnicalConclusion::query()
            ->tap(function ($query) use (&$appealTypes) {
                $appealTypes = $query->pluck('appeal_type')->unique();
            })->get();

        $defectCodes = $buildTreeAction->getTree('App\Models\DefectCode');
        $symptomCodes = $buildTreeAction->getTree('App\Models\SymptomCode');

        $title = 'Створення АТЕ';

        return view('front.ate.create', compact(
            'title',
            'technicalConclusion',
            'defectCodes',
            'symptomCodes',
            'appealTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnicalConclusionRequest $request, CodeNumberAction $codeNumberAction): RedirectResponse
    {
        $data = $request->validated();
        $data['code_1c'] = $codeNumberAction->getCode();
        $data['number_1c'] = $codeNumberAction->getNumber();
        $data['warranty_claims_code_1c'] = WarrantyClaim::query()->where('number_1c', $data['warranty_claim_number_1c'])->value('code_1c');
        unset($data['warranty_claim_number_1c']);

        try {
            TechnicalConclusion::query()->firstOrCreate(
                ['code_1c' => $data['code_1c'], 'number_1c' => $data['number_1c']],
                $data
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Помилка створення АТЕ');
        }

        return redirect()->route('ate.index')->with('success', 'АТЕ успішно створена');
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
    public function edit(string $id, BuildTreeAction $buildTreeAction)
    {
        $technicalConclusion = TechnicalConclusion::query()
            ->tap(function ($query) use (&$appealTypes) {
                $appealTypes = $query->pluck('appeal_type')->unique();
            })
            ->where('id', $id)->first();

        $defectCodes = $buildTreeAction->getTree('App\Models\DefectCode');
        $symptomCodes = $buildTreeAction->getTree('App\Models\SymptomCode');

        $title = 'Редагування АТЕ';

        return view('front.ate.edit', compact(
            'technicalConclusion',
            'title',
            'appealTypes',
            'defectCodes',
            'symptomCodes'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnicalConclusionRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        try {
            TechnicalConclusion::query()->where('id', $id)->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Помилка оновлення АТЕ');
        }

        return redirect()->route('ate.index')->with('success', 'АТЕ успішно оновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
