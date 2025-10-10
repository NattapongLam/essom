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
                <h5>ESSOM CO.,LTD<br>คำขอแก้ไขแบบ<br>DESIGN CHANGE REQUEST</h5><p class="text-right">F8300.4<br>09 Jun. 16</p>              
            </div>
            <div class="card-body">  
                <form method="POST" class="form-horizontal" action="{{ route('design-edit.store') }}" enctype="multipart/form-data">
                @csrf                   
               <div class="row mt-3">
                    <div class="col-6">
                        <label>Product</label>
                        <input class="form-control" type="text" name="design_edits_product" required>
                    </div>
                    <div class="col-6">
                        <label>Model</label>
                        <input class="form-control" type="text" name="design_edits_model" required>
                    </div>
               </div>
               <div class="row mt-3">
                    <div class="col-12">
                        <label>1. Detail of Change</label>
                    </div>
               </div>  
                <div class="row mt-3">
                    <div class="col-12">
                        <label>1.1 Drawing No.</label>
                        <textarea class="form-control" name="design_edits_drawing" required></textarea>
                    </div>
               </div> 
               <div class="row mt-3">
                    <div class="col-12">
                        <label>1.2 Reasons and Details</label>
                        <textarea class="form-control" rows="5" name="design_edits_reasons" required></textarea>
                    </div>
               </div>
               <div class="row mt-3">
                    <div class="col-9">
                        <label>Requested By</label>
                        <select class="form-control select2" name="requested_by" required>
                            <option value="">กรุณาเลือก</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">
                                    {{ $item->ms_employee_code }}/{{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="requested_date" value="{{ $hd->requested_date }}" required>
                    </div>
               </div> 
                <div class="row mt-3">
                    <div class="col-9">
                        <label>Supervisor</label>
                        <select class="form-control select2" name="supervisor_by" required>
                            <option value="">กรุณาเลือก</option>
                            @foreach ($emp as $item)
                                <option value="{{ $item->ms_employee_fullname }}">
                                    {{ $item->ms_employee_code }}/{{ $item->ms_employee_fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="supervisor_date" value="{{ $hd->supervisor_date  }}" required>
                    </div>
               </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>2. Engineering Section Comments</label>
                        <textarea class="form-control" rows="5" name="engineeringsection_comments" readonly></textarea>
                    </div>
               </div>
               <div class="row mt-3">
                    <div class="col-9">
                        <label>Signature</label>
                        <input class="form-control" type="text" name="engineeringsection_by" readonly>
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="engineeringsection_date" readonly>
                    </div>
               </div>
                 <div class="row mt-3">
                    <div class="col-12">
                        <label>3. Engineer Comments</label>
                        <textarea class="form-control" rows="5" name="engineer_comments" readonly></textarea>
                    </div>
               </div>
               <div class="row mt-3">
                    <div class="col-9">
                        <label>Signature</label>
                        <input class="form-control" type="text" name="engineer_by" readonly>
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="engineer_date" readonly>
                    </div>
               </div>
                 <div class="row mt-3">
                    <div class="col-12">
                        <label>4. Senior Engineer Comments</label>
                        <textarea class="form-control" rows="5" name="seniorengineer_comments" readonly></textarea>
                    </div>
               </div>
               <div class="row mt-3">
                    <div class="col-9">
                        <label>Signature</label>
                        <input class="form-control" type="text" name="seniorengineer_by" readonly>
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="seniorengineer_date" readonly>
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
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "กรุณาเลือก",
        allowClear: true,
        width: '100%' // ให้พอดีกับ form-control
    });
});
</script>
@endpush  