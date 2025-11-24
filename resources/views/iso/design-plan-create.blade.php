@extends('layouts.main')
@section('content')

@if(session('success'))
    <p style="color: green; text-align:center;">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color: red; text-align:center;">{{ session('error') }}</p>
@endif

<style>
.card, .form-container { background: #ffffff; border-radius: 18px; padding: 30px 40px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; margin: 40px auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 1200px; }
h2, h3 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 10px; }
h3 { font-weight: 500; }
.section-title { font-size: 18px; font-weight: 700; color: #1e293b; margin-top: 20px; margin-bottom: 10px; border-bottom: 2px solid #94a3b8; padding-bottom: 4px; }
label { font-weight: 600; color: #1e293b; margin-bottom: 4px; display: block; }
input, textarea, select { border: 1px solid #94a3b8; border-radius: 6px; padding: 8px 12px; font-size: 14px; width: 100%; box-sizing: border-box; background-color: #f8fafc; transition: 0.2s; }
input:focus, textarea:focus { border-color: #1e40af; box-shadow: 0 0 6px rgba(59,130,246,0.3); background-color: #ffffff; outline: none; }
textarea { resize: vertical; min-height: 120px; }
.row { display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 15px; align-items: flex-start; }
.row > div { flex: 1; min-width: 120px; display: flex; flex-direction: column; }
button.primary { background: linear-gradient(180deg, #1e3a8a, #3b82f6); color: white; border: none; padding: 10px 22px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s ease; }
button.primary:hover { transform: scale(1.05); }
.actions { display:flex; gap:12px; justify-content:flex-end; margin-top:20px; }
.reasons-container {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
    gap: 10px; 
}
.main-label {
    white-space: nowrap; 
}
.checkbox-group {
    display: flex;
    flex-wrap: wrap; 
    gap: 10px;
    align-items: center;
}

.checkbox-group label {
    display: flex;
    align-items: center;
    gap: 5px; 
}
.checkbox-group span:first-child {
    font-weight: 600;
}
.section-title-container { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
.section-title-container .section-title { font-weight: 1000; font-size: 16px; color: #0f172a; }
.section-title-container .date-inline { display: flex; align-items: center; gap: 6px; }
.section-title-container .date-inline input[type="date"] { border: 1px solid #94a3b8; border-radius: 6px; padding: 6px 10px; font-size: 14px; background-color: #f8fafc; transition: 0.2s; }
.section-title-container .date-inline input[type="date"]:focus { border-color: #1e40af; box-shadow: 0 0 6px rgba(59,130,246,0.3); background-color: #ffffff; outline: none; }
#pagination { text-align:center; margin:20px 0; }
#pagination button { padding: 6px 12px; margin:0 5px; border-radius: 6px; border:none; cursor:pointer; }
#pagination button:disabled { opacity:0.5; cursor:not-allowed; }
</style>

<form action="{{ route('design-plan.store') }}" method="POST" id="designForm">
@csrf
<div class="form-container">
    <center>
        <h4>ESSOM CO.,LTD. </h4>
        <h4>แผนการออกแบบผลิตภัณฑ์</h4>
        <h4>DESIGN REQUEST AND DESIGN PLANNING</h4>
    </center>

    <div class="section">
        <div class="section-title-container">
            <div class="section-title">1. Design Request</div>
            <div class="date-inline">
                <label for="design_request_date">Date:</label>
                <input type="date" name="design_request_date" id="design_request_date" value="{{ old('design_request_date') }}">
            </div>
        </div>
        <div class="row">
            <div>
                <label>1.1 Product:</label>
                <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="Product">
            </div>
            <div>
                <label>Model:</label>
                <input type="text" name="product_model" value="{{ old('product_model') }}" placeholder="Model">
            </div>
        </div>
        <div class="row">
            <div>
                <label>Description:</label>
                <input type="text" name="product_description" value="{{ old('product_description') }}" placeholder="Description">
            </div>
        </div>
       <div class="reasons-container">
    <label>1.2 Reasons:</label>
    <div class="checkbox-group">
        <label>Cost Price <input type="checkbox" name="reason_cost_price" value="1" {{ old('reason_cost_price') ? 'checked' : '' }}></label>
        <label>Picture for Catalog <input type="checkbox" name="reason_catalog_picture" value="1" {{ old('reason_catalog_picture') ? 'checked' : '' }}></label>
        <label>Drawing <input type="checkbox" name="reason_drawing" value="1" {{ old('reason_drawing') ? 'checked' : '' }}></label>
        <label>Prototype <input type="checkbox" name="reason_prototype" value="1" {{ old('reason_prototype') ? 'checked' : '' }}></label>
    </div>
</div>
        <div class="row">
            <div>
                <label>Other:</label>
                <input type="text" name="reason_other" value="{{ old('reason_other') }}" placeholder="Description">
            </div>
        </div>
        <label>1.3) Design Input:</label>
        <div class="row" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
            @for($i = 1; $i <= 8; $i++)
            <div>
                <label>{{ $i }})</label>
                <input type="text" name="design_input_{{ $i }}" value="{{ old('design_input_'.$i) }}" placeholder="Design">
            </div>
            @endfor
        </div>
    </div>
    <div class="section">
        <label>1.4 Reference:</label>
        <div class="row">
            <div style="display:flex; gap:10px; flex-wrap: wrap;">
                <div><label>Brand</label><input type="text" name="ref_brand1" value="{{ old('ref_brand1') }}" placeholder="Brand"></div>
                <div><label>Model</label><input type="text" name="ref_model1" value="{{ old('ref_model1') }}" placeholder="Model"></div>
                <div><label>Brand</label><input type="text" name="ref_brand2" value="{{ old('ref_brand2') }}" placeholder="Brand"></div>
                <div><label>Model</label><input type="text" name="ref_model2" value="{{ old('ref_model2') }}" placeholder="Model"></div>
            </div>            
        </div>
        <div class="row">
            <div class="col-6">
                <label for="iso_design_plan_file">ไฟล์แนบ(หากมี)</label>
                <input type="file" class="form-control-file" name="iso_design_plan_file" >
            </div> 
            <div class="col-6">
                <label for="iso_design_plan_link">Link(หากมี)</label>
                <input type="text" class="form-control" name="iso_design_plan_link" >
            </div> 
        </div>
        <div class="row">
            <div><label>1.5 Requested By</label><input type="text" name="requested_by" value="{{auth()->user()->name}}" readonly></div>
            <div><label>Date</label><input type="date" name="requested_date" value="{{ old('date', now()->format('Y-m-d')) }}"></div>
            <div><label>Reviewed By</label>
                <select class="form-control receiver-select" name="reviewed_by">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                </select>
                {{-- <input type="text" name="reviewed_by" value="{{ old('reviewed_by') }}"> --}}
                <input type="hidden" name="reviewed_status" value="N">
            </div>
            <div><label>Date</label><input type="date" name="reviewed_date" value="{{ old('reviewed_date') }}"></div>
        </div>
        <div class="row">
            <div><label>1.6 Approved By</label>
                <select class="form-control receiver-select" name="approved_by_request">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                </select>
                {{-- <input type="text" name="Approveds_by" value="{{ old('Approveds_by') }}"> --}}
                <input type="hidden" name="approved_status_request" value="N">
            </div>
            <div><label>Date</label><input type="date" name="approved_date_request" value="{{ old('approved_date_request') }}"></div>
        </div>

        <label>2. Design Planning</label>
        <div class="row">
            <div><label>2.1 Engineer</label>
                <select class="form-control receiver-select" name="engineer_desing">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                </select>
                {{-- <input type="text" name="Engineer_Desing" value="{{ old('Engineer_Desing') }}"> --}}
                <input type="hidden" name="engineer_desing_status" value="N">
            </div>
            <div><label>2.2 Senior Engineer</label>
                <select class="form-control receiver-select" name="senior_engineer">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                </select>
                {{-- <input type="text" name="senior_Engineer" value="{{ old('senior_Engineer') }}"> --}}
                <input type="hidden" name="senior_engineer_status" value="N">
            </div>
        </div>
    </div>
    <div class="section">
        <div class="row"><label>2.3 Due Date</label></div>
        @php
            $rows = [
                '2.3.1 Preliminary Design & Calculations' => ['plan_calc','act_calc'],
                '2.3.2 Design Review' => ['plan_review','act_review'],
                'Participants' => ['participants'],
                '2.3.3 Design Verification' => ['plan_verify','act_verify'],
                '2.3.4 Prototype Production' => ['plan_proto','act_proto'],
                '2.3.5 Validation' => ['plan_valid','act_valid'],
                '2.3.6 Final Design Approval' => ['plan_final','act_final'],
            ];
        @endphp
        @foreach ($rows as $label => $fields)
            <div class="row">
                <div style="flex:1; min-width:200px;"><label>{{ $label }}</label></div>
                @if(count($fields) === 1)
                    <div style="flex:1; min-width:200px;"><input type="text" name="{{ $fields[0] }}" value="{{ old($fields[0]) }}"></div>
                @else
                    <div style="flex:1; min-width:140px;"><input type="date" name="{{ $fields[0] }}" value="{{ old($fields[0]) }}"></div>
                    <div style="flex:1; min-width:140px;"><input type="date" name="{{ $fields[1] }}" value="{{ old($fields[1]) }}"></div>
                @endif
            </div>
        @endforeach

        <div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="flex: 1; display: flex; align-items: center;">
                <label style="width: 120px;">2.4 Planned By</label>
                <select class="form-control receiver-select" name="planned_by">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                </select>
                {{-- <input type="text" name="planned_by" value="{{ old('planned_by') }}" style="flex: 1; padding: 5px;"> --}}
                <input type="hidden" name="planned_status" value="N">
            </div>
            <div style="flex: 1; text-align: center;">Engineering Section</div>
            <div style="flex: 1; display: flex; align-items: center;">
                <label style="width: 50px;">Date</label>                
                <input type="date" name="planned_date_engineering" value="{{ old('planned_date_engineering') }}" style="flex: 1; padding: 5px;">
            </div>
        </div>
        <div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="flex: 1; display: flex; align-items: center;">
                <label style="width: 120px;"></label>
                <select class="form-control receiver-select" name="planned_marketing">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                </select>
                {{-- <input type="text" name="planned_marketing" value="{{ old('planned_marketing') }}" style="flex: 1; padding: 5px;"> --}}
                <input type="hidden" name="planned_marketing_status" value="N">
            </div>
            <div style="flex: 1; text-align: center;">Marketing Representative</div>
            <div style="flex: 1; display: flex; align-items: center;">
                <label style="width: 50px;">Date</label>
                <input type="date" name="planned_date_marketing" value="{{ old('planned_date_marketing') }}" style="flex: 1; padding: 5px;">
            </div>
        </div>
        <div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="flex: 1; display: flex; align-items: center;">
                <label style="width: 120px;"></label>
                 <select class="form-control receiver-select" name="planned_plant">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                </select>
                {{-- <input type="text" name="planned_plant" value="{{ old('planned_plant') }}" style="flex: 1; padding: 5px;"> --}}
                <input type="hidden" name="planned_plant_status" value="N">
            </div>
            <div style="flex: 1; text-align: center;">Plant Representative</div>
            <div style="flex: 1; display: flex; align-items: center;">
                <label style="width: 50px;">Date</label>
                <input type="date" name="planned_date_plant" value="{{ old('planned_date_plant') }}" style="flex: 1; padding: 5px;">
            </div>
        </div>
        <div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="flex: 1; display: flex; align-items: center;">
                <label style="width: 130px;">2.5 Approved By</label>
                  <select class="form-control receiver-select" name="approved_by">
                        <option value=""></option>
                        @foreach ($emp as $item)
                             <option value="{{ $item->ms_employee_fullname }}">{{ $item->ms_employee_fullname }}</option>
                        @endforeach
                </select>
                {{-- <input type="text" name="approved_by" value="{{ old('approved_by') }}" style="flex: 1; padding: 5px;"> --}}
                <input type="hidden" name="approved_status" value="N">
            </div>
            <div style="flex: 1;"></div>
            <div style="flex: 1; display: flex; align-items: center;">
                <label style="width: 50px;">Date</label>
                <input type="date" name="approved_date" value="{{ old('approved_date') }}" style="flex: 1; padding: 6px;">
            </div>
        </div>
    </div>

    <div id="pagination"></div>
    <div class="actions">
        <button type="submit" class="primary">บันทึกข้อมูล</button>
    </div>
</div>
</form>
@endsection
@push('scriptjs')
<script>
$(document).ready(function () {
    // init select2 ให้กับ select ที่โหลดมาตั้งแต่แรก
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือก',
        width: '100%'
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('designForm');
    const sections = Array.from(form.querySelectorAll('.section'));
    const submitBtn = form.querySelector('button[type="submit"]');
    const pagination = document.getElementById('pagination');
    const totalPages = sections.length;
    const steps = Array.from(document.querySelectorAll('.step'));
    let currentPage = 1;

    pagination.innerHTML = `
        <button type="button" id="prev-page">ก่อนหน้า</button>
        <span id="page-info"></span>
        <button type="button" id="next-page">ถัดไป</button>
    `;
    const prevBtn = document.getElementById('prev-page');
    const nextBtn = document.getElementById('next-page');
    const pageInfo = document.getElementById('page-info');

    function showPage(page) {
        sections.forEach((section, idx) => section.style.display = (idx === page-1) ? '' : 'none');
        submitBtn.style.display = (page === totalPages) ? '' : 'none';
        nextBtn.style.display = (page === totalPages) ? 'none' : '';
        prevBtn.disabled = page === 1;
        pageInfo.textContent = `หน้า ${page} / ${totalPages}`;
    
        steps.forEach((step, idx) => {
            step.classList.toggle('active', idx < page);
        });
    }

    prevBtn.addEventListener('click', () => { if(currentPage>1){currentPage--;showPage(currentPage);} });
    nextBtn.addEventListener('click', () => { if(currentPage<totalPages){currentPage++;showPage(currentPage);} });
    showPage(currentPage);

    form.addEventListener('submit', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'ยืนยันการบันทึกข้อมูล?',
            text: 'กรุณาตรวจสอบข้อมูลก่อนกดยืนยัน',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result)=>{ if(result.isConfirmed) form.submit(); });
    });
});
</script>
@endpush

