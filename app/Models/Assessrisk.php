<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessrisk extends Model
{
    use HasFactory;

    protected $fillable = [
        'process_ref','proposed_by','proposed_date',
        'risk_issue','risk_cause','risk_impact','risk_accept_reason',
        'pre_i_1','pre_l_1','pre_level_1','pre_result_1','pre_by_1','pre_date_1',
        'pre_i_2','pre_l_2','pre_level_2','pre_result_2','pre_by_2','pre_date_2',
        'pre_i_3','pre_l_3','pre_level_3','pre_result_3','pre_by_3','pre_date_3',
        'mitigation_1','mitigation_2','mitigation_3',
        'summary_1','summary_2','summary_3',
        'followup_1','followup_2','followup_3',
        'approved_by_1','approved_date_1','approved_by_2','approved_date_2','approved_by_3','approved_date_3',
        'post_i_1','post_l_1','post_level_1','post_result_1','post_by_1','post_date_1',
        'post_i_2','post_l_2','post_level_2','post_result_2','post_by_2','post_date_2',
        'post_i_3','post_l_3','post_level_3','post_result_3','post_by_3','post_date_3',
        'ack_name_1','ack_date_1','ack_name_2','ack_date_2','ack_name_3','ack_date_3',
        'ack_final_name_1','ack_final_date_1','ack_final_name_2','ack_final_date_2','ack_final_name_3','ack_final_date_3','flag'
    ];
}
