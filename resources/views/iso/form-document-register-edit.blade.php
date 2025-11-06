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
                    <h5>ESSOM CO.,LTD<br>ทะเบียนควบคุมเอกสาร (Documents Control Status)</h5><p class="text-right">F7530.1<br>1 Oct. 20</p>
            </div>
            <div class="card-body">
                <form method="POST" class="form-horizontal" action="{{ route('document-register.update', $hd->documentregisters_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mt-3">
                    <div class="col-1">
                        <label for="documentregisters_listno">ที่</label>
                        <input type="number" name="documentregisters_listno" class="form-control" value="{{$hd->documentregisters_listno}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="documentregisters_docuno">Doc</label>
                        <input type="text" name="documentregisters_docuno" class="form-control" value="{{$hd->documentregisters_docuno}}">
                    </div>
                    <div class="col-8">
                        <label for="documentregisters_remark">Deseription</label>
                        <input type="text" name="documentregisters_remark" class="form-control" value="{{$hd->documentregisters_remark}}">
                    </div>
                </div>
                 <div class="row mt-3">
                    <div class="col-2">
                        <label for="documentregisters_rev01">Rev.</label>
                        <input type="text" name="documentregisters_rev01" class="form-control" value="{{$hd->documentregisters_rev01}}">
                    </div>
                    <div class="col-2">
                        <label for="documentregisters_rev02">Rev.</label>
                        <input type="text" name="documentregisters_rev02" class="form-control" value="{{$hd->documentregisters_rev02}}">
                    </div>
                    <div class="col-2">
                        <label for="documentregisters_rev03">Rev.</label>
                        <input type="text" name="documentregisters_rev03" class="form-control" value="{{$hd->documentregisters_rev03}}">
                    </div>
                    <div class="col-2">
                        <label for="documentregisters_rev04">Rev.</label>
                        <input type="text" name="documentregisters_rev04" class="form-control" value="{{$hd->documentregisters_rev04}}">
                    </div>
                    <div class="col-2">
                        <label for="documentregisters_rev05">Rev.</label>
                        <input type="text" name="documentregisters_rev05" class="form-control" value="{{$hd->documentregisters_rev05}}">
                    </div>
                    <div class="col-2">
                        <label for="documentregisters_rev06">Rev.</label>
                        <input type="text" name="documentregisters_rev06" class="form-control" value="{{$hd->documentregisters_rev06}}">
                    </div>
                    <div class="col-2">
                        <label for="documentregisters_rev07">Rev.</label>
                        <input type="text" name="documentregisters_rev07" class="form-control" value="{{$hd->documentregisters_rev07}}">
                    </div>
                    <div class="col-2">
                        <label for="documentregisters_rev08">Rev.</label>
                        <input type="text" name="documentregisters_rev08" class="form-control" value="{{$hd->documentregisters_rev08}}">
                    </div>
                    <div class="col-2">
                        <label for="documentregisters_rev09">Rev.</label>
                        <input type="text" name="documentregisters_rev09" class="form-control" value="{{$hd->documentregisters_rev09}}">
                    </div>
                    <div class="col-2">
                        <label for="documentregisters_rev10">Rev.</label>
                        <input type="text" name="documentregisters_rev10" class="form-control" value="{{$hd->documentregisters_rev10}}">
                    </div>
                         
                </div>
                 <div class="row mt-3">
                    <div class="col-4">
                        <label for="documentregisters_file">ไฟล์แนบ(หากมี)</label>
                        <input type="file" class="form-control-file" name="documentregisters_file" >                        
                    </div> 
                    <div class="col-4">
                        <label for="documentregisters_file1">ไฟล์แนบ(หากมี)</label>
                        <input type="file" class="form-control-file" name="documentregisters_file1" >                        
                    </div> 
                    <div class="col-4">
                        <label for="documentregisters_file2">ไฟล์แนบ(หากมี)</label>
                        <input type="file" class="form-control-file" name="documentregisters_file2" >                        
                    </div> 
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <label for="documentregisters_flag">เอกสารแนบของเดิม</label><br>
                        @if ($hd->documentregisters_file)
                            <a href="{{asset($hd->documentregisters_file)}}" target=”_blank”>
                                <i class="fas fa-file"></i>
                            </a>
                        @endif
                    </div>       
                    <div class="col-4">
                        <label for="documentregisters_flag">เอกสารแนบของเดิม</label><br>
                        @if ($hd->documentregisters_file1)
                            <a href="{{asset($hd->documentregisters_file1)}}" target=”_blank”>
                                <i class="fas fa-file"></i>
                            </a>
                        @endif
                    </div> 
                     <div class="col-4">
                        <label for="documentregisters_flag">เอกสารแนบของเดิม</label><br>
                        @if ($hd->documentregisters_file2)
                            <a href="{{asset($hd->documentregisters_file2)}}" target=”_blank”>
                                <i class="fas fa-file"></i>
                            </a>
                        @endif
                    </div>           
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <label for="documentregisters_flag">สถานะ</label>
                        <select class="form-control" name="documentregisters_flag">
                            @if ($hd->documentregisters_flag)
                                <option value="1">ใช้งาน</option>
                                <option value="0">ไม่ใช้งาน</option>
                            @else
                                <option value="0">ไม่ใช้งาน</option>
                                <option value="1">ใช้งาน</option>                           
                            @endif
                        </select>
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
    