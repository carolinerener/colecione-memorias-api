<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $blocos = Category::where('slug', 'blocos-e-encaixes')->first();
        $pintura = Category::where('slug', 'pintura-e-desenho')->first();
        $quebra = Category::where('slug', 'quebra-cabecas')->first();

        Product::create([
            'name'        => 'Blocos de Montar Coloridos',
            'slug'        => 'blocos-de-montar-coloridos',
            'description' => 'Kit com 50 blocos coloridos para estimular a criatividade e coordenacao motora.',
            'price'       => 89.90,
            'stock'       => 50,
            'category_id' => $blocos->id,
        ]);

        Product::create([
            'name'        => 'Kit de Pintura Infantil',
            'slug'        => 'kit-de-pintura-infantil',
            'description' => 'Kit completo com tintas atoxicas, pinceis e tela para criancas a partir de 3 anos.',
            'price'       => 64.90,
            'stock'       => 30,
            'category_id' => $pintura->id,
        ]);

        Product::create([
            'name'        => 'Quebra-Cabeca Mundo Animal',
            'slug'        => 'quebra-cabeca-mundo-animal',
            'description' => 'Quebra-cabeca com 100 pecas ilustradas com animais do mundo todo.',
            'price'       => 49.90,
            'stock'       => 40,
            'category_id' => $quebra->id,
        ]);

        Product::create([
            'name'        => 'Torre de Encaixe Arco-Iris',
            'slug'        => 'torre-de-encaixe-arco-iris',
            'description' => 'Brinquedo educativo com aneis coloridos para encaixar por tamanho e cor.',
            'price'       => 39.90,
            'stock'       => 60,
            'category_id' => $blocos->id,
        ]);

        Product::create([
            'name'        => 'Massinha de Modelar Natural',
            'slug'        => 'massinha-de-modelar-natural',
            'description' => 'Massinha atoxica feita com ingredientes naturais, em 6 cores vibrantes.',
            'price'       => 29.90,
            'stock'       => 80,
            'category_id' => $pintura->id,
        ]);
    }
}