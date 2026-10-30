<?php

namespace App\Http\Controllers;

use App\Models\InternalauditMasterDt;
use App\Models\InternalauditMasterHd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IsoInternalAuditMaster extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = InternalauditMasterHd::where('internalaudit_master_hds_flag',true)->get();
        return view('iso.internalaudit-master-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hd = null;
        return view('iso.internalaudit-master-create', compact('hd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'document_no' => ['required'],
            'document_name' => ['required'],
            'revision' => ['required'],
            'effective_date' => ['required'],
        ]);
        $data = [
            'internalaudit_master_hds_flag' => true,
            'document_no' => $request->document_no,
            'document_name' => $request->document_name,
            'revision' => $request->revision,
            'effective_date' => $request->effective_date,
            'person_at' => auth()->user()->name ?? null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        try {
            DB::beginTransaction();

            // 1. บันทึก Header
            $insertHD = InternalauditMasterHd::create($data);

            // 2. บันทึก Detail
            $items = $request->input('audit', []);
            foreach ($items as $item) {
                InternalauditMasterDt::create([
                        'internalaudit_master_hds_id' => $insertHD->internalaudit_master_hds_id,
                        'checklist' => $item['checklist'] ?? null,
                        'person_at' => auth()->user()->name ?? null,
                        'internalaudit_master_dts_flag' => true,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                ]);  
            }
            DB::commit();
            return redirect()->route('internalaudit-masters.index')->with('success', 'บันทึกข้อมูลสำเร็จ');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // บรรทัดนี้ช่วยให้คุณเห็น Error ชัดเจนตอนกดบันทึก (สามารถเปิดใช้ชั่วคราวเพื่อ Debug)
            dd($e->getMessage()); 

            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'บันทึกข้อมูลไม่สำเร็จ: ' . $e->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hd = InternalauditMasterHd::find($id);
        $dt = InternalauditMasterDt::where('internalaudit_master_dts_flag',true)->where('internalaudit_master_hds_id',$id)->get();
        return view('iso.internalaudit-master-edit', compact('hd','dt'));
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
            $hd = InternalauditMasterHd::findOrFail($id);
            DB::beginTransaction();
            try {
                $hd->update([
                    'document_no'   => $request->document_no,
                    'document_name' => $request->document_name,
                    'revision'      => $request->revision,
                    'effective_date'=> $request->effective_date,
                    'updated_at' => Carbon::now(),
                    'person_at' => auth()->user()->name ?? null,
                ]);
                InternalauditMasterDt::where('internalaudit_master_hds_id', $id)->delete();
                if ($request->has('audit') && is_array($request->audit)) {
                    foreach ($request->audit as $item) {
                        if (!empty($item['checklist']) || !empty($item['finding'])) {
                            InternalauditMasterDt::create([
                                'internalaudit_master_hds_id' => $hd->internalaudit_master_hds_id,
                                'checklist'                   => $item['checklist'] ?? null,
                                'internalaudit_master_dts_flag' => true,
                                'person_at' => auth()->user()->name ?? null,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }
                }

                DB::commit();
                return redirect()->route('internalaudit-masters.index')->with('success', 'อัปเดตข้อมูลรายงานการตรวจสอบภายในสำเร็จ');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', 'เกิดข้อผิดพลาดในการบันทึก: ' . $e->getMessage());
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

    public function cancelInternalauditmaster(Request $request)
    {
        $hd = InternalauditMasterHd::where('internalaudit_master_hds_id',$request->refid)->update([
            'internalaudit_master_hds_flag' => 0,
            'updated_at' => Carbon::now(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'ยกเลิกเอกสารเรียบร้อยแล้ว'
        ]);    
    }
    public function getDetails($id)
    {
        $details = InternalauditMasterDt::where('internalaudit_master_hds_id', $id)
                    ->where('internalaudit_master_dts_flag',true) // ปรับเงื่อนไข flag ตามระบบของคุณถ้ามี
                    ->get();

        return response()->json([
            'status' => true,
            'data' => $details
        ]);
    }
}
