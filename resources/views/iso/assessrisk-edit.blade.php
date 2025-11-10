@extends('layouts.main')
@section('content')

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
.input_style[readonly] { background-color: #f3f4f6; color: #6b7280; cursor: not-allowed; }
body { font-family: 'TH Sarabun New', sans-serif; font-size: 18px; background: #f4f6f8; color: #333; }
form { margin: 20px auto; width: 95%; max-width: 2000px; background: #ffffff; padding: 30px 35px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; }
.risk-block { border: 1px solid #d1d5db; border-radius: 10px; margin-bottom: 30px; background: #ffffff; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); page-break-inside: avoid; }
.risk-header { font-weight: bold; background: #e6f0ff; padding: 8px 10px; border-radius: 6px; margin-bottom: 15px; color: #457dcbff; }
.input_style { width: 100%; border: 1px solid #cbd5e1; border-radius: 5px; outline: none; background: #f9fafb; font-size: 16px; padding: 5px 8px; transition: all 0.2s ease-in-out; }
.input_style:focus { border-color: #3b82f6; background: #ffffff; box-shadow: 0 0 5px rgba(59, 130, 246, 0.3); }
.mini-table { width: 100%; border-collapse: collapse; font-size: 15px; margin: 6px 0; }
.mini-table th, .mini-table td { border: 1px solid #cbd5e1; padding: 5px; text-align: center; }
.mini-table th { background: #f0f4f8; font-weight: 600; color: #1e3a8a; }
table { border-collapse: separate !important; border-spacing: 0 !important; border: 1px solid #cbd5e1 !important; width: 100%; background: #ffffff; border-radius: 8px; overflow: hidden; margin-top: 10px; }
table td, table th { border: 1px solid #cbd5e1 !important; padding: 6px 10px; }
table td input.input_style { font-size: 15px; text-align: center; }
.btn-submit { background: #2242abff; color: #fff; border: none; border-radius: 8px; padding: 10px 25px; cursor: pointer; font-size: 16px; transition: background 0.2s ease-in-out; }
.btn-submit:hover { background: #6090deff; }
</style>

<form id="assessForm" method="POST" action="{{ route('assessrisk.update', $risk->id) }}">
    @csrf
    @method('PUT')

    @foreach($risks as $i => $risk)
    <div class="risk-block">
        <div class="risk-header">
            <center><h4>การประเมินความเสี่ยงและโอกาส (แก้ไข)</h4></center><br>
            อ้างอิง กระบวนการ / ระเบียบปฏิบัติ: 
            <input type="text" name="risks[{{ $i }}][process]" value="{{ $risk['process'] ?? '' }}" class="input_style" style="width:20%;">
            เสนอโดย: 
            <input type="text" name="risks[{{ $i }}][proposed_by]" value="{{ $risk['proposed_by'] ?? '' }}" class="input_style" style="width:20%;">
            วันที่: 
            <input type="date" name="risks[{{ $i }}][date]" value="{{ !empty($risk['date']) ? date('Y-m-d', strtotime($risk['date'])) : '' }}" class="input_style" style="width:15%;">
        </div>

        <table>
            <tr>
                <td colspan="6">
                    <b>ประเด็นความเสี่ยง:</b><br>
                    @foreach($risk['issues'] ?? ['', '', '', ''] as $pi => $issue)
                        <input type="text" name="risks[{{ $i }}][issues][{{ $pi }}]" value="{{ $issue }}" class="input_style"><br>
                    @endforeach

                    <b>มาตรการลดความเสี่ยงและติดตาม:</b><br>
                    @foreach($risk['measures'] ?? ['', '', ''] as $mi => $measure)
                        <input type="text" name="risks[{{ $i }}][measures][{{ $mi }}]" value="{{ $measure }}" class="input_style"><br>
                    @endforeach
                </td>

                <td colspan="7">
                    <table class="mini-table">
                        <tr>
                            <th>ก่อนประเมิน</th><th>I</th><th>L</th><th>Level</th><th>Result</th><th>By</th><th>Date</th>
                        </tr>
                        @foreach($risk['before_assess'] ?? [['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>''],['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>''],['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>'']] as $bi => $before)
                        <tr>
                            <td>ครั้งที่ {{ $bi+1 }}</td>
                            <td><input type="text" name="risks[{{ $i }}][before_assess][{{ $bi }}][I]" value="{{ $before['I'] }}" class="input_style"></td>
                            <td><input type="text" name="risks[{{ $i }}][before_assess][{{ $bi }}][L]" value="{{ $before['L'] }}" class="input_style"></td>
                            <td><input type="text" name="risks[{{ $i }}][before_assess][{{ $bi }}][Level]" value="{{ $before['Level'] }}" class="input_style"></td>
                            <td><input type="text" name="risks[{{ $i }}][before_assess][{{ $bi }}][Result]" value="{{ $before['Result'] }}" class="input_style"></td>
                            <td><input type="text" name="risks[{{ $i }}][before_assess][{{ $bi }}][By]" value="{{ $before['By'] }}" class="input_style"></td>
                            <td><input type="date" name="risks[{{ $i }}][before_assess][{{ $bi }}][Date]" value="{{ !empty($before['Date']) ? date('Y-m-d', strtotime($before['Date'])) : '' }}" class="input_style"></td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    <b>สรุปผลการลดความเสี่ยง:</b><br>
                    @foreach($risk['summary'] ?? ['', '', ''] as $si => $summary)
                        <input type="text" name="risks[{{ $i }}][summary][{{ $si }}]" value="{{ $summary }}" class="input_style"><br>
                    @endforeach

                    <b>การติดตาม :</b><br>
                    @foreach($risk['follow_up'] ?? ['', '', ''] as $fi => $fu)
                        <input type="text" name="risks[{{ $i }}][follow_up][{{ $fi }}]" value="{{ $fu }}" class="input_style"><br>
                    @endforeach
                </td>

                <td colspan="5">
                    <b>รับทราบโดย / วันที่:</b>
                    <table class="mini-table">
                        @foreach($risk['dates'] ?? [['text'=>'','date'=>''],['text'=>'','date'=>''],['text'=>'','date'=>'']] as $di => $date)
                        <tr>
                            <td>
                                <select class="form-control receiver-select" name="risks[{{ $i }}][dates][{{ $di }}][text]">
                                    <option value="">กรุณาเลือก</option>
                                    @foreach($emp as $item)
                                        <option value="{{ $item->ms_employee_fullname }}" {{ isset($date['text']) && $date['text'] == $item->ms_employee_fullname ? 'selected' : '' }}>
                                            {{ $item->ms_employee_fullname }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="date" name="risks[{{ $i }}][dates][{{ $di }}][date]" value="{{ !empty($date['date']) ? date('Y-m-d', strtotime($date['date'])) : '' }}" class="input_style">
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <b>รับทราบโดย / วันที่:</b>
                    <table class="mini-table">
                        @foreach($risk['acknowledged'] ?? [['name'=>'','date'=>''],['name'=>'','date'=>''],['name'=>'','date'=>'']] as $ai => $ack)
                        <tr>
                            <td><input type="text" name="risks[{{ $i }}][acknowledged][{{ $ai }}][name]" value="{{ $ack['name'] ?? '' }}" class="input_style"></td>
                            <td><input type="date" name="risks[{{ $i }}][acknowledged][{{ $ai }}][date]" value="{{ !empty($ack['date']) ? date('Y-m-d', strtotime($ack['date'])) : '' }}" class="input_style"></td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="4">
                    <b>อนุมัติ / วันที่:</b>
                    <table class="mini-table">
                        @foreach($risk['approved'] ?? [['name'=>'','date'=>''],['name'=>'','date'=>''],['name'=>'','date'=>'']] as $ap => $approve)
                        <tr>
                            <td><input type="text" name="risks[{{ $i }}][approved][{{ $ap }}][name]" value="{{ $approve['name'] ?? '' }}" class="input_style" readonly></td>
                            <td><input type="date" name="risks[{{ $i }}][approved][{{ $ap }}][date]" value="{{ !empty($approve['date']) ? date('Y-m-d', strtotime($approve['date'])) : '' }}" class="input_style" readonly></td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td colspan="7">
                    <table class="mini-table">
                        <tr>
                            <th>หลังประเมิน:</th><th>I</th><th>L</th><th>Level</th><th>Result</th><th>By</th><th>Date</th>
                        </tr>
                        @foreach($risk['after_assess'] ?? [['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>''],['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>''],['I'=>'','L'=>'','Level'=>'','Result'=>'','By'=>'','Date'=>'']] as $ai => $after)
                        <tr>
                            <td>ครั้ง{{ $ai+1 }}</td>
                            <td><input type="text" name="risks[{{ $i }}][after_assess][{{ $ai }}][I]" value="{{ $after['I'] }}" class="input_style" readonly></td>
                            <td><input type="text" name="risks[{{ $i }}][after_assess][{{ $ai }}][L]" value="{{ $after['L'] }}" class="input_style" readonly></td>
                            <td><input type="text" name="risks[{{ $i }}][after_assess][{{ $ai }}][Level]" value="{{ $after['Level'] }}" class="input_style" readonly></td>
                            <td><input type="text" name="risks[{{ $i }}][after_assess][{{ $ai }}][Result]" value="{{ $after['Result'] }}" class="input_style" readonly></td>
                            <td><input type="text" name="risks[{{ $i }}][after_assess][{{ $ai }}][By]" value="{{ $after['By'] }}" class="input_style" readonly></td>
                            <td><input type="date" name="risks[{{ $i }}][after_assess][{{ $ai }}][Date]" value="{{ !empty($after['Date']) ? date('Y-m-d', strtotime($after['Date'])) : '' }}" class="input_style" readonly></td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>

        </table>
    </div>
    @endforeach

    <div style="text-align:center; margin-top:10px;">
        <button type="submit" class="btn-submit">อัปเดตข้อมูล</button>
    </div>
</form>

@endsection

@push('scriptjs')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('.receiver-select').select2({
        placeholder: 'กรุณาเลือกพนักงาน',
        width: '100%'
    });

    const form = document.getElementById('assessForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'ยืนยันการแก้ไขข้อมูล?',
            text: 'ตรวจสอบข้อมูลก่อนยืนยันการบันทึก',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'อัปเดต',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                form.removeEventListener('submit', arguments.callee);
                form.submit();
            }
        });
    });
});
</script>
@endpush
