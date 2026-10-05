@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Cursos</a></li>
                <li class="breadcrumb-item active">Listar</li>
            </ol>
        </div>

        @livewire('course-search')

    </div>
@endsection
