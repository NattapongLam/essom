<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitysPdtDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'activitys_pdt_dts_id';
    protected $table = 'activitys_pdt_dts';
    protected $guarded = ['activitys_pdt_dts_id'];

    public function header()
    {
        return $this->belongsTo(ActivitysPdtHd::class, 'activitys_pdt_hds_id', 'activitys_pdt_hds_id');
    }
}
