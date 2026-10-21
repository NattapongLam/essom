<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElemchptggroupPlanningDt extends Model
{
    use HasFactory;
    protected $table = 'elemchptggroup_planning_dts';
    protected $primaryKey = 'elemchptggroup_planning_dts_id';

    protected $fillable = [
        'elemchptggroup_planning_hds_id',
        'set_no',
        'section',
        'product_code',
        'job_no',
        'qty',
        'customer',
        'responsible',
        'budget_time',
        'mh_for_date',
        'to_date',
        'remark',
        'month_1',
        'details',
        'ack',
        'ack_date',
        'weekly_review',
    ];

    protected $casts = [
        'details' => 'array',
        'ack' => 'array',
        'ack_date' => 'array',
        'weekly_review' => 'array',
    ];

    public function header()
    {
        return $this->belongsTo(ElemchptggroupPlanningHd::class, 'elemchptggroup_planning_hds_id', 'elemchptggroup_planning_hds_id');
    }
}
