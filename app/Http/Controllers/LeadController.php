<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'cidade_interesse' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
        ]);

        Lead::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pedido enviado com sucesso!'
        ]);
    }
}
