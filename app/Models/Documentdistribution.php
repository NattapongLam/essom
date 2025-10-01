<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentdistribution extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'documentdistributions_id';
    protected $table = 'documentdistributions';
    protected $guarded = ['documentdistributions_id'];
}
