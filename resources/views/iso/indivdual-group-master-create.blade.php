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

    .modern-table thead th {
        background-color: #f8fafc !important;
        color: #64748b;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1rem 0.5rem !important;
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

    .btn-action-delete {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background-color: #fee2e2;
        color: #dc2626;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
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
                            <h5 class="m-0">ESSOM CO.,LTD</h5>
                            <h5 class="m-0 font-weight-normal" style="font-size: 1.1rem; opacity: 0.9;">Individual Group Master</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form id="planningForm" method="POST" action="{{ route('individual-masters.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input class="form-control" type="text" name="product_code" value="{{ old('product_code') }}">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="section-title m-0 border-0 p-0 fw-semibold">Planning Schedule Details</div>
                            <button type="button" id="addRowBtn" class="btn btn-sm btn-success px-3" style="border-radius: 8px;">
                                <i class="fa fa-plus me-1"></i> เพิ่มแถว
                            </button>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered modern-table text-center align-middle" id="planningTable">
                                <thead>
                                    <tr>
                                        <th style="min-width: 280px; width: 80%;">Description</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <tr>
                                        <td>
                                            <input class="form-control" type="text" name="details[0][description]" placeholder="รายละเอียดงาน">
                                        </td>
                                        <td>
                                            <button type="button" class="btn-action-delete remove-row" title="ลบแถว">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4" style="background-color: var(--indigo-primary); border-color: var(--indigo-primary); border-radius: 8px;">
                                บันทึกข้อมูล
                            </button>
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
        const tbody = document.getElementById('tableBody');
        const addRowBtn = document.getElementById('addRowBtn');

        function reindexRows() {
            Array.from(tbody.rows).forEach((row, index) => {
                const input = row.querySelector('input[name*="[description]"]');
                if (input) {
                    input.name = `details[${index}][description]`;
                }
            });
        }

        addRowBtn.addEventListener('click', function () {
            const nextIndex = tbody.rows.length;
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <input class="form-control" type="text" name="details[${nextIndex}][description]" placeholder="รายละเอียดงาน">
                </td>
                <td>
                    <button type="button" class="btn-action-delete remove-row" title="ลบแถว">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(newRow);
        });

        tbody.addEventListener('click', function (e) {
            const deleteBtn = e.target.closest('.remove-row');
            if (!deleteBtn) return;

            if (tbody.rows.length > 1) {
                deleteBtn.closest('tr').remove();
                reindexRows();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'ไม่สามารถลบได้',
                    text: 'ต้องมีรายการข้อมูลอย่างน้อย 1 แถว',
                    confirmButtonColor: '#4f46e5'
                });
            }
        });
    });
</script>
@endpush