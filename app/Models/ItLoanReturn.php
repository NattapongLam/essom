<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItLoanReturn extends Model
{
    use HasFactory;

    protected $table = 'it_loan_returns';
    protected $primaryKey = 'it_loan_returns_id'; // เช็คชื่อ Primary Key ให้ตรงกับตารางจริงด้วยครับ

    protected $fillable = [
        'quantity',
        'equipment_name',
        'borrower',
        'details',
        'borrow_date',
        'borrow_by',
        'return_date',
        'return_by',
        'remark',
    ];
}
