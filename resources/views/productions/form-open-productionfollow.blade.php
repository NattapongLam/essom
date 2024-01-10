@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-weight: bold">Projects</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 10%">
                            #
                        </th>
                        <th style="width: 10%">
                            Deadline
                        </th>
                        <th style="width: 30%">
                            Project Name
                        </th>
                        <th style="width: 20%" class="text-center">
                            Team Members
                        </th>
                        <th style="width: 20%" class="text-center">
                            Time Forecast
                        </th>
                        <th style="width: 20%" class="text-center">
                            Time ManDay
                        </th>
                        <th class="text-center">
                            Project Progress
                        </th>
                        <th style="width: 10%" class="text-center">
                            Status
                        </th>
                        <th style="width: 10%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hd as $item)
                        <tr>
                            <td>
                               {{$item->productionopenjob_hd_type}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($item->productionnotice_dt_duedate)->format('d/m/Y')}}
                             </td>
                            <td>
                                <a>
                                    {{$item->productionopenjob_hd_docuno}}
                                    ({{$item->ms_product_code}} Spec Page {{$item->ms_specpage_name}})
                                </a>
                                <br/>
                                <small>
                                    {{$item->ms_customer_name}}
                                </small>
                            </td>
                            <td class="text-center">
                                {{$item->created_person}}
                            </td>
                            <td class="text-center">
                                {{number_format($item->totaltime,0)}}
                            </td>
                            <td class="text-center">
                                {{number_format($item->mantime,0)}}
                            </td>
                            <td class="project_progress" >
                                @if ($item->timeper <= 100)
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{$item->timeper}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$item->timeper}}%">
                                    </div>
                                </div>
                                <small>
                                    {{number_format($item->timeper,2)}}% Complete
                                </small>
                                @else
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="{{$item->timeper}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$item->timeper}}%">
                                    </div>
                                </div>
                                <small>
                                    {{number_format($item->timeper,2)}}% Complete
                                </small>
                                @endif
                                
                            </td>
                            <td class="project-state">
                                <span class="badge badge-success">
                                    {{$item->productionopenjob_status_name}}
                                </span>
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="{{route('pd-follow.show',$item->productionopenjob_hd_docuno)}}">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                                {{-- <a class="btn btn-info btn-sm" href="#">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script>
</script>
@endpush  