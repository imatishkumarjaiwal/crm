<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffs extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'mobile_number',
        'email',
        'address',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
    ];

    public $timestamps = false;
}
