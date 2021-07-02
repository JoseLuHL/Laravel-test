<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CategoryController;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class Categories extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $description;
    public $updateMode = false;
    public $pagina = "";
    private  $cateController ;

    public function __construct()
    {
       $this->cateController = new CategoryController();
       $this->pagina = env('URL_API') .'api/categories';
    }

    public function render($url='')
    {
        $keyWord = '%'.$this->keyWord .'%';
        // $url=$this->pagina;
        if ( $url=='') {
            $url=$this->pagina;        
        }
        else
        {
            $this->pagina=$url;
        }
        $categorias = $this->cateController->index();
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.categories.view', [
            'categories' => $categorias
        ]);
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
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'description' => 'required',
        ]);

        $respuesta = Http::withHeaders([
            'api-key-laika' => env('API_KEY_LAIKA'),
        ])->post(env('URL_API').'api/categories',[
            'titulo' => $this-> name,
			'detalles' => $this-> description
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Categoria creada correctamente.');
    }

    public function edit($id)
    {
        // $record = Category::findOrFail($id);
        $response = Http::withHeaders([
            'api-key-laika' => env('API_KEY_LAIKA'),
        ])->get(env('URL_API').'api/categories/'.$id);
        $record = $response->json()['data'];
        $this->selected_id = $id; 
		$this->name = $record['titulo'];
		$this->description = $record['detalles'];		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'description' => 'required',
        ]);

        if ($this->selected_id) {

            $response = Http::withHeaders([
                'api-key-laika' => env('API_KEY_LAIKA'),
            ])->put(env('URL_API').'api/categories/'. $this->selected_id,[
                'titulo' => $this-> name,
			'detalles' => $this-> description
            ]);
            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Categoria actualizada con exito');
        }
    }

    public function destroy($id)
    {
        if ($id) {
           $response = Http::withHeaders([
            'api-key-laika' => env('API_KEY_LAIKA'),
        ])->delete(env('URL_API').'api/categories/'.$id);
        }
    }
}
