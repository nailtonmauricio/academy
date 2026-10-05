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

                <li class="breadcrumb-item">
                    <a
                            href="{{ route('module.index') }}"
                            class="text-decoration-none"
                    >
                        Aula
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    Cadastrar
                </li>

            </ol>

        </div>


        <div class="card mb-4 border-light shadow">

            <div class="card-header hstack gap-2">
                <h5>Nova Aula</h5>
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
                        name="create-module"
                        method="POST"
                        action="{{ route('lesson.store', $module->id) }}"
                >

                    @csrf
                    @method('POST')


                    {{-- Curso --}}
                    <input type="hidden" name="module_id" value="{{ $module->id }}">


                    {{-- Nome --}}
                    <div class="form-floating mb-3">

                        <input
                                type="text"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                placeholder="Nome do módulo"
                                value="{{ old('name') }}"
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

                    <div class="row g-3 mb-3">

                        {{-- Slug --}}
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        name="slug"
                                        placeholder="Slug do curso"
                                        value="{{ old('slug') }}"
                                        required
                                >

                                <label for="slug">
                                    Slug
                                </label>

                                @error('slug')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror
                            </div>
                        </div>

                        {{-- Ordem --}}
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input
                                        type="number"
                                        id="order"
                                        class="form-control @error('order') is-invalid @enderror"
                                        name="order"
                                        placeholder="Ordem do módulo"
                                        value="{{ old('order', 1) }}"
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
                        </div>

                        {{-- status --}}
                        <div class="col-md-2">
                            <div class="form-floating">
                                <select
                                        id="status"
                                        class="form-select @error('status') is-invalid @enderror"
                                        name="status"
                                >

                                    <option
                                            value="1"
                                            @selected(old('status', '1') == '1')
                                    >
                                    Ativo
                                    </option>

                                    <option
                                            value="0"
                                            @selected(old('status') == '0')
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
                        </div>
                    </div>

                    {{-- Descrição --}}
                    <div class="form-floating mb-3">

                        <textarea
                                id="description"
                                class="form-control @error('description') is-invalid @enderror"
                                name="description"
                                placeholder="Descrição do módulo"
                                style="height: 120px"
                        >{{ old('description') }}</textarea>

                        <label for="description">
                            Descrição
                        </label>

                        @error('description')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>

                    {{-- Conteudo --}}
                    <div class="form-floating mb-3">

                        <textarea
                                id="content"
                                class="form-control @error('content') is-invalid @enderror"
                                name="content"
                                placeholder="Conteudo da aula"
                                style="height: 120px"
                        >{{ old('content') }}</textarea>

                        <label for="content">
                            Conteudo
                        </label>

                        @error('content')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>

                    {{-- URL e Duração Lado a Lado --}}
                    <div class="row g-3 mb-3">
                        {{-- URL --}}
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input
                                        type="url"
                                        id="url"
                                        class="form-control @error('url') is-invalid @enderror"
                                        name="url"
                                        placeholder="URL do vídeo/aula"
                                        value="{{ old('url') }}"
                                        required
                                >
                                <label for="url">URL</label>

                                @error('url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Duração --}}
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        id="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        name="duration"
                                        placeholder="Duração"
                                        value="{{ old('duration') }}"
                                        required
                                >
                                <label for="duration">Duração</label>

                                @error('duration')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

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