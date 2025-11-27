@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5>ESSOM CO.,LTD<br>ใบคัดเลือกสินค้า/ผู้ขายและประเมิน (Drawing control status)</h5><p class="text-right">F8411.1<br>15 Aug. 19</p>              
            </div>
            <div class="card-body">       
                <form method="POST" class="form-horizontal" action="{{ route('product-selection.store') }}" enctype="multipart/form-data">
                @csrf        
               <div class="row mt-3">
                    <div class="col-6">
                        <h5><strong>ประเภทสินค้า</strong></h5>
                    </div>
                    <div class="col-6">
                        <label for="product_selection_hd_type">ประเภทจัดซื้อ</label>
                        <select class="form-control" name="product_selection_hd_type">
                            <option value="">กรุณาเลือก</option>
                            <option value="โรงงาน">โรงงาน</option>
                            <option value="สำนักงาน">สำนักงาน</option>
                            <option value="ต่างประเทศ">ต่างประเทศ</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="product_type1">1.</label>
                        <input type="text" class="form-control" name="product_type1" required>
                    </div>
                    <div class="col-3">
                        <label for="product_type2">2.</label>
                        <input type="text" class="form-control" name="product_type2">
                    </div>
                    <div class="col-3">
                        <label for="product_type3">3.</label>
                        <input type="text" class="form-control" name="product_type3">
                    </div>
                    <div class="col-3">
                        <label for="product_type4">4.</label>
                        <input type="text" class="form-control" name="product_type4">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="mb-2">
                        <button type="button" class="btn btn-sm btn-success" onclick="addRow()">
                            ➕ เพิ่มแถว
                        </button>
                    </div>
                    <table class="table table-bordered table-sm text-center" id="destroyTable">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 3%">ลำดับ</th>
                                <th rowspan="2" style="width: 20%">รายละเอียดผู้ขายสินค้า</th>
                                <th rowspan="2" style="width: 10%">ยี่ห้อ</th>
                                <th rowspan="2" style="width: 5%">(A)</th>
                                <th rowspan="2" style="width: 10%">(B)</th>
                                <th rowspan="2" style="width: 5%">(C)</th>
                                <th colspan="3" style="width: 12%">ผลการตรวจเยี่ยมสถานที่ผู้ขาย</th>
                                <th rowspan="2" style="width: 10%">หมายเหตุ</th>
                                <th rowspan="2" style="width: 3%">ลบ</th>
                            </tr>
                            <tr>
                                <th style="width: 5%">ระบบ</th>
                                <th style="width: 5%">บุคลากร</th>
                                <th style="width: 5%">เครื่องมือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- เริ่มต้นไม่มีแถว หรือคุณจะใส่แถวเริ่มต้น 1 แถวก็ได้ -->
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>(A) คุณสมบัติสินค้าตรงความต้องการ, (B) มาตรฐานของสินค้าบริการ, (C) สินค้า/บริการเป็นที่ยอมรับ</h6>
                    </div>                    
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="requested_by">จัดทำโดย</label>
                        <input class="form-control" name="requested_by" value="{{auth()->user()->name}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="requested_date">วันที่</label>
                        <input class="form-control" type="date" name="requested_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                    </div>
                </div>   
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="reviewed_by">ทบทวนโดย</label>
                        <select class="form-control receiver-select" name="reviewed_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="reviewed_by" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="reviewed_date">วันที่</label>
                        <input class="form-control" type="date" name="reviewed_date" readonly>
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="approved_by1">อนุมัติโดย</label>
                        <select class="form-control receiver-select" name="approved_by1">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="approved_by1" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="approved_date1">วันที่</label>
                        <input class="form-control" type="date" name="approved_date1" readonly>
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>ใบประเมินสินค้า/ผู้ขาย</h6>
                    </div>                    
                </div>
                <div class="row mt-3">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 25%" class="text-center">รายการประเมิน</th>
                                <th colspan="3" class="text-center">( 1 )</th>
                                <th colspan="3" class="text-center">( 2 )</th>
                                <th colspan="3" class="text-center">( 3 )</th>
                                <th colspan="3" class="text-center">( 4 )</th>
                            </tr>
                            <tr>
                                <th style="width: 6%" class="text-center">ดี</th>
                                <th style="width: 6%" class="text-center">พอใช้</th>
                                <th style="width: 6%" class="text-center">ไม่ดี</th>
                                <th style="width: 6%" class="text-center">ดี</th>
                                <th style="width: 6%" class="text-center">พอใช้</th>
                                <th style="width: 6%" class="text-center">ไม่ดี</th>
                                <th style="width: 6%" class="text-center">ดี</th>
                                <th style="width: 6%" class="text-center">พอใช้</th>
                                <th style="width: 6%" class="text-center">ไม่ดี</th>
                                <th style="width: 6%" class="text-center">ดี</th>
                                <th style="width: 6%" class="text-center">พอใช้</th>
                                <th style="width: 6%" class="text-center">ไม่ดี</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    - คุณภาพการใช้งานของสินค้า
                                    <input type="hidden" value="1" name="product_selection_sub_listno[]">
                                    <input type="hidden" value="คุณภาพการใช้งานของสินค้า" name="product_selection_sub_name[]">
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results1_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results1_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results1_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                 <td>
                                    <select class="form-control"  name="product_selection_hd_results2_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results2_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results2_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    - ความเรียบร้อยของสินค้า
                                    <input type="hidden" value="2" name="product_selection_sub_listno[]">
                                    <input type="hidden" value="ความเรียบร้อยของสินค้า" name="product_selection_sub_name[]">
                                </td>
                               <td>
                                    <select class="form-control"  name="product_selection_hd_results1_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results1_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results1_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                 <td>
                                    <select class="form-control"  name="product_selection_hd_results2_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results2_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results2_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    - บริการของผู้ขาย
                                    <input type="hidden" value="3" name="product_selection_sub_listno[]">
                                    <input type="hidden" value="บริการของผู้ขาย" name="product_selection_sub_name[]">
                                </td>
                               <td>
                                    <select class="form-control"  name="product_selection_hd_results1_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results1_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results1_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                 <td>
                                    <select class="form-control"  name="product_selection_hd_results2_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results2_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results2_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    - การให้บริการหลังการขาย
                                    <input type="hidden" value="4" name="product_selection_sub_listno[]">
                                    <input type="hidden" value="การให้บริการหลังการขาย" name="product_selection_sub_name[]">
                                </td>
                              <td>
                                    <select class="form-control"  name="product_selection_hd_results1_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results1_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results1_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                 <td>
                                    <select class="form-control"  name="product_selection_hd_results2_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results2_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results2_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results3_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control"  name="product_selection_hd_results4_3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="">หมายเหตุ</label>
                        <textarea  class="form-control" name="product_selection_hd_remark"></textarea>
                    </div>                    
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="assessor_by">ผู้ประเมิน</label>
                        <select class="form-control receiver-select" name="assessor_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="assessor_by" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="assessor_date">วันที่</label>
                        <input class="form-control" type="date" name="assessor_date" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="approved_by2">ผู้อนุมัติ</label>
                        <select class="form-control receiver-select" name="approved_by2">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="approved_by2" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="approved_date2">วันที่</label>
                        <input class="form-control" type="date" name="approved_date2" readonly>
                    </div>
                </div>
                <br>
                <div class="col-12 col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก                           
                         </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function () {
    // init select2 ให้กับ select ที่โหลดมาตั้งแต่แรก
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});
// ✅ ฟังก์ชันเพิ่มแถว
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
            ${rowCount}
            <input type="hidden" name="product_selection_dt_listno[]" value="${rowCount}">            
        </td>
        <td>
            <input type="text"  class="form-control" placeholder="ชื่อ" name="product_selection_dt_vendor[]">
            <input type="text"  class="form-control" placeholder="ผู้ติดต่อ" name="product_selection_dt_vendor_name[]">
            <input type="text"  class="form-control" placeholder="โทร" name="product_selection_dt_vendor_tel[]">
            <input type="text"  class="form-control" placeholder="E-mail" name="product_selection_dt_vendor_email[]">
            <input type="text"  class="form-control" name="product_selection_dt_vendor_remark[]">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="ยี่ห้อ	" name="product_selection_dt_brand[]">
        </td>
        <td>
            <select class="form-control"  name="product_selection_hd_grade_a[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
        </td>
        <td>
            <input type="text" class="form-control" name="product_selection_hd_grade_b[]">
        </td>
        <td>
            <select class="form-control"  name="product_selection_hd_grade_c[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control"  name="product_selection_hd_results1[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control"  name="product_selection_hd_results2[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
        </td>
        <td>
            <select class="form-control"  name="product_selection_hd_results3[]">
                <option value="0"></option>
                <option value="1">/</option>
            </select>
        </td>
          <td>
            <input type="text" class="form-control" placeholder="หมายเหตุ" name="product_selection_dt_remark[]">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">ลบ</button>
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers(); // รีเลขลำดับ
}

// ✅ ฟังก์ชันลบแถว
function removeRow(button) {
    const row = button.closest("tr");
    row.remove();
    updateRowNumbers(); // รีเลขลำดับใหม่หลังลบ
}

function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        row.querySelector(".row-number").textContent = number;
        row.querySelector('input[name="product_registration_dt_listno[]"]').value = number;
    });
}
</script>
@endpush  
    