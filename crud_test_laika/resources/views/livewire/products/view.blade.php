@section('title', __('Products'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="fab fa-laravel text-info"></i>
                                Productos </h4>
                        </div>
                        <div>
                            <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                                placeholder="Search Products">
                        </div>
                        <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> Agregar producto
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('livewire.products.create')
                    @include('livewire.products.update')
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead">
                                <tr>
                                    <td>#</td>
                                    <th>Nombre</th>
                                    <th>Categoria</th>
                                    <th>Disponible</th>
                                    {{-- <th>Estado</th> --}}
                                    <th>Image</th>
                                    <td>ACCIONES</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products['data'] as $row)
                                    <tr @if ($row['estado'] == 0) class=" btn-danger" @endif>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row['titulo'] }}</td>
                                        <td>{{ $row['des_categoria'] }}</td>
                                        <td>{{ $row['disponibles'] }}</td>
                                        {{-- <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked" @if ($row['estado'] == 1) checked @endif>
                                            </div>
                                        </td> --}}
                                        <td>
                                            <a href="{{ env('URL_API') }}img/{{ $row['imagen'] }}" target="_blanck">
                                                <i class="far fa-images">

                                                </i>
                                            </a>
                                        </td>
                                        <td width="90">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a data-toggle="modal" data-target="#updateModal"
                                                        class="dropdown-item"
                                                        wire:click="edit({{ $row['identificador'] }})"><i
                                                            class="fa fa-edit"></i> Editar </a>
                                                    <a class="dropdown-item"
                                                        onclick="confirm('Confirm Delete Product id {{ $row['identificador'] }}? \nDeleted Products cannot be recovered!')||event.stopImmediatePropagation()"
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
                                    <a class="page-link" wire:click="@if (array_key_exists('prev_page_url', $products)) render('{{ $products['prev_page_url']}}') @endif">Anterior</a>

                                </li>

                                <li class="page-item">
                                    <span
                                        class="page-link">{{ $products['current_page']}}</span>
                                </li>

                                <li class="page-item">
                                    <span class="page-link">de</span>
                                </li>
                                <li class="page-item">
                                    <span class="page-link">{{ $products['to']}}</span>
                                </li>

                                <li class="page-item">
                                    <a class="page-link" wire:click="render('{{  $products['next_page_url'] }}')">Siguiente</a>
                                </li>
                            </ul>
                        </nav> 

                        {{  $products['next_page_url'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
