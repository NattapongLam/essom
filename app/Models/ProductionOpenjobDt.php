<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionOpenjobDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productionopenjob_dt';
    protected $primaryKey = 'productionopenjob_dt_id';
    protected $guarded = ['productionopenjob_dt_id'];
}
