<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionRequestOrderHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'requestorder_hd';
    protected $primaryKey = 'requestorder_hd_id';
    protected $guarded = ['requestorder_hd_id'];
    public function ProductionRequestOrderDt()
    {
        return $this->hasMany(ProductionRequestOrderDt::class, 'requestorder_hd_id', 'requestorder_hd_id');
    }
}
