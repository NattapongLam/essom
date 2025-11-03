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

<style>
body { font-family: 'TH Sarabun New', sans-serif; font-size:18px; background:#f9f9f9; }
form { margin:20px auto; width:95%; max-width:1300px; background:#fff; padding:25px 30px; border:2px solid #333; border-radius:12px; box-shadow:0 3px 12px rgba(0,0,0,0.1); }
.risk-block { border:1px solid #999; border-radius:8px; margin-bottom:30px; background:#fefefe; padding:15px 20px; page-break-inside:avoid; }
.risk-header { font-weight:bold; background:#e3f2fd; padding:6px 8px; border-radius:4px; margin-bottom:10px; }
.input_style { width:100%; border:none; border-bottom:1px solid #000; outline:none; background:transparent; font-size:16px; padding:2px 4px; }
.mini-table { width:100%; border-collapse:collapse; font-size:15px; margin:4px 0; }
.mini-table th, .mini-table td { border:1px solid #000; padding:4px; text-align:center; }
.mini-table th { background:#f2f2f2; font-weight:bold; }
table { border-collapse:separate !important; border-spacing:0 !important; border:1px solid #333 !important; width:100%; background:#fff; border-radius:6px; overflow:hidden; }
table td, table th { border:1px solid #333 !important; padding:6px 8px; }
table td input.input_style { font-size:15px; text-align:center; }
.btn-submit { background:#1e40af; color:#fff; border:none; border-radius:8px; padding:8px 20px; cursor:pointer; }
.btn-submit:hover { background:#1c3aa0; }
</style>

<form method="POST" action="{{ route('assessrisk.update', $risk->id) }}">
    @csrf
    @method('PUT')

    <div class="risk-block">
        <div class="risk-header">
            <center><h4>การประเมินความเสี่ยงและโอกาส (Risk & Opportunity Assessment)</h4></center><br>
            กระบวนการ / ระเบียบปฏิบัติ: <input type="text" name="process" value="{{ $risk->process_ref }}" class="input_style" style="width:20%;">  
            เสนอโดย: <input type="text" name="proposed_by" value="{{ $risk->proposed_by }}" class="input_style" style="width:20%;">  
            วันที่: <input type="date" name="date" value="{{ $risk->proposed_date }}" class="input_style" style="width:15%;">
        </div>

        <table>
            <tr>
                <td colspan="6">
                    <b>ประเด็นความเสี่ยง:</b><br>
                    <input type="text" name="issues[0]" value="{{ $risk->risk_issue }}" class="input_style"><br>
                    <input type="text" name="issues[1]" value="{{ $risk->risk_cause }}" class="input_style"><br>
                    <input type="text" name="issues[2]" value="{{ $risk->risk_impact }}" class="input_style"><br>
                    <input type="text" name="issues[3]" value="{{ $risk->risk_accept_reason }}" class="input_style"><br>

                    <b>มาตรการลดความเสี่ยง:</b><br>
                    <input type="text" name="measures[0]" value="{{ $risk->mitigation_1 }}" class="input_style"><br>
                    <input type="text" name="measures[1]" value="{{ $risk->mitigation_2 }}" class="input_style"><br>
                    <input type="text" name="measures[2]" value="{{ $risk->mitigation_3 }}" class="input_style"><br>
                </td>

                <td colspan="7">
                    <table class="mini-table">
                        <tr>
                            <th>ก่อนประเมิน</th><th>I</th><th>L</th><th>Level</th><th>Result</th><th>By</th><th>Date</th>
                        </tr>
                        @for($i=1; $i<=3; $i++)
                        <tr>
                            <td>ครั้งที่ {{ $i }}</td>
                            <td><input type="text" name="before_assess[{{ $i }}][I]" value="{{ $risk->{'pre_i_'.$i} }}" class="input_style"></td>
                            <td><input type="text" name="before_assess[{{ $i }}][L]" value="{{ $risk->{'pre_l_'.$i} }}" class="input_style"></td>
                            <td><input type="text" name="before_assess[{{ $i }}][Level]" value="{{ $risk->{'pre_level_'.$i} }}" class="input_style"></td>
                            <td><input type="text" name="before_assess[{{ $i }}][Result]" value="{{ $risk->{'pre_result_'.$i} }}" class="input_style"></td>
                            <td><input type="text" name="before_assess[{{ $i }}][By]" value="{{ $risk->{'pre_by_'.$i} }}" class="input_style"></td>
                            <td><input type="date" name="before_assess[{{ $i }}][Date]" value="{{ $risk->{'pre_date_'.$i} }}" class="input_style"></td>
                        </tr>
                        @endfor
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    <b>สรุปผลการลดความเสี่ยง:</b><br>
                    <input type="text" name="summary[0]" value="{{ $risk->summary_1 }}" class="input_style"><br>
                    <input type="text" name="summary[1]" value="{{ $risk->summary_2 }}" class="input_style"><br>
                    <input type="text" name="summary[2]" value="{{ $risk->summary_3 }}" class="input_style"><br>
                </td>
                <td colspan="5">
                    <b>รับทราบโดย / วันที่:</b>
                    <table class="mini-table">
                        @for($i=1; $i<=3; $i++)
                        <tr>
                            <td><input type="text" name="dates[{{ $i }}][text]" value="{{ $risk->{'dates_'.$i.'_text'} ?? '' }}" class="input_style"></td>
                            <td><input type="date" name="dates[{{ $i }}][date]" value="{{ $risk->{'dates_'.$i.'_date'} ?? '' }}" class="input_style"></td>
                        </tr>
                        @endfor
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>การติดตาม:</b><br>
                    <input type="text" name="follow_up[0]" value="{{ $risk->followup_1 }}" class="input_style"><br>
                    <input type="text" name="follow_up[1]" value="{{ $risk->followup_2 }}" class="input_style"><br>
                    <input type="text" name="follow_up[2]" value="{{ $risk->followup_3 }}" class="input_style"><br>
                </td>
                <td colspan="2">
                    <b>รับทราบโดย / วันที่:</b>
                    <table class="mini-table">
                        @for($i=1; $i<=3; $i++)
                        <tr>
                            <td><input type="text" name="acknowledged[{{ $i }}][name]" value="{{ $risk->{'ack_by_'.$i} ?? '' }}" class="input_style"></td>
                            <td><input type="date" name="acknowledged[{{ $i }}][date]" value="{{ $risk->{'ack_date_'.$i} ?? '' }}" class="input_style"></td>
                        </tr>
                        @endfor
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <b>อนุมัติ / วันที่:</b>
                    <table class="mini-table">
                        @for($i=1; $i<=3; $i++)
                        <tr>
                            <td><input type="text" name="approved[{{ $i }}][name]" value="{{ $risk->{'approved_by_'.$i} ?? '' }}" class="input_style"></td>
                            <td><input type="date" name="approved[{{ $i }}][date]" value="{{ $risk->{'approved_date_'.$i} ?? '' }}" class="input_style"></td>
                        </tr>
                        @endfor
                    </table>
                </td>
                <td colspan="7">
                    <table class="mini-table">
                        <tr>
                            <th>ครั้งหลังประเมิน:</th><th>I</th><th>L</th><th>Level</th><th>Result</th><th>By</th><th>Date</th>
                        </tr>
                        @for($i=1; $i<=3; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><input type="text" name="after_assess[{{ $i }}][I]" value="{{ $risk->{'post_i_'.$i} }}" class="input_style"></td>
                            <td><input type="text" name="after_assess[{{ $i }}][L]" value="{{ $risk->{'post_l_'.$i} }}" class="input_style"></td>
                            <td><input type="text" name="after_assess[{{ $i }}][Level]" value="{{ $risk->{'post_level_'.$i} }}" class="input_style"></td>
                            <td><input type="text" name="after_assess[{{ $i }}][Result]" value="{{ $risk->{'post_result_'.$i} }}" class="input_style"></td>
                            <td><input type="text" name="after_assess[{{ $i }}][By]" value="{{ $risk->{'post_by_'.$i} }}" class="input_style"></td>
                            <td><input type="date" name="after_assess[{{ $i }}][Date]" value="{{ $risk->{'post_date_'.$i} }}" class="input_style"></td>
                        </tr>
                        @endfor
                    </table>
                </td>
            </tr>

        </table>
    </div>

    <div style="text-align:center; margin-top:10px;">
        <button type="submit" class="btn-submit">บันทึกทั้งหมด</button>
    </div>
</form>

@endsection
