<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'password',
        'staff_id',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
        'deleted_status'
    ];

    public $timestamps = false;
}
