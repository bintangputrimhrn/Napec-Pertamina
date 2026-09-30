<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? __('feedback.title') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --form-width: 650px; }
        body {
            background: #fff;
            color: #333;
            font-family: "Rajdhani", "Roboto Condensed", Arial, sans-serif;
            font-size: 16px;
        }
        .napec-page { min-height: 100vh; }
        .brand-wrap { text-align: center; }
        .brand-logo { width: min(850px, 78vw); height: auto; display: inline-block; }
        .brand-placeholder {
            width: min(560px, 78vw);
            height: 125px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: clamp(42px, 8vw, 76px);
            letter-spacing: -2px;
        }
        .page-heading { font-size: 28px; font-weight: 800; margin: 12px 0 5px; }
        .page-subheading { font-size: 19px; font-weight: 700; margin-bottom: 42px; }
        .form-shell { width: min(var(--form-width), calc(100% - 40px)); margin: 0 auto; padding-bottom: 40px; }
        .home-shell { width: min(900px, calc(100% - 40px)); margin: 0 auto; text-align: center; }
        .home-shell .page-heading { margin-top: 20px; margin-bottom: 55px; }
        .language-buttons { display: flex; justify-content: center; gap: 200px; }
        .language-buttons .btn { min-width: 145px; font-size: 20px; font-weight: 700; letter-spacing: 1px; padding: 12px 28px; border: 0; border-radius: 3px; }
        .language-buttons .btn-english { background: #58aebb; color: #fff; }
        .language-buttons .btn-english:hover { background: #0b75b8;}
        .language-buttons .btn-france { background: #8bbb91; color: #fff; }
        .language-buttons .btn-france:hover { background: #bddc33;}
        .question { margin-bottom: 24px; }
        .question label.question-label, .field-label { display: block; font-weight: 700; margin-bottom: 9px; line-height: 1.35; }
        .required::after { content: " *"; color: #d22; }
        .form-control { border-radius: 2px; border-color: #cfcfcf; min-height: 38px; box-shadow: none !important; }
        .form-control:focus { border-color: #8dbbd3; }
        textarea.form-control { min-height: 80px; resize: vertical; }
        .option-list { display: grid; gap: 7px; }
        .form-check { min-height: 22px; margin: 0; }
        .form-check-input { margin-top: .28em; }
        .form-check-label { font-weight: 400 !important; cursor: pointer; }
        .two-col { display: grid; grid-template-columns: 1fr 1fr; column-gap: 80px; row-gap: 7px; }
        .rating-wrap { margin-top: 2px; }
        .star-rating { display: inline-flex; flex-direction: row-reverse; justify-content: flex-end; gap: 1px; }
        .star-rating input { position: absolute; opacity: 0; pointer-events: none; }
        .star-rating label { font-size: 35px; line-height: 1; color: #d5d5d5; cursor: pointer; padding: 0 1px; }
        .star-rating label:hover, .star-rating label:hover ~ label { color: #2485bd; }
        .star-rating label.active { color: #2485bd; }
        .star-rating input:focus-visible + label { outline: 2px solid #0d6efd; outline-offset: 2px; }
        .rating-help { font-size: 16px; color: #777; margin-top: 4px; }
        .other-input { display: none; margin-top: 7px; }
        .other-input.is-visible { display: block; }
        .submit-wrap { margin-top: 4px; }
        .submit-btn { background: #0b75b8; border: 0; border-radius: 3px; padding: 8px 17px; color: #fff; }
        .submit-btn:hover { background: #095f95; }
        .submit-btn:disabled { opacity: .7; }
        .alert { border-radius: 2px; }
        .success-shell { min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 40px 20px; }
        .success-content { width: min(650px, 100%); }
        .success-content h1 { font-size: 30px; font-weight: 800; margin: 30px 0 24px; }
        .admin-shell { width: min(1100px, calc(100% - 32px)); margin: 30px auto 60px; }
        .admin-card { background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 28px; box-shadow: 0 5px 20px rgba(0,0,0,.04); }
        .admin-card h1 { font-size: 28px; font-weight: 800; margin-bottom: 8px; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 22px; }
        .stat-card { border: 1px solid #ddd; border-radius: 6px; padding: 18px; background: #fafafa; }
        .stat-card span { display: block; color: #777; font-size: 13px; }
        .stat-card strong { display: block; font-size: 28px; margin-top: 3px; }
        .export-actions { display: flex; gap: 12px; flex-wrap: wrap; }
        .admin-wide { overflow: hidden; }
        @media (max-width: 700px) {
            .stats-grid { grid-template-columns: 1fr; }
            .admin-card { padding: 18px; }

            .page-heading { font-size: 24px; }
            .page-subheading { font-size: 17px; margin-bottom: 30px; }
            .language-buttons { gap: 12px; flex-direction: column; align-items: center; }
            .language-buttons .btn { width: min(220px, 80vw); }
            .two-col { grid-template-columns: 1fr; column-gap: 0; }
            .form-shell { width: calc(100% - 28px); }
        }
    </style>
</head>
<body>
@php($useOfficialBranding = filter_var(env('USE_OFFICIAL_BRANDING', false), FILTER_VALIDATE_BOOL))
<div class="napec-page">
    @if($useOfficialBranding)
        <div class="brand-wrap">
            <img class="brand-logo" src="{{ asset('assets/pertamina-logo.png') }}" alt="Pertamina">
        </div>
    @else
        <div class="brand-wrap">
            <div class="brand-placeholder" aria-label="NAPEC">NAPEC</div>
        </div>
    @endif
    @yield('content')
</div>
@stack('scripts')
</body>
</html>
