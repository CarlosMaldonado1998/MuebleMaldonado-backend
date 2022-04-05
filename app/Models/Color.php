<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable =[ 
        'name',
        'url', 
        ];


    public function products(){
        return $this->belongsToMany('App\Models\Product')->withTimestamps()->withPivot('id');
    }
}
