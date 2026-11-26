<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductselectionMasterDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'productselection_master_dts_id';
    protected $table = 'productselection_master_dts';
    protected $guarded = ['productselection_master_dts_id'];
    public function header()
    {
        return $this->belongsTo(ProductselectionMasterHd::class, 'productselection_master_hds_id', 'productselection_master_hds_id');
    }    
}
