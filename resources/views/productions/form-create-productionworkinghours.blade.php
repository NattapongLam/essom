@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<div class="mt-4"><br>
<div class="row">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="col-12">
    <div class="card">
        <form method="POST" class="form-horizontal" action="{{ route('pd-woho.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-woho.index')}}">เอกสารบันทึกชั่วโมงการทำงาน</h3></a><br>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="workinghours_hd_date" class="col-sm-3 col-form-label">วันที่</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="workinghours_hd_date" id="workinghours_hd_date" class="form-control" value="{{date('Y-m-d')}}" autofocus readonly>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="workinghours_hd_docuno" class="col-sm-3 col-form-label">เลขที่</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="workinghours_hd_docuno" id="workinghours_hd_docuno" class="form-control" value="{{$docs}}"readonly>
                          <input type="hidden" name="workinghours_hd_number" id="workinghours_hd_number" value="{{$docs_number}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group row">
                        <label for="ms_department_id" class="col-sm-3 col-form-label">แผนก</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="ms_department_name" id="ms_department_name" class="form-control" value="{{$dep->ms_department_name}}"readonly>
                        <input type="hidden" name="ms_department_id" id="ms_department_id" value="{{$emp->ms_department_id}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                    </div>
                </div>
            </div>
            {{-- <div class="row"> --}}
                {{-- <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="ms_department_id">แผนก</label>
                        <select class="form-control select2 @error('ms_department_id') is-invalid @enderror" style="width: 100%;" name="ms_department_id" id="ms_department_id">
                            <option value="">กรุณาเลือก</option>
                            @foreach ($dep as $item)
                            <option value="{{$item->ms_department_id}}">{{$item->ms_department_name}}</option>
                            @endforeach
                        </select>
                            @error('ms_department_id')
                            <div id="ms_department_id_validation" class="invalid-feedback">
                              {{$message}}
                            </div>
                            @enderror
                    </div>
                </div> --}}
                {{-- <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workinghours_type">ประเภท</label>
                        <select class="form-control select2" style="width: 100%;" name="workinghours_type" id="workinghours_type">
                            <option selected="selected">กรุณาเลือก</option>
                            @foreach ($typ as $item)
                            <option value="{{$item->workinghours_type_name}}">{{$item->workinghours_type_name}}</option>
                            @endforeach
                          </select>
                    </div>
                </div> --}}
                {{-- <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="productionopenjob_dt_id">เลขที่เปิดงาน</label>
                        <select class="form-control select2 @error('productionopenjob_dt_id') is-invalid @enderror" style="width: 100%;" id="productionopenjob_dt_id" name="productionopenjob_dt_id">
                        <option value="">กรุณาเลือกเลขที่เปิดงาน</option>
                        @foreach ($jobdoc as $jobdoc)
                            <option value="{{ $jobdoc->productionopenjob_dt_id }}"
                                {{ old('productionopenjob_dt_id') == $jobdoc->productionopenjob_dt_id ? 'selected' : null }}>
                                {{ $jobdoc->productionopenjob_hd_docuno }} {{ $jobdoc->ms_product_name }} {{ $jobdoc->ms_customer_name }}</option>
                        @endforeach
                        </select>
                        @error('productionopenjob_dt_id')
                            <div id="productionopenjob_dt_id_docuno_validation" class="invalid-feedback">
                              {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="other_hours">ชั่วโมงอื่นๆ</label>
                        <input class="form-control" name="other_hours" id="other_hours" type="text" value="{{old('other_hours',0)}}">
                    </div>
                </div> --}}
            {{-- </div> --}}
            <div class="row">
                <div class="col-12 col-md-12">
                <div class="form-group">
                    <label for="workinghours_hd_remark">หมายเหตุ</label>
                    <input class="form-control" name="workinghours_hd_remark" id="workinghours_hd_remark" type="text">
                </div>
                </div>
            </div>
            <div class="row">             
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>เลือก</th>
                                    <th>ลำดับ</th>
                                    <th>เลขที่งาน</th>
                                    {{-- <th>ชื่อ - นามสกุล</th> --}}
                                    <th>ชั่วโมงทำงาน</th>
                                    <th>ชั่วโมงอื่นๆ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job as $key => $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="checkboxPrimary1" name="selected[]">
                                        </td>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->productionopenjob_hd_docuno}}</td>
                                        {{-- <td>{{Auth::user()->name}}</td> --}}
                                        <td>
                                            <input class="form-control" type="text" id="workinghours_dt_hours[]" name="workinghours_dt_hours[]" value="0">
                                            <input type="hidden" id="productionopenjob_hd_docuno[]" name="productionopenjob_hd_docuno[]" value="{{$item->productionopenjob_hd_docuno}}">
                                            <input type="hidden" id="workinghours_type_name[]" name="workinghours_type_name[]" value="{{$item->workinghours_type_name}}">
                                            {{-- <input type="hidden" id="emp_id[]" name="emp_id[]" value="{{$emp->ms_employee_id}}">
                                            <input type="hidden" id="ms_employee_code[]" name="ms_employee_code[]" value="{{$emp->ms_employee_code}}">
                                            <input type="hidden" id="ms_employee_fullname[]" name="ms_employee_fullname[]" value="{{$emp->ms_employee_fullname}}"> --}}
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" id="workinghours_dt_other[]" name="workinghours_dt_other[]" value="0">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="row">             
                <div class="col-12">
                <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr style="background-color:#F5F5F5">
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">รหัสพนักงาน</th>
                        <th class="text-center">ชื่อ - นามสกุล</th>   
                        <th class="text-center">จำนวนชั่วโมง</th>                    
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody id="tb_employeelist">
                </tbody>
                </table>
                </div>
                </div>
            </div><hr> --}}
            {{-- <div class="row">             
                <div class="col-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-Large-tab" data-toggle="pill" href="#custom-tabs-four-Large" role="tab" aria-controls="custom-tabs-four-Large" aria-selected="true">อุปกรณ์ใหญ่</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Small1-tab" data-toggle="pill" href="#custom-tabs-four-Small1" role="tab" aria-controls="custom-tabs-four-Small1" aria-selected="false">อุปกรณ์เล็ก1</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Small2-tab" data-toggle="pill" href="#custom-tabs-four-Small2" role="tab" aria-controls="custom-tabs-four-Small2" aria-selected="false">อุปกรณ์เล็ก2</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Elect-tab" data-toggle="pill" href="#custom-tabs-four-Elect" role="tab" aria-controls="custom-tabs-four-Elect" aria-selected="false">ไฟฟ้า</a>
                          </li> 
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Mach-tab" data-toggle="pill" href="#custom-tabs-four-Mach" role="tab" aria-controls="custom-tabs-four-Mach" aria-selected="false">กลึง</a>
                          </li> 
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Paint-tab" data-toggle="pill" href="#custom-tabs-four-Paint" role="tab" aria-controls="custom-tabs-four-Paint" aria-selected="false">ช่างสี</a>
                          </li> 
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Service-tab" data-toggle="pill" href="#custom-tabs-four-Service" role="tab" aria-controls="custom-tabs-four-Service" aria-selected="false">ซ่อมและบริการ</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Del-tab" data-toggle="pill" href="#custom-tabs-four-Del" role="tab" aria-controls="custom-tabs-four-Del" aria-selected="false">ส่งของ</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Store-tab" data-toggle="pill" href="#custom-tabs-four-Store" role="tab" aria-controls="custom-tabs-four-Store" aria-selected="false">พัสดุ</a>
                          </li> 
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-Design-tab" data-toggle="pill" href="#custom-tabs-four-Design" role="tab" aria-controls="custom-tabs-four-Design" aria-selected="false">ออกแบบ</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-ENG-tab" data-toggle="pill" href="#custom-tabs-four-ENG" role="tab" aria-controls="custom-tabs-four-ENG" aria-selected="false">วิศวกรโรงงาน</a>
                          </li> 
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                          <div class="tab-pane fade show active" id="custom-tabs-four-Large" role="tabpanel" aria-labelledby="custom-tabs-four-Large-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>                                         
                                        </tr>
                                    </thead>
                                    <tbody>     
                                        @foreach ($lar as $item)
                                            <tr>
                                                <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                                <td class="text-center">{{$item->ms_employee_code}}</td>
                                                <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                            </tr>
                                        @endforeach                                 
                                    </tbody>
                                </table>
                                </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-Small1" role="tabpanel" aria-labelledby="custom-tabs-four-Small1-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>                                         
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($sm1 as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                        </tr>
                                        @endforeach                                   
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-Small2" role="tabpanel" aria-labelledby="custom-tabs-four-Small2-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @foreach ($sm2 as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                        </tr>
                                        @endforeach                                     
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-Elect" role="tabpanel" aria-labelledby="custom-tabs-four-Elect-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @foreach ($ele as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                        </tr>
                                        @endforeach                                   
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-Mach" role="tabpanel" aria-labelledby="custom-tabs-four-Mach-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($mac as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                        </tr>
                                        @endforeach                                  
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-Paint" role="tabpanel" aria-labelledby="custom-tabs-four-Paint-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($pai as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                        </tr>
                                        @endforeach                                  
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-Service" role="tabpanel" aria-labelledby="custom-tabs-four-Service-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($ser as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                        </tr>
                                        @endforeach                                  
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-Del" role="tabpanel" aria-labelledby="custom-tabs-four-Del-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($del as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                        </tr>
                                        @endforeach                                  
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-Store" role="tabpanel" aria-labelledby="custom-tabs-four-Store-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($sto as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                        </tr>
                                        @endforeach                                  
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-Design" role="tabpanel" aria-labelledby="custom-tabs-four-Design-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($des as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
                                        </tr>
                                        @endforeach                                  
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="custom-tabs-four-ENG" role="tabpanel" aria-labelledby="custom-tabs-four-ENG-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">รหัสพนักงาน</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($eng as $item)
                                        <tr>
                                            <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->ms_employee_id}})"> </td>
                                            <td class="text-center">{{$item->ms_employee_code}}</td>
                                            <td class="text-center">{{$item->ms_employee_fullname}}</td>
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
            </div> --}}
        </div>
        </form>
    </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(function () {
    $('.select2').select2()
})
addTolist = (id) => {
        console.log(id)
        $.ajax({
            url: "{{ url('/getEmployee') }}",
            type: "POST",
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            dataType: "json",
            success: function(data) {               
            $numbertd = $('#tb_employeelist tr').length + 1;
            $('#tb_employeelist').append(`
            <tr style="background-color:#F8F8FF" class="${data.emp.ms_employee_id}">                 
            <td class="text-center"><input type="hidden" name="emp_id[]" value="${data.emp.ms_employee_id}">${$numbertd}</td>   
            <td class="text-center">${data.emp.ms_employee_code}</td>
            <td class="text-center">${data.emp.ms_employee_fullname}</td>
            <td class="text-center"><input type="text" class="form-control" name="emp_qty[]" value="0"></td>                          
            <td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeTolist('${data.emp.ms_employee_id}')"><i class="fas fa-trash"></i></button></td>
            </tr>
            `)                                                 
            }
        })
}
removeTolist = (reftr) => {
$('.' + reftr).remove()
}
</script>
@endpush        