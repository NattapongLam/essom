<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElemchptggroupPlanningHd extends Model
{
    use HasFactory;
    protected $table = 'elemchptggroup_planning_hds';
    protected $primaryKey = 'elemchptggroup_planning_hds_id';

    protected $fillable = [
        'elemchptggroup_planning_hds_flag',
        'prepared_by',
        'prepared_date',
        'checked_by',
        'checked_date',
        'approved_by',
        'approved_date',
        'docs_status',
    ];

    public function details()
    {
        return $this->hasMany(ElemchptggroupPlanningDt::class, 'elemchptggroup_planning_hds_id', 'elemchptggroup_planning_hds_id');
    }
}
