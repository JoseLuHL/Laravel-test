<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withHeaders([
            'api-key-laika' => env('API_KEY_LAIKA'),
        ])->get(env('URL_API').'api/categories');
        return  $response->json();
    }

}
