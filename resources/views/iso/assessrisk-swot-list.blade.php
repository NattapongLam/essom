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
                    <h2>ESSOM CO., LTD.<br>คำขอแก้ไขแบบฟอร์มการวิเคราะห์ความเสี่ยงต่อธุรกิจของบริษัท</h2>
                    <p class="text-left">
                        <a href="{{ route('assessrisk-swot.create') }}" >เพิ่มข้อมูลใหม่</a>
                    </p>
                </div>
                <div class="card-body">             
                    <div class="table-responsive">
                        <table id="swotTable" class="table table-bordered table-sm text-center">
                            <thead>
                                <tr>
                                    <th>วันที่ประชุม</th>
                                    <th>ผู้รายงาน</th>
                                    <th>Strengths</th>
                                    <th>Weaknesses</th>
                                    <th>Opportunities</th>
                                    <th>Threats</th>
                                    <th>แก้ไข</th>
                                    <th>อนุมัติ</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
@foreach($records as $record)
<tr>
    <td>{{ $record->meeting_date ? \Carbon\Carbon::parse($record->meeting_date)->format('Y-m-d') : '' }}</td>
    <td>{{ $record->report_by }}</td>
    
    <td>
        @php
            $strengths = json_decode($record->strength, true);
            if (!is_array($strengths)) $strengths = [];
            $strength_risks = array_column($strengths, 'risk');
        @endphp
        {{ implode(', ', $strength_risks) }}
    </td>

    <td>
        @php
            $weaknesses = json_decode($record->weakness, true);
            if (!is_array($weaknesses)) $weaknesses = [];
            $weakness_risks = array_column($weaknesses, 'risk');
        @endphp
        {{ implode(', ', $weakness_risks) }}
    </td>

    <td>
        @php
            $opportunities = json_decode($record->opportunity, true);
            if (!is_array($opportunities)) $opportunities = [];
            $opportunity_risks = array_column($opportunities, 'risk');
        @endphp
        {{ implode(', ', $opportunity_risks) }}
    </td>

    <td>
        @php
            $threats = json_decode($record->threat, true);
            if (!is_array($threats)) $threats = [];
            $threat_risks = array_column($threats, 'risk');
        @endphp
        {{ implode(', ', $threat_risks) }}
    </td>

    <td>
        <a href="{{ route('assessrisk-swot.edit', $record->id) }}" class="btn btn-sm btn-warning">
            <i class="fas fa-edit"></i>
        </a>
    </td>
    <td>
        <a href="{{ route('assessrisk-swot.show', $record->id) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-check"></i>
        </a>
    </td>
    <td>
        <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="confirmDel('{{ $record->id }}')">
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
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    function confirmDel(id) {
    if(confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/assessrisk-swot/${id}`; 

        const token = document.createElement('input');
        token.type = 'hidden';
        token.name = '_token';
        token.value = '{{ csrf_token() }}';
        form.appendChild(token);

        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        form.appendChild(method);

        document.body.appendChild(form);
        form.submit();
    }
}
$(document).ready(function() {
    $('#swotTable').DataTable({
        "pageLength": 50,
        "lengthMenu": [[10, 25, 50, -1],[10, 25, 50, "All"]],
        dom: 'Bfrtip',
        buttons: ['copy','csv','excel','pdf','print'],
        order: [[0, "desc"]],
        fixedHeader: true,
        pagingType: "full_numbers",
        bSort: true,    
    });
});
</script>
@endpush
