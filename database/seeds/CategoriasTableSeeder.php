<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'id'        => 1,
            'categoria' => "Producto"
        ]);

        DB::table('users')->insert([
            'id'    => 1,
            'name' => "admin",
            'email' => "admin@admin.com",
            'password' => "admin",
        ]);
    }
}
