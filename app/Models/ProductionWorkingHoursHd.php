<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionWorkingHoursHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'workinghours_hd';
    protected $primaryKey = 'workinghours_hd_id';
    protected $guarded = ['workinghours_hd_id'];
    public function ProductionWorkingHoursDt()
    {
        return $this->hasMany(ProductionWorkingHoursDt::class, 'workinghours_hd_id', 'workinghours_hd_id');
    }
}
