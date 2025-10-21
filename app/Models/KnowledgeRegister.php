<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeRegister extends Model
{
    protected $table = 'iso_knowledge_registers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'document_code',
        'received_date',
        'doc_title',
    ];

    protected $casts = [
        'document_code' => 'array',
        'received_date' => 'array',
        'doc_title' => 'array',
    ];
}