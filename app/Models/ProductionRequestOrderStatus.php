<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionRequestOrderStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'requestorder_status';
    protected $guarded = ['requestorder_status_id'];
}
