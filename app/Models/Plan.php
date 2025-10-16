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
    ];

    protected $casts = [
        'activities' => 'array',
    ];
}