<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstWorks extends Model
{
    use HasFactory;
    protected $primaryKey = 'work_id';
    public $timestamps = false;
    protected $fillable = [
        'work_name',
        'work_desc',
        'work_createdby',
        'work_createdon',
        'work_updatedby',
        'work_updatedon',
        'work_deleted',
        'work_deletedby',
        'work_deletedon',
    ];
}
