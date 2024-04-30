<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'car';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'model',
        'brand',
        'price',
        'seats',
        'transmission',
        'engine',
        'doors',
        'bags',
        'air-conditioning',
        'kilometer',
        'horsepower',
        'description',
        'image',
        'rented'
    ];
    
}
