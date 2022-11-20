<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargo::create(
            [
                'NombreDelCargo' => 'Administrador',
                'DescripciónDelCargo' => 'Cargo para el usuario maestro',
                'Sueldo'  => '0.00',
            ]
        );
        
    }
}
