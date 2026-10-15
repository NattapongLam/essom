<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalibrationResultfactoryDt extends Model
{
    use HasFactory;
    protected $table = 'calibration_resultfactory_dts';
    protected $primaryKey = 'calibration_resultfactory_dts_id';
    protected $fillable = [
        'calibration_resultfactory_hds_id', 'listno', 'standard_value',
        'correct_value', 'calibration_value', 'error_value',
        'measured_percent', 'acceptable_percent', 'remark',
        'person_at', 'calibration_resultfactory_dts_flag','table_type'
    ];
}
