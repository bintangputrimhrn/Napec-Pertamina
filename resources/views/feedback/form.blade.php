@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap');

    :root {
        --form-blue: #0b75b8;
        --form-blue-dark: #095f95;
        --border-color: #cfcfcf;
        --text-color: #111;
        --muted-color: #666;
        --error-color: #d22;
    }

    * {
        box-sizing: border-box;
    }

    .feedback-page {
        width: min(650px, calc(100% - 40px));
        margin: 0 auto;
        padding-bottom: 50px;
        font-family: "Rajdhani", sans-serif;
        color: var(--text-color);
    }

    /* =========================================
       LANGUAGE SWITCHER
    ========================================== */

    .language-switcher {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 8px auto 35px;
    }

    .language-toggle {
        display: flex;
        border: 1px solid #cfcfcf;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
    }

    .language-button {
        border: 0;
        background: #fff;
        color: #555;
        padding: 8px 25px;
        min-width: 110px;
        font-family: "Rajdhani", sans-serif;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .language-button:first-child {
        border-right: 1px solid #cfcfcf;
    }

    .language-button.active {
        background: var(--form-blue);
        color: #fff;
    }

    .language-button:hover:not(.active) {
        background: #f2f2f2;
    }


    /* =========================================
       TITLE
    ========================================== */

    .feedback-title {
        text-align: center;
        margin-bottom: 38px;
    }

    .feedback-title h1 {
        font-size: 30px;
        font-weight: 700;
        margin: 0 0 5px;
        line-height: 1.2;
    }

    .feedback-title h2 {
        font-size: 22px;
        font-weight: 600;
        margin: 0;
        line-height: 1.3;
    }


    /* =========================================
       QUESTION
    ========================================== */

    .question {
        margin-bottom: 25px;
    }

    .question-label {
        display: block;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 9px;
    }

    .required::after {
        content: " *";
        color: var(--error-color);
    }


    /* =========================================
       INPUT
    ========================================== */

    .form-control {
        width: 100%;
        min-height: 40px;
        padding: 8px 11px;
        border: 1px solid var(--border-color);
        border-radius: 2px;
        background: #fff;
        color: #111;
        font-family: "Rajdhani", sans-serif;
        font-size: 15px;
        outline: none;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #8dbbd3;
    }

    textarea.form-control {
        min-height: 90px;
        resize: vertical;
    }


    /* =========================================
       RADIO OPTIONS
    ========================================== */

    .option-list {
        display: grid;
        gap: 9px;
        margin-top: 4px;
    }

    .form-option {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        cursor: pointer;
        font-size: 15px;
        line-height: 1.35;
    }

    .form-option input {
        margin-top: 4px;
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        accent-color: var(--form-blue);
        cursor: pointer;
    }

    .form-option span {
        display: block;
    }


    /* =========================================
       OTHER INPUT
    ========================================== */

    .other-input {
        display: none;
        margin-top: 9px;
    }

    .other-input.is-visible {
        display: block;
    }


    /* =========================================
       STAR RATING
    ========================================== */

    .rating-wrap {
        margin-top: 3px;
    }

    .star-rating {
        display: inline-flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 2px;
    }

    .star-rating input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .star-rating label {
        font-size: 30px;
        line-height: 1;
        color: #d5d5d5;
        cursor: pointer;
        padding: 0 1px;
        transition: color .15s ease;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #0b75b8;
    }

    .star-rating input:checked ~ label {
        color: #0b75b8;
    }

    .rating-help {
        font-size: 12px;
        color: #777;
        margin-top: 5px;
    }


    /* =========================================
       ERROR
    ========================================== */

    .field-error {
        display: none;
        color: var(--error-color);
        font-size: 13px;
        font-weight: 500;
        margin-top: 5px;
        line-height: 1.35;
    }

    .field-error.show {
        display: block;
    }

    .form-control.has-error {
        border-color: var(--error-color);
    }

    .question.has-error .question-label {
        color: #111;
    }


    /* =========================================
       SUBMIT
    ========================================== */

    .submit-wrap {
        margin-top: 35px;
    }

    .submit-button {
        background: var(--form-blue);
        border: 0;
        border-radius: 3px;
        padding: 9px 20px;
        color: #fff;
        font-family: "Rajdhani", sans-serif;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
    }

    .submit-button:hover {
        background: var(--form-blue-dark);
    }

    .submit-button:disabled {
        opacity: .7;
        cursor: not-allowed;
    }


    /* =========================================
       SERVER ERROR
    ========================================== */

    .server-error {
        background: #fde8e8;
        border: 1px solid #f2b8b8;
        color: #9d1c1c;
        padding: 10px 12px;
        margin-bottom: 25px;
        border-radius: 3px;
        font-size: 14px;
    }


    /* =========================================
       MOBILE
    ========================================== */

    @media (max-width: 700px) {

        .feedback-page {
            width: calc(100% - 28px);
        }

        .feedback-title h1 {
            font-size: 25px;
        }

        .feedback-title h2 {
            font-size: 20px;
        }

        .language-button {
            min-width: 100px;
            padding: 8px 18px;
        }

        .question-label {
            font-size: 15px;
        }

        .star-rating label {
            font-size: 27px;
        }
    }
</style>


<div class="feedback-page">

    {{-- =========================================
         LANGUAGE SWITCHER
    ========================================== --}}

    <div class="language-switcher">

        <div class="language-toggle">
            <button
                type="button"
                class="language-button active"
                id="frenchButton"
            >
                France
            </button>

            <button
                type="button"
                class="language-button"
                id="englishButton"
            >
                English
            </button>

        </div>

    </div>


    {{-- =========================================
         TITLE
    ========================================== --}}

    <div class="feedback-title">

        <h1>
            Pertamina NAPEC 2026
        </h1>

        <h2 id="pageSubtitle">
            Visitor Information
        </h2>

    </div>


    {{-- =========================================
         SERVER ERROR
    ========================================== --}}

    @if(session('form_error'))
        <div class="server-error">
            {{ session('form_error') }}
        </div>
    @endif


    {{-- =========================================
         FORM
    ========================================== --}}

    <form
        method="POST"
        action="{{ route('feedback.store') }}"
        id="feedbackForm"
        novalidate
    >

        @csrf

        <input
            type="hidden"
            name="language"
            id="languageInput"
            value="{{ old('language', $language ?? 'fr') }}"
        >

        <input
            type="hidden"
            name="submission_token"
            value="{{ $formToken }}"
        
        >

        {{-- =====================================
             1. NAME
        ====================================== --}}

        <div class="question" data-question="name">

            <label
                class="question-label required"
                for="name"
                data-en="Name"
                data-fr="Nom"
            >
                Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                class="form-control @error('name') has-error @enderror"
                value="{{ old('name') }}"
                autocomplete="name"
            >

            <div class="field-error" data-error-for="name"></div>

            @error('name')
                <div class="field-error show">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- =====================================
             2. COMPANY NAME
        ====================================== --}}

        <div class="question" data-question="company_name">

            <label
                class="question-label required"
                for="company_name"
                data-en="Company Name"
                data-fr="Nom de la entreprise"
            >
                Company Name
            </label>

            <input
                type="text"
                id="company_name"
                name="company_name"
                class="form-control @error('company_name') has-error @enderror"
                value="{{ old('company_name') }}"
            >

            <div class="field-error" data-error-for="company_name"></div>

            @error('company_name')
                <div class="field-error show">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- =====================================
             3. EMAIL
        ====================================== --}}

        <div class="question" data-question="email">

            <label
                class="question-label required"
                for="email"
                data-en="Email Address"
                data-fr="Courriel"
            >
                Email Address
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') has-error @enderror"
                value="{{ old('email') }}"
                autocomplete="email"
            >

            <div class="field-error" data-error-for="email"></div>

            @error('email')
                <div class="field-error show">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- =====================================
             4. JOB TITLE
        ====================================== --}}

        <div class="question" data-question="job_title">

            <label
                class="question-label required"
                for="job_title"
                data-en="Job Title"
                data-fr="Désignation professeionnelle "
            >
                Job Title
            </label>

            <input
                type="text"
                id="job_title"
                name="job_title"
                class="form-control @error('job_title') has-error @enderror"
                value="{{ old('job_title') }}"
            >

            <div class="field-error" data-error-for="job_title"></div>

            @error('job_title')
                <div class="field-error show">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- =====================================
             5. HOW DID YOU HEAR ABOUT US?
        ====================================== --}}

        <div class="question" data-question="heard_from">

            <label
                class="question-label required"
                data-en="How did you hear about our exhibition booth?"
                data-fr="Comment avez-vous entendu parler de notre stand d'exposition ?"
            >
                How did you hear about our exhibition booth?
            </label>

            <div class="option-list">

                <label class="form-option">
                    <input
                        type="radio"
                        name="heard_from"
                        value="online_advertisement"
                        {{ old('heard_from') === 'online_advertisement' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Online advertisement"
                        data-fr="Publicité en ligne"
                    >
                        Online advertisement
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="heard_from"
                        value="social_media"
                        {{ old('heard_from') === 'social_media' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Social media"
                        data-fr="Réseaux sociaux"
                    >
                        Social media
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="heard_from"
                        value="word_of_mouth"
                        {{ old('heard_from') === 'word_of_mouth' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Word of mouth"
                        data-fr="Bouche-à-oreille"
                    >
                        Word of mouth
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="heard_from"
                        value="other"
                        {{ old('heard_from') === 'other' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Other (please specify):"
                        data-fr="Autre (veuillez préciser) :"
                    >
                        Other (please specify):
                    </span>
                </label>

            </div>

            <input
                type="text"
                name="heard_from_other"
                id="heard_from_other"
                class="form-control other-input"
                value="{{ old('heard_from_other') }}"
            >

            <div class="field-error" data-error-for="heard_from"></div>

        </div>


        {{-- =====================================
             6. BOOTH RATING
        ====================================== --}}

        <div class="question" data-question="booth_rating">

            <label
                class="question-label required"
                data-en="On a scale of 1 to 5, how would you rate the overall presentation and attractiveness of our booth?"
                data-fr="Sur une échelle de 1 à 5, comment évalueriez-vous la présentation générale et l'attractivité de notre stand ?"
            >
                On a scale of 1 to 5, how would you rate the overall presentation and attractiveness of our booth?
            </label>

            <div class="rating-wrap">

                <div class="star-rating">

                    <input
                        type="radio"
                        id="star5"
                        name="booth_rating"
                        value="5"
                        {{ old('booth_rating') == '5' ? 'checked' : '' }}
                    >
                    <label for="star5" title="5">★</label>

                    <input
                        type="radio"
                        id="star4"
                        name="booth_rating"
                        value="4"
                        {{ old('booth_rating') == '4' ? 'checked' : '' }}
                    >
                    <label for="star4" title="4">★</label>

                    <input
                        type="radio"
                        id="star3"
                        name="booth_rating"
                        value="3"
                        {{ old('booth_rating') == '3' ? 'checked' : '' }}
                    >
                    <label for="star3" title="3">★</label>

                    <input
                        type="radio"
                        id="star2"
                        name="booth_rating"
                        value="2"
                        {{ old('booth_rating') == '2' ? 'checked' : '' }}
                    >
                    <label for="star2" title="2">★</label>

                    <input
                        type="radio"
                        id="star1"
                        name="booth_rating"
                        value="1"
                        {{ old('booth_rating') == '1' ? 'checked' : '' }}
                    >
                    <label for="star1" title="1">★</label>

                </div>

                <div
                    class="rating-help"
                    id="ratingHelp"
                >
                    1 (Poor) - 5 (Excellent)
                </div>

            </div>

            <div class="field-error" data-error-for="booth_rating"></div>

        </div>


        {{-- =====================================
             7. BOOTH LAYOUT
        ====================================== --}}

        <div class="question" data-question="booth_design">

            <label
                class="question-label required"
                data-en="Did the booth layout and design effectively communicate our company?"
                data-fr="L'agencement et la conception du stand ont-ils permis de communiquer efficacement sur notre entreprise ?"
            >
                Did the booth layout and design effectively communicate our company?
            </label>

            <div class="option-list">

                <label class="form-option">
                    <input
                        type="radio"
                        name="booth_design"
                        value="yes"
                        {{ old('booth_design') === 'yes' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Yes"
                        data-fr="Oui"
                    >
                        Yes
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="booth_design"
                        value="no"
                        {{ old('booth_design') === 'no' ? 'checked' : '' }}
                    >
                    <span
                        data-en="No"
                        data-fr="Non"
                    >
                        No
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="booth_design"
                        value="partially"
                        {{ old('booth_design') === 'partially' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Partially"
                        data-fr="Partiellement"
                    >
                        Partially
                    </span>
                </label>

            </div>

            <div class="field-error" data-error-for="booth_design"></div>

        </div>


        {{-- =====================================
             8. ATTENTION ASPECT
        ====================================== --}}

        <div class="question" data-question="attention_aspect">

            <label
                class="question-label required"
                data-en="Which aspect of our booth caught your attention the most?"
                data-fr="Quel aspect de notre stand a le plus retenu votre attention ?"
            >
                Which aspect of our booth caught your attention the most?
            </label>

            <div class="option-list">

                <label class="form-option">
                    <input
                        type="radio"
                        name="attention_aspect"
                        value="visuals_graphics"
                        {{ old('attention_aspect') === 'visuals_graphics' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Visuals/Graphics"
                        data-fr="Visuels/Graphiques"
                    >
                        Visuals/Graphics
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="attention_aspect"
                        value="product_displays"
                        {{ old('attention_aspect') === 'product_displays' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Product displays"
                        data-fr="Présentation"
                    >
                        Product displays
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="attention_aspect"
                        value="demonstrations"
                        {{ old('attention_aspect') === 'demonstrations' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Demonstrations"
                        data-fr="Activités sur le stand"
                    >
                        Demonstrations
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="attention_aspect"
                        value="interactive_elements"
                        {{ old('attention_aspect') === 'interactive_elements' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Interactive elements"
                        data-fr="Éléments interactifs"
                    >
                        Interactive elements
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="attention_aspect"
                        value="other"
                        {{ old('attention_aspect') === 'other' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Other (please specify):"
                        data-fr="Autre (veuillez préciser) :"
                    >
                        Other (please specify):
                    </span>
                </label>

            </div>

            <input
                type="text"
                name="attention_aspect_other"
                id="attention_aspect_other"
                class="form-control other-input"
                value="{{ old('attention_aspect_other') }}"
            >

            <div class="field-error" data-error-for="attention_aspect"></div>

        </div>


        {{-- =====================================
             9. REPRESENTATIVES
        ====================================== --}}

        <div class="question" data-question="representative_rating">

            <label
                class="question-label required"
                data-en="Were our representatives knowledgeable and helpful in addressing your inquiries?"
                data-fr="Nos représentants étaient-ils compétents et disponibles pour répondre à vos questions ?"
            >
                Were our representatives knowledgeable and helpful in addressing your inquiries?
            </label>

            <div class="option-list">

                <label class="form-option">
                    <input
                        type="radio"
                        name="representative_rating"
                        value="very_knowledgeable"
                        {{ old('representative_rating') === 'very_knowledgeable' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Very knowledgeable and helpful"
                        data-fr="Très compétents et serviables"
                    >
                        Very knowledgeable and helpful
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="representative_rating"
                        value="somewhat_knowledgeable"
                        {{ old('representative_rating') === 'somewhat_knowledgeable' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Somewhat knowledgeable and helpful"
                        data-fr="Plutôt compétents et serviables"
                    >
                        Somewhat knowledgeable and helpful
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="representative_rating"
                        value="not_knowledgeable"
                        {{ old('representative_rating') === 'not_knowledgeable' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Not knowledgeable or helpful"
                        data-fr="Ni compétents ni serviables"
                    >
                        Not knowledgeable or helpful
                    </span>
                </label>

            </div>

            <div class="field-error" data-error-for="representative_rating"></div>

        </div>


        {{-- =====================================
             10. LEARNED SOMETHING
        ====================================== --}}

        <div class="question" data-question="learned_something">

            <label
                class="question-label required"
                data-en="Did you learn something new about our company/products/services during your visit?"
                data-fr="Avez-vous appris quelque chose de nouveau sur notre entreprise/nos produits/services lors de votre visite ?"
            >
                Did you learn something new about our company/products/services during your visit?
            </label>

            <div class="option-list">

                <label class="form-option">
                    <input
                        type="radio"
                        name="learned_something"
                        value="yes"
                        {{ old('learned_something') === 'yes' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Yes"
                        data-fr="Oui"
                    >
                        Yes
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="learned_something"
                        value="no"
                        {{ old('learned_something') === 'no' ? 'checked' : '' }}
                    >
                    <span
                        data-en="No"
                        data-fr="Non"
                    >
                        No
                    </span>
                </label>

            </div>

            <div class="field-error" data-error-for="learned_something"></div>

        </div>


        {{-- =====================================
             11. IMPROVEMENTS
        ====================================== --}}

        <div class="question" data-question="improvements">

            <label
                class="question-label required"
                for="improvements"
                data-en="What improvements, if any, would you suggest for our booth in future exhibitions?"
                data-fr="Quelles améliorations, le cas échéant, suggéreriez-vous pour notre stand lors des prochaines salons ?"
            >
                What improvements, if any, would you suggest for our booth in future exhibitions?
            </label>

            <textarea
                id="improvements"
                name="improvements"
                class="form-control"
                rows="4"
            >{{ old('improvements') }}</textarea>

            <div class="field-error" data-error-for="improvements"></div>

        </div>


        {{-- =====================================
             12. INTERESTED PRODUCTS
        ====================================== --}}

        <div class="question" data-question="interested_products">

            <label
                class="question-label required"
                for="interested_products"
                data-en="Were there any specific products or services that particularly interested you? If so, please specify."
                data-fr="Y avait-il des produits ou des services spécifiques qui vous ont particulièrement intéressé ? Si oui, veuillez préciser."
            >
                Were there any specific products or services that particularly interested you? If so, please specify.
            </label>

            <textarea
                id="interested_products"
                name="interested_products"
                class="form-control"
                rows="4"
            >{{ old('interested_products') }}</textarea>

            <div class="field-error" data-error-for="interested_products"></div>

        </div>


        {{-- =====================================
             13. ATTENDED PRESENTATION
        ====================================== --}}

        <div class="question" data-question="attended_presentation">

            <label
                class="question-label required"
                data-en="Did you attend any of our presentations or demonstrations?"
                data-fr="Avez-vous assisté à l'une de nos présentations ou démonstrations ? Si oui, veuillez nous faire part de vos commentaires sur le contenu et la manière dont elles ont été présentées."
            >
                Did you attend any of our presentations or demonstrations?
            </label>

            <div class="option-list">

                <label class="form-option">
                    <input
                        type="radio"
                        name="attended_presentation"
                        value="no"
                        {{ old('attended_presentation') === 'no' ? 'checked' : '' }}
                    >
                    <span
                        data-en="No"
                        data-fr="Non"
                    >
                        No
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="attended_presentation"
                        value="yes"
                        {{ old('attended_presentation') === 'yes' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Yes"
                        data-fr="Oui"
                    >
                        Yes
                    </span>
                </label>

            </div>

            <textarea
                id="presentation_feedback"
                name="presentation_feedback"
                class="form-control"
                rows="4"
                style="display:none; margin-top:10px;"
            >{{ old('presentation_feedback') }}</textarea>

            <div
                id="presentationFeedbackHelp"
                style="
                    display:none;
                    font-size:12px;
                    color:#777;
                    margin-top:5px;
                "
                data-en="Please share your feedback about the presentation or demonstration."
                data-fr="Veuillez partager vos commentaires sur la présentation ou la démonstration."
            >
                Please share your feedback about the presentation or demonstration.
            </div>

            <div
                class="field-error"
                data-error-for="attended_presentation"
            ></div>

        </div>


        {{-- =====================================
             14. OVERALL SATISFACTION
        ====================================== --}}

        <div class="question" data-question="overall_satisfaction">

            <label
                class="question-label required"
                data-en="Overall, how satisfied were you with your experience at our booth?"
                data-fr="Dans l'ensemble, dans quelle mesure avez-vous été satisfait de votre expérience sur notre stand ?"
            >
                Overall, how satisfied were you with your experience at our booth?
            </label>

            <div class="option-list">

                <label class="form-option">
                    <input
                        type="radio"
                        name="overall_satisfaction"
                        value="very_satisfied"
                        {{ old('overall_satisfaction') === 'very_satisfied' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Very satisfied"
                        data-fr="Très satisfait"
                    >
                        Very satisfied
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="overall_satisfaction"
                        value="satisfied"
                        {{ old('overall_satisfaction') === 'satisfied' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Satisfied"
                        data-fr="Satisfait"
                    >
                        Satisfied
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="overall_satisfaction"
                        value="neutral"
                        {{ old('overall_satisfaction') === 'neutral' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Neutral"
                        data-fr="Neutre"
                    >
                        Neutral
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="overall_satisfaction"
                        value="dissatisfied"
                        {{ old('overall_satisfaction') === 'dissatisfied' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Dissatisfied"
                        data-fr="Insatisfait"
                    >
                        Dissatisfied
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="overall_satisfaction"
                        value="very_dissatisfied"
                        {{ old('overall_satisfaction') === 'very_dissatisfied' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Very Dissatisfied"
                        data-fr="Très insatisfait"
                    >
                        Very Dissatisfied
                    </span>
                </label>

            </div>

            <div class="field-error" data-error-for="overall_satisfaction"></div>

        </div>


        {{-- =====================================
             15. RECOMMENDATION
        ====================================== --}}

        <div class="question" data-question="recommendation">

            <label
                class="question-label required"
                data-en="Would you be willing to recommend our company/products/services to others in your industry?"
                data-fr="Seriez-vous prêt à recommander notre entreprise/nos produits/nos services à d'autres personnes de votre secteur ?"
            >
                Would you be willing to recommend our company/products/services to others in your industry?
            </label>

            <div class="option-list">

                <label class="form-option">
                    <input
                        type="radio"
                        name="recommendation"
                        value="yes"
                        {{ old('recommendation') === 'yes' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Yes"
                        data-fr="Oui"
                    >
                        Yes
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="recommendation"
                        value="no"
                        {{ old('recommendation') === 'no' ? 'checked' : '' }}
                    >
                    <span
                        data-en="No"
                        data-fr="Non"
                    >
                        No
                    </span>
                </label>

                <label class="form-option">
                    <input
                        type="radio"
                        name="recommendation"
                        value="additional"
                        {{ old('recommendation') === 'additional' ? 'checked' : '' }}
                    >
                    <span
                        data-en="Any additional comments or suggestions for us?"
                        data-fr="Autres commentaires ou suggestions à nous faire ?"
                    >
                        Any additional comments or suggestions for us?
                    </span>
                </label>

            </div>

            <textarea
                id="additional_comments"
                name="additional_comments"
                class="form-control other-input"
                rows="4"
            >{{ old('additional_comments') }}</textarea>

            <div class="field-error" data-error-for="recommendation"></div>

        </div>


        {{-- =====================================
             SUBMIT
        ====================================== --}}

        <div class="submit-wrap">

            <button
                type="submit"
                class="submit-button"
                id="submitButton"
            >
                Submit
            </button>

        </div>

    </form>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('feedbackForm');

    const englishButton = document.getElementById('englishButton');
    const frenchButton = document.getElementById('frenchButton');

    const pageSubtitle = document.getElementById('pageSubtitle');

    const submitButton = document.getElementById('submitButton');

    const ratingHelp = document.getElementById('ratingHelp');

    let currentLanguage =
        document.getElementById('languageInput').value || 'fr';


    /* =========================================
       TRANSLATIONS
    ========================================== */

    const translations = {

        en: {
            subtitle: 'Visitor Information',
            submit: 'Submit',
            rating: '1 (Poor) - 5 (Excellent)',
            presentationHelp:
                'Please share your feedback about the presentation or demonstration.',

            required: 'This field is required.',
            selectRequired: 'Please select an option.',
            email: 'Please enter a valid email address.',
            otherRequired: 'Please specify your answer.'
        },

        fr: {
            subtitle: 'Renseignements concernant le visiteur',
            submit: 'Envoyer',
            rating: '1 (Mauvais) - 5 (Excellent)',
            presentationHelp:
                'Veuillez partager vos commentaires sur la présentation ou la démonstration.',

            required: 'Ce champ est obligatoire.',
            selectRequired: 'Veuillez sélectionner une option.',
            email: 'Veuillez saisir une adresse e-mail valide.',
            otherRequired: 'Veuillez préciser votre réponse.'
        }

    };


    /* =========================================
       CHANGE LANGUAGE
    ========================================== */

    function setLanguage(language) {

        currentLanguage = language;

        document.getElementById('languageInput').value = language;

        const translation = translations[language];


        /*
         * Button active state
         */

        englishButton.classList.toggle(
            'active',
            language === 'en'
        );

        frenchButton.classList.toggle(
            'active',
            language === 'fr'
        );


        /*
         * Page subtitle
         */

        pageSubtitle.textContent =
            translation.subtitle;


        /*
         * Submit button
         */

        submitButton.textContent =
            translation.submit;


        /*
         * Rating help
         */

        ratingHelp.textContent =
            translation.rating;


        /*
         * Semua element yang mempunyai
         * data-en dan data-fr
         */

        document
            .querySelectorAll('[data-en][data-fr]')
            .forEach(function (element) {

                const text =
                    element.dataset[language];

                if (text) {
                    element.textContent = text;
                }

            });


        /*
         * Presentation feedback help
         */

        const presentationHelp =
            document.getElementById(
                'presentationFeedbackHelp'
            );

        if (presentationHelp) {

            presentationHelp.textContent =
                presentationHelp.dataset[language];

        }


        /*
         * Jangan hapus isi input yang
         * sudah diketik user.
         */

    }


    englishButton.addEventListener(
        'click',
        function () {

            setLanguage('en');

        }
    );


    frenchButton.addEventListener(
        'click',
        function () {

            setLanguage('fr');

        }
    );


    /* =========================================
       OTHER - HEARD FROM
    ========================================== */

    const heardFromRadios =
        document.querySelectorAll(
            'input[name="heard_from"]'
        );

    const heardFromOther =
        document.getElementById(
            'heard_from_other'
        );


    function updateHeardFromOther() {

        const selected =
            document.querySelector(
                'input[name="heard_from"]:checked'
            );

        if (
            selected &&
            selected.value === 'other'
        ) {

            heardFromOther.classList.add(
                'is-visible'
            );

            heardFromOther.required = true;

        } else {

            heardFromOther.classList.remove(
                'is-visible'
            );

            heardFromOther.required = false;
            heardFromOther.value = '';

        }

    }


    heardFromRadios.forEach(function (radio) {

        radio.addEventListener(
            'change',
            updateHeardFromOther
        );

    });


    /* =========================================
       OTHER - ATTENTION ASPECT
    ========================================== */

    const attentionRadios =
        document.querySelectorAll(
            'input[name="attention_aspect"]'
        );

    const attentionOther =
        document.getElementById(
            'attention_aspect_other'
        );


    function updateAttentionOther() {

        const selected =
            document.querySelector(
                'input[name="attention_aspect"]:checked'
            );

        if (
            selected &&
            selected.value === 'other'
        ) {

            attentionOther.classList.add(
                'is-visible'
            );

            attentionOther.required = true;

        } else {

            attentionOther.classList.remove(
                'is-visible'
            );

            attentionOther.required = false;
            attentionOther.value = '';

        }

    }


    attentionRadios.forEach(function (radio) {

        radio.addEventListener(
            'change',
            updateAttentionOther
        );

    });


    /* =========================================
       PRESENTATION YES / NO
    ========================================== */

    const presentationRadios =
        document.querySelectorAll(
            'input[name="attended_presentation"]'
        );

    const presentationFeedback =
        document.getElementById(
            'presentation_feedback'
        );

    const presentationFeedbackHelp =
        document.getElementById(
            'presentationFeedbackHelp'
        );


    function updatePresentationFeedback() {

        const selected =
            document.querySelector(
                'input[name="attended_presentation"]:checked'
            );


        if (
            selected &&
            selected.value === 'yes'
        ) {

            presentationFeedback.style.display =
                'block';

            presentationFeedbackHelp.style.display =
                'block';

            presentationFeedback.required = true;

        } else {

            presentationFeedback.style.display =
                'none';

            presentationFeedbackHelp.style.display =
                'none';

            presentationFeedback.required = false;

            presentationFeedback.value = '';

        }

    }


    presentationRadios.forEach(function (radio) {

        radio.addEventListener(
            'change',
            updatePresentationFeedback
        );

    });


    /* =========================================
       RECOMMENDATION ADDITIONAL COMMENTS
    ========================================== */

    const recommendationRadios =
        document.querySelectorAll(
            'input[name="recommendation"]'
        );

    const additionalComments =
        document.getElementById(
            'additional_comments'
        );


    function updateAdditionalComments() {

        const selected =
            document.querySelector(
                'input[name="recommendation"]:checked'
            );


        if (
            selected &&
            selected.value === 'additional'
        ) {

            additionalComments.classList.add(
                'is-visible'
            );

            additionalComments.required = true;

        } else {

            additionalComments.classList.remove(
                'is-visible'
            );

            additionalComments.required = false;

            additionalComments.value = '';

        }

    }


    recommendationRadios.forEach(function (radio) {

        radio.addEventListener(
            'change',
            updateAdditionalComments
        );

    });


    /* =========================================
       CLEAR ERROR
    ========================================== */

    function clearFieldError(name) {

        const error =
            document.querySelector(
                '[data-error-for="' + name + '"]'
            );

        if (error) {

            error.textContent = '';
            error.classList.remove('show');

        }


        const question =
            document.querySelector(
                '[data-question="' + name + '"]'
            );

        if (question) {

            question.classList.remove(
                'has-error'
            );

        }


        const input =
            document.getElementById(name);

        if (input) {

            input.classList.remove(
                'has-error'
            );

        }

    }


    /* =========================================
       SHOW ERROR
    ========================================== */

    function showFieldError(name, message) {

        const error =
            document.querySelector(
                '[data-error-for="' + name + '"]'
            );

        if (error) {

            error.textContent = message;
            error.classList.add('show');

        }


        const question =
            document.querySelector(
                '[data-question="' + name + '"]'
            );

        if (question) {

            question.classList.add(
                'has-error'
            );

        }


        const input =
            document.getElementById(name);

        if (input) {

            input.classList.add(
                'has-error'
            );

        }

    }


    /* =========================================
       FORM VALIDATION
    ========================================== */

    form.addEventListener(
        'submit',
        function (event) {

            let valid = true;

            const t =
                translations[currentLanguage];


            /*
             * Clear previous errors
             */

            document
                .querySelectorAll('.field-error')
                .forEach(function (error) {

                    error.textContent = '';
                    error.classList.remove(
                        'show'
                    );

                });

            document
                .querySelectorAll('.has-error')
                .forEach(function (element) {

                    element.classList.remove(
                        'has-error'
                    );

                });


            /*
             * Text fields
             */

            const requiredTextFields = [
                'name',
                'company_name',
                'email',
                'job_title',
                'improvements',
                'interested_products'
            ];


            requiredTextFields.forEach(
                function (name) {

                    const input =
                        document.getElementById(name);

                    if (
                        !input ||
                        !input.value.trim()
                    ) {

                        showFieldError(
                            name,
                            t.required
                        );

                        valid = false;

                    }

                }
            );


            /*
             * Email validation
             */

            const email =
                document.getElementById('email');

            if (
                email.value.trim() &&
                !email.checkValidity()
            ) {

                showFieldError(
                    'email',
                    t.email
                );

                valid = false;

            }


            /*
             * Radio groups
             */

            const radioGroups = [
                'heard_from',
                'booth_rating',
                'booth_design',
                'attention_aspect',
                'representative_rating',
                'learned_something',
                'attended_presentation',
                'overall_satisfaction',
                'recommendation'
            ];


            radioGroups.forEach(
                function (name) {

                    const selected =
                        document.querySelector(
                            'input[name="' +
                            name +
                            '"]:checked'
                        );

                    if (!selected) {

                        showFieldError(
                            name,
                            t.selectRequired
                        );

                        valid = false;

                    }

                }
            );


            /*
             * Heard from - Other
             */

            const heardFrom =
                document.querySelector(
                    'input[name="heard_from"]:checked'
                );

            if (
                heardFrom &&
                heardFrom.value === 'other' &&
                !heardFromOther.value.trim()
            ) {

                showFieldError(
                    'heard_from',
                    t.otherRequired
                );

                valid = false;

            }


            /*
             * Attention aspect - Other
             */

            const attention =
                document.querySelector(
                    'input[name="attention_aspect"]:checked'
                );

            if (
                attention &&
                attention.value === 'other' &&
                !attentionOther.value.trim()
            ) {

                showFieldError(
                    'attention_aspect',
                    t.otherRequired
                );

                valid = false;

            }


            /*
             * Presentation feedback
             */

            const attended =
                document.querySelector(
                    'input[name="attended_presentation"]:checked'
                );


            if (
                attended &&
                attended.value === 'yes' &&
                !presentationFeedback.value.trim()
            ) {

                showFieldError(
                    'attended_presentation',
                    t.required
                );

                valid = false;

            }


            /*
             * Additional comments
             */

            const recommendation =
                document.querySelector(
                    'input[name="recommendation"]:checked'
                );


            if (
                recommendation &&
                recommendation.value === 'additional' &&
                !additionalComments.value.trim()
            ) {

                showFieldError(
                    'recommendation',
                    t.required
                );

                valid = false;

            }


            /*
             * Jika tidak valid,
             * jangan submit
             */

            if (!valid) {

                event.preventDefault();

                const firstError =
                    document.querySelector(
                        '.field-error.show'
                    );

                if (firstError) {

                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                }

                return;

            }


            /*
             * Kalau valid, tombol disabled
             * supaya tidak double submit
             */

            submitButton.disabled = true;

        }
    );


    /* =========================================
       INITIAL STATE
    ========================================== */

    updateHeardFromOther();

    updateAttentionOther();

    updatePresentationFeedback();

    updateAdditionalComments();

    setLanguage(
    document.getElementById('languageInput').value || 'fr'
);

});
</script>

@endsection