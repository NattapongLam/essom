<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHoursType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'workinghours_type';
    protected $guarded = ['workinghours_type_id'];
}
