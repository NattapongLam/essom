<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareDesignHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'software_design_hd_id';
    protected $table = 'software_design_hds';
    protected $guarded = ['software_design_hd_id'];
    public function details()
    {
        return $this->hasMany(SoftwareDesignDt::class, 'software_design_hd_id', 'software_design_hd_id');
    }
    
}
