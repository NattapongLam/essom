<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $table = 'iso_objectives';
   protected $primaryKey = 'id';
    protected $fillable = [
        'no', 'description', 'resp_person', 'previous', 'plan',
        'results', 'remarks', 'section', 'period'
    ];
}
