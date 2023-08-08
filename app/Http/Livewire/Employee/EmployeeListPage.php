<?php

namespace App\Http\Livewire\Employee;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeListPage extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $searchTerm;

    protected $listeners = [
        'refreshEmployee' => '$refresh'
    ];

    public function render()
    {
        $employees = User::query();
        if($this->searchTerm){
            $employees = $employees
            ->where('name','LIKE',"%{$this->searchTerm}%")
            ->orwhere('email','LIKE',"%{$this->searchTerm}%");
        }
        $employees = $employees->paginate(20);
        return view('livewire.employee.employee-list-page',[
            'employees' => $employees
        ])->extends('layouts.main');
    }
}
