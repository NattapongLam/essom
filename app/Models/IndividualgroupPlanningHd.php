<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualgroupPlanningHd extends Model
{
    use HasFactory;
    protected $table = 'individualgroup_planning_hds';
    protected $primaryKey = 'individualgroup_planning_hds_id';
    
    // อนุญาตให้ Mass Assignment ข้อมูลทั้งหมดได้ (ป้องกันปัญหา Field ไม่พึงประสงค์)
    protected $guarded = ['individualgroup_planning_hds_id'];

    /**
     * ความสัมพันธ์กับตาราง Detail (individualgroup_planning_dts)
     * 1 Header สามารถมีได้หลาย Rows (HasMany)
     */
    public function details()
    {
        return $this->hasMany(IndividualgroupPlanningDt::class, 'individualgroup_planning_hds_id', 'individualgroup_planning_hds_id');
    }
}
