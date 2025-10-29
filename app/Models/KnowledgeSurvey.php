<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'surveyor_name',
        'department',
        'position',
        'survey_date',
        'survey_number',
        'q1_department_field',
        'q1_status',
        'q1_doc_no',
        'q1_storage_location',
        'q1_transfer_date',
        'q1_comment',
        'q1_progress_date',
        'q2_department_field',
        'q2_status',
        'q2_doc_no',
        'q2_storage_location',
        'q2_transfer_method',
        'q2_transfer_date',
        'q2_comment',
        'q2_comment_date',
        'q2_progress_detail',
        'q2_progress_date',
        'q3_need',
        'q3_topic',
        'q3_reason',
        'approved_by',
        'approved_date',
    ];
}
