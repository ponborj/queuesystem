<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class QueueTicketSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('queue_tickets')->truncate();

        $queueIDs = DB::table('queues')->pluck('id')->toArray();

        foreach ($queueIDs as $queueID) {

            $totalTickets = rand(50, 200); // Aleatório entre 50 e 200 tickets por fila

            $createdAt = now();
            $caletAt = now()->addMinutes(2); // Adiciona 2 minutos ao horário atual

            for ($i = 0; $i <= $totalTickets; $i++) {
                $status = '';
                $statusTmp = rand(1, 4);

                if ($statusTmp == 1) {
                    $status = 'waiting';
                } elseif ($statusTmp == 2) {
                    $status = 'called';
                } elseif ($statusTmp == 3) {
                    $status = 'not_attended';
                } elseif ($statusTmp == 4) {
                    $status = 'dismissed';
                }

                // cria um ticket com o status gerado aleatoriamente
                DB::table('queue_tickets')->insert([
                    'id_queue' => $queueID,
                    'queue_ticket_number' => $i + 1,
                    'queue_ticket_created_at' => $createdAt,
                    'queue_ticket_called_at' => $status === 'called' ? $caletAt : null,
                    'queue_ticket_called_by' => $status === 'called' ? 'user_' . rand(1, 10) : null,
                    'queue_ticket_status' => $status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $createdAt = $createdAt->addMinutes(2); // Incrementa 2 minutos para o próximo ticket
                $caletAt = $caletAt->addMinutes(2); // Incrementa 2 minutos para o próximo ticket chamado
            }
        }
    }
}
