<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductListSelectedDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'product_list_selected_dt_id';
    protected $table = 'product_list_selected_dts';
    protected $guarded = ['product_list_selected_dt_id'];
    public function header()
    {
        return $this->belongsTo(ProductListSelectedHd::class, 'product_list_selected_hd_id', 'product_list_selected_hd_id');
    }    
}
