@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5>การประเมินสมรรถนะของผู้ส่งมอบ/ผู้ขาย สำหรับสินค้าและบริการที่ใช้งาน</h5>
            </div>
             <div class="card-body">   
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อบริษัท</th>
                                <th>รายการ</th>
                                <th>คุณภาพการใช้งานของสินค้า</th>
                                <th>ความเรียบร้อยของสินค้า</th>
                                <th>บริการของผู้ขาย</th>
                                <th>การให้บริการหลังการขาย</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $key => $item)
                                <tr>
                                    <td>{{$key +1 }}</td>
                                    <td>{{$item->vendor_name}}</td>
                                    <td>{{$item->product_group_name}}</td>
                                    <td>{{$item->quality_status}}</td>
                                    <td>{{$item->neatness_status}}</td>
                                    <td>{{$item->vendor_service_status}}</td>
                                    <td>{{$item->after_sale_status}}</td>
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
</script>
@endpush  
    