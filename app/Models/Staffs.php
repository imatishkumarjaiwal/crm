<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffs extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo',
        'salutation',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'mobile_number',
        'email',
        'city',
        'pincode',
        'state',
        'country',
        'address',
        'aadhar_number',
        'aadhar_file',
        'pan_number',
        'pan_file',
        'designation',
        'date_of_joining',
        'date_of_leaving',
        'salary',
        'salary_increment_note',
        'bank_name',
        'account_number',
        'ifsc_code',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
        'deleted_status'
    ];

    public $timestamps = false;
}
