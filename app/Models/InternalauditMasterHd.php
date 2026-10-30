<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalauditMasterHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'internalaudit_master_hds_id';
    protected $table = 'internalaudit_master_hds';
    protected $guarded = ['internalaudit_master_hds_id'];
}
