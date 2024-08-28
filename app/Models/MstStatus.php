<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstStatus extends Model
{
    use HasFactory;
    protected $table = 'mst_status';
    protected $primaryKey = 'status_id';

    protected $fillable = [
        'status_name',
        'status_color',
        'status_desc',
        'status_createdby',
        'status_createdon',
        'status_updatedby',
        'status_updatedon',
        'status_deleted',
        'status_deletedby',
        'status_deletedon',
    ];

    public $timestamps = false;

}
