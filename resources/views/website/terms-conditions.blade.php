@extends('layouts.website')

@section('title', ($termsPage->seo_title ?? 'Terms-Conditions') . ' - Top Universities in India')

@section('body-class', 'Terms-Conditions')

@section('content')

<!-- Banner section -->
<section class="hero common-hero">

    <div class="hero-banner">
        <img src="{{ asset('images/banner.png') }}" alt="Background Image" class="bg-image">
    </div>

    <div class="middleware">
        <div class="hero-content">
            <div class="left portion">
                <p class="hero-subtitle">
                    <img src="{{ asset('images/unversity.png') }}" alt="unversity">
                    india's #1 University Discovery Platform
                </p>

                <h2 class="hero-title">
                    {{ $termsPage->title ?? 'Terms and Conditions' }}
                </h2>

                <p class="hero-description">
                    Welcome to your trusted platform for discovering the best educational opportunities across India.
                </p>
            </div>
        </div>
    </div>
</section>
<!--End of Banner section -->

<section class="popular-streams">
    <div class="container">
        <h2 class="section-title">
            {{ $termsPage->title ?? 'Terms and Conditions' }}
        </h2>

        <p class="section-subtitle">
            Last updated:
            {{ !empty($termsPage?->updated_at) ? \Carbon\Carbon::parse($termsPage->updated_at)->format('F Y') : 'March 2026' }}
        </p>

        <div class="content">
            {!! $termsPage->content ?? '' !!}
        </div>
    </div>
</section>
@endsection