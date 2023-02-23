@extends('layouts.app')

@section('modalContent')
    <div id="shop" class="bg-light">
        <div class="container">
            <div class="row">
            	
            	<!-- Sidebar
                ===================================== -->
                <div id="sidebar" class="col-md-3 mt25 animated" data-animation="fadeInLeft" data-animation-delay="250">           
                    
                    <!-- Search
                    ===================================== -->
                    <div class="mt75 pr25 pl25 clearfix">
                        <form url="{{ url('reviews/all') }}">
                            <div class="form-group">
                                <input id="searchreview" name="searchreview" type="text" class="form-control" placeholder="Search" value={{$searchreview}}>
                            </div>
                            <button type="submit" class="button button-sm button-block button-dark mt-10">Search</button>
                        </form>
                    </div>
                    
                    <!-- Categories
                    ===================================== -->
                    <div class="pr25 pl25 clearfix">
                        <h5 class="mt25">
                            Categories
                            <span class="heading-divider mt10"></span>
                        </h5>
                        </select>
                        <ul class="shop-sidebar pl25">
                			<li>
                			    <form url="{{ url('reviews/all') }}">
                			        <input id="searchreview" name="searchreview" class="hidden" value="{{$searchreview}}">
                			        <input id="filtertype" name="filtertype" class="hidden" value="t1">
                			        <input id="filterstars" name="filterstars" class="hidden" value="{{$filterstars}}">
                			        <input id="orderby" name="orderby" class="hidden" value="{{$orderby}}">
                			        <input id="items_per_page" name="items_per_page" class="hidden" value="{{$items_per_page}}">
                			        <button type="submit" class="link-delete" <?php if($filtertype == 't1') echo 'style="color: #ff4530;"'?>>Films</button><span class="badge badge-pasific pull-right">{{ $count_type_film }}</span>
                			    </form>
                			</li>
                			<li>
                			    <form url="{{ url('reviews/all') }}">
                			        <input id="searchreview" name="searchreview" class="hidden" value="{{$searchreview}}">
                			        <input id="filtertype" name="filtertype" class="hidden" value="t2">
                			        <input id="filterstars" name="filterstars" class="hidden" value="{{$filterstars}}">
                			        <input id="orderby" name="orderby" class="hidden" value="{{$orderby}}">
                			        <input id="items_per_page" name="items_per_page" class="hidden" value="{{$items_per_page}}">
                            		<button type="submit" class="link-delete" <?php if($filtertype == 't2') echo 'style="color: #ff4530;"'?>>Books</button><span class="badge badge-pasific pull-right">{{ $count_type_book }}</span>
                			    </form>
                			</li>
                			<li>
                			    <form url="{{ url('reviews/all') }}">
                			        <input id="searchreview" name="searchreview" class="hidden" value="{{$searchreview}}">
                			        <input id="filtertype" name="filtertype" class="hidden" value="t3">
                			        <input id="filterstars" name="filterstars" class="hidden" value="{{$filterstars}}">
                			        <input id="orderby" name="orderby" class="hidden" value="{{$orderby}}">
                			        <input id="items_per_page" name="items_per_page" class="hidden" value="{{$items_per_page}}">
                			        <button type="submit" class="link-delete" <?php if($filtertype == 't3') echo 'style="color: #ff4530;"'?>>Records</button><span class="badge badge-pasific pull-right">{{ $count_type_record }}</span>
                			    </form>
                			</li>
                        </ul>
                    </div>
                    
                    <!-- Filter by Stars
                    ===================================== -->
                    <div class="pr25 pl25 clearfix">
                        <h5 class="mt25">
                            Filter by Stars
                            <span class="heading-divider mt10"></span>
                        </h5>
                        <form url="{{ url('reviews/all') }}">
        			        <input id="searchreview" name="searchreview" class="hidden" value="{{$searchreview}}">
        			        <input id="filtertype" name="filtertype" class="hidden" value="{{$filtertype}}">
        			        <input id="orderby" name="orderby" class="hidden" value="{{$orderby}}">
        			        <input id="items_per_page" name="items_per_page" class="hidden" value="{{$items_per_page}}">
                            <select id="filterstars" name="filterstars" class="form-control" style="height: 40px;" onchange="this.form.submit()">
                                <option value="" selected disabled hidden>Select stars</option>
                                <option value="s1" <?php if($filterstars == 's1') echo 'selected'?>>1 - 5 stars</option>
                                <option value="s2" <?php if($filterstars == 's2') echo 'selected'?>>2 - 5 stars</option>
                                <option value="s3" <?php if($filterstars == 's3') echo 'selected'?>>3 - 5 stars</option>
                                <option value="s4" <?php if($filterstars == 's4') echo 'selected'?>>4 - 5 stars</option>
                            </select>
                        </form>
                    </div>
                    
                    <!-- Latest Reviews
                    ===================================== -->
                    <div class="pr25 pl25 clearfix">
                        <h5 class="mt25">
                            Latest Reviews
                            <span class="heading-divider mt10"></span>
                        </h5>
                        <div class="shop-sidebar-cart">
                            <?php
                            $count = 0;
                            foreach($last_reviews as $review){
				                if($count<3) {
                                    $count++;
                            ?>
                                    <div class="sidebar-cart-container">
    						            <a href="{{ url('review/' . $review->id) }}" 
    						            	class="img-responsive center-block shop-item-img-list-view pull-left"
    						            	style="background-image: url('data:image/jpeg;base64,{{ $review->thumbnail }}');
    						            		   width: 50px; height:72px; background-size:cover; background-position:center; margin-right: 10px;"></a>
                                        <h6>{{ $review->nombre }}</h6>
                                        <span class="sidebar-cart-price text-gray">{{ $review->tipo }}</span>
                                        </br>
                                        <span class="sidebar-cart-remove">
                                            <?php
        				                	if($review->ncomments>0){
        				                		$stars = $review->stars;
        				                		for($i=1; $i<=5; $i++){
        				                			if($i<=$stars){
        				                        		?>
        				                    			<i class="fa fa-star text-orange"></i>
        				                    			<?php
        				                			}
        				                			else if($i-$stars>0 && $i-$stars<1){
        				                        		?>
        				                    			<i class="fa fa-star-half-o text-orange"></i>
        				                    			<?php
        				                			}
        				                			else {
        				                        		?>
        				                    			<i class="fa fa-star-o text-orange"></i>
        				                    			<?php
        				                			}
        				                		}
        				                	} else {
        				                    ?>
        				                    	<i class="fa fa-star-o text-orange"></i>
        				                    	<i class="fa fa-star-o text-orange"></i>
        				                    	<i class="fa fa-star-o text-orange"></i>
        				                    	<i class="fa fa-star-o text-orange"></i>
        				                    	<i class="fa fa-star-o text-orange"></i>
        				                	<?php
        				                	}
        				                    ?>
                                        </span>
                                    </div>
                                <?php
				                }
				            }
				            ?>
                        </div>
                    </div>
                </div>                    
                
                <div class="col-md-9">
                
                 	<!-- Filters
                    ===================================== -->
                    <div class="row mt25 mb25 animated" data-animation="fadeInDown" data-animation-delay="100">                   
                        <div class="col-md-12">
                            <form class="form-inline pull-left" url="{{ url('reviews/all') }}">
                                <label>Short By:</label>
            			        <input id="searchreview" name="searchreview" class="hidden" value="{{$searchreview}}">
            			        <input id="filtertype" name="filtertype" class="hidden" value="{{$filtertype}}">
            			        <input id="filterstars" name="filterstars" class="hidden" value="{{$filterstars}}">
            			        <input id="items_per_page" name="items_per_page" class="hidden" value="{{$items_per_page}}">
                                <select id="orderby" name="orderby" class="form-control" style="height: 40px;" onchange="this.form.submit()">
                                    <option value="" selected disabled hidden>Select order</option>
                                    <option value="o1" <?php if($orderby == 'o1') echo 'selected'?>>Best Reviews</option>
                                    <option value="o2" <?php if($orderby == 'o2') echo 'selected'?>>Most Commented</option>
                                    <option value="o3" <?php if($orderby == 'o3') echo 'selected'?>>Alphabetical Order</option>
                                    <option value="o4" <?php if($orderby == 'o4') echo 'selected'?>>Latest Reviews</option>
                                </select>
                            </form>       
                            <form class="form-inline pull-left ml25">
                                <label>Show:</label>
            			        <input id="searchreview" name="searchreview" class="hidden" value="{{$searchreview}}">
            			        <input id="filtertype" name="filtertype" class="hidden" value="{{$filtertype}}">
            			        <input id="filterstars" name="filterstars" class="hidden" value="{{$filterstars}}">
            			        <input id="orderby" name="orderby" class="hidden" value="{{$orderby}}">
                                <select id="items_per_page" name="items_per_page" class="form-control" style="height: 40px;" onchange="this.form.submit()">
                                    <option value="" selected disabled hidden>Items per page</option>
                                    <option value="p1" <?php if($items_per_page == 'p1') echo 'selected'?>>3</option>
                                    <option value="p2" <?php if($items_per_page == 'p2') echo 'selected'?>>5</option>
                                    <option value="p3" <?php if($items_per_page == 'p3') echo 'selected'?>>10</option>
                                </select>
                            </form>
                        </div>                            
                    </div>
                    
                    <!-- Tarjets
                	===================================== -->
                	@foreach($reviews as $review)
						<div class="row bt-solid-1 bb-dashed-1 pb25">
							
						    <!-- Item Image
						    ======================== -->
						    <div class="col-md-4 col-sm-4 col-xs-12">
						        <div class="shop-item-container-in">
						            <a href="{{ url('review/' . $review->id) }}" 
						            	class="img-responsive center-block shop-item-img-list-view"
						            	style="background-image: url('data:image/jpeg;base64,{{ $review->thumbnail }}');
						            		   background-size:cover;"></a>
						        </div>
						    </div>
						    
						    <!-- Item Summary
						    ======================== -->
						    <div class="col-md-5 col-sm-4 col-xs-12">
						        <h3>{{ $review->nombre }}</h3>
						        <p class="mt20 text-uppercase">
						            <i class="fa fa-calendar"></i> {{ \Str::substr($review->created_at, 0, 10); }}
						            <br/>
						            <i class="fa fa-pencil"></i> {{ $review->username }}
						            <br/>
				                    <i class="fa fa-tags"></i> <a href="{{ url('reviews/' . $review->tipo) }}">{{ $review->tipo }}S</a>
						        </p>
						        <div class="mt10 pt10 bt-dotted-1">
						        	<?php
				                	if($review->ncomments>0){
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
						            <i class="fa fa-comment-o mt10"></i> {{ $review->ncomments }} Comments
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
					@endforeach
                    
                    <!-- Pagination
                    ===================================== -->
                    {{ $reviews->onEachSide(2)->links() }}
                </div>
            </div> 
        </div>
    </div>
@endsection