<?php

namespace App\Http\Controllers;

use App\Models\ItLoanReturn;
use Illuminate\Http\Request;

class IsoItLoanReturn extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hd = ItLoanReturn::orderBy('it_loan_returns_id', 'DESC')->get();
        return view('iso.it-loanreturn-list', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
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
        //
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
        //
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
    /**
     * ฟังก์ชันสำหรับ Auto Save / Update ผ่าน AJAX จากหน้า List
     */
    public function autoSave(Request $request)
    {
        try {
            $id = $request->input('it_loan_returns_id'); // ถ้ามี ID แปลว่าอัปเดต ถ้าไม่มีคือสร้างใหม่

            $data = [
                'quantity'       => $request->input('quantity', 1),
                'equipment_name' => $request->input('equipment_name'),
                'borrower'       => $request->input('borrower'),
                'details'        => $request->input('details'),
                'borrow_date'    => $request->input('borrow_date'),
                'borrow_by'      => $request->input('borrow_by'),
                'return_date'    => $request->input('return_date'),
                'return_by'      => $request->input('return_by'),
                'remark'         => $request->input('remark'),
            ];

            // เช็คว่ามีชื่ออุปกรณ์ไหม ถ้าไม่มีและบังคับพิมพ์ ก็ให้ข้าม
            if (empty($data['equipment_name'])) {
                return response()->json(['status' => 'empty', 'message' => 'ชื่ออุปกรณ์ว่างเปล่า ไม่บันทึก']);
            }

            if ($id) {
                // อัปเดตข้อมูลเดิม
                $item = ItLoanReturn::findOrFail($id);
                $item->update($data);
                $message = 'อัปเดตข้อมูลสำเร็จ';
            } else {
                // สร้างข้อมูลใหม่
                $item = ItLoanReturn::create($data);
                $message = 'บันทึกข้อมูลใหม่สำเร็จ';
            }

            return response()->json([
                'status' => 'success',
                'message' => $message,
                'id' => $item->it_loan_returns_id // ส่ง ID กลับไปผูกกับแถวในตาราง
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * ฟังก์ชันสำหรับ Auto Delete ผ่าน AJAX
     */
    public function autoDelete($id)
    {
        try {
            $item = ItLoanReturn::find($id);
            if ($item) {
                $item->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'ลบข้อมูลสำเร็จ'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'เกิดข้อผิดพลาดในการลบ'
            ], 500);
        }
    }
}
