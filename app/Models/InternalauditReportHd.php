<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalauditReportHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'internalaudit_report_hds_id';
    protected $table = 'internalaudit_report_hds';
    protected $guarded = ['internalaudit_report_hds_id'];
}
