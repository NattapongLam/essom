<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignReviewAHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'design_review_a_hd_id';
    protected $table = 'design_review_a_hds';
    protected $guarded = ['design_review_a_hd_id'];
    public function details()
    {
        return $this->hasMany(DesignReviewADt::class, 'design_review_a_hd_id', 'design_review_a_hd_id');
    }
}
