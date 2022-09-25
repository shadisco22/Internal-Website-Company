<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['sender_emp_id','receiver_emp_id','receiver_dep_id','seen','request_id'];

    public function employees()
    {
            return $this->belongsTo(Employee::class);
    }

}
