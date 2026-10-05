<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.course.index', ['menu' => 'cursos']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = Subcategory::with('category')
            ->orderBy('name')
            ->get();
        $menu = 'cursos';

        return view('modules.course.create', compact('subcategories', 'menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        Course::create($request->validated());

        return redirect()
            ->route('course.index')
            ->with('success', 'Curso cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load('modules.lessons');

        return view('modules.course.show', [
            'course' => $course,
            'menu' => 'cursos',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $subcategories = Subcategory::with('category')
            ->orderBy('name')
            ->get();

        return view('modules.course.edit', compact(
            'course',
            'subcategories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect()
            ->route('course.index')
            ->with('success', 'Curso atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
