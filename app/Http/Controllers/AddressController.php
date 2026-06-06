<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // Listar endereços do usuário autenticado
    public function index(Request $request)
    {
        $addresses = Address::where('user_id', $request->user()->id)->get();
        return response()->json($addresses);
    }

    // Criar novo endereço
    public function store(Request $request)
    {
        $request->validate([
            'street'       => 'required|string|max:255',
            'number'       => 'required|string|max:20',
            'neighborhood' => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'state'        => 'required|string|max:2',
            'zip_code'     => 'required|string|max:10',
        ]);

        $address = Address::create([
            'user_id'      => $request->user()->id,
            'street'       => $request->street,
            'number'       => $request->number,
            'neighborhood' => $request->neighborhood,
            'city'         => $request->city,
            'state'        => $request->state,
            'zipcode'      => $request->zip_code,
        ]);

        return response()->json($address, 201);
    }

    // Deletar endereço
    public function destroy(Request $request, Address $address)
    {
        if ($address->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $address->delete();
        return response()->json(['message' => 'Endereço excluído com sucesso.']);
    }
}