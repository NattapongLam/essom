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
                {{-- <form method="POST" class="form-horizontal" action="{{ route('recipient-selection.update',$hd->recipient_selection_hd_id) }}" enctype="multipart/form-data">
                @csrf 
                @method('PUT')         --}}
                <input type="hidden" name="checkdoc" value="Update">           
                <div class="row mt-3">  
                    <div class="col-4">
                        <label for="recipient_selection_hd_name">ชื่อผู้รับจ้างช่าง</label>
                        <input class="form-control" name="recipient_selection_hd_name" value="{{$hd->recipient_selection_hd_name}}" readonly>
                    </div> 
                    <div class="col-8">
                        <label for="recipient_selection_hd_address">ที่อยู่</label>
                        <input class="form-control" name="recipient_selection_hd_address" value="{{$hd->recipient_selection_hd_address}}" readonly>
                    </div>   
                </div>  
                <div class="row mt-3">  
                    <div class="col-4">
                        <label for="recipient_selection_hd_contact">ชื่อผู้ติดต่อ</label>
                        <input class="form-control" name="recipient_selection_hd_contact" value="{{$hd->recipient_selection_hd_contact}}" readonly>
                    </div> 
                    <div class="col-4">
                        <label for="recipient_selection_hd_tel">เบอร์โทร</label>
                        <input class="form-control" name="recipient_selection_hd_tel" value="{{$hd->recipient_selection_hd_tel}}" readonly>
                    </div> 
                    <div class="col-4">
                        <label for="recipient_selection_hd_email">E-mail</label>
                        <input class="form-control" name="recipient_selection_hd_email" value="{{$hd->recipient_selection_hd_email}}"readonly> 
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
                                        <input class="form-control" style="width: 100px;" name="location_house" value="{{$hd->location_house}}" readonly>
                                        ตรม
                                    </div>
                                </td>            
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องกลึง 
                                        <input class="form-control" style="width: 100px;" name="tool_lathe" value="{{$hd->tool_lathe}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        วิศวกร 
                                        <input class="form-control" style="width: 100px;" name="person_engineer" value="{{$hd->person_engineer}}" readonly>
                                    </div>
                                </td>   
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_lathe" disabled>
                                        @if ($hd->job_lathe)
                                            <option value="1">/</option>
                                            <option value="0"></option>
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif                                        
                                       </select> กลึง
                                    </div>
                                </td>                 
                            </tr>   
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ห้องแถว 
                                        <input class="form-control" style="width: 100px;" name="location_rowhouse" value="{{$hd->location_rowhouse}}" readonly>
                                        คูหา
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องมิลลิ่ง 
                                        <input class="form-control" style="width: 100px;" name="tool_milling" value="{{$hd->tool_milling}}" readonly>
                                        เครื่อง
                                    </div>
                                </td>    
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        หน. งาน 
                                        <input class="form-control" style="width: 100px;" name="person_manager" value="{{$hd->person_manager}}" readonly>
                                    </div>
                                </td>     
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_milling" disabled>
                                        @if ($hd->job_milling)
                                            <option value="1">/</option>
                                            <option value="0"></option>                                        
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif                                      
                                       </select> มิงลิ่ง
                                    </div>
                                </td>    
                            </tr> 
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        โรงงาน 
                                        <input class="form-control" style="width: 100px;" name="location_factory" value="{{$hd->location_factory}}" readonly>
                                        ตรม
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเชื่อมไฟฟ้า 
                                        <input class="form-control" style="width: 100px;" name="tool_electricwelding" value="{{$hd->tool_electricwelding}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman1" value="{{$hd->person_tradesman1}}" readonly>
                                    </div>
                                </td>  
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_drill" disabled>
                                        @if ($hd->job_drill)
                                            <option value="1">/</option>
                                            <option value="0"></option>                                            
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif
                                        
                                       </select> เจาะ
                                    </div>
                                </td>        
                            </tr> 
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        อื่นๆ 
                                        <input class="form-control" style="width: 100px;" name="location_other" value="{{$hd->location_other}}" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเชื่อมCO2 
                                        <input class="form-control" style="width: 100px;" name="tool_co2welding" value="{{$hd->tool_co2welding}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman2" value="{{$hd->person_tradesman2}}" readonly>
                                    </div>
                                </td>    
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_roll" disabled>
                                        @if ($hd->job_roll)
                                            <option value="1">/</option>
                                            <option value="0"></option>
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif                                       
                                       </select> ม้วน
                                    </div>
                                </td>         
                            </tr> 
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเชื่อมอาร์กอน 
                                        <input class="form-control" style="width: 100px;" name="tool_argonwelding" value="{{$hd->tool_argonwelding}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman3" value="{{$hd->person_tradesman3}}" readonly>
                                    </div>
                                </td> 
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_cut" disabled>
                                        @if ($hd->job_cut)
                                            <option value="1">/</option>
                                            <option value="0"></option>  
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif                                    
                                       </select> ตัด
                                    </div>
                                </td>        
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องแก๊ส 
                                        <input class="form-control" style="width: 100px;" name="tool_gas" value="{{$hd->tool_gas}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman4" value="{{$hd->person_tradesman4}}" readonly>
                                    </div>
                                </td>     
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_fold" disabled>
                                        @if ($hd->job_fold)
                                            <option value="1">/</option>
                                            <option value="0"></option>                                          
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif
                                        
                                       </select> พับ
                                    </div>
                                </td>    
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องม้วนโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metalwinding" value="{{$hd->tool_metalwinding}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman5" value="{{$hd->person_tradesman5}}" readonly>
                                    </div>
                                </td>  
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_link" disabled>
                                        @if ($hd->job_link)
                                            <option value="1">/</option>
                                            <option value="0"></option>
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif
                                       </select> เชื่อม
                                    </div>
                                </td>       
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องตัดโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metalcutting" value="{{$hd->tool_metalcutting}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                               <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_handsome" disabled>
                                        @if ($hd->job_handsome)
                                            <option value="1">/</option>
                                            <option value="0"></option>
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif
                                        
                                       </select> หล่อ
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;"> 
                                        เครื่องพับโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metalfolding" value="{{$hd->tool_metalfolding}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_assemble" disabled>
                                        @if ($hd->job_assemble)
                                            <option value="1">/</option>
                                            <option value="0"></option>                                           
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif
                                       </select> ประกอบ
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องตัดท่อ 
                                        <input class="form-control" style="width: 100px;" name="tool_pipecutting" value="{{$hd->tool_pipecutting}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                  <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_repair" disabled>
                                        @if ($hd->job_repair)
                                            <option value="1">/</option>
                                            <option value="0"></option>
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif                                      
                                       </select> ซ่อม
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องขัดโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metalpolisher" value="{{$hd->tool_metalpolisher}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_paint" disabled>
                                        @if ($hd->job_paint)
                                            <option value="1">/</option>
                                            <option value="0"></option>
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif
                                       
                                       </select> งานสี
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเจาะโลหะ 
                                        <input class="form-control" style="width: 100px;" name="tool_metaldrilling" value="{{$hd->tool_metaldrilling}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_lasercutting" disabled>
                                        @if ($hd->job_lasercutting)
                                            <option value="1">/</option>   
                                            <option value="0"></option>
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif
                                     
                                       </select> ตัดเลเซอร์
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องมือวัด 
                                        <input class="form-control" style="width: 100px;" name="tool_measuring" value="{{$hd->tool_measuring}}" readonly>
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_other" disabled >
                                        @if ($hd->job_other)
                                            <option value="1">/</option>
                                            <option value="0"></option>
                                        @else
                                            <option value="0"></option>
                                            <option value="1">/</option>
                                        @endif
                                       
                                       </select> อื่นๆ
                                    </div>
                                </td>  
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเลเซอร์ 
                                        <input class="form-control" style="width: 100px;" name="tool_laser" value="{{$hd->tool_laser}}" readonly>
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
                                        <input class="form-control" style="width: 100px;" name="tool_other" value="{{$hd->tool_other}}" readonly>
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
                        <input type="file" class="form-control-file" name="recipient_selection_hd_file" disabled>
                        @if ($hd->recipient_selection_hd_file)
                            <a href="{{asset($hd->recipient_selection_hd_file)}}" target=”_blank”>
                                <i class="fas fa-file"></i>
                            </a>
                        @endif
                    </div>   
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="requested_by">เสนอโดย</label>
                        <input class="form-control" name="requested_by" value="{{$hd->requested_by}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="requested_date">วันที่</label>
                        <input class="form-control" type="date" name="requested_date" value="{{ $hd->requested_date }}" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-9">
                        <label for="reviewed_by">ทบทวนโดย</label>   
                        @if ($hd->reviewed_status == "N")
                            @if ($hd->reviewed_by == auth()->user()->name)
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="confirmApp('{{ $hd->recipient_selection_hd_id }}','reviewed')">
                                    <i class="fas fa-check"></i>
                                </a>
                            @else
                                <span class="badge-warning">รอดำเนินการ</span>
                            @endif
                        @else
                            <span class="badge-success">ดำเนินการเรียบร้อย</span>
                        @endif             
                        <input class="form-control" name="reviewed_by" value="{{$hd->reviewed_by}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="reviewed_date">วันที่</label>
                        <input class="form-control" type="date" name="reviewed_date"  value="{{$hd->reviewed_date }}" readonly>
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="approved_by1">อนุมัติโดย</label>
                        @if ($hd->approved_status1 == "N")
                            @if ($hd->approved_by1 == auth()->user()->name)
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="confirmApp('{{ $hd->recipient_selection_hd_id }}','approved1')">
                                    <i class="fas fa-check"></i>
                                </a>
                            @else
                                <span class="badge-warning">รอดำเนินการ</span>
                            @endif
                        @else
                            <span class="badge-success">ดำเนินการเรียบร้อย</span>
                        @endif             
                        <input class="form-control" name="approved_by1"  value="{{$hd->approved_by1}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="approved_date1">วันที่</label>
                        <input class="form-control" type="date" name="approved_date1" value="{{ $hd->approved_date1 }}" readonly>
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
                            @foreach ($sub as $item)
                                <tr>
                                    <td> 
                                        - {{$item->recipient_selection_sub_name}}
                                        <input type="hidden" name="recipient_selection_sub_id[]" value="{{$item->recipient_selection_sub_id}}">
                                    </td>
                                    <td class="text-center">
                                        <select class="form-control" name="recipient_selection_sub_results1[]" disabled>
                                            @if ($item->recipient_selection_sub_results1)
                                                <option value="1">/</option>
                                                <option value="0"></option>
                                            @else
                                                <option value="0"></option>
                                                <option value="1">/</option>
                                            @endif
                                           
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <select class="form-control" name="recipient_selection_sub_results2[]" disabled>
                                            @if ($item->recipient_selection_sub_results2)
                                                <option value="1">/</option>
                                                <option value="0"></option>
                                            @else
                                                <option value="0"></option>
                                                <option value="1">/</option>
                                            @endif
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <select class="form-control" name="recipient_selection_sub_results3[]" disabled>
                                            @if ($item->recipient_selection_sub_results3)
                                                <option value="1">/</option>
                                                <option value="0"></option>
                                            @else
                                                <option value="0"></option>
                                                <option value="1">/</option>
                                            @endif
                                        </select>
                                    </td>
                                </tr>
                            @endforeach                         
                        </tbody>
                    </table>
                </div>  
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="product_type1">หมายเหตุ</label>
                        <textarea class="form-control" name="recipient_selection_hd_remark" disabled>{{$hd->recipient_selection_hd_remark}}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="assessor_by">ผู้ประเมินสินค้า</label>
                        <input class="form-control" name="assessor_by" value="{{$hd->assessor_by}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="assessor_date">วันที่</label>
                        <input class="form-control" type="date" name="assessor_date" value="{{$hd->assessor_date}}" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="purchase_by">ผู้ประเมินบริการ</label>
                        <input class="form-control" name="purchase_by" value="{{$hd->purchase_by}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="purchase_date">วันที่</label>
                        <input class="form-control" type="date" name="purchase_date" value="{{$hd->purchase_date}}" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="approved_by2">ผู้อนุมัติ</label>
                        @if ($hd->approved_status2 == "N")
                            @if ($hd->approved_by2 == auth()->user()->name)
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="confirmApp('{{ $hd->recipient_selection_hd_id }}','approved2')">
                                    <i class="fas fa-check"></i>
                                </a>
                            @else
                                <span class="badge-warning">รอดำเนินการ</span>
                            @endif
                        @else
                            <span class="badge-success">ดำเนินการเรียบร้อย</span>
                        @endif         
                        <input class="form-control" name="approved_by2"  value="{{$hd->approved_by2}}"  readonly>
                    </div>
                    <div class="col-3">
                        <label for="approved_date2">วันที่</label>
                        <input class="form-control" type="date" name="approved_date2" value="{{ $hd->approved_date2 }}" readonly>
                    </div>
                </div>                     
                 {{-- <br>
                <div class="col-12 col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก                           
                         </button>
                    </div>
                </div>
                </form> --}}
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
confirmApp = (refid,status) =>{       
Swal.fire({
    title: 'คุณแน่ใจหรือไม่ !',
    text: `คุณต้องการอนุมัติรายการนี้หรือไม่ ?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'ยืนยัน',
    cancelButtonText: 'ยกเลิก',
    confirmButtonClass: 'btn btn-success mt-2',
    cancelButtonClass: 'btn btn-danger ms-2 mt-2',
    buttonsStyling: false
}).then(function(result) {
    if (result.value) {

        $.ajax({
            url: `{{ url('/ApprovedRecipientSelection') }}`,
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "refid": refid,
                'status': status
            },
            dataType: "json",
            success: function(data) {

                console.log(data);


                if (data.status == true) {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'อนุมัติเอกสารเรียบร้อยแล้ว',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'ไม่สำเร็จ',
                        text: 'อนุมัติเอกสารไม่สำเร็จ',
                        icon: 'error'
                    });
                }
               
            }
        });

    } else if ( // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
            title: 'ยกเลิก',
            text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
            icon: 'error'
        });
    }
});

}
</script>
@endpush  
    