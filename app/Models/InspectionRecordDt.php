<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionRecordDt extends Model
{
    use HasFactory;
    protected $table = 'inspection_record_dts';
    protected $primaryKey = 'inspection_record_dts_id';
    
    protected $guarded = ['inspection_record_dts_id'];

    // ความสัมพันธ์: Detail สังกัดอยู่ 1 Header
    public function header()
    {
        return $this->belongsTo(InspectionRecordHd::class, 'inspection_record_hds_id', 'inspection_record_hds_id');
    }
}
