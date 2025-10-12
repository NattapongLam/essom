<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailRegistry extends Model
{
    use HasFactory;

    protected $table = 'email_registry';
    protected $primaryKey = 'email_id';
    public $timestamps = false;

    protected $fillable = [
        'email_account',
        'password',
        'user_name',
        'position',
        'department',
        'approved_by',
        'date',
        'remark',
        'item'
    ];

    public function getRouteKeyName()
    {
        return 'email_id';
    }
}