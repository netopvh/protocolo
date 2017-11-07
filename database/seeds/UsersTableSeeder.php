<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /*
        \App\Domains\Access\Models\User::create([
            'name' => 'ANGELO MENDONÇA NETO',
            'username' => '00545841240',
            'email' => 'netopvh@gmail.com@gmail.com',
            'password' => bcrypt('123456'),
        ]); */

        \App\Domains\Access\Models\User::create([
            'name' => 'PAULO SERGIO ALVES SILVA',
            'username' => '83395',
            'email' => 'paulo@gmail.com',
            'password' => bcrypt('123456'),
        ]); 
        \App\Domains\Access\Models\User::create([
            'name' => 'JÉSSICA ALINE FERREIRA MATOS COUTINHO',
            'username' => '293506',
            'email' => 'jessica@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
