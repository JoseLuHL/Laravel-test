<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nuevo producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
	
            <form>
                <input type="hidden" wire:model="selected_id">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="description">Detalle</label>
            <input wire:model="description" type="text" class="form-control" id="description" placeholder="Description">@error('description') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="quantity">Cantidad disponible</label>
            <input wire:model="quantity" type="text" class="form-control" id="quantity" placeholder="Cantidad disponible">@error('quantity') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="status">Estado</label>
            <input wire:model="status" type="hidden"  id="status" placeholder="Estado">@error('status') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="photo">Imagen</label>
            <input wire:model="photo" type="file" class="form-control" id="photo" placeholder="Image">@error('image') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        @if ($photo)
     
        <img width="100" height="100" src="{{ $photo->temporaryUrl() }}">
        @endif
        <h3>Categorias</h3>
        <select wire:model="categoria_id" id="categoria_id" class="form-select" size="10"  >
            <option value="0" selected>Selecciona una categoria</option> @error('categoria_id') <span class="error text-danger">{{ $message }}</span> @enderror
            @foreach ($categories['data'] as $item)
            <option value="{{ $item['identificador'] }}">{{ $item['titulo'] }}</option>
            @endforeach
          </select>
        </form>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>