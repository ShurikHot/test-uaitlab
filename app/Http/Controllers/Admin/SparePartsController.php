<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CodeNumberAction;
use App\Contracts\SparePartsIndexInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSparePartRequest;
use App\Http\Requests\UpdateSparePartRequest;
use App\Models\SpareParts;

class SparePartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = SpareParts::all();
        $customTitle = ' :: Довідник запчастин';

        return view('admin.catalog.spareparts.index', compact('parts', 'customTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customTitle = ' :: Створення нової запчастини';

        return view('admin.catalog.spareparts.create', compact('customTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSparePartRequest $request, CodeNumberAction $codeNumberAction, SparePartsIndexInterface $sparePartsIndex)
    {
        $data = $request->validated();
        $data['code_1c'] = $codeNumberAction->getCode();

        $part = SpareParts::query()->firstOrCreate(
            ['code_1c' => $data['code_1c']],
            $data
        );

        $sparePartsIndex->indexPart($part);

        return redirect()->route('parts.index')->with('success', 'Нова запчастина створена');
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
        $part = SpareParts::query()->where('id', $id)->first();
        $customTitle = ' :: Редагування запчастини';

        return view('admin.catalog.spareparts.edit', compact('part', 'customTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSparePartRequest $request, SparePartsIndexInterface $sparePartsIndex, string $id)
    {
        $data = $request->validated();
        $part = SpareParts::query()->where('id', $id)->first();

        $sparePartsIndex->updatePart($part);

        $part->update($data);

        return redirect()->route('parts.index')->with('success', 'Інформація оновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
