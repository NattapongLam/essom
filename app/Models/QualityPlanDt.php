<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityPlanDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'quality_plan_dt_id';
    protected $table = 'quality_plan_dts';
    protected $guarded = ['quality_plan_dt_id'];
    public function header()
    {
        return $this->belongsTo(QualityPlanHd::class, 'quality_plan_hd_id', 'quality_plan_hd_id');
    }    
}
