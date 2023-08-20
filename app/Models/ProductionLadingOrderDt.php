<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLadingOrderDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ladingorder_dt';
    protected $primaryKey = 'ladingorder_dt_id';
    protected $guarded = ['ladingorder_dt_id'];
}
