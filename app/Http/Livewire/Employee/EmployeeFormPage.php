<?php

namespace App\Http\Livewire\Employee;

use App\Models\User;
use Livewire\Component;
use App\Models\EmployeeList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeFormPage extends Component
{
    public $idKey=0;
    public $name;
    public $code;
    public $email;
    public $password;
    public $status=1;
    
    public function rulesValidate()
    {
        if($this->idKey)
        {
            return[
                'name'=> "required",
                'code'=> "required|unique:users,code,".$this->idKey,
                'email'=> "required"
            ];
        }
        else
        {
            return[
                'name'=> "required",
                'email'=> "required|unique:users,email",
                'password'=> "required|min:6",
                'code'=> "required|unique:users,code",
            ];
        }
    }

    protected $messages = [
        'name.required' => 'กรุณาระบุชื่อพนักงาน',
        'email.required' => 'กรุณาระบุอีเมล์',
        'email.unique' => 'อีเมล์นี้มีอยู่ในระบบแล้ว',
        'code.required' => 'กรุณาระบุรหัสพนักงาน',
        'code.unique' => 'รหัสพนักงานนี้มีอยู่ในระบบแล้ว',
        'password.required' => 'กรุณาระบุรหัสผ่าน',
        'password.min' => 'กรุณาระบุรหัสผ่าน 6 ตัวขึ้นไป',
    ];

    public function mount($id = 0)
    {
        if($id > 0)
        {
            $employee = User::findOrfail($id);
            $this->idKey = $employee->id;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->code= $employee->code;
            $this->status= $employee->status;
        }
    }

    public function save()
    {
        $this->validate($this->rulesValidate(),$this->messages);
        $employee = new User();
        if($this->idKey > 0){
            $employee = User::findOrfail($this->idKey);     
            $employee->password = $this->password ? Hash::make($this->password) : $employee->password;    
        }else{           
            $employee->password= Hash::make($this->password);
        }
        $employee->name = $this->name;
        $employee->email= $this->email;          
        $employee->code= $this->code;
        $employee->status= $this->status; 
        $employee->save();
        $this->dispatchBrowserEvent('swal',[
            'title' => 'บันทึกข้อมูลพนักงานเรียบร้อย',
            'timer' => 3000,
            'icon' => 'success',
            'url' => route('employee.list')
        ]);
    }

    public function render()
    {
        if($this->code){            
            $emp = EmployeeList::where('ms_employee_code',$this->code)->first();
            $this->email = $emp->ms_employee_code .'@essom.local';
            $this->name = $emp->ms_employee_fullname;
            $pas = DB::table('users_win')->where('users_name',$this->code)->first();
            if($pas){
                $this->password = $pas->password_text;
            }
            else {
                $this->password = "123456";
            }            
        }
        return view('livewire.employee.employee-form-page',[
            'employee' => EmployeeList::where('ms_employee_flag',true)->get()
        ])->extends('layouts.main');
    }
}
