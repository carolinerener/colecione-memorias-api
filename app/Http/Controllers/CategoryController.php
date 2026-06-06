<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Listar todas as categorias
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return response()->json($categories);
    }

  // Criar nova categoria
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'parent_id' => 'nullable|exists:categories,id',
    ]);

    $category = Category::create([
        'name' => $request->name,
        'slug' => \Illuminate\Support\Str::slug($request->name),
        'parent_id' => $request->parent_id,
    ]);

    return response()->json($category, 201);
}

    // Exibir uma categoria
    public function show(Category $category)
    {
        return response()->json($category->load('children'));
    }

    // Atualizar categoria
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update([
        'name' => $request->name,
        'slug' => \Illuminate\Support\Str::slug($request->name),
        'parent_id' => $request->parent_id,
]);
    }

    // Deletar categoria
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Categoria excluída com sucesso.']);
    }
}