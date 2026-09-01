@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#4f46e5',
    customClass: { confirmButton: 'px-4 py-2 text-white font-weight-bold rounded' }
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'เกิดข้อผิดพลาด!',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc2626',
    customClass: { confirmButton: 'px-4 py-2 text-white font-weight-bold rounded' }
});
</script>
@endif

<style>
    /* Modern Indigo Theme Setup */
    .form-container {
        background: #ffffff;
        padding: 2.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        color: #334155;
    }
    .header-title-block {
        text-align: center;
        margin-bottom: 25px;
    }
    h2 { 
        font-weight: 700; 
        color: #1e293b; 
        margin-bottom: 4px; 
        font-size: 1.6rem;
    }
    h2.sub-title {
        color: #4f46e5;
        font-size: 1.3rem;
        margin-bottom: 10px;
    }
    .doc-meta {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Form Section Layouts */
    .section-top-fields {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
    }

    label { 
        font-weight: 600; 
        color: #475569; 
        display: block; 
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    
    /* Input Elements styling */
    input, textarea, select {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.9rem;
        width: 100%;
        box-sizing: border-box;
        background-color: #ffffff;
        color: #334155;
        transition: all 0.2s ease;
    }
    input:focus, textarea:focus, select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }
    input[readonly], textarea[readonly], select[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
        border-color: #cbd5e1;
    }

    /* Table Responsive Style */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        margin-top: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }
    th, td {
        border: 1px solid #e2e8f0;
        padding: 10px 8px;
        text-align: center;
        vertical-align: middle;
    }
    th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
    }
    tr:nth-child(even) { background-color: #fcfdfe; }

    /* Action Buttons Design */
    .btn-indigo-add {
        background-color: #e0e7ff !important;
        color: #4f46e5 !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 0.5rem 1rem !important;
        font-weight: 600 !important;
        font-size: 0.875rem;
        transition: all 0.2s;
        margin-top: 15px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    .btn-indigo-add:hover {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
    }

    button.primary-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
        transition: all 0.2s ease;
    }
    button.primary-submit:hover { 
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25);
        transform: translateY(-1px);
    }

    button.delete {
        background-color: #fee2e2;
        color: #dc2626;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    button.delete:hover { 
        background-color: #dc2626;
        color: #ffffff;
    }

    .inner-field-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-align: left;
        margin-top: 5px;
        margin-bottom: 2px;
    }
    .old-file-info {
        text-align: left;
        margin-top: 4px;
        font-size: 0.8rem;
    }

    /* Signature Flow Card Grid */
    .signature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-top: 30px;
    }
    .signature-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 25px; }

    /* Select2 Theme Custom Overrides to fit Indigo */
    .select2-container--default .select2-selection--single {
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        height: 38px !important;
        padding: 4px 8px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
    /* Header Action Buttons Styling */
    .header-actions-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        margin-top: 16px;
        flex-wrap: wrap;
    }
    
    .btn-action-custom {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none !important;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .btn-action-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }

    .btn-print-custom {
        background: #ffffff;
        color: #4f46e5 !important;
        border: 1px solid #c7d2fe;
    }
    .btn-print-custom:hover {
        background: #eef2ff;
        border-color: #4f46e5;
    }

    .btn-duplicate-custom {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff !important;
        border: none;
    }
    .btn-duplicate-custom:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: #ffffff !important;
    }
    @media (max-width: 1024px){
        .form-container { padding: 20px; }
    }
    @media (max-width: 640px) {
        .actions { flex-direction: column; align-items: stretch; }
    }
</style>

<form action="{{ route('objcctives.update', $objcctive->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<input type="hidden" name="checkdoc" value="Edit">

