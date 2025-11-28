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
                <h5>ESSOM CO.,LTD<br>ใบคัดเลือกผู้รับจ้างช่วงและประเมิน (SUBCONTRACTOR QUALIFICATION AND EVALUATION)</h5><p class="text-right">F8411.2<br>15 Aug. 19</p>              
            </div>
            <div class="card-body">     
                <form method="POST" class="form-horizontal" action="{{ route('recipient-selection.store') }}" enctype="multipart/form-data">
                @csrf            
                <div class="row mt-3">  
                    <div class="col-3">
                        <label for="recipient_selection_hd_type">ประเภทจัดซื้อ</label>
                        <select class="form-control" name="recipient_selection_hd_type">
                            <option value="">กรุณาเลือก</option>
                            <option value="โรงงาน">โรงงาน</option>
                            <option value="สำนักงาน">สำนักงาน</option>
                            <option value="ต่างประเทศ">ต่างประเทศ</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="recipient_selection_hd_name">ชื่อผู้รับจ้างช่าง</label>
                        <input class="form-control" name="recipient_selection_hd_name">
                    </div> 
                    <div class="col-6">
                        <label for="recipient_selection_hd_address">ที่อยู่</label>
                        <input class="form-control" name="recipient_selection_hd_address">
                    </div>   
                </div>  
                <div class="row mt-3">  
                    <div class="col-4">
                        <label for="recipient_selection_hd_contact">ชื่อผู้ติดต่อ</label>
                        <input class="form-control" name="recipient_selection_hd_contact">
                    </div> 
                    <div class="col-4">
                        <label for="recipient_selection_hd_tel">เบอร์โทร</label>
                        <input class="form-control" name="recipient_selection_hd_tel">
                    </div> 
                    <div class="col-4">
                        <label for="recipient_selection_hd_email">E-mail</label>
                        <input class="form-control" name="recipient_selection_hd_email">
                    </div>   
                </div>
                <div class="row mt-3">  
                    <table class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th>ลักษณะสถานที่</th>
                                <th>เครื่องมือ/อุปกรณ์</th>
                                <th>บุคคลากร</th>
                                <th>ลักษณะงานที่เหมาะสม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        บ้าน 
                                        <input class="form-control" style="width: 100px;" name="location_house">
                                        ตรม
                                    </div>
                                </td>            
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องกลึง 
                                        <input class="form-control" style="width: 100px;" name="tool_lathe">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        วิศวกร 
                                        <input class="form-control" style="width: 100px;" name="person_engineer">
                                    </div>
                                </td>   
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_lathe">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> กลึง
                                    </div>
                                </td>                 
                            </tr>   
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ห้องแถว 
                                        <input class="form-control" style="width: 100px;" name="location_rowhouse">
                                        คูหา
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องมิลลิ่ง 
                                        <input class="form-control" style="width: 100px;" name="tool_milling">
                                        เครื่อง
                                    </div>
                                </td>    
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        หน. งาน 
                                        <input class="form-control" style="width: 100px;" name="person_manager">
                                    </div>
                                </td>     
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_milling">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> มิงลิ่ง
                                    </div>
                                </td>    
                            </tr> 
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        โรงงาน 
                                        <input class="form-control" style="width: 100px;" name="location_factory">
                                        ตรม
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเชื่อมไฟฟ้า 
                                        <input class="form-control" style="width: 100px;" name="tool_electricwelding">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman1">
                                    </div>
                                </td>  
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_drill">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> เจาะ
                                    </div>
                                </td>        
                            </tr> 
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        อื่นๆ 
                                        <input class="form-control" style="width: 100px;" name="location_other">
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเชื่อมCO2 
                                        <input class="form-control" style="width: 100px;" name="tool_co2welding">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman2">
                                    </div>
                                </td>    
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_roll">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> ม้วน
                                    </div>
                                </td>         
                            </tr> 
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเชื่อมอาร์กอน 
                                        <input class="form-control" style="width: 100px;" name="tool_argonwelding">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman3">
                                    </div>
                                </td> 
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_cut">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> ตัด
                                    </div>
                                </td>        
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องแก๊ส 
                                        <input class="form-control" style="width: 100px;" name="tool_gas">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman4">
                                    </div>
                                </td>     
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_fold">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> พับ
                                    </div>
                                </td>    
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องม้วนโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metalwinding">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman5">
                                    </div>
                                </td>  
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_link">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> เชื่อม
                                    </div>
                                </td>       
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องตัดโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metalcutting">
                                        เครื่อง
                                    </div>
                                </td> 
                               <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_handsome">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> หล่อ
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;"> 
                                        เครื่องพับโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metalfolding">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_assemble">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> ประกอบ
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องตัดท่อ 
                                        <input class="form-control" style="width: 100px;" name="tool_pipecutting">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                  <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_repair">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> ซ่อม
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องขัดโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metalpolisher">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_paint">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> งานสี
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเจาะโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metaldrilling">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_lasercutting">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> ตัดเลเซอร์
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องมือวัด 
                                        <input class="form-control" style="width: 100px;" name="tool_measuring">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_other">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                       </select> อื่นๆ
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเลเซอร์ 
                                        <input class="form-control" style="width: 100px;" name="tool_laser">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td></td>
                            </tr>
                              <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องอื่นๆ
                                        <input class="form-control" style="width: 100px;" name="tool_other">
                                    </div>
                                </td> 
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>                        
                    </table>
                </div> 
                <div class="row mt-3">
                    <div class="col-2">
                        <label for="recipient_selection_hd_file">ไฟล์แนบ(หากมี)</label>
                        <input type="file" class="form-control-file" name="recipient_selection_hd_file" >
                    </div>   
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="requested_by">เสนอโดย</label>
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
                    <h5>ใบประเมินผู้รับจ้างช่วง</h5>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">รายการประเมิน</th>
                                <th class="text-center">ดี</th>
                                <th class="text-center">พอใช้</th>
                                <th class="text-center">ไม่ดี</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    - คุณภาพการใช้งานของสินค้า
                                    <input type="hidden" value="1" name="recipient_selection_sub_listno[]">
                                    <input type="hidden" value="คุณภาพการใช้งานของสินค้า" name="recipient_selection_sub_name[]">
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    - ความเรียบร้อยของสินค้า
                                    <input type="hidden" value="2" name="recipient_selection_sub_listno[]">
                                    <input type="hidden" value="ความเรียบร้อยของสินค้า" name="recipient_selection_sub_name[]">
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    - บริการของผู้รับจ้างช่วง
                                    <input type="hidden" value="3" name="recipient_selection_sub_listno[]">
                                    <input type="hidden" value="บริการของผู้รับจ้างช่วง" name="recipient_selection_sub_name[]">
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results3[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    - การให้บริการหลังการขาย
                                    <input type="hidden" value="4" name="recipient_selection_sub_listno[]">
                                    <input type="hidden" value="การให้บริการหลังการขาย" name="recipient_selection_sub_name[]">
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results1[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results2[]">
                                        <option value="0"></option>
                                        <option value="1">/</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="recipient_selection_sub_results3[]">
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
                        <label for="product_type1">หมายเหตุ</label>
                        <textarea class="form-control" name="recipient_selection_hd_remark"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="assessor_by">ผู้ประเมินสินค้า</label>
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
                        <label for="assessor_by">ผู้ประเมินบริการ</label>
                         <select class="form-control receiver-select" name="purchase_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="assessor_by" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="assessor_date">วันที่</label>
                        <input class="form-control" type="date" name="purchase_date" readonly>
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
</script>
@endpush  
    