<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductselectionMasterSub extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'productselection_master_subs_id';
    protected $table = 'productselection_master_subs';
    protected $guarded = ['productselection_master_subs_id'];
    public function header()
    {
        return $this->belongsTo(ProductselectionMasterHd::class, 'productselection_master_hds_id', 'productselection_master_hds_id');
    }    
}
