
@extends('layouts.website')

@section('title', 'Faq - Top Universities in India')

@section('body-class', 'Faq')

@section('content')
        <!-- Banner section -->
    <section class="hero common-hero">

        <div class="hero-banner">
        <img src="images/banner.png" alt="Background Image" class="bg-image">
        </div>

        <div class="middleware">
            <div class="hero-content">
                <div class="left portion">
                <p class="hero-subtitle"><img src="images/unversity.png" alt="unversity"> india’s #1 University Discovery Platform</p>
                <h2 class="hero-title">Frequently Asked Questions</h2>
                <p class="hero-description">Welcome to your trusted platform for discovering the best educational opportunities across India.</p>
                </div>
            </div>
        </div>
    </section>
    <!--End of Banner section -->

    <!-- Popular Streams -->
<section class="Faq-section">
  <div class="container">
    <p class="section-btn">Asked Question</p>
    <h2 class="section-title">Frequently asked questions</h2>
    <p class="section-subtitle">
      Explore clear and concise answers to the most commonly asked questions.
    </p>

  <div class="faq-section">

      @forelse($faqs as $index => $faq)
          <div class="faq-item">
              <div class="faq-q">
                  <span>{{ $index + 1 }}. {{ $faq->question }}</span>
                  <span class="faq-icon">+</span>
              </div>
              <div class="faq-a">
                  <p>{{ $faq->answer }}</p>
              </div>
          </div>
      @empty
          <p>No FAQs found.</p>
      @endforelse

  </div>
  </div>
</section>

@endsection