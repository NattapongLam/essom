<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalInspectionDt2 extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'finalInspection_dt2';
    protected $primaryKey = 'finalInspection_dt2_id';
    protected $guarded = ['finalInspection_dt2_id'];
}
