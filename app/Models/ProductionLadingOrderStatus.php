<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLadingOrderStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ladingorder_status';
    protected $guarded = ['ladingorder_status_id'];
}
