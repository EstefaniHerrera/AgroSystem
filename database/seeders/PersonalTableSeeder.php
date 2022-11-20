<?php

namespace Database\Seeders;

use App\Models\Personal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Personal::create(
            [
                'cargo_id'  => '1',
                'IdentidadDelEmpleado' =>'0000000000000',
                'NombresDelEmpleado' => 'Administrador',
                'ApellidosDelEmpleado' => 'Primero',
                'CorreoElectrónico' => 'primerusuario@arreiro.com',
                'Teléfono' => '00000000',
                'FechaDeNacimiento' => '2000-12-02',
                'FechaDeIngreso'  => '2022-08-01',
                'Ciudad' => 'Danlí',
                'Dirección' => 'San Diego, Jamastran',
                'EmpleadoActivo' => 'Activo'
            ]
        );

    }
}
