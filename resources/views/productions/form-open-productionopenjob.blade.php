@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold">เอกสารเปิดงาน</h3><br><hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>สถานะ</th>
                            <th>กำหนดส่ง</th>
                            <th>วันที่</th>
                            <th>เลขที่ใบเปิดงาน</th>
                            <th>วันที่เริ่ม - จบ</th>
                            <th>ลูกค้า</th>
                            <th>สินค้า</th>
                            <th>Spec Page</th>
                            <th>รายละเอียด</th>
                            <th>ประมาณการต้นทุน</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td>{{$item->productionopenjob_status_name}}</td>
                                <td>{{\Carbon\Carbon::parse($item->productionnotice_dt_duedate)->format('d/m/Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($item->productionopenjob_hd_date)->format('d/m/Y')}}</td>
                                <td>{{$item->productionopenjob_hd_docuno}}</td>
                                <td>
                                    {{\Carbon\Carbon::parse($item->productionopenjob_hd_startdate)->format('d/m/Y')}} - 
                                    {{\Carbon\Carbon::parse($item->productionopenjob_hd_enddate)->format('d/m/Y')}}
                                </td>
                                <td>{{$item->ms_customer_name}}</td>
                                <td>{{$item->ms_product_name}} ({{$item->ms_product_qty}})</td>
                                <td>{{$item->ms_specpage_name}}</td>
                                <td>{{$item->productionnotice_dt_remark}}</td>
                                <td>{{number_format($item->productionopenjob_estimatecost,2)}}</td>
                                <td>
                                    @if($item->productionopenjob_status_id == 1 || $item->productionopenjob_status_id == 3)
                                    <a href="{{route('pd-open.edit',$item->productionopenjob_hd_id)}}" 
                                        class="btn btn-sm btn-warning" >
                                        <i class="fas fa-edit"></i>
                                      </a>
                                    @else
                                    <a href="javascript:void(0)" 
                                    class="btn btn-primary btn-sm" 
                                    data-toggle="modal" data-target="#modal"
                                    onclick="getDataOpen('{{ $item->productionopenjob_hd_id }}')">
                                    <i class="fas fa-eye"></i></a>
                                    @endif                                   
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายละเอียด</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">              
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>สถานะ</th>
                            <th>แผนก</th>
                            <th>ลำดับ</th>
                            <th>วันที่ต้องการ</th>                                  
                            <th>รหัสสินค้า</th>    
                            <th>ชื่อสินค้า</th>  
                            <th>หน่วยนับ</th>     
                            <th>จำนวน</th>      
                            <th>รายละเอียด</th>       
                            <th>ประมาณการต้นทุน</th>                                    
                        </tr>
                        </thead>
                        <tbody id="tb_list">
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scriptjs')
<script>
getDataOpen = (id) => {
$.ajax({
    url: "{{ url('/getData-Open') }}",
    type: "post",
    dataType: "JSON",
    data: {
        refid: id,
        _token: "{{ csrf_token() }}"      
    },    
    success: function(data) {
        console.log(data);
        let el_list = ''; 
        $.each(data.dt, function(key , item) {
            el_list += `    
             <tr>
                <td>${item.productionopenjob_status_name}</td>  
                <td>${item.ms_department_name}</td>  
                <td>${key+1}</td> 
                <td>${item.productionopenjob_dt_duedate}</td>  
                <td>${item.ms_product_code}</td>  
                <td>${item.ms_product_name}</td>  
                <td>${item.ms_product_unit}</td>  
                <td>${item.ms_product_qty}</td>  
                <td>${item.productionopenjob_dt_remark}</td>           
                <td>${item.estimatecost}</td>            
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
}
</script>
@endpush   