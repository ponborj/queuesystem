<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // adicionar 3 usuários de exemplo

        // Usuário 1
        // sys-admin - gestor da aplicação

        // Usuário 2
        // client-admin - gestor do cliente

        // Usuário 3
        // client-user - usuário comum do cliente

        $users = [
            [
                'email' => 'sysadmin@email.com',
                'password' => bcrypt('123'),
                'id_company' => 0,
                'role' => 'sys-admin',
                'active' => true
            ],
            [
                'email' => 'admincompany1@email.com',
                'password' => bcrypt('123'),
                'id_company' => 0,
                'role' => 'client-admin',
                'active' => true
            ],
            [
                'email' => 'admincompany2@email.com',
                'password' => bcrypt('123'),
                'id_company' => 0,
                'role' => 'client-admin',
                'active' => true
            ]
        ];

        DB::table('users')->insert($users);
    }
}
