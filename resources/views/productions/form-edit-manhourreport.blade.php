@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
</div>
<div class="col-12">
    <div class="card">
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('mn-report.update', $hd->manhour_report_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <h3 class="card-title" style="font-weight: bold"><a href="{{route('mn-report.index')}}">Man Hour Report</h3></a>
                </div>
                <div class="col-12 col-md-3">
                    @if($hd->reviewed_by == null)
                    <button type="submit" class="btn btn-block btn-primary">
                        Review
                    </button>
                    @elseif($hd->acknowledges_by == null)
                    <button type="submit" class="btn btn-block btn-primary">
                        Acknowledges
                     </button>
                    @endif                 
                </div>
            </div>           
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_yearmonth">ปี-เดือน</label>
                        <input type="text" class="form-control" value="{{$hd->manhour_report_yearmonth}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_product">Production</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_product,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_si">ซ่อมอุปกรณ์พ่นสี(SI)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_si,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_se">ซ่อมอุปกรณ์การศึกษา(SE)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_se,2)}}" readonly>
                    </div>
                </div>                         
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_sf">ซ่อมบำรุงภายในโรงงาน(SF)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_sf,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_di">ส่งอุปกรณ์พ่นสี(DI)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_di,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_dd">ส่งอุปกรณ์การศึกษาในประเทศ(DD)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_dd,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_de">ส่งอุปกรณ์การศึกษาต่างประเทศ(DE)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_de,2)}}" readonly>
                    </div>
                </div>
            </div>      
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_c">ทำความสะอาด(C)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_c,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_o">อื่นๆ(O)</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_o,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_en">EN</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_en,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_admin">ADMIN</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_admin,2)}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="manhour_report_total">TOTAL</label>
                        <input type="text" class="form-control" value="{{number_format($hd->manhour_report_total,2)}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="created_person">Prepared By</label>
                        <input type="text" class="form-control" value="{{$hd->created_person}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="reviewed_by">Review By</label>
                        <input type="text" class="form-control" value="{{$hd->reviewed_by}}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="acknowledges_by">Acknowledges By</label>
                        <input type="text" class="form-control" value="{{$hd->acknowledges_by}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                                <tr>
                                    <th>Job</th>
                                    <th>Model</th>
                                    <th>Mach</th>
                                    <th>Small1</th>
                                    <th>Small2</th>
                                    <th>Large</th>
                                    <th>Elect</th>
                                    <th>Instru</th>
                                    <th>Paint</th>
                                    <th>Del</th>
                                    <th>Service</th>
                                    <th>Other</th>
                                    <th>MH Begin Of Month</th>
                                    <th>MH This Of Month</th>
                                    <th>MH END Of Month</th>
                                    <th>MH Standard /Unit</th>
                                    <th>Qty</th>
                                    <th>Total MHR Budget</th>
                                    <th>Total MHR Standard</th>
                                    <th>Remark</th>
                                </tr>
                           </thead>
                           <tbody>
                                @foreach ($dt as $item)
                                    <tr>
                                        <td>{{$item->manhour_reportsub_jobno}}</td>
                                        <td>{{$item->manhour_reportsub_model}}</td>
                                        <td>{{number_format($item->manhour_reportsub_mach,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_small1,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_small2,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_large,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_elect,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_instru,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_paint,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_del,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_service,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_other,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_begin,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_this,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_end,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_unit,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_qty,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_budget,2)}}</td>
                                        <td>{{number_format($item->manhour_reportsub_standard,2)}}</td>
                                        <td>{{$item->manhour_reportsub_reamrk}}</td>
                                    </tr>
                                @endforeach
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </div>
        </form>       
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script>
</script>
@endpush  