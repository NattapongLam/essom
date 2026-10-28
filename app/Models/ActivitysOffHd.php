<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitysOffHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'activitys_off_hds_id';
    protected $table = 'activitys_off_hds';
    protected $guarded = ['activitys_off_hds_id'];
    public function details()
    {
        return $this->hasMany(ActivitysOffDt::class, 'activitys_off_hds_id', 'activitys_off_hds_id');
    }
}
