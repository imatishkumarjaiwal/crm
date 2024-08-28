<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstStaff extends Model
{
    use HasFactory;
    protected $primaryKey = 'staff_id';
    public $timestamps = false;
    protected $fillable = [
        'staff_salutation',
        'staff_first_name',
        'staff_middle_name',
        'staff_last_name',
        'staff_address',
        'staff_city',
        'staff_pin',
        'staff_state',
        'staff_country',
        'staff_mobile',
        'staff_email',
        'staff_mobile_1',
        'staff_email_1',
        'staff_photo',
        'staff_aadhar',
        'staff_aadhar_file',
        'staff_pan_file',
        'staff_pan',
        'staff_dob',
        'staff_doj',
        'staff_dol',
        'staff_user_role',
        'staff_designation',
        'staff_salary',
        'staff_salary_increment_note',
        'staff_password',
        'staff_status',
        'staff_bank',
        'staff_account_number',
        'staff_ifsc_code',
        'staff_ref_name_1',
        'staff_ref_relation_1',
        'staff_ref_mobile_1',
        'staff_ref_name_2',
        'staff_ref_relation_2',
        'staff_ref_mobile_2',
        'staff_ref_name_3',
        'staff_ref_relation_3',
        'staff_ref_mobile_3',
        'staff_ref_name_4',
        'staff_ref_relation_4',
        'staff_ref_mobile_4',
        'staff_ref_name_5',
        'staff_ref_relation_5',
        'staff_ref_mobile_5',
        'staff_createdby',
        'staff_createdon',
        'staff_updatedby',
        'staff_updatedon',
        'staff_deleted',
        'staff_deletedby',
        'staff_deletedon',
    ];
}
