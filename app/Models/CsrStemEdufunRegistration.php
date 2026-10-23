<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsrStemEdufunRegistration extends Model
{
    protected $table = 'csr_stem_edufun_registrations';

    protected $fillable = [
        'full_name',
        'company_name',
        'position',
        'mobile_no',
        'email_address',
    ];
}
