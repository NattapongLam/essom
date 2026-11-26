<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductselectionMasterHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'productselection_master_hds_id';
    protected $table = 'productselection_master_hds';
    protected $guarded = ['productselection_master_hds_id'];
    public function details()
    {
        return $this->hasMany(ProductselectionMasterDt::class, 'productselection_master_hds_id', 'productselection_master_hds_id');
    }
    public function subdetails()
    {
        return $this->hasMany(ProductselectionMasterSub::class, 'productselection_master_hds_id', 'productselection_master_hds_id');
    }
}
