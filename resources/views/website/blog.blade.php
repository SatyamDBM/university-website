@extends('layouts.website')

@section('title', 'Blog - Top Universities in India')

@section('body-class', 'blog')

@section('content')

    {{-- ========== HERO / BANNER SECTION ========== --}}
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
    {{-- ========== END HERO SECTION ========== --}}


    {{-- ========== BLOG LIST SECTION ========== --}}
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

                <div class="fac-card rv d1">
                    <div class="fac-img">
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=500&q=75&fit=crop" alt="Research Labs" loading="lazy">
                    </div>
                    <div class="fac-body">
                        <div class="fac-name">Research Labs</div>
                        <div class="fac-desc">500+ advanced labs with IBM, Cisco & Intel certified infrastructure. AI/ML, IoT, Robotics & Biotech centres.</div>
                        <a href="{{ url('blog-detail') }}" class="course-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="fac-card rv d2">
                    <div class="fac-img">
                        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=500&q=75&fit=crop" alt="Central Library" loading="lazy">
                    </div>
                    <div class="fac-body">
                        <div class="fac-name">Central Library</div>
                        <div class="fac-desc">5 lakh+ books, 15,000+ e-journals, JSTOR & Springer access. Air-conditioned 24×7 reading halls.</div>
                        <a href="{{ url('blog-detail') }}" class="course-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="fac-card rv d3">
                    <div class="fac-img">
                        <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=500&q=75&fit=crop" alt="Sports Complex" loading="lazy">
                    </div>
                    <div class="fac-body">
                        <div class="fac-name">Sports Complex</div>
                        <div class="fac-desc">Olympic-size swimming pool, cricket stadium, football ground, basketball, badminton & 20+ other sports.</div>
                        <a href="{{ url('blog-detail') }}" class="course-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="fac-card rv d4">
                    <div class="fac-img">
                        <img src="https://images.unsplash.com/photo-1538108149393-fbbd81895907?w=500&q=75&fit=crop" alt="Hospital" loading="lazy">
                    </div>
                    <div class="fac-body">
                        <div class="fac-name">University Hospital</div>
                        <div class="fac-desc">On-campus 200-bed hospital with 24×7 emergency, OPD, dental, physiotherapy & pharmacy services.</div>
                        <a href="{{ url('blog-detail') }}" class="course-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="fac-card rv d1">
                    <div class="fac-img">
                        <img src="https://images.unsplash.com/photo-1519452575417-564c1401ecc0?w=500&q=75&fit=crop" alt="Auditorium" loading="lazy">
                    </div>
                    <div class="fac-body">
                        <div class="fac-name">Grand Auditorium</div>
                        <div class="fac-desc">5,000-seat air-conditioned auditorium hosting national tech fests, cultural events & convocations.</div>
                        <a href="{{ url('blog-detail') }}" class="course-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="fac-card rv d2">
                    <div class="fac-img">
                        <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=500&q=75&fit=crop" alt="Gym" loading="lazy">
                    </div>
                    <div class="fac-body">
                        <div class="fac-name">Fitness Centre</div>
                        <div class="fac-desc">State-of-the-art gym, yoga hall, aerobics studio and wellness centre open 6 AM – 10 PM daily.</div>
                        <a href="{{ url('blog-detail') }}" class="course-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="fac-card rv d3">
                    <div class="fac-img">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=500&q=75&fit=crop" alt="Food Court" loading="lazy">
                    </div>
                    <div class="fac-body">
                        <div class="fac-name">Multi-Cuisine Food Court</div>
                        <div class="fac-desc">20+ food outlets with North Indian, South Indian, Chinese, Continental and fast food. Open 7 AM – 11 PM.</div>
                        <a href="{{ url('blog-detail') }}" class="course-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="fac-card rv d4">
                    <div class="fac-img">
                        <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=500&q=75&fit=crop" alt="Lecture Halls" loading="lazy">
                    </div>
                    <div class="fac-body">
                        <div class="fac-name">Smart Classrooms</div>
                        <div class="fac-desc">800+ smart classrooms with interactive panels, high-speed internet, projectors and ergonomic seating.</div>
                        <a href="{{ url('blog-detail') }}" class="course-link">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- ========== END BLOG LIST SECTION ========== --}}
@endsection