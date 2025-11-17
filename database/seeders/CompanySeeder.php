<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [];

        for ($index = 1; $index <= 3; $index++) {
            $companies[] = [
                'company_name' => 'Empresa ' . $index,
                'company_logo' => 'Empresa_0' . $index . '.png',
                'uuid' => Str::uuid(),
                'address' => 'Rua da Empresa ' . $index . ', 100, Brasília DF',
                'phone' => '0000000000' . $index,
                'email' => 'empresa' . $index . '@email.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ];
        }

        DB::table('companies')->insert($companies);
    }
}
