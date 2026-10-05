<div>

    <div class="row mb-3">

        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>

                <input
                        type="text"
                        wire:model.live="search"
                        class="form-control"
                        placeholder="Pesquisar aula..."
                >
            </div>
        </div>

    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead>
            <tr>
                <th width="80">#</th>
                <th>Aula</th>
                <th width="100">Ordem</th>
                <th width="100">Status</th>
                <th width="150">Ações</th>
            </tr>
            </thead>

            <tbody>

            @forelse ($lessons as $lesson)

                <tr>

                    <td>
                        {{ $lesson->id }}
                    </td>

                    <td>
                        {{ $lesson->name }}
                    </td>

                    <td>
                        {{ $lesson->order }}
                    </td>

                    <td>
                        @if ($lesson->status)
                            <span class="badge bg-success">
                                    Ativo
                                </span>
                        @else
                            <span class="badge bg-secondary">
                                    Inativo
                                </span>
                        @endif
                    </td>

                    <td>
                        {{-- Ações serão implementadas posteriormente --}}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="text-center">
                        Nenhuma aula encontrada.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $lessons->links() }}

</div>