<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentList extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ms_department';
    protected $guarded = ['ms_department_id'];
}
