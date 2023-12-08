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
        <form method="POST" class="form-horizontal" action="{{ route('pd-ladi.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold"><a href="{{route('pd-ladi.index')}}">เอกสารใบเบิกวัสดุอุปกรณ์</h3></a><br>
            <div class="row">              
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="ladingorder_hd_date" class="col-sm-3 col-form-label">วันที่</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="ladingorder_hd_date" id="ladingorder_hd_date" class="form-control" value="{{date('Y-m-d')}}" autofocus readonly>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="ladingorder_hd_docuno" class="col-sm-3 col-form-label">เลขที่</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="ladingorder_hd_docuno" id="ladingorder_hd_docuno" class="form-control" value="{{$docs}}"readonly>
                          <input type="hidden" name="ladingorder_hd_number" id="ladingorder_hd_number" value="{{$docs_number}}">
                        </div>
                      </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="productionopenjob_hd_docuno" class="col-sm-3 col-form-label">เลขที่งาน</label>
                        <div class="col-sm-9">
                        <select class="form-control select2 @error('productionopenjob_hd_docuno') is-invalid @enderror" style="width: 100%;" id="productionopenjob_hd_docuno" name="productionopenjob_hd_docuno">
                        <option value="">กรุณาเลือกเลขที่เปิดงาน</option>
                        @foreach ($jobdoc as $jobdoc)
                            <option value="{{ $jobdoc->productionopenjob_hd_docuno }}"
                                {{ old('productionopenjob_hd_docuno') == $jobdoc->productionopenjob_hd_docuno ? 'selected' : null }}>
                                {{ $jobdoc->productionopenjob_hd_docuno }}</option>
                        @endforeach
                        </select>
                        @error('productionopenjob_hd_docuno')
                            <div id="productionopenjob_hd_docuno_docuno_validation" class="invalid-feedback">
                              {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="ms_department_id" class="col-sm-3 col-form-label">แผนก</label>
                        <div class="col-sm-9">
                        <select class="form-control select2 @error('ms_department_id') is-invalid @enderror" style="width: 100%;" name="ms_department_id" id="ms_department_id">
                            <option value="">กรุณาเลือก</option>
                            @foreach ($dep as $item)
                            <option value="{{$item->ms_department_id}}" 
                                {{ old('ms_department_id') == $emp->ms_department_id ? 'selected' : null }}>
                                {{$item->ms_department_name}}
                            </option>
                            @endforeach
                        </select>
                            @error('ms_department_id')
                            <div id="ms_department_id_validation" class="invalid-feedback">
                              {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="form-group row">
                        <label for="ladingorder_hd_note" class="col-sm-1 col-form-label">หมายเหตุ</label>
                        <div class="col-sm-11">
                        <input class="form-control" name="ladingorder_hd_note" id="ladingorder_hd_note" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                
                </div>
            </div>
            <div class="row">             
                <div class="col-12">
                <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr style="background-color:#F5F5F5">
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">สินค้า</th>
                        <th class="text-center">คลังสินค้า</th>   
                        <th class="text-center">จำนวนเบิก</th>              
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody id="tb_employeelist">
                </tbody>
                </table>
                </div>
                </div>
            </div><hr>
            <div class="row">             
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tb_job">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>คลังสินค้า</th>
                                    <th>จำนวน</th>
                                    <th>ราคาต่อหน่วย</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>คลังสินค้า</th>
                                    <th>จำนวน</th>
                                    <th>ราคาต่อหน่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stc as $item)
                                    <tr>
                                        <td class="text-center"><img src="{{asset('img/accept.png')}}" style="width: 30px" onclick="addTolist({{$item->id}})"></td>
                                        <td>{{trim($item->ms_product_code)}}</td>
                                        <td>{{trim($item->ms_product_name)}}</td>
                                        <td>{{trim($item->ms_warehouse_name)}}</td>
                                        <td>{{number_format($item->stcqty,2)}}/{{trim($item->ms_productunit_name)}}</td>
                                        <td>{{number_format($item->ms_producttype_price,2)}}/บาท</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
$(function () {
$('.select2').select2()
})
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
                [2, "desc"]
            ],
            fixedHeader: {
                header:false,
                footer:false
            },
        pagingType: "full_numbers",
        bSort: true,
            initComplete: function() {
      this.api().columns().every(function() {
        var column = this;
        var select = $('<select class="form-control select2"><option value=""></option></select>')
          .appendTo($(column.header()).empty())
          .on('change', function() {
            var val = $.fn.dataTable.util.escapeRegex(
              $(this).val()
            );

            column
              .search(val ? '^' + val + '$' : '', true, false)
              .draw();
          });

        column.data().unique().sort().each(function(d, j) {
          select.append('<option value="' + d + '">' + d + '</option>')
        });
      });
    }
    
    })
});
addTolist = (id) => {
        console.log(id)
        $.ajax({
            url: "{{ url('/getProduct') }}",
            type: "POST",
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            dataType: "json",
            success: function(data) {               
            $numbertd = $('#tb_employeelist tr').length + 1;
            $('#tb_employeelist').append(`
            <tr style="background-color:#F8F8FF" class="${data.pd.id}">                 
            <td class="text-center"><input type="hidden" name="pd_id[]" value="${data.pd.id}">${$numbertd}</td>   
            <td class="text-center">${data.pd.ms_product_code}/${data.pd.ms_product_name}</td>
            <td class="text-center">${data.pd.ms_warehouse_name}</td>
            <td class="text-center"><input type="text" class="form-control" name="pd_qty[]" value="0"></td>                  
            <td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeTolist('${data.pd.id}')"><i class="fas fa-trash"></i></button></td>
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