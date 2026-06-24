@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<div class="mt-2">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline border-top-0 shadow-sm rounded-lg">
                <div class="card-body p-4">
                    
                    <form method="GET" class="form-horizontal">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-12 col-xl-3 mb-3 mb-xl-0">
                                <h3 class="card-title text-dark mb-0" style="font-weight: 700; font-size: 1.35rem;">
                                    <i class="fas fa-clock text-indigo mr-2"></i> บันทึกชั่วโมงการทำงาน
                                </h3>
                            </div>
                            <div class="col-12 col-sm-3 col-xl-2.5 mb-3 mb-sm-0">
                                <div class="form-group row mb-0 align-items-center">
                                    <label for="datestart" class="col-sm-3 col-form-label text-muted font-weight-bold">วันที่</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-lg border-gray-300" name="datestart" id="datestart" value="{{$datestart}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-xl-2.5 mb-3 mb-sm-0">
                                <div class="form-group row mb-0 align-items-center">
                                    <label for="dateend" class="col-sm-3 col-form-label text-muted font-weight-bold">ถึง</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-lg border-gray-300" name="dateend" id="dateend" value="{{$dateend}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-xl-3 text-right">
                                <button class="btn btn-indigo px-3 shadow-sm font-weight-bold rounded-lg mr-1" type="submit">
                                    <i class="fas fa-search mr-1"></i> ค้นหา
                                </button>
                                <a href="{{route('pd-woho.create')}}" class="btn btn-success-indigo px-3 shadow-sm font-weight-bold rounded-lg">
                                    <i class="fas fa-plus-circle mr-1"></i> เพิ่มรายการ
                                </a>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4 border-gray-200">
                    
                    <div class="table-responsive">
                        <table class="table table-custom table-hover align-middle table-sm" id="tb_job" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center text-secondary py-3" style="width: 70px;">#</th>
                                    <th class="text-center text-secondary py-3" style="width: 110px;">วันที่</th>
                                    <th class="text-center text-secondary py-3" style="width: 110px;">สถานะ</th>                       
                                    <th class="text-center text-secondary py-3" style="width: 140px;">เลขที่เอกสาร</th>
                                    <th class="text-center text-secondary py-3">ผู้บันทึก</th>
                                    <th class="text-center text-secondary py-3">แผนก</th>
                                    <th class="text-secondary py-3">ชื่อพนักงาน</th>
                                    <th class="text-secondary py-3">หมายเหตุ</th>
                                    <th class="text-center text-secondary py-3" style="width: 125px;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                <tr>
                                    <td class="text-center text-secondary font-weight-bold">{{$item->workinghours_hd_id}}</td>
                                    <td class="text-center font-weight-bold text-secondary">{{\Carbon\Carbon::parse($item->workinghours_hd_date)->format('d/m/Y')}}</td>
                                    <td class="text-center font-weight-bold">
                                        <span class="badge badge-light-indigo px-2.5 py-1.5 rounded">
                                            {{$item->workinghours_status_name}}
                                        </span>
                                    </td>                       
                                    <td class="text-center text-primary font-weight-bold">{{$item->workinghours_hd_docuno}}</td>
                                    <td class="text-center text-muted"><i class="fas fa-user text-xs mr-1"></i> {{$item->created_person}}</td>
                                    <td class="text-center"><span class="font-weight-500 text-dark">{{$item->ms_department_name}}</span></td>
                                    <td><span class="font-weight-500 text-dark">{{$item->ms_employee_fullname}}</span></td>
                                    <td><span class="text-muted text-xs">{{$item->workinghours_hd_remark ?: '-'}}</span></td>                  
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @if($item->workinghours_status_id == 1)
                                            <a href="{{route('pd-woho.edit',$item->workinghours_hd_id)}}" class="btn btn-sm btn-action-edit shadow-sm mr-1" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-action-delete btn-sm shadow-sm mr-1" onclick="confirmDel('{{ $item->workinghours_hd_docuno }}','{{ $item->workinghours_hd_id }}')" title="ลบรายการ">
                                                <i class="fas fa-trash"></i>
                                            </a>                           
                                            @endif  
                                            <a href="javascript:void(0)" class="btn btn-sm btn-action-view shadow-sm" data-toggle="modal" data-target="#modal" onclick="getDataWoho('{{$item->workinghours_hd_id }}')" title="ดูรายละเอียด">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
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
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-xl">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark"><i class="fas fa-info-circle text-indigo mr-2"></i>รายละเอียดบันทึกชั่วโมงการทำงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-4">              
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle table-sm" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center text-secondary py-2" style="width: 80px;">ลำดับ</th>
                                <th class="text-center text-secondary py-2" style="width: 180px;">ประเภทงาน</th>
                                <th class="text-center text-secondary py-2" style="width: 200px;">เลขที่เอกสารงาน</th>  
                                <th class="text-secondary py-2">ชื่อ-นามสกุล พนักงาน</th>                                 
                                <th class="text-right text-secondary py-2" style="width: 150px;">จำนวนชั่วโมง</th>                                                                                  
                            </tr>
                        </thead>
                        <tbody id="tb_list"></tbody>
                    </table>
                </div>                                           
            </div>
            <div class="modal-footer border-top-0 px-4 pb-4">
                <button type="button" class="btn btn-light px-4 font-weight-bold rounded-lg border" data-dismiss="modal">ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* ธีมสีหลักระบบ Indigo */
    .text-indigo { color: #4f46e5 !important; }
    .btn-indigo {
        background-color: #4f46e5 !important;
        border-color: #4f46e5 !important;
        color: #ffffff !important;
    }
    .btn-indigo:hover {
        background-color: #4338ca !important;
        color: #ffffff !important;
    }
    .btn-success-indigo {
        background-color: #7c3aed !important;
        border-color: #7c3aed !important;
        color: #ffffff !important;
    }
    .btn-success-indigo:hover {
        background-color: #6d28d9 !important;
        color: #ffffff !important;
    }
    .rounded-xl { border-radius: 1rem !important; }
    
    /* สไตล์ปุ่ม Action ล้อมกรอบนุ่มนวล */
    .btn-action-edit { background-color: #fef3c7; color: #d97706; border-radius: 6px; }
    .btn-action-edit:hover { background-color: #fde68a; color: #b45309; }
    .btn-action-delete { background-color: #fee2e2; color: #dc2626; border-radius: 6px; }
    .btn-action-delete:hover { background-color: #fecaca; color: #b91c1c; }
    .btn-action-view { background-color: #e0e7ff; color: #4f46e5; border-radius: 6px; }
    .btn-action-view:hover { background-color: #c7d2fe; color: #3730a3; }
    
    /* ตารางโมเดิร์นดีไซน์ */
    .table-custom thead th {
        border-bottom: 2px solid #e2e8f0 !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.82rem;
        letter-spacing: 0.5px;
        background-color: #f8fafc;
    }
    .table-custom tbody tr { transition: all 0.2s; }
    .table-custom tbody tr:hover { background-color: #f1f5f9 !important; }
    .align-middle td { vertical-align: middle !important; }
    
    /* ตราสัญลักษณ์สถานะ */
    .badge-light-indigo {
        background-color: #e0e7ff;
        color: #4f46e5;
    }
    .font-weight-500 { font-weight: 500; }
</style>
@endsection

@push('scriptjs')
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
            { extend: 'copy', className: 'btn btn-sm btn-light border' },
            { extend: 'csv', className: 'btn btn-sm btn-light border' },
            { extend: 'excel', className: 'btn btn-sm btn-light border' },
            { extend: 'pdf', className: 'btn btn-sm btn-light border' },
            { extend: 'print', className: 'btn btn-sm btn-light border' }
        ],
        order: [
            [0, "desc"]
        ],
        fixedHeader: {
            header: false,
            footer: false
        },
        pagingType: "full_numbers",
        bSort: true, 
    })
}); 

const getDataWoho = (id) => {
    // เพิ่มการแจ้งโหลดเพื่อความเรียบเนียนในการใช้ modal
    $('#tb_list').html('<tr><td colspan="5" class="text-center text-muted">กำลังโหลดรายละเอียดความคืบหน้า...</td></tr>');
    
    $.ajax({
        url: "{{ url('/getData-Woho') }}",
        type: "post",
        dataType: "JSON",
        data: {
            refid: id,
            _token: "{{ csrf_token() }}"      
        },    
        success: function(data) {
            let el_list = ''; 
            if(data.dt && data.dt.length > 0) {
                $.each(data.dt, function(key , item) {
                    let doc_job = item.productionopenjob_hd_docuno ? item.productionopenjob_hd_docuno : '-';
                    el_list += `    
                     <tr>
                        <td class="text-center font-weight-bold text-secondary">${item.workinghours_dt_listno}</td>  
                        <td class="text-center"><span class="badge bg-light text-dark border px-2 py-1">${item.workinghours_type_name}</span></td>  
                        <td class="text-center font-weight-bold text-primary">${doc_job}</td>
                        <td><span class="font-weight-500">${item.ms_employee_fullname}</span></td>  
                        <td class="text-right text-indigo font-weight-bold">${parseFloat(item.workinghours_dt_hours).toFixed(2)} ชม.</td>                
                    </tr>
                    `;
                });
            } else {
                el_list = '<tr><td colspan="5" class="text-center text-danger">ไม่พบข้อมูลรายละเอียดชั่วโมงทำงานค้างในระบบ</td></tr>';
            }
            $('#tb_list').html(el_list);
        },
        error: function() {
            $('#tb_list').html('<tr><td colspan="5" class="text-center text-danger">เกิดข้อผิดพลาดในการโหลดข้อมูล</td></tr>');
        }
    });
}

const confirmDel = (docs, refid) => {       
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่ที่จะลบ ?',
        text: `ต้องการลบเอกสารเลขที่ ${docs} ใช่หรือไม่? สมาชิกจะไม่สามารถกู้คืนได้`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> ยืนยันการลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            confirmButton: 'btn btn-danger px-4 py-2 font-weight-bold rounded-lg shadow-sm mx-2',
            cancelButton: 'btn btn-light border px-4 py-2 text-secondary font-weight-bold rounded-lg mx-2'
        },
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
                    if (data.status == true) {
                        Swal.fire({
                            title: 'ลบข้อมูลสำเร็จ',
                            text: 'ระบบได้ทำลายและยกเลิกเอกสารดังกล่าวเรียบร้อยแล้ว',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            customClass: { confirmButton: 'btn btn-indigo px-4 rounded-lg' },
                            buttonsStyling: false
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'ไม่สามารถทำลายรายการเอกสารนี้ได้ กรุณาลองใหม่อีกครั้ง',
                            icon: 'error',
                            confirmButtonText: 'ปิด',
                            customClass: { confirmButton: 'btn btn-secondary px-4 rounded-lg' },
                            buttonsStyling: false
                        });
                    }
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'ยกเลิกคำสั่งเรียบร้อย',
                text: 'ข้อมูลชุดนี้ปลอดภัยและยังคงอยู่คงเดิมในระบบของคุณ :)',
                icon: 'info',
                confirmButtonText: 'รับทราบ',
                customClass: { confirmButton: 'btn btn-indigo px-4 rounded-lg' },
                buttonsStyling: false
            });
        }
    });
}
</script>
@endpush