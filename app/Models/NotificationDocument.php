<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationDocument extends Model
{
    use HasFactory;
    protected $table = 'vw_notification_documents';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;
}
