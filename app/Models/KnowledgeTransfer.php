<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeTransfer extends Model
{
    use HasFactory;

    protected $table = 'iso_knowledge_transfer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'evaluator_name',
        'department',
        'position',
        'record_date',
        'doc_no',
        'approved_date',
        'organizational_knowledge',
        'subject',
        'sent_date',
        'plan_send_date',
        'plan_complete_date',
        'transfer_method',
        'eval_understanding_good',
        'eval_understanding_partial',
        'eval_understanding_none',
        'eval_result_pass',
        'eval_result_fail',
        'eval_not_yet',
        'eval_not_done',
        're_evaluate_date',
        'supervisor_comments',
        'review_current',
        'review_outdated',
        'review_replace',
        'review_freq_monthly',
        'review_freq_6months',
        'review_freq_yearly',
        'review_freq_none',
        'approved_by',
        'approved_date_final',
        'status_sent',
        'status_pending',
        'status_planning',
        'approved_status'
    ];
}
