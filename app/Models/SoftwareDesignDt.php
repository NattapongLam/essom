<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareDesignDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'software_design_dt_id';
    protected $table = 'software_design_dts';
    protected $guarded = ['software_design_dt_id'];
    public function header()
    {
        return $this->belongsTo(SoftwareDesignHd::class, 'software_design_hd_id', 'software_design_hd_id');
    }    
}
