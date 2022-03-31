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
    ];
}
