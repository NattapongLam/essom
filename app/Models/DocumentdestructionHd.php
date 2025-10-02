<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentdestructionHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'documentdestruction_hd_id';
    protected $table = 'documentdestruction_hds';
    protected $guarded = ['documentdestruction_hd_id'];
    public function details()
    {
        return $this->hasMany(DocumentdestructionDt::class, 'documentdestruction_hd_id', 'documentdestruction_hd_id');
    }
}
