<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'dimension',
        'value',
        'product_id'
    ];
  
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
