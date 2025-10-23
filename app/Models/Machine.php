<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'iso_machine_history';
    protected $primaryKey = 'id';
    protected $fillable = [
        'machine_name',
        'machine_number',
        'date_start',
        'department',
        'repair_date',
        'repair_description',
        'repair_person',
        'remarks',
    ];
    protected $casts = [
        'repair_date' => 'array',
        'repair_description' => 'array',
        'repair_person' => 'array',
        'date_start' => 'date',
    ];
}