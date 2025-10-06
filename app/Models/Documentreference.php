<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentreference extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'documentreferences_id';
    protected $table = 'documentreferences';
    protected $guarded = ['documentreferences_id'];
}
