@extends('layouts.main')
@section('content')

<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #eeebff;
        --indigo-border: #e0e0fe;
    }
    
    .card-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(79, 70, 229, 0.05);
        overflow: hidden;
        background: #ffffff;
    }

    .card-modern .card-header {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
        border-bottom: none;
        padding: 1.5rem;
    }

    .card-modern .card-header h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .form-label-modern {
        font-weight: 600;
        color: #4b5563;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control-modern {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        transition: all 0.2s ease;
    }

    .form-control-modern:focus {
        border-color: var(--indigo-primary);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
    }

    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-modern thead th {
        background-color: var(--indigo-light);
        color: #3730a3;
        font-weight: 600;
        border: 1px solid var(--indigo-border) !important;
        padding: 12px;
    }

    .table-modern tbody td {
        border: 1px solid #f3f4f6 !important;
        padding: 10px;
        vertical-align: middle;
    }

    .btn-indigo {
        background-color: var(--indigo-primary);
        color: white;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        border: none;
        transition: all 0.2s;
    }

    .btn-indigo:hover {
        background-color: var(--indigo-hover);
        color: white;
        transform: translateY(-1px);
    }

    .btn-add-row {
        background-color: #f5f3ff;
        color: var(--indigo-primary);
        border: 2px dashed var(--indigo-primary);
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-add-row:hover {
        background-color: var(--indigo-primary);
        color: white;
    }

    .btn-delete {
        background-color: #fee2e2;
        color: #ef4444;
        border: none;
        border-radius: 8px;
        padding: 6px 12px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-delete:hover {
        background-color: #ef4444;
        color: white;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">  
        <div class="col-12 col-xl-11">
            <div class="card card-modern">
                <div class="card-header position-relative">
                    <div class="text-center">
                        <h5 class="m-0">ESSOM CO.,LTD</h5>
                        <p class="m-0 opacity-75 small">บัญชีรายชื่อสินค้าและผู้ขายที่ได้รับการยอมรับแล้ว (APPROVED SUPPLIER LIST)</p>
                    </div>
                    <div class="position-absolute" style="right: 1.5rem; bottom: 1rem; text-align: right; font-size: 0.8rem; opacity: 0.8;">
                        <strong>F8411.3</strong><br>10 Jul. 20
                    </div>             
                </div>
                
                <div class="card-body p-4">      
                    <form method="POST" class="form-horizontal" action="{{ route('product-list-selected.store') }}" enctype="multipart/form-data">
                        @csrf            
                        
                        <!-- Header Input -->
                        <div class="row mb-4">
                            <div class="col-12 col-md-6">
                                <label for="product_list_selected_hd_product" class="form-label-modern mb-2">Product Group</label>
                                <input class="form-control form-control-modern" name="product_list_selected_hd_product" placeholder="ระบุกลุ่มสินค้า...">
                            </div>                   
                        </div>

                        <!-- Table Section -->
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <button type="button" class="btn btn-add-row px-3 py-2" onclick="addRow()">
                                    ✨ เพิ่มแถวรายการใหม่
                                </button>
                            </div>
                            
                            <div class="col-12 table-responsive">
                                <table class="table table-modern text-center" id="destroyTable">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 5%">No.</th>
                                            <th rowspan="2" style="width: 25%">Company Information</th>
                                            <th rowspan="2" style="width: 25%">Product List</th>
                                            <th colspan="5" style="width: 35%">Assessment Year</th>
                                            <th rowspan="2" style="width: 10%">Action</th>
                                        </tr>
                                        <tr id="yearRow"></tr>
                                    </thead>
                                    <tbody>
                                        <!-- Dynamic rows injection -->
                                    </tbody>
                                </table>
                            </div>
                        </div> 

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <button type="submit" class="btn btn-indigo btn-block shadow-sm">
                                    💾 บันทึกข้อมูล
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
    const yearRow = document.getElementById("yearRow");
    const currentYear = new Date().getFullYear();
    const startYear = currentYear - 4; 

    for (let y = startYear; y <= currentYear; y++) {
        const td = document.createElement("td");
        td.textContent = y;
        td.style.fontWeight = '600';
        yearRow.appendChild(td);
    }

    // ✅ ฟังก์ชันเพิ่มแถว (เพิ่ม class="row-number" เพื่อให้สคริปต์ลบแถวทำงานได้สมบูรณ์)
    function addRow() {
        const tableBody = document.querySelector("#destroyTable tbody");
        const rowCount = tableBody.querySelectorAll("tr").length + 1;

        const row = document.createElement("tr");
        row.innerHTML = `
            <td>
                <span class="row-number font-weight-bold">${rowCount}</span>
                <input type="hidden" name="product_list_selected_dt_listno[]" value="${rowCount}">            
            </td>
            <td>
                <textarea class="form-control form-control-modern" rows="2" placeholder="ชื่อผู้ขาย / รายละเอียดบริษัท" name="product_list_selected_dt_vendor[]"></textarea>
            </td>
            <td>
                <textarea class="form-control form-control-modern" rows="2" placeholder="รายละเอียดสินค้า" name="product_list_selected_dt_product[]"></textarea>
            </td>
            <td>
                <select class="form-control form-control-modern text-center" name="product_list_selected_dt_results1[]">
                    <option value="0"></option>
                    <option value="1">/</option>
                </select>
            </td>
            <td>
                <select class="form-control form-control-modern text-center" name="product_list_selected_dt_results2[]">
                    <option value="0"></option>
                    <option value="1">/</option>
                </select>
            </td>
            <td>
                <select class="form-control form-control-modern text-center" name="product_list_selected_dt_results3[]">
                    <option value="0"></option>
                    <option value="1">/</option>
                </select>
            </td>
            <td>
                <select class="form-control form-control-modern text-center" name="product_list_selected_dt_results4[]">
                    <option value="0"></option>
                    <option value="1">/</option>
                </select>
            </td>
            <td>
                <select class="form-control form-control-modern text-center" name="product_list_selected_dt_results5[]">
                    <option value="0"></option>
                    <option value="1">/</option>
                </select>
            </td>
            <td>
                <button type="button" class="btn btn-delete" onclick="removeRow(this)">🗑️ ลบ</button>
            </td>
        `;

        tableBody.appendChild(row);
        updateRowNumbers(); 
    }

    // ✅ ฟังก์ชันลบแถว
    function removeRow(button) {
        const row = button.closest("tr");
        row.remove();
        updateRowNumbers(); 
    }

    // ✅ ฟังก์ชันจัดเลขลำดับใหม่ (แก้ไขให้ชี้คลาสถูกต้อง)
    function updateRowNumbers() {
        document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
            const number = index + 1;
            const rowNumSpan = row.querySelector(".row-number");
            if(rowNumSpan) rowNumSpan.textContent = number;
            
            const hiddenInput = row.querySelector('input[name="product_list_selected_dt_listno[]"]');
            if(hiddenInput) hiddenInput.value = number;
        });
    }
</script>
@endpush