<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'nombre' => 'Administrador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}