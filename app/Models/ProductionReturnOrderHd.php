<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionReturnOrderHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'returnorder_hd';
    protected $primaryKey = 'returnorder_hd_id';
    protected $guarded = ['returnorder_hd_id'];
    public function ProductionReturnOrderDt()
    {
        return $this->hasMany(ProductionReturnOrderDt::class, 'returnorder_hd_id', 'returnorder_hd_id');
    }
}
