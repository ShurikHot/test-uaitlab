<?php

namespace App\Http\Controllers\Admin;

use App\Actions\BuildTreeAction;
use App\Actions\CodeNumberAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDefectCodeRequest;
use App\Http\Requests\UpdateDefectCodeRequest;
use App\Models\DefectCode;
use Illuminate\Http\RedirectResponse;

class DefectCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BuildTreeAction $buildTreeAction)
    {
        $tree = $buildTreeAction->getTree('App\Models\DefectCode');
        $customTitle = ' :: Довідник кодів дефектів';

        return view('admin.catalog.defect-codes.index', compact('tree', 'customTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BuildTreeAction $buildTreeAction)
    {
        $tree = $buildTreeAction->getTree('App\Models\DefectCode');
        $customTitle = ' :: Створення нового коду дефекту';

        return view('admin.catalog.defect-codes.create', compact('tree', 'customTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDefectCodeRequest $request, CodeNumberAction $codeNumberAction): RedirectResponse
    {
        $data = $request->validated();
        $data['code_1C'] = $codeNumberAction->getCode();
        $data['parent_id'] == 0 ? $data['is_folder'] = 1 : $data['is_folder'] = 0;
        $data['parent_id'] = $data['parent_id'] ?: '0';
        $data['created'] = date('Y-m-d H:m:s');

        DefectCode::query()->firstOrCreate(
            ['code_1C' => $data['code_1C']],
            $data
        );

        return redirect()->route('defect-codes.index')->with('success', 'Новий код дефекту створено');
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
    public function edit(BuildTreeAction $buildTreeAction, DefectCode $defectCode)
    {
        $tree = $buildTreeAction->getTree('App\Models\DefectCode');
        $customTitle = ' :: Редагування коду дефекту';

        $defectCodeEdit = DefectCode::query()->where('id', $defectCode->id)->first()->toArray();

        return view('admin.catalog.defect-codes.edit', compact('tree', 'defectCodeEdit', 'customTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDefectCodeRequest $request, DefectCode $defectCode): RedirectResponse
    {
        $data = $request->validated();
        $data['parent_id'] == 0 ? $data['is_folder'] = 1 : $data['is_folder'] = 0;
        $data['edited'] = date('Y-m-d H:m:s');

        $defectCode->update($data);

        return redirect()->route('defect-codes.index')->with('success', 'Інформація оновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DefectCode $defectCode): RedirectResponse
    {
        $defectCode->delete();

        return redirect()->route('defect-codes.index')->with('success', 'Запис дефекту видалено');
    }
}
