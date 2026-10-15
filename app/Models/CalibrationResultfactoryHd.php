<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalibrationResultfactoryHd extends Model
{
    use HasFactory;
    protected $table = 'calibration_resultfactory_hds';
    protected $primaryKey = 'calibration_resultfactory_hds_id';
    protected $fillable = [
        'docutype', 'calibration_name', 'calibration_code', 'calibration_brand',
        'calibration_resultfactory_hds_date', 'standard_tools', 'room_temperature',
        'atmospheric_pressur', 'measurement_scales', 'additional_details',
        'standard_unit', 'value_unit', 'equipment_unit', 'error_unit',
        'evaluation_round', 'approved_at', 'approved_date', 'final_approval',
        'calibration_resultfactory_hds_flag','liquid_unit','container_unit'
    ];
}
