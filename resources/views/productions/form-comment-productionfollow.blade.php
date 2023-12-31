@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">
<div class="mt-4"><br>
<div class="row">
  <form method="POST" class="form-horizontal" action="{{ route('pd-follow.store') }}" enctype="multipart/form-data">
    @csrf
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">General</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="inputName">Project No</label>
                        <input type="text" id="inputName" class="form-control" name="productionopenjob_hd_docuno" value="{{$job->productionopenjob_hd_docuno}}" readonly>
                      </div>
                </div>
                <div class="col-12 col-md-10">
                    <div class="form-group">
                        <label for="inputName">Project Product</label>
                        <input type="text" id="inputName" class="form-control" value="{{$job->ms_product_code}}/{{$job->ms_product_name}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="inputDescription">Project Description</label>
                        <textarea id="inputDescription" class="form-control" rows="2" name="productionnotice_dt_remark">{{$job->productionnotice_dt_remark}}</textarea>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="inputClientCompany">Client Company</label>
                        <input type="text" id="inputClientCompany" class="form-control" value="{{$job->ms_customer_name}}" readonly>
                      </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="inputProjectLeader">Project Leader</label>
                        <input type="text" id="inputProjectLeader" class="form-control" value="{{$job->created_person}}" readonly>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <label for="inputName">Project Deadline</label>
                    <input type="date" id="inputName" class="form-control" name="productionnotice_dt_duedate" value="{{$job->productionnotice_dt_duedate}}">
                </div>
                <div class="col-12 col-md-4">
                    <label for="inputName">Project Start</label>
                    <input type="date" id="inputName" class="form-control" name="productionopenjob_hd_startdate" value="{{$job->productionopenjob_hd_startdate}}">
                </div>
                <div class="col-12 col-md-4">
                    <label for="inputName">Project Finish</label>
                    <input type="date" id="inputName" class="form-control" name="productionopenjob_hd_enddate" value="{{$job->productionopenjob_hd_enddate}}">
                </div>
            </div>              
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Budget</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="inputEstimatedBudget">Estimate  budget</label>
                        <input type="text" id="inputEstimatedBudget" class="form-control" name="productionopenjob_estimatecost" value="{{number_format($job->productionopenjob_estimatecost,2)}}">
                      </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="inputSpentBudget">Total amount spent</label>
                        <input type="text" id="inputSpentBudget" class="form-control" name="productionopenjob_actualcost" value="{{number_format($job->productionopenjob_actualcost,2)}}">
                      </div>
                </div>               
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputEstimatedDuration">Machine Time</label>
                        <input type="text" id="inputEstimatedDuration" class="form-control" name="machinetime" value="{{number_format($job->machinetime,2)}}">
                      </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputEstimatedDuration">Electricity Time</label>
                        <input type="text" id="inputEstimatedDuration" class="form-control" name="electricitytime" value="{{number_format($job->electricitytime,2)}}">
                      </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputEstimatedDuration">Paint Time</label>
                        <input type="text" id="inputEstimatedDuration" class="form-control" name="painttime" value="{{number_format($job->painttime,2)}}">
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputEstimatedDuration">Assembly Time</label>
                        <input type="text" id="inputEstimatedDuration" class="form-control" name="assemblytime" value="{{number_format($job->assemblytime,2)}}">
                      </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputEstimatedDuration">Other Time</label>
                        <input type="text" id="inputEstimatedDuration" class="form-control" name="othertime" value="{{number_format($job->othertime,2)}}">
                      </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputEstimatedDuration">Total Time</label>
                        <input type="text" id="inputEstimatedDuration" class="form-control" name="totaltime" value="{{number_format($job->totaltime,2)}}">
                      </div>
                </div>
            </div>
            
           
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Comment</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="inputDescription">Comment Description</label>
                        <textarea id="inputDescription" class="form-control" rows="2" name="comment"></textarea>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="filename">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                </div>
            </div><br>
            <div class="row">
              <div class="col-12 col-md-12">
                <input type="submit" value="Save Changes" class="btn btn-success float-right">
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div>
  </form>
</div>
</div>
@endsection
@push('scriptjs')
<script src="{{ asset('/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
$('.toastrDefaultSuccess').click(function() {
    toastr.success('บันทึกเรียบร้อย')
});
$(function () {
  bsCustomFileInput.init();
});
</script>
@endpush