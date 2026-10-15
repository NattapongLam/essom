<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItserviceRequest extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'itservice_requests';
    protected $primaryKey = 'itservice_requests_id';
    protected $guarded = ['itservice_requests_id'];
    protected $casts = [
        'objective_status' => 'array',
    ];
}
