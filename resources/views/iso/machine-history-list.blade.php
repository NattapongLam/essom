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
                    <h5>ESSOM CO.,LTD<br>คำขอแก้ไขประวัติเครื่องจักร<br>EQUIPMENT RECORD</h5>
                    <p class="text-right mb-0">F7132.2<br>9 Feb 17</p>
                    <p class="text-left">
                        <a href="{{ route('machine-history.create') }}" >เพิ่มข้อมูลใหม่</a>
                    </p>
                </div>
                <div class="card-body">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-sm text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ชื่อเครื่องจักร</th>
                                    <th>หมายเลข</th>
                                    <th>วันที่เริ่มใช้</th>
                                    <th>หน่วยงานที่รับผิดชอบ</th>
                                    <th>วัน/เดือน/ปี</th>
                                    <th>รายการซ่อม/เปลี่ยน</th>
                                    <th>ผู้ซ่อม</th>
                                    <th>หมายเหตุ</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($machines as $machine)
                                    @php
                                        $dates = json_decode($machine->repair_date, true) ?? [];
                                        $descriptions = json_decode($machine->repair_description, true) ?? [];
                                        $persons = json_decode($machine->repair_person, true) ?? [];
                                        $rows = max(count($dates), count($descriptions), count($persons), 1);
                                    @endphp

                                    @for($i = 0; $i < $rows; $i++)
                                        <tr>
                                            @if($i==0)
                                                <td rowspan="{{ $rows }}">{{ $no++ }}</td>
                                                <td rowspan="{{ $rows }}">{{ $machine->machine_name }}</td>
                                                <td rowspan="{{ $rows }}">{{ $machine->machine_number }}</td>
                                                <td rowspan="{{ $rows }}">{{ $machine->date_start }}</td>
                                                <td rowspan="{{ $rows }}">{{ $machine->department }}</td>
                                            @endif
                                            <td>{{ $dates[$i] ?? '' }}</td>
                                            <td>{{ $descriptions[$i] ?? '' }}</td>
                                            <td>{{ $persons[$i] ?? '' }}</td>
                                            @if($i==0)
                                                <td rowspan="{{ $rows }}">{{ $machine->remarks ?? '-' }}</td>
                                                <td rowspan="{{ $rows }}">
                                                    <a href="{{ route('machine-history.edit', $machine->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td rowspan="{{ $rows }}">
                                                    <form action="{{ route('machine-history.destroy', $machine->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบใช่หรือไม่?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endfor
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
    