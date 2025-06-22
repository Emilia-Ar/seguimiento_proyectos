<?php
namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create(['nombre' => 'Matemáticas']);
        Categoria::create(['nombre' => 'Ciencias']);
        Categoria::create(['nombre' => 'Historia']);
        Categoria::create(['nombre' => 'Literatura']);
    }
}
