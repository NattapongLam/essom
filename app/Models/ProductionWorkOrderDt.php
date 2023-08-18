<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionWorkOrderDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'workorder_dt';
    protected $primaryKey = 'workorder_dt_id';
    protected $guarded = ['workorder_dt_id'];
}
