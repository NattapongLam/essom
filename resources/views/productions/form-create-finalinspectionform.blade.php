@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title" style="font-weight: bold">การตรวจสอบในกระบวนการผลิตและขั้นสุดท้าย</h3><br><hr>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="finalInspection_hd_date" class="col-sm-4 col-form-label">วันที่</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="finalInspection_hd_date" id="finalInspection_hd_date" class="form-control" value="{{date('Y-m-d')}}" autofocus readonly>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="finalInspection_hd_docuno" class="col-sm-4 col-form-label">เลขที่</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="finalInspection_hd_docuno" id="finalInspection_hd_docuno" class="form-control" value="{{$docs}}"readonly>
                          <input type="hidden" name="finalInspection_hd_number" id="finalInspection_hd_number" value="{{$docs_number}}">
                        </div>
                      </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="productionopenjob_hd_docuno" class="col-sm-4 col-form-label">ใบเปิดงาน</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="productionopenjob_hd_docuno" id="productionopenjob_hd_docuno" class="form-control" value="{{$hd->productionopenjob_hd_docuno}}"readonly>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group row">
                        <label for="ms_finalspec_hd_id" class="col-sm-4 col-form-label">Doc.No</label>
                        <div class="col-sm-10">
                          
                        </div>
                      </div>
                </div>
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