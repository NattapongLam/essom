<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionNoticeHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productionnotice_hd';
    protected $primaryKey = 'productionnotice_hd_id';
    protected $guarded = ['productionnotice_hd_id'];
    public function ProductionNoticeDt()
    {
        return $this->hasMany(ProductionNoticeDt::class, 'productionnotice_hd_id', 'productionnotice_hd_id');
    }
    public function ProductionNoticeOp()
    {
        return $this->hasMany(ProductionNoticeOp::class, 'productionnotice_hd_id', 'productionnotice_hd_id');
    }
}
