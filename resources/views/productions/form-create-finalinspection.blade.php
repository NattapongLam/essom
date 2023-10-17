@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold">รายการรอดำเนินการ</h3><br><hr>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>วันที่</th>
                        <th>เลขที่ใบเปิดงาน</th>
                        <th>กำหนดส่ง</th>
                        <th>ลูกค้า</th>
                        <th>สินค้า</th>
                        <th>จำนวน</th>
                        <th>รายละเอียด</th>
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($item->productionopenjob_hd_date)->format('d/m/Y')}}</td>
                                <td>
                                    <a href="{{route('fl-form.edit',$item->productionopenjob_hd_id)}}">
                                        {{$item->productionopenjob_hd_docuno}}
                                    </a>                                  
                                </td>
                                <td>{{\Carbon\Carbon::parse($item->productionnotice_dt_duedate)->format('d/m/Y')}}</td>
                                <td>{{$item->ms_customer_name}}</td>
                                <td>{{$item->ms_product_name}}/{{$item->ms_product_code}}</td>
                                <td>{{$item->ms_product_qty}}</td>
                                <td>{{$item->productionnotice_dt_remark}} {{$item->productionopenjob_hd_remark}}</td>
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
<script>
</script>
@endpush   