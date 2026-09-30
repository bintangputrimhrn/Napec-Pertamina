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
    /**
     * Display the visitor feedback form.
     */
    public function index(Request $request): View
    {
        /*
         * Satu token untuk halaman /form.
         * Bahasa tidak lagi ditentukan dari URL.
         */
        $token = bin2hex(random_bytes(32));

        $request->session()->put(
            'feedback_form_token',
            $token
        );

        /*
         * Bahasa awal selalu English.
         * User bisa menggantinya ke Français
         * melalui tombol di halaman.
         */
        return view('feedback.form', [
            'language' => old('language', 'fr'),
            'formToken' => $token,
        ]);
    }


    /**
     * Store visitor feedback.
     */
    public function store(
        StoreFeedbackRequest $request
    ): RedirectResponse {

        /*
         * Bahasa diambil dari hidden input:
         *
         * language = en
         * atau
         * language = fr
         */
        $language = $request->input(
            'language',
            'en'
        );

        /*
         * Pastikan hanya menerima
         * English atau Français.
         */
        abort_unless(
            in_array($language, ['en', 'fr'], true),
            422
        );


        /*
         * Cek token form.
         */
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


        /*
         * Token hanya boleh dipakai sekali.
         */
        $request->session()->forget(
            'feedback_form_token'
        );


        /*
         * Ambil data yang sudah divalidasi.
         */
        $data = $request->validated();


        /*
         * Token tidak disimpan ke database.
         */
        unset(
            $data['submission_token']
        );


        /*
         * Simpan bahasa yang dipilih user.
         */
        $data['language'] = $language;


        /*
         * Buat fingerprint agar submit yang sama
         * tidak tersimpan berkali-kali secara bersamaan.
         */
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


            /*
             * Simpan bahasa untuk halaman success.
             */
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


    /**
     * Display success page.
     */
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