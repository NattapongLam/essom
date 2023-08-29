<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionComment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productionopenjob_comment';
    protected $guarded = ['id'];
}
