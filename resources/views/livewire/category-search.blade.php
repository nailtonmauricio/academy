<div class="card mb-4 border-light shadow">
    <div class="card-header d-flex justify-content-between align-items-center">

        <div class="flex-grow-1 d-flex justify-content-center">
            <form class="d-flex" wire:submit.prevent="search" method="POST">
                @csrf

                <input
                        wire:model.live.debounce.500ms="search"
                        id="search"
                        name="search"
                        class="form-control"
                        type="text"
                        placeholder="Buscar por..."
                        aria-label="Search for..."
                        aria-describedby="btnNavbarSearch"
                >
            </form>
        </div>

        <span class="ms-auto">
            @can('category-create')
                <a
                        href="{{ route('category.create') }}"
                        class="bg-gradient btn btn-primary btn-sm"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        data-bs-original-title="Nova categoria"
                        aria-label="Nova categoria"
                >
                    <i class="fa-solid fa-plus"></i>
                </a>
            @endcan
        </span>

    </div>

    <div class="card-body">

        <x-alert/>

        <table id="categories" class="display table table-striped table-hover mb-2">

            <thead>
            <tr>
                <th>NOME</th>
                <th class="d-none d-md-table-cell">CRIADO</th>
                <th class="d-none d-md-table-cell">MODIFICADO</th>
                <th class="text-center">OPÇÕES</th>
            </tr>
            </thead>

            <tbody>

            @forelse($categories as $category)

                <tr>

                    <td class="align-middle">
                        {{ $category->name }}
                    </td>

                    <td class="d-none d-md-table-cell align-middle">
                        {{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y H:i:s') }}
                    </td>

                    <td class="d-none d-md-table-cell align-middle">
                        {{ \Carbon\Carbon::parse($category->updated_at)->format('d/m/Y H:i:s') }}
                    </td>

                    @can('category-show')

                        <td class="text-center">

                            {{--@can('category-show')
                                <a
                                        href="{{ route('category.show', ['category' => $category->id]) }}"
                                        class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-original-title="Visualizar"
                                        aria-label="Visualizar"
                                >
                                    <i class="fa-solid fa-folder-open"></i>
                                </a>
                            @endcan--}}

                            @can('category-edit')
                                <a
                                        href="{{ route('category.edit', ['category' => $category->id]) }}"
                                        class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-original-title="Editar"
                                        aria-label="Editar"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan

                            @can('category-destroy')
                                <button
                                        wire:click="confirmDelete({{ $category->id }})"
                                        class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-original-title="Remover"
                                        aria-label="Remover"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endcan

                        </td>

                    @else

                        <td class="text-center">
                            <span class="badge bg-danger">Negado</span>
                        </td>

                    @endcan

                </tr>

            @empty

                <td class="text-center" colspan="4">
                    Nenhum resultado encontrado
                </td>

            @endforelse

            </tbody>

        </table>

        @push('scripts')

            <script>

                let toastShown = false;

                window.addEventListener('no-results-found', () => {

                    if (toastShown) return;

                    toastShown = true;

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'info',
                        title: 'Nenhum resultado encontrado.',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,

                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    setTimeout(() => {
                        toastShown = false;
                    }, 3500);

                });

                window.addEventListener('show-delete-confirmation', event => {

                    const categoryId = event.detail.id;

                    Swal.fire({
                        title: 'Você tem certeza?',
                        text: "Essa ação não poderá ser desfeita!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sim, deletar!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {

                        if (result.isConfirmed) {

                            // Posteriormente:
                            // Livewire.dispatch('destroy', {id: categoryId});

                            alert('Oops! Esta feature ainda não está pronta!');

                        }

                    });

                });

            </script>

        @endpush

        {{ $categories->links() }}

    </div>
</div>