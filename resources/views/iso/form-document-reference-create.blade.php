@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5>บริษัท เอาซอม จำกัด<br>ทะเบียนเอกสารอ้างอิง</h5><p class="text-right">F7531.2<br>9 Jun. 16</p>              
            </div>
            <div class="card-body">    
                <form method="POST" class="form-horizontal" action="{{ route('document-reference.store') }}" enctype="multipart/form-data">
                @csrf           
                <div class="row mt-3">
                    <div class="col-3">
                        <label>ลำดับที่</label>
                        <input type="number" class="form-control" name="documentreferences_listno" value="{{$listno}}" readonly>
                    </div>
                    <div class="col-3">
                        <label>วันที่รับเอกสาร</label>
                        <input type="date" class="form-control" name="documentreferences_receivedate" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-6">
                        <label>หน่วยงานที่ออกเอกสาร</label>
                        <input type="text" class="form-control" name="documentreferences_department" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <label>วันที่ออกเอกสาร</label>
                        <input type="date" class="form-control" name="documentreferences_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                    </div>
                    <div class="col-3">
                        <label>รหัสเอกสาร</label>
                        <input type="text" class="form-control" name="documentreferences_code">
                    </div>
                    <div class="col-6">
                        <label>ชื่อเอกสาร</label>
                        <input type="text" class="form-control" name="documentreferences_name">
                    </div>
                </div>
                <br>
                <div class="col-12 col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
</script>
@endpush  