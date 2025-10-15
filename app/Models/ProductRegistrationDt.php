<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRegistrationDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'product_registration_dt_id';
    protected $table = 'product_registration_dts';
    protected $guarded = ['product_registration_dt_id'];
    public function header()
    {
        return $this->belongsTo(ProductRegistrationHd::class, 'product_registration_hd_id', 'product_registration_hd_id');
    }    
}
