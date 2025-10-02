<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentdestructionDt extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'documentdestruction_dt_id';
    protected $table = 'documentdestruction_dts';
    protected $guarded = ['documentdestruction_dt_id'];
    public function header()
    {
        return $this->belongsTo(DocumentdestructionHd::class, 'documentdestruction_hd_id', 'documentdestruction_hd_id');
    }    
}
