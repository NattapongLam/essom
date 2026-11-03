<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitysoffMasterDt extends Model
{
    use HasFactory;
    protected $table = 'activitysoff_master_dts';
    protected $primaryKey = 'activitysoff_master_dts_id';

    protected $fillable = [
        'activitysoff_master_hds_id',
        'code',
        'detail',
        'score',
        'activitysoff_master_dts_flag',
    ];

    // ความสัมพันธ์: Detail หลายรายการ เป็นของ 1 Header
    public function header()
    {
        return $this->belongsTo(ActivitysoffMasterHd::class, 'activitysoff_master_hds_id', 'activitysoff_master_hds_id');
    }
}
