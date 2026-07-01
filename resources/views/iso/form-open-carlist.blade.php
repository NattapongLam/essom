@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Modern Indigo Theme Styles for CAR Report */
    .car-wrapper {
        font-family: 'Sarabun', 'Noto Sans Thai', sans-serif;
        padding: 1.5rem 0;
    }
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 25px rgba(79, 70, 229, 0.05) !important;
        background: #ffffff;
        margin-bottom: 2rem !important;
        overflow: hidden;
    }
    .card-header {
        background: #ffffff !important;
        padding: 1.5rem 1.75rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .card-title-main {
        font-size: 1.4rem !important;
        font-weight: 700 !important;
        color: #4f46e5 !important;
        margin: 0;
        display: flex;
        align-items: center;
    }
    .card-body {
        padding: 1.75rem !important;
    }
    
    /* Filter Form Controls */
    .form-label-custom {
        font-weight: 600 !important;
        color: #4b5563 !important;
        font-size: 0.9rem;
        margin-bottom: 0 !important;
    }
    .form-control {
        border-radius: 10px !important;
        border: 1.5px solid #e5e7eb !important;
        padding: 0.5rem 0.75rem !important;
        height: 40px !important;
        color: #1f2937 !important;
        background-color: #ffffff !important;
        transition: all 0.25s ease-in-out !important;
    }
    .form-control:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12) !important;
    }

    /* Modern Checkbox Design */
    .checkbox-container {
        display: inline-flex;
        align-items: center;
        margin-top: 8px;
        cursor: pointer;
    }
    .checkbox-container input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border: 1.5px solid #d1d5db;
        border-radius: 6px;
        background-color: #fff;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.5rem;
        transition: all 0.2s ease;
        position: relative;
    }
    .checkbox-container input[type="checkbox"]:checked {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }
    .checkbox-container input[type="checkbox"]:checked:after {
        content: '';
        position: absolute;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        top: 2px;
    }

    /* Premium Buttons */
    .btn-indigo-search {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        height: 40px;
        padding: 0 1.5rem !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15) !important;
        transition: all 0.2s ease !important;
        width: 100%;
    }
    .btn-indigo-search:hover {
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.25) !important;
        opacity: 0.95;
    }
    .btn-purple-create {
        background: #fafafa !important;
        color: #4f46e5 !important;
        border: 2px solid #4f46e5 !important;
        padding: 0.5rem 1.25rem !important;
        border-radius: 10px !important;
        font-weight: 700 !important;
        transition: all 0.2s ease !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 40px;
    }
    .btn-purple-create:hover {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
    }

    /* Action Buttons in Table */
    .btn-action-edit {
        background-color: #fef3c7 !important;
        color: #d97706 !important;
        border: none !important;
        border-radius: 8px !important;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        margin-right: 4px;
    }
    .btn-action-edit:hover {
        background-color: #d97706 !important;
        color: #ffffff !important;
    }
    .btn-action-delete {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
        border: none !important;
        border-radius: 8px !important;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }

    /* Modern Table Design */
    .table-responsive {
        border: none !important;
    }
    #tb_job {
        border-collapse: separate !important;
        border-spacing: 0 0px !important;
        width: 100% !important;
    }
    #tb_job thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 12px 16px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }
    #tb_job tbody tr {
        transition: all 0.2s ease;
    }
    #tb_job tbody tr:hover {
        background-color: #f5f3ff !important;
    }
    #tb_job tbody td {
        padding: 14px 16px !important;
        vertical-align: middle !important;
        color: #334155 !important;
        border-bottom: 1px solid #e2e8f0 !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
    }
    
    /* DataTables Custom Overrides */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px !important;
        border: 1.5px solid #e2e8f0 !important;
        padding: 0.4rem 0.75rem !important;
    }
    .dt-buttons .btn {
        background: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        margin-right: 4px;
    }
    .dt-buttons .btn:hover {
        background: #e2e8f0 !important;
    }
</style>

