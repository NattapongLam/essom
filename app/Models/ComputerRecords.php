<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerRecords extends Model
{
    use HasFactory;

    protected $table = 'computer_records';

    protected $fillable = [
        'id',
        'asset_number',
        'user_name',
        'period',
        'maintenance_status',
        'check_by',
        'date_check',
        'remark'
    ];

    protected $casts = [
        'maintenance_status' => 'array',
        'check_by' => 'array',
        'date_check' => 'array',
    ];
}
