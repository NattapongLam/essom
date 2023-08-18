<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionNoticeOp extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productionnotice_op';
    protected $primaryKey = 'productionnotice_op_id';
    protected $guarded = ['productionnotice_op_id'];
}
