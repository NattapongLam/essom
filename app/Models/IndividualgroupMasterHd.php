<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualgroupMasterHd extends Model
{
    use HasFactory;
    protected $table = 'individualgroup_master_hds';
    protected $primaryKey = 'individualgroup_master_hds_id';
    
    protected $guarded = ['individualgroup_master_hds_id'];


    public function details()
    {
        return $this->hasMany(IndividualgroupMasterDt::class, 'individualgroup_master_hds_id', 'individualgroup_master_hds_id');
    }
}
