<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualgroupPlanningDt extends Model
{
    use HasFactory;
    protected $table = 'individualgroup_planning_dts';
    protected $primaryKey = 'individualgroup_planning_dts_id';
    
    protected $guarded = ['individualgroup_planning_dts_id'];

    public function header()
    {
        return $this->belongsTo(IndividualgroupPlanningHd::class, 'individualgroup_planning_hds_id', 'individualgroup_planning_hds_id');
    }
}
