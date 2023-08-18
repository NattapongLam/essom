<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionWorkOrderHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'workorder_hd';
    protected $primaryKey = 'workorder_hd_id';
    protected $guarded = ['workorder_hd_id'];
    public function ProductionWorkOrderDt()
    {
        return $this->hasMany(ProductionWorkOrderDt::class, 'workorder_hd_id', 'workorder_hd_id');
    }
    public function ProductionWorkOrderCheck()
    {
        return $this->hasMany(ProductionWorkOrderCheck::class, 'workorder_hd_id', 'workorder_hd_id');
    }
}
