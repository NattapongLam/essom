<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionRecordsdmHd extends Model
{
    use HasFactory;

    protected $table = 'inspection_recordsdm_hds';
    protected $primaryKey = 'inspection_recordsdm_hds_id';

    protected $fillable = [
        'doc_number',
        'company_name',
        'checked_by',
        'checked_job',
        'checked_date',
        'approved_by',
        'approved_job',
        'approved_date',
        'overall_status',
        'inspection_recordsdm_hds_flag'
    ];

    // ความสัมพันธ์ One-to-Many ไปยังตาราง Detail
    public function details()
    {
        return $this->hasMany(InspectionRecordsdmDt::class, 'inspection_recordsdm_hds_id', 'inspection_recordsdm_hds_id');
    }
}
