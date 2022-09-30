<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Listeners\send_request_notification;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Employee extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['person_id', 'dep_id', 'role', 'duties', 'salary', 'hire_date', 'retire_date', 'title', 'email', 'password'];

    public function people()
    {
        return $this->belongsTo(Person::class);
    }
    public function departments()
    {
        return $this->belongsTo(Department::class);
    }
    public function requests()
    {
        return $this->hasMany(Request::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
