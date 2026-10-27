<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionRecordHd extends Model
{
    use HasFactory;
    protected $table = 'inspection_record_hds';
    protected $primaryKey = 'inspection_record_hds_id';
    
    protected $guarded = ['inspection_record_hds_id'];

    // ความสัมพันธ์: 1 Header มีหลาย Detail
    public function details()
    {
        return $this->hasMany(InspectionRecordDt::class, 'inspection_record_hds_id', 'inspection_record_hds_id');
    }
}
