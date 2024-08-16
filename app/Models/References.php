<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class References extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'staff_id',
        'name',
        'relationship',
        'mobile',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
        'deleted_status'
    ];
}
