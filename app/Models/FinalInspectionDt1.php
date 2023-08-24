<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalInspectionDt1 extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'finalInspection_dt1';
    protected $primaryKey = 'finalInspection_dt1_id';
    protected $guarded = ['finalInspection_dt1_id'];
}
