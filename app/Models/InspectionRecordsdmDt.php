<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionRecordsdmDt extends Model
{
    use HasFactory;

    protected $table = 'inspection_recordsdm_dts';
    protected $primaryKey = 'inspection_recordsdm_dts_id';

    protected $fillable = [
        'inspection_recordsdm_hds_id',
        'section_no',
        'item_name',
        'pass_fail',
        'remarks',
    ];

    // ความสัมพันธ์ Inverse One-to-Many กลับมาที่ Header
    public function header()
    {
        return $this->belongsTo(InspectionRecordsdmHd::class, 'inspection_recordsdm_hds_id', 'inspection_recordsdm_hds_id');
    }
}
