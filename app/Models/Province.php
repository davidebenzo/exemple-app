<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommercialActivities;



class Province extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'region_id',
    ];

    protected $hidden = [
        'region_id',
    ];

    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class)->orderBy('name');
    }

   
}
