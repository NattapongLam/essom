<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeRecord extends Model
{
    use HasFactory;

    protected $table = 'knowledge_records';
      protected $primaryKey = 'id';
      public $timestamps = false;
    protected $fillable = [
        'name',
        'department',
        'position',
        'request_date',
        'documentKM_no',
        'OZN',
        'document_no',
        'subject',
        'details',
        'attached_file',
        'approval',
        'transfer_date',
        'NameCF',
        'approval_date',
    ];
}