<?php

namespace App\Http\Controllers;

use App\Models\MediaRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaRegistrationController extends Controller
{
    public function create(): View
    {
        return view('media-registration');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'media_name' => ['required', 'string', 'max:255'],
            'media_type' => ['required', 'string', 'max:50'],
            'job_title' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'contact_number' => ['required', 'string', 'max:50'],
        ]);

        MediaRegistration::create($validated);

        return redirect()
            ->route('media.form')
            ->with('success', 'Registration submitted successfully.');
    }
}