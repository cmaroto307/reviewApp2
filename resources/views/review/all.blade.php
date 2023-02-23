@extends('layouts.app')

@section('modalContent')
    <div id="shop" class="bg-light pt25">
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
                                <input id="searchreview" name="searchreview" type="text" class="form-control" placeholder="Search">
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
                        	@foreach($types as $index => $type)
                        		@if($index == 'film')
                        			<li>
                        			    <form url="{{ url('reviews/all') }}">
                        			        <input id="filtertype" name="filtertype" class="hidden" value="t1">
                        			        <button type="submit" class="link-delete">{{ $type }}</button><span class="badge badge-pasific pull-right">{{ $count_type_film }}</span>
                        			     </form>
                        			</li>
                        		@elseif($index == 'book')
                        			<li>
                        			    <form url="{{ url('reviews/all') }}">
                        			        <input id="filtertype" name="filtertype" class="hidden" value="t2">
                        			        <button type="submit" class="link-delete">{{ $type }}</button><span class="badge badge-pasific pull-right">{{ $count_type_book }}</span>
                        			     </form>
                        			</li>
                        		@elseif($index == 'record')
                        			<li>
                        			    <form url="{{ url('reviews/all') }}">
                        			        <input id="filtertype" name="filtertype" class="hidden" value="t3">
                        			        <button type="submit" class="link-delete">{{ $type }}</button><span class="badge badge-pasific pull-right">{{ $count_type_record }}</span>
                        			     </form>
                        			</li>
                        		@endif
                            @endforeach
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
                            <select id="filterstars" name="filterstars" class="form-control" style="height: 40px;" onchange="this.form.submit()">
                                <option value="" selected disabled hidden>Select stars</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
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
    						            <a href="{{ url('review/' . $review['id']) }}" 
    						            	class="img-responsive center-block shop-item-img-list-view pull-left"
    						            	style="background-image: url('data:image/jpeg;base64,{{ $review['thumbnail'] }}');
    						            		   width: 50px; height:72px; background-size:cover; background-position:center; margin-right: 10px;"></a>
                                        <h6>{{ $review['nombre'] }}</h6>
                                        <span class="sidebar-cart-price text-gray">{{ $review['tipo'] }}</span>
                                        </br>
                                        <span class="sidebar-cart-remove">
                                            <?php
        				                	if($review['count_comments']>0){
        				                		$stars = $review['stars'];
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
                                <select id="orderby" name="orderby" class="form-control" style="height: 40px;" onchange="this.form.submit()">
                                    <option value="" selected disabled hidden>Select order</option>
                                    <option value="o1">Best Reviews</option>
                                    <option value="o2">Most Commented</option>
                                    <option value="o3">Latest Reviews</option>
                                    <option value="o4">Alphabetical Order</option>
                                </select>
                            </form>       
                            <form class="form-inline pull-left ml25">
                                <label>Show:</label>
                                <select id="items_per_page" name="items_per_page" class="form-control" style="height: 40px;" onchange="this.form.submit()">
                                    <option value="" selected disabled hidden>Items per page</option>
                                    <option value="p1">10</option>
                                    <option value="p2">20</option>
                                    <option value="p3">30</option>
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
						            <a href="{{ url('review/' . $review['id']) }}" 
						            	class="img-responsive center-block shop-item-img-list-view"
						            	style="background-image: url('data:image/jpeg;base64,{{ $review['thumbnail'] }}');
						            		   background-size:cover;"></a>
						        </div>
						    </div>
						    
						    <!-- Item Summary
						    ======================== -->
						    <div class="col-md-5 col-sm-4 col-xs-12">
						        <h3>{{ $review['nombre'] }}</h3>
						        <p class="mt20 text-uppercase">
						            <i class="fa fa-calendar"></i> {{ \Str::substr($review['created_at'], 0, 10); }}
						            <br/>
						            <i class="fa fa-pencil"></i> {{ $review['username'] }}
						            <br/>
				                    <i class="fa fa-tags"></i> <a href="{{ url('reviews/' . $review['tipo']) }}">{{ $review['tipo'] }}S</a>
						        </p>
						        <div class="mt10 pt10 bt-dotted-1">
						        	<?php
				                	if($review['count_comments']>0){
				                		$stars = $review['stars'];
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
						            <i class="fa fa-comment-o mt10"></i> {{ $review['count_comments'] }} Comments
						        </div>
						    </div>
						    
						    <!-- Link Analysis
						    ======================== -->
						    <div class="col-md-3 col-sm-4 col-xs-12 text-center">
						        <a href="{{ url('review/' . $review['id']) }}" class="button button-md button-pasific hover-icon-wobble-horizontal mt25">
						        	View Analysis<i class="bi bi-bookmark-plus-fill"></i>
						        </a>
						    </div>
						</div>
					@endforeach
                    
                    <!-- Pagination
                    ===================================== -->
                    <div class="row mb25 animated" data-animation="fadeInUp" data-animation-delay="700">
                        <div class="col-md-12 text-center">
                            <ul class="pagination pagination-pasific">
                                <li><a href="#"><i class="fa fa-angle-double-left"></i> First</a></li>
                                <li><a href="#"><i class="fa fa-angle-left"></i> Prev</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">Next <i class="fa fa-angle-right"></i></a></li>
                                <li><a href="#">Last <i class="fa fa-angle-double-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection