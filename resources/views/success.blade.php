@extends('layouts.app')

@section('content')

<style>
    .success-shell {
        width: 100% !important;
        min-height: auto !important;
        height: auto !important;
        display: flex !important;
        justify-content: center !important;
        align-items: flex-start !important;
        padding: 10px 20px 40px 20px !important;
        margin-top: -20px !important;
        box-sizing: border-box;
    }

    .success-content {
        width: 100% !important;
        max-width: 900px !important;
        text-align: center !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .success-content h1 {
        font-size: 28px;
        font-weight: 700;
        margin-top: 0 !important;
        margin-bottom: 20px !important;
        color: #111;
    }

    .success-content h2 {
        font-size: 26px;
        font-weight: 700;
        margin-top: 0 !important;
        margin-bottom: 50px !important;
        color: #111;
    }

    .success-message {
        background-color: #d1f0aa;
        border: 1px solid #b8d99a;
        border-radius: 0;
        padding: 20px 20px;
        margin: 0 auto;
        max-width: 900px;
        font-size: 18px;
        font-weight: 400;
        line-height: 1.7;
        color: #222;
        text-align: left;
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        .success-shell {
            margin-top: -10px !important;
            padding: 0 15px 30px 15px !important;
        }

        .success-content h1 {
            font-size: 25px;
        }

        .success-content h2 {
            font-size: 22px;
            margin-bottom: 35px !important;
        }

        .success-message {
            padding: 18px 20px;
            font-size: 15px;
        }
    }
</style>

@php
    $isFrench = ($language ?? 'en') === 'fr';
@endphp

<div class="success-shell">
    <div class="success-content">

        @if($isFrench)

            <h1>Pertamina NAPEC 2026</h1>

            <h2>Renseignements concernant le visiteur</h2>

            <p class="success-message">
                Merci d'avoir pris le temps de nous faire part de vos commentaires.
                Vos avis nous seront précieux pour améliorer nos futures expositions.
            </p>

        @else

            <h1>Pertamina NAPEC 2026</h1>

            <h2>Visitor Information</h2>

            <p class="success-message">
                Thank you for taking the time to provide your feedback.
                Your input is valuable to us in improving our future exhibitions.
            </p>

        @endif

    </div>
</div>

@endsection