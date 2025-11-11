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
                <h5>บริษัท เอสซอม จำกัด<br>ใบขอทำลายเอกสาร</h5><p class="text-right">F7530.4<br>1 May. 17</p>              
            </div>
            <div class="card-body">  
                <form method="POST" class="form-horizontal" action="{{ route('document-destruction.update',$hd->documentdestruction_hd_id) }}" enctype="multipart/form-data">
                @csrf    
                @method('PUT')    
                <div class="row mt-3">
                    <div class="col-4">
                         <label>เรียน</label>
                         <input class="form-control" type="text" name="documentdestruction_hd_to" value="{{$hd->documentdestruction_hd_to}}" readonly>
                    </div>
                    <div class="col-4">
                         <label>จาก</label>
                         <input class="form-control" type="text" name="documentdestruction_hd_from" value="{{$hd->documentdestruction_hd_from}}" readonly>
                    </div>
                    <div class="col-4">
                         <label>วันที่</label>
                         <input class="form-control" type="date" name="documentdestruction_hd_date" value="{{ $hd->documentdestruction_hd_date }}" required>
                    </div>
                </div>
                <br>
                <h6>ขอทำลายเอกสารดังนี้</h6>
                <div class="row mt-3">
                    <table class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th style="width: 5%">ลำดับ</th>
                                <th style="width: 20%">รหัสเอกสาร</th>
                                <th style="width: 35%">ชื่อเอกสาร</th>
                                <th style="width: 35%">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dt as $item)
                                <tr>
                                    <td>{{$item->documentdestruction_dt_listno}}</td>
                                    <td>{{$item->documentdestruction_dt_code}}</td>
                                    <td>{{$item->documentdestruction_dt_name}}</td>
                                    <td>{{$item->documentdestruction_dt_note}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-4 text-center">
                        <label>ผู้ขออนุมัติ</label>
                        <input class="form-control" type="text" value="{{$hd->requested_by}}" name="requested_by" readonly><br>
                        <input class="form-control" type="date" value="{{ $hd->requested_date }}" name="requested_date" readonly>
                    </div>
                    @if ($hd->reviewed_status == "Y")
                         <div class="col-4 text-center">
                            <label>ผู้จัดการฝ่าย</label>
                            <input class="form-control" type="text" value="{{$hd->reviewed_by}}" name="reviewed_by" readonly><br>
                            <input class="form-control" type="date" value="{{$hd->reviewed_date}}" name="reviewed_date">
                        </div>
                        <div class="col-4 text-center">
                            <label>ผู้อนุมัติ</label>
                            <input class="form-control" type="text" name="approved_by" value="{{auth()->user()->name}}" readonly><br>
                            <input class="form-control" type="date" name="approved_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                        </div>
                        <input type="hidden" name="reviewed_status" value="Y">
                        <input type="hidden" name="approved_status" value="Y">
                    @else
                        <div class="col-4 text-center">
                            <label>ผู้จัดการฝ่าย</label>
                            <input class="form-control" type="text" value="{{auth()->user()->name}}" name="reviewed_by" readonly><br>
                            <input class="form-control" type="date" value="{{ old('date', now()->format('Y-m-d')) }}" name="reviewed_date">
                        </div>
                        <div class="col-4 text-center">
                            <label>ผู้อนุมัติ</label>
                            <input class="form-control" type="text" name="approved_by" readonly><br>
                            <input class="form-control" type="date" name="approved_date" readonly>
                        </div>
                        <input type="hidden" name="reviewed_status" value="Y">
                        <input type="hidden" name="approved_status" value="N">
                    @endif                   
                </div> 
                <br>
                @if ($hd->approved_status == "N")
                <div class="col-12 col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            บันทึก
                         </button>
                    </div>
                </div> 
                @endif              
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
    