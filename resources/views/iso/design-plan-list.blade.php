@extends('layouts.main')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'สำเร็จ!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#1e40af'
    });
</script>
@endif

@if(session('error'))
<script>
    
    Swal.fire({
        icon: 'error',
        title: 'เกิดข้อผิดพลาด!',
        text: "{{ session('error') }}",
        confirmButtonColor: '#dc2626'
    });
</script>
@endif
<style>

button.primary, button.edit, button.delete, .dt-button { cursor:pointer; transition: all 0.2s ease; }
button.primary { background: linear-gradient(180deg, #1e3a8a, #3b82f6); color:white; border:none; padding:10px 18px; border-radius:8px; font-weight:600; }
button.primary:hover { transform: scale(1.05); }

button.edit { background: linear-gradient(180deg, #2563eb, #60a5fa); color:white; border:none; padding:8px 14px; border-radius:6px; font-weight:500; }
button.edit:hover { transform: scale(1.05); }

button.delete { background: linear-gradient(180deg, #dc2626, #ef4444); color:white; border:none; padding:8px 14px; border-radius:6px; font-weight:500; }
button.delete:hover { transform: scale(1.05); }

.dt-button { background: linear-gradient(180deg, #cecaca, #827c7c); color:white; border:none; padding:8px 18px; border-radius:8px; font-weight:600; }
.dt-button:hover { transform: scale(1.05); }

#searchInput { border:1px solid #94a3b8; border-radius:5px; padding:6px 10px; width:220px; margin-bottom:10px; }
#searchInput:focus { border-color:#1e40af; box-shadow:0 0 4px rgba(59,130,246,0.3); outline:none; }

.table-container { overflow-x:auto; }
table { width:100%; border-collapse:collapse; font-size:15px; margin-top:20px; }
th, td { border:1px solid #cbd5e1; padding:8px 10px; text-align:center; vertical-align:middle; }
th { background-color:#cdcfd4ff; font-weight:600; }
tr:nth-child(even) { background-color:#f1f5f9; }
.section-title { text-align:left; background-color:#36404fff; color:white; font-weight:800; padding:6px; }
.actions { display:flex; gap:10px; justify-content:center; flex-wrap:wrap; }
</style>

<div class="wrap">
    <div class="card">
        <h2 align="center">ESSOM CO.,LTD.<br>แผนการออกแบบผลิตภัณฑ์<br>DESIGN REQUEST AND DESIGN PLANNING</h2>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap:10px;">
            <a href="{{ route('design-plan.create') }}" class="primary">เพิ่มข้อมูลใหม่</a>
            <input type="text" id="searchInput" placeholder="🔍 ค้นหา...">
        </div>

        <div style="margin-bottom:10px;">
            <button id="printBtn" class="dt-button">print</button>
            <button id="exportExcelBtn" class="dt-button">excel</button>
        </div>
            <table id="planTable">

                @foreach($plans as $plan)
                <thead>
                    <tr><th colspan="4" class="section-title">1.1 Design Request</th></tr>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Model</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $plan->design_request_date }}</td>
                        <td>{{ $plan->product_name }}</td>
                        <td>{{ $plan->product_model }}</td>
                        <td>{{ $plan->product_description }}</td>
                    </tr>
                </tbody>
                    <tr><th colspan="4" class="section-title">1.2 Reasons</th></tr>
                    <tr>
                        <th>Cost Price</th>
                        <th>Picture for Catalog</th>
                        <th>Drawing</th>
                        <th>Prototype</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $plan->reason_cost_price ? '✔' : '' }}</td>
                        <td>{{ $plan->reason_catalog_picture ? '✔' : '' }}</td>
                        <td>{{ $plan->reason_drawing ? '✔' : '' }}</td>
                        <td>{{ $plan->reason_prototype ? '✔' : '' }}</td>
                    </tr>
                </tbody>

                <thead>
                    <tr><th colspan="4" class="section-title">Other</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">{{ $plan->reason_other }}</td>
                    </tr>
                </tbody>

                <thead>
                    <tr><th colspan="4" class="section-title">1.4 Reference</th></tr>
                    <tr>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Brand</th>
                        <th>Model</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $plan->ref_brand1 }}</td>
                        <td>{{ $plan->ref_model1 }}</td>
                        <td>{{ $plan->ref_brand2 }}</td>
                        <td>{{ $plan->ref_model2 }}</td>
                    </tr>
                </tbody>
                <thead>
                    <tr><th colspan="4" class="section-title">1.5 Requested / Reviewed</th></tr>
                    <tr>
                        <th>Requested By</th>
                        <th>Requested Date</th>
                        <th>Reviewed By</th>
                        <th>Reviewed Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $plan->requested_by }}</td>
                        <td>{{ $plan->requested_date }}</td>
                        <td>{{ $plan->reviewed_by }}</td>
                        <td>{{ $plan->reviewed_date }}</td>
                    </tr>
                </tbody>

                <thead>
                    <tr><th colspan="4" class="section-title">1.6 Approved</th></tr>
                    <tr>
                        <th>Approved By</th>
                        <th>Date</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="color: {{ $plan->Approveds_by ? 'green':'red' }}">{{ $plan->Approveds_by ?? '-' }}</td>
                        <td>{{ $plan->Approveds_date ?? '-' }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>

                <thead>
                    <tr><th colspan="1" class="section-title">2. Design Planning</th>
                   <th colspan="1" class="section-title">Planning</th>
                <th colspan="3" class="section-title" >Actual</th>  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Engineer</td>
                        <td colspan="3">{{ $plan->engineer_desing }}</td>
                    </tr>
                      <tr>
                    <td >Senior Engineer</td>
                        <td colspan="3">{{ $plan->senior_engineer }}</td>
                        </tr>
                    <tr>
                        <td>2.3.1 Preliminary Design & Calculations</td>
                        <td>{{ $plan->plan_calc }}</td>
                        <td colspan="3">{{ $plan->act_calc }}</td>
                    </tr>
                    <tr>
                        <td>2.3.2 Design Review</td>
                        <td>{{ $plan->plan_review }}</td>
                        <td colspan="3">{{ $plan->act_review }}</td>
                    </tr>
                    <tr>
                        <td>Participants</td>
                        <td colspan="3">{{ $plan->participants }}</td>
                    </tr>
                    <tr>
                        <td>2.3.3 Design Verification</td>
                        <td>{{ $plan->plan_verify }}</td>
                        <td colspan="3">{{ $plan->act_verify }}</td>
                    </tr>
                    <tr>
                        <td>2.3.4 Prototype Production</td>
                        <td>{{ $plan->plan_proto }}</td>
                        <td colspan="3">{{ $plan->act_proto }}</td>
                    </tr>
                    <tr>
                        <td>2.3.5 Validation</td>
                        <td>{{ $plan->plan_valid }}</td>
                        <td colspan="3">{{ $plan->act_valid }}</td>
                    </tr>
                    <tr>
                        <td>2.3.6 Final Design Approval</td>
                        <td>{{ $plan->plan_final }}</td>
                        <td colspan="3">{{ $plan->act_final }}</td>
                    </tr>
                  
                <thead>
                    <tr><th colspan="4" class="section-title">Planned /Approval</th>
                     </thead>
                <tbody>
                    <tr>
                     <td>Planned By Engineering</td>
                        <td>{{ $plan->planned_by }}</td>
                        <td>Date</td>
                        <td>{{ $plan->planned_date_engineering }}</td>
                    </tr>
                    <tr>
                        <td>Planned By Marketing</td>
                        <td>{{ $plan->planned_marketing }}</td>
                        <td>Date</td>
                        <td>{{ $plan->planned_date_marketing }}</td>
                    </tr>
                    <tr>
                        <td>Planned By Plant</td>
                        <td>{{ $plan->planned_plant }}</td>
                        <td>Date</td>
                        <td>{{ $plan->planned_date_plant }}</td>
                    </tr>
                    <tr>
                        <td>Approved By</td>
                        <td>{{ $plan->approved_by }}</td>
                        <td>Date</td>
                        <td>{{ $plan->approved_date }}</td>
                    </tr>
                </tbody>
 <thead>
                    <tr><th colspan="4" class="section-title">Actions</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">
                            <div class="actions">
                                <a href="{{ route('design-plan.edit', $plan->id) }}"><button type="button" class="edit">แก้ไข</button></a>
                                <form action="{{ route('design-plan.destroy', $plan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete" onclick="return confirm('แน่ใจว่าจะลบ?')">ลบ</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>

                @endforeach

            </table>
</div>
  </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('#planTable tbody tr');
    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    document.getElementById('printBtn').addEventListener('click', function() {
        window.print();
    });

    document.getElementById('exportExcelBtn').addEventListener('click', function() {
        const table = document.getElementById('planTable');
        const rows = table.querySelectorAll('tr');
        let wb = XLSX.utils.book_new();
        let ws_data = [];

        rows.forEach(row => {
            const rowData = [];
            row.querySelectorAll('th, td').forEach(cell => {
                rowData.push(cell.innerText.trim());
            });
            ws_data.push(rowData);
        });

        let ws = XLSX.utils.aoa_to_sheet(ws_data);
        XLSX.utils.book_append_sheet(wb, ws, "Design_Plan");
        XLSX.writeFile(wb, "Design_Plan.xlsx");
    });
});
</script>
@endsection