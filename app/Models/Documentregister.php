<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentregister extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'documentregisters_id';
    protected $table = 'documentregisters';
    protected $guarded = ['documentregisters_id'];
}
