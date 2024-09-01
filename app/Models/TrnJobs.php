<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrnJobs extends Model
{
    use HasFactory;
    protected $primaryKey = 'job_id';
    public $timestamps = false;
    protected $fillable = [
        'job_date',
        'job_received_from',
        'job_client_id',
        'job_client_contact_person',
        'job_staff_id',
        'job_property_details',
        'job_instructions',
        'job_file_type',
        'job_fileno',
        'job_file_return_status',
        'job_file_return_reason',
        'job_file_return_date',
        'job_ref_fileno',
        'job_doclist_names',
        'job_advocate_fee',
        'job_stamp_reg_court_fee',
        'job_misc_expenses',
        'job_total_amount',
        'job_total_receipt',
        'job_total_payment',
        'job_discount',
        'job_settled_amount',
        'job_createdon',
        'job_createdby',
        'job_updatedon',
        'job_updatedby',
        'job_deleted',
        'job_deletedon',
        'job_deletedby',
    ];
    public function client()
    {
        return $this->belongsTo(MstClients::class, 'job_client_id', 'client_id');
    }

    public function staff()
    {
        return $this->belongsTo(MstStaff::class, 'job_staff_id', 'staff_id');
    }

}
