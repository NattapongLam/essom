<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionWorkingHoursDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'workinghours_dt';
    protected $primaryKey = 'workinghours_dt_id';
    protected $guarded = ['workinghours_dt_id'];
}
