@extends('layouts.main')
@section('content')
@push('styles')
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5>ESSOM CO.,LTD<br>ทะเบียนควบคุมเอกสาร (Documents Control Status)</h5><p class="text-right">F7530.1<br>1 Oct. 20</p>
                <p class="text-left">
                    <a href="{{route('document-register.create')}}">เพิ่มเอกสาร</a>
                </p>              
            </div>
            <div class="card-body">             
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th>สถานะ</th>
                                <th>ที่</th>
                                <th>Doc.</th>
                                <th>Deseription</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th>Rev.</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td>
                                            @if ($item->documentregisters_flag)
                                                <span class="badge bg-success">ใช้งาน</span>
                                            @else
                                                <span class="badge bg-danger">ไม่ใช้งาน</span>
                                            @endif
                                        </td>
                                        <td>{{$item->documentregisters_listno}}</td>
                                        <td>
                                            <a href="{{asset($item->documentregisters_file)}}" target=”_blank”>
                                            {{$item->documentregisters_docuno}}
                                            </a>
                                        </td>
                                        <td>{{$item->documentregisters_remark}}</td>
                                        <td>{{$item->documentregisters_rev01}}</td>
                                        <td>{{$item->documentregisters_rev02}}</td>
                                        <td>{{$item->documentregisters_rev03}}</td>
                                        <td>{{$item->documentregisters_rev04}}</td>
                                        <td>{{$item->documentregisters_rev05}}</td>
                                        <td>{{$item->documentregisters_rev06}}</td>
                                        <td>{{$item->documentregisters_rev07}}</td>
                                        <td>{{$item->documentregisters_rev08}}</td>
                                        <td>{{$item->documentregisters_rev09}}</td>
                                        <td>{{$item->documentregisters_rev10}}</td>
                                        <td>
                                            <a href="{{route('document-register.edit',$item->documentregisters_id)}}" class="btn btn-sm btn-warning" >
                                                <i class="fas fa-edit"></i>
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
                [1, "asc"]
            ],
            fixedHeader: {
                header:false,
                footer:false
            },
        pagingType: "full_numbers",
        bSort: true,    
    })
});
</script>
@endpush  
    