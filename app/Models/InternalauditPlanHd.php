<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalauditPlanHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'internalaudit_plan_hds_id';
    protected $table = 'internalaudit_plan_hds';
    protected $guarded = ['internalaudit_plan_hds_id'];
    protected $fillable = [
        'internalaudit_plan_hds_flag', 
        'period', 
        'prepared_by', 
        'prepared_date', 
        'checked_by',
        'checked_date',
        'approved_by',
        'approved_date',
        'docs_status',
        'created_at',
        'updated_at'
    ];
}
