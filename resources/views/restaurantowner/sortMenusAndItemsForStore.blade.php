@extends('admin.layouts.master')
@section("title") Sort Menu and Items - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">{{ __('storeDashboard.sortingMenuAndItemForTitle') }}: <a href="{{ route('admin.get.editRestaurant', $restaurant->id) }}"><b>{{ $restaurant->name }}</b></a></span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"
                    data-toggle="modal" data-target="#sortMenuCategoriesModal">
                <b><i class="icon-menu8"></i></b>
                  {{ __('storeDashboard.sortMenuCategoriesButton') }}
                </button>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex justify-content-lg-left">
                <ul class="nav nav-pills flex-column mr-lg-3 wmin-lg-250 mb-lg-0">
                    @foreach($itemCategories as $itemCategory)
                    <li class="nav-item">
                        <a href="#{{ str_slug($itemCategory->name.'-'.$loop->iteration) }}" class="nav-link @if($loop->first) active @endif each-menu-item" data-toggle="tab">
                        {{ $itemCategory->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div id="sortMenuCategoriesModal" class="modal fade">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><span class="font-weight-bold">Sort Menu Categories</span></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <ul style="list-style: none" id="sortable-menu" class="pl-0">
                                    @foreach($itemCategories as $itemCategory)
                                    <li class="card each-menu-item p-2 cursor-move" data-id={{ $itemCategory->
                                        id }}>
                                        <p class="mb-1 text-semibold">
                                            <i class="icon-menu8 mr-2"></i> {{ $itemCategory->name }}
                                        </p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" style="width: 100%; padding: 0 25px;">
                    @foreach($items as $key => $itemWithCategory)
                    <div class="tab-pane fade show @if($loop->first) active @endif" id="{{ str_slug($key.'-'.$loop->iteration) }}">
                        <legend class="font-weight-semibold font-size-sm">
                            {{ __('storeDashboard.sortItemsInTitle') }}: <b>{{ $key }} menu</b>
                        </legend>
                        <div class="row sortable" id="each-section-{{ $key }}-{{ $loop->iteration }}">
                            @foreach($itemWithCategory as $item)
                            <div class="col-md-4 mb-4 each-item cursor-move" data-id="{{ $item->id }}">
                                <div class="col-md-12" style="border: 1px solid #f2f2f2; padding: 0.5rem;">
                                    <div class="d-flex">
                                        @if($item->image)
                                        <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}{{ $item->image }}"
                                        alt="{{ $item->name }}" height="80" width="80"
                                        style="border-radius: 0.275rem;" class="text-center">
                                        @else
                                        <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/img/various/placeholder{{ rand(1,3) }}.jpeg"
                                        alt="{{ $item->name }}" height="80" width="80"
                                        style="border-radius: 0.275rem;" class="text-center">
                                        @endif
                                        <div class="ml-2">
                                            <p class="mb-1 text-semibold" style="width: 110px;">{{ $item->name }}</p>
                                            <p class="mb-0">{{ config('appSettings.currencyFormat') }}{{ $item->price }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="token" value="{{ csrf_token() }}">
<script>
    $(function() {
        $('.sortable').sortable({
            animation: 350,
            easing: "cubic-bezier(0.42, 0, 0.58, 1.0)",
            // ghostClass: "sortable-placeholder",
            onUpdate: function (evt) {
                console.log(evt.from.id);
                let section = evt.from.id;
                let newSortOrder = {};
                $('.each-item').each(function(index) {
                    if ($(this).parent().attr("id") == section) {
                        newSortOrder[$(this).index()] = $(this).data('id');
                    }
                });
                console.log({newSortOrder});
                $('.card-body').addClass('popup-order-processing');
                $.ajax({
                  url: '{{ route('restaurant.updateItemPositionForStore') }}',
                  type: 'POST',
                  dataType: 'JSON',
                  data: {newOrder: newSortOrder, _token: $('#token').val()},
              })
              .done(function(res) {
                   $.jGrowl("Items sorted successfully", {
                       position: 'bottom-center',
                       header: 'Done ✅',
                       theme: 'bg-success',
                       life: '2000',
                   }); 
                   $('.card-body').removeClass('popup-order-processing');
              })
              .fail(function() {
                  console.log("error");
                  $.jGrowl("Something went wrong! On your server configuration, make sure your 'max_input_vars' paramenter is set greater than the total item count.", {
                      position: 'bottom-center',
                      header: 'Wooopsss ⚠️',
                      theme: 'bg-warning', 
                      life: '10000',
                  });
                  $('.card-body').removeClass('popup-order-processing');
              })
            },
        });
    
        $('#sortable-menu').sortable({
            animation: 350,
            easing: "cubic-bezier(0.42, 0, 0.58, 1.0)",
            // ghostClass: "sortable-placeholder",
            onUpdate: function (evt) {
                let newSortOrder = {};
                $('.each-menu-item').each(function() {
                    newSortOrder[$(this).index()] = $(this).data('id');
                });
                $('.each-menu-item').addClass('popup-order-processing');
                $.ajax({
                  url: '{{ route('restaurant.updateMenuCategoriesPositionForStore') }}',
                  type: 'POST',
                  dataType: 'JSON',
                  data: {newOrder: newSortOrder, _token: $('#token').val()},
              })
              .done(function(res) {
                   $.jGrowl("Menu sorted successfully", {
                       position: 'bottom-center',
                       header: 'Done ✅',
                       theme: 'bg-success',
                       life: '2000',
                   }); 
                   $('.each-menu-item').removeClass('popup-order-processing');
              })
              .fail(function() {
                  console.log("error");
                  $.jGrowl("Something went wrong! Please try again after reloading the page.", {
                      position: 'bottom-center',
                      header: 'Wooopsss ⚠️',
                      theme: 'bg-warning', 
                      life: '10000',
                  });
                  $('.card-body').removeClass('popup-order-processing');
              })
            },
        });
    
        $('#sortMenuCategoriesModal').on('hidden.bs.modal', function () {
            window.location.reload();
        })
    });
</script>
@endsection