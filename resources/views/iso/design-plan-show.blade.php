

<style>
.card, .form-container { 
    background: #ffffff; 
    border-radius: 18px; 
    padding: 30px 40px; 
    box-shadow: 0 6px 20px rgba(0,0,0,0.08); 
    border: 1px solid #e0e0e0; 
    margin: 40px auto; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    max-width: 1200px; 
}
h4 { text-align: center; margin-bottom: 8px; color: #0f172a; }
.section-title { font-size: 18px; font-weight: 700; color: #1e293b; margin-top: 20px; margin-bottom: 10px; border-bottom: 2px solid #94a3b8; padding-bottom: 4px; }
label { font-weight: 600; color: #1e293b; margin-bottom: 4px; display: block; }
input, textarea { border: 1px solid #94a3b8; border-radius: 6px; padding: 8px 12px; font-size: 14px; width: 100%; box-sizing: border-box; background-color: #f8fafc; }
input[readonly], textarea[readonly] { background-color: #e2e8f0; }
.row { display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 15px; align-items: flex-start; }
.row > div { flex: 1; min-width: 120px; display: flex; flex-direction: column; }
.checkbox-group { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
.checkbox-group label { display: flex; align-items: center; gap: 5px; }
</style>

<div class="form-container">
    <center>
        <h4>ESSOM CO.,LTD.</h4>
        <h4>แผนการออกแบบผลิตภัณฑ์</h4>
        <h4>DESIGN REQUEST AND DESIGN PLANNING</h4>
    </center>
    <p class="text-right">F8300.1<br>19 Jan. 22</p>
    <div class="section">
        <div class="section-title">1. Design Request</div>
        <div class="row">
            <div>
                <label>Product:</label>
                <input type="text" value="{{ $plan->product_name }}" readonly>
            </div>
            <div>
                <label>Model:</label>
                <input type="text" value="{{ $plan->product_model }}" readonly>
            </div>
        </div>
        <div class="row">
            <div>
                <label>Description:</label>
                <input type="text" value="{{ $plan->product_description }}" readonly>
            </div>
        </div>
        <div class="checkbox-group">
            <label><input type="checkbox" {{ $plan->reason_cost_price ? 'checked' : '' }} disabled> Cost Price</label>
            <label><input type="checkbox" {{ $plan->reason_catalog_picture ? 'checked' : '' }} disabled> Picture for Catalog</label>
            <label><input type="checkbox" {{ $plan->reason_drawing ? 'checked' : '' }} disabled> Drawing</label>
            <label><input type="checkbox" {{ $plan->reason_prototype ? 'checked' : '' }} disabled> Prototype</label>
        </div>
        <div class="row">
            <div>
                <label>Other:</label>
                <input type="text" value="{{ $plan->reason_other }}" readonly>
            </div>
        </div>

        <label>Design Inputs:</label>
        <div class="row" style="display:grid; grid-template-columns: repeat(4, 1fr); gap:10px;">
            @for($i=1;$i<=8;$i++)
            <div>
                <label>{{ $i }})</label>
                <input type="text" value="{{ $plan->{'design_input_'.$i} }}" readonly>
            </div>
            @endfor
        </div>
    </div>

    <div class="section">
        <label>References:</label>
        <div class="row">
            <div><label>Brand 1</label><input type="text" value="{{ $plan->ref_brand1 }}" readonly></div>
            <div><label>Model 1</label><input type="text" value="{{ $plan->ref_model1 }}" readonly></div>
            <div><label>Brand 2</label><input type="text" value="{{ $plan->ref_brand2 }}" readonly></div>
            <div><label>Model 2</label><input type="text" value="{{ $plan->ref_model2 }}" readonly></div>
        </div>
    </div>

    <div class="section">
        <label>Requested/Reviewed/Approved By:</label>
        <div class="row">
            <div><label>Requested By</label><input type="text" value="{{ $plan->requested_by }}" readonly></div>
            <div><label>Date</label><input type="date" value="{{ $plan->requested_date }}" readonly></div>
            <div><label>Reviewed By</label><input type="text" value="{{ $plan->reviewed_by }}" readonly></div>
            <div><label>Date</label><input type="date" value="{{ $plan->reviewed_date }}" readonly></div>
        </div>
        <div class="row">
            <div><label>Approved By</label><input type="text" value="{{ $plan->approved_by_request }}" readonly></div>
            <div><label>Date</label><input type="date" value="{{ $plan->approved_date_request }}" readonly></div>
        </div>
    </div>

    <div class="section">
        <label>Design Planning</label>
        <div class="row">
            <div><label>Engineer</label><input type="text" value="{{ $plan->engineer_desing }}" readonly></div>
            <div><label>Senior Engineer</label><input type="text" value="{{ $plan->senior_engineer }}" readonly></div>
   </div>

        @php
            $dueRows = [
                '2.3.1 Preliminary Design & Calculations' => ['plan_calc','act_calc'],
                '2.3.2 Design Review' => ['plan_review','act_review'],
                'Participants' => ['participants'],
                '2.3.3 Design Verification' => ['plan_verify','act_verify'],
                '2.3.4 Prototype Production' => ['plan_proto','act_proto'],
                '2.3.5 Validation' => ['plan_valid','act_valid'],
                '2.3.6 Final Design Approval' => ['plan_final','act_final'],
            ];
        @endphp
        @foreach ($dueRows as $label => $fields)
        <div class="row">
            <div style="flex:1; min-width:200px;"><label>{{ $label }}</label></div>
            @if(count($fields) === 1)
                <div style="flex:1; min-width:200px;"><input type="text" value="{{ $plan->{$fields[0]} }}" readonly></div>
            @else
                <div style="flex:1; min-width:140px;"><input type="date" value="{{ $plan->{$fields[0]} }}" readonly></div>
                <div style="flex:1; min-width:140px;"><input type="date" value="{{ $plan->{$fields[1]} }}" readonly></div>
            @endif
        </div>
        @endforeach
        <div class="row" style="display:flex; align-items:center; margin-bottom:10px;">
            <div style="flex:1; display:flex; align-items:center;">
                <label style="width:120px;">Planned By</label>
                <input type="text" value="{{ $plan->planned_by }}" readonly style="flex:1; padding:5px;">
            </div>
            <div style="flex:1; text-align:center;">Engineering Section</div>
            <div style="flex:1; display:flex; align-items:center;">
                <label style="width:50px;">Date</label>
                <input type="date" value="{{ $plan->planned_date_engineering }}" readonly style="flex:1; padding:5px;">
            </div>
        </div>
        <div class="row" style="display:flex; align-items:center; margin-bottom:10px;">
            <div style="flex:1; display:flex; align-items:center;">
                <input type="text" value="{{ $plan->planned_marketing }}" readonly style="flex:1; padding:5px;">
            </div>
            <div style="flex:1; text-align:center;">Marketing Representative</div>
            <div style="flex:1; display:flex; align-items:center;">
                <label style="width:50px;">Date</label>
                <input type="date" value="{{ $plan->planned_date_marketing }}" readonly style="flex:1; padding:5px;">
            </div>
        </div>
        <div class="row" style="display:flex; align-items:center; margin-bottom:10px;">
            <div style="flex:1; display:flex; align-items:center;">
                <input type="text" value="{{ $plan->planned_plant }}" readonly style="flex:1; padding:5px;">
            </div>
            <div style="flex:1; text-align:center;">Plant Representative</div>
            <div style="flex:1; display:flex; align-items:center;">
                <label style="width:50px;">Date</label>
                <input type="date" value="{{ $plan->planned_date_plant }}" readonly style="flex:1; padding:5px;">
            </div>
        </div>
        <div class="row" style="display:flex; align-items:center; margin-bottom:10px;">
            <div style="flex:1; display:flex; align-items:center;">
                <label style="width:130px;">Approved By</label>
                <input type="text" value="{{ $plan->approved_by }}" readonly style="flex:1; padding:5px;">
            </div>
            <div style="flex:1;"></div>
            <div style="flex:1; display:flex; align-items:center;">
                <label style="width:50px;">Date</label>
                <input type="date" value="{{ $plan->approved_date }}" readonly style="flex:1; padding:5px;">
            </div>
        </div>
    </div>
</div>


