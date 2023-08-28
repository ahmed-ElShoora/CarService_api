<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'tec_id',
        'client_id',
        'type',
        'category_id',
        'category_price',
        'price',
        'lat',
        'lng',
        'day_work',
        'end_date',
        'desc',
        'image',
        'vidoe',   
        'arrive',
        'pay-invoice',
        'add-addtions'
    ];
}
