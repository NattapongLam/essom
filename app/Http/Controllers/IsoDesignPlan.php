<?php

namespace App\Http\Controllers;

use App\Models\DesignPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IsoDesignPlan extends Controller
{
    public function index()
{
    $plans = DB::table('iso_design_plan')->get()->map(function($plan) {
        // เก็บเฉพาะฟิลด์ที่มีค่า
        $visibleFields = [];
        // ฟิลด์หลัก
        $fields = [
            'design_request_date','product_name','product_model','product_description',
            'reason_cost_price','reason_catalog_picture','reason_drawing','reason_prototype','reason_other',
            'design_input_1','design_input_2','design_input_3','design_input_4','design_input_5','design_input_6','design_input_7','design_input_8',
            'ref_brand1','ref_model1','ref_brand2','ref_model2',
            'requested_by','reviewed_by','approved_by_request',
            'engineer_desing','senior_engineer'
        ];

        foreach($fields as $f) {
    if(in_array($f, ['reason_cost_price','reason_catalog_picture','reason_drawing','reason_prototype'])) {
        if($plan->$f == 1) {
            $visibleFields[$f] = 1;
        }
    } else {
        if(!empty($plan->$f)) {
            $visibleFields[$f] = $plan->$f;
            }
        }
    }
        $plan->visibleFields = $visibleFields;
        return $plan;
    });

    if($plans->isEmpty()){
        $plans = collect([]);
    }

    return view('iso.design-plan-list', compact('plans'));
}

    public function create()
    {
        return view('iso.design-plan-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'design_request_date' => 'nullable|date',
            'product_name' => 'nullable|string|max:255',
            'product_model' => 'nullable|string|max:255',
            'product_description' => 'nullable|string|max:255',
            'reason_other' => 'nullable|string|max:255',
            'requested_by' => 'nullable|string|max:255',
            'reviewed_by' => 'nullable|string|max:255',
            'approved_by_request' => 'nullable|string|max:255',
            'engineer_desing' => 'nullable|string|max:255',
            'senior_engineer' => 'nullable|string|max:255',
            'participants' => 'nullable|string|max:255',
            'planned_by' => 'nullable|string|max:255',
            'planned_marketing' => 'nullable|string|max:255',
            'planned_plant' => 'nullable|string|max:255',
            'approved_by' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'design_request_date','product_name','product_model','product_description',
            'reason_cost_price','reason_catalog_picture','reason_drawing','reason_prototype','reason_other',
            'design_input_1','design_input_2','design_input_3','design_input_4','design_input_5','design_input_6','design_input_7','design_input_8',
            'ref_brand1','ref_model1','ref_brand2','ref_model2',
            'requested_by','requested_date','reviewed_by','reviewed_date',
            'approved_by_request','approved_date_request',
            'engineer_desing','senior_engineer',
            'plan_calc','act_calc','plan_review','act_review','participants','plan_verify','act_verify','plan_proto','act_proto','plan_valid','act_valid','plan_final','act_final',
            'planned_by','planned_date_engineering','planned_marketing','planned_date_marketing','planned_plant','planned_date_plant',
            'approved_by','approved_date'
        ]);

        // Checkbox
        $checkboxFields = ['reason_cost_price','reason_catalog_picture','reason_drawing','reason_prototype'];
        foreach ($checkboxFields as $field) {
            $data[$field] = $request->has($field) ? 1 : 0;
        }

        try {
            DesignPlan::create($data);
            return redirect()->route('design-plan.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $plan = DesignPlan::findOrFail($id);
        return view('iso.design-plan-edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'design_request_date' => 'nullable|date',
            'product_name' => 'nullable|string|max:255',
            'product_model' => 'nullable|string|max:255',
            'product_description' => 'nullable|string|max:255',
            'reason_other' => 'nullable|string|max:255',
            'requested_by' => 'nullable|string|max:255',
            'reviewed_by' => 'nullable|string|max:255',
            'approved_by_request' => 'nullable|string|max:255',
            'engineer_desing' => 'nullable|string|max:255',
            'senior_engineer' => 'nullable|string|max:255',
            'participants' => 'nullable|string|max:255',
            'planned_by' => 'nullable|string|max:255',
            'planned_marketing' => 'nullable|string|max:255',
            'planned_plant' => 'nullable|string|max:255',
            'approved_by' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'design_request_date','product_name','product_model','product_description',
            'reason_cost_price','reason_catalog_picture','reason_drawing','reason_prototype','reason_other',
            'design_input_1','design_input_2','design_input_3','design_input_4','design_input_5','design_input_6','design_input_7','design_input_8',
            'ref_brand1','ref_model1','ref_brand2','ref_model2',
            'requested_by','requested_date','reviewed_by','reviewed_date',
            'approved_by_request','approved_date_request',
            'engineer_desing','senior_engineer',
            'plan_calc','act_calc','plan_review','act_review','participants','plan_verify','act_verify','plan_proto','act_proto','plan_valid','act_valid','plan_final','act_final',
            'planned_by','planned_date_engineering','planned_marketing','planned_date_marketing','planned_plant','planned_date_plant',
            'approved_by','approved_date'
        ]);

        $checkboxFields = ['reason_cost_price','reason_catalog_picture','reason_drawing','reason_prototype'];
        foreach ($checkboxFields as $field) {
            $data[$field] = $request->has($field) ? 1 : 0;
        }

        try {
            $plan = DesignPlan::findOrFail($id);
            $plan->update($data);
            return redirect()->route('design-plan.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $plan = DesignPlan::findOrFail($id);
        return view('iso.design-plan-show', compact('plan'));
    }

    public function destroy($id)
    {
        try {
            $plan = DesignPlan::findOrFail($id);
            $plan->delete();
            return redirect()->route('design-plan.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ไม่สามารถลบได้: ' . $e->getMessage());
        }
    }
}
