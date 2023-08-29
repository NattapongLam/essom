@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Projects Detail</h3>    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                  <div class="row">
                    <div class="col-12 col-sm-4">
                      <div class="info-box bg-light">
                        <div class="info-box-content">
                          <span class="info-box-text text-center text-muted">Estimate budget</span>
                          <span class="info-box-number text-center text-muted mb-0">{{number_format($job->productionopenjob_estimatecost,2)}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-4">
                      <div class="info-box bg-light">
                        <div class="info-box-content">
                          <span class="info-box-text text-center text-muted">Total amount spent</span>
                          <span class="info-box-number text-center text-muted mb-0">{{number_format($job->productionopenjob_actualcost,2)}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-4">
                      <div class="info-box bg-light">
                        <div class="info-box-content">
                          <span class="info-box-text text-center text-muted">Total Time</span>
                          <span class="info-box-number text-center text-muted mb-0">{{number_format($job->totaltime,2)}}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <h4>Recent Activity</h4>
                      @foreach ($doc as $item)
                      <div class="post">
                        {{-- <div class="user-block"> --}}
                          <span class="username">
                            @if ($item->status == 'ยกเลิก')
                            <span class="badge badge-danger">
                                {{$item->status}}
                            </span>
                            @elseif($item->status == 'อนุมัติ' || $item->status == 'อนุมัติตรวจรับ' || $item->status == 'สรุปเรียบร้อย' )
                            <span class="badge badge-success">
                                {{$item->status}}
                            </span>
                            @else
                            <span class="badge badge-warning">
                                {{$item->status}}
                            </span>
                            @endif
                            @if ($item->type == 'ใบเบิกวัสดุอุปกรณ์')
                                        <a href="{{route('pd-ladi.show',$item->docuno)}}"  target=”_blank”>
                                        {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบขอซื้อ')
                                        <a href="{{route('pd-requ.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบสั่งงาน')
                                        <a href="{{route('pd-work.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบบันทึกชั่วโมงการทำงาน')
                                        <a href="{{route('pd-woho.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบตรวจสอบกระบวนขั้นสุดท้าย')
                                        <a href="{{route('fl-inst.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบรับคืนจากการเบิก')
                                        <a href="{{route('pd-retu.show',$item->docuno)}}"  target=”_blank”>
                                            {{$item->docuno}}
                                        </a>
                                        @elseif($item->type == 'ใบโอนย้ายวัสดุอุปกรณ์')
                                            {{$item->docuno}}
                                        @endif
                          </span><br>
                          <span class="description">{{$item->type}} - {{$item->created_person}} : {{\Carbon\Carbon::parse($item->date)->format('d/m/Y')}} </span>
                        {{-- </div> --}}
                        <!-- /.user-block -->
                        <p>
                            {{$item->remark}}
                        </p>
                      </div>
                      @endforeach                    
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                  <h3 class="text-primary">Job No. {{$job->productionopenjob_hd_docuno}} ({{$job->ms_product_code}})</h3>
                  <p class="text-muted">Product : {{$job->ms_product_name}}</p>
                  <p class="text-muted">Spec Page : {{$job->ms_specpage_name}}</p>
                  <br>
                  <div class="text-muted">
                    <p class="text-sm">Client Company
                      <b class="d-block">{{$job->ms_customer_name}}</b>
                    </p>
                    <p class="text-sm">Project Leader
                      <b class="d-block">{{$job->created_person}}</b>
                    </p>
                  </div>
    
                  <h5 class="mt-5 text-muted">Project comment</h5>
                  <ul class="list-unstyled">
                    @foreach ($comm as $item)
                    <li>
                      <div class="row">
                        <div class="col-1">
                          <a href="{{asset($item->filename)}}"class="btn-link text-secondary"  target=”_blank”><i class="far fa-fw fa-image"></i></a>
                        </div>
                        <div class="col-11">
                          <p class="btn-link text-secondary">{{$item->comment}}</p>
                        </div>                       
                      </div>                                     
                    </li> 
                    @endforeach
                                    
                  </ul>
                  <div class="text-center mt-5 mb-3">
                    <a href="{{route('pd-follow.edit',$job->productionopenjob_hd_docuno)}}" class="btn btn-sm btn-primary">Add comment</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script>
</script>
@endpush  