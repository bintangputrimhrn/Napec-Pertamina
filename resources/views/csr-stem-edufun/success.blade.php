@extends('layouts.app')

@section('content')

<style>
    .edufun-logo {
    text-align: center;
    margin-bottom: 25px;
    }

    .edufun-logo img {
    max-width: 220px;
    width: 100%;
    height: auto;
    object-fit: contain;
    }

    .success-page {
        width: min(650px, calc(100% - 40px));
        margin: 0 auto;
        padding: 50px 0 70px;
        font-family: "Rajdhani", sans-serif;
        text-align: center;
    }

    .success-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 25px;
        border-radius: 50%;
        background: #e1f5d5;
        color: #37852a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 45px;
        font-weight: 700;
    }

    .success-page h1 {
        font-size: 30px;
        font-weight: 700;
        color: #111;
        margin-bottom: 15px;
    }

    .success-page p {
        font-size: 17px;
        line-height: 1.7;
        color: #555;
        margin-bottom: 30px;
    }

    .success-button {
        display: inline-block;
        background: #0b75b8;
        color: #fff;
        padding: 10px 22px;
        border-radius: 3px;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
    }

    .success-button:hover {
        background: #095f95;
        color: #fff;
    }

    @media (max-width: 700px) {
        .success-page h1 {
            font-size: 25px;
        }
    }
</style>

<div class="success-page">

    <h1>Thank you for your registration</h1>

    <p>
        Please collect your ID badges at First Floor, Event Floor, West Court, Bintang Megamall
    </p>

    <a href="{{ route('csr-stem-edufun.create') }}" class="success-button">
        Back to Registration
    </a>
</div>

@endsection