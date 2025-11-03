<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRecord extends Model
{
    use HasFactory;

    protected $table = 'maintenance_records';

    protected $fillable = [
        'machine_name',
        'status',
        'inspector',
        'inspection_date',
    ];

    protected $casts = [
        'status' => 'array',
        'inspection_date' => 'date',
    ];
}
