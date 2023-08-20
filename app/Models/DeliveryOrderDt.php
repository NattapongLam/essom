<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrderDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'deliveryorder_dt';
    protected $primaryKey = 'deliveryorder_dt_id';
    protected $guarded = ['deliveryorder_dt_id'];
}
