<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueueTicket extends Model
{
    use SoftDeletes;

    // relação entre QueueTicket e Queue, QueueTicket pertence a uma Queue
    public function queue()
    {
        return $this->belongsTo(Queue::class, 'id_queue');
    }
}
