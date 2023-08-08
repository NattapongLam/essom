<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeList extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ms_employee';
    protected $guarded = ['ms_employee_id'];
}
