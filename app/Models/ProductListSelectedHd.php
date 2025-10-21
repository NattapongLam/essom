<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductListSelectedHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'product_list_selected_hd_id';
    protected $table = 'product_list_selected_hds';
    protected $guarded = ['product_list_selected_hd_id'];
    public function details()
    {
        return $this->hasMany(ProductListSelectedDt::class, 'product_list_selected_hd_id', 'product_list_selected_hd_id');
    }
}
