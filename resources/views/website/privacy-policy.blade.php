@extends('layouts.website')

@section('title', ($privacyPage->seo_title ?? 'Privacy-policy') . ' - Top Universities in India')

@section('body-class', 'Privacy-policy')

@section('content')
 <!-- End of Header -->

    <!-- Banner section -->
<section class="hero common-hero">

    <div class="hero-banner">
    <img src="images/banner.png" alt="Background Image" class="bg-image">
    </div>

    <div class="middleware">
        <div class="hero-content">
            <div class="left portion">
            <p class="hero-subtitle"><img src="images/unversity.png" alt="unversity"> india's #1 University Discovery Platform</p>
            <h2 class="hero-title">{{ $privacyPage->title ?? 'Privacy Policy' }}</h2>
            <p class="hero-description">Welcome to your trusted platform for discovering the best educational opportunities across India.</p>
            </div>
        </div>
    </div>
</section>
<!--End of Banner section -->

<section class="popular-streams">
    <div class="container">
            <h2 class="section-title">Privacy & Policy</h2>
            <p class="section-subtitle">
                Last updated: 
                {{ !empty($privacyPage?->updated_at) ? \Carbon\Carbon::parse($privacyPage->updated_at)->format('F Y') : '-' }}
            </p>

        <div class="content">
            {!! $privacyPage->content ?? '' !!}
        </div>
    </div>
</section>
@endsection