<div class="car-wrapper">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form method="GET" class="form-horizontal">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-12 col-xl-2 mb-3 mb-xl-0">
                                <h3 class="card-title-main">
                                    <i class="fas fa-folder-open mr-2"></i> เอกสาร CAR
                                </h3>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-3 col-xl-2 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <label for="datestart" class="form-label-custom mr-2 text-nowrap">วันที่</label>
                                    <input type="date" class="form-control" name="datestart" id="datestart" value="{{$datestart}}">
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-3 col-xl-2 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <label for="dateend" class="form-label-custom mr-2 text-nowrap">ถึง</label>
                                    <input type="date" class="form-control" name="dateend" id="dateend" value="{{$dateend}}">
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-2 col-xl-2 mb-3 mb-md-0">
                                <div class="checkbox-container">
                                    <input type="checkbox" id="checkboxPrimary1" name="ck_sta" {{ request('ck_sta') ? 'checked' : '' }}>
                                    <label for="checkboxPrimary1" class="form-label-custom m-0">รออนุมัติ</label>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-2 col-xl-2 mb-3 mb-md-0">
                                <button class="btn btn-indigo-search" type="submit">
                                    <i class="fas fa-search mr-1"></i> ค้นหา
                                </button>
                            </div>
                            
                            <div class="col-12 col-md-2 col-xl-2 text-md-right ml-auto">
                                <a href="{{route('car-report.create')}}" class="btn btn-purple-create">
                                    <i class="fas fa-plus-circle mr-1"></i> สร้างเอกสาร
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="tb_job">
                            <thead>
                                <tr>
                                    <th>สถานะ</th>
                                    <th>วันที่</th>
                                    <th>อ้างถึง</th>
                                    <th>เลขที่</th>
                                    <th>ผู้แก้ปัญหา</th>
                                    <th>ข้อบกพร่องที่พบ</th>
                                    <th class="text-center" style="width: 90px;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd as $item)
                                    <tr>
                                        <td>
                                            <span class="badge badge-pill padding-custom {{ $item->iso_status_name == 'อนุมัติ' ? 'badge-success' : 'badge-warning' }}" style="padding: 6px 12px; font-size: 0.85rem;">
                                                {{$item->iso_status_name}}
                                            </span>
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($item->troublemaker_date)->format('Y/m/d')}}</td>
                                        <td>{{$item->iso_car_refertype}}</td>
                                        <td class="font-weight-bold" style="color: #4f46e5;">{{$item->iso_car_docuno}}</td>
                                        <td>{{$item->problem_by}}</td>
                                        <td>{{$item->found_bugs}}</td>
                                        <td class="text-center">
                                            <a href="{{route('car-report.edit',$item->iso_car_id)}}" class="btn-action-edit" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn-action-delete" title="ลบ"
                                               onclick="confirmDel('{{ $item->iso_car_docuno }}','{{ $item->iso_car_id }}')">
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
            columnDefs: [{
                targets: 1,
                type: 'time-date-sort'
            }],
            order: [
                [3, "desc"]
            ],
            fixedHeader: {
                header: false,
                footer: false
            },
            pagingType: "full_numbers",
            bSort: true,
            language: {
                search: "ค้นหาแนวราบ:",
                lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
                zeroRecords: "ไม่พบข้อมูลที่ค้นหา",
                info: "แสดงหน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",
                infoEmpty: "ไม่มีข้อมูลที่มีอยู่",
                infoFiltered: "(กรองข้อมูลจากทั้งหมด _MAX_ รายการ)"
            }
        });
    });

    confirmDel = (docs, refid) => {       
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่ !',
            text: `คุณต้องการลบรายการ CAR เลขที่ ${docs} นี้หรือไม่ ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ใช่, ฉันต้องการลบ',
            cancelButtonText: 'ยกเลิก',
            customClass: {
                confirmButton: 'btn btn-indigo-search mx-2',
                cancelButton: 'btn btn-secondary mx-2'
            },
            buttonsStyling: true
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: `{{ url('/cancelDocsCar') }}`,
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
                                title: 'สำเร็จ',
                                text: 'ยกเลิกเอกสารเรียบร้อยแล้ว',
                                icon: 'success',
                                confirmButtonColor: '#4f46e5'
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'ไม่สำเร็จ',
                                text: 'ยกเลิกเอกสารไม่สำเร็จ',
                                icon: 'error',
                                confirmButtonColor: '#4f46e5'
                            });
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'ยกเลิกแล้ว',
                    text: 'เอกสารของคุณยังคงปลอดภัย :)',
                    icon: 'info',
                    confirmButtonColor: '#4f46e5'
                });
            }
        });
    } 
</script>
@endpush