<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionWorkOrderStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'workorder_status';
    protected $guarded = ['workorder_status_id'];
}
