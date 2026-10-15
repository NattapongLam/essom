<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeRepairrequestDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'office_repairrequest_dts';
    protected $primaryKey = 'office_repairrequest_dts_id';
    protected $guarded = ['office_repairrequest_dts_id'];
}
