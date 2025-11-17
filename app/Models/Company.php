<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    // relação entre Company e User, Company tem muitos Users
    public function users()
    {
        return $this->hasMany(User::class, 'id_company');
    }

    // relação entre Company e Queue, Company tem muitas Queues
    public function queues()
    {
        return $this->hasMany(Queue::class, 'id_company');
    }
}
