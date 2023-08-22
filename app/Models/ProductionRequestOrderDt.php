<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionRequestOrderDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'requestorder_dt';
    protected $primaryKey = 'requestorder_dt_id';
    protected $guarded = ['requestorder_dt_id'];
}
