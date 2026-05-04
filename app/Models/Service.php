<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'icon'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
