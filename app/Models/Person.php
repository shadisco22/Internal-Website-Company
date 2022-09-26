<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $fillable = ['fname', 'lname', 'gender', 'dob', 'email', 'phonenumber', 'address'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
