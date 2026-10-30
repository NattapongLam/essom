<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalauditMasterDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'internalaudit_master_dts_id';
    protected $table = 'internalaudit_master_dts';
    protected $guarded = ['internalaudit_master_dts_id'];
}
