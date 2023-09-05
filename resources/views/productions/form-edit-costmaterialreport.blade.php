@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
</div>
<div class="col-12">
    <div class="card">
        <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('cm-report.update', $hd->costmaterial_report_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <h3 class="card-title" style="font-weight: bold"><a href="{{route('cm-report.index')}}">Cost of Material</h3></a>
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
                        <input type="text" class="form-control" value="{{$hd->costmaterial_report_yearmonth}}" readonly>
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
                                    <th>Job No.</th>
                                    <th>Serial No.</th>
                                    <th>SpecPage No.</th>
                                    <th>Invoice No.</th>
                                    <th>Delivery Date</th>
                                    <th>Description</th>
                                    <th>Buyer</th>
                                    <th>QTY</th>
                                    <th>/Unit</th>
                                    <th>/Total</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dt as $item)
                                    <tr>
                                        <td>{{$item->costmaterial_reportsub_jobno}}</td>
                                        <td>{{$item->costmaterial_reportsub_serialno}}</td>
                                        <td>{{$item->costmaterial_reportsub_specpage}}</td>
                                        <td>{{$item->costmaterial_reportsub_invoice}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->delivery_date)->format('d/m/Y')}}</td>
                                        <td>{{$item->costmaterial_reportsub_desp}}</td>
                                        <td>{{$item->costmaterial_reportsub_cust}}</td>
                                        <td>{{$item->costmaterial_reportsub_qty}}</td>
                                        <td>{{$item->costmaterial_reportsub_unit}}</td>
                                        <td>{{$item->costmaterial_reportsub_total}}</td>
                                        <td>{{$item->costmaterial_reportsub_remark}}</td>
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