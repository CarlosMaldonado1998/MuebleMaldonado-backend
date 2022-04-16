<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable =[ 
        'name',
        'url'
        ];

        public function products(){
            return $this->hasMany('App\Models\Product');
        }

        public function categories(){
            return $this->hasMany('App\Models\Category');
        }
}
