@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
.dt-buttons {
    margin-bottom: 50px; 
}
</style>
<div class="mt-4"><br>
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
    <h2 align="center">ESSOM CO., LTD. <br> คำขอแก้ไขแบบบำรุงรักษาอุปกรณ์IT</h2>
    <p class="text-right mb-0">F7134.2<br>12 jun </p>
                    <p class="text-left">
        <a href="{{ route('computer-records.create') }}" >เพิ่มข้อมูลใหม่</a>
                    </p>
      </div>
                <div class="card-body">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-sm text-center">
                            <thead>
            <tr>
                <th>NO</th>
                <th>For Asset Number</th>
                <th>User Name</th>
              <th>แก้ไข</th>
              <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->asset_number }}</td>
                <td>{{ $record->user_name }}</td>
                <td>{{ $record->period }}</td>
                </td>
        <td>
            <a href="{{ route('assessrisk.edit', $risk->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
            </a>
        </td>
        <td>
            <form action="{{ route('assessrisk.destroy', $risk->id) }}" method="POST" style="display:inline;">
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
                url: `{{ url('/cancelReference') }}`,
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
