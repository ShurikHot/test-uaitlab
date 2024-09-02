<?php

namespace App\Http\Controllers\Admin;

use App\Actions\BuildTreeAction;
use App\Actions\CodeNumberAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSymptomCodeRequest;
use App\Http\Requests\UpdateSymptomCodeRequest;
use App\Models\SymptomCode;
use Illuminate\Http\RedirectResponse;

class SymptomCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BuildTreeAction $buildTreeAction)
    {
        $tree = $buildTreeAction->getTree('App\Models\SymptomCode');
        $customTitle = ' :: Довідник кодів симптомів';

        return view('admin.catalog.symptom-codes.index', compact('tree', 'customTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BuildTreeAction $buildTreeAction)
    {
        $tree = $buildTreeAction->getTree('App\Models\SymptomCode');
        $customTitle = ' :: Створення нового коду симптому';

        return view('admin.catalog.symptom-codes.create', compact('tree', 'customTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSymptomCodeRequest $request, CodeNumberAction $codeNumberAction): RedirectResponse
    {
        $data = $request->validated();
        $data['code_1C'] = $codeNumberAction->getCode();
        $data['parent_id'] == 0 ? $data['is_folder'] = 1 : $data['is_folder'] = 0;
        $data['parent_id'] = $data['parent_id'] ?: '0';
        $data['created'] = date('Y-m-d H:m:s');

        SymptomCode::query()->firstOrCreate(
            ['code_1C' => $data['code_1C']],
            $data
        );

        return redirect()->route('symptom-codes.index')->with('success', 'Новий код симптому створено');
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
    public function edit(BuildTreeAction $buildTreeAction, SymptomCode $symptomCode)
    {
        $tree = $buildTreeAction->getTree('App\Models\SymptomCode');
        $customTitle = ' :: Редагування коду симптому';

        $symptomCodeEdit = SymptomCode::query()->where('id', $symptomCode->id)->first()->toArray();

        return view('admin.catalog.symptom-codes.edit', compact('tree', 'symptomCodeEdit', 'customTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSymptomCodeRequest $request, SymptomCode $symptomCode): RedirectResponse
    {
        $data = $request->validated();
        $data['parent_id'] == 0 ? $data['is_folder'] = 1 : $data['is_folder'] = 0;
        $data['edited'] = date('Y-m-d H:m:s');

        $symptomCode->update($data);

        return redirect()->route('symptom-codes.index')->with('success', 'Інформація оновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SymptomCode $symptomCode): RedirectResponse
    {
        $symptomCode->delete();

        return redirect()->route('symptom-codes.index')->with('success', 'Запис симптому видалено');
    }
}
