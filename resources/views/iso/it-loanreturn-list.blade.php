@extends('layouts.main')
@section('content')
<!-- SweetAlert2 Resource -->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    .objective-container { font-family: 'Sarabun', 'Noto Sans Thai', sans-serif; padding: 1.5rem 0; }
    .card { border: none !important; border-radius: 16px !important; box-shadow: 0 4px 20px rgba(79, 70, 229, 0.05) !important; background: #ffffff; overflow: hidden; }
    .card-header { background: #ffffff !important; padding: 1.5rem 1.75rem !important; border-bottom: 1px solid #f1f5f9 !important; }
    .main-title { font-size: 1.35rem; font-weight: 700; color: #1e293b; margin: 0; }
    .doc-meta { font-size: 0.8rem; color: #94a3b8; font-weight: 500; }

    /* ✅ ตรึงหัวตารางและจำกัดความสูงให้เลื่อนได้แบบ Excel */
    .table-responsive { 
        border-radius: 12px; 
        max-height: 65vh; 
        overflow-y: auto;  
        border: 1px solid #e2e8f0; 
        width: 100%; 
    }
    
    /* ✅ ตกแต่งหัวตาราง รองรับ Sticky และกดเรียงลำดับ */
    #destroyTable thead th { 
        position: sticky; 
        top: 0; 
        z-index: 10; 
        background-color: #f8fafc !important; 
        color: #475569 !important; 
        font-weight: 700 !important; 
        border-bottom: 2px solid #e2e8f0 !important; 
        padding: 0.85rem 0.5rem !important; 
        font-size: 0.85rem; 
        text-align: center; 
        user-select: none;
        transition: background-color 0.2s;
    }
    #destroyTable thead th:hover {
        background-color: #f1f5f9 !important;
    }
    #destroyTable thead th.sort-asc::after {
        content: " ▲";
        font-size: 0.7rem;
        color: #6366f1;
    }
    #destroyTable thead th.sort-desc::after {
        content: " ▼";
        font-size: 0.7rem;
        color: #6366f1;
    }

    #destroyTable tbody td { padding: 0.65rem 0.5rem !important; vertical-align: middle !important; color: #334155; font-size: 0.85rem; border-bottom: 1px solid #f1f5f9 !important; }
    .form-control-modern { border: 1px solid #cbd5e1 !important; border-radius: 8px !important; padding: 0.4rem 0.6rem !important; font-size: 0.85rem !important; color: #334155 !important; background-color: #ffffff; width: 100%; }
    .form-control-modern:focus { border-color: #6366f1 !important; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important; outline: none; }
    .btn-danger-light { background-color: #fee2e2 !important; color: #dc2626 !important; border: none !important; border-radius: 8px !important; padding: 0.45rem 0.65rem !important; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; }
    .btn-danger-light:hover { background-color: #dc2626 !important; color: #ffffff !important; }
    .saving-indicator { font-size: 0.75rem; color: #6366f1; margin-left: 5px; display: none; }
</style>

<div class="objective-container">
    <div class="row">  
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div>
                            <h5 class="main-title"><i class="fas fa-laptop text-indigo mr-2"></i> บันทึกการยืม-คืน อุปกรณ์ด้าน IT</h5>
                        </div>
                        <div class="text-md-right mt-2 mt-md-0 doc-meta">
                            <strong>Form No:</strong> F7134.4<br>
                            <strong>Date:</strong> {{ date('d M y') }}
                        </div>
                    </div>            
                </div>

                <div class="card-body">    
                    <!-- ปุ่มเพิ่มแถว -->
                    <div class="mb-3 text-right">
                        <button type="button" class="btn btn-primary btn-sm" onclick="addRow()" style="background: #6366f1; border: none; border-radius: 8px; padding: 0.5rem 1rem;">
                            <i class="fas fa-plus-circle"></i> เพิ่มแถวรายการ
                        </button>
                    </div>
                    
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered text-center" id="destroyTable">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">ลำดับ</th>
                                    <th style="width: 80px;">จำนวน</th>
                                    <th style="width: 150px;">ชื่ออุปกรณ์</th>
                                    <th style="width: 130px;">ผู้ยืม</th>
                                    <th>รายละเอียด</th>
                                    <th style="width: 130px;">วันที่ยืม</th>
                                    <th style="width: 130px;">ให้ยืมโดย</th>
                                    <th style="width: 130px;">วันที่คืน</th>
                                    <th style="width: 130px;">รับคืนโดย</th>
                                    <th>Remark</th>
                                    {{-- <th style="width: 50px;"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ดึงข้อมูลเก่าจากฐานข้อมูลมาแสดง (ถ้ามี) -->
                                @if(isset($hd) && count($hd) > 0)
                                    @foreach($hd as$item)
                                    <tr data-id="{{ $item->it_loan_returns_id }}">
                                        <td class="row-number font-weight-bold text-muted"></td>
                                        <td><input type="number" class="form-control form-control-modern text-center" name="quantity" value="{{ $item->quantity }}" min="1" onblur="autoSaveRow(this)"></td>
                                        <td><input type="text" class="form-control form-control-modern" name="equipment_name" value="{{ $item->equipment_name }}" placeholder="ระบุชื่ออุปกรณ์" onblur="autoSaveRow(this)"></td>
                                        <td><input type="text" class="form-control form-control-modern" name="borrower" value="{{ $item->borrower }}" placeholder="ชื่อผู้ยืม" onblur="autoSaveRow(this)"></td>
                                        <td><textarea class="form-control form-control-modern" rows="1" name="details" placeholder="รายละเอียดเพิ่มเติม" onblur="autoSaveRow(this)">{{ $item->details }}</textarea></td>
                                        <td><input type="date" class="form-control form-control-modern" name="borrow_date" value="{{ $item->borrow_date }}" onchange="autoSaveRow(this)"></td>
                                        <td><input type="text" class="form-control form-control-modern" name="borrow_by" value="{{ $item->borrow_by }}" placeholder="ผู้ให้ยืม" onblur="autoSaveRow(this)"></td>
                                        <td><input type="date" class="form-control form-control-modern" name="return_date" value="{{ $item->return_date }}" onchange="autoSaveRow(this)"></td>
                                        <td><input type="text" class="form-control form-control-modern" name="return_by" value="{{ $item->return_by }}" placeholder="ผู้รับคืน" onblur="autoSaveRow(this)"></td>
                                        <td><textarea class="form-control form-control-modern" rows="1" name="remark" placeholder="หมายเหตุ" onblur="autoSaveRow(this)">{{ $item->remark }}</textarea></td>
                                        {{-- <td class="text-center">
                                            <button type="button" class="btn-danger-light" onclick="removeRow(this)" title="ลบแถว">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>        
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ถ้าไม่มีข้อมูลเลย ให้สร้างแถวเปล่าเริ่มต้น 1 แถว
        const tableBody = document.querySelector("#destroyTable tbody");
        if (tableBody.querySelectorAll("tr").length === 0) {
            addRow();
        } else {
            updateRowNumbers();
        }

        // เปิดใช้งานระบบคลิกหัวตารางเพื่อเรียงลำดับ
        makeTableSortable();
    });

    // ฟังก์ชันเพิ่มแถวใหม่ (ว่างเปล่าสำหรับพิมพ์เพิ่ม)
    function addRow() {
        const tableBody = document.querySelector("#destroyTable tbody");
        const row = document.createElement("tr");
        row.setAttribute("data-id", ""); // แถวใหม่ยังไม่มี ID ใน DB
        row.innerHTML = `
            <td class="row-number font-weight-bold text-muted"></td>
            <td><input type="number" class="form-control form-control-modern text-center" name="quantity" value="1" min="1" oninput="checkAutoInsert(this)" onblur="autoSaveRow(this)"></td>
            <td><input type="text" class="form-control form-control-modern" name="equipment_name" placeholder="ระบุชื่ออุปกรณ์" oninput="checkAutoInsert(this)" onblur="autoSaveRow(this)"></td>
            <td><input type="text" class="form-control form-control-modern" name="borrower" placeholder="ชื่อผู้ยืม" oninput="checkAutoInsert(this)" onblur="autoSaveRow(this)"></td>
            <td><textarea class="form-control form-control-modern" rows="1" name="details" placeholder="รายละเอียดเพิ่มเติม" oninput="checkAutoInsert(this)" onblur="autoSaveRow(this)"></textarea></td>
            <td><input type="date" class="form-control form-control-modern" name="borrow_date" value="{{ date('Y-m-d') }}" onchange="autoSaveRow(this)"></td>
            <td><input type="text" class="form-control form-control-modern" name="borrow_by" placeholder="ผู้ให้ยืม" oninput="checkAutoInsert(this)" onblur="autoSaveRow(this)"></td>
            <td><input type="date" class="form-control form-control-modern" name="return_date" onchange="autoSaveRow(this)"></td>
            <td><input type="text" class="form-control form-control-modern" name="return_by" placeholder="ผู้รับคืน" oninput="checkAutoInsert(this)" onblur="autoSaveRow(this)"></td>
            <td><textarea class="form-control form-control-modern" rows="1" name="remark" placeholder="หมายเหตุ" oninput="checkAutoInsert(this)" onblur="autoSaveRow(this)"></textarea></td>
        `;
        tableBody.appendChild(row);
        updateRowNumbers();
    }

    // [Auto Insert] เช็คว่าถ้าพิมพ์ที่แถวสุดท้าย ให้สร้างแถวใหม่เพิ่มทันที
    function checkAutoInsert(element) {
        const tableBody = document.querySelector("#destroyTable tbody");
        const rows = Array.from(tableBody.querySelectorAll("tr"));
        const currentRow = element.closest("tr");
        const lastRow = rows[rows.length - 1];

        if (currentRow === lastRow) {
            let hasValue = false;
            lastRow.querySelectorAll("input, textarea").forEach(input => {
                if (input.name !== 'quantity' && input.value.trim() !== '') hasValue = true;
                if (input.type === 'date' && input.value) hasValue = true;
            });
            if (hasValue) {
                addRow();
            }
        }
    }

    // [Auto Save / Update] ทำงานเมื่อผู้ใช้พิมพ์เสร็จและคลิกออกนอกช่อง (blur) หรือเปลี่ยนค่า Date
    function autoSaveRow(element) {
        const row = element.closest("tr");
        const id = row.getAttribute("data-id");
        
        let equipmentName = row.querySelector("input[name='equipment_name']").value.trim();
        
        // ถ้าชื่ออุปกรณ์ว่างเปล่า และยังไม่มี ID ในระบบ ก็ไม่ต้องส่งไปบันทึก
        if (!equipmentName && !id) return;

        // รวบรวมข้อมูลในแถวนี้
        const formData = {
            _token: "{{ csrf_token() }}",
            it_loan_returns_id: id,
            quantity: row.querySelector("input[name='quantity']").value,
            equipment_name: equipmentName,
            borrower: row.querySelector("input[name='borrower']").value,
            details: row.querySelector("textarea[name='details']").value,
            borrow_date: row.querySelector("input[name='borrow_date']").value,
            borrow_by: row.querySelector("input[name='borrow_by']").value,
            return_date: row.querySelector("input[name='return_date']").value,
            return_by: row.querySelector("input[name='return_by']").value,
            remark: row.querySelector("textarea[name='remark']").value,
        };

        // ส่งข้อมูลแบบ AJAX ไปยัง Controller
        fetch("{{ route('it_loan_returns.auto_save') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                if (!id && data.id) {
                    row.setAttribute("data-id", data.id);
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // [Auto Delete] ลบข้อมูลออกจากฐานข้อมูลทันทีเมื่อกดถังขยะ หรือช่องว่างเปล่า
    function removeRow(button) {
        const row = button.closest("tr");
        const id = row.getAttribute("data-id");
        const tableBody = document.querySelector("#destroyTable tbody");

        if (tableBody.querySelectorAll("tr").length <= 1) {
            row.querySelectorAll("input, textarea").forEach(input => {
                if (input.name === 'quantity') input.value = '1';
                else if (input.name === 'borrow_date') input.value = '{{ date('Y-m-d') }}';
                else input.value = '';
            });
            if (id) {
                deleteDataFromServer(id);
                row.setAttribute("data-id", "");
            }
            return;
        }

        if (id) {
            deleteDataFromServer(id);
        }
        row.remove();
        updateRowNumbers();
    }

    function deleteDataFromServer(id) {
        fetch(`{{ url('/it-loanreturns/auto-delete') }}/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            }
        }).catch(error => console.error('Error deleting:', error));
    }

    // จัดระเบียบเลขลำดับ
    function updateRowNumbers() {
        document.querySelectorAll("#destroyTable tbody tr").forEach((row, index) => {
            const number = index + 1;
            const rowNumDisplay = row.querySelector(".row-number");
            if (rowNumDisplay) {
                rowNumDisplay.textContent = number;
            }
        });
    }

    // ฟังก์ชันสำหรับคลิกหัวตารางเพื่อเรียงลำดับ (Sorting)
    function makeTableSortable() {
        const table = document.querySelector("#destroyTable");
        const headers = table.querySelectorAll("thead th");

        headers.forEach((th, columnIndex) => {
            if (columnIndex === 0 || columnIndex === headers.length - 1) return; // ข้ามคอลัมน์ลำดับและปุ่มลบ

            th.style.cursor = "pointer";
            th.title = "คลิกเพื่อเรียงลำดับ";

            th.addEventListener("click", function() {
                const tbody = table.querySelector("tbody");
                const rows = Array.from(tbody.querySelectorAll("tr"));
                
                const isAscending = th.classList.contains("sort-asc");
                
                headers.forEach(h => h.classList.remove("sort-asc", "sort-desc"));
                
                th.classList.toggle("sort-asc", !isAscending);
                th.classList.toggle("sort-desc", isAscending);

                rows.sort((rowA, rowB) => {
                    const inputA = rowA.cells[columnIndex].querySelector("input, textarea");
                    const inputB = rowB.cells[columnIndex].querySelector("input, textarea");

                    const cellA = inputA ? inputA.value.trim() : rowA.cells[columnIndex].innerText.trim();
                    const cellB = inputB ? inputB.value.trim() : rowB.cells[columnIndex].innerText.trim();

                    const numA = parseFloat(cellA);
                    const numB = parseFloat(cellB);

                    if (!isNaN(numA) && !isNaN(numB)) {
                        return isAscending ? numB - numA : numA - numB;
                    }

                    return isAscending 
                        ? cellB.localeCompare(cellA, 'th') 
                        : cellA.localeCompare(cellB, 'th');
                });

                rows.forEach(row => tbody.appendChild(row));
                updateRowNumbers();
            });
        });
    }
</script>
@endpush