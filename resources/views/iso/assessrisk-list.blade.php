@extends('layouts.main')
@section('content')
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="mt-4"><br>
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h5>ESSOM CO.,LTD<br>การประเมินความเสี่ยงและโอกาส</h5>
                    <p class="text-right mb-0">F6120.1<br>15 Feb 22</p>
                    <p class="text-left">

                        <a href="{{ route('assessrisk.create') }}" >เพิ่มข้อมูลใหม่</a>
                   </p>              
                </div>
                <div class="card-body">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">กระบวนการ / ระเบียบ</th>
                                    <th class="text-center">เสนอโดย</th>
                                    <th class="text-center">วันที่</th>
                                    <th class="text-center">ประเด็นความเสี่ยง</th>
                                    <th class="text-center">แก้ไข</th>
                                    <th class="text-center">อนุมัติ</th>
                                    <th class="text-center">ลบ</th>
                                </tr>
                            </thead>
                           <tbody>
@foreach($risks as $i => $risk)
<tr>
    <td>{{ $risk->process_ref }}</td>
    <td class="text-center">{{ $risk->proposed_by }}</td>
    <td class="text-center">{{ $risk->proposed_date }}</td>
    <td>
        {{ $risk->risk_issue }}<br>
        {{ $risk->risk_cause }}<br>
        {{ $risk->risk_impact }}<br>
        {{ $risk->risk_accept_reason }}
    </td>
    <td class="text-center">
        <a href="{{ route('assessrisk.edit', $risk->id) }}" class="btn btn-sm btn-warning">
            <i class="fas fa-edit"></i>
        </a>
    </td>
    <td class="text-center">
        <a href="{{ route('assessrisk.show', $risk->id) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-check"></i>
        </a>
    </td>
    <td class="text-center">
        <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="confirmDel('{{ $risk->id }}')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>
@endforeach
</tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('#tb_job').DataTable({
        "pageLength": 50,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columnDefs: [{
            targets: 1,
            type: 'time-date-sort'
        }],
        order: [
            [1, "asc"]
        ],
        fixedHeader: {
            header:false,
            footer:false
        },
        pagingType: "full_numbers",
        bSort: true,    
    });
});

confirmDel = (refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: `คุณต้องการลบรายการนี้หรือไม่ ?`,
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
                url: `{{ url('/cancelAssessrisk') }}`,
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
                            text: 'ยกเลิกเอกสารเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ยกเลิกเอกสารไม่สำเร็จ',
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
