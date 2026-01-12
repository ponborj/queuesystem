<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class QueueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // criar dados iniciais para a tabela de filas
        $data = [
            [
                'id' => 1,
                'id_company' => 1,
                'name' => 'Fila número 1',
                'description'=> 'Fila para o Atendimento Geral',
                'service_name' => 'Atendimento Geral',
                'service_desk' => 'Balcão',
                'queue_prefix' => 'A',
                'queue_total_digits' => 3, // 001, 002, ..., 999, 001
                'queue_colors' => json_encode([
                    'prefix_bg_color' => '#FFFF00',
                    'prefix_text_color' => '000000',
                    'number_bg_color' => '#AAAAAA',
                    'number_text_color' => '#000000',
                ]),
                'hash_code' => Str::random(64),
                'status' => 'active',
                'created_at'=> now(),
                'updated_at'=> now(),
                'deleted_at'=> null,
            ],
            [
                'id' => 2,
                'id_company' => 1,
                'name' => 'Fila número 2',
                'description'=> 'Fila para a Consulta Familiar',
                'service_name' => 'Consulta Familiar',
                'service_desk' => 'Balcão 2',
                'queue_prefix' => 'B',
                'queue_total_digits' => 3, // 001, 002, ..., 999, 001
                'queue_colors' => json_encode([
                    'prefix_bg_color' => '#FFFF00',
                    'prefix_text_color' => '000000',
                    'number_bg_color' => '#AAAAAA',
                    'number_text_color' => '#000000',
                ]),
                'hash_code' => Str::random(64),
                'status' => 'active',
                'created_at'=> now(),
                'updated_at'=> now(),
                'deleted_at'=> null,
            ],
            [
                'id' => 3,
                'id_company' => 2,
                'name' => 'Fila número 3',
                'description'=> 'Fila para a Consulta de Rastreio',
                'service_name' => 'Consulta de Rastreio',
                'service_desk' => 'Balcão 3',
                'queue_prefix' => 'C',
                'queue_total_digits' => 3, // 001, 002, ..., 999, 001
                'queue_colors' => json_encode([
                    'prefix_bg_color' => '#FFFF00',
                    'prefix_text_color' => '000000',
                    'number_bg_color' => '#AAAAAA',
                    'number_text_color' => '#000000',
                ]),
                'hash_code' => Str::random(64),
                'status' => 'active',
                'created_at'=> now(),
                'updated_at'=> now(),
                'deleted_at'=> null,
            ],
        ];

        DB::table('queues')->insert($data);

        echo count($data) . " Filas adicionadas com sucesso!" . PHP_EOL;
    }
}
