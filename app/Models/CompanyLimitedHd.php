<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLimitedHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'company_limited_hds_id';
    protected $table = 'company_limited_hds';
    protected $guarded = ['company_limited_hds_id'];
}
