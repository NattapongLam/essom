<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\RecipientSelectionHd;
use Illuminate\Support\Facades\Auth;
use App\Models\RecipientSelectionSub;

class IsoRecipientSelection extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = RecipientSelectionHd::where('recipient_selection_hd_flag',true)->get();
        return view('iso.form-recipient-selection-list',compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();    
        return view('iso.form-recipient-selection-create',compact('hd','emp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'recipient_selection_hd_name' => $request->recipient_selection_hd_name,
            'recipient_selection_hd_address' => $request->recipient_selection_hd_address,
            'recipient_selection_hd_contact' => $request->recipient_selection_hd_contact,
            'recipient_selection_hd_tel' => $request->recipient_selection_hd_tel,
            'recipient_selection_hd_email' => $request->recipient_selection_hd_email,
            'location_house' => $request->location_house,
            'location_rowhouse' => $request->location_rowhouse,
            'location_factory' => $request->location_factory,
            'location_other' => $request->location_other,
            'tool_lathe' => $request->tool_lathe,
            'tool_milling' => $request->tool_milling,
            'tool_electricwelding' => $request->tool_electricwelding,
            'tool_co2welding' => $request->tool_co2welding,
            'tool_argonwelding' => $request->tool_argonwelding,
            'tool_gas' => $request->tool_gas,
            'tool_metalwinding' => $request->tool_metalwinding,
            'tool_metalcutting' => $request->tool_metalcutting,
            'tool_metalfolding' => $request->tool_metalfolding,
            'tool_pipecutting' => $request->tool_pipecutting,
            'tool_metalpolisher' => $request->tool_metalpolisher,
            'tool_metaldrilling' => $request->tool_metaldrilling,
            'tool_measuring' => $request->tool_measuring,
            'tool_laser' => $request->tool_laser,
            'tool_other' => $request->tool_other,
            'person_engineer' => $request->person_engineer,
            'person_manager' => $request->person_manager,
            'person_tradesman1' => $request->person_tradesman1,
            'person_tradesman2' => $request->person_tradesman2,
            'person_tradesman3' => $request->person_tradesman3,
            'person_tradesman4' => $request->person_tradesman4,
            'person_tradesman5' => $request->person_tradesman5,
            'job_lathe' => $request->job_lathe,
            'job_milling' => $request->job_milling,
            'job_drill' => $request->job_drill,
            'job_roll' => $request->job_roll,
            'job_cut' => $request->job_cut,
            'job_fold' => $request->job_fold,
            'job_link' => $request->job_link,
            'job_handsome' => $request->job_handsome,
            'job_assemble' => $request->job_assemble,
            'job_repair' => $request->job_repair,
            'job_paint' => $request->job_paint,
            'job_lasercutting' => $request->job_lasercutting,
            'job_other' => $request->job_other,
            'requested_by' => $request->requested_by,
            'requested_date' => $request->requested_date,
            'recipient_selection_hd_flag' => true,
            'created_at' =>  Carbon::now(),
            'reviewed_by' => $request->reviewed_by,
            'approved_by1' => $request->approved_by1,
            'assessor_by' => $request->assessor_by,
            'approved_by2' => $request->approved_by2,
            'reviewed_status' => "N",
            'approved_status1' => "N",
            'assessor_status' => "N",
            'approved_status2' => "N",
            'purchase_by' => $request->purchase_by,
        ];
        if ($request->hasFile('recipient_selection_hd_file')) {
            $data['recipient_selection_hd_file'] = $request->file('recipient_selection_hd_file')->storeAs('img/recipientselection', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('recipient_selection_hd_file')->extension());
        }
        try{

            DB::beginTransaction();
            $insertHD = RecipientSelectionHd::create($data);
            foreach ($request->recipient_selection_sub_listno as $key => $value) {
                RecipientSelectionSub::insert([
                    'recipient_selection_hd_id' => $insertHD->recipient_selection_hd_id,
                    'recipient_selection_sub_listno' => $request->recipient_selection_sub_listno[$key],
                    'recipient_selection_sub_name' => $request->recipient_selection_sub_name[$key],
                    'recipient_selection_sub_results1' => $request->recipient_selection_sub_results1[$key],
                    'recipient_selection_sub_results2' => $request->recipient_selection_sub_results2[$key],
                    'recipient_selection_sub_results3' => $request->recipient_selection_sub_results3[$key],
                    'person_at' => Auth::user()->name,
                    'created_at' => Carbon::now(),
                ]);
            }
            DB::commit();
            return redirect()->route('recipient-selection.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('recipient-selection.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hd = RecipientSelectionHd::find($id);
        $sub = RecipientSelectionSub::where('recipient_selection_hd_id',$id)->get();
        return view('iso.form-recipient-selection-update',compact('hd','sub'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = RecipientSelectionHd::find($id);
        $sub = RecipientSelectionSub::where('recipient_selection_hd_id',$id)->get();
        $emp = DB::table('ms_employee')->where('ms_employee_flag',true)->get();    
        return view('iso.form-recipient-selection-edit',compact('hd','sub','emp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->checkdoc == ""){
            $data = [
                'recipient_selection_hd_name' => $request->recipient_selection_hd_name,
                'recipient_selection_hd_address' => $request->recipient_selection_hd_address,
                'recipient_selection_hd_contact' => $request->recipient_selection_hd_contact,
                'recipient_selection_hd_tel' => $request->recipient_selection_hd_tel,
                'recipient_selection_hd_email' => $request->recipient_selection_hd_email,
                'location_house' => $request->location_house,
                'location_rowhouse' => $request->location_rowhouse,
                'location_factory' => $request->location_factory,
                'location_other' => $request->location_other,
                'tool_lathe' => $request->tool_lathe,
                'tool_milling' => $request->tool_milling,
                'tool_electricwelding' => $request->tool_electricwelding,
                'tool_co2welding' => $request->tool_co2welding,
                'tool_argonwelding' => $request->tool_argonwelding,
                'tool_gas' => $request->tool_gas,
                'tool_metalwinding' => $request->tool_metalwinding,
                'tool_metalcutting' => $request->tool_metalcutting,
                'tool_metalfolding' => $request->tool_metalfolding,
                'tool_pipecutting' => $request->tool_pipecutting,
                'tool_metalpolisher' => $request->tool_metalpolisher,
                'tool_metaldrilling' => $request->tool_metaldrilling,
                'tool_measuring' => $request->tool_measuring,
                'tool_laser' => $request->tool_laser,
                'tool_other' => $request->tool_other,
                'person_engineer' => $request->person_engineer,
                'person_manager' => $request->person_manager,
                'person_tradesman1' => $request->person_tradesman1,
                'person_tradesman2' => $request->person_tradesman2,
                'person_tradesman3' => $request->person_tradesman3,
                'person_tradesman4' => $request->person_tradesman4,
                'person_tradesman5' => $request->person_tradesman5,
                'job_lathe' => $request->job_lathe,
                'job_milling' => $request->job_milling,
                'job_drill' => $request->job_drill,
                'job_roll' => $request->job_roll,
                'job_cut' => $request->job_cut,
                'job_fold' => $request->job_fold,
                'job_link' => $request->job_link,
                'job_handsome' => $request->job_handsome,
                'job_assemble' => $request->job_assemble,
                'job_repair' => $request->job_repair,
                'job_paint' => $request->job_paint,
                'job_lasercutting' => $request->job_lasercutting,
                'job_other' => $request->job_other,
                'requested_by' => $request->requested_by,
                'requested_date' => $request->requested_date,
                'recipient_selection_hd_flag' => true,
                'updated_at' =>  Carbon::now(),
                'assessor_by' => $request->assessor_by,
                'assessor_date' => $request->assessor_date,
                'purchase_by' => $request->purchase_by,
                'purchase_date' => $request->purchase_date
            ];
            if ($request->hasFile('recipient_selection_hd_file')) {
                $data['recipient_selection_hd_file'] = $request->file('recipient_selection_hd_file')->storeAs('img/recipientselection', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('recipient_selection_hd_file')->extension());
            }
            try{

                DB::beginTransaction();
                $insertHD = RecipientSelectionHd::where('recipient_selection_hd_id',$id)->update($data);
                foreach ($request->recipient_selection_sub_id as $key => $value) {
                    RecipientSelectionSub::where('recipient_selection_sub_id',$value)->update([
                        'recipient_selection_sub_results1' => $request->recipient_selection_sub_results1[$key],
                        'recipient_selection_sub_results2' => $request->recipient_selection_sub_results2[$key],
                        'recipient_selection_sub_results3' => $request->recipient_selection_sub_results3[$key],
                        'person_at' => Auth::user()->name,
                        'updated_at' => Carbon::now(),
                    ]);
                }
                DB::commit();
                return redirect()->route('recipient-selection.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('recipient-selection.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }elseif($request->checkdoc == "Update"){
            $data = [
                'reviewed_by' => $request->reviewed_by,
                'reviewed_date' => $request->reviewed_date,
                'approved_by1' => $request->approved_by1,
                'approved_date1' => $request->approved_date1,
                'approved_by2' => $request->approved_by2,
                'approved_date2' => $request->approved_date2
            ];
            try{

                DB::beginTransaction();
                $insertHD = RecipientSelectionHd::where('recipient_selection_hd_id',$id)->update($data);
                DB::commit();
                return redirect()->route('recipient-selection.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch(\Exception $e){
                Log::error($e->getMessage());
                dd($e->getMessage());
                return redirect()->route('recipient-selection.index')->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancelRecipientSelection(Request $request)
    {
        $hd = RecipientSelectionHd::where('recipient_selection_hd_id',$request->refid)->update([
            'recipient_selection_hd_flag' => 0,
            'updated_at' => Carbon::now(),
            'requested_by' => Auth::user()->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
    public function ApprovedRecipientSelection(Request $request)
    {
        if($request->status == "reviewed"){
            $hd = RecipientSelectionHd::where('product_selection_hd_id',$request->refid)
            ->update([
            'reviewed_status' => "Y",
            'reviewed_date' => Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'อนุมัติเอกสารเรียบร้อยแล้ว'
            ]);    
        }else if($request->status == "approved1"){
            $hd = RecipientSelectionHd::where('product_selection_hd_id',$request->refid)
            ->update([
            'approved_status1' => "Y",
            'approved_date1' =>Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'อนุมัติเอกสารเรียบร้อยแล้ว'
            ]);    

        }else if($request->status == "approved2"){
            $hd = RecipientSelectionHd::where('product_selection_hd_id',$request->refid)
            ->update([
            'approved_status2' => "Y",
            'approved_date2' => Carbon::now(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'อนุมัติเอกสารเรียบร้อยแล้ว'
            ]);    
        }
    }
}
