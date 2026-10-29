<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionRecordhbDt extends Model
{
    use HasFactory;
    protected $table = 'inspection_recordhb_dts';
    protected $primaryKey = 'inspection_recordhb_dts_id'; // ระบุ Primary Key ให้ตรงกับตาราง

    protected $fillable = [
        'inspection_recordhb_hds_id',
        'section_number',
        'section_title',
        'measurements', // เก็บเป็น JSON
        'pass_fail',
        'remarks',
    ];

    protected $casts = [
        'measurements' => 'array', // แปลง JSON ในฐานข้อมูลให้อัตโนมัติเป็น PHP Array เวลาเรียกใช้งาน
    ];

    /**
     * ความสัมพันธ์กลับไปยังตารางหลัก Header
     */
    public function header()
    {
        return $this->belongsTo(InspectionRecordhbHd::class, 'inspection_recordhb_hds_id', 'inspection_recordhb_hds_id');
    }
}
