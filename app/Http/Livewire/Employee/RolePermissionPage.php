<?php

namespace App\Http\Livewire\Employee;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class RolePermissionPage extends Component
{
    public $employee;
    public $idKey=0;
    public $name;
    public $code;
    public $permission = [];

    public function mount($id)
    {
        $employee = User::findOrFail($id);
        if($employee){
            $this->idKey = $employee->id;
            $this->name = $employee->name;
            $this->code= $employee->code;
            $this->employee = $employee;
            $permissions = Permission::all();
            foreach ($permissions as $key => $permission) {
                $this->permission[$key] = $employee->hasPermissionTo($permission->name);
            }
        }
        
    }
    
    public function save()
    {
        $permissions = Permission::all();

        $selectedPermissions = [];

        foreach ($this->permission as $key => $checked) {
            if ($checked) {
                $selectedPermissions[] = $permissions[$key]->name;
            }
        }

        $this->employee->syncPermissions($selectedPermissions);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'บันทึกข้อมูลพนักงานเรียบร้อย',
            'timer' => 3000,
            'icon'  => 'success',
        ]);
    }

    public function render()
    {
        return view('livewire.employee.role-permission-page',[
            'permissions' => Permission::leftjoin('permissions_name','id','=','permissions_name_id')->get()
        ])->extends('layouts.main');
    }
}
