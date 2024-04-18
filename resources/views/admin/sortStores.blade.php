@extends('admin.layouts.master')
@section("title") Sort Stores - Dashboard
@endsection
@section('content')
<style>
    .delivery-div {
    background-color: #fafafa;
    padding: 1rem;
    }
    .location-search-block {
    position: relative;
    top: -26rem;
    z-index: 999;
    }
    .status-mark {
        width: 8px;
        height: 8px;
        display: inline-block;
        border-radius: 50%;
        border: 2px solid;
    }
</style>
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">TOTAL</span>
                <span class="badge badge-primary badge-pill animated flipInX">{{ $count }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
<div class="card">
<div class="card-body">
    <div class="row" id="sortable">
    @foreach($restaurants as $restaurant)
        <div class="col-md-3 mb-4 each-store" data-id="{{ $restaurant->id }}">
            <div class="col-md-12" style="border: 1px solid #f2f2f2; padding: 0.5rem;">
                <div class="d-flex">
                <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}{{ $restaurant->image }}"
                    alt="{{ $restaurant->name }}" height="80" width="80"
                    style="border-radius: 0.275rem;" class="text-center">
                    @if($restaurant->is_featured)<span class="badge badge-secondary badge-warning" data-popup="tooltip" title="Featured" data-placement="left" style="position: absolute; right: 0; top: 0; opacity: 0.55; background-color: #ffc107;"> <i class="icon-star-full2"></i></span> @endif
                    <div class="ml-2">
                        <p class="mb-1 text-semibold" style="width: 110px;">{{ $restaurant->name }} </p>
                        <p class="mb-0">
                        @if($dapCheck)                        
                        @if(count($restaurant->delivery_areas) === 0)
                          <span class="badge badge-flat border-grey-800 mr-1 mb-2" style="font-size: 0.9rem;">  NA </span>
                        @else
                            @foreach($restaurant->delivery_areas as $deliveryArea)
                            <span class="badge badge-flat border-grey-800 mr-1 mb-2" style="font-size: 0.9rem;">{{ $deliveryArea->name }}</span>
                            @endforeach
                        @endif
                        @endif
                        </p>
                        <small class="display-block">  @if($restaurant->is_active) <span class="status-mark border-success"></span> Currently Open  @else <span class="status-mark border-danger"></span> Currently Closed @endif</small>
                        
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
<input type="hidden" id="token" value="{{ csrf_token() }}">
<script>
    $(function() {
    	$('#sortable').sortable({
    	    animation: 350,
    	    easing: "cubic-bezier(0.42, 0, 0.58, 1.0)",
    	    // ghostClass: "sortable-placeholder",
    	    onUpdate: function (evt) {
    	        let newSortOrder = {};
    	        $('.each-store').each(function() {
    	            newSortOrder[$(this).index()] = $(this).data('id');
    	        });
                $('.card-body').addClass('popup-order-processing');
    	        $.ajax({
    	          url: '{{ route('admin.updateStorePosition') }}',
    	          type: 'POST',
    	          dataType: 'JSON',
    	          data: {newOrder: newSortOrder, _token: $('#token').val()},
    	      })
    	      .done(function(res) {
    	           $.jGrowl("Stores sorted successfully", {
    	               position: 'bottom-center',
    	               header: 'Done ✅',
    	               theme: 'bg-success',
    	               life: '2000',
    	           }); 
                   $('.card-body').removeClass('popup-order-processing');
    	      })
    	      .fail(function() {
    	          console.log("error");
    	          $.jGrowl("Something went wrong! Reload the page and try again later.", {
    	              position: 'bottom-center',
    	              header: 'Wooopsss ⚠️',
    	              theme: 'bg-warning',
    	          });
                  $('.card-body').removeClass('popup-order-processing');
    	      })
    	    },
    	});
    });
</script>
@endsection