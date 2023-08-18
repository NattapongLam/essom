<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionWorkOrderCheck extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'workorder_check';
    protected $primaryKey = 'workorder_check_id';
    protected $guarded = ['workorder_check_id'];
}
