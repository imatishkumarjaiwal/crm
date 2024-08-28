<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstClients extends Model
{
    use HasFactory;
    protected $primaryKey = 'client_id';
    public $timestamps = false;
    protected $fillable = [
        'client_firm_name',
        'client_salutation',
        'client_first_name',
        'client_middle_name',
        'client_last_name',
        'client_address',
        'client_city',
        'client_pin',
        'client_state',
        'client_country',
        'client_mobile',
        'client_email',
        'client_mobile_1',
        'client_email_1',
        'client_website',
        'client_contact_person',
        'client_contact_desig',
        'client_contact_mobile',
        'client_contact_email',
        'client_contact_person_1',
        'client_contact_desig_1',
        'client_contact_mobile_1',
        'client_contact_email_1',
        'client_contact_person_2',
        'client_contact_desig_2',
        'client_contact_mobile_2',
        'client_contact_email_2',
        'client_contact_person_3',
        'client_contact_desig_3',
        'client_contact_mobile_3',
        'client_contact_email_3',
        'client_contact_person_4',
        'client_contact_desig_4',
        'client_contact_mobile_4',
        'client_contact_email_4',
        'client_start_date',
        'client_refer_by',
        'client_sugg_for_prev_client',
        'client_password',
        'client_user_role',
        'client_status',
        'client_remark',
        'client_createdby',
        'client_createdon',
        'client_updatedby',
        'client_updatedon',
        'client_deleted',
        'client_deletedby',
        'client_deletedon',
    ];

  
}
