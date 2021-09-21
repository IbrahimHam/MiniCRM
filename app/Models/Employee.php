<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['fname', 'lname', 'email', 'phone', 'company_id'];

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
