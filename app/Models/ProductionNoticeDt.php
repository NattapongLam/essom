<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionNoticeDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productionnotice_dt';
    protected $primaryKey = 'productionnotice_dt_id';
    protected $guarded = ['productionnotice_dt_id'];
}
