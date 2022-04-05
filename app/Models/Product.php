<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[ 
        'name', 
        'code',  
        'description', 
        'warranty',
        'material',
        'delivery_time',
        'room_id',
        'category_id'
    ];

    public function colors(){
        return $this->belongsToMany('App\Models\Color')->withTimestamps()->withPivot('id');
    }

    public function images(){
        return $this->hasMany('App\Models\Image', 'product_id');
    }

    public function prices(){
        return $this->hasMany('App\Models\Price');
    }

    public function room(){
        return $this->belongsTo('App\Models\Room');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

}
