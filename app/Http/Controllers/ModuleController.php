<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.module.index', ['menu' => 'modulos']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('modules.module.create', [
            'menu' => 'modulos',
            'course' => $course,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModuleRequest $request, Course $course)
    {
        $course->modules()->create($request->validated());

        return redirect()
            ->route('course.show', $course->id)
            ->with('success', 'Módulo cadastrado com sucesso.');
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
    public function edit(Module $module)
    {
        $courses = Course::query()
            ->with('subcategory.category')
            ->orderBy('name')
            ->get();

        return view('modules.module.edit', [
            'module' => $module,
            'courses' => $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModuleRequest $request, Module $module)
    {
        $module->update($request->validated());

        return redirect()
            ->route('module.index')
            ->with('success', 'Módulo atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
