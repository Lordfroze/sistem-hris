<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'employees';  // table name in database
    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'address',
        'birth_date',
        'hire_date',
        'department_id',
        'role_id',
        'status',
        'salary'
    ];
}
