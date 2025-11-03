@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="mt-4">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>ESSOM CO.,LTD.<br>คำขอแก้ไข Objective</h2>
                    <p class="text-right mb-0">F6200.1<br>9 Apr 24</p>
                    <p class="text-left">
                        <a href="{{ route('objcctives.create') }}">เพิ่มข้อมูลใหม่</a>
                    </p>    
                </div>

                <div class="card-body">             
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-sm text-center">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>SECTION</th>
                                    <th>FOR PERIOD.</th>
                                    <th>DESCRIPTION OF ACTIVITIES</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($objectives as $objective)
                                    @php
                                        $activities = $objective->activity_list ?? [];
                                    @endphp

                                    @foreach($activities as $act)
                                        <tr>
                                            <td>{{ $act['no'] ?? '' }}</td>
                                            <td>{{ $objective->section ?? '' }}</td>
                                            <td>{{ $objective->period ?? '' }}</td>
                                            <td>{{ $act['description'] ?? '' }}</td>
                                            <td>
                                                <a href="{{ route('objcctives.edit', $objective->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('objcctives.destroy', $objective->id) }}" method="POST" style="display:inline;">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- card-body -->
            </div> <!-- card -->
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
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        order: [[0, "asc"]],
        pagingType: "full_numbers",
    });
});
</script>
@endpush
