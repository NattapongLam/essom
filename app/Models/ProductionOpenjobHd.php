<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionOpenjobHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productionopenjob_hd';
    protected $primaryKey = 'productionopenjob_hd_id';
    protected $guarded = ['productionopenjob_hd_id'];
    public function ProductionOpenjobDt()
    {
        return $this->hasMany(ProductionOpenjobDt::class, 'productionopenjob_hd_id', 'productionopenjob_hd_id');
    }
}
