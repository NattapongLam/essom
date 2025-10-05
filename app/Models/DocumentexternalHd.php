<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentexternalHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'documentexternal_hd_id';
    protected $table = 'documentexternal_hds';
    protected $guarded = ['documentexternal_hd_id'];
    public function details()
    {
        return $this->hasMany(DocumentexternalDt::class, 'documentexternal_hd_id', 'documentexternal_hd_id');
    }
}
