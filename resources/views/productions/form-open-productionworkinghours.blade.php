@extends('layouts.main')
@section('content')
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <form method="GET" class="form-horizontal">
                @csrf
            <div class="row">
                <div class="col-12 col-md-2">
                    <h3 class="card-title" style="font-weight: bold">เอกสารบันทึกชั่วโมงการทำงาน</h3>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group row">
                        <label for="datestart" class="col-sm-3 col-form-label">วันที่</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="datestart" id="datestart" class="form-control" value="{{$datestart}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group row">
                        <label for="dateend" class="col-sm-3 col-form-label">ถึงวันที่</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="dateend" id="dateend" class="form-control" value="{{$dateend}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <button class="btn btn-info" type="submit">ค้นหา</button>
                </div>
                <div class="col-12 col-md-4" style="text-align: right">
                    <a href="{{route('pd-woho.create')}}" 
                class="btn btn-sm btn-success" >
                <i class="fas fa-file"> เพิ่มรายการ</i>
                </a>
                </div>
            </form>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="tb_job">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">วันที่</th>
                        <th class="text-center">สถานะ</th>                       
                        <th class="text-center">เลขที่</th>
                        <th class="text-center">ผู้บันทึก</th>
                        <th class="text-center">แผนก</th>
                        <th>พนักงาน</th>
                        <th>หมายเหตุ</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hd as $item)
                    <tr>
                        <td class="text-center">{{$item->workinghours_hd_id}}</td>
                        <td class="text-center">{{\Carbon\Carbon::parse($item->workinghours_hd_date)->format('d/m/Y')}}</td>
                        <td class="text-center">{{$item->workinghours_status_name}}</td>                       
                        <td class="text-center">{{$item->workinghours_hd_docuno}}</td>
                        <td class="text-center">{{$item->created_person}}</td>
                        <td class="text-center">{{$item->ms_department_name}}</td>
                        <td>{{$item->ms_employee_fullname}}</td>
                        <td>{{$item->workinghours_hd_remark}}</td>                  
                        <td class="text-center">
                            @if($item->workinghours_status_id == 1)
                            <a href="{{route('pd-woho.edit',$item->workinghours_hd_id)}}" 
                                class="btn btn-sm btn-warning" >
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm"  
                            onclick="confirmDel('{{ $item->workinghours_hd_docuno }}','{{ $item->workinghours_hd_id }}')">
                            <i class="fas fa-trash"></i></a>                           
                            @else                                                                               
                            @endif  
                            <a href="javascript:void(0)" 
                            class="btn btn-primary btn-sm" 
                            data-toggle="modal" data-target="#modal"
                            onclick="getDataWoho('{{$item->workinghours_hd_id }}')">
                            <i class="fas fa-eye"></i></a>
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
                            <th>ลำดับ</th>
                            <th>ประเภทงาน</th>
                            <th>เลขที่งาน</th>  
                            <th>พนักงาน</th>                                 
                            <th>ชั่วโมง</th>                                                  
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
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function() {
 $('#tb_job').DataTable({
            "pageLength": 20,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            // columnDefs: [{
            //     targets: 1,
            //     type: 'time-date-sort'
            // }],
            order: [
                [0, "desc"]
            ],
            fixedHeader: {
                header:false,
                footer:false
            },
        pagingType: "full_numbers",
        bSort: true, 
    })
}); 
getDataWoho = (id) => {
$.ajax({
    url: "{{ url('/getData-Woho') }}",
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
                <td>${item.workinghours_dt_listno}</td>  
                <td>${item.workinghours_type_name}</td>  
                <td>${item.productionopenjob_hd_docuno}</td>
                <td>${item.ms_employee_fullname}</td>   
                <td>${parseFloat(item.workinghours_dt_hours).toFixed(2)}</td>                
            </tr>
        `
        })      
        $('#tb_list').html(el_list);
    }
});
}
confirmDel = (docs,refid) =>{       
Swal.fire({
    title: 'คุณแน่ใจหรือไม่ !',
    text: `คุณต้องการลบรายการเบิกนี้หรือไม่ ?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'ยืนยัน',
    cancelButtonText: 'ยกเลิก',
    confirmButtonClass: 'btn btn-success mt-2',
    cancelButtonClass: 'btn btn-danger ms-2 mt-2',
    buttonsStyling: false
}).then(function(result) {
    if (result.value) {

        $.ajax({
            url: `{{ url('/cancelDocsMan') }}`,
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "docuno": docs,
                "refid": refid
            },
            dataType: "json",
            success: function(data) {

                console.log(data);


                if (data.status == true) {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'ยกเลิกเอกสารเรียบร้อยแล้ว',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'ไม่สำเร็จ',
                        text: 'ยกเลิกเอกสารไม่สำเร็จ',
                        icon: 'error'
                    });
                }
               
            }
        });

    } else if ( // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
            title: 'ยกเลิก',
            text: 'โปรดตรวจสอบข้อมูลอีกครั้งเพื่อความถูกต้อง :)',
            icon: 'error'
        });
    }
});

}

</script>
@endpush        