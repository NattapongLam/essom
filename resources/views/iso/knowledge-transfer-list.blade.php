@extends('layouts.main')
@section('content')
<!-- Sweet Alert CSS -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
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
                <h5>ESSOM CO.,LTD <br>ใบส่งต่อความรู้องค์กร การประเมินผลและการทบทวน</h5>
                <p class="text-right mb-0">F7160.3<br>7 Nov 23</p>
                <p class="text-left">
                    <a href="{{ route('knowledge-transfer.create') }}" >เพิ่มข้อมูลใหม่</a>
                </p>
            </div>
            <div class="card-body">             
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ผู้ส่ง / ผู้ประเมิน ชื่อ</th>
                                <th>หน่วยงาน</th>
                                <th>ตำแหน่ง</th>
                                <th>วันที่</th>
                                <th>เอกสาร KM เลขที่</th>
                                <th>อนุมัติเมื่อวันที่</th>
                                <th>ความรู้องค์กรด้าน</th>
                                <th>แก้ไข</th>
                                <th>อนุมัติ</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $record->evaluator_name }}</td>
                                <td>{{ $record->department }}</td>
                                <td>{{ $record->position }}</td>
                                <td>{{ $record->record_date }}</td>
                                <td>{{ $record->doc_no }}</td>
                                <td>{{ $record->approved_date }}</td>
                                <td>{{ $record->organizational_knowledge }}</td>
                                <td>
                                     <a href="{{ route('knowledge-transfer.edit', $record->id) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td>
                @if ($record->approved_status == "N")
                    @if ($record->approved_by == auth()->user()->name)
                        <a href="{{ route('knowledge-transfer.show', $record->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-check"></i>
                        </a>
                    @else
                        <span class="badge-warning">รออนุมัติ</span> 
                    @endif
                @elseif($record->approved_status == "Y")
                    <span class="badge-success">อนุมัติ</span> 
                @endif
            </td>
            <td>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="confirmDel('{{ $record->id }}')">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach

        @if($records->isEmpty())
        <tr><td colspan="10" align="center">ไม่มีข้อมูล</td></tr>
        @endif
    </tbody>
</table>
                </div>
            </div>
    </div>
    </div>
</div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
$(document).ready(function() {
    var table = $('#tb_job').DataTable({
        pageLength: 50,
        lengthMenu: [[10,25,50,-1],[10,25,50,"All"]],
        dom: 'Bfrtip',
        buttons: ['copy','csv','excel','pdf','print'],
        order: [[0,"asc"]],
        fixedHeader: {header:false, footer:false},
        pagingType: "full_numbers",
        bSort: true
    });

    // Search input ถ้ามี
    $('#searchInput').on('input', function() {
        table.search(this.value).draw();
    });
});

function confirmDel(id) {
   Swal.fire({
    title: 'คุณแน่ใจหรือไม่ !',
    text: "คุณต้องการลบรายการนี้หรือไม่ ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'ยืนยัน',
    cancelButtonText: 'ยกเลิก',
    customClass: {
        confirmButton: 'btn btn-success mt-2',
        cancelButton: 'btn btn-danger ms-2 mt-2'
    },
    buttonsStyling: false
}).then((result) => {
    if (result.isConfirmed) {

            $.ajax({
                url: `{{ url('/knowledge-transfer') }}/${id}`,
                type: 'POST',
                data: {
                    "_method": "DELETE",
                    "_token": "{{ csrf_token() }}"
                },
                success: function() {
                    Swal.fire('สำเร็จ','ลบรายการเรียบร้อยแล้ว','success').then(()=>location.reload());
                },
                error: function() {
                    Swal.fire('ไม่สำเร็จ','ลบรายการไม่สำเร็จ','error');
                }
            });
        }
    });
}
</script>
@endsection
