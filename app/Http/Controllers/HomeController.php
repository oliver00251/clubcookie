<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Pega todos os produtos ou apenas os em destaque, se tiver flag
        $produtos = Produto::all();

        return view('home', compact('produtos'));
    }
}
