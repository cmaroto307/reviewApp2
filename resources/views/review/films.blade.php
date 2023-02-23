@extends('layouts.app')

@section('modalContent')
	@foreach($reviews as $review)
		@if($review->tipo == 'film')
			<div class="row bt-solid-1 bb-dashed-1 pb25">
				
			    <!-- Item Image
			    ======================== -->
			    <div class="col-md-3 col-sm-4 col-xs-12">
			        <div class="shop-item-container-in">
			            <a href="{{ url('review/' . $review->id) }}" 
			            	class="img-responsive center-block shop-item-img-list-view"
			            	style="background-image: url('data:image/jpeg;base64,{{ $review->thumbnail }}');
			            		   background-size:cover;"></a>
			        </div>
			    </div>
			    
			    <!-- Item Summary
			    ======================== -->
			    <div class="col-md-6 col-sm-4 col-xs-12">
			        <h3>{{ $review->nombre }}</h3>
			        <p class="mt20 text-uppercase">
			            <i class="fa fa-calendar"></i> {{ \Str::substr($review->created_at, 0, 10); }}
			            <br/>
			            <i class="fa fa-pencil"></i> {{ $review->user->name }}
			            <br/>
                        <i class="fa fa-tags"></i> <a href="{{ url('reviews/' . $review->tipo) }}">{{ $review->tipo }}S</a>
			        </p>
			        <div class="mt10 pt10 bt-dotted-1">
			        	<?php
			        	$count_comments = $review->ncomments;
                    	if($count_comments>0){
                    		$stars = $review->stars;
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
			            <br/>
			            <i class="fa fa-comment-o mt10"></i> {{ $count_comments }} Comments
			        </div>
			    </div>
			    
			    <!-- Link Analysis
			    ======================== -->
			    <div class="col-md-3 col-sm-4 col-xs-12 text-center">
			        <a href="{{ url('review/' . $review->id) }}" class="button button-md button-pasific hover-icon-wobble-horizontal mt25">
			        	View Analysis<i class="bi bi-bookmark-plus-fill"></i>
			        </a>
			    </div>
			</div>
	  	@endif
	@endforeach
	@if(Auth::user()->isAdvanced())
		<a class="button button-md button-pasific mt10 hover-icon-wobble-horizontal" href="{{ url('review/create') }}">NEW REVIEW</a>
	@endif
@endsection