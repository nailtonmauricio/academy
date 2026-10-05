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

                <li class="breadcrumb-item active">
                    Cadastrar
                </li>

            </ol>
        </div>


        <div class="card mb-4 border-light shadow">

            <div class="card-header hstack gap-2">
                <h5>Nova subcategoria</h5>
                <span class="ms-auto">

                    @can('subcategory-index')

                        <a
                                href="{{ route('subcategory.index') }}"
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
                        name="create-subcategory"
                        method="POST"
                        action="{{ route('subcategory.store') }}"
                >

                    @csrf
                    @method('POST')


                    {{-- Categoria --}}
                    <div class="form-floating mb-3">

                        <select
                                id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror"
                                name="category_id"
                                required
                                autofocus
                        >

                            <option value="">
                                Selecione uma categoria
                            </option>

                            @foreach($categories as $category)

                                <option
                                        value="{{ $category->id }}"
                                        @selected(old('category_id') == $category->id)
                                >
                                {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        <label for="category_id">
                            Categoria
                        </label>

                        @error('category_id')
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
                                placeholder="Nome da subcategoria"
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

                    {{-- Status --}}
                    <div class="form-floating mb-3">

                        <select
                                id="active"
                                class="form-select @error('active') is-invalid @enderror"
                                name="active"
                        >

                            <option
                                    value="1"
                                    @selected(old('active', '1') == '1')
                            >
                            Ativa
                            </option>

                            <option
                                    value="0"
                                    @selected(old('active') == '0')
                            >
                            Inativa
                            </option>

                        </select>

                        <label for="active">
                            Status
                        </label>

                        @error('active')
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