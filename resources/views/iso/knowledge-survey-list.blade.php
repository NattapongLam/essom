@extends('layouts.main')
@section('content')
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="mt-4"><br>
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h5>ESSOM CO.,LTD<br>คำขอแก้ไขแบบสำรวจองค์กร</h5>
                    <p class="text-right mb-0">F6120.1<br>7 Nov 23</p>
                    <p class="text-left">

                        <a href="{{ route('knowledge-survey.create') }}" >เพิ่มข้อมูลใหม่</a>
                   </p>              
                </div>
                <div class="card-body">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-sm text-center">
                            <thead>
                                <tr>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อผู้สำรวจ</th>
                <th>หน่วยงาน</th>
                <th>วันที่</th>
                 <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
@foreach($surveys as $index => $s)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $s->surveyor_name }}</td>
        <td>{{ $s->department }}</td>
        <td>{{ $s->survey_date }}</td>
        <td>
            <a href="{{ route('knowledge-survey.edit', $s->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
            </a>
        </td>
        <td>
            <form action="{{ route('knowledge-survey.destroy', $s->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
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
<!-- Sweet Alerts js -->
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
                [0, "asc"]
            ],
            fixedHeader: {
                header:false,
                footer:false
            },
        pagingType: "full_numbers",
        bSort: true,    
    })
});
confirmDel = (refid) =>{       
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
            url: `{{ url('/cancelSoftwareDesignHd') }}`,
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "refid": refid
            },
            dataType: "json",
            success: function(data) {

                console.log(data);


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

    } else if ( // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel) {
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
    