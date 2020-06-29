<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $table = 'sales';

    protected $fillable = [
        'subtotal',
        'total',
    ];

    public function products(){
        return $this->hasMany('App\Product');
    }
}
