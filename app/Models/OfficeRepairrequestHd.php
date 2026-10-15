<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeRepairrequestHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'office_repairrequest_hds';
    protected $primaryKey = 'office_repairrequest_hds_id';
    protected $guarded = ['office_repairrequest_hds_id'];
    protected $casts = [
        'tracking_status' => 'array',
    ];
}
