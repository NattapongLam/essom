<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignReviewADt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'design_review_a_dt_id';
    protected $table = 'design_review_a_dts';
    protected $guarded = ['design_review_a_dt_id'];
    public function header()
    {
        return $this->belongsTo(DesignReviewAHd::class, 'design_review_a_hd_id', 'design_review_a_hd_id');
    }    
}
