@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold">เอกสารแจ้งผลิต</h3><br><hr>
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>สถานะ</th>
                        <th>วันที่</th>
                        <th>เลขที่ใบแจ้งผลิต</th>
                        <th>กำหนดส่ง</th>
                        <th>ลูกค้า</th>
                        <th>สินค้า</th>
                        <th>Spec Page</th>
                        <th>รายละเอียด</th>
                        <th></th>
                    </tr>
                </thead>   
                <tbody>
                    @foreach ($hd as $item)
                    <tr>
                        <td>{{$item->productionnotice_status_name}}</td>
                        <td>{{\Carbon\Carbon::parse($item->productionnotice_hd_date)->format('d/m/Y')}}</td>
                        <td>{{$item->productionnotice_hd_docuno}}</td>
                        <td>{{\Carbon\Carbon::parse($item->productionnotice_hd_duedate)->format('d/m/Y')}}</td>
                        <td>{{$item->ms_customer_name}}</td>
                        <td>{{$item->ms_product_name}} : {{$item->product_qty}}/{{$item->ms_productunit_name}}</td>
                        <td>{{$item->ms_specpage_name}}</td>
                        <td>{{$item->productionnotice_hd_remark}}</td>
                        <td>
                            @if($item->productionnotice_status_id == 1)
                            <a href="{{route('pd-noti.edit',$item->productionnotice_hd_id)}}" 
                                class="btn btn-sm btn-warning" >
                                <i class="fas fa-edit"></i>
                              </a>                           
                            @else
                            <a href="javascript:void(0)" 
                            class="btn btn-primary btn-sm" 
                            data-toggle="modal" data-target="#modal"
                            onclick="getData('{{ $item->productionnotice_hd_id }}')">
                            <i class="fas fa-eye"></i></a>
                            @endif   
                        </td>
                    </tr> 
                    @endforeach                   
                </tbody>          
            </table>
            </div>
        </div>
        <div wire:loading wire:target="save" wire:loading.class="overlay" wire:loading.flex>
            <div class="d-flex justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
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
                <h5 class="modal-title">Optional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">              
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รหัสสินค้า</th>    
                            <th>ชื่อสินค้า</th>  
                            <th>หน่วยนับ</th>     
                            <th>จำนวน</th>      
                            <th>รายละเอียด</th>                                           
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
getData = (id) => {
$.ajax({
    url: "{{ url('/getData') }}",
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
                <td>${key+1}</td>
                <td>${item.ms_product_semicode}</td>  
                <td>${item.ms_product_seminame}</td>  
                <td>${item.ms_product_semiunit}</td>  
                <td>${item.ms_product_semiqty}</td>  
                <td>${item.productionnotice_dt_remark}</td>                      
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
}
</script>
@endpush