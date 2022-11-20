<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name'=>'Administrador',
                'username'=>'admin',
                'password' => bcrypt('12345678'),
                'id_personal'=>'1',
                'pregunta_a'=>bcrypt('Mordelon'),
                'pregunta_b'=>bcrypt('Rojo'),
                'pregunta_c'=>bcrypt('Catolica')
            ]
        );
    }
}
