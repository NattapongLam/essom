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
        --success-color: #10b981;
        --warning-color: #f59e0b;
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

    .form-control[readonly], .form-control[disabled] {
        background-color: var(--bg-light) !important;
        color: #64748b;
        opacity: 0.85;
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

    /* File badge view */
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

    /* Badge overrides for workflow status */
    .status-badge-container {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-left: 10px;
    }
    .badge-modern-warning {
        background-color: #fef3c7;
        color: #d97706;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-modern-success {
        background-color: #d1fae5;
        color: #059669;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .btn-approve-check {
        background-color: var(--primary-indigo);
        color: white;
        border-radius: 6px;
        padding: 2px 8px;
        font-size: 0.8rem;
        transition: all 0.2s;
    }
    .btn-approve-check:hover {
        background-color: var(--primary-hover);
        color: white;
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
                    <input type="hidden" name="checkdoc" value="Update">           
                    
                    <!-- ข้อมูลทั่วไป -->
                    <h5 class="section-subtitle mt-0">ข้อมูลทั่วไป</h5>
                    <div class="row">  
                        <div class="col-md-4 form-group">
                            <label for="recipient_selection_hd_name">ชื่อผู้รับจ้างช่วง</label>
                            <input class="form-control" name="recipient_selection_hd_name" value="{{$hd->recipient_selection_hd_name}}" readonly>
                        </div> 
                        <div class="col-md-8 form-group">
                            <label for="recipient_selection_hd_address">ที่อยู่</label>
                            <input class="form-control" name="recipient_selection_hd_address" value="{{$hd->recipient_selection_hd_address}}" readonly>
                        </div>   
                    </div>  

                    <div class="row">  
                        <div class="col-md-4 form-group">
                            <label for="recipient_selection_hd_contact">ชื่อผู้ติดต่อ</label>
                            <input class="form-control" name="recipient_selection_hd_contact" value="{{$hd->recipient_selection_hd_contact}}" readonly>
                        </div> 
                        <div class="col-md-4 form-group">
                            <label for="recipient_selection_hd_tel">เบอร์โทร</label>
                            <input class="form-control" name="recipient_selection_hd_tel" value="{{$hd->recipient_selection_hd_tel}}" readonly>
                        </div> 
                        <div class="col-md-4 form-group">
                            <label for="recipient_selection_hd_email">E-mail</label>
                            <input class="form-control" name="recipient_selection_hd_email" value="{{$hd->recipient_selection_hd_email}}" readonly> 
                        </div>
                    </div>

                    <!-- ผลิตภัณฑ์/งานจ้าง -->
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="product_type1">ผลิตภัณฑ์ที่เสนอขาย ลำดับที่ 1</label>
                            <input type="text" class="form-control" name="product_type1" value="{{$hd->product_type1}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="product_type2">ผลิตภัณฑ์ที่เสนอขาย ลำดับที่ 2</label>
                            <input type="text" class="form-control" name="product_type2" value="{{$hd->product_type2}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="product_type3">ผลิตภัณฑ์ที่เสนอขาย ลำดับที่ 3</label>
                            <input type="text" class="form-control" name="product_type3" value="{{$hd->product_type3}}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="product_type4">ผลิตภัณฑ์ที่เสนอขาย ลำดับที่ 4</label>
                            <input type="text" class="form-control" name="product_type4" value="{{$hd->product_type4}}">
                        </div>   
                    </div>

                    <!-- ข้อมูลโครงสร้างและขีดความสามารถ -->
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
                                            <input class="form-control text-center" style="width: 80px;" name="location_house" value="{{$hd->location_house}}" readonly>
                                            <span class="text-muted">ตรม</span>
                                        </div>
                                    </td>            
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>เครื่องกลึง</span> 
                                            <input class="form-control text-center" style="width: 80px;" name="tool_lathe" value="{{$hd->tool_lathe}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>วิศวกร</span> 
                                            <input class="form-control text-center" style="width: 80px;" name="person_engineer" value="{{$hd->person_engineer}}" readonly>
                                        </div>
                                    </td>   
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_lathe" disabled>
                                                <option value="{{ $hd->job_lathe ? '1' : '0' }}">{{ $hd->job_lathe ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_lathe ? '0' : '1' }}">{{ $hd->job_lathe ? '' : '/' }}</option>                                 
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
                                            <input class="form-control text-center" style="width: 80px;" name="location_rowhouse" value="{{$hd->location_rowhouse}}" readonly>
                                            <span class="text-muted">คูหา</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>เครื่องมิลลิ่ง</span> 
                                            <input class="form-control text-center" style="width: 80px;" name="tool_milling" value="{{$hd->tool_milling}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td>    
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>หน. งาน</span> 
                                            <input class="form-control text-center" style="width: 80px;" name="person_manager" value="{{$hd->person_manager}}" readonly>
                                        </div>
                                    </td>     
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_milling" disabled>
                                                <option value="{{ $hd->job_milling ? '1' : '0' }}">{{ $hd->job_milling ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_milling ? '0' : '1' }}">{{ $hd->job_milling ? '' : '/' }}</option>                                    
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
                                            <input class="form-control text-center" style="width: 80px;" name="location_factory" value="{{$hd->location_factory}}" readonly>
                                            <span class="text-muted">ตรม</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>เครื่องเชื่อมไฟฟ้า</span> 
                                            <input class="form-control text-center" style="width: 80px;" name="tool_electricwelding" value="{{$hd->tool_electricwelding}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>ช่าง</span>
                                            <input class="form-control text-center" style="width: 80px;" name="person_tradesman1" value="{{$hd->person_tradesman1}}" readonly>
                                        </div>
                                    </td>  
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_drill" disabled>
                                                <option value="{{ $hd->job_drill ? '1' : '0' }}">{{ $hd->job_drill ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_drill ? '0' : '1' }}">{{ $hd->job_drill ? '' : '/' }}</option>
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
                                            <input class="form-control" style="width: 120px;" name="location_other" value="{{$hd->location_other}}" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>เครื่องเชื่อม CO2</span> 
                                            <input class="form-control text-center" style="width: 80px;" name="tool_co2welding" value="{{$hd->tool_co2welding}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>ช่าง</span>
                                            <input class="form-control text-center" style="width: 80px;" name="person_tradesman2" value="{{$hd->person_tradesman2}}" readonly>
                                        </div>
                                    </td>    
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_roll" disabled>
                                                <option value="{{ $hd->job_roll ? '1' : '0' }}">{{ $hd->job_roll ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_roll ? '0' : '1' }}">{{ $hd->job_roll ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_argonwelding" value="{{$hd->tool_argonwelding}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>ช่าง</span>
                                            <input class="form-control text-center" style="width: 80px;" name="person_tradesman3" value="{{$hd->person_tradesman3}}" readonly>
                                        </div>
                                    </td> 
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_cut" disabled>
                                                <option value="{{ $hd->job_cut ? '1' : '0' }}">{{ $hd->job_cut ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_cut ? '0' : '1' }}">{{ $hd->job_cut ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_gas" value="{{$hd->tool_gas}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>ช่าง</span>
                                            <input class="form-control text-center" style="width: 80px;" name="person_tradesman4" value="{{$hd->person_tradesman4}}" readonly>
                                        </div>
                                    </td>     
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_fold" disabled>
                                                <option value="{{ $hd->job_fold ? '1' : '0' }}">{{ $hd->job_fold ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_fold ? '0' : '1' }}">{{ $hd->job_fold ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_metalwinding" value="{{$hd->tool_metalwinding}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="table-flex-cell">
                                            <span>ช่าง</span>
                                            <input class="form-control text-center" style="width: 80px;" name="person_tradesman5" value="{{$hd->person_tradesman5}}" readonly>
                                        </div>
                                    </td>  
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_link" disabled>
                                                <option value="{{ $hd->job_link ? '1' : '0' }}">{{ $hd->job_link ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_link ? '0' : '1' }}">{{ $hd->job_link ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_metalcutting" value="{{$hd->tool_metalcutting}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                   <td></td>
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_handsome" disabled>
                                                <option value="{{ $hd->job_handsome ? '1' : '0' }}">{{ $hd->job_handsome ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_handsome ? '0' : '1' }}">{{ $hd->job_handsome ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_metalfolding" value="{{$hd->tool_metalfolding}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td></td>
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_assemble" disabled>
                                                <option value="{{ $hd->job_assemble ? '1' : '0' }}">{{ $hd->job_assemble ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_assemble ? '0' : '1' }}">{{ $hd->job_assemble ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_pipecutting" value="{{$hd->tool_pipecutting}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td></td>
                                      <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_repair" disabled>
                                                <option value="{{ $hd->job_repair ? '1' : '0' }}">{{ $hd->job_repair ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_repair ? '0' : '1' }}">{{ $hd->job_repair ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_metalpolisher" value="{{$hd->tool_metalpolisher}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td></td>
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_paint" disabled>
                                                <option value="{{ $hd->job_paint ? '1' : '0' }}">{{ $hd->job_paint ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_paint ? '0' : '1' }}">{{ $hd->job_paint ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_metaldrilling" value="{{$hd->tool_metaldrilling}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td></td>
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_lasercutting" disabled>
                                                <option value="{{ $hd->job_lasercutting ? '1' : '0' }}">{{ $hd->job_lasercutting ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_lasercutting ? '0' : '1' }}">{{ $hd->job_lasercutting ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_measuring" value="{{$hd->tool_measuring}}" readonly>
                                            <span class="text-muted">เครื่อง</span>
                                        </div>
                                    </td> 
                                    <td></td>
                                    <td>
                                         <div class="table-flex-cell">
                                           <select class="form-control" style="width: 70px;" name="job_other" disabled >
                                                <option value="{{ $hd->job_other ? '1' : '0' }}">{{ $hd->job_other ? '/' : '' }}</option>
                                                <option value="{{ $hd->job_other ? '0' : '1' }}">{{ $hd->job_other ? '' : '/' }}</option>
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
                                            <input class="form-control text-center" style="width: 80px;" name="tool_laser" value="{{$hd->tool_laser}}" readonly>
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
                                            <input class="form-control" style="width: 120px;" name="tool_other" value="{{$hd->tool_other}}" readonly>
                                        </div>
                                    </td> 
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>                        
                        </table>
                    </div> 

                    <!-- ไฟล์แนบ -->
                    <div class="row align-items-center mb-2">
                        <div class="col-md-4 form-group">
                            <label for="recipient_selection_hd_file"><i class="fas fa-paperclip mr-1 text-muted"></i> ไฟล์แนบ (หากมี)</label>
                            <input type="file" class="form-control-file p-1" name="recipient_selection_hd_file" disabled>
                            @if ($hd->recipient_selection_hd_file)
                                <div class="file-preview-badge">
                                    <i class="fas fa-file-alt"></i>
                                    <a href="{{asset($hd->recipient_selection_hd_file)}}" target="_blank" class="font-weight-bold">ดูไฟล์แนบ</a>
                                </div>
                            @endif
                        </div>   
                    </div>

                    <!-- ส่วนตรวจสอบและอนุมัติ (Workflow 1) -->
                    <div class="row">
                        <div class="col-md-9 form-group">
                            <label for="requested_by">เสนอโดย</label>
                            <input class="form-control" name="requested_by" value="{{$hd->requested_by}}" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="requested_date">วันที่</label>
                            <input class="form-control" type="date" name="requested_date" value="{{ $hd->requested_date }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9 form-group">
                            <label for="reviewed_by">ทบทวนโดย</label>   
                            <span class="status-badge-container">
                                @if ($hd->reviewed_status == "N")
                                    @if ($hd->reviewed_by == auth()->user()->name)
                                        <a href="javascript:void(0)" class="btn btn-approve-check btn-sm" onclick="confirmApp('{{ $hd->recipient_selection_hd_id }}','reviewed')">
                                            <i class="fas fa-check mr-1"></i> คลิกเพื่ออนุมัติ
                                        </a>
                                    @else
                                        <span class="badge-modern-warning">รอดำเนินการ</span>
                                    @endif
                                @else
                                    <span class="badge-modern-success"><i class="fas fa-check-circle mr-1"></i> ดำเนินการเรียบร้อย</span>
                                @endif
                            </span>             
                            <input class="form-control mt-1" name="reviewed_by" value="{{$hd->reviewed_by}}" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="reviewed_date">วันที่</label>
                            <input class="form-control" type="date" name="reviewed_date" value="{{$hd->reviewed_date }}" readonly>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-md-9 form-group">
                            <label for="approved_by1">อนุมัติโดย</label>
                            <span class="status-badge-container">
                                @if ($hd->approved_status1 == "N")
                                    @if ($hd->approved_by1 == auth()->user()->name)
                                        <a href="javascript:void(0)" class="btn btn-approve-check btn-sm" onclick="confirmApp('{{ $hd->recipient_selection_hd_id }}','approved1')">
                                            <i class="fas fa-check mr-1"></i> คลิกเพื่ออนุมัติ
                                        </a>
                                    @else
                                        <span class="badge-modern-warning">รอดำเนินการ</span>
                                    @endif
                                @else
                                    <span class="badge-modern-success"><i class="fas fa-check-circle mr-1"></i> ดำเนินการเรียบร้อย</span>
                                @endif
                            </span>             
                            <input class="form-control mt-1" name="approved_by1" value="{{$hd->approved_by1}}" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="approved_date1">วันที่</label>
                            <input class="form-control" type="date" name="approved_date1" value="{{ $hd->approved_date1 }}" readonly>
                        </div>
                    </div>                   

                    <!-- ส่วนประเมินผลผู้รับจ้างช่วง -->
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
                                            - {{$item->recipient_selection_sub_name}}
                                            <input type="hidden" name="recipient_selection_sub_id[]" value="{{$item->recipient_selection_sub_id}}">
                                        </td>
                                        <td class="text-center">
                                            <select class="form-control mx-auto" style="width: 70px;" name="recipient_selection_sub_results1[]" disabled>
                                                <option value="{{ $item->recipient_selection_sub_results1 ? '1' : '0' }}">{{ $item->recipient_selection_sub_results1 ? '/' : '' }}</option>
                                                <option value="{{ $item->recipient_selection_sub_results1 ? '0' : '1' }}">{{ $item->recipient_selection_sub_results1 ? '' : '/' }}</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <select class="form-control mx-auto" style="width: 70px;" name="recipient_selection_sub_results2[]" disabled>
                                                <option value="{{ $item->recipient_selection_sub_results2 ? '1' : '0' }}">{{ $item->recipient_selection_sub_results2 ? '/' : '' }}</option>
                                                <option value="{{ $item->recipient_selection_sub_results2 ? '0' : '1' }}">{{ $item->recipient_selection_sub_results2 ? '' : '/' }}</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <select class="form-control mx-auto" style="width: 70px;" name="recipient_selection_sub_results3[]" disabled>
                                                <option value="{{ $item->recipient_selection_sub_results3 ? '1' : '0' }}">{{ $item->recipient_selection_sub_results3 ? '/' : '' }}</option>
                                                <option value="{{ $item->recipient_selection_sub_results3 ? '0' : '1' }}">{{ $item->recipient_selection_sub_results3 ? '' : '/' }}</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach                         
                            </tbody>
                        </table>
                    </div>  

                    <!-- หมายเหตุและผู้ลงนามประเมิน (Workflow 2) -->
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="recipient_selection_hd_remark">หมายเหตุ</label>
                            <textarea class="form-control" name="recipient_selection_hd_remark" disabled>{{$hd->recipient_selection_hd_remark}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9 form-group">
                            <label for="assessor_by">ผู้ประเมินสินค้า</label>
                            <input class="form-control" name="assessor_by" value="{{$hd->assessor_by}}" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="assessor_date">วันที่</label>
                            <input class="form-control" type="date" name="assessor_date" value="{{$hd->assessor_date}}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9 form-group">
                            <label for="purchase_by">ผู้ประเมินบริการ</label>
                            <input class="form-control" name="purchase_by" value="{{$hd->purchase_by}}" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="purchase_date">วันที่</label>
                            <input class="form-control" type="date" name="purchase_date" value="{{$hd->purchase_date}}" readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-9 form-group">
                            <label for="approved_by2">ผู้อนุมัติ (ผลประเมิน)</label>
                            <span class="status-badge-container">
                                @if ($hd->approved_status2 == "N")
                                    @if ($hd->approved_by2 == auth()->user()->name)
                                        <a href="javascript:void(0)" class="btn btn-approve-check btn-sm" onclick="confirmApp('{{ $hd->recipient_selection_hd_id }}','approved2')">
                                            <i class="fas fa-check mr-1"></i> คลิกเพื่ออนุมัติ
                                        </a>
                                    @else
                                        <span class="badge-modern-warning">รอดำเนินการ</span>
                                    @endif
                                 @else
                                    <span class="badge-modern-success"><i class="fas fa-check-circle mr-1"></i> ดำเนินการเรียบร้อย</span>
                                @endif
                            </span>         
                            <input class="form-control mt-1" name="approved_by2" value="{{$hd->approved_by2}}" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="approved_date2">วันที่</label>
                            <input class="form-control" type="date" name="approved_date2" value="{{ $hd->approved_date2 }}" readonly>
                        </div>
                    </div>                     
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
confirmApp = (refid, status) => {       
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
        } else if (result.dismiss === Swal.DismissReason.cancel) {
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