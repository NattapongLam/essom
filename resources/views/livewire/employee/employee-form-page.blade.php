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
                            <label for="code">รหัสพนักงาน</label>
                            <select class="form-control @error('idEmp') is-invalid @enderror" 
                                wire:model="code"
                                name="code" 
                                id="code">
                                <option>กรุณาเลือก</option>
                                @foreach ($employee as $item)
                                <option value="{{$item->ms_employee_code}}">{{$item->ms_employee_fullname}} ({{$item->ms_employee_code}}) / {{$item->ms_employee_email}}</option> 
                                @endforeach                          
                            </select>
                            @error('code')
                            <div id="code_validation" class="invalid-feedback">
                            {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">ชื่อ - นามสกุล</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            name="name" 
                            id="name" 
                            placeholder="ชื่อ - นามสกุล"
                            wire:model="name">
                            @error('name')
                            <div id="name_validation" class="invalid-feedback">
                            {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">อีเมล์</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" 
                            name="email" 
                            id="email" 
                            placeholder="อีเมล์"
                            wire:model="email">
                            @error('email')
                            <div id="email_validation" class="invalid-feedback">
                            {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password">รหัสผ่าน</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" 
                            id="password" 
                            placeholder="รหัสผ่าน"
                            wire:model="password">
                            @error('password')
                            <div id="password_validation" class="invalid-feedback">
                            {{$message}}
                            </div>
                            @enderror
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