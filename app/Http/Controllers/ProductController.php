<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Listar todos os produtos
    public function index()
    {
        $products = Product::with(['category', 'images'])->get();
        return response()->json($products);
    }

    // Criar novo produto
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return response()->json($product->load(['category', 'images']), 201);
    }

    // Exibir um produto
    public function show(Product $product)
    {
        return response()->json($product->load(['category', 'images']));
    }

    // Atualizar produto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return response()->json($product->load(['category', 'images']));
    }

    // Deletar produto
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Produto excluído com sucesso.']);
    }
}