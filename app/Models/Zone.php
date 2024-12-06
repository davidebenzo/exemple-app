<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;

    public function regions()
    {
        return $this->hasMany(Region::class)->orderBy('name');
    }
}
