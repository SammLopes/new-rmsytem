<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Client::with('client_contact')->paginate(10);

        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteWithContatosRequest $request)
    {
        DB::transaction(function () use ($request) {

            $cliente = Client::create($request->only('nome','cpf','cnpj','razao_social','telefone_1','telefone_2'));

            foreach ($request->contatos as $contato) {
                Contato::create([
                    'nome' => $contato['nome'],
                    'telefone_1' => $contato['telefone_1'],
                    'telefone_2' => $contato['telefone_2'] ?? null,
                    'cliente_id' => $cliente->id,
                ]);
            }

        });
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
