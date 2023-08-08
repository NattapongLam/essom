<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionNoticeStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productionnotice_status';
    protected $guarded = ['productionnotice_status_id'];
}
