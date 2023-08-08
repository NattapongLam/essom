<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionOpenjobStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productionopenjob_status';
    protected $guarded = ['productionopenjob_status_id'];
}
