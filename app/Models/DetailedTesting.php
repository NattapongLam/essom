<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailedTesting extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'detailed_testings_id';
    protected $table = 'detailed_testings';
    protected $guarded = ['detailed_testings_id'];
}
