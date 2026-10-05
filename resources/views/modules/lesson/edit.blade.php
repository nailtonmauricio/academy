@extends('templates.admin.index')

@section('content')

    <div class="container-fluid px-4">

        <div class="mb-1 hstack gap-1">

            <ol class="breadcrumb mb-3 mt-3 ms-auto">

                <li class="breadcrumb-item">
                    <a
                            href="{{ route('category.index') }}"
                            class="text-decoration-none"
                    >
                        Categorias
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a
                            href="{{ route('subcategory.index') }}"
                            class="text-decoration-none"
                    >
                        Subcategorias
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a
                            href="{{ route('course.index') }}"
                            class="text-decoration-none"
                    >
                        Cursos
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a
                            href="{{ route('module.index') }}"
                            class="text-decoration-none"
                    >
                        Módulos
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    Editar
                </li>

            </ol>

        </div>


        <div class="card mb-4 border-light shadow">

            <div class="card-header hstack gap-2">

                <span class="ms-auto">

                    @can('module-index')

                        <a
                                href="{{ route('module.index') }}"
                                class="bg-gradient btn btn-primary btn-sm"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-original-title="Listar"
                                aria-label="Listar"
                        >
                            <i class="fa-solid fa-list"></i>
                        </a>

                    @endcan

                </span>

            </div>


            <div class="card-body">

                <x-alert/>


                <form
                        class="form-floating"
                        name="edit-module"
                        method="POST"
                        action="{{ route('module.update', ['module' => $module->id]) }}"
                >

                    @csrf
                    @method('PUT')


                    {{-- Curso --}}
                    <div class="form-floating mb-3">

                        <select
                                id="course_id"
                                class="form-select @error('course_id') is-invalid @enderror"
                                name="course_id"
                                required
                                autofocus
                        >

                            <option value="">
                                Selecione um curso
                            </option>

                            @foreach($courses as $course)

                                <option
                                        value="{{ $course->id }}"
                                        @selected(old('course_id', $module->course_id) == $course->id)
                                >

                                {{ $course->subcategory->name }}
                                -
                                {{ $course->name }}
                                </option>

                            @endforeach

                        </select>

                        <label for="course_id">
                            Curso
                        </label>

                        @error('course_id')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- Nome --}}
                    <div class="form-floating mb-3">

                        <input
                                type="text"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                placeholder="Nome do módulo"
                                value="{{ old('name', $module->name) }}"
                                required
                        >

                        <label for="name">
                            Nome
                        </label>

                        @error('name')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- Descrição --}}
                    <div class="form-floating mb-3">

                        <textarea
                                id="description"
                                class="form-control @error('description') is-invalid @enderror"
                                name="description"
                                placeholder="Descrição do módulo"
                                style="height: 120px"
                        >{{ old('description', $module->description) }}</textarea>

                        <label for="description">
                            Descrição
                        </label>

                        @error('description')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- Ordem --}}
                    <div class="form-floating mb-3">

                        <input
                                type="number"
                                id="order"
                                class="form-control @error('order') is-invalid @enderror"
                                name="order"
                                placeholder="Ordem do módulo"
                                value="{{ old('order', $module->order) }}"
                                min="1"
                                required
                        >

                        <label for="order">
                            Ordem
                        </label>

                        @error('order')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="form-floating mb-3">

                        <select
                                id="status"
                                class="form-select @error('status') is-invalid @enderror"
                                name="status"
                        >

                            <option
                                    value="1"
                                    @selected(old('status', $module->status) == '1')
                            >
                            Ativo
                            </option>

                            <option
                                    value="0"
                                    @selected(old('status', $module->status) == '0')
                            >
                            Inativo
                            </option>

                        </select>

                        <label for="status">
                            Status
                        </label>

                        @error('status')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    <div class="d-flex justify-content-end mb-2">

                        <button
                                type="submit"
                                class="bg-gradient btn btn-primary"
                                onclick="showLoading()"
                        >
                            Gravar
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection