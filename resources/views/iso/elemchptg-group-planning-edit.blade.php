@extends('layouts.main')

@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --primary-light: #e0e7ff;
        --bg-surface: #f8fafc;
        --text-main: #0f172a;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --radius-lg: 16px;
        --radius-md: 10px;
        --radius-sm: 6px;
    }

    .custom-card { border: none; border-radius: var(--radius-lg); box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05); background: #ffffff; overflow: hidden; }
    .custom-card-header { background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); color: #ffffff; padding: 1.75rem 2rem; }
    .doc-badge { background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(8px); color: #ffffff; font-size: 0.8rem; padding: 0.35rem 0.85rem; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.2); }
    .form-group label { font-size: 0.825rem; font-weight: 600; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.4rem; }
    .form-control { border-radius: var(--radius-md); border: 1px solid var(--border-color); padding: 0.6rem 0.9rem; font-size: 0.9rem; background-color: #fafafa; }
    .form-control:focus { background-color: #ffffff; border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15); }
    .section-title-custom { font-size: 1.05rem; font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 0.5rem; }
    .section-title-custom::before { content: ''; width: 4px; height: 18px; background-color: var(--primary-color); border-radius: 4px; }
    .table-modern-form thead th { background-color: #f1f5f9 !important; color: #334155; font-weight: 600; font-size: 0.825rem; text-transform: uppercase; }
    .btn-add-row { background-color: var(--primary-color); color: #ffffff; font-weight: 600; border-radius: var(--radius-md); padding: 0.45rem 1rem; border: none; }
    .btn-action-delete { width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: var(--radius-sm); background-color: #fee2e2; color: #ef4444; border: none; }
    .weekly-card { background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 0.75rem 1rem; }
    .set-container { border: 2px solid #e2e8f0; border-radius: var(--radius-lg); padding: 2rem; background-color: #ffffff; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02); }
</style>

<form action="{{ route('elemchptg-plannings.update', $hd->elemchptggroup_planning_hds_id) }}" method="POST">
    @csrf
    @method('PUT')   
    <input type="hidden" name="doc_ref" value="Edit">
    
    <div class="container-fluid py-4">
        <div class="row">  
            <div class="col-12">
                <div class="card custom-card">
                    <div class="custom-card-header">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                            <div>
                                <h5 class="m-0 text-white">ESSOM CO., LTD</h5>
                                <h6 class="m-0 font-weight-normal text-white-50" style="font-size: 1rem;">Electrical, Machining, and Painting Group Planning (แก้ไขข้อมูล)</h6>
                            </div>
                            <div><span class="doc-badge"><i class="fa fa-file-text-o me-1"></i> F8510.3(S) (9 Feb. 17)</span></div>
                        </div>
                    </div>

                    <div class="card-body p-4">     
                        
                        {{-- วนลูปแสดงฟอร์มทั้ง 3 ชุด พร้อมดึงข้อมูลเดิม (Detail) ที่ตรงกับ set_no มาแสดง --}}
                        @foreach([1 => 'Electrical', 2 => 'Machining', 3 => 'Painting'] as $setId =>$setName)
                            @php
                                // ค้นหาข้อมูล Detail ของชุดนี้จากฐานข้อมูล
                                $item = $hd->details->where('set_no',$setId)->first();
                            @endphp

                            <div class="set-container">
                                <h4 class="text-primary fw-bold fs-5 mb-4 border-bottom pb-2">
                                    <i class="fa fa-bookmark me-1"></i> ชุดข้อมูลที่ {{ $setId }} : {{$setName }}
                                </h4>
                                
                                <div class="row g-3 mb-3">
                                    <div class="col-md-3"><div class="form-group"><label><i class="fa fa-sitemap me-1"></i> Section</label><input class="form-control" type="text" name="sets[{{ $setId }}][section]" value="{{ old('sets.'.$setId.'.section',$item->section ?? '') }}" placeholder="ระบุแผนก..."></div></div>
                                    <div class="col-md-3"><div class="form-group"><label><i class="fa fa-barcode me-1"></i> Product Code</label><input class="form-control" type="text" name="sets[{{ $setId }}][product_code]" value="{{ old('sets.'.$setId.'.product_code',$item->product_code ?? '') }}" placeholder="รหัสสินค้า..."></div></div>
                                    <div class="col-md-3"><div class="form-group"><label><i class="fa fa-tasks me-1"></i> Job No</label><input class="form-control" type="text" name="sets[{{ $setId }}][job_no]" value="{{ old('sets.'.$setId.'.job_no',$item->job_no ?? '') }}" placeholder="หมายเลขงาน..."></div></div>
                                    <div class="col-md-3"><div class="form-group"><label><i class="fa fa-cubes me-1"></i> Qty</label><input class="form-control" type="number" name="sets[{{ $setId }}][qty]" value="{{ old('sets.'.$setId.'.qty',$item->qty ?? '') }}" placeholder="จำนวน..."></div></div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-3"><div class="form-group"><label><i class="fa fa-user me-1"></i> Customer</label><input class="form-control" type="text" name="sets[{{ $setId }}][customer]" value="{{ old('sets.'.$setId.'.customer',$item->customer ?? '') }}" placeholder="ชื่อลูกค้า..."></div></div>
                                    <div class="col-md-3"><div class="form-group"><label><i class="fa fa-user-circle me-1"></i> Responsible</label><input class="form-control" type="text" name="sets[{{ $setId }}][responsible]" value="{{ old('sets.'.$setId.'.responsible',$item->responsible ?? '') }}" placeholder="ผู้รับผิดชอบ..."></div></div>
                                    <div class="col-md-3"><div class="form-group"><label><i class="fa fa-clock-o me-1"></i> Budget Time (MH)</label><input class="form-control" type="text" name="sets[{{ $setId }}][budget_time]" value="{{ old('sets.'.$setId.'.budget_time',$item->budget_time ?? '') }}" placeholder="เวลาที่กำหนด..."></div></div>
                                    <div class="col-md-3"><div class="form-group"><label><i class="fa fa-calendar me-1"></i> For Date</label><input class="form-control" type="date" name="sets[{{ $setId }}][mh_for_date]" value="{{ old('sets.'.$setId.'.mh_for_date',$item->mh_for_date ?? '') }}"></div></div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-3"><div class="form-group"><label><i class="fa fa-calendar-check-o me-1"></i> To Date</label><input class="form-control" type="date" name="sets[{{ $setId }}][to_date]" value="{{ old('sets.'.$setId.'.to_date',$item->to_date ?? '') }}"></div></div>
                                    <div class="col-md-9"><div class="form-group"><label><i class="fa fa-commenting-o me-1"></i> Remark</label><input class="form-control" type="text" name="sets[{{ $setId }}][remark]" value="{{ old('sets.'.$setId.'.remark',$item->remark ?? '') }}" placeholder="หมายเหตุเพิ่มเติม..."></div></div>
                                </div>

                                <hr class="my-4" style="border-color: var(--border-color); opacity: 0.6;">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="section-title-custom">Planning Schedule Details</div>
                                    <button type="button" class="btn btn-sm btn-add-row addRowBtn" data-set="{{ $setId }}"><i class="fa fa-plus me-1"></i> เพิ่มแถว</button>
                                </div>

                                <div class="table-responsive mb-4">
                                    <table class="table table-bordered table-modern-form text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="align-middle" style="min-width: 260px; width: 30%;">Description</th>
                                                <th colspan="6" class="py-2">
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <span>Month</span>
                                                        <input class="form-control d-inline-block py-1 px-2 text-center" type="text" name="sets[{{ $setId }}][month_1]" value="{{ old('sets.'.$setId.'.month_1',$item->month_1 ?? '') }}" placeholder="ระบุเดือน..." style="max-width: 180px; font-size: 0.85rem;">
                                                    </div>
                                                </th>
                                                <th rowspan="2" class="align-middle" style="width: 50px;">Action</th>
                                            </tr>
                                            <tr>
                                                @for($j=1; $j<=6; $j++)<th style="width: 4%; min-width: 40px;">{{ $j }}</th>@endfor
                                            </tr>
                                        </thead>
                                        <tbody class="table-body-container" id="tableBody_{{ $setId }}">
                                            @php
                                                $savedDetails =$item->details ?? [];
                                            @endphp

                                            @if(count($savedDetails) > 0)
                                                @foreach($savedDetails as $rowIndex =>$rowVal)
                                                <tr>
                                                    <td><input class="form-control text-start" type="text" name="sets[{{ $setId }}][details][{{ $rowIndex }}][description]" value="{{ $rowVal['description'] ?? '' }}" placeholder="รายละเอียดงาน..."></td>
                                                    @for($i=0; $i<6; $i++)
                                                    <td><input class="form-control px-1 text-center" type="text" name="sets[{{ $setId }}][details][{{ $rowIndex }}][val_{{$i }}]" value="{{ $rowVal['val_'.$i] ?? '' }}"></td>
                                                    @endfor
                                                    <td><button type="button" class="btn-action-delete remove-row" title="ลบแถว"><i class="fa fa-trash"></i></button></td>
                                                </tr>
                                                @endforeach
                                            @else
                                                {{-- ถ้ายังไม่มีข้อมูล ให้แสดงแถวว่าง 1 แถว --}}
                                                <tr>
                                                    <td><input class="form-control text-start" type="text" name="sets[{{ $setId }}][details][0][description]" placeholder="รายละเอียดงาน..."></td>
                                                    @for($i=0; $i<6; $i++)<td><input class="form-control px-1 text-center" type="text" name="sets[{{ $setId }}][details][0][val_{{$i }}]"></td>@endfor
                                                    <td><button type="button" class="btn-action-delete remove-row" title="ลบแถว"><i class="fa fa-trash"></i></button></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-start ps-3 text-secondary">Ack.</th>
                                                @for($i=0; $i<6; $i++)
                                                <td><input class="form-control px-1 text-center" type="text" name="sets[{{ $setId }}][ack][{{$i }}]" value="{{ $item->ack[$i] ?? '' }}"></td>
                                                @endfor
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th class="text-start ps-3 text-secondary">Date</th>
                                                @for($i=0; $i<6; $i++)
                                                <td><input class="form-control px-1 text-center" type="date" name="sets[{{ $setId }}][ack_date][{{$i }}]" value="{{ $item->ack_date[$i] ?? '' }}" style="font-size: 0.8rem;"></td>
                                                @endfor
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <hr class="my-4" style="border-color: var(--border-color); opacity: 0.6;">

                                <div class="section-title-custom mb-3">Weekly Review</div>
                                <div class="row g-3">
                                    @for($w=1; $w<=6; $w++)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="weekly-card">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="badge" style="background-color: var(--primary-light); color: var(--primary-color);">Week {{ $w }}</span>
                                            </div>
                                            <div class="form-group mb-0">
                                                <input class="form-control" type="text" name="sets[{{ $setId }}][weekly_review][{{$w }}][col1]" value="{{ $item->weekly_review[$w]['col1'] ?? '' }}" placeholder="บันทึกการทบทวน...">
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>

                            </div>
                        @endforeach

                        <!-- Signatures Section -->
                        <div class="section-title-custom mb-3 mt-4">Signatures</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-2"><div class="form-group"><label>Prepared By</label><input class="form-control" type="text" name="prepared_by" value="{{ $hd->prepared_by ?? auth()->user()->name }}" readonly></div></div>
                            <div class="col-md-2"><div class="form-group"><label>Date</label><input class="form-control" type="date" name="prepared_date" value="{{ $hd->prepared_date ?? date('Y-m-d') }}"></div></div>
                            <div class="col-md-2"><div class="form-group"><label>Checked By</label><input class="form-control" type="text" name="checked_by" value="{{ $hd->checked_by ?? '' }}" readonly></div></div>
                            <div class="col-md-2"><div class="form-group"><label>Date</label><input class="form-control" type="date" name="checked_date" value="{{ $hd->checked_date ?? '' }}" readonly></div></div>
                            <div class="col-md-2"><div class="form-group"><label>Approved By</label><input class="form-control" type="text" name="approved_by" value="{{ $hd->approved_by ?? '' }}" readonly></div></div>
                            <div class="col-md-2"><div class="form-group"><label>Date</label><input class="form-control" type="date" name="approved_date" value="{{ $hd->approved_date ?? '' }}" readonly></div></div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold" style="border-radius: 8px; background-color: var(--primary-color);">
                                <i class="fa fa-save me-1"></i> บันทึกการแก้ไขข้อมูล
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // กำหนด Index เริ่มต้นให้สอดคล้องกับจำนวนแถวที่มีอยู่แล้วในแต่ละตาราง (ป้องกันการซ้ำซ้อนเวลาเพิ่มแถวใหม่)
        let rowIndices = {};
        @foreach([1, 2, 3] as $setId)
            rowIndices['{{ $setId }}'] = document.querySelectorAll('#tableBody_{{ $setId }} tr').length;
        @endforeach

        document.querySelectorAll('.addRowBtn').forEach(button => {
            button.addEventListener('click', function () {
                let suffix = this.getAttribute('data-set');
                let tbody = document.getElementById('tableBody_' + suffix);
                let currentIndex = rowIndices[suffix];
                
                let newRow = document.createElement('tr');
                let html = `<td><input class="form-control text-start" type="text" name="sets[${suffix}][details][${currentIndex}][description]" placeholder="รายละเอียดงาน..."></td>`;
                for (let i = 0; i < 6; i++) {
                    html += `<td><input class="form-control px-1 text-center" type="text" name="sets[${suffix}][details][${currentIndex}][val_${i}]"></td>`;
                }
                html += `<td><button type="button" class="btn-action-delete remove-row" title="ลบแถว"><i class="fa fa-trash"></i></button></td>`;
                
                newRow.innerHTML = html;
                tbody.appendChild(newRow);
                rowIndices[suffix]++;
            });
        });

        document.querySelectorAll('.table-body-container').forEach(tbody => {
            tbody.addEventListener('click', function (e) {
                if (e.target.closest('.remove-row')) {
                    let row = e.target.closest('tr');
                    if (this.rows.length > 1) {
                        row.remove();
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ไม่สามารถลบได้',
                            text: 'ต้องมีรายการข้อมูลอย่างน้อย 1 แถว',
                            confirmButtonColor: '#4f46e5'
                        });
                    }
                }
            });
        });
    });
</script>
@endpush