<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsoCar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'iso_car';
    protected $guarded = ['iso_car_id'];
}
