<?php

namespace App\Http\Controllers\Admin;

use App\Actions\BuildTreeAction;
use App\Actions\CodeNumberAction;
use App\Models\SymptomCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SymptomCodeController extends CodeController
{
    protected string $viewFolder = 'symptom-codes';
    protected string $model = SymptomCode::class;
    protected string $table = 'symptom_codes';
    protected string $customTitle = ' :: Довідник кодів симптомів';
    /**
     * Display a listing of the resource.
     */
    public function index(BuildTreeAction $buildTreeAction)
    {
        return parent::index($buildTreeAction);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BuildTreeAction $buildTreeAction)
    {
        return parent::create($buildTreeAction);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CodeNumberAction $codeNumberAction): RedirectResponse
    {
        return parent::store($request, $codeNumberAction);
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
        return parent::edit($buildTreeAction, $codeModel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codeModel): RedirectResponse
    {
        return parent::update($request, $codeModel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($codeModel): RedirectResponse
    {
        return parent::destroy($codeModel);
    }
}
