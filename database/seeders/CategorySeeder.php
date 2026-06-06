<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $educativos = Category::create([
            'name' => 'Brinquedos Educativos',
            'slug' => 'brinquedos-educativos',
        ]);

        $arte = Category::create([
            'name' => 'Arte e Criatividade',
            'slug' => 'arte-e-criatividade',
        ]);

        $jogos = Category::create([
            'name' => 'Jogos e Quebra-Cabeças',
            'slug' => 'jogos-e-quebra-cabecas',
        ]);

        // Subcategorias
        Category::create([
            'name'      => 'Blocos e Encaixes',
            'slug'      => 'blocos-e-encaixes',
            'parent_id' => $educativos->id,
        ]);

        Category::create([
            'name'      => 'Pintura e Desenho',
            'slug'      => 'pintura-e-desenho',
            'parent_id' => $arte->id,
        ]);

        Category::create([
            'name'      => 'Quebra-Cabeças',
            'slug'      => 'quebra-cabecas',
            'parent_id' => $jogos->id,
        ]);
    }
}