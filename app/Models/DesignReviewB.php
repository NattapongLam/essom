<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignReviewB extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'design_review_b_id';
    protected $table = 'design_review_b_s';
    protected $guarded = ['design_review_b_id'];
}
