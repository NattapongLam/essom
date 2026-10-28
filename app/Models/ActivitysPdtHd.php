<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitysPdtHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'activitys_pdt_hds_id';
    protected $table = 'activitys_pdt_hds';
    protected $guarded = ['activitys_pdt_hds_id'];

    public function details()
    {
        return $this->hasMany(ActivitysPdtDt::class, 'activitys_pdt_hds_id', 'activitys_pdt_hds_id');
    }
}
