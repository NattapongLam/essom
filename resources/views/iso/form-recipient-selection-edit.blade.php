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
                <form method="POST" class="form-horizontal" action="{{ route('recipient-selection.update',$hd->recipient_selection_hd_id) }}" enctype="multipart/form-data">
                @csrf 
                @method('PUT')        
                <input type="hidden" name="checkdoc" value="Edit">           
                <div class="row mt-3">  
                    <div class="col-4">
                        <label for="recipient_selection_hd_name">ชื่อผู้รับจ้างช่าง</label>
                        <input class="form-control" name="recipient_selection_hd_name" value="{{$hd->recipient_selection_hd_name}}">
                    </div> 
                    <div class="col-8">
                        <label for="recipient_selection_hd_address">ที่อยู่</label>
                        <input class="form-control" name="recipient_selection_hd_address" value="{{$hd->recipient_selection_hd_address}}">
                    </div>   
                </div>  
                <div class="row mt-3">  
                    <div class="col-4">
                        <label for="recipient_selection_hd_contact">ชื่อผู้ติดต่อ</label>
                        <input class="form-control" name="recipient_selection_hd_contact" value="{{$hd->recipient_selection_hd_contact}}">
                    </div> 
                    <div class="col-4">
                        <label for="recipient_selection_hd_tel">เบอร์โทร</label>
                        <input class="form-control" name="recipient_selection_hd_tel" value="{{$hd->recipient_selection_hd_tel}}">
                    </div> 
                    <div class="col-4">
                        <label for="recipient_selection_hd_email">E-mail</label>
                        <input class="form-control" name="recipient_selection_hd_email" value="{{$hd->recipient_selection_hd_email}}">
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
                                        <input class="form-control" style="width: 100px;" name="location_house" value="{{$hd->location_house}}">
                                        ตรม
                                    </div>
                                </td>            
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องกลึง 
                                        <input class="form-control" style="width: 100px;" name="tool_lathe" value="{{$hd->tool_lathe}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        วิศวกร 
                                        <input class="form-control" style="width: 100px;" name="person_engineer" value="{{$hd->person_engineer}}">
                                    </div>
                                </td>   
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_lathe">
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
                                        <input class="form-control" style="width: 100px;" name="location_rowhouse" value="{{$hd->location_rowhouse}}">
                                        คูหา
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องมิลลิ่ง 
                                        <input class="form-control" style="width: 100px;" name="tool_milling" value="{{$hd->tool_milling}}">
                                        เครื่อง
                                    </div>
                                </td>    
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        หน. งาน 
                                        <input class="form-control" style="width: 100px;" name="person_manager" value="{{$hd->person_manager}}">
                                    </div>
                                </td>     
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_milling">
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
                                        <input class="form-control" style="width: 100px;" name="location_factory" value="{{$hd->location_factory}}">
                                        ตรม
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเชื่อมไฟฟ้า 
                                        <input class="form-control" style="width: 100px;" name="tool_electricwelding" value="{{$hd->tool_electricwelding}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman1" value="{{$hd->person_tradesman1}}">
                                    </div>
                                </td>  
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_drill">
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
                                        <input class="form-control" style="width: 100px;" name="location_other" value="{{$hd->location_other}}">
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        เครื่องเชื่อมCO2 
                                        <input class="form-control" style="width: 100px;" name="tool_co2welding" value="{{$hd->tool_co2welding}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman2" value="{{$hd->person_tradesman2}}">
                                    </div>
                                </td>    
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_roll">
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
                                        <input class="form-control" style="width: 100px;" name="tool_argonwelding" value="{{$hd->tool_argonwelding}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman3" value="{{$hd->person_tradesman3}}">
                                    </div>
                                </td> 
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_cut">
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
                                        <input class="form-control" style="width: 100px;" name="tool_gas" value="{{$hd->tool_gas}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman4" value="{{$hd->person_tradesman4}}">
                                    </div>
                                </td>     
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_fold">
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
                                        <input class="form-control" style="width: 100px;" name="tool_metalwinding" value="{{$hd->tool_metalwinding}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        ช่าง
                                        <input class="form-control" style="width: 100px;" name="person_tradesman5" value="{{$hd->person_tradesman5}}">
                                    </div>
                                </td>  
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_link">
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
                                        <input class="form-control" style="width: 100px;" name="tool_metalcutting" value="{{$hd->tool_metalcutting}}">
                                        เครื่อง
                                    </div>
                                </td> 
                               <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_handsome">
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
                                        <input class="form-control" style="width: 100px;" name="tool_metalfolding" value="{{$hd->tool_metalfolding}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_assemble">
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
                                        <input class="form-control" style="width: 100px;" name="tool_pipecutting" value="{{$hd->tool_pipecutting}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                  <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_repair">
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
                                        <input class="form-control" style="width: 100px;" name="tool_metalpolisher" value="{{$hd->tool_metalpolisher}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_paint">
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
                                        <input class="form-control" style="width: 100px;" name="tool_metaldrilling" value="{{$hd->tool_metaldrilling}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_lasercutting">
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
                                        <input class="form-control" style="width: 100px;" name="tool_measuring" value="{{$hd->tool_measuring}}">
                                        เครื่อง
                                    </div>
                                </td> 
                                <td></td>
                                <td>
                                     <div style="display: flex; align-items: center; gap: 10px;">
                                       <select class="form-control" style="width: 100px;" name="job_other">
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
                                        <input class="form-control" style="width: 100px;" name="tool_laser" value="{{$hd->tool_laser}}">
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
                                        <input class="form-control" style="width: 100px;" name="tool_other" value="{{$hd->tool_other}}">
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
                        <input class="form-control" type="date" name="requested_date" value="{{ $hd->requested_date }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="reviewed_by">ทบทวนโดย</label>
                        <select class="form-control receiver-select" name="reviewed_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->reviewed_by) &&  $hd->reviewed_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
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
                        <input class="form-control" name="approved_by1" readonly>
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
                            @foreach ($sub as $item)
                                <tr>
                                    <td> 
                                        - {{$item->recipient_selection_sub_name}}
                                        <input type="hidden" name="recipient_selection_sub_id[]" value="{{$item->recipient_selection_sub_id}}">
                                    </td>
                                    <td class="text-center">
                                        <select class="form-control" name="recipient_selection_sub_results1[]">
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
                                        <select class="form-control" name="recipient_selection_sub_results2[]">
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
                                        <select class="form-control" name="recipient_selection_sub_results3[]">
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
                        <textarea class="form-control" name="recipient_selection_hd_remark">{{$hd->recipient_selection_hd_remark}}</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="assessor_by">ผู้ประเมิน</label>
                        <select class="form-control receiver-select" name="assessor_by">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->assessor_by) &&  $hd->assessor_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <input class="form-control" name="assessor_by"  value="{{auth()->user()->name}}" readonly> --}}
                    </div>
                    <div class="col-3">
                        <label for="assessor_date">วันที่</label>
                        <input class="form-control" type="date" name="assessor_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label for="approved_by2">ผู้อนุมัติ</label>
                        <select class="form-control receiver-select" name="approved_by2">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ isset($hd->approved_by2) &&  $hd->approved_by2 == $item->ms_employee_fullname ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
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
    