<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Set application language before validation.
     *
     * Karena bahasa sekarang berasal dari hidden input,
     * bukan dari /en atau /fr.
     */
    protected function prepareForValidation(): void
    {
        $language = $this->input(
            'language',
            'en'
        );


        if (
            in_array(
                $language,
                ['en', 'fr'],
                true
            )
        ) {
            app()->setLocale(
                $language
            );
        } else {
            app()->setLocale('en');
        }
    }


    public function rules(): array
    {
        return [

            /*
             * Language
             */
            'language' => [
                'required',
                Rule::in(['en', 'fr']),
            ],


            /*
             * Security token
             */
            'submission_token' => [
                'required',
                'string',
                'size:64',
            ],


            /*
             * Personal information
             */
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'company_name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'job_title' => [
                'required',
                'string',
                'max:255',
            ],


            /*
             * How did you hear about us?
             */
            'heard_from' => [
                'required',
                Rule::in([
                    'online_advertisement',
                    'social_media',
                    'word_of_mouth',
                    'other',
                ]),
            ],

            'heard_from_other' => [
                'nullable',
                'required_if:heard_from,other',
                'string',
                'max:255',
            ],


            /*
             * Booth rating
             */
            'booth_rating' => [
                'required',
                'integer',
                'between:1,5',
            ],


            /*
             * Booth design
             */
            'booth_design' => [
                'required',
                Rule::in([
                    'yes',
                    'no',
                    'partially',
                ]),
            ],


            /*
             * Attention aspect
             */
            'attention_aspect' => [
                'required',
                Rule::in([
                    'visuals_graphics',
                    'product_displays',
                    'demonstrations',
                    'interactive_elements',
                    'other',
                ]),
            ],

            'attention_aspect_other' => [
                'nullable',
                'required_if:attention_aspect,other',
                'string',
                'max:255',
            ],


            /*
             * Representatives
             */
            'representative_rating' => [
                'required',
                Rule::in([
                    'very_knowledgeable',
                    'somewhat_knowledgeable',
                    'not_knowledgeable',
                ]),
            ],


            /*
             * Learned something
             */
            'learned_something' => [
                'required',
                Rule::in([
                    'yes',
                    'no',
                ]),
            ],


            /*
             * Written feedback
             */
            'improvements' => [
                'required',
                'string',
                'max:3000',
            ],

            'interested_products' => [
                'required',
                'string',
                'max:3000',
            ],


            /*
             * Presentation / demonstration
             */
            'attended_presentation' => [
                'required',
                Rule::in([
                    'yes',
                    'no',
                ]),
            ],

            'presentation_feedback' => [
                'nullable',
                'required_if:attended_presentation,yes',
                'string',
                'max:3000',
            ],


            /*
             * Overall satisfaction
             */
            'overall_satisfaction' => [
                'required',
                Rule::in([
                    'very_satisfied',
                    'satisfied',
                    'neutral',
                    'dissatisfied',
                    'very_dissatisfied',
                ]),
            ],


            /*
             * Recommendation
             */
            'recommendation' => [
                'required',
                Rule::in([
                    'yes',
                    'no',
                ]),
            ],


            /*
             * Additional comments
             *
             * Ini sekarang berdiri sendiri,
             * bukan pilihan dari recommendation.
             */
            'additional_comments' => [
                'nullable',
                'string',
                'max:3000',
            ],
        ];
    }


    public function attributes(): array
    {
        return [
            'name' =>
                __('feedback.fields.name'),

            'company_name' =>
                __('feedback.fields.company_name'),

            'email' =>
                __('feedback.fields.email'),

            'job_title' =>
                __('feedback.fields.job_title'),

            'heard_from' =>
                __('feedback.questions.heard_from'),

            'booth_rating' =>
                __('feedback.questions.booth_rating'),

            'booth_design' =>
                __('feedback.questions.booth_design'),

            'attention_aspect' =>
                __('feedback.questions.attention_aspect'),

            'representative_rating' =>
                __('feedback.questions.representative_rating'),

            'learned_something' =>
                __('feedback.questions.learned_something'),

            'improvements' =>
                __('feedback.questions.improvements'),

            'interested_products' =>
                __('feedback.questions.interested_products'),

            'attended_presentation' =>
                __('feedback.questions.attended_presentation'),

            'presentation_feedback' =>
                __('feedback.questions.presentation_feedback'),

            'overall_satisfaction' =>
                __('feedback.questions.overall_satisfaction'),

            'recommendation' =>
                __('feedback.questions.recommendation'),

            'additional_comments' =>
                __('feedback.questions.additional_comments'),
        ];
    }
}