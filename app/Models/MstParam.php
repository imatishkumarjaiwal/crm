<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstParam extends Model
{
    use HasFactory;
    protected $table = 'mst_param';
    protected $primaryKey = 'site_id';
    public $timestamps = false;
    protected $fillable = [
        'site_name',
        'site_currency_id',
        'site_email',
        'site_address',
        'site_phone',
        'site_llno',
        'site_legal_email',
        'site_main_website',
        'site_fax',
        'site_url',
        'site_incharge',
        'site_logo',
        'site_tax_rate',
        'site_add_time_hh_mm',
    ];
}
