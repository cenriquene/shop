<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleTransaction extends Model
{
    use SoftDeletes;

    protected $table = 'sale_transactions';

    protected $fillable = [
        'subtotal',
        'total',
        'currency',
        'name',
        'address',
        'country',
        'exp_month',
        'exp_year',
        'card_last_numbers',
        'gateway_response',
        'sale_id'
    ];

    public function sale(){
        return $this->belongsTo('App\Sale');
    }
}