@extends('layouts.main')
@section('content')

@if(session('success'))
    <p style="color: green; text-align:center;">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color: red; text-align:center;">{{ session('error') }}</p>
@endif

<style>
.card, .form-container {
    background: #ffffff;
    border-radius: 18px;
    padding: 25px 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    border: 1px solid #e0e0e0;
    margin-bottom: 25px;
}
h2, h3 { text-align: center; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
h3 { font-weight: 500; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px; color: #1e293b; }
th, td { border: 1px solid #cbd5e1; padding: 6px 8px; text-align: center; vertical-align: middle; }
th { background-color: #1e40af; color: #ffffff; font-weight: 600; text-transform: uppercase; }
tr:nth-child(even) { background-color: #f1f5f9; }
td a { color: #1e40af; text-decoration: none; font-weight: 500; }
td a:hover { text-decoration: underline; }
button.primary { background: linear-gradient(180deg, #1e3a8a, #3b82f6); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s ease; }
button.primary:hover { transform: scale(1.05); }
button.edit { background: linear-gradient(180deg, #2563eb, #60a5fa); color:white; border:none; padding:8px 14px; border-radius:6px; font-weight:500; cursor:pointer; transition: all 0.2s ease; }
button.edit:hover { transform: scale(1.05); }
button.delete { background: linear-gradient(180deg, #dc2626, #ef4444); color: white; border: none; padding: 8px 14px; border-radius: 6px; font-weight: 500; cursor: pointer; transition: all 0.2s ease; }
button.delete:hover { transform: scale(1.05); }
.checkbox-group label { display: flex; flex-direction: column; align-items: center; font-size: 13px; }
.checkbox input[type="checkbox"] { transform: scale(1.2); margin-bottom: 4px; }
.actions { display:flex; gap:12px; justify-content:flex-end; margin-top:15px; }
@media (max-width: 1024px){ table, th, td { font-size: 12px; } .form-container { width: 95%; padding: 20px; } }
@media (max-width: 640px){ table { font-size: 11px; } .actions { flex-direction: column; align-items: stretch; } }
</style>

<div class="form-container">
    <h2>ESSOM CO., LTD.</h2>
    <h3>Design Plan </h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Design Request Date</th>
                <th>Product</th>
                <th>Model</th>
                <th>Description</th>
                <th>Reasons</th>
                <th>Design Input 1</th>
                <th>Design Input 2</th>
                <th>Design Input 3</th>
                <th>Design Input 4</th>
                <th>Design Input 5</th>
                <th>Design Input 6</th>
                <th>Design Input 7</th>
                <th>Design Input 8</th>
                <th>Ref Brand1</th>
                <th>Ref Model1</th>
                <th>Ref Brand2</th>
                <th>Ref Model2</th>
                <th>Requested By</th>
                <th>Requested Date</th>
                <th>Reviewed By</th>
                <th>Reviewed Date</th>
                <th>Plan Calc</th>
                <th>Act Calc</th>
                <th>Plan Review</th>
                <th>Act Review</th>
                <th>Participants</th>
                <th>Plan Verify</th>
                <th>Act Verify</th>
                <th>Plan Proto</th>
                <th>Act Proto</th>
                <th>Plan Valid</th>
                <th>Act Valid</th>
                <th>Plan Final</th>
                <th>Act Final</th>
                <th>Planned By (Engineering)</th>
                <th>Planned Date Engineering</th>
                <th>Planned By (Marketing)</th>
                <th>Planned Date Marketing</th>
                <th>Planned By (Plant)</th>
                <th>Planned Date Plant</th>
                <th>Approved By</th>
                <th>Approved Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plans as $plan)
            <tr>
                <td>{{ $plan->id }}</td>
                <td>{{ $plan->design_request_date }}</td>
                <td>{{ $plan->product_name }}</td>
                <td>{{ $plan->product_model }}</td>
                <td>{{ $plan->product_description }}</td>

                @php
                    $reasons = [];
                    if($plan->reason_cost_price) $reasons[] = 'Cost Price';
                    if($plan->reason_catalog_picture) $reasons[] = 'Catalog Picture';
                    if($plan->reason_drawing) $reasons[] = 'Drawing';
                    if($plan->reason_prototype) $reasons[] = 'Prototype';
                    if($plan->reason_other) $reasons[] = $plan->reason_other;
                @endphp
                <td>
                    <div style="display:flex; flex-wrap:wrap; gap:5px;">
                        @foreach($reasons as $reason)
                            <label style="display:flex; flex-direction:column; align-items:center; font-size:12px;">
                                <input type="checkbox" checked disabled> {{ $reason }}
                            </label>
                        @endforeach
                    </div>
                </td>

                @for($i=1; $i<=8; $i++)
                <td>{{ $plan->{'design_input_'.$i} }}</td>
                @endfor

                <td>{{ $plan->ref_brand1 }}</td>
                <td>{{ $plan->ref_model1 }}</td>
                <td>{{ $plan->ref_brand2 }}</td>
                <td>{{ $plan->ref_model2 }}</td>
                <td>{{ $plan->requested_by }}</td>
                <td>{{ $plan->requested_date }}</td>
                <td>{{ $plan->reviewed_by }}</td>
                <td>{{ $plan->reviewed_date }}</td>
                <td>{{ $plan->plan_calc }}</td>
                <td>{{ $plan->act_calc }}</td>
                <td>{{ $plan->plan_review }}</td>
                <td>{{ $plan->act_review }}</td>
                <td>{{ $plan->participants }}</td>
                <td>{{ $plan->plan_verify }}</td>
                <td>{{ $plan->act_verify }}</td>
                <td>{{ $plan->plan_proto }}</td>
                <td>{{ $plan->act_proto }}</td>
                <td>{{ $plan->plan_valid }}</td>
                <td>{{ $plan->act_valid }}</td>
                <td>{{ $plan->plan_final }}</td>
                <td>{{ $plan->act_final }}</td>
                <td>{{ $plan->planned_by }}</td>
                <td>{{ $plan->planned_date_engineering }}</td>
                <td>{{ $plan->planned_marketing }}</td>
                <td>{{ $plan->planned_date_marketing }}</td>
                <td>{{ $plan->planned_plant }}</td>
                <td>{{ $plan->planned_date_plant }}</td>
                <td>{{ $plan->approved_by }}</td>
                <td>{{ $plan->approved_date }}</td>

                <td>
                    <div class="actions">
                        <a href="{{ route('design-plan.edit', $plan->id) }}">
                            <button type="button" class="edit">แก้ไข</button>
                        </a>
                        <form action="{{ route('design-plan.destroy', $plan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete" onclick="return confirm('แน่ใจว่าจะลบ?')">ลบ</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="actions">
        <a href="{{ route('design-plan.create') }}">
            <button class="primary">+ สร้าง Design Plan ใหม่</button>
        </a>
    </div>
</div>
@endsection
