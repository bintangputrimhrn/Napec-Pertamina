@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .media-page {
        width: min(650px, calc(100% - 40px));
        margin: 0 auto;
        padding-bottom: 50px;
        font-family: "Rajdhani", sans-serif;
    }

    .media-title {
        text-align: center;
        margin-bottom: 42px;
    }

    .media-title h1 {
        font-size: 30px;
        font-weight: 700;
        margin: 0 0 7px;
        color: #111;
    }

    .media-title .french-title {
        font-size: 20px;
        font-style: italic;
        font-weight: 500;
        color: #555;
        margin: 0;
    }

    .section-title {
        margin-bottom: 30px;
    }

    .section-title .english {
        display: block;
        font-size: 24px;
        font-weight: 700;
        color: #111;
        margin-bottom: 4px;
    }

    .section-title .french {
        display: block;
        font-size: 17px;
        font-style: italic;
        color: #666;
    }

    .media-question {
        margin-bottom: 27px;
    }

    .question-english {
        display: block;
        font-size: 16px;
        font-weight: 700;
        color: #111;
        margin-bottom: 3px;
        line-height: 1.4;
    }

    .question-french {
        display: block;
        font-size: 14px;
        font-style: italic;
        color: #666;
        margin-bottom: 9px;
        line-height: 1.4;
    }

    .required::after {
        content: " *";
        color: #d22;
    }

    .media-form-control {
        width: 100%;
        min-height: 40px;
        padding: 8px 11px;
        border: 1px solid #cfcfcf;
        border-radius: 2px;
        font-family: "Rajdhani", sans-serif;
        font-size: 14px;
        box-shadow: none;
        outline: none;
        box-sizing: border-box;
        background-color: #fff;
    }

    .media-form-control:focus {
        border-color: #8dbbd3;
    }

    /* =========================
       CUSTOM DROPDOWN
    ========================= */

    .custom-dropdown {
        position: relative;
        width: 100%;
    }

    .custom-dropdown-button {
        width: 100%;
        min-height: 40px;
        padding: 8px 11px;
        border: 1px solid #cfcfcf;
        border-radius: 2px;
        background: #fff;
        color: #111;
        font-family: "Rajdhani", sans-serif;
        font-size: 14px;
        text-align: left;
        cursor: pointer;

        display: flex;
        align-items: center;
        justify-content: space-between;

        box-sizing: border-box;
    }

    .custom-dropdown-button:focus {
        border-color: #8dbbd3;
        outline: none;
    }

    .dropdown-arrow {
        font-size: 18px;
        line-height: 1;
        margin-left: 10px;
    }

    .custom-dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;

        background: #fff;
        border: 1px solid #999;
        border-top: none;

        z-index: 1000;
        box-sizing: border-box;
    }

    .custom-dropdown.open .custom-dropdown-menu {
        display: block;
    }

    .custom-dropdown-option {
        padding: 9px 12px;
        cursor: pointer;
        border-bottom: 1px solid #eee;
        line-height: 1.3;
        background: #fff;
        font-family: "Rajdhani", sans-serif;
    }

    .custom-dropdown-option:last-child {
        border-bottom: none;
    }

    .custom-dropdown-option:hover {
        background: #f1f1f1;
    }

    .option-english {
        display: block;
        font-size: 14px;
        color: #111;
        font-weight: 500;
    }

    .option-french {
        display: block;
        margin-top: 2px;
        font-size: 13px;
        font-style: italic;
        color: #666;
    }

    /* =========================
       ERROR & SUCCESS
    ========================= */

    .media-alert {
        margin-bottom: 25px;
        padding: 12px 15px;
        border-radius: 3px;
        font-size: 14px;
    }

    .media-alert-success {
        background: #d1f0aa;
        color: #333;
    }

    .media-alert-error {
        background: #f8d7da;
        color: #842029;
    }

    .media-error {
        margin-top: 5px;
        color: #d22;
        font-size: 13px;
    }

    /* =========================
       SUBMIT
    ========================= */

    .media-submit-wrap {
        margin-top: 35px;
    }

    .media-submit {
        background: #0b75b8;
        border: 0;
        border-radius: 3px;
        padding: 9px 20px;
        color: #fff;
        font-family: "Rajdhani", sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .media-submit:hover {
        background: #095f95;
    }

    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 700px) {

        .media-page {
            width: calc(100% - 28px);
        }

        .media-title h1 {
            font-size: 25px;
        }

        .media-title .french-title {
            font-size: 18px;
        }

        .section-title .english {
            font-size: 21px;
        }

        .section-title .french {
            font-size: 15px;
        }
    }
