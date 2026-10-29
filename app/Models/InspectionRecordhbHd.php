<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionRecordhbHd extends Model
{
    use HasFactory;
    protected $table = 'inspection_recordhb_hds';
    protected $primaryKey = 'inspection_recordhb_hds_id'; // ระบุ Primary Key ให้ตรงกับตาราง

    protected $fillable = [
        'document_code',
        'company_name',
        'product_name',
        'checked_by',
        'checked_job',
        'checked_date',
        'approved_by',
        'approved_job',
        'approved_date',
        'status',
    ];

    protected $casts = [
        'checked_date' => 'date',
        'approved_date' => 'date',
    ];

    /**
     * ความสัมพันธ์ One-to-Many ไปยังตาราง Details
     */
    public function details()
    {
        return $this->hasMany(InspectionRecordhbDt::class, 'inspection_recordhb_hds_id', 'inspection_recordhb_hds_id');
    }
}
