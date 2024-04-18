@extends('admin.layouts.master')
@section("title") Delivery Reviews - Dashboard
@endsection
@section('content')
<style>
	.text-truncate {
 		width:250px;white-space:nowrap; overflow:hidden; text-overflow: ellipsis; 
	}
</style>	
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">Reviews of <a class="ml-1" href="{{ route('admin.get.editUser', $user->id) }}">{{ $user->name }}</a></span> <span class="ml-1 badge badge-flat text-white {{ ratingColorClass($averageRating) }}">{{ $averageRating }} <i class="icon-star-full2 text-white" style="font-size: 0.6rem;"></i></span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
        			<thead>
        			    <tr>
        			    	<th>Order</th>
        			        <th>Customer</th>
        			        <th>Review</th>
        			        <th class="text-center" style="width: 10%;"><i class="
        			            icon-circle-down2"></i></th>
        			    </tr>
        			</thead>
        			<tbody>
        				@foreach($reviews as $review)
        				<tr>
        					<td><a href="{{ route('admin.viewOrder', $review->order->unique_order_id) }}">{{ $review->order->unique_order_id }}</a></td>
        					<td><a href="{{ route('admin.get.editUser', $review->user->id) }}">{{ $review->user->name }}</a></td>
        					<td>
        						<div class="d-flex">
        							<div class="mr-1">
        								<span class="ml-1 badge badge-flat text-white {{ ratingColorClass($review->rating_delivery) }}" data-popup="tooltip" title="Delivery Review" data-placement="top">{{ $review->rating_delivery }} <i class="icon-star-full2 text-white" style="font-size: 0.6rem;"></i></span>
        							</div>
        							<div>
        								<p class="text-truncate">{{ $review->review_delivery }}</p>
        							</div>
        						</div>

        						<div class="d-flex">
        							<div class="mr-1">
        								<span class="ml-1 badge badge-flat text-white {{ ratingColorClass($review->rating_store) }}" data-popup="tooltip" title="Store Review" data-placement="top">{{ $review->rating_store }} <i class="icon-star-full2 text-white" style="font-size: 0.6rem;"></i></span>
        							</div>
        							<div>
        								<p class="text-truncate">{{ $review->review_store }}</p>
        							</div>
        						</div>
        						
        					</td>
        					<td class="text-center">

        						<button class="btn btn-sm btn-primary reviewViewButton" data-toggle="modal" data-target="#viewReviewModal" data-reviewId="{{ $review->id }}" data-ratingDelivery="{{ $review->rating_delivery }}" data-ratingStore="{{ $review->rating_store }}" data-reviewDelivery="{{ $review->review_delivery }}" data-reviewStore="{{ $review->review_store }}"> View </button>
        						    
        					</td>
        				</tr>
        				@endforeach
        			</tbody>
        		</table>
        	</div>
        </div>
    </div>
</div>
<div id="viewReviewModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">Detailed Review</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            	<form action="{{ route('admin.updateStoreReview') }}" method="POST">
                    <input type="hidden" name="review_id" id="reviewId">
            		<div class="form-group row">
            		    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Delivery Rating:</label>
            		    <div class="col-lg-9">
            		        <select class="form-control select-search" name="rating_delivery" required id="deliveryRating">
            		            <option value="1">1 Star</option>
            		            <option value="2">2 Two</option>
            		            <option value="3">3 Star</option>
            		            <option value="4">4 Star</option>
            		            <option value="5">5 Stars</option>
            		        </select>
            		    </div>
            		</div>

            		<div class="form-group row">
                        <label class="col-lg-3 col-form-label">Delivery Review:</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="review_delivery" placeholder="Delivery Review"
                                rows="6" id="deliveryReviewText"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
            		    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Store Rating:</label>
            		    <div class="col-lg-9">
            		        <select class="form-control select-search" name="rating_store" required id="storeRating">
            		            <option value="1">1 Star</option>
            		            <option value="2">2 Two</option>
            		            <option value="3">3 Star</option>
            		            <option value="4">4 Star</option>
            		            <option value="5">5 Stars</option>
            		        </select>
            		    </div>
            		</div>

            		<div class="form-group row">
                        <label class="col-lg-3 col-form-label">Store Review:</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="review_store" placeholder="Store Review"
                                rows="6" id="storeReviewText"></textarea>
                        </div>
                    </div>

                     @csrf
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Update
                            <i class="icon-database-insert ml-1"></i></button>
                    </div>

            	</form>
            </div>
        </div>
    </div>
</div>

<script>
	$(function() {
		$('.reviewViewButton').click(function(event) {
            $('#reviewId').val($(this).attr("data-reviewId"))
			$('#deliveryRating').val($(this).attr("data-ratingDelivery"));
			$('#storeRating').val($(this).attr("data-ratingStore"));
			$('#deliveryReviewText').val($(this).attr("data-reviewDelivery"))
			$('#storeReviewText').val($(this).attr("data-reviewStore"))
		});
	});
</script>

@endsection