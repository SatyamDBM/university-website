@extends('layouts.website')

@section('title', '404 - Page Not Found')

@section('body-class', 'error-page')

@section('content')
<div class="error-404 not-found erro-page-heading container">

		<div class="error-page-content">
			<div class="page-content">
                <h1 class="section-heading"><span class="red">404</span> Error</h1>
				<h2>Hey there mate! Your lost treasure is not found here...</h2>
				<p>Sorry! The page you are looking for was not found!</p>
				<div class="custom-btn common-btn red-btn">
					<a class="main-btn" href="{{route('home')}}">Home</a>
				</div>
			</div>
		</div>
</div>
@endsection