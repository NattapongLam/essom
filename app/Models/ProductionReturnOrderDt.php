<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionReturnOrderDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'returnorder_dt';
    protected $primaryKey = 'returnorder_dt_id';
    protected $guarded = ['returnorder_dt_id'];
}
