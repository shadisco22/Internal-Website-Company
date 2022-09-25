<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['person_id','dep_id','role','duties','salary','hire_date','retire_date'];

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
}
