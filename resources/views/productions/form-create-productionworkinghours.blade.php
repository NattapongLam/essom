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
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('pd-woho.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-woho.index')}}">เอกสารบันทึกชั่วโมงการทำงาน</h3></a>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="workinghours_hd_date" class="col-sm-2 col-form-label">วันที่</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="workinghours_hd_date" id="workinghours_hd_date" class="form-control" value="{{date('Y-m-d')}}"readonly>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group row">
                        <label for="workinghours_hd_docuno" class="col-sm-2 col-form-label">เลขที่</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="workinghours_hd_docuno" id="workinghours_hd_docuno" class="form-control" value="{{$docs}}"readonly>
                          <input type="hidden" name="workinghours_hd_number" id="workinghours_hd_number" value="{{$docs_number}}">
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
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="ms_department_id">แผนก</label>
                        <select class="form-control select2" style="width: 100%;" name="ms_department_id" id="ms_department_id">
                            <option selected="selected">กรุณาเลือก</option>
                            @foreach ($dep as $item)
                            <option value="{{$item->ms_department_id}}">{{$item->ms_department_name}}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="workinghours_type">ประเภท</label>
                        <select class="form-control select2" style="width: 100%;" name="workinghours_type" id="workinghours_type">
                            <option selected="selected">กรุณาเลือก</option>
                            @foreach ($typ as $item)
                            <option value="{{$item->workinghours_type_name}}">{{$item->workinghours_type_name}}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="productionopenjob_hd_docuno">เลขที่เปิดงาน</label>
                        <select class="form-control"
                        autocomplete="off" id="productionopenjob_hd_docuno" name="productionopenjob_hd_docuno" autofocus
                        required disabled>
                        <option value="0" selected>กรุณาเลือกเลขที่เปิดงาน</option>
                        @foreach ($jobdoc as $jobdoc)
                            <option value="{{ $jobdoc->productionopenjob_hd_docuno }}"
                                {{ old('productionopenjob_hd_docuno') == $jobdoc->productionopenjob_hd_docuno ? 'selected' : null }}>
                                {{ $jobdoc->productionopenjob_hd_docuno }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>
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
    $('#workinghours_type').change(function () {
           $.ajax({
            type: "POST",
            url: "{{ route('pd-woho.getjobDocu') }}",
            data: {
                workinghours_type : $(this).val() ,
                _token : "{{ csrf_token() }}"
            },
            dataType: "json",
                success: function (response) {
                if (response.status == true) {
                console.log(response.jobdoc);
                var jobdocHtml = `<option value="">เลือกเลขที่เปิดงาน</option>`;
                $.each(response.jobdoc, function (i, value) { 
                jobdocHtml += `<option value="${value.productionopenjob_hd_docuno}">${value.productionopenjob_hd_docuno}</option>`;
                });
                $('#productionopenjob_hd_docuno').attr('disabled', false);
                $('#productionopenjob_hd_docuno').html(jobdocHtml);
                } else{
                    $('#productionopenjob_hd_docuno').attr('disabled', true);
                    $('#productionopenjob_hd_docuno').html(`<option value="">ไม่พบข้อมูล</option>`);
                }
            }
           });
        })
</script>
@endpush        