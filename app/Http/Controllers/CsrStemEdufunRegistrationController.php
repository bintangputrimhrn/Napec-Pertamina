<?php

namespace App\Http\Controllers;

use App\Models\CsrStemEdufunRegistration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CsrStemEdufunRegistrationController extends Controller
{
    public function create()
    {
        return view('csr-stem-edufun.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'mobile_no' => ['required', 'string', 'max:30'],
            'email_address' => [
                'required',
                'email',
                'max:255',
                Rule::unique('csr_stem_edufun_registrations', 'email_address'),
            ],
        ]);

        CsrStemEdufunRegistration::create($validated);

        $request->session()->put('edufun_registration_success', true);

        return redirect()->route('csr-stem-edufun.success');
    }
}