<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable =[
        'date',
        'type_pay',
        'state',
        'iva',
        'val_iva',
        'subtotal', 
        'total', 
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function orders(){
        return $this->hasMany('App\Models\Order');
    }


}
