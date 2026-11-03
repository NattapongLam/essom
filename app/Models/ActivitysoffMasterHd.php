<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitysoffMasterHd extends Model
{
    use HasFactory;
    protected $table = 'activitysoff_master_hds';
    protected $primaryKey = 'activitysoff_master_hds_id';

    protected $fillable = [
        'activitysoff_master_hds_flag',
        'department_name',
        'floor',
    ];

    // ความสัมพันธ์: 1 Header มีหลาย Details
    public function details()
    {
        return $this->hasMany(ActivitysoffMasterDt::class, 'activitysoff_master_hds_id', 'activitysoff_master_hds_id');
    }
}
