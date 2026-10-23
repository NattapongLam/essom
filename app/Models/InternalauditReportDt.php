<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalauditReportDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'internalaudit_report_dts_id';
    protected $table = 'internalaudit_report_dts';
    protected $guarded = ['internalaudit_report_dts_id'];
}
