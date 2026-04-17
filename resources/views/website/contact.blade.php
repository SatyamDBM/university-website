@extends('layouts.website')

@section('title', $contactUs->seo_title ?? 'Contact Us - Top Universities in India')

@section('meta_description', $contactUs->seo_description)
@section('meta_keywords', $contactUs->seo_keywords)

@section('body-class', 'Contact-Us')

@section('content')

<section class="hero common-hero">
    <div class="hero-banner">
        <img src="{{ asset($contactUs->banner_image) }}" alt="Background Image" class="bg-image">
    </div>

    <div class="middleware">
        <div class="hero-content">
            <div class="left portion">
                <p class="hero-subtitle">
                    <img src="{{ asset('images/unversity.png') }}" alt="unversity">
                    {{ $contactUs->small_heading }}
                </p>

                <h2 class="hero-title">{{ $contactUs->heading }}</h2>

                <p class="hero-description">
                    {{ $contactUs->description }}
                </p>
            </div>
        </div>
    </div>
</section>

<section class="popular-streams">
    <div class="container">
        <p class="section-btn">{{ $contactUs->small_heading }}</p>
        <h2 class="section-title">{{ $contactUs->head_office_title }}</h2>

        <div class="tu-contact-container">

            <div class="tu-card-box new">
                <div class="offic">
                    <img src="{{ asset('images/contact.svg') }}" alt="Contact Icon">
                </div>

                <div class="office">
                    <p>{!! nl2br(e($contactUs->head_office_address)) !!}</p>

                    <p>
                        <strong>Phone:</strong>
                        <a href="tel:{{ $contactUs->head_office_phone }}">
                            {{ $contactUs->head_office_phone }}
                        </a>
                    </p>

                    <p>
                        <strong>Email:</strong>
                        <a href="mailto:{{ $contactUs->head_office_email }}">
                            {{ $contactUs->head_office_email }}
                        </a>
                    </p>

                    <p>
                        <strong>Working Hours:</strong>
                        {{ $contactUs->head_office_working_hours }}
                    </p>
                </div>
            </div>

            <p class="common-p">
                {{ $contactUs->student_support_description }}
            </p>
            
            <div class="cm-map">
                <iframe 
                    src="{{ $contactUs->head_office_map_iframe }}"
                    width="100%"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <div class="destination-add">
                <img src="{{ asset('images/addon.png') }}" alt="View All Universities">
            </div>

            <h2 class="tu-section-heading">Regional Offices</h2>

            <div class="tu-grid-layout">
                @foreach($contactUs->regionalOffices as $office)
                    <div class="tu-card-box">
                        <h3>{{ $office->city_name }}</h3>

                        <p>{!! nl2br(e($office->address)) !!}</p>

                        <div class="alignment-pp">
                            <i class="fa-solid fa-phone"></i>

                            <div class="phn-div">
                                <a href="tel:{{ $office->phone }}" class="link-gray-medium">
                                    {{ $office->phone }}
                                </a>
                            </div>
                        </div>

                        <div class="alignment-pp mt-2">
                            <i class="fa-solid fa-envelope"></i>

                            <div class="phn-div">
                                <a href="mailto:{{ $office->email }}" class="link-gray-medium">
                                    {{ $office->email }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <br>

            <div class="tu-card-box">
                <h2>{{ $contactUs->student_support_title }}</h2>

                <p>
                    {{ $contactUs->student_support_description }}
                </p>

                <p>
                    <strong>Email:</strong>
                    <a href="mailto:{{ $contactUs->student_support_email }}">
                        {{ $contactUs->student_support_email }}
                    </a>
                </p>

                <p>
                    <strong>Phone:</strong>
                    <a href="tel:{{ $contactUs->student_support_phone }}" class="no-underline text-black hover:no-underline">
                        {{ $contactUs->student_support_phone }}
                    </a>
                </p>
            </div>

        </div>
    </div>
</section>
@endsection