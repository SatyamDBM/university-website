@extends('layouts.website')

@section('title', 'Blog - Top Universities in India')

@section('body-class', 'blog')

@section('content')

<section class="hero common-hero">
    <div class="hero-banner">
        <img src="{{ asset('images/banner.png') }}" alt="Background Image" class="bg-image">
    </div>

    <div class="middleware">
        <div class="hero-content">
            <div class="left portion">
                <p class="hero-subtitle">
                    <img src="{{ asset('images/unversity.png') }}" alt="university">
                    India's #1 University Discovery Platform
                </p>
                <h2 class="hero-title">Blog</h2>
                <p class="hero-description">
                    Welcome to your trusted platform for discovering the best educational opportunities across India.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="Blog-list-page">
    <div class="W">
        <div class="sh rv">
            <p class="section-btn">Post and Article</p>
            <div class="sh-h">Recent Post</div>
            <div class="sh-sub">
                Discover insightful articles, student experiences, and expert perspectives
                that bring university life, academics, and innovation together in one place.
            </div>
        </div>

        <div class="fac-grid rv" style="margin-top:28px">
            @forelse($blogs as $blog)
                <div class="fac-card rv d1">
                    <div class="fac-img">
                        <img 
                            src="{{ asset('storage/' . $blog->featured_image) }}" 
                            alt="{{ $blog->title }}" 
                            loading="lazy"
                        >
                    </div>

                    <div class="fac-body">
                        <div class="fac-name">
                            {{ $blog->title }}
                        </div>

                        <div class="fac-desc">
                            {{ $blog->short_description }}
                        </div>

                        <a href="{{ url('blog-detail/' . $blog->slug) }}" class="course-link">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center;">
                    <p>No blogs found.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection