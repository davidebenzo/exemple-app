<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\City;
use App\Models\Category;

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
    ];


    protected $hidden = [
        'city_id',
        'category_id'
    ];


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
