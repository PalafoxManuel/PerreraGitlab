<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

class TipoReporteSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_reporte')->insert([
            ['Id_Tipo_Reporte' => 1, 'Nombre' => 'Maltrato'],
            ['Id_Tipo_Reporte' => 2, 'Nombre' => 'Extravío'],
            ['Id_Tipo_Reporte' => 3, 'Nombre' => 'Vacunación'],
            ['Id_Tipo_Reporte' => 4, 'Nombre' => 'Adopción'],
        ]);
    }
}
