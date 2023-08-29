<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsoNcr extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'iso_ncr';
    protected $guarded = ['iso_ncr_id'];
}
