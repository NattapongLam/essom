<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerserviceComplaintDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'customerservice_complaint_dts_id';
    protected $table = 'customerservice_complaint_dts';
    protected $guarded = ['customerservice_complaint_dts_id'];
}
