@extends('layouts.app')

@section('content')
<div class="home-shell">
    <h1 class="page-heading">{{ __('feedback.title') }}</h1>

    <div class="language-buttons">
        <a href="{{ route('feedback.en') }}" class="btn btn-english">{{ __('feedback.language.english') }}</a>
        <a href="{{ route('feedback.fr') }}" class="btn btn-france">{{ __('feedback.language.france') }}</a>
    </div>
</div>
@endsection
