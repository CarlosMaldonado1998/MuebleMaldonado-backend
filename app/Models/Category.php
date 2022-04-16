<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable =[ 
        'name',
        'room_id'
        ];

        public function products(){
            return $this->hasMany('App\Models\Product');
        }

        public function deliveries(){
            return $this->hasMany('App\Models\Delivery');
        }

        public function room(){
        return $this->belongsTo('App\Models\Room');
    }
}
