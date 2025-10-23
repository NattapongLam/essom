<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineHistory extends Model
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
}