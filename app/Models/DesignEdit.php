<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignEdit extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'design_edits_id';
    protected $table = 'design_edits';
    protected $guarded = ['design_edits_id'];
}
