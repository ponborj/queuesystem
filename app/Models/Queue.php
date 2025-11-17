<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model
{
    use SoftDeletes;

    // relação entre Queue e Company, Queue pertence a uma Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }
}
