@extends('layouts.public')

@section('title', $page->seo_title ?? $page->title)
@section('meta_description', $page->seo_description)

@section('content')
<section class="cms-wrapper">
    <div class="cms-container">

        <h1 class="cms-page-title">
            {{ $page->title }}
        </h1>

        <div class="cms-divider"></div>

        <div class="cms-content">
            {!! html_entity_decode($page->content) !!}
        </div>
    </div>
</section>
@endsection
