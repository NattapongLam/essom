<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSelectionHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'product_selection_hd_id';
    protected $table = 'product_selection_hds';
    protected $guarded = ['product_selection_hd_id'];
    public function details()
    {
        return $this->hasMany(ProductSelectionDt::class, 'product_selection_hd_id', 'product_selection_hd_id');
    }
    public function subdetails()
    {
        return $this->hasMany(ProductSelectionSub::class, 'product_selection_hd_id', 'product_selection_hd_id');
    }
}
