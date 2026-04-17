@extends('layouts.website')

@section('title', $aboutUs->seo_title ?? 'About-Us - Top Universities in India')

@section('meta_description', $aboutUs->seo_description)
@section('meta_keywords', $aboutUs->seo_keywords)

@section('body-class', 'About-Us')

@section('content')
<!-- Banner section -->
<section class="hero common-hero">

    <div class="hero-banner">
        <img src="{{ asset($aboutUs->banner_image) }}" alt="Background Image" class="bg-image">
    </div>

    <div class="middleware">
        <div class="hero-content">
            <div class="left portion">
                <p class="hero-subtitle">
                    <img src="{{ asset('images/unversity.png') }}" alt="unversity">
                    {{ $aboutUs->small_heading }}
                </p>
                <h2 class="hero-title">{{ $aboutUs->heading }}</h2>
                <p class="hero-description">{{ $aboutUs->description }}</p>
            </div>
        </div>
    </div>
</section>
<!--End of Banner section -->

<!-- Client profile-->
<section class="about-left-right">
    <div class="container">

        <div class="about-flex">

            <div class="about-img desktop">
                <img src="{{ asset($aboutUs->founder_image) }}" alt="{{ $aboutUs->founder_name }}">
            </div>

            <div class="about-content">
                <p class="section-btn">{{ $aboutUs->founder_section_badge }}</p>
                <h2 class="section-title">{{ $aboutUs->founder_section_title }}</h2>

                @php
                    $founderParagraphs = explode("\n", $aboutUs->founder_description);
                @endphp

                @foreach($founderParagraphs as $paragraph)
                    @if(trim($paragraph))
                        <p class="common-p">{{ trim($paragraph) }}</p>
                    @endif
                @endforeach

                <div class="about-img mobile">
                    <img src="{{ asset($aboutUs->founder_image) }}" alt="{{ $aboutUs->founder_name }}">
                </div>

                <h3 class="section-title">{{ $aboutUs->founder_name }}</h3>

                <p class="common-p" style="margin-top: 0; margin-bottom: 25px;">
                    {{ $aboutUs->founder_designation }}
                </p>

                <a href="{{ $aboutUs->founder_button_link }}" class="common-b">
                    {{ $aboutUs->founder_button_text }}
                </a>
            </div>

        </div>

    </div>
</section>
<!-- End client profile -->

<!-- Our story-->
<section class="story">
    <div class="container">
        <div class="bg-colr">
            <div class="story-content">
                <p class="section-btn">{{ $aboutUs->journey_section_badge }}</p>
                <h2 class="section-title">{{ $aboutUs->journey_section_title }}</h2>

                @php
                    $journeyParagraphs = explode("\n", $aboutUs->journey_description);
                @endphp

                @foreach($journeyParagraphs as $paragraph)
                    @if(trim($paragraph))
                        <p class="common-p">{{ trim($paragraph) }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- End client profile -->

<!-- Meet Our Leadership Team -->
<section class="leadership">
    <div class="container">
        <p class="section-btn">{{ $aboutUs->leadership_section_badge }}</p>
        <h2 class="section-title">{{ $aboutUs->leadership_section_title }}</h2>
        <p class="section-subtitle">{{ $aboutUs->leadership_description }}</p>

        <div class="leadership-grid">
            @foreach($aboutUs->leadershipTeamMembers as $member)
                <div class="leader-card">
                    <div class="profile-type">
                        <img src="{{ asset($member->image) }}" alt="{{ $member->name }}">
                    </div>

                    <div class="profile-content">
                        <h3>{{ $member->name }}</h3>

                        <p style="margin: 10px 0;">
                            {{ $member->designation }}
                        </p>

                        @if($member->linkedin_url)
                            <a target="_blank" href="{{ $member->linkedin_url }}">
                                <img alt="linkedin-logo" width="30" height="30" src="{{ asset('images/linkedin.png') }}">
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection