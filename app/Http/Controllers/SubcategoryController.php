<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Http\Requests\SubcategoryRequest;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.subcategory.index', ['menu' => 'subcategorias']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('modules.subcategory.create', [
            'menu' => 'subcategorias',
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubcategoryRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        Subcategory::create($data);

        return redirect()
            ->route('subcategory.index')
            ->with('success', 'Subcategoria cadastrada com sucesso!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::orderBy('name')->get();

        return view('modules.subcategory.edit', [
            'menu' => 'subcategorias',
            'subcategory' => $subcategory,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubcategoryRequest $request, Subcategory $subcategory)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        $subcategory->update($data);

        return redirect()
            ->route('subcategory.index')
            ->with('success', 'Subcategoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
