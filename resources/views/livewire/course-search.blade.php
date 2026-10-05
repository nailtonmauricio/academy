<div class="card mb-4 border-light shadow">

    <div class="card-header d-flex justify-content-between align-items-center">

        <div class="flex-grow-1 d-flex justify-content-center">

            <form class="d-flex" wire:submit.prevent="search">

                <input
                        wire:model.live.debounce.500ms="search"
                        id="search"
                        name="search"
                        class="form-control"
                        type="text"
                        placeholder="Buscar por..."
                        aria-label="Buscar por..."
                        aria-describedby="btnNavbarSearch"
                >

            </form>

        </div>

        <span class="ms-auto">

            @can('course-create')

                <a
                        href="{{ route('course.create') }}"
                        class="bg-gradient btn btn-primary btn-sm"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        data-bs-original-title="Novo curso"
                        aria-label="Novo curso"
                >
                    <i class="fa-solid fa-plus"></i>
                </a>

            @endcan

        </span>

    </div>


    <div class="card-body">

        <x-alert/>

        <table id="courses"
               class="display table table-striped table-hover mb-2">

            <thead>

            <tr>
                <th>NOME</th>
                <th class="d-none d-md-table-cell">SUBCATEGORIA</th>
                <th class="d-none d-md-table-cell">CATEGORIA</th>
                <th class="d-none d-md-table-cell">CRIADO</th>
                <th class="d-none d-md-table-cell">MODIFICADO</th>
                <th class="text-center">OPÇÕES</th>
            </tr>

            </thead>


            <tbody>

            @forelse($courses as $course)

                <tr>

                    {{-- Nome --}}
                    <td class="align-middle">

                        {{ $course->name }}

                    </td>


                    {{-- Subcategoria --}}
                    <td class="d-none d-md-table-cell align-middle">

                        {{ $course->subcategory->name }}

                    </td>


                    {{-- Categoria --}}
                    <td class="d-none d-md-table-cell align-middle">

                        {{ $course->subcategory->category->name }}

                    </td>


                    {{-- Criado --}}
                    <td class="d-none d-md-table-cell align-middle">

                        {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}

                    </td>


                    {{-- Modificado --}}
                    <td class="d-none d-md-table-cell align-middle">

                        {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}

                    </td>


                    {{-- Opções --}}
                    @can('course-show')

                        <td class="text-center">
                            {{-- Show --}}
                            @can('course-show')
                                <a
                                        href="{{ route('course.show', ['course' => $course->id]) }}"
                                        class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-original-title="Ver"
                                        aria-label="Ver"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            {{-- Editar --}}

                            @can('course-edit')

                                <a
                                        href="{{ route('course.edit', ['course' => $course->id]) }}"
                                        class="bg-gradient btn btn-sm btn-primary me-2 mt-1 mt-md-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-original-title="Editar"
                                        aria-label="Editar"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>

                            @endcan


                            {{-- Remover --}}

                            @can('course-destroy')

                                <button
                                        wire:click="confirmDelete({{ $course->id }})"
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

                            <span class="badge bg-danger">
                                Negado
                            </span>

                        </td>

                    @endcan

                </tr>

            @empty

                <tr>

                    <td class="text-center" colspan="6">

                        Nenhum resultado encontrado

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>


        @push('scripts')

            <script>

                let toastShown = false;


                /*
                 * Nenhum resultado encontrado
                 */

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

                            toast.addEventListener(
                                'mouseenter',
                                Swal.stopTimer
                            );

                            toast.addEventListener(
                                'mouseleave',
                                Swal.resumeTimer
                            );

                        }

                    });

                    setTimeout(() => {

                        toastShown = false;

                    }, 3500);

                });


                /*
                 * Confirmação de exclusão
                 */

                window.addEventListener(
                    'show-delete-confirmation',
                    event => {

                        const courseId = event.detail.id;

                        Swal.fire({

                            title: 'Você tem certeza?',

                            text: 'Essa ação não poderá ser desfeita!',

                            icon: 'warning',

                            showCancelButton: true,

                            confirmButtonColor: '#d33',

                            cancelButtonColor: '#3085d6',

                            confirmButtonText: 'Sim, deletar!',

                            cancelButtonText: 'Cancelar'

                        }).then((result) => {

                            if (result.isConfirmed) {

                                Livewire.dispatch(
                                    'destroy',
                                    {
                                        id: courseId
                                    }
                                );

                            }

                        });

                    }
                );

            </script>

        @endpush


        {{ $courses->links() }}

    </div>

</div>