<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::insert([
            ['name' => 'Hardware', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Software', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Redes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accesos', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