<div class="form-container">
   <div class="header-title-block">
        <h2>ESSOM CO.,LTD.</h2>
        <h2 class="sub-title">OBJECTIVES (แก้ไขข้อมูล)</h2>
        <div class="doc-meta text-right">F6200.1<br>9 Apr 24</div>
        
        <div class="header-actions-wrapper">
            <!-- ปุ่มพิมพ์ฟอร์มเดิม -->
            <a href="{{ route('objectives.print', $objcctive->id) }}" target="_blank" class="btn-action-custom btn-print-custom">
                <i class="fas fa-print"></i> พิมพ์ฟอร์ม
            </a>
            
            <!-- ปุ่มสร้างเอกสารใหม่จากข้อมูลนี้ (Duplicate) -->
            <a href="{{ route('objectives.duplicate', $objcctive->id) }}" class="btn-action-custom btn-duplicate-custom">
                <i class="fas fa-copy"></i> สร้างเอกสารใหม่จากข้อมูลนี้
            </a>
        </div>
    </div>
    <div class="section-top-fields">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <label>Section:</label>
                <input type="text" name="section[]" value="{{ old('section.0', $objcctive->section) }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>Period:</label>
                <input type="text" name="period[]" value="{{ old('period.0', $objcctive->period) }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>Type:</label>
                <select class="form-control" name="docutype[]">
                    <option value="{{$objcctive->docutype}}">{{$objcctive->docutype}}</option>
                    <option value="Monthly">Monthly</option>
                    <option value="Semi-annual">Semi-annual</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="objectiveTable">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 5%">NO.</th>
                    <th rowspan="2" style="width: 35%">DESCRIPTION OF ACTIVITIES</th>
                    <th rowspan="2" style="width: 20%">RESP. PERSON</th>
                    <th colspan="3" style="background-color: #f1f5f9; color: #475569;">OBJECTIVE</th>
                    <th rowspan="2" style="width: 20%">REMARKS/CORRECTIVE ACTION</th>
                    <th rowspan="2" style="width: 5%">ลบ</th>
                </tr>
                <tr>
                    <th width="8%" style="background-color: #f8fafc; color: #475569;">Previous</th>
                    <th width="8%" style="background-color: #f8fafc; color: #475569;">Plan</th>
                    <th width="8%" style="background-color: #f8fafc; color: #475569;">Results</th>
                </tr>
            </thead>
            <tbody>
                @php
                  $activities = $objcctive->activity_list ?? [];
                @endphp

                @forelse($activities as $i => $act)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                        <textarea name="description[]" rows="3">{{ trim(old('description.'.$i, $act['description'] ?? '')) }}</textarea>
                        <div class="inner-field-label">สาเหตุ :</div>
                        <input class="form-control" name="note1[]" value="{{ old('note1.'.$i, $act['note1'] ?? '') }}">
                        <div class="inner-field-label">แนวทางแก้ไข :</div>
                        <input class="form-control" name="note2[]" value="{{ old('note2.'.$i, $act['note2'] ?? '') }}">
                    </td>
                    <td>
                        <select class="form-control receiver-select" name="resp_person[]">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                 <option value="{{ $item->ms_employee_fullname }}"
                                    {{ (isset($act['resp_person']) && $act['resp_person'] == $item->ms_employee_fullname) ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                         <select class="form-control receiver-select" name="resp_person1[]">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ (isset($act['resp_person1']) && $act['resp_person1'] == $item->ms_employee_fullname) ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                        <div class="inner-field-label">ไฟล์แนบ :</div>
                        <input type="file" class="form-control-file" name="attachment[{{ $i }}]" style="font-size: 0.75rem;">
        
                        @if(!empty($act['file_path']))
                            <div class="old-file-info" id="file-wrapper-{{ $i }}">
                                <a href="{{ asset($act['file_path']) }}" target="_blank" style="color: #4f46e5; text-decoration: none;">
                                    <i class="fas fa-paperclip"></i> ดูไฟล์เดิม
                                </a>
                                
                                <!-- ปุ่มลบไฟล์เดิม -->
                                <button type="button" class="btn btn-sm text-danger p-0 ml-2 remove-old-file" data-row="{{ $i }}" title="ลบไฟล์นี้">
                                    <i class="fas fa-times-circle"></i> ลบไฟล์
                                </button>

                                <!-- เก็บ path เดิมไว้ -->
                                <input type="hidden" name="old_file_path[{{ $i }}]" value="{{ $act['file_path'] }}">
                                <!-- Input บอกสถานะว่าต้องการลบไฟล์นี้ไหม (0 = เก็บไว้, 1 = ลบออก) -->
                                <input type="hidden" name="delete_file[{{ $i }}]" value="0" id="delete_file_{{ $i }}">
                            </div>
                        @else
                            <input type="hidden" name="old_file_path[{{ $i }}]" value="">
                            <input type="hidden" name="delete_file[{{ $i }}]" value="0">
                        @endif
                    </td>
                    <td><input type="text" name="previous[]" value="{{ old('previous.'.$i, $act['previous'] ?? '') }}"></td>
                    <td><input type="text" name="plan[]" value="{{ old('plan.'.$i, $act['plan'] ?? '') }}"></td>
                    <td><input type="text" name="results[]" value="{{ old('results.'.$i, $act['results'] ?? '') }}"></td>
                    <td>
                        <textarea name="remarks[]" rows="3">{{ trim(old('remarks.'.$i, $act['remarks'] ?? '')) }}</textarea>
                    </td>
                    <td>
                        <input type="hidden" name="no[]" value="{{ $i+1 }}" class="rowNo">
                        <button type="button" class="delete"><i class="fas fa-trash-alt"></i> ลบ</button>
                    </td>
                </tr>
                @empty
                @for($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                        <textarea name="description[]" rows="3" placeholder="Description of Activities"></textarea>
                        <div class="inner-field-label">สาเหตุ :</div>
                        <input class="form-control" name="note1[]" placeholder="สาเหตุ">
                        <div class="inner-field-label">แนวทางแก้ไข :</div>
                        <input class="form-control" name="note2[]" placeholder="แนวทางแก้ไข">
                    </td>
                    <td>
                        <select class="form-control receiver-select" name="resp_person[]">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                 <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                          <select class="form-control receiver-select" name="resp_person1[]">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                        <br>
                        <div class="inner-field-label">ไฟล์แนบ :</div>
                        <input type="file" class="form-control-file" name="attachment[]" style="font-size: 0.75rem;">
                        <input type="hidden" name="old_file_path[]" value="">
                    </td>
                    <td><input type="text" name="previous[]" placeholder="Previous"></td>
                    <td><input type="text" name="plan[]" placeholder="Plan"></td>
                    <td><input type="text" name="results[]" placeholder="Results"></td>
                    <td><textarea name="remarks[]" rows="3" placeholder="Remarks"></textarea></td>
                    <td>
                        <input type="hidden" name="no[]" value="{{ $i+1 }}" class="rowNo">
                        <button type="button" class="delete"><i class="fas fa-trash-alt"></i> ลบ</button>
                    </td>
                </tr>
                @endfor
                @endforelse
            </tbody>
        </table>
    </div>
    
    <button type="button" class="btn btn-indigo-add" id="addRowBtn"><i class="fas fa-plus mr-1"></i> เพิ่มแถวกิจกรรม</button>

<div class="signature-grid">
        <div class="row w-100 m-0">
            <!-- Reported by -->
            @if ($objcctive->docutype == "Monthly")
            <div class="col-md-6 mb-3">
                <div class="signature-item">
                    <label>Reported by:</label>
                    <select class="form-control receiver-select" name="reported_by">
                        <option value="NULL">ไม่ระบุ</option>
                        @foreach ($emp as $item)
                            <option value="{{ $item->ms_employee_fullname }}"
                                {{ (isset($objcctive->reported_by) && $objcctive->reported_by == $item->ms_employee_fullname) ? 'selected' : '' }}>
                                {{ $item->ms_employee_fullname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="signature-item mt-2">
                    <label>Date:</label>
                    <input type="date" name="reported_date" value="{{ old('reported_date', optional(\Carbon\Carbon::parse($objcctive->reported_date))->format('Y-m-d')) }}" required>
                </div>
            </div>  
            @else
             <div class="col-md-6 mb-3">
                <div class="signature-item">
                    <label>Reported by:</label>
                    <select class="form-control receiver-select" name="reported_by">
                        <option value="NULL">ไม่ระบุ</option>
                        @foreach ($emp as $item)
                            <option value="{{ $item->ms_employee_fullname }}">
                                {{ $item->ms_employee_fullname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="signature-item mt-2">
                    <label>Date:</label>
                    <input type="date" name="reported_date" value="{{ old('reported_date', optional(\Carbon\Carbon::parse($objcctive->reported_date))->format('Y-m-d')) }}" required>
                </div>
            </div>
            @endif
            <!-- Prepared by -->
            @if ($objcctive->docutype == "Semi-annual")               
                <div class="col-md-6 mb-3">
                    <div class="signature-item">
                        <label>Prepared by:</label>
                        <select class="form-control receiver-select" name="prepared_by">
                            <option value="NULL">ไม่ระบุ</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ (isset($objcctive->prepared_by) && $objcctive->prepared_by == $item->ms_employee_fullname) ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="signature-item mt-2">
                        <label>Date:</label>
                        <input type="date" name="prepared_date" value="{{ old('prepared_date', optional(\Carbon\Carbon::parse($objcctive->prepared_date))->format('Y-m-d')) }}" required>
                    </div>
                </div>
            @else
                <div class="col-md-6 mb-3">
                    <div class="signature-item">
                        <label>Prepared by:</label>
                        <select class="form-control receiver-select" name="prepared_by">
                            <option value="NULL">ไม่ระบุ</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="signature-item mt-2">
                        <label>Date:</label>
                        <input type="date" name="prepared_date" value="{{ old('prepared_date', optional(\Carbon\Carbon::parse($objcctive->prepared_date))->format('Y-m-d')) }}" required>
                    </div>
                </div>
            @endif
            

            <!-- Reviewed by -->
            @if ($objcctive->docutype == "Monthly")
                <div class="col-md-6 mb-3">
                    <div class="signature-item">
                        <label>Reviewed by:</label>
                        <select class="form-control receiver-select" name="reviewed_by">
                            <option value="NULL">ไม่ระบุ</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ (isset($objcctive->reviewed_by) && $objcctive->reviewed_by == $item->ms_employee_fullname) ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="signature-item mt-2">
                        <label>Date:</label>
                        <input type="date" name="reviewed_date" value="{{ old('reviewed_date', optional(\Carbon\Carbon::parse($objcctive->reviewed_date))->format('Y-m-d')) }}" required>
                    </div>
                </div>
            @else
                <div class="col-md-6 mb-3">
                    <div class="signature-item">
                        <label>Reviewed by:</label>
                        <select class="form-control receiver-select" name="reviewed_by">
                            <option value="NULL">ไม่ระบุ</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="signature-item mt-2">
                        <label>Date:</label>
                        <input type="date" name="reviewed_date" value="{{ old('reviewed_date', optional(\Carbon\Carbon::parse($objcctive->reviewed_date))->format('Y-m-d')) }}" required>
                    </div>
                </div>
            @endif
           
            <!-- Acknowledged by -->
            @if ($objcctive->docutype == "Semi-annual")
                <div class="col-md-6 mb-3">
                    <div class="signature-item">
                        <label>Acknowledged by:</label>
                        <select class="form-control receiver-select" name="acknowledged_by">
                            <option value="NULL">ไม่ระบุ</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}"
                                    {{ (isset($objcctive->acknowledged_by) && $objcctive->acknowledged_by == $item->ms_employee_fullname) ? 'selected' : '' }}>
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="signature-item mt-2">
                        <label>Date:</label>
                        <input type="date" name="acknowledged_date" value="{{ old('acknowledged_date', optional(\Carbon\Carbon::parse($objcctive->acknowledged_date))->format('Y-m-d')) }}" required>
                    </div>
                </div>
            @else
                 <div class="col-md-6 mb-3">
                    <div class="signature-item">
                        <label>Acknowledged by:</label>
                        <select class="form-control receiver-select" name="acknowledged_by">
                            <option value="NULL">ไม่ระบุ</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">
                                    {{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="signature-item mt-2">
                        <label>Date:</label>
                        <input type="date" name="acknowledged_date" value="{{ old('acknowledged_date', optional(\Carbon\Carbon::parse($objcctive->acknowledged_date))->format('Y-m-d')) }}" required>
                    </div>
                </div>
            @endif
            

            <!-- Approved by (จัดให้อยู่คู่กัน หรือเต็มแถวตามความเหมาะสม) -->
            <div class="col-md-6 mb-3">
                <div class="signature-item">
                    <label>Approved by:</label>
                    <select class="form-control receiver-select" name="approved_by">
                        <option value="NULL">ไม่ระบุ</option>
                        @foreach ($emp as $item)
                            <option value="{{ $item->ms_employee_fullname }}"
                                {{ (isset($objcctive->approved_by) && $objcctive->approved_by == $item->ms_employee_fullname) ? 'selected' : '' }}>
                                {{ $item->ms_employee_fullname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="signature-item">
                    <label>Date:</label>
                    <input type="date" name="approved_date" value="{{ old('approved_date', optional(\Carbon\Carbon::parse($objcctive->approved_date))->format('Y-m-d')) }}" required>
                </div>
            </div>
        </div>
    </div>

    <div class="actions">
        <button type="submit" class="primary-submit">อัปเดตข้อมูล</button>
    </div>
</div>
</form>
@endsection

@push('scriptjs')
<script>
$(document).ready(function () {
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const tableBody = document.querySelector('#objectiveTable tbody'); 
    const addRowBtn = document.getElementById('addRowBtn');

    function updateRowNumbers() {
        const rows = tableBody.querySelectorAll('tr');
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
            const hiddenInput = row.querySelector('.rowNo');
            if(hiddenInput) hiddenInput.value = index + 1;
        });
    }

    tableBody.addEventListener("click", function(e) {
        if (e.target.closest(".delete")) {
            const row = e.target.closest('tr');
            Swal.fire({
                title: 'ยืนยันการลบ?',
                text: "คุณแน่ใจหรือไม่ว่าต้องการลบแถวนี้?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    row.remove();
                    updateRowNumbers();
                }
            });
        }
    });

    // [แก้ไข]: ปรับแต่งฟังก์ชันเพิ่มแถวให้มีโครงสร้างของฟิลด์ note1, note2 และ attachment ครบถ้วน
    addRowBtn.addEventListener('click', () => {
        const rowCount = tableBody.rows.length + 1;
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${rowCount}</td>
            <td>
                <textarea name="description[]" rows="3" placeholder="Description of Activities"></textarea>
                <div class="inner-field-label">วัตถุประสงค์ :</div>
                <input class="form-control" name="note1[]" placeholder="วัตถุประสงค์">
                <div class="inner-field-label">สาเหตุ/แนวทางแก้ไข :</div>
                <input class="form-control" name="note2[]" placeholder="สาเหตุ/แนวทางแก้ไข">
            </td>
            <td>
                <select class="form-control receiver-select" name="resp_person[]">
                    <option value=""></option>
                    @foreach ($emp as $item)
                         <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                    @endforeach
                </select>
                 <select class="form-control receiver-select" name="resp_person1[]">
                            <option value=""></option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                            @endforeach
                        </select>
                <br>
                <div class="inner-field-label">ไฟล์แนบ :</div>
                <input type="file" class="form-control-file" name="attachment[]" style="font-size: 0.75rem;">
                <input type="hidden" name="old_file_path[]" value="">
            </td>
            <td><input type="text" name="previous[]" placeholder="Previous"></td>
            <td><input type="text" name="plan[]" placeholder="Plan"></td>
            <td><input type="text" name="results[]" placeholder="Results"></td>
            <td><textarea name="remarks[]" rows="3" placeholder="Remarks"></textarea></td>
            <td>
                <input type="hidden" name="no[]" value="${rowCount}" class="rowNo">
                <button type="button" class="delete"><i class="fas fa-trash-alt"></i> ลบ</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        $(newRow).find('.receiver-select').select2({
            placeholder: 'กรุณาเลือกพนักงาน',
            width: '100%'
        });
    });
});
// จัดการการคลิกปุ่มลบไฟล์เดิม (แบบเก็บเป็น Array Index)
$(document).on('click', '.remove-old-file', function () {
    const rowIndex = $(this).data('row');
    
    Swal.fire({
        title: 'ลบไฟล์แนบ?',
        text: "คุณต้องการลบไฟล์แนบนี้ใช่หรือไม่?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'ใช่, ลบเลย',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            // เซ็ตค่าเป็น 1 เพื่อบอก Controller ว่าให้ลบไฟล์นี้ทิ้ง
            $('#delete_file_' + rowIndex).val('1');
            
            // ซ่อนการแสดงผลแถวไฟล์เดิม
            $('#file-wrapper-' + rowIndex).fadeOut();
            
            Swal.fire({
                icon: 'success',
                title: 'ลบไฟล์สำเร็จ',
                text: 'ไฟล์จะถูกลบเมื่อกดอัปเดตข้อมูล',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
});
</script>
@endpush