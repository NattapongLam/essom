<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineMaintenanceRecord extends Model
{
    protected $table = 'machine_maintenance_records';

    protected $fillable = [
        'machine',
        'items_status',
        'checked_by',
        'checked_date',
    ];

    protected $casts = [
        'items_status' => 'array',
        'checked_date' => 'date',
    ];
}
