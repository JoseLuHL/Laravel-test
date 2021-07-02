<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CategoryController;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $categoria_id, $name, $description, $quantity, $status, $image;
    public $updateMode = false;
    public $pagina = "";
    public $photo;

    public function __construct()
    {
        $this->pagina = env('URL_API') . 'products';
    }

    public function render($url = '')
    {
        $keyWord = '%' . $this->keyWord . '%';
        // $url=$this->pagina;
        if ($url == '') {
            $url = $this->pagina;
        } else {
            $this->pagina = $url;
        }
        $response = Http::get($url);
        $products = $response->json();
        $resCategory = Http::get(env('URL_API') . 'categories');
        $categorias = $resCategory->json();
        return view('livewire.products.view', ['products' => $products, 'categories' => $categorias],);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
        $this->name = null;
        $this->description = null;
        $this->quantity = null;
        $this->status = null;
        $this->image = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'categoria_id'=>'required'
            // 'image' => 'required',
        ]);

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'image' => $this->image
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Product Successfully created.');
    }

    public function edit($id)
    {
        $record = Product::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->description = $record->description;
        $this->quantity = $record->quantity;
        $this->status = $record->status;
        $this->image = $record->image;
        $this->categoria_id = $record->category_id;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'image' => 'required',
            'categoria_id'=>'required'
        ]);

        if ($this->selected_id) {
            $record = Product::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'description' => $this->description,
                'quantity' => $this->quantity,
                'status' => $this->status,
                'image' => $this->image
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Product Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Product::where('id', $id);
            $record->delete();
        }
    }
}
