<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackSubmission extends Model
{
    protected $fillable = [
        'language',
        'name',
        'company_name',
        'email',
        'job_title',

        'heard_from',
        'heard_from_other',

        'booth_rating',
        'booth_design',

        'attention_aspect',
        'attention_aspect_other',

        'representative_rating',

        'learned_something',

        'improvements',
        'interested_products',

        'attended_presentation',
        'presentation_feedback',

        'overall_satisfaction',

        'recommendation',
        'additional_comments',
    ];

    protected function casts(): array
    {
        return [
            'booth_rating' => 'integer',
        ];
    }
}