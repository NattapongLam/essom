<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionWorkingHoursStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'workinghours_status';
    protected $guarded = ['workinghours_status_id'];
}
