@extends('admin.layouts.master')
@section("title") {{__('storeDashboard.ratingsPageTitle')}}
@endsection
@section('content')
<div class="content">
@if(!empty($restaurants))
<div class="row">
    <div class="form-group row mt-5">
        <label class="col-lg-12 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.epSelectStore')}}:</label>
        <div class="col-lg-12">
            <select class="form-control select-search select" name="restaurant_id" required id="dynamic_select" style="height: 2.5rem;">
                <option value="">{{__('storeDashboard.epSelect')}} </option>
                @foreach ($restaurants as $restaurant)
                <option value="{{ route('restaurant.ratings') }}/{{ $restaurant->id }}" class="text-capitalize">{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.select').select2(); 
      // bind change event to select
      $('#dynamic_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>
@endif
@if(!Request::is('store-owner/ratings'))
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">{{ __('storeDashboard.ratingsPageReviewsOfTitle') }} <a class="ml-1" href="{{ route('restaurant.get.editRestaurant', $restaurant->id) }}">{{ $restaurant->name }}</a></span> <span class="ml-1 badge badge-flat text-white {{ ratingColorClass($averageRating) }}">{{ $averageRating }} <i class="icon-star-full2 text-white" style="font-size: 0.6rem;"></i></span>
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
                            <th>{{ __('storeDashboard.ratingsPageOrder') }}</th>
                            <th>{{ __('storeDashboard.ratingsPageCustomer') }}</th>
                            <th>{{ __('storeDashboard.ratingsPageReview') }}</th>
                            <th class="text-center" style="width: 10%;"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td><a href="{{ route('restaurant.viewOrder', $review->order->unique_order_id) }}">{{ $review->order->unique_order_id }}</a></td>
                            <td>{{ $review->user->name }}</td>
                            <td>
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
                                <button class="btn btn-sm btn-primary reviewViewButton" data-toggle="modal" data-target="#viewReviewModal" data-reviewId="{{ $review->id }}" data-ratingDelivery="{{ $review->rating_delivery }}" data-ratingStore="{{ $review->rating_store }}" data-reviewDelivery="{{ $review->review_delivery }}" data-reviewStore="{{ $review->review_store }}"> {{ __('storeDashboard.ratingsPageViewBtn') }} </button>
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
                <h5 class="modal-title"><span class="font-weight-bold">{{ __('storeDashboard.ratingsPageDetailedViewTitle') }} </span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">{{ __('storeDashboard.ratingsPageStoreRating') }}:</label>
                    <div class="col-lg-9">
                        <select class="form-control select-search" name="rating_store" id="storeRating" disabled>
                            <option value="1">1 Star</option>
                            <option value="2">2 Two</option>
                            <option value="3">3 Star</option>
                            <option value="4">4 Star</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">{{ __('storeDashboard.ratingsPageStoreReview') }}:</label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="review_store" placeholder="Store Review"
                            rows="6" id="storeReviewText" readonly></textarea>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
      $('.reviewViewButton').click(function(event) {
        $('#storeRating').val($(this).attr("data-ratingStore"));
        $('#storeReviewText').val($(this).attr("data-reviewStore"))
      });
    });
</script>
@endif
@endsection