<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = ['accept_emp_id','req_id','seen','offer','price'];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }

    public function requests()
    {
        return $this->belongsTo(Request::class);
    }
}
