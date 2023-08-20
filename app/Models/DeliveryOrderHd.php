<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrderHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'deliveryorder_hd';
    protected $primaryKey = 'deliveryorder_hd_id';
    protected $guarded = ['deliveryorder_hd_id'];
    public function DeliveryOrderDt()
    {
        return $this->hasMany(DeliveryOrderDt::class, 'deliveryorder_hd_id', 'deliveryorder_hd_id');
    }
}
