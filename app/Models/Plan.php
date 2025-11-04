<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'iso_plan';
    protected $primaryKey = 'id';

protected $fillable = [
    'project_name',
    'responsible_section',
    'activities',              
    'prepared_by',
    'prepared_date',
    'prepared_progress_review',
    'prepared_progress_date',
    'reviewed_by',
    'reviewed_date',
    'reported_by',
    'reported_date',
    'approved_by',
    'approved_date',
    'acknowledged_by',
    'acknowledged_date',
];

protected $casts = [
    'activities' => 'array',    
    'prepared_date' => 'date',
    'prepared_progress_date' => 'date',
    'reviewed_date' => 'date',
    'reported_date' => 'date',
    'approved_date' => 'date',
    'acknowledged_date' => 'date',
];
}
