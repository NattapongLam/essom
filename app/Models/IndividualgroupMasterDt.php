<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualgroupMasterDt extends Model
{
    use HasFactory;
    protected $table = 'individualgroup_master_dts';
    protected $primaryKey = 'individualgroup_master_dts_id';
    
    protected $guarded = ['individualgroup_master_dts_id'];

    public function header()
    {
        return $this->belongsTo(IndividualgroupMasterHd::class, 'individualgroup_master_hds_id', 'individualgroup_master_hds_id');
    }
}
