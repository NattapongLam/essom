@extends('layouts.main')
@section('content')
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

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

<style>
body { 
    font-family: 'TH Sarabun New', sans-serif; 
    font-size: 18px; 
    background: #f4f6f8; 
    color: #333;
}
form { 
    margin: 20px auto; 
    width: 95%; 
    max-width: 2000px; 
    background: #ffffff; 
    padding: 30px 35px; 
    border-radius: 12px; 
    box-shadow: 0 4px 20px rgba(0,0,0,0.08); 
    border: 1px solid #e0e0e0;
}
.risk-block { 
    border: 1px solid #d1d5db; 
    border-radius: 10px; 
    margin-bottom: 30px; 
    background: #ffffff; 
    padding: 20px 25px; 
    box-shadow: 0 2px 10px rgba(0,0,0,0.03); 
    page-break-inside: avoid; 
}
.risk-header { 
    font-weight: bold; 
    background: #e6f0ff; 
    padding: 8px 10px; 
    border-radius: 6px; 
    margin-bottom: 15px; 
    color: #457dcbff;
}
.input_style { 
    width: 100%; 
    border: 1px solid #cbd5e1; 
    border-radius: 5px; 
    outline: none; 
    background: #f9fafb; 
    font-size: 16px; 
    padding: 5px 8px; 
    transition: all 0.2s ease-in-out;
}
.input_style:focus {
    border-color: #3b82f6;
    background: #ffffff;
    box-shadow: 0 0 5px rgba(59, 130, 246, 0.3);
}
.input_style[readonly] {
    background: #f3f4f6;
    color: #555;
    cursor: not-allowed;
}
.mini-table { 
    width: 100%; 
    border-collapse: collapse; 
    font-size: 15px; 
    margin: 6px 0; 
}
.mini-table th, .mini-table td { 
    border: 1px solid #cbd5e1; 
    padding: 5px; 
    text-align: center; 
}
.mini-table th { 
    background: #f0f4f8; 
    font-weight: 600; 
    color: #1e3a8a;
}
table { 
    border-collapse: separate !important; 
    border-spacing: 0 !important; 
    border: 1px solid #cbd5e1 !important; 
    width: 100%; 
    background: #ffffff; 
    border-radius: 8px; 
    overflow: hidden; 
    margin-top: 10px;
}
table td, table th { 
    border: 1px solid #cbd5e1 !important; 
    padding: 6px 10px; 
}
table td input.input_style { 
    font-size: 15px; 
    text-align: center; 
}
.btn-submit { 
    background: #2242abff; 
    color: #fff; 
    border: none; 
    border-radius: 8px; 
    padding: 10px 25px; 
    cursor: pointer; 
    font-size: 16px; 
    transition: background 0.2s ease-in-out;
}
.btn-submit:hover { 
    background: #6090deff; 
}
@media (max-width: 768px) {
    form { padding: 20px; }
    .risk-header h4 { font-size: 16px; }
    .input_style { font-size: 14px; }
    table td, table th { padding: 4px 6px; }
}
</style>

{{-- <form action="{{ route('assessrisk.update', $risks[0]['id'] ?? 0) }}" method="POST">
    @csrf
    @method('PUT') --}}

@foreach($risks as $i => $risk)
<div class="risk-block">
    <div class="risk-header">
        <center><h4>การประเมินความเสี่ยงและโอกาส</h4></center><br>
        อ้างอิง กระบวนการ / ระเบียบปฏิบัติ: 
        <input type="text" value="{{ $risk['process'] ?? '' }}" class="input_style" style="width:20%;" readonly>  
        เสนอโดย: 
        <input type="text" value="{{ $risk['proposed_by'] ?? '' }}" class="input_style" style="width:20%;" readonly>  
        วันที่: 
        <input type="date" value="{{ $risk['date'] ?? '' }}" class="input_style" style="width:15%;" readonly>
    </div>

    <table>
        <tr>
            <td colspan="6">
                <b>ประเด็นความเสี่ยง:</b><br>
                @foreach($risk['issues'] ?? [] as $issue)
                    <input type="text" value="{{ $issue ?? '' }}" class="input_style" readonly><br>
                @endforeach               
            </td>

            <td colspan="7">
                <table class="mini-table">
                    <tr>
                        <th>ก่อนประเมิน</th><th>I</th><th>L</th><th>Level</th><th>Result</th><th>By</th><th>Date</th>
                    </tr>
                    @foreach($risk['before_assess'] ?? [] as $bi => $before)
                    <tr>
                        <td>ครั้งที่ {{ $bi+1 }}</td>
                        <td>{{ $before['I'] ?? '' }}</td>
                        <td>{{ $before['L'] ?? '' }}</td>
                        <td>{{ $before['Level'] ?? '' }}</td>
                        <td>{{ $before['Result'] ?? '' }}</td>
                        <td>{{ $before['By'] ?? '' }}</td>
                        <td>{{ $before['Date'] ?? '' }}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <b>มาตรการลดความเสี่ยงและติดตาม:</b><br>
                @foreach($risk['measures'] ?? [] as $measure)
                    <input type="text" value="{{ $measure ?? '' }}" class="input_style" readonly><br>
                @endforeach
            </td>
            <td colspan="5">
                 <b>รับทราบโดย / วันที่:</b>
                <table class="mini-table">
                    @foreach($risk['mitigations'] ?? [] as $mitigation)
                    <tr>
                        <td>{{ $mitigation['text'] ?? '' }}</td>
                        <td>{{ $mitigation['date'] ?? '' }}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <b>สรุปผลการลดความเสี่ยง:</b><br>
                @foreach($risk['summary'] ?? [] as $summary)
                    <input type="text" value="{{ $summary ?? '' }}" class="input_style" readonly><br>
                @endforeach
            </td>
            <td colspan="5">
                <b>รับทราบโดย / วันที่:</b>
                <table class="mini-table">
                    @foreach($risk['dates'] ?? [] as $date)
                    <tr>
                        <td>{{ $date['text'] ?? '' }}</td>
                        <td>{{ $date['date'] ?? '' }}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="6">
                <b>การติดตาม:</b><br>
                @foreach($risk['follow_up'] ?? [] as $follow)
                    <input type="text" value="{{ $follow ?? '' }}" class="input_style"><br>
                @endforeach
            </td>
            <td colspan="2">
                <b>รับทราบโดย / วันที่:</b>
                <table class="mini-table">
                    @foreach($risk['acknowledged'] ?? [] as $ack)
                    <tr>
                        <td>{{ $ack['name'] ?? '' }}</td>
                        <td>{{ $ack['date'] ?? '' }}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
