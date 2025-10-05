<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentexternalDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'documentexternal_dt_id';
    protected $table = 'documentexternal_dts';
    protected $guarded = ['documentexternal_dt_id'];
    public function header()
    {
        return $this->belongsTo(DocumentexternalHd::class, 'documentexternal_hd_id', 'documentexternal_hd_id');
    }    
}
