<div>
    <br>    
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">ผู้ใช้งานระบบ</h3>
              </div>
              <div class="card-body">
                <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">ชื่อ - นามสกุล</label>
                            <input type="text" class="form-control" 
                            name="name" 
                            id="name" 
                            placeholder="ชื่อ - นามสกุล"
                            wire:model="name"
                            readonly>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">รหัสพนักงาน</label>
                            <input type="text" class="form-control" 
                            name="code" 
                            id="code" 
                            placeholder="รหัสพนักงาน"
                            wire:model="code"
                            readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="permission">Permission</label>  
                            <div class="row">                       
                            @foreach ($permissions as $key => $item)
                            <div class="col-12 col-md-3">
                                <div class="custom-control custom-checkbox">
                                    <input 
                                    class="custom-control-input" 
                                    type="checkbox" 
                                    wire:model="permission.{{$key}}"
                                    id="customCheckbox{{$item->id}}" 
                                    value="{{$item->name}}">
                                    <label 
                                        for="customCheckbox{{$item->id}}"
                                        class="custom-control-label">
                                        {{$item->permissions_name_log}}
                                    </label>
                                </div>
                            </div>                         
                            @endforeach 
                            </div>                          
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">บันทึกข้อมูล</button>
                </div>
                </form>
                <div wire:loading wire:target="save" wire:loading.class="overlay" wire:loading.flex>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                </div>
              </div>             
            </div>
        </div>
    </div>
</div>
@push('scriptjs')
<script>
$(function () {
    $('.select2').select2()
})
</script>
@endpush 