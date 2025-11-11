<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignPlan extends Model
{
    use HasFactory;

    protected $table = 'iso_design_plan'; 
    protected $primaryKey = 'id';
    protected $fillable = [      
        'design_request_date',
        'product_name',
        'product_model',
        'product_description',
        'reason_cost_price',
        'reason_catalog_picture',
        'reason_drawing',
        'reason_prototype',
        'reason_other',
        'design_input_1','design_input_2','design_input_3','design_input_4',
        'design_input_5','design_input_6','design_input_7','design_input_8',
        'ref_brand1','ref_model1','ref_brand2','ref_model2',
        'requested_by','requested_date',
        'reviewed_by','reviewed_date',
        'approved_by_request','approved_date_request', 

      
        'engineer_desing', 'senior_engineer',
        'plan_calc','act_calc','plan_review','act_review','participants',
        'plan_verify','act_verify','plan_proto','act_proto',
        'plan_valid','act_valid','plan_final','act_final',

       
        'planned_by','planned_date_engineering',
        'planned_marketing','planned_date_marketing',
        'planned_plant','planned_date_plant',
        'approved_by','approved_date',
    ];
}
