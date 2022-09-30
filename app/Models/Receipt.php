<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable = ['emp_id', 'accept_emp_id', 'request_id', 'total_price'];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
