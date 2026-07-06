@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Modern Indigo Theme */
    :root {
        --primary-indigo: #6366f1;
        --primary-hover: #4f46e5;
        --bg-light: #f8fafc;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.06);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 24px;
    }

    .form-title {
        color: var(--primary-indigo);
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .doc-number {
        background: #e0e7ff;
        color: var(--primary-hover);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .section-subtitle {
        color: var(--primary-indigo);
        font-weight: 600;
        border-left: 4px solid var(--primary-indigo);
        padding-left: 10px;
        margin-top: 2rem;
        margin-bottom: 1.2rem;
    }

    /* Form Controls Styling */
    .form-group label {
        color: #475569;
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 6px;
    }

    .form-control {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 14px;
        height: auto;
        color: var(--text-dark);
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus {
        border-color: var(--primary-indigo);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    /* Modern Table Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    .modern-table thead th {
        background-color: #f8fafc !important;
        color: var(--text-dark);
        font-weight: 600;
        font-size: 0.85rem;
        border-bottom: 2px solid var(--border-color) !important;
        padding: 12px 8px !important;
    }
    .modern-table td {
        padding: 12px 8px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        background: #fff;
    }
    .modern-table tbody tr:hover td {
        background-color: #f8fafc;
    }

    /* Inline elements inside tables */
    .table-flex-cell {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    .table-flex-cell .form-control {
        padding: 6px 10px;
    }

    /* Submit Button */
    .btn-indigo-submit {
        background-color: var(--primary-indigo);
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
        padding: 12px 32px;
        border: none;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }
    .btn-indigo-submit:hover {
        background-color: var(--primary-hover);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
    }
    
    .file-preview-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f1f5f9;
        padding: 6px 12px;
        border-radius: 6px;
        margin-top: 8px;
        font-size: 0.85rem;
        color: var(--primary-indigo);
        border: 1px solid #e2e8f0;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="text-center text-md-left">
                            <small class="text-muted font-weight-bold">ESSOM CO., LTD</small>
                            <h4 class="form-title mb-0">ใบคัดเลือกผู้รับจ้างช่วงและประเมิน</h4>
                            <span class="text-muted" style="font-size: 0.9rem;">SUBCONTRACTOR QUALIFICATION AND EVALUATION</span>
                        </div>
                        <div class="text-center text-md-right">
                            <span class="doc-number mb-1">F8411.2</span>
                            <div class="text-muted small">15 Aug. 19</div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">     
                    <form method="POST" action="{{ route('recipient-selection.update', $hd->recipient_selection_hd_id) }}" enctype="multipart/form-data">
                        @csrf            
                        @method('PUT')
                        <input type="hidden" name="checkdoc" value="Edit">

                        <!-- ข้อมูลทั่วไป -->
                        <h5 class="section-subtitle mt-0">ข้อมูลทั่วไป</h5>
                        <div class="row">  
                            <div class="col-md-4 form-group">
                                <label for="recipient_selection_hd_name">ชื่อผู้รับจ้างช่วง</label>
                                <input class="form-control" name="recipient_selection_hd_name" value="{{$hd->recipient_selection_hd_name}}">
                            </div> 
                            <div class="col-md-8 form-group">
                                <label for="recipient_selection_hd_address">ที่อยู่</label>
                                <input class="form-control" name="recipient_selection_hd_address" value="{{$hd->recipient_selection_hd_address}}">
                            </div>   
                        </div>  

                        <div class="row">  
                            <div class="col-md-4 form-group">
                                <label for="recipient_selection_hd_contact">ชื่อผู้ติดต่อ</label>
                                <input class="form-control" name="recipient_selection_hd_contact" value="{{$hd->recipient_selection_hd_contact}}">
                            </div> 
                            <div class="col-md-4 form-group">
                                <label for="recipient_selection_hd_tel">เบอร์โทร</label>
                                <input class="form-control" name="recipient_selection_hd_tel" value="{{$hd->recipient_selection_hd_tel}}">
                            </div> 
                            <div class="col-md-4 form-group">
                                <label for="recipient_selection_hd_email">E-mail</label>
                                <input class="form-control" name="recipient_selection_hd_email" value="{{$hd->recipient_selection_hd_email}}">
                            </div>   
                        </div>

                        <!-- ผลิตภัณฑ์/งานจ้าง -->
                        <h5 class="section-subtitle">ผลิตภัณฑ์ หรือ งานจ้างที่เสนอผลิตได้</h5>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="product_type1">ลำดับที่ 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="product_type1" value="{{$hd->product_type1}}" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="product_type2">ลำดับที่ 2</label>
                                <input type="text" class="form-control" name="product_type2" value="{{$hd->product_type2}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="product_type3">ลำดับที่ 3</label>
                                <input type="text" class="form-control" name="product_type3" value="{{$hd->product_type3}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="product_type4">ลำดับที่ 4</label>
                                <input type="text" class="form-control" name="product_type4" value="{{$hd->product_type4}}">
                            </div>
                        </div>          

                        <!-- ตารางประเมินศักยภาพ -->
                        <h5 class="section-subtitle">ข้อมูลโครงสร้างและขีดความสามารถ</h5>
                        <div class="table-responsive mb-4">
                            <table class="table modern-table text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;">ลักษณะสถานที่</th>
                                        <th style="width: 25%;">เครื่องมือ / อุปกรณ์</th>
                                        <th style="width: 25%;">บุคลากร</th>
                                        <th style="width: 25%;">ลักษณะงานที่เหมาะสม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- แถวที่ 1 -->
                                    <tr>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>บ้าน</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="location_house" value="{{$hd->location_house}}">
                                                <span class="text-muted">ตรม</span>
                                            </div>
                                        </td>            
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องกลึง</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_lathe" value="{{$hd->tool_lathe}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>วิศวกร</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="person_engineer" value="{{$hd->person_engineer}}">
                                                <span class="text-muted">คน</span>
                                            </div>
                                        </td>   
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_lathe">
                                                    <option value="0" {{ !$hd->job_lathe ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_lathe ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>กลึง</span>
                                            </div>
                                        </td>                 
                                    </tr>   
                                    <!-- แถวที่ 2 -->
                                    <tr>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>ห้องแถว</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="location_rowhouse" value="{{$hd->location_rowhouse}}">
                                                <span class="text-muted">คูหา</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องมิลลิ่ง</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_milling" value="{{$hd->tool_milling}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td>    
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>หน. งาน</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="person_manager" value="{{$hd->person_manager}}">
                                                <span class="text-muted">คน</span>
                                            </div>
                                        </td>     
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_milling">
                                                    <option value="0" {{ !$hd->job_milling ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_milling ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>มิลลิ่ง</span>
                                            </div>
                                        </td>    
                                    </tr> 
                                    <!-- แถวที่ 3 -->
                                    <tr>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>โรงงาน</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="location_factory" value="{{$hd->location_factory}}">
                                                <span class="text-muted">ตรม</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องเชื่อมไฟฟ้า</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_electricwelding" value="{{$hd->tool_electricwelding}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>ช่าง</span>
                                                <input class="form-control text-center" style="width: 80px;" name="person_tradesman1" value="{{$hd->person_tradesman1}}">
                                                <span class="text-muted">คน</span>
                                            </div>
                                        </td>  
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_drill">
                                                    <option value="0" {{ !$hd->job_drill ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_drill ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>เจาะ</span>
                                            </div>
                                        </td>        
                                    </tr> 
                                    <!-- แถวที่ 4 -->
                                    <tr>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>อื่นๆ</span> 
                                                <input class="form-control" style="width: 120px;" name="location_other" value="{{$hd->location_other}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องเชื่อม CO2</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_co2welding" value="{{$hd->tool_co2welding}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>ช่าง</span>
                                                <input class="form-control text-center" style="width: 80px;" name="person_tradesman2" value="{{$hd->person_tradesman2}}">
                                                <span class="text-muted">คน</span>
                                            </div>
                                        </td>    
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_roll">
                                                    <option value="0" {{ !$hd->job_roll ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_roll ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>ม้วน</span>
                                            </div>
                                        </td>         
                                    </tr> 
                                    <!-- แถวที่ 5 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องเชื่อมอาร์กอน</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_argonwelding" value="{{$hd->tool_argonwelding}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>ช่าง</span>
                                                <input class="form-control text-center" style="width: 80px;" name="person_tradesman3" value="{{$hd->person_tradesman3}}">
                                                <span class="text-muted">คน</span>
                                            </div>
                                        </td> 
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_cut">
                                                    <option value="0" {{ !$hd->job_cut ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_cut ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>ตัด</span>
                                            </div>
                                        </td>        
                                    </tr>
                                    <!-- แถวที่ 6 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องแก๊ส</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_gas" value="{{$hd->tool_gas}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>ช่าง</span>
                                                <input class="form-control text-center" style="width: 80px;" name="person_tradesman4" value="{{$hd->person_tradesman4}}">
                                                <span class="text-muted">คน</span>
                                            </div>
                                        </td>     
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_fold">
                                                    <option value="0" {{ !$hd->job_fold ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_fold ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>พับ</span>
                                            </div>
                                        </td>    
                                    </tr>
                                    <!-- แถวที่ 7 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องม้วนโลหะ</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_metalwinding" value="{{$hd->tool_metalwinding}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>ช่าง</span>
                                                <input class="form-control text-center" style="width: 80px;" name="person_tradesman5" value="{{$hd->person_tradesman5}}">
                                                <span class="text-muted">คน</span>
                                            </div>
                                        </td>  
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_link">
                                                    <option value="0" {{ !$hd->job_link ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_link ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>เชื่อม</span>
                                            </div>
                                        </td>       
                                    </tr>
                                    <!-- แถวที่ 8 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องตัดโลหะ</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_metalcutting" value="{{$hd->tool_metalcutting}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                       <td></td>
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_handsome">
                                                    <option value="0" {{ !$hd->job_handsome ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_handsome ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>หล่อ</span>
                                            </div>
                                        </td>  
                                    </tr>
                                    <!-- แถวที่ 9 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell"> 
                                                <span>เครื่องพับโลหะ</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_metalfolding" value="{{$hd->tool_metalfolding}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td></td>
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_assemble">
                                                    <option value="0" {{ !$hd->job_assemble ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_assemble ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>ประกอบ</span>
                                            </div>
                                        </td>  
                                    </tr>
                                    <!-- แถวที่ 10 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องตัดท่อ</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_pipecutting" value="{{$hd->tool_pipecutting}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td></td>
                                          <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_repair">
                                                    <option value="0" {{ !$hd->job_repair ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_repair ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>ซ่อม</span>
                                            </div>
                                        </td>  
                                    </tr>
                                    <!-- แถวที่ 11 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องขัดโลหะ</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_metalpolisher" value="{{$hd->tool_metalpolisher}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td></td>
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_paint">
                                                    <option value="0" {{ !$hd->job_paint ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_paint ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>งานสี</span>
                                            </div>
                                        </td>  
                                    </tr>
                                    <!-- แถวที่ 12 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องเจาะโลหะ</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_metaldrilling" value="{{$hd->tool_metaldrilling}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td></td>
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_lasercutting">
                                                    <option value="0" {{ !$hd->job_lasercutting ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_lasercutting ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>ตัดเลเซอร์</span>
                                            </div>
                                        </td>  
                                    </tr>
                                    <!-- แถวที่ 13 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องมือวัด</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_measuring" value="{{$hd->tool_measuring}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td></td>
                                        <td>
                                             <div class="table-flex-cell">
                                               <select class="form-control" style="width: 70px;" name="job_other">
                                                    <option value="0" {{ !$hd->job_other ? 'selected' : '' }}></option>
                                                    <option value="1" {{ $hd->job_other ? 'selected' : '' }}>/</option>
                                               </select>
                                               <span>อื่นๆ</span>
                                            </div>
                                        </td>  
                                    </tr>
                                    <!-- แถวที่ 14 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องเลเซอร์</span> 
                                                <input class="form-control text-center" style="width: 80px;" name="tool_laser" value="{{$hd->tool_laser}}">
                                                <span class="text-muted">เครื่อง</span>
                                            </div>
                                        </td> 
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- แถวที่ 15 -->
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="table-flex-cell">
                                                <span>เครื่องอื่นๆ</span>
                                                <input class="form-control" style="width: 120px;" name="tool_other" value="{{$hd->tool_other}}">
                                            </div>
                                        </td> 
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>                        
                            </table>
                        </div> 

                        <!-- ไฟล์แนบและการเสนอข้อมูล -->
                        <div class="row align-items-center mb-2">
                            <div class="col-md-4 form-group">
                                <label for="recipient_selection_hd_file"><i class="fas fa-paperclip mr-1 text-muted"></i> ไฟล์แนบ (หากมี)</label>
                                <input type="file" class="form-control-file p-1" name="recipient_selection_hd_file">
                                @if ($hd->recipient_selection_hd_file)
                                    <div class="file-preview-badge">
                                        <i class="fas fa-file-alt"></i>
                                        <a href="{{asset($hd->recipient_selection_hd_file)}}" target="_blank" class="font-weight-bold">ดูไฟล์เดิมที่นี่</a>
                                    </div>
                                @endif
                            </div>   
                        </div>

                        <div class="row">
                            <div class="col-md-9 form-group">
                                <label for="requested_by">เสนอโดย</label>
                                <input class="form-control bg-light" name="requested_by" value="{{$hd->requested_by}}" readonly>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="requested_date">วันที่เสนอ</label>
                                <input class="form-control" type="date" name="requested_date" value="{{ $hd->requested_date }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9 form-group">
                                <label for="reviewed_by">ทบทวนโดย</label>
                                <select class="form-control receiver-select" name="reviewed_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ isset($hd->reviewed_by) && $hd->reviewed_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="reviewed_date">วันที่ทบทวน</label>
                                <input class="form-control bg-light" type="date" name="reviewed_date" readonly>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-9 form-group">
                                <label for="approved_by1">อนุมัติโดย</label>
                                <input class="form-control bg-light" name="approved_by1" readonly>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="approved_date1">วันที่อนุมัติ</label>
                                <input class="form-control bg-light" type="date" name="approved_date1" readonly>
                            </div>
                        </div>

                        <!-- ส่วนประเมินผล -->
                        <h5 class="section-subtitle">ใบประเมินผู้รับจ้างช่วง</h5>
                        <div class="table-responsive mb-4">
                            <table class="table modern-table">
                                <thead>
                                    <tr>
                                        <th class="text-left" style="width: 55%; padding-left: 20px !important;">รายการประเมิน</th>
                                        <th class="text-center" style="width: 15%;">ดี</th>
                                        <th class="text-center" style="width: 15%;">พอใช้</th>
                                        <th class="text-center" style="width: 15%;">ไม่ดี</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sub as $item)
                                    <tr>
                                        <td class="text-left" style="padding-left: 20px !important; font-weight: 500;">
                                            - {{ $item->recipient_selection_sub_name }}
                                            <input type="hidden" name="recipient_selection_sub_id[]" value="{{$item->recipient_selection_sub_id}}">
                                        </td>
                                        <td class="text-center">
                                            <select class="form-control mx-auto" style="width: 70px;" name="recipient_selection_sub_results1[]">
                                                <option value="0" {{ !$item->recipient_selection_sub_results1 ? 'selected' : '' }}></option>
                                                <option value="1" {{ $item->recipient_selection_sub_results1 ? 'selected' : '' }}>/</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <select class="form-control mx-auto" style="width: 70px;" name="recipient_selection_sub_results2[]">
                                                <option value="0" {{ !$item->recipient_selection_sub_results2 ? 'selected' : '' }}></option>
                                                <option value="1" {{ $item->recipient_selection_sub_results2 ? 'selected' : '' }}>/</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <select class="form-control mx-auto" style="width: 70px;" name="recipient_selection_sub_results3[]">
                                                <option value="0" {{ !$item->recipient_selection_sub_results3 ? 'selected' : '' }}></option>
                                                <option value="1" {{ $item->recipient_selection_sub_results3 ? 'selected' : '' }}>/</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>  

                        <!-- หมายเหตุและผู้ลงนามประเมิน -->
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="recipient_selection_hd_remark">หมายเหตุ</label>
                                <textarea class="form-control" rows="3" name="recipient_selection_hd_remark" placeholder="ระบุรายละเอียดเพิ่มเติม...">{{$hd->recipient_selection_hd_remark}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9 form-group">
                                <label for="assessor_by">ผู้ประเมินสินค้า</label>
                                 <select class="form-control receiver-select" name="assessor_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ isset($hd->assessor_by) && $hd->assessor_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="assessor_date">วันที่ประเมินสินค้า</label>
                                <input class="form-control" type="date" name="assessor_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9 form-group">
                                <label for="purchase_by">ผู้ประเมินบริการ</label>
                                 <select class="form-control receiver-select" name="purchase_by">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ isset($hd->purchase_by) && $hd->purchase_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="purchase_date">วันที่ประเมินบริการ</label>
                                <input class="form-control" type="date" name="purchase_date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-9 form-group">
                                <label for="approved_by2">ผู้อนุมัติ (ผลประเมิน)</label>
                                 <select class="form-control receiver-select" name="approved_by2">
                                    <option value=""></option>
                                    @foreach ($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}"
                                            {{ isset($hd->approved_by2) && $hd->approved_by2 == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="approved_date2">วันที่อนุมัติ</label>
                                <input class="form-control bg-light" type="date" name="approved_date2" readonly>
                            </div>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <!-- ปุ่ม Actions -->
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-indigo-submit">
                                    <i class="fas fa-save mr-2"></i> อัปเดตข้อมูลเอกสาร
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
    // init select2 
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});
</script>
@endpush