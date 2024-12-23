<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\City;
use App\Models\Category;
use App\Models\User;

class CommercialActivity extends Model
{
    /** @use HasFactory<\Database\Factories\CommercialActivityFactory> */
    use HasFactory;
    protected $fillable = [
        'id',
        'company',
        'address',
        'city_id',
        'category_id',
        'description',
        'phone',
        'email',
        'latitude',
        'longitude',
        'rangeKm',
        'user_id'
    ];


    protected $hidden = [
        'city_id',
        'category_id',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function deliveryCities()
    {
        return $this->belongsToMany(City::class, 'commercial_activity_city', 'commercial_activity_id', 'city_id');
    }
}
