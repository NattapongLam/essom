<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLadingOrderHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ladingorder_hd';
    protected $primaryKey = 'ladingorder_hd_id';
    protected $guarded = ['ladingorder_hd_id'];
    public function ProductionLadingOrderDt()
    {
        return $this->hasMany(ProductionLadingOrderDt::class, 'ladingorder_hd_id', 'ladingorder_hd_id');
    }
}
