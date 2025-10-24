<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailRegistry extends Model
{
    use HasFactory;

    protected $table = 'iso_email_registration';
    protected $primaryKey = 'id';
    protected $fillable = [
        'item',
        'email_account',
        'password',
        'user_name',
        'position',
        'department',
        'approved_by',
        'date',
        'remark'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
