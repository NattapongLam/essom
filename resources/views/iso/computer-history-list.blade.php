@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="mt-4"><br>
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h5>ESSOM CO.,LTD<br>คำขอแก้ไขแบบ ประวัติคอมพิวเตอร์</h5>
                    <p class="text-right">F7530.1<br>1 Oct. 20</p>
                    <p class="text-left">
                        <a href="{{route('computer-history.create')}}">เพิ่มเอกสาร</a>
                    </p>              
                </div>
                <div class="card-body">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-sm text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User Name</th>
                                    <th>No</th>
                                    <th>Start Date</th>
                                    <th>Check by</th>
                                    <th>Acknowledged by</th>
                                    <th>แก้ไข</th>
                                    <th>อนุมัติ</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($histories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ $item->no_number }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>
                                        {{ $item->check_by ?? '-' }}<br>
                                        {{ $item->check_date ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $item->ack_by ?? '-' }}<br>
                                        {{ $item->ack_date ?? '-' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('computer-history.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('computer-history.show', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="confirmDel('{{ $item->id }}')">
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
        "lengthMenu": [[10, 25, 50, -1],[10, 25, 50, "All"]],
        dom: 'Bfrtip',
        buttons: ['copy','csv','excel','pdf','print'],
        order: [[1, "asc"]],
        pagingType: "full_numbers"
    });
});

function confirmDel(id){
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ !',
        text: 'คุณต้องการลบรายการนี้หรือไม่ ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ url('/computer-history/delete') }}`,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data){
                    if(data.status){
                        Swal.fire('สำเร็จ','ลบข้อมูลเรียบร้อยแล้ว','success').then(()=>location.reload());
                    } else {
                        Swal.fire('ไม่สำเร็จ','ลบข้อมูลไม่สำเร็จ','error');
                    }
                }
            });
        }
    });
}
</script>
@endpush
