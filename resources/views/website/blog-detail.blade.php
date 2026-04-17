@extends('layouts.website')

@section('title','Blog Details - Top Universities in India')

@section('body-class', 'blog-details')

@section('content')

<!-- HERO -->
<section class="udb-container udb-hero-wrap">
    <div class="container">
        <img 
            class="udb-hero-img" 
            src="{{ asset('storage/' . $blog->featured_image) }}" 
            alt="{{ $blog->title }}"
        >

        <h1 class="udb-title">{{ $blog->title }}</h1>

        <p class="udb-meta">
            <strong>By Admin</strong> |
            <strong>
                {{ \Carbon\Carbon::parse($blog->publish_date ?? $blog->created_at)->format('F d, Y') }}
            </strong> |
            <strong>{{ ucfirst($blog->category_name) }}</strong>
        </p>
    </div>
</section>

<!-- BODY -->
<section class="udb-container">
    <div class="container udb-grid">

        <!-- CONTENT -->
        <div class="udb-content">

            {!! $blog->detail->content ?? '' !!}

            @if(!empty($blog->detail?->tags))
                <div class="udb-quote">
                    {{ $blog->detail->tags }}
                </div>
            @endif

            <!-- AUTHOR -->
            <div class="udb-author-box">
                <img class="udb-author-img" src="{{ asset('images/profile.avif') }}">

                <div>
                    <strong>Admin</strong>
                    <p>Top Universities Team</p>
                </div>
            </div>

            <!-- COMMENTS -->
            <div class="udb-comments">
                <h3 class="udb-comment-title">Leave a Comment</h3>

                <form class="udb-form">
                    <input type="text" placeholder="Your Name">
                    <input type="email" placeholder="Your Email">
                    <textarea rows="4" placeholder="Your Comment"></textarea>
                    <button class="udb-btn" type="submit">Submit</button>
                </form>
            </div>

        </div>

        <!-- SIDEBAR -->
        <aside class="udb-sidebar">
            <h3 class="udb-sidebar-title">Recent Posts</h3>

            <ul class="udb-sidebar-list">
                @foreach($recentBlogs as $recentBlog)
                    <li>
                        <a href="{{ route('blog.detail', $recentBlog->slug) }}">
                            {{ $recentBlog->title }}
                        </a>
                    </li>
                @endforeach
            </ul>

            @if(!empty($blog->detail?->meta_keywords))
                <div style="margin-top: 30px;">
                    <h3 class="udb-sidebar-title">Tags</h3>

                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        @foreach(explode(',', $blog->detail->meta_keywords) as $keyword)
                            <span style="padding: 6px 12px; background: #f4f4f4; border-radius: 20px; font-size: 13px;">
                                {{ trim($keyword) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
</section>
@endsection