<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSelectionSub extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'product_selection_sub_id';
    protected $table = 'product_selection_subs';
    protected $guarded = ['product_selection_sub_id'];
    public function header()
    {
        return $this->belongsTo(ProductSelectionHd::class, 'product_selection_hd_id', 'product_selection_hd_id');
    }    
}
