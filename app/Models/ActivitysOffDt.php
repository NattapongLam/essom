<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitysOffDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'activitys_off_dts_id';
    protected $table = 'activitys_off_dts';
    protected $guarded = ['activitys_off_dts_id'];
    public function header()
    {
        return $this->belongsTo(ActivitysOffHd::class, 'activitys_off_hds_id', 'activitys_off_hds_id');
    }
}
