<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrderStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'deliveryorder_status';
    protected $guarded = ['deliveryorder_status_id'];
}
