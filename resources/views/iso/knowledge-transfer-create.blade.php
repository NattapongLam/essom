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
.form-container { 
    background: #ffffff; 
    border-radius: 12px; 
    padding: 20px 25px; 
    box-shadow: 0 4px 15px rgba(0,0,0,0.08); 
    border: 1px solid #e0e0e0; 
    margin-bottom: 25px; 
    font-family: "Tahoma", sans-serif; 
    font-size: 14px; 
}
h2 { 
    text-align: center; 
    font-weight: 700; 
    color: #0f172a; 
    margin-bottom: 15px; 
    font-size: 16px; 
}
input[type="text"], input[type="date"], textarea { 
    border: 1px solid #94a3b8; 
    border-radius: 5px; 
    padding: 4px 6px; 
    font-size: 13px; 
    width: 100%; 
    box-sizing: border-box; 
    background-color: #f8fafc; 
    margin-bottom: 10px; 
    transition: 0.2s; 
}
input:focus, textarea:focus { 
    border-color: #1e40af; 
    box-shadow: 0 0 3px rgba(59,130,246,0.3); 
    background-color: #ffffff; 
    outline: none; 
}
textarea { min-height: 60px; }
label { display: block; font-weight: 500; margin-bottom: 4px; }
.checkbox-row, .checkbox-row1 { 
    display: flex; 
    flex-wrap: wrap; 
    gap: 15px; 
    margin-bottom: 10px; 
}
.checkbox-row label, .checkbox-row1 label { 
    display: flex; 
    align-items: center; 
    gap: 6px; 
    font-size: 13px; 
}
.status-date {  
    width: 150px; margin-left: 8px; 
}
.actions { 
    display: flex; 
    gap: 12px; 
    justify-content: flex-end; 
    margin-top: 15px; 
}
button.primary { 
    background: linear-gradient(180deg, #1e3a8a, #3b82f6); 
    color: white; 
    border: none; 
    padding: 6px 14px; 
    border-radius: 6px; 
    font-weight: 600; 
    cursor: pointer; 
}
button.ghost { 
    background: #cbd5e1; 
    color: #000; 
    border: none; 
    padding: 6px 14px; 
    border-radius: 6px; 
    font-weight: 600; 
    cursor: pointer; 
}
</style>

<div class="form-container">
    <h2>ESSOM CO.,LTD.</h2>
    <h2>ใบส่งต่อความรู้องค์กร การประเมินผลและการทบทวน</h2>
     <p class="text-right mb-0">F7160.3<br>7 Nov 23</p>
    <form method="POST" action="{{ route('knowledge-transfer.store') }}">
        @csrf
        <div class="grid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;">
            <div>
                <label>ผู้ส่ง/ผู้ประเมิน ชื่อ</label>
                <input type="text" name="evaluator_name" value="{{$emp->ms_employee_fullname}}" placeholder="ผู้ส่ง/ผู้ประเมิน ชื่อ" required>
            </div>
            <div>
                <label>หน่วยงาน</label>
                <input type="text" name="department" value="{{$emp->ms_department_name}}" placeholder="หน่วยงาน">
            </div>
            <div>
                <label>ตำแหน่ง</label>
                <input type="text" name="position" value="{{$emp->ms_job_name}}" placeholder="ตำแหน่ง">
            </div>
            <div>
                <label>วันที่</label>
                <input type="date" name="record_date">
            </div>
            <div>
                <label>เอกสาร KM เลขที่</label>
                <input type="text" name="doc_no" placeholder="KM">
            </div>
            <div>
                <label>อนุมัติเมื่อวันที่</label>
                <input type="date" name="approved_date">
            </div>
            <div>
                <label>ความรู้องค์กรด้าน</label>
                <input type="text" name="organizational_knowledge" placeholder="ความรู้องค์กรด้าน">
            </div>
            <div style="grid-column:span 2;">
                <label>เรื่อง</label>
                <input type="text" name="subject" placeholder="เรื่อง">
            </div>
        </div> 

        <label>2.1) สถานะการส่งต่อ-ถ่ายทอดองค์ความรู้</label>
        <div class="checkbox-row">
            <label>
                <input type="checkbox" name="status_sent" value="ส่งต่อ-ถ่ายทอดแล้ว" class="status-checkbox">
                ส่งต่อ-ถ่ายทอดแล้ว
            </label>
            <label>วันที่: 
                <input type="date" name="sent_date" class="status-date" style="width:100px; display:inline-block;">
            </label>
        </div>

        <div class="checkbox-row">
            <label>
                <input type="checkbox" name="status_pending" value="ยังไม่ได้ส่งต่อ-ถ่ายทอด" class="status-checkbox" >
                ยังไม่ได้ส่งต่อ-ถ่ายทอด
            </label>
            <label>กำหนดวันที่ส่งต่อความรู้ให้แล้วเสร็จวันที่: 
                <input type="date" name="plan_send_date" class="status-date" style="width:100px; display:inline-block;">
            </label>
        </div>

        <div class="checkbox-row">
            <label>
                <input type="checkbox" name="status_planning" value="อยู่ระหว่างแผนการส่งต่อความรู้" class="status-checkbox">
                อยู่ระหว่างแผนการส่งต่อความรู้
            </label>
            <label>กำหนดกำหนดเสร็จ:  
                <input type="date" name="plan_complete_date" class="status-date" style="width:100px; display:inline-block;">
            </label>
        </div>

        <div class="row">
            <label>2.2) วิธีการในการส่งต่อ-ถ่ายทอดความรู้</label>
            <input type="text" name="transfer_method">
        </div>

        <label>2.3) การประเมินผล</label>
        <div class="checkbox-row">
            <label><input type="checkbox" name="eval_understanding_good" value="รับรู้และเข้าใจเป็นอย่างดี">รับรู้และเข้าใจเป็นอย่างดี</label>
            <label><input type="checkbox" name="eval_understanding_partial" value="เข้าใจเป็นบางส่วน"> เข้าใจเป็นบางส่วน</label>
            <label><input type="checkbox" name="eval_understanding_none" value="ยังไม่เข้าใจ"> ยังไม่เข้าใจ</label>
        </div>
        <div class="checkbox-row">
            <label><input type="checkbox" name="eval_result_pass" value="ผ่าน">ผ่าน</label>
            <label><input type="checkbox" name="eval_result_fail" value="ไม่ผ่าน"> ไม่ผ่าน</label>
        </div>
        <div class="checkbox-row1">
            <label><input type="checkbox" name="eval_not_yet" value="ยังประเมินไม่ได้">ยังประเมินไม่ได้</label>
        </div>
        <div class="checkbox-row">
            <label><input type="checkbox" name="eval_not_done" value="ยังไม่ได้ประเมิน">ยังไม่ได้ประเมิน</label>
        </div>

        <div>
            <label>3.5) กรณีที่ ยังไม่เข้าใจ/ไม่ผ่าน/ยังไม่ได้ประเมิน กำหนดวันประเมินอีกครั้ง วันที่ :</label>
            <input type="date" name="re_evaluate_date">
        </div>

        <div class="row">
            <label>ข้อคิดเห็น / ข้อเสนอแนะจากหัวหน้างาน:</label>
            <textarea name="supervisor_comments"></textarea>
        </div>

        <label>4) การทบทวนองค์ความรู้</label>
        <div class="checkbox-row">
            <label><input type="checkbox" name="review_current" value="องค์ความรู้นี้ยังสามารถใช้ได้ ณ ปัจจุบัน"> องค์ความรู้นี้ยังสามารถใช้ได้ ณ ปัจจุบัน</label>
        </div> 
        <div class="checkbox-row">
            <label><input type="checkbox" name="review_outdated" value="อาจไม่เป็นปัจจุบันแล้ว / ไม่สอดคล้องกับงาน"> อาจไม่เป็นปัจจุบันแล้ว / ไม่สอดคล้องกับงาน</label>
            <label>ควร<input type="checkbox" name="review_replace" value="ยกเลิกการนำไปใช้และจัดหาองค์ความรู้ใหม่แทน"> ยกเลิกการนำไปใช้และจัดหาองค์ความรู้ใหม่แทน</label>
        </div> 

        <div class="checkbox-row">
            <label>กรณีองค์ความรู้นี้ยังใช้ได้ ควรพิจารณาทบทวนองค์ความรู้นี้</label>
            <label><input type="checkbox" name="review_freq_monthly" value="ทุกๆเดือน"> ทุกๆเดือน</label>
            <label><input type="checkbox" name="review_freq_6months" value="ทุกๆ 6 เดือน"> ทุกๆ 6 เดือน</label>
            <label><input type="checkbox" name="review_freq_yearly" value="ทุกๆ 1 ปี"> ทุกๆ 1 ปี</label>
            <label><input type="checkbox" name="review_freq_none" value="ไม่จำเป็นต้องทบทวนซ้ำ"> ไม่จำเป็นต้องทบทวนซ้ำ</label>
        </div>

        <div class="grid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px;">
            <div>
                <label>อนุมัติโดย :</label>
                    <select class="form-control receiver-select" name="approved_by"  placeholder="กรุณาเลือก">
                        <option value=""></option>
                        @foreach ($list as $item)
                            <option value="{{ $item->ms_employee_fullname }}">
                                {{ $item->ms_employee_fullname }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="approved_status" value="N">
            </div>
            <div>
                <label>วันที่ : </label>
                <input type="date" name="approved_date_final">
            </div>
            <div></div>
        </div>

        <div class="actions">
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
</script>
@endpush  
