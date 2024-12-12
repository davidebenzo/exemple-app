<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'latitude',
        'longitude',
        'province_id',
    ];

    protected $hidden = [
        'province_id',
    ];

    public $timestamps = false;

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function zips()
    {
        return $this->hasMany(Zip::class)->orderBy('code');
    }

    public function commercialActivities()
    {
        return $this->hasMany(CommercialActivity::class)->orderBy('company');
    }

    public function deliveringActivities()
    {
        return $this->belongsToMany(CommercialActivity::class, 'commercial_activity_city', 'city_id', 'commercial_activity_id');
    }
}
