<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessriskSwot extends Model
{
    use HasFactory;

    protected $table = 'assessrisk_swot';

    protected $fillable = [
        'meeting_date',
        'strategy',
        'strength',
        'weakness',
        'opportunity',
        'threat',
        'review_summary',
        'report_by',
        'report_date',
        'ack_by',
        'ack_date',
    ];

    protected $casts = [
        'strategy'    => 'array',
        'strength'    => 'array',
        'weakness'    => 'array',
        'opportunity' => 'array',
        'threat'      => 'array',
        'review_summary' => 'array', 
        'meeting_date' => 'date',
        'report_date'  => 'date',
        'ack_date'     => 'date',
    ];
}
