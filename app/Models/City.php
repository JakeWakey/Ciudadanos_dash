<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{

    protected $fillable = ['name'];

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }
}
