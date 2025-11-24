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
                <h5>บริษัท เอสซอม จำกัด<br>ทะเบียนเอกสารอ้างอิง</h5><p class="text-right">F7531.2<br>9 Jun. 16</p>              
            </div>
            <div class="card-body">    
                <form method="POST" class="form-horizontal" action="{{ route('document-reference.update',$hd->documentreferences_id) }}" enctype="multipart/form-data">
                @csrf  
                @method('PUT')         
                <div class="row mt-3">
                    <div class="col-3">
                        <label>ลำดับที่</label>
                        <input type="number" class="form-control" name="documentreferences_listno" value="{{$hd->documentreferences_listno}}" readonly>
                    </div>
                    <div class="col-3">
                        <label>วันที่รับเอกสาร</label>
                        <input type="date" class="form-control" name="documentreferences_receivedate" value="{{ $hd->documentreferences_receivedate }}" required>
                    </div>
                    <div class="col-6">
                        <label>หน่วยงานที่ออกเอกสาร</label>
                        <input type="text" class="form-control" name="documentreferences_department" value="{{ $hd->documentreferences_department }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <label>วันที่ออกเอกสาร</label>
                        <input type="date" class="form-control" name="documentreferences_date" value="{{ $hd->documentreferences_date}}">
                    </div>
                    <div class="col-3">
                        <label>รหัสเอกสาร</label>
                        <input type="text" class="form-control" name="documentreferences_code" value="{{ $hd->documentreferences_code}}">
                    </div>
                    <div class="col-6">
                        <label>ชื่อเอกสาร</label>
                        <input type="text" class="form-control" name="documentreferences_name"  value="{{ $hd->documentreferences_name}}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label for="documentreferences_file">ไฟล์แนบ(หากมี)</label>
                        <input type="file" class="form-control-file" name="documentreferences_file" >
                        @if ($hd->documentreferences_file)
                            <a href="{{asset($hd->documentreferences_file)}}" target=”_blank”>
                                <i class="fas fa-file"></i>
                            </a>
                        @endif  
                    </div>                  
                    <div class="col-6">
                        <label>Link</label>
                        <input type="text" class="form-control" name="documentreferences_link" value="{{ $hd->documentreferences_link}}">
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