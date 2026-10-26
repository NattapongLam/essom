<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementReviewDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'management_review_dts';
    protected $primaryKey = 'management_review_dts_id';
    protected $guarded = ['management_review_dts_id'];
}
