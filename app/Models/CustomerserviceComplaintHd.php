<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerserviceComplaintHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'customerservice_complaint_hds_id';
    protected $table = 'customerservice_complaint_hds';
    protected $guarded = ['customerservice_complaint_hds_id'];
}
