<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CodeNumberAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceWorkRequest;
use App\Http\Requests\UpdateServiceWorkRequest;
use App\Models\ServiceWorks;

class ServiceWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = ServiceWorks::all();
        $customTitle = ' :: Довідник видів робіт';

        return view('admin.catalog.works.index', compact('works', 'customTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customTitle = ' :: Створення нового виду робіт';

        return view('admin.catalog.works.create', compact('customTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceWorkRequest $request, CodeNumberAction $codeNumberAction)
    {
        $data = $request->validated();
        $data['code_1c'] = $codeNumberAction->getCode();

        ServiceWorks::query()->firstOrCreate(
            ['code_1c' => $data['code_1c']],
            $data
        );

        return redirect()->route('works.index')->with('success', 'Новий вид робіт створено');
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
        $work = ServiceWorks::query()->where('id', $id)->first();
        $customTitle = ' :: Редагування виду робіт';

        return view('admin.catalog.works.edit', compact('work', 'customTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceWorkRequest $request, string $id)
    {
        $data = $request->validated();
        $work = ServiceWorks::query()->where('id', $id)->first();

        $work->update($data);

        return redirect()->route('works.index')->with('success', 'Інформація оновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
