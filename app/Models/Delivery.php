<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable =[ 
        'title',
        'description',
        'url',
        'category_id'
        ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
