<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaRegistration extends Model
{
    protected $fillable = [
        'name',
        'media_name',
        'media_type',
        'job_title',
        'email',
        'contact_number',
    ];
}