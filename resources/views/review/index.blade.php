@extends('layouts.app')

@section('modalContent')
	<!-- Intro Area
	===================================== -->
	<header class="parallax-window-5 bg-black" style="background:url('assets/img/bg/img-bg-41.jpg') 50% 0% no-repeat #000;">            
	    <div class="container">                    
	        <div class="row"><div class="col-md-8 col-md-offset-2 text-center pt100">&nbsp;</div></div>
	        <div class="row"><div class="col-md-8 col-md-offset-2 text-center pt100">&nbsp;</div></div>
	        <div class="row">
	            <div class="col-md-8 col-md-offset-2 text-center pt100">
	                <h1 class="brand-heading text-capitalize font-pacifico mt80 color-light animated" data-animation="fadeInUp" data-animation-delay="100">
	                    We <i class="fa fa-heart main-color animated infinite" data-animation="pulse ml5 mr5"></i> Reviews
	                </h1>
	            </div>
	        </div>
	    </div>
	</header>
	
	<!-- Films
	===================================== -->
	<div class="container">
		<div class="row">
	        <h3 class="text-center col-12">                          
	            Films
	            <small class="heading-desc">
	                Our reviews of your favorite films.
	            </small>
	            <small class="heading heading-solid center-block"></small>
	        </h3>
		</div>
		<div class="row">
			<?php
			$count = 0;
			foreach($reviews as $review) {
				if($review->tipo == 'film' && $count<2) {
					$count++;
					?>
					<div class="col-sm-12 col-md-6 col-lg-4 tarjet">
						<a href="{{ url('review/' . $review->id) }}"><img alt="{{ $review->nombre }}" src="data:image/jpeg;base64,{{ $review->thumbnail }}"></a>
					</div>
				<?php
				}
			}
			?>
			<div class="col-sm-12 col-md-6 col-lg-4 tarjet">
				<a href="{{ url('reviews/film') }}"><img alt="See More" src="{{ asset('assets/img/tarjet/tarjet-more-1.png') }}"></a>
			</div>
		</div>
	</div>
	
	<!-- Books
	===================================== -->
	<div class="container">
		<div class="row">
	        <h3 class="text-center col-12">                          
	            Books
	            <small class="heading-desc">
	                Our reviews of your favorite books.
	            </small>
	            <small class="heading heading-solid center-block"></small>
	        </h3>
		</div>
		<div class="row">
			<?php
			$count = 0;
			foreach($reviews as $review) {
				if($review->tipo == 'book' && $count<2) {
					$count++;
					?>
					<div class="col-sm-12 col-md-6 col-lg-4 tarjet">
						<a href="{{ url('review/' . $review->id) }}"><img alt="{{ $review->nombre }}" src="data:image/jpeg;base64,{{ $review->thumbnail }}"></a>
					</div>
				<?php
				}
			}
			?>
			<div class="col-sm-12 col-md-6 col-lg-4 tarjet">
				<a href="{{ url('reviews/book') }}"><img alt="See More" src="{{ asset('assets/img/tarjet/tarjet-more-1.png') }}"></a>
			</div>
		</div>
	</div>
	
	<!-- Records
	===================================== -->
	<div class="container">
		<div class="row">
	        <h3 class="text-center col-12">                          
	            Records
	            <small class="heading-desc">
	                Our reviews of your favorite records.
	            </small>
	            <small class="heading heading-solid center-block"></small>
	        </h3>
		</div>
		<div class="row">
			<?php
			$count = 0;
			foreach($reviews as $review) {
				if($review->tipo == 'record' && $count<2) {
					$count++;
					?>
					<div class="col-sm-12 col-md-6 col-lg-4 tarjet">
						<a href="{{ url('review/' . $review->id) }}"><img alt="{{ $review->nombre }}" src="data:image/jpeg;base64,{{ $review->thumbnail }}"></a>
					</div>
				<?php
				}
			}
			?>
			<div class="col-sm-12 col-md-6 col-lg-4 tarjet">
				<a href="{{ url('reviews/record') }}"><img alt="See More" src="{{ asset('assets/img/tarjet/tarjet-more-2.png') }}"></a>
			</div>
		</div>
	</div>