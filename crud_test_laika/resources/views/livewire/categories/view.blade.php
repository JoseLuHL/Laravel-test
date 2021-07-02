@section('title', __('Categorys'))
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <h4><i class="fab fa-laravel text-info"></i>
                                    Categorias </h4>
                            </div>
    
                            @if (session()->has('message'))
                                <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                                    {{ session('message') }} </div>
                            @endif
                            <div>
                                <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                                    placeholder="Buscar Categoria">
                            </div>
                            <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Agregar Categoria
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('livewire.categories.create')
                        @include('livewire.categories.update')
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="thead">
                                    <tr>
                                        <td>#</td>
                                        <th>Titulo</th>
                                        <th>Detalle</th>
                                        <td>ACCIONES</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories['data'] as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row['titulo'] }}</td>
                                            <td>{{ $row['detalles'] }}</td>
                                            <td width="90">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Acción
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a data-toggle="modal" data-target="#updateModal"
                                                            class="dropdown-item"
                                                            wire:click="edit({{ $row['identificador'] }})"><i
                                                                class="fa fa-edit"></i> Editar </a>
                                                        <a class="dropdown-item"
                                                            onclick="confirm('Confirm Delete Category id {{ $row['identificador'] }}? \nDeleted Categorys cannot be recovered!')||event.stopImmediatePropagation()"
                                                            wire:click="destroy({{ $row['identificador'] }})"><i
                                                                class="fa fa-trash"></i> Eliminar </a>
                                                    </div>
                                                </div>
                                            </td>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">

                                    <li class="page-item">
                                        <a class="page-link" wire:click="@if (array_key_exists('previous', $categories['meta']['pagination']['links'])) render('{{ $categories['meta']['pagination']['links']['previous'] }}') @endif">Anterior</a>

                                    </li>

                                    <li class="page-item">
                                        <span
                                            class="page-link">{{ $categories['meta']['pagination']['current_page'] }}</span>
                                    </li>

                                    <li class="page-item">
                                        <span class="page-link">de</span>
                                    </li>
                                    <li class="page-item">
                                        <span
                                            class="page-link">{{ $categories['meta']['pagination']['total_pages'] }}</span>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" wire:click="@if (array_key_exists('next',
                                            $categories['meta']['pagination']['links'])) render('{{ $categories['meta']['pagination']['links']['next'] }}') @endif">Siguiente</a>
                                    </li>
                                </ul>
                            </nav>


                        </div>
                        {{-- {{ $categories->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
