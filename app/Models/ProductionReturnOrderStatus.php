<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionReturnOrderStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'returnorder_status';
    protected $guarded = ['returnorder_status_id'];
}
