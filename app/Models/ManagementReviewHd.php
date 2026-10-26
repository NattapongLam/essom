<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementReviewHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'management_review_hds';
    protected $primaryKey = 'management_review_hds_id';
    protected $guarded = ['management_review_hds_id'];
}
