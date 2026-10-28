<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\FeedbackSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class FeedbackController extends Controller
{
    public function index(Request $request): View
    {
        $token = bin2hex(random_bytes(32));

        $request->session()->put(
            'feedback_form_token',
            $token
        );

        return view('feedback.form', [
            'language' => old('language', 'fr'),
            'formToken' => $token,
        ]);
    }


    public function store(
        StoreFeedbackRequest $request
    ): RedirectResponse {

        $language = $request->input(
            'language',
            'en'
        );

        abort_unless(
            in_array($language, ['en', 'fr'], true),
            422
        );


        $expectedToken =
            $request->session()->get(
                'feedback_form_token'
            );


        if (
            ! $expectedToken ||
            ! hash_equals(
                $expectedToken,
                (string) $request->input(
                    'submission_token'
                )
            )
        ) {
            return redirect()
                ->route('feedback.success');
        }


        $request->session()->forget(
            'feedback_form_token'
        );


        $data = $request->validated();


        unset(
            $data['submission_token']
        );


        $data['language'] = $language;


        $fingerprint = hash(
            'sha256',
            $request->session()->getId()
            . '|'
            . $language
            . '|'
            . json_encode($data)
        );


        $lock = Cache::lock(
            'feedback-submit:' . $fingerprint,
            10
        );


        if (! $lock->get()) {
            return redirect()
                ->route('feedback.success');
        }


        try {

            FeedbackSubmission::create(
                $data
            );


            $request->session()->put(
                'feedback_language',
                $language
            );


            return redirect()
                ->route('feedback.success');


        } catch (Throwable $exception) {

            Log::error(
                'Feedback submission failed.',
                [
                    'language' => $language,
                    'exception' =>
                        $exception->getMessage(),
                ]
            );


            return back()
                ->withInput()
                ->with(
                    'form_error',
                    'Unable to save your feedback. Please try again.'
                );


        } finally {

            $lock->release();

        }
    }


    public function success(
        Request $request
    ): View {

        $language =
            $request->session()->pull(
                'feedback_language',
                'fr'
            );


        if (
            ! in_array(
                $language,
                ['en', 'fr'],
                true
            )
        ) {
            $language = 'en';
        }


        app()->setLocale(
            $language
        );


        return view(
            'success',
            [
                'language' => $language,
            ]
        );
    }
}