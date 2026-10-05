<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.lesson.index', ['menu' => 'aulas']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course, Module $module)
    {
        return view('modules.lesson.create', [
            'course' => $course,
            'module' => $module,
            'menu' => 'aulas'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonRequest $request)
    {
        Lesson::create($request->validated());

        return redirect()
            ->route('course.show', $request->course_id) // ou module_id, dependendo da estrutura
            ->with('success', 'Aula cadastrada com sucesso!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
