<?php

namespace App\Http\Controllers\Admin;

use App\Actions\BuildTreeAction;
use App\Actions\CodeNumberAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

abstract class CodeController extends Controller
{
    protected string $model;
    protected string $table;
    protected string $viewFolder;
    protected string $customTitle;
    /**
     * Display a listing of the resource.
     */
    public function index(BuildTreeAction $buildTreeAction)
    {
        $tree = $buildTreeAction->getTree($this->model);
        return view("admin.catalog.{$this->viewFolder}.index", ['tree' => $tree, 'customTitle' => $this->customTitle]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BuildTreeAction $buildTreeAction)
    {
        $tree = $buildTreeAction->getTree($this->model);
        return view("admin.catalog.{$this->viewFolder}.create", ['tree' => $tree, 'customTitle' => $this->customTitle]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CodeNumberAction $codeNumberAction): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'parent_id' => "nullable|string|exists:{$this->table},code_1C"
        ]);

        $data['code_1C'] = $codeNumberAction->getCode();
        $data['parent_id'] == 0 ? $data['is_folder'] = 1 : $data['is_folder'] = 0;
        $data['parent_id'] = $data['parent_id'] ?: '0';
        $data['created'] = date('Y-m-d H:m:s');

        $this->model::query()->firstOrCreate(
            ['code_1C' => $data['code_1C']],
            $data
        );

        return redirect()->route("$this->viewFolder.index")->with('success', 'Новий код створено');
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
    public function edit(BuildTreeAction $buildTreeAction, $codeModel)
    {
        $tree = $buildTreeAction->getTree($this->model);
        $codeEdit = $this->model::query()->where('id', $codeModel)->first()->toArray();

        return view("admin.catalog.{$this->viewFolder}.edit", ['tree' => $tree, 'customTitle' => $this->customTitle, 'codeEdit' => $codeEdit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codeModel): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'parent_id' => "nullable|string|exists:{$this->table},code_1C"
        ]);
        $data['parent_id'] == 0 ? $data['is_folder'] = 1 : $data['is_folder'] = 0;
        $data['edited'] = date('Y-m-d H:m:s');
        $codeModel = $this->model::query()->where('id', $codeModel)->first();

        $codeModel->update($data);

        return redirect()->route("{$this->viewFolder}.index")->with('success', 'Інформація оновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codeModel): RedirectResponse
    {
        $codeModel = $this->model::query()->where('id', $codeModel)->first();
        $codeModel->delete();

        return redirect()->route("{$this->viewFolder}.index")->with('success', 'Запис видалено з довідника');
    }
}
