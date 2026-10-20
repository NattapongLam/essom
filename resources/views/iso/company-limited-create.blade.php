@extends('layouts.main')
@section('content')
{{-- @push('styles') --}}
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
{{-- @endpush --}}

<style>
    /* Custom Indigo Modern Theme */
    :root {
        --indigo-primary: #4f46e5;
        --indigo-hover: #4338ca;
        --indigo-light: #e0e7ff;
        --text-dark: #1e1b4b;
        --border-radius-custom: 12px;
    }

    .custom-card {
        border: none;
        border-radius: var(--border-radius-custom);
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 8px 10px -6px rgba(79, 70, 229, 0.1);
        background: #ffffff;
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6366f1, var(--indigo-primary));
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: none;
    }

    .custom-card-header h5 {
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .doc-code {
        font-size: 0.85rem;
        opacity: 0.85;
        font-weight: 300;
    }

    .btn-indigo-add {
        background-color: #ffffff;
        color: var(--indigo-primary) !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none !important;
        border: none;
        cursor: pointer;
    }

    .btn-indigo-add:hover {
        background-color: var(--indigo-light);
        transform: translateY(-1px);
        box-shadow: 0 6px 12px -2px rgba(79, 70, 229, 0.2);
    }

    /* Table Styling */
    .modern-table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead th {
        background-color: #f8fafc !important;
        color: #64748b;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1.2rem 0.5rem !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
    }

    .modern-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background-color: #f1f5f9;
    }

    .modern-table tbody td {
        padding: 0.75rem 0.5rem !important;
        vertical-align: middle !important;
        color: var(--text-dark);
        font-weight: 500;
        font-size: 0.9rem;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    /* Action Buttons */
    .btn-action {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: #dc2626;
        border: none;
        cursor: pointer;
    }

    .btn-action-delete:hover {
        background-color: #fecaca;
        color: #b91c1c;
        transform: scale(1.05);
    }
</style>

<div class="container-fluid py-4">
    <div class="row">  
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="text-center text-md-left mb-3 mb-md-0">
                            <h5 class="m-0">ESSOM COMPANY LIMITED</h5>
                            <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">OVERALL PRODUCTION PLAN</h5>
                            <span class="doc-code">ฟอร์มเอกสาร: F8510.2 (9 Feb. 17)</span>
                        </div>                   
                    </div>
                </div>

                <div class="card-body p-4">         
                    <form action="{{ route('company-limiteds.store') }}" method="POST">
                    @csrf       
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>FOR MONTH</label>
                                <input class="form-control" type="month" name="for_month" value="{{ date('Y-m') }}">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered modern-table text-center align-middle" id="productTable">
                            <thead>
                                <tr>
                                    <th colspan="2">PRODUCT</th>
                                    <th colspan="2">Min Stk.</th>
                                    <th rowspan="2" style="width: 5%">PDO</th>
                                    <th colspan="2">Cur Stk.</th>
                                    <th rowspan="2"style="width: 5%">ORD</th>
                                    <th rowspan="2" style="width: 5%">PTO</th>
                                    <th rowspan="2" style="width: 5%">PP</th>
                                    <th rowspan="2" style="width: 5%">JUN</th>
                                    <th rowspan="2" style="width: 5%">FEB</th>
                                    <th rowspan="2" style="width: 5%">MAR</th>
                                    <th rowspan="2">
                                        APR-JUNE 
                                        <input class="form-control form-control-sm mt-1" type="number" name="for_year" value="{{ date('Y') }}">
                                    </th>
                                    <th rowspan="2" style="width: 5%">
                                        <button type="button" class="btn-indigo-add btn-sm" id="addRowBtn">
                                            <i class="fa fa-plus"></i> เพิ่มแถว
                                        </button>
                                    </th>
                                </tr>
                                <tr>
                                    <td style="width: 10%">Code</td>
                                    <td>Desc</td>
                                    <td style="width: 5%">Fin.</td>
                                    <td style="width: 5%">Semi</td>
                                    <td style="width: 5%">Fin.</td>
                                    <td style="width: 5%">Semi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- เริ่มต้นด้วย 1 แถว -->
                                <tr>
                                    <td><input type="text" class="form-control form-control-sm" name="products[0][product_code]"></td>
                                    <td><input type="text" class="form-control form-control-sm" name="products[0][product_desc]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][min_fin]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][min_semi]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][pdo]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][cur_fin]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][cur_semi]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][ord]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][pto]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][pp]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][jun]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][feb]"></td>
                                    <td><input type="number" class="form-control form-control-sm" name="products[0][mar]"></td>
                                    <td><input type="text" class="form-control form-control-sm" name="products[0][apr_jun]"></td>
                                    <td>
                                        <button type="button" class="btn btn-action btn-action-delete remove-row">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-muted small">Min Stk Fin=Minimum Stock Finish , Min Stk Semi=Minimum Stock Semi , PDO=Production Order , Cur Stk Fin=Currency Stock Finish , Cur Stk Semi=Current Stock Semi , ORD=Order , PTO=Potential Order , PP=Production Plan</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Prepared By</label>
                                <input class="form-control" type="text" name="prepared_by" value="{{auth()->user()->name}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control" type="date" name="prepared_date" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Checked By</label>
                                <input class="form-control" type="text" name="checked_by" value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control" type="date" name="checked_date" value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Approved By</label>
                                <input class="form-control" type="text" name="approved_by" value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control" type="date" name="approved_date" value="">
                            </div>
                        </div>
                    </div> 

                    <div class="text-end">
                        <button type="submit" class="btn btn-indigo-add px-4 py-2">บันทึกข้อมูล</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let rowIndex = 1;

        // กดปุ่มเพิ่มแถว
        document.getElementById('addRowBtn').addEventListener('click', function () {
            let tbody = document.querySelector('#productTable tbody');
            let newRow = `
                <tr>
                    <td><input type="text" class="form-control form-control-sm" name="products[${rowIndex}][product_code]"></td>
                    <td><input type="text" class="form-control form-control-sm" name="products[${rowIndex}][product_desc]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][min_fin]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][min_semi]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][pdo]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][cur_fin]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][cur_semi]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][ord]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][pto]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][pp]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][jun]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][feb]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][mar]"></td>
                    <td><input type="number" class="form-control form-control-sm" name="products[${rowIndex}][apr_jun]"></td>
                    <td>
                        <button type="button" class="btn btn-action btn-action-delete remove-row">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', newRow);
            rowIndex++;
        });

        // กดปุ่มลบแถว
        document.querySelector('#productTable').addEventListener('click', function (e) {
            if (e.target.closest('.remove-row')) {
                let row = e.target.closest('tr');
                let tbody = document.querySelector('#productTable tbody');
                // เช็คไม่ให้ลบจนหมดแถวสุดท้าย (ถ้าต้องการให้เหลืออย่างน้อย 1 แถว)
                if (tbody.querySelectorAll('tr').length > 1) {
                    row.remove();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'ไม่สามารถลบได้',
                        text: 'ต้องมีข้อมูลสินค้าอย่างน้อย 1 แถว',
                        confirmButtonColor: '#4f46e5'
                    });
                }
            }
        });
    });
</script>
@endpush