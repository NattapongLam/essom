@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#1e40af'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'เกิดข้อผิดพลาด!',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc2626'
});
</script>
@endif

<style>
.form-container { background: #ffffff; border-radius: 12px; padding: 20px 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; margin-bottom: 25px; font-family: "Tahoma", sans-serif; font-size: 14px; }
h2 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 15px; font-size: 16px; }
input[type="text"], input[type="date"], textarea { border: 1px solid #94a3b8; border-radius: 5px; padding: 4px 6px; font-size: 13px; width: 100%; box-sizing: border-box; background-color: #f8fafc; margin-bottom: 10px; transition: 0.2s; }
.status-date { width: 150px; margin-left: 8px; }
input:focus, textarea:focus { border-color: #1e40af; box-shadow: 0 0 3px rgba(59,130,246,0.3); background-color: #ffffff; outline: none; }
textarea { min-height: 60px; }
label { display: block; font-weight: 500; margin-bottom: 4px; }
.checkbox-row input[type="date"] { width: 150px; }
.checkbox-row, .checkbox-row1 { display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 10px; }
.checkbox-row label, .checkbox-row1 label { display: flex; align-items: center; gap: 6px; font-size: 13px; }
.status-date { display: none; margin-left: 10px; padding: 3px 6px; font-size: 13px; }
.actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 15px; }
button.primary { background: linear-gradient(180deg, #1e3a8a, #3b82f6); color: white; border: none; padding: 6px 14px; border-radius: 6px; font-weight: 600; cursor: pointer; }
button.ghost { background: #cbd5e1; color: #000; border: none; padding: 6px 14px; border-radius: 6px; font-weight: 600; cursor: pointer; }
</style>

<div class="form-container">
    <h2>ESSOM CO.,LTD.</h2>
    <h2>แก้ไขใบส่งต่อความรู้องค์กร การประเมินผลและการทบทวน</h2>
     <p class="text-right mb-0">F7160.3<br>7 Nov 23</p>
    <form method="POST" action="{{ route('knowledge-transfer.update', $knowledgeTransfer->id) }}">
        @csrf
        @method('PUT')
        <div class="grid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;">
            <div>
                <label>ผู้ส่ง/ผู้ประเมิน ชื่อ</label>
                <input type="text" name="evaluator_name" value="{{ $knowledgeTransfer->evaluator_name }}" required>
            </div>
            <div>
                <label>หน่วยงาน</label>
                <input type="text" name="department" value="{{ $knowledgeTransfer->department }}">
            </div>
            <div>
                <label>ตำแหน่ง</label>
                <input type="text" name="position" value="{{ $knowledgeTransfer->position }}">
            </div>
            <div>
                <label>วันที่</label>
                <input type="date" name="record_date" value="{{ $knowledgeTransfer->record_date }}">
            </div>
            <div>
                <label>เอกสาร KM เลขที่</label>
                <input type="text" name="doc_no" value="{{ $knowledgeTransfer->doc_no }}">
            </div>
            <div>
                <label>อนุมัติเมื่อวันที่</label>
                <input type="date" name="approved_date" value="{{ $knowledgeTransfer->approved_date }}">
            </div>
            <div>
                <label>ความรู้องค์กรด้าน</label>
                <input type="text" name="organizational_knowledge" value="{{ $knowledgeTransfer->organizational_knowledge }}">
            </div>
            <div style="grid-column:span 2;">
                <label>เรื่อง</label>
                <input type="text" name="subject" value="{{ $knowledgeTransfer->subject }}">
            </div>
        </div> 
<label>2.1) สถานะการส่งต่อ-ถ่ายทอดองค์ความรู้</label>
<div class="checkbox-row">
    <label>
        <input type="checkbox" name="status_sent" value="ส่งต่อ-ถ่ายทอดแล้ว" class="status-checkbox"
        {{ $knowledgeTransfer->status_sent ? 'checked' : '' }}>
        ส่งต่อ-ถ่ายทอดแล้ว
    </label>
    <label>วันที่: 
        <input type="date" name="sent_date" value="{{ $knowledgeTransfer->sent_date }}" class="status-date" style="width:100px; display:inline-block;">
    </label>
</div>

<div class="checkbox-row">
    <label>
        <input type="checkbox" name="status_pending" value="ยังไม่ได้ส่งต่อ-ถ่ายทอด" class="status-checkbox"
        {{ $knowledgeTransfer->status_pending ? 'checked' : '' }}>
        ยังไม่ได้ส่งต่อ-ถ่ายทอด
    </label>
    <label>กำหนดวันที่ส่งต่อความรู้ให้แล้วเสร็จวันที่: 
        <input type="date" name="plan_send_date" value="{{ $knowledgeTransfer->plan_send_date }}" class="status-date" style="width:100px; display:inline-block;">
    </label>
</div>

<div class="checkbox-row">
    <label>
        <input type="checkbox" name="status_planning" value="อยู่ระหว่างแผนการส่งต่อความรู้" class="status-checkbox"
        {{ $knowledgeTransfer->status_planning ? 'checked' : '' }}>
        อยู่ระหว่างแผนการส่งต่อความรู้
    </label>
    <label>กำหนดกำหนดเสร็จ:  
        <input type="date" name="plan_complete_date" value="{{ $knowledgeTransfer->plan_complete_date }}" class="status-date" style="width:100px; display:inline-block;">
    </label>
</div>

        <div class="row">
            <label>2.2) วิธีการในการส่งต่อ-ถ่ายทอดความรู้</label>
            <input type="text" name="transfer_method" value="{{ $knowledgeTransfer->transfer_method }}">
        </div>

        <label>2.3) การประเมินผล</label>
        <div class="checkbox-row">
            <label>3.1 <input type="checkbox" name="eval_understanding_good" value="รับรู้และเข้าใจเป็นอย่างดี" {{ $knowledgeTransfer->eval_understanding_good ? 'checked' : '' }}>รับรู้และเข้าใจเป็นอย่างดี</label>
            <label><input type="checkbox" name="eval_understanding_partial" value="เข้าใจเป็นบางส่วน" {{ $knowledgeTransfer->eval_understanding_partial ? 'checked' : '' }}> เข้าใจเป็นบางส่วน</label>
            <label><input type="checkbox" name="eval_understanding_none" value="ยังไม่เข้าใจ" {{ $knowledgeTransfer->eval_understanding_none ? 'checked' : '' }}> ยังไม่เข้าใจ</label>
        </div>
        <div class="checkbox-row">
            <label>3.2<input type="checkbox" name="eval_result_pass" value="ผ่าน" {{ $knowledgeTransfer->eval_result_pass ? 'checked' : '' }}>ผ่าน</label>
            <label><input type="checkbox" name="eval_result_fail" value="ไม่ผ่าน" {{ $knowledgeTransfer->eval_result_fail ? 'checked' : '' }}> ไม่ผ่าน</label>
        </div>
        <div class="checkbox-row1">
            <label>3.3<input type="checkbox" name="eval_not_yet" value="ยังประเมินไม่ได้" {{ $knowledgeTransfer->eval_not_yet ? 'checked' : '' }}>ยังประเมินไม่ได้</label>
        </div>
        <div class="checkbox-row">
            <label>3.4<input type="checkbox" name="eval_not_done" value="ยังไม่ได้ประเมิน" {{ $knowledgeTransfer->eval_not_done ? 'checked' : '' }}>ยังไม่ได้ประเมิน</label>
        </div>
        <div>
            <label>3.5) กรณีที่ ยังไม่เข้าใจ/ไม่ผ่าน/ยังไม่ได้ประเมิน กำหนดวันประเมินอีกครั้ง วันที่ :</label>
            <input type="date" name="re_evaluate_date" value="{{ $knowledgeTransfer->re_evaluate_date }}">
        </div>

        <div class="row">
            <label>ข้อคิดเห็น / ข้อเสนอแนะจากหัวหน้างาน:</label>
            <textarea name="supervisor_comments">{{ $knowledgeTransfer->supervisor_comments }}</textarea>
        </div>

        <label>4) การทบทวนองค์ความรู้</label>
        <div class="checkbox-row">
            <label><input type="checkbox" name="review_current" value="องค์ความรู้นี้ยังสามารถใช้ได้ ณ ปัจจุบัน" {{ $knowledgeTransfer->review_current ? 'checked' : '' }}> องค์ความรู้นี้ยังสามารถใช้ได้ ณ ปัจจุบัน</label>
        </div> 
        <div class="checkbox-row">
            <label><input type="checkbox" name="review_outdated" value="อาจไม่เป็นปัจจุบันแล้ว / ไม่สอดคล้องกับงาน" {{ $knowledgeTransfer->review_outdated ? 'checked' : '' }}> อาจไม่เป็นปัจจุบันแล้ว / ไม่สอดคล้องกับงาน</label>
            <label>ควร<input type="checkbox" name="review_replace" value="ยกเลิกการนำไปใช้และจัดหาองค์ความรู้ใหม่แทน" {{ $knowledgeTransfer->review_replace ? 'checked' : '' }}> ยกเลิกการนำไปใช้และจัดหาองค์ความรู้ใหม่แทน</label>
        </div> 

        <div class="checkbox-row">
            <label>กรณีองค์ความรู้นี้ยังใช้ได้ ควรพิจารณาทบทวนองค์ความรู้นี้</label>
            <label><input type="checkbox" name="review_freq_monthly" value="ทุกๆเดือน" {{ $knowledgeTransfer->review_freq_monthly ? 'checked' : '' }}> ทุกๆเดือน</label>
            <label><input type="checkbox" name="review_freq_6months" value="ทุกๆ 6 เดือน" {{ $knowledgeTransfer->review_freq_6months ? 'checked' : '' }}> ทุกๆ 6 เดือน</label>
            <label><input type="checkbox" name="review_freq_yearly" value="ทุกๆ 1 ปี" {{ $knowledgeTransfer->review_freq_yearly ? 'checked' : '' }}> ทุกๆ 1 ปี</label>
            <label><input type="checkbox" name="review_freq_none" value="ไม่จำเป็นต้องทบทวนซ้ำ" {{ $knowledgeTransfer->review_freq_none ? 'checked' : '' }}> ไม่จำเป็นต้องทบทวนซ้ำ</label>
        </div>

        <div class="grid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;">
            <div>
                <label>อนุมัติโดย :</label>
                 <select class="form-control receiver-select" name="approved_by"  placeholder="กรุณาเลือก">
                        <option value=""></option>
                        @foreach ($list as $item)
                            <option value="{{ $item->ms_employee_fullname }}"
                                 {{ isset( $knowledgeTransfer->approved_by) &&   $knowledgeTransfer->approved_by == $item->ms_employee_fullname ? 'selected' : '' }}>
                                {{ $item->ms_employee_fullname }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="approved_status" value="Y">
            </div>
            <div>
                <label>วันที่ : </label>
                <input type="date" name="approved_date_final" value="{{ $knowledgeTransfer->approved_date_final }}">
            </div>
            <div></div>
        </div>

        <div class="actions">
            <a href="{{ route('knowledge-transfer.index') }}"><button type="button" class="ghost">ย้อนกลับ</button></a>
            <button type="reset" class="ghost">รีเซ็ต</button>
            <button type="submit" class="primary">บันทึกข้อมูล</button>
        </div>
    </form>
</div>
@endsection
@push('scriptjs')
<script>
$(document).ready(function () {
    // init select2 ให้กับ select ที่โหลดมาตั้งแต่แรก
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.status-checkbox');
    const dateInputs = document.querySelectorAll('.status-date');

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkboxes.forEach(cb => {
                    if (cb !== checkbox) cb.checked = false;
                });

                dateInputs.forEach(input => {
                    const parentCheckbox = input.closest('.checkbox-row').querySelector('.status-checkbox');
                    if (parentCheckbox !== checkbox) {
                        input.value = ''; 
                    }
                });
            }
        });
    });
});
</script>
@endpush  