<tr>
<td colspan="4">
    <b>อนุมัติ / วันที่:</b>
    <table class="mini-table">
        @php
            $approvedList = $risk['approved'] ?? [['name'=>'','date'=>''], ['name'=>'','date'=>''], ['name'=>'','date'=>'']];
        @endphp

        @foreach($approvedList as $index => $approve)
        <tr>
            <td>
                <input 
                    type="text" 
                    name="risks[0][approved][{{ $index }}][name]" 
                    value="{{ $approve['name'] ?? '' }}" 
                    class="input_style" 
                    placeholder="ชื่อผู้อนุมัติ">
            </td>
            <td>
                <input 
                    type="date" 
                    name="risks[0][approved][{{ $index }}][date]" 
                    value="{{ $approve['date'] ?? '' }}" 
                    class="input_style">
            </td>
            <td>
                @if ($approve['name'] && $approve['status'] == "N")
                    @if ($approve['name'] == auth()->user()->name && $approve['status'] == "N")
                        <button type="submit" class="btn-submit"> อนุมัติ</button>
                        <a href="javascript:void(0)" class="btn btn-sm btn-info" onclick="confirmApp('{{ $risks[0]['id'] }}')">
                            อนุมัติ
                        </a>
                    @else
                    <span class="badge-warning">รออนุมัติ</span> 
                    @endif  
                @elseif( $approve['status'] == "Y")     
                    <span class="badge-success">อนุมัติ</span> 
                @endif             
            </td>
        </tr>
        @endforeach
    </table>
</td>

<td colspan="6">
    <table class="mini-table">
        <tr>
            <th>หลังประเมิน:</th><th>I</th><th>L</th><th>Level</th><th>Result</th><th>By</th><th>Date</th>
        </tr>
        @foreach($risk['after_assess'] ?? [] as $ai => $after)
        <tr>
            <td>ครั้งที่{{ $ai+1 }}</td>
            <td>
                <input type="text" 
                       name="risks[0][after_assess][{{ $ai }}][I]" 
                       value="{{ $after['I'] ?? '' }}" 
                       class="input_style" readonly>
            </td>
            <td>
                <input type="text" 
                       name="risks[0][after_assess][{{ $ai }}][L]" 
                       value="{{ $after['L'] ?? '' }}" 
                       class="input_style" readonly>
            </td>
            <td>
                <input type="text" 
                       name="risks[0][after_assess][{{ $ai }}][Level]" 
                       value="{{ $after['Level'] ?? '' }}" 
                       class="input_style" readonly>
            </td>
            <td>
                <input type="text" 
                       name="risks[0][after_assess][{{ $ai }}][Result]" 
                       value="{{ $after['Result'] ?? '' }}" 
                       class="input_style" readonly>
            </td>
            <td>
                <input type="text" 
                       name="risks[0][after_assess][{{ $ai }}][By]" 
                       value="{{ $after['By'] ?? '' }}" 
                       class="input_style" readonly>
            </td>
            <td>
                <input type="date" 
                       name="risks[0][after_assess][{{ $ai }}][Date]" 
                       value="{{ $after['Date'] ?? '' }}" 
                       class="input_style" readonly>
            </td>
        </tr>
        @endforeach
    </table>
</td>


        </tr>
    </table>
</div>
@endforeach

{{-- <div class="text-center mt-3">
    <button type="submit" class="btn-submit"> บันทึก</button>
    <a href="{{ route('assessrisk.index') }}" class="btn btn-secondary">ยกเลิก</a>
</div>
</form> --}}
@endsection
@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    document.querySelectorAll('input, textarea, select').forEach(el => {
        if (!el.name.startsWith('risks[0][approved]') && !el.name.startsWith('risks[0][after_assess]')) {
            el.setAttribute('readonly', true);
        }
    });

});
confirmApp = (refid) => {       
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
                url: `{{ url('/approvedAssessrisk') }}`,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "refid": refid
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
