<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holidays extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'date',
        'day',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
        'deleted_by',
        'deleted_on',
        'deleted_status',
        'last_updated',
    ];
}
