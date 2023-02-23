@extends('layouts.app')

@section('modalContent')
    <!-- Subheader Area
    ===================================== -->
    <header class="bg-grad-day-tripper">
        <div class="container">
            <div class="row mt20 mb30">
                <div class="col-md-6 text-left">
                    <h3 class="color-light text-uppercase animated" data-animation="fadeInUp" data-animation-delay="100">Analysis of the<small class="color-light alpha7">{{ $review->tipo }}: {{ $review->nombre }}</small></h3>
                </div>
                <div class="col-md-6 text-right pt35">
                    <ul class="breadcrumb">
                        <li><a href="{{ url('reviews/' . $review->tipo) }}" class="text-uppercase">{{ $review->tipo }}S</a></li>
                        <li>{{ $review->nombre }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Post Area
    ===================================== -->
    <section id="blog" class="pt50 pb50">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="blog-three-mini">
                        <h2 class="color-dark">{{ $review->nombre }}</h2>
                        <div class="blog-three-attrib">
                            <div><i class="fa fa-calendar"></i>{{ \Str::substr($review->created_at, 0, 10); }}</div> | 
                            <div><i class="fa fa-pencil"></i>{{ $review->user->name }}</div> | 
                            <div>
                            	<?php
					        	$count_comments = count($review->comments);
		                    	if($count_comments>0){
		                    		$stars = 0;
		                    		foreach($review->comments as $comment){
		                        		$stars += $comment->stars;
		                    		}
		                    		$stars = $stars/$count_comments;
		                    		for($i=1; $i<=5; $i++){
		                    			if($i<=$stars){
		                            		?>
		                        			<i class="fa fa-star color-yellow" aria-hidden="true"></i>
		                        			<?php
		                    			}
		                    			else if($i-$stars>0 && $i-$stars<1){
		                            		?>
		                        			<i class="fa fa-star-half-o color-yellow" aria-hidden="true"></i>
		                        			<?php
		                    			}
		                    			else {
		                            		?>
		                        			<i class="fa fa-star-o color-yellow" aria-hidden="true"></i>
		                        			<?php
		                    			}
		                    		}
		                    	} else {
		                        ?>
		                        	<i class="fa fa-star-o color-yellow" aria-hidden="true"></i>
		                        	<i class="fa fa-star-o color-yellow" aria-hidden="true"></i>
		                        	<i class="fa fa-star-o color-yellow" aria-hidden="true"></i>
		                        	<i class="fa fa-star-o color-yellow" aria-hidden="true"></i>
		                        	<i class="fa fa-star-o color-yellow" aria-hidden="true"></i>
		                    	<?php
		                    	}
		                        ?>
                            </div> | 
                            <div><i class="fa fa-comment-o"></i>{{ $count_comments }} Comments</div> | 
                            <div>
                                Share:  <a href="#"><i class="fa fa-facebook-official"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                        <div class="row">
	                        <img class="img-responsive col-md-6" alt="{{ $review->nombre }}" src="data:image/jpeg;base64,{{ $review->thumbnail }}" style="object-fit: contain;">
	                        <p class="lead mt25 col-md-6">
	                            {{ $review->review }}
	                        </p>
                        </div>
                        <div class="blog-post-read-tag mt10">
                            <i class="fa fa-tags"></i> Tags:
                            <a href="{{ url('reviews/' . $review->tipo) }}" class="text-uppercase">{{ $review->tipo }}S</a>
                        </div>
		            	@if(count($review->images)>0)
			            	<h5><i class="fa fa-camera mt50 mb25"></i> Images</h5>
				            <div class="row">
			                	@foreach($review->images as $img)
			                    	<img class="img-responsive mb10 col-md-6" alt="{{ $review->nombre }}/$img->name" src="{{ asset('storage/images/' . $img->name) }}">
			                	@endforeach
							</div>
		            	@endif
						@if(Auth::user()->isAdmin() || Auth::user()->id  == $review->iduser)
		                    <div class="row mt25 mb25 justify-content-between">
			                    <button class="button button-pasific button-sm">
			            			<a href="{{ url('review/'. $review->id . '/edit') }}" style="color:white;">EDIT POST</a>
			        			</button>
					            <form method="POST" action="{{ url('review/'. $review->id) }}">
					                @method('delete')
					                @csrf
					                <input type="submit" class="button button-pasific button-sm" value="DELETE POST"/>
					            </form>
		                    </div>
		            	@endif
                    </div>
        			
                    <div class="blog-post-comment-container">
                        <h5><i class="fa fa-comments-o mb10"></i> {{ $count_comments }} Comments</h5>
	                	@foreach($review->comments as $comment)
                			<div class="blog-post-comment">
	                            <span class="blog-post-comment-name"><i class="fa fa-comment"></i> {{ $comment->user->name }}</span><i class="fa fa-calendar"></i> {{ \Str::substr($comment->created_at, 0, 10); }}
	                            <p>
	                            	"{{ $comment->text }}"
	                            	<br/>
		                            <?php
	                        		$stars = $comment->stars;
	                        		for($i=1; $i<=5; $i++){
	                        			if($i<=$stars){
		                            		?>
	                            			<i class="fa fa-star color-yellow" aria-hidden="true"></i>
	                            			<?php
	                        			}
	                        			else {
		                            		?>
	                            			<i class="fa fa-star-o color-yellow" aria-hidden="true"></i>
	                            			<?php
	                        			}
	                        		}
		                            ?>
	                            </p>
								@if(Auth::user()->isAdvanced() || Auth::user()->id == $comment->iduser)
									<a href="{{ url('comment/' . $comment->id . '/edit') }}"><i class="fa fa-reply" aria-hidden="true"></i> Edit</a>
									<form method="POST" style="float:left;" action="{{ url('comment/'. $comment->id) }}">
						                @method('delete')
						                @csrf
						                <i class="fa fa-reply" aria-hidden="true"></i><input type="submit" class="link-delete" value="Delete"/>
						            </form>
		            			@endif
	                        </div>
	                	@endforeach
                    </div>
                    
					@if(Auth::user()->isAdvanced() || Auth::user()->isVerified())
	                    <div class="blog-post-leave-comment">
	                        <h5><i class="fa fa-comment mt25 mb10"></i> Leave Comment</h5>
	                        <form method="POST" action="{{ url('comment') }}">
								@csrf
								<input id="idreview" name="idreview" class="hidden" value="{{ $review->id }}">
	                            <textarea name="text" class="blog-leave-comment-textarea" required>{{ old('text') }}</textarea>
                                <label for="stars">Stars:</label>
                                <select id="stars" name="stars" class="form-control" style="height: 40px;" required>
		                            <option value="" selected disabled hidden>Select stars</option>
		                            @foreach($stars_review as $star)
		                                <option value="{{ $star }}" <?php if(old('stars') == $star) echo 'selected' ?>>{{ $star }}</option>
		                            @endforeach
		                        </select>
	                            <button class="button button-pasific button-sm center-block mt20 mb25">Post Comment</button>                            
	                        </form>
	                    </div>
	            	@else
	            		<div class="row mt25">
	            			<p>If you want to write a comment, you must verify your account:</p>
		                    <button class="button button-pasific button-sm center-block mb25">
		                    	<a href="{{ url('email/verify') }}" style="color:white;">Verify your email</a>
		        			</button>
	                    </div>
	            	@endif
                </div>    
            </div>
        </div>
    </section>
@endsection