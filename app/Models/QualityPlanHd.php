<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityPlanHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'quality_plan_hd_id';
    protected $table = 'quality_plan_hds';
    protected $guarded = ['quality_plan_hd_id'];
    public function details()
    {
        return $this->hasMany(QualityPlanDt::class, 'quality_plan_hd_id', 'quality_plan_hd_id');
    }
}
