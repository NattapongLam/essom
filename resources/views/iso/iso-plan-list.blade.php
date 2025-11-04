@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5>ESSOM CO.,LTD<br>PLAN</h5>
                <p class="text-left">
                    <a href="{{ route('iso-plan.create') }}">+ เพิ่มเอกสาร</a>
                </p>              
            </div>

            <div class="card-body">             
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-sm text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Project</th>
                                <th>Responsible Section / Person</th>
                                <th>Description of Activities</th>
                                <th>Progress Review</th>
                                <th>Reviewed by</th>
                                <th>Reported by</th>
                                <th>Approved by</th>
                                <th>Acknowledged by</th>
                                <th>แก้ไข</th>
                                <th>อนุมัติ</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
@php $no = 1; @endphp
@forelse($records as $plan)
    @php $activities = json_decode($plan->activities, true) ?? []; @endphp
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $plan->project_name ?? '-' }}</td>
        <td>{{ $plan->responsible_section ?? '-' }}</td>
        <td>
            @if(count($activities) > 0)
                @foreach($activities as $act)
                    {{ $act['description'] ?? '-' }}<br>
                    <small>Responsible: {{ $act['responsible_person'] ?? '-' }}</small><br>
                @endforeach
            @else
                -
            @endif
        </td>
        <td>
            {{ $plan->prepared_progress_review ?? '-' }}
            @if(isset($plan->prepared_progress_date))
                ({{ \Carbon\Carbon::parse($plan->prepared_progress_date)->format('Y-m-d') }})
            @endif
        </td>
        <td>
            {{ $plan->reviewed_by ?? '-' }}
            @if(isset($plan->reviewed_date))
                ({{ \Carbon\Carbon::parse($plan->reviewed_date)->format('Y-m-d') }})
            @endif
        </td>
        <td>
            {{ $plan->reported_by ?? '-' }}
            @if(isset($plan->reported_date))
                ({{ \Carbon\Carbon::parse($plan->reported_date)->format('Y-m-d') }})
            @endif
        </td>
        <td>
             {{ $plan->approved_by ?? '-' }}
            @if(isset($plan->approved_date))
                ({{ \Carbon\Carbon::parse($plan->approved_date)->format('Y-m-d') }})
            @endif
        </td>
        <td>
             {{ $plan->acknowledged_by ?? '-' }}
            @if(isset($plan->acknowledged_date))
                ({{ \Carbon\Carbon::parse($plan->acknowledged_date)->format('Y-m-d') }})
            @endif
        </td>
        <td>
            <a href="{{ route('iso-plan.edit', $plan->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
            </a>
        </td>
        <td>
            <a href="{{ route('iso-plan.show', $plan->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-check"></i>
            </a>
        </td>
        <td>
            <form id="delete-form-{{ $plan->id }}" action="{{ route('iso-plan.destroy', $plan->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDel({{ $plan->id }})">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr><td colspan="12">ไม่พบข้อมูล</td></tr>
@endforelse
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
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        fixedHeader: { header: false, footer: false },
        pagingType: "full_numbers",
        bSort: true
    });
});

function confirmDel(id) {
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: 'คุณต้องการลบรายการนี้หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush
