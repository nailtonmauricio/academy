@extends('templates.admin.index')

@section('content')

    <div class="container-fluid px-4">

        <div class="mb-1 hstack gap-1">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('category.index') }}" class="text-decoration-none">
                        Categorias
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
                    @can('category-index')
                        <a
                                href="{{ route('category.index') }}"
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
                        name="edit-category"
                        method="POST"
                        action="{{ route('category.update', ['category' => $category->id]) }}"
                >

                    @csrf
                    @method('PUT')

                    <div class="form-floating mb-3">

                        <input
                                type="text"
                                id="name"
                                class="form-control"
                                name="name"
                                placeholder="Nome da categoria"
                                value="{{ old('name', $category->name) }}"
                                autofocus
                        >

                        <label for="name">
                            Nome
                        </label>

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