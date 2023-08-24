<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalInspectionHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'finalInspection_hd';
    protected $primaryKey = 'finalInspection_hd_id';
    protected $guarded = ['finalInspection_hd_id'];
    public function FinalInspectionDt1()
    {
        return $this->hasMany(FinalInspectionDt1::class, 'finalInspection_hd_id', 'finalInspection_hd_id');
    }
    public function FinalInspectionDt2()
    {
        return $this->hasMany(FinalInspectionDt2::class, 'finalInspection_hd_id', 'finalInspection_hd_id');
    }
}
