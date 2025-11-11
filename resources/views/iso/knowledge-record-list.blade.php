@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'success',
    title: 'สำเร็จ!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#1e40af'
});
</script>
@endif

<div class="mt-4">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>ESSOM CO., LTD.</h2>
                    <h3>บันทึกความรู้องค์กร</h3>
                    <p class="text-left">
                        <a href="{{ route('knowledge-record.create') }}">เพิ่มข้อมูลใหม่</a>
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-sm text-center">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>จัดทำโดย</th>
                                    <th>หน่วยงาน</th>
                                    <th>ตำแหน่ง</th>
                                    <th>อนุมัติโดย</th>
                                    <th>วันที่ส่งต่อ</th>
                                    <th>แก้ไข</th>
                                    <th>อนุมัติ</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->department }}</td>
                                    <td>{{ $record->position }}</td>
                                    <td>{{ $record->NameCF ?? '-' }}</td>
                                    <td>{{ $record->approval_date ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('knowledge-record.edit', $record->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($record->approval_status == "N")
                                            @if($record->NameCF == auth()->user()->name)
                                                <a href="{{ route('knowledge-record.show', $record->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-check"></i>
                                                </a>                                               
                                            @else
                                                <span class="badge-warning">รออนุมัติ</span>
                                            @endif                                                                                                                        
                                        @elseif($record->approval_status == "Y")  
                                             <span class="badge-success">อนุมัติ</span> 
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('knowledge-record.destroy', $record->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการลบรายการนี้หรือไม่?')">
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
        "lengthMenu": [[10, 25, 50, -1],[10, 25, 50, "All"]],
        dom: 'Bfrtip',
        buttons: ['copy','csv','excel','pdf','print'],
        order: [[1, "asc"]],
        pagingType: "full_numbers"
    });
});
</script>
@endpush
