<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
        'deleted_status',
        'last_updated'
    ];

    public $timestamps = false;
}
