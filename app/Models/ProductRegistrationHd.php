<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRegistrationHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'product_registration_hd_id';
    protected $table = 'product_registration_hds';
    protected $guarded = ['product_registration_hd_id'];
    public function details()
    {
        return $this->hasMany(ProductRegistrationDt::class, 'product_registration_hd_id', 'product_registration_hd_id');
    }
}
