@extends('templates.admin.index')
@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item active"><a href="#" class="text-decoration-none">Cursos</a></li>
                <li class="breadcrumb-item active">Listar</li>
            </ol>
        </div>

        {{--@livewire('course-search')--}}
        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <h1>{{ $course->name }}</h1>

                <span class="ms-auto">

                    @can('module-create')

                                <a
                                        href="{{ route('module.create',  $course->id) }}"
                                        class="bg-gradient btn btn-primary btn-sm"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-original-title="Novo modulo"
                                        aria-label="Novo modulo"
                                >
                            <i class="fa-solid fa-plus"></i>
                        </a>

                            @endcan

                </span>
            </div>

            <div class="card-body">
                <x-alert/>
                <div class="row">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <figure class="figure">
                            <img class="card-img-top shadow-lg mb-2" src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}">
                        </figure>
                    </div>

                    <div class="col-12 col-md-8">

                        <p>{{ $course->description }}</p>
                        <p>
                            <strong>Tempo estimado em videoaulas: {{--{{ $courseLength }}--}}</strong><br>
                            {{--@if(!$course->price == '00.0')
                                <strong>Investimento : --}}{{--{{ number_format($course->price, 2, ',', '.') }}--}}{{--</strong>
                            @endif--}}
                        </p>

                        {{--@if(auth()->check())
                            <form action="{{ route('course.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary bg-gradient">Inscrever-se</button>
                            </form>
                        @else
                            <button type="submit" class="btn btn-primary bg-gradient" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogin" aria-controls="offcanvasRight" onclick="noRegisteredInfo()">Ver Curso</button>
                        @endif--}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Container de eibiçao dos modulos --}}

    @foreach($course->modules as $module)
    <div class="container-fluid px-4">
        <div class="card mb-4 border-light shadow">

            <div class="card-header d-flex justify-content-between align-items-center">
                Modulo {{ $loop->iteration }} - {{ $module->name }}

                <span class="ms-auto">

                    @can('module-create')

                            <a
                                    href="{{ route('lesson.create', $module->id) }}"
                                    class="bg-gradient btn btn-primary btn-sm"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-original-title="Novo aula"
                                    aria-label="Novo aula"
                            >
                            <i class="fa-solid fa-plus"></i>
                        </a>

                        @endcan

                </span>

            </div>

            <div class="card-body">

                <x-alert/>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="d-none d-md-table-cell">Módulo</th>
                        <th class="d-none d-md-table-cell">Status</th>
                        <th class="d-none d-md-table-cell">Criado</th>
                        <th class="d-none d-md-table-cell">Modificado</th>
                        <th class="text-center">Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($module->lessons as $lesson)
                        <tr>
                            <td class="align-middle">{{ $lesson->name }}</td>
                            <td class="d-none d-md-table-cell align-middle">{{ $lesson->module->name }}</td>
                            <td class="d-none d-md-table-cell align-middle">
                                @if($lesson->status)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo</span>
                                @endif
                            </td>
                            <td class="d-none d-md-table-cell align-middle">
                                {{ \Carbon\Carbon::parse($lesson->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td class="d-none d-md-table-cell align-middle">
                                {{ \Carbon\Carbon::parse($lesson->updated_at)->format('d/m/Y H:i:s') }}
                            </td>
                            @can('lesson-show')
                                <td class="text-center">
                                    @can('lesson-edit')
                                        <a href="{{--{{ route('lesson.edit', ['lesson' => $lesson->id]) }}--}}"
                                           class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           data-bs-original-title="Editar"
                                           aria-label="Editar"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('lesson-destroy')
                                        <form
                                                action="{{--{{ route('lesson.destroy', ['lesson' => $lesson->id]) }}--}}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Deseja realmente remover esta aula?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                    type="submit"
                                                    class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-original-title="Remover"
                                                    aria-label="Remover"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            @else
                                <td class="text-center">
                                    <span class="badge bg-danger">Negado</span>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">
                                Nenhuma aula cadastrada neste módulo
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                {{--{{ $lessons->links() }}--}}
            </div>
        </div>
    </div>
    @endforeach
@endsection