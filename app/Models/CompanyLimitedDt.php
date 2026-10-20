<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLimitedDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'company_limited_dts_id';
    protected $table = 'company_limited_dts';
    protected $guarded = ['company_limited_dts_id'];
}
