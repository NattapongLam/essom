<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalInspectionStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'finalInspection_status';
    protected $guarded = ['finalInspection_status_id'];
}
