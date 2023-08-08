<div class="mt-4"><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-5">
                    <h3 class="card-title">รายการผู้ใช้งาน</h3>
                  </div>
                  <div class="col-7">
                    <div class="card-tools">
                      <div class="input-group input-group-sm">
                        <input type="text" class="form-control float-right" placeholder="Search" wire:model="searchTerm"/>&nbsp;
                        <div class="input-group-append">
                          <a href="{{route('employee.create')}}"class="btn btn-primary">
                            <i class="fas fa-plus"></i>&nbsp;เพิ่มข้อมูล
                          </a>
                        </div>
                      </div>
                  </div>
                  </div>
                </div>               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th style="text-align: center">สถานะ</th>
                      <th style="text-align: center">ชื่อ - นามสกุล</th>
                      <th style="text-align: center">อีเมล</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($employees as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td class="text-center">
                          @if ($item->status)
                              <span class="badge badge-success">ใช้งาน</span>
                          @else  
                              <span class="badge badge-danger">ยกเลิก</span>
                          @endif
                      </td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                          <a href="{{route('employee.update',$item->id)}}" 
                            class="btn btn-sm btn-warning" >
                            <i class="fas fa-edit"></i>
                          </a>
                        </td>
                    </tr>
                    @endforeach                  
                  </tbody>
                </table>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
               {{$employees->links()}}
              </div>
              <div wire:loading wire:target="save" wire:loading.class="overlay" wire:loading.flex>
                <div class="d-flex justify-content-center align-items-center">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>