@extends('layouts.app')

@section('content')

<style>
    .csr-page {
        width: min(650px, calc(100% - 40px));
        margin: 0 auto;
        padding: 20px 0 50px;
        font-family: "Rajdhani", sans-serif;
    }

    .csr-title {
        text-align: center;
        margin-bottom: 42px;
    }

    .csr-title h1 {
        font-size: 30px;
        font-weight: 700;
        line-height: 1.3;
        margin: 0;
        color: #111;
    }

    .csr-section-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 30px;
        color: #111;
    }

    .csr-question {
        margin-bottom: 27px;
    }

    .csr-question label {
        display: block;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 9px;
        color: #111;
    }

    .csr-required::after {
        content: " *";
        color: #d22;
    }

    .csr-input {
        width: 100%;
        min-height: 40px;
        padding: 8px 11px;
        border: 1px solid #cfcfcf;
        border-radius: 2px;
        font-family: "Rajdhani", sans-serif;
        font-size: 15px;
        box-shadow: none;
        box-sizing: border-box;
        background: #fff;
    }

    .csr-input:focus {
        border-color: #8dbbd3;
        outline: none;
    }

    .csr-input.csr-invalid {
        border-color: #d22;
    }

    .csr-error {
        color: #d22;
        font-size: 13px;
        margin-top: 5px;
    }

    .csr-alert {
        padding: 12px 15px;
        margin-bottom: 25px;
        border-radius: 3px;
        font-size: 14px;
    }

    .csr-alert-error {
        background: #f8d7da;
        color: #842029;
    }

    .csr-submit-wrap {
        margin-top: 35px;
    }

    .csr-submit {
        background: #0b75b8;
        border: 0;
        border-radius: 3px;
        padding: 9px 20px;
        color: #fff;
        font-family: "Rajdhani", sans-serif;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
    }

    .csr-submit:hover {
        background: #095f95;
    }

    @media (max-width: 700px) {
        .csr-page {
            width: calc(100% - 28px);
        }

        .csr-title h1 {
            font-size: 25px;
        }

        .csr-section-title {
            font-size: 21px;
        }
    }
</style>

<div class="csr-page">

    <div class="csr-title">
        <h1>CSR Extraordinary STEM Edufun Festival Vol.3</h1>
    </div>

    @if($errors->any())
        <div class="csr-alert csr-alert-error">
            Please check the fields below and try again.
        </div>
    @endif

    <form
        id="csr-registration-form"
        method="POST"
        action="{{ route('csr-stem-edufun.store') }}"
        novalidate
    >
        @csrf

        <div class="csr-question">
            <label for="full_name" class="csr-required">
                Full Name
            </label>

            <input
                type="text"
                id="full_name"
                name="full_name"
                class="csr-input"
                value="{{ old('full_name') }}"
                autocomplete="name"
                maxlength="255"
                required
            >

            @error('full_name')
                <div class="csr-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="csr-question">
            <label for="company_name" class="csr-required">
                Company Name
            </label>

            <input
                type="text"
                id="company_name"
                name="company_name"
                class="csr-input"
                value="{{ old('company_name') }}"
                autocomplete="organization"
                maxlength="255"
                required
            >

            @error('company_name')
                <div class="csr-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="csr-question">
            <label for="position" class="csr-required">
                Position
            </label>

            <input
                type="text"
                id="position"
                name="position"
                class="csr-input"
                value="{{ old('position') }}"
                maxlength="255"
                required
            >

            @error('position')
                <div class="csr-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="csr-question">
            <label for="mobile_no" class="csr-required">
                Mobile No
            </label>

            <input
                type="tel"
                id="mobile_no"
                name="mobile_no"
                class="csr-input"
                value="{{ old('mobile_no') }}"
                autocomplete="tel"
                maxlength="30"
                required
            >

            @error('mobile_no')
                <div class="csr-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="csr-question">
            <label for="email_address" class="csr-required">
                Email Address
            </label>

            <input
                type="email"
                id="email_address"
                name="email_address"
                class="csr-input"
                value="{{ old('email_address') }}"
                autocomplete="email"
                maxlength="255"
                required
            >

            @error('email_address')
                <div class="csr-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="csr-submit-wrap">
            <button type="submit" class="csr-submit">
                Submit
            </button>
        </div>
    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('csr-registration-form');

    if (!form) return;

    const fields = [
        'full_name',
        'company_name',
        'position',
        'mobile_no',
        'email_address'
    ];

    function getErrorElement(input) {
        const errorId = input.name + '_client_error';
        let error = document.getElementById(errorId);

        if (!error) {
            error = document.createElement('div');
            error.id = errorId;
            error.className = 'csr-error';
            input.insertAdjacentElement('afterend', error);
        }

        return error;
    }

    function showError(input, message) {
        const error = getErrorElement(input);

        error.textContent = message;
        input.classList.add('csr-invalid');
        input.setAttribute('aria-invalid', 'true');
    }

    function clearError(input) {
        const error = document.getElementById(
            input.name + '_client_error'
        );

        if (error) {
            error.remove();
        }

        input.classList.remove('csr-invalid');
        input.removeAttribute('aria-invalid');
    }

    function validateField(input) {
        const value = input.value.trim();

        if (value === '') {
            showError(input, 'This field is required.');
            return false;
        }

        if (
            input.name === 'email_address' &&
            !input.validity.valid
        ) {
            showError(
                input,
                'Please enter a valid email address.'
            );
            return false;
        }

        clearError(input);
        return true;
    }

    fields.forEach(function (name) {
        const input = form.elements.namedItem(name);

        if (!input) return;

        input.addEventListener('input', function () {
            if (input.classList.contains('csr-invalid')) {
                validateField(input);
            }
        });

        input.addEventListener('blur', function () {
            if (input.value.trim() !== '') {
                validateField(input);
            }
        });
    });

    form.addEventListener('submit', function (event) {
        let isValid = true;
        let firstInvalidField = null;

        fields.forEach(function (name) {
            const input = form.elements.namedItem(name);

            if (!input) return;

            if (!validateField(input)) {
                isValid = false;

                if (!firstInvalidField) {
                    firstInvalidField = input;
                }
            }
        });

        if (!isValid) {
            event.preventDefault();
            firstInvalidField.focus();
        }
    });
});
</script>

@endsection