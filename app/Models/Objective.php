<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $table = 'iso_objectives';

    protected $fillable = [
        'section',
        'period',
        'activity_list',
        'prepared_by',
        'prepared_date',
        'reported_by',
        'reported_date',
        'reviewed_by',
        'reviewed_date',
        'acknowledged_by',
        'acknowledged_date',
        'approved_by',
        'approved_date',
    ];

    protected $casts = [
        'activity_list' => 'array',
        'prepared_date' => 'date',
        'reported_date' => 'date',
        'reviewed_date' => 'date',
        'acknowledged_date' => 'date',
        'approved_date' => 'date',
    ];
}
