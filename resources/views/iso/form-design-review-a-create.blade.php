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
                <h5>ESSOM CO.,LTD<br>การทบทวนการออกแบบ<br>DESIGN REVIEW</h5><p class="text-right">F8300.2A<br>19 Jan. 22</p>              
            </div>
            <div class="card-body">   
                <form method="POST" class="form-horizontal" action="{{ route('design-review-a.store') }}" enctype="multipart/form-data">
                @csrf        
                <div class="row mt-3">
                    <div class="col-12">
                        <label>1. Design Review</label>
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-8">
                        <label>1.1 Product</label>
                        <input class="form-control" type="text" name="design_review_a_hd_product">
                    </div>
                    <div class="col-4">
                        <label>Model</label>
                        <input class="form-control" type="text" name="design_review_a_hd_model">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>1.2 Participants</label>
                        <textarea class="form-control" name="design_review_a_hd_participants"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>1.3 Subject</label>
                        <textarea class="form-control" name="design_review_a_hd_subject"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>1.4 Design Input</label>
                        <textarea class="form-control" name="design_review_a_hd_designinput"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>1.5 Do List</label>
                        <div class="mb-2">
                            <button type="button" class="btn btn-sm btn-success" onclick="addRow()">
                                ➕ เพิ่มแถว
                            </button>
                        </div>
                            <table class="table table-bordered table-sm text-center" id="destroyTable">
                                <thead>
                                    <tr>
                                        <th style="width: 25%">Item</th>
                                        <th style="width: 50%">Description</th>
                                        <th style="width: 5%">ลบ</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- เริ่มต้นไม่มีแถว หรือคุณจะใส่แถวเริ่มต้น 1 แถวก็ได้ -->
                                </tbody>
                            </table>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label>1.6 Drawing (page(s))</label>
                        <input class="form-control" type="text" name="design_review_a_hd_drawing">
                    </div>
                    <div class="col-6">
                        <label>1.7 Reference Documents (page(s))</label>
                        <input class="form-control" type="text" name="design_review_a_hd_reference">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label>1.8 Comment</label>
                        <textarea class="form-control" name="design_review_a_hd_comment"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label>Reported By</label>
                        <input class="form-control" type="text" name="reported_by"  value="{{auth()->user()->name}}" readonly>
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="reported_date" value="{{ old('date', now()->format('Y-m-d')) }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <label>Reviewed By</label>
                        <input class="form-control" type="text" name="reviewed_by" readonly>
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="reviewed_date" readonly>
                    </div>
                </div>        
                <div class="row mt-3">
                    <div class="col-9">
                        <label>Engineecing Supervisor</label>
                        <input class="form-control" type="text" name="engineecing_by" readonly>
                    </div>
                    <div class="col-3">
                        <label>Date</label>
                        <input class="form-control" type="date" name="engineecing_date" readonly>
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
// ✅ ฟังก์ชันเพิ่มแถว
function addRow() {
    const tableBody = document.querySelector("#destroyTable tbody");
    const rowCount = tableBody.querySelectorAll("tr").length + 1;

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>
            <input type="hidden" name="listno[]" value="${rowCount}">
            <input type="text" class="form-control" placeholder="Item" name="design_review_a_dt_item[]">
        </td>
        <td>
            <input type="text"  class="form-control" placeholder="Description" name="design_review_a_dt_description[]">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">ลบ</button>
        </td>
    `;

    tableBody.appendChild(row);
    updateRowNumbers(); // รีเลขลำดับ
}

// ✅ ฟังก์ชันลบแถว
function removeRow(button) {
    const row = button.closest("tr");
    row.remove();
    updateRowNumbers(); // รีเลขลำดับใหม่หลังลบ
}

function updateRowNumbers() {
    document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
        const number = index + 1;
        row.querySelector(".row-number").textContent = number;
        row.querySelector('input[name="listno[]"]').value = number;
    });
}
</script>
@endpush  