</style>


<form
    method="POST"
    action="{{ route('media.store') }}"
    class="media-page"
>

    @csrf


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))
        <div class="media-alert media-alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- ERROR MESSAGE --}}

    @if($errors->any())
        <div class="media-alert media-alert-error">
            Please check the required fields and try again.
        </div>
    @endif


    {{-- TITLE --}}

    <div class="media-title">

        <h1>
            Media Registration Form NAPEC 2026
        </h1>

        <p class="french-title">
            Formulaire d'inscription média
        </p>

    </div>


    {{-- SECTION TITLE --}}

    <div class="section-title">

        <span class="english">
            A. Media Information
        </span>

        <span class="french">
            A. Informations sur les médias
        </span>

    </div>


    {{-- 1. NAME --}}

    <div class="media-question">

        <label
            class="question-english required"
            for="name"
        >
            1. Name
        </label>

        <span class="question-french">
            Nom
        </span>

        <input
            type="text"
            id="name"
            name="name"
            class="media-form-control"
            value="{{ old('name') }}"
            required
        >

        @error('name')
            <div class="media-error">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- 2. MEDIA OUTLET / PUBLICATION NAME --}}

    <div class="media-question">

        <label
            class="question-english required"
            for="media_name"
        >
            2. Media Outlet / Publication Name
        </label>

        <span class="question-french">
            Nom du média / de la publication
        </span>

        <input
            type="text"
            id="media_name"
            name="media_name"
            class="media-form-control"
            value="{{ old('media_name') }}"
            required
        >

        @error('media_name')
            <div class="media-error">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- 3. MEDIA TYPE --}}

    <div class="media-question">

        <span class="question-english required">
            3. Media Type
        </span>

        <span class="question-french">
            Type de média
        </span>


        <div
            class="custom-dropdown"
            id="mediaTypeDropdown"
        >

            <button
                type="button"
                class="custom-dropdown-button"
                id="mediaTypeButton"
            >

                <span id="mediaTypeSelected">

                    @if(old('media_type') === 'print')
                        <span class="option-english">
                            Print
                        </span>
                        <span class="option-french">
                            Presse écrite
                        </span>

                    @elseif(old('media_type') === 'digital')
                        <span class="option-english">
                            Digital
                        </span>
                        <span class="option-french">
                            Média numérique
                        </span>

                    @elseif(old('media_type') === 'broadcast')
                        <span class="option-english">
                            Broadcast
                        </span>
                        <span class="option-french">
                            Audiovisuel
                        </span>

                    @elseif(old('media_type') === 'independent_content_creator')
                        <span class="option-english">
                            Independent / Content Creator
                        </span>
                        <span class="option-french">
                            Média indépendant / Créateur de contenu
                        </span>

                    @else
                        <span class="option-english">
                             Select media type
                        </span>
                        <span class="option-french">
                              Sélectionner le type de support
                        </span>
                    @endif

                </span>

                <span class="dropdown-arrow">
                    ⌄
                </span>

            </button>


            <div class="custom-dropdown-menu">


                {{-- PRINT --}}

                <div
                    class="custom-dropdown-option"
                    data-value="print"
                >

                    <span class="option-english">
                        Print
                    </span>

                    <span class="option-french">
                        Presse écrite
                    </span>

                </div>


                {{-- DIGITAL --}}

                <div
                    class="custom-dropdown-option"
                    data-value="digital"
                >

                    <span class="option-english">
                        Digital
                    </span>

                    <span class="option-french">
                        Média numérique
                    </span>

                </div>


                {{-- BROADCAST --}}

                <div
                    class="custom-dropdown-option"
                    data-value="broadcast"
                >

                    <span class="option-english">
                        Broadcast
                    </span>

                    <span class="option-french">
                        Audiovisuel
                    </span>

                </div>


                {{-- INDEPENDENT / CONTENT CREATOR --}}

                <div
                    class="custom-dropdown-option"
                    data-value="independent_content_creator"
                >

                    <span class="option-english">
                        Independent / Content Creator
                    </span>

                    <span class="option-french">
                        Média indépendant / Créateur de contenu
                    </span>

                </div>

            </div>


            <input
                type="hidden"
                name="media_type"
                id="mediaTypeInput"
                value="{{ old('media_type') }}"
            >

        </div>

        @error('media_type')
            <div class="media-error">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- 4. JOB TITLE --}}

    <div class="media-question">

        <label
            class="question-english required"
            for="job_title"
        >
            4. Job Title
        </label>

        <span class="question-french">
            Fonction
        </span>

        <input
            type="text"
            id="job_title"
            name="job_title"
            class="media-form-control"
            value="{{ old('job_title') }}"
            required
        >

        @error('job_title')
            <div class="media-error">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- 5. EMAIL --}}

    <div class="media-question">

        <label
            class="question-english required"
            for="email"
        >
            5. Email
        </label>

        <span class="question-french">
            Adresse e-mail
        </span>

        <input
            type="email"
            id="email"
            name="email"
            class="media-form-control"
            value="{{ old('email') }}"
            required
        >

        @error('email')
            <div class="media-error">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- 6. CONTACT NUMBER --}}

    <div class="media-question">

        <label
            class="question-english required"
            for="contact_number"
        >
            6. Contact Number
        </label>

        <span class="question-french">
            Numéro de téléphone
        </span>

        <input
            type="tel"
            id="contact_number"
            name="contact_number"
            class="media-form-control"
            value="{{ old('contact_number') }}"
            required
        >

        @error('contact_number')
            <div class="media-error">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- SUBMIT --}}

    <div class="media-submit-wrap">

        <button
            type="submit"
            class="media-submit"
        >
            Submit
        </button>

    </div>

