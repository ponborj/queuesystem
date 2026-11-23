<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    // relação entre User e Company, User pertence a uma Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }
}
