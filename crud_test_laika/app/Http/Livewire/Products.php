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
        $this->pagina = env('URL_API') . 'api/products';
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
        $response = Http::withHeaders([
            'api-key-laika' => env('API_KEY_LAIKA'),
        ])->get($url);
        $products = $response->json();
        $resCategory = Http::withHeaders([
            'api-key-laika' => env('API_KEY_LAIKA'),
        ])->get(env('URL_API') . 'api/categories');
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
        $this->categoria_id = null;
        $this->image = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'categoria_id'=>'required'
            // 'image' => 'required',
        ]);
        $this->image='2.png';
        $this->status=1;
      
        $response = Http::withHeaders([
            'api-key-laika' => env('API_KEY_LAIKA'),
        ])->post(env('URL_API').'api/products', [
            'titulo' => $this->name,
            'detalles' => $this->description,
            'disponibles' => $this->quantity,
            'estado' => $this->status,
            'imagen' => $this->image,
            'categoria'=> $this->categoria_id
        ]);

        $this->resetInput();
        $this->emit('closeModal');
        $this->updateMode = false;
        session()->flash('message', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $record = Http::withHeaders([
            'api-key-laika' => env('API_KEY_LAIKA'),
        ])->get(env('URL_API').'api/products/'.$id)['data'];

        $this->selected_id = $id;
        $this->name = $record[0]['titulo'];
        $this->description = $record[0]['detalles'];
        $this->quantity = $record[0]['disponibles'];
        $this->status = $record[0]['estado'];
        $this->image = env('URL_API').'img/'.$record[0]['imagen'];
        $this->categoria_id = $record[0]['categoria_id'];
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'categoria_id'=>'required'
            // 'image' => 'required',
        ]);

        if ($this->selected_id) {
            $this->image='2.png';
            $this->status=1;
            $response = Http::withHeaders([
                'api-key-laika' => env('API_KEY_LAIKA'),
            ])->put(env('URL_API').'api/products/'.$this->selected_id, [
                'titulo' => $this->name,
                'detalles' => $this->description,
                'disponibles' => $this->quantity,
                'estado' => $this->status,
                'imagen' => $this->image,
                'categoria'=> $this->categoria_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Product Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $response = Http::withHeaders([
                'api-key-laika' => env('API_KEY_LAIKA'),
            ])->delete(env('URL_API').'api/products/'.$id);
            // $record = Product::where('id', $id);
            // $record->delete();
        }
    }
}
