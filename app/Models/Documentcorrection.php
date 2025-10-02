<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentcorrection extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'documentcorrections_id';
    protected $table = 'documentcorrections';
    protected $guarded = ['documentcorrections_id'];
}