</form>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const dropdown =
            document.getElementById('mediaTypeDropdown');

        const button =
            document.getElementById('mediaTypeButton');

        const selected =
            document.getElementById('mediaTypeSelected');

        const input =
            document.getElementById('mediaTypeInput');

        const options =
            document.querySelectorAll(
                '.custom-dropdown-option'
            );


        /*
        |--------------------------------------------------------------------------
        | OPEN / CLOSE DROPDOWN
        |--------------------------------------------------------------------------
        */

        button.addEventListener('click', function () {

            dropdown.classList.toggle('open');

        });


        /*
        |--------------------------------------------------------------------------
        | SELECT MEDIA TYPE
        |--------------------------------------------------------------------------
        */

        options.forEach(function (option) {

            option.addEventListener('click', function () {

                const value = this.dataset.value;

                const english =
                    this.querySelector('.option-english')
                        .textContent
                        .trim();

                const french =
                    this.querySelector('.option-french')
                        .textContent
                        .trim();


                selected.innerHTML = `
                    <span style="
                        display:block;
                        font-size:14px;
                        color:#111;
                        font-family:'Rajdhani', sans-serif;
                    ">
                        ${english}
                    </span>

                    <span style="
                        display:block;
                        font-size:13px;
                        font-style:italic;
                        color:#666;
                        margin-top:2px;
                        font-family:'Rajdhani', sans-serif;
                    ">
                        ${french}
                    </span>
                `;


                input.value = value;

                dropdown.classList.remove('open');

            });

        });


        /*
        |--------------------------------------------------------------------------
        | CLOSE WHEN CLICKING OUTSIDE
        |--------------------------------------------------------------------------
        */

        document.addEventListener('click', function (event) {

            if (!dropdown.contains(event.target)) {

                dropdown.classList.remove('open');

            }

        });

    });
</script>

@endsection