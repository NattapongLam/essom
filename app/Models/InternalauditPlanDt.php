<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalauditPlanDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'internalaudit_plan_dts_id';
    protected $table = 'internalaudit_plan_dts';
    protected $guarded = ['internalaudit_plan_dts_id'];
    protected $fillable = [
        'internalaudit_plan_hds_id', 
        'date', 
        'process', 
        'auditee', 
        'auditor', 
        'person_at', 
        'internalaudit_plan_dts_flag',
        'created_at',
        'updated_at'
    ];
}
