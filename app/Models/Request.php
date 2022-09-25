<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = ['emp_id','request','description','quantity'];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }


}
