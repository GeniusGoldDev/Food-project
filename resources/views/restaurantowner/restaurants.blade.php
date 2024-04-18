@extends('admin.layouts.master')
@section("title") {{__('storeDashboard.spPageTitle')}}
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
</style>
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{__('storeDashboard.total')}}</span>
                <span class="badge badge-primary badge-pill animated flipInX">{{ count($restaurants) }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2" id="addNewRestaurant"
                    data-toggle="modal" data-target="#addNewRestaurantModal">
                <b><i class="icon-plus2"></i></b>
                {{__('storeDashboard.spAddNewStoreBtn')}}
                </button>
            </div>
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
                            <th style="width: 5%;">{{__('storeDashboard.spTableID')}}</th>
                            <th style="width: 10%;">{{__('storeDashboard.spTableImage')}}</th>
                            <th style="width: 15%;">{{__('storeDashboard.spTableName')}}</th>
                            <th>{{__('storeDashboard.spTableAddress')}}</th>
                            <th>{{__('storeDashboard.spTableStatus')}}</th>
                            <th style="width: 15%">{{__('storeDashboard.spTableCA')}}</th>
                            <th class="text-center" style="width: 10%;"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restaurants as $restaurant)
                        <tr>
                            <td>{{ $restaurant->id }}</td>
                            <td><img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}{{ $restaurant->image }}" alt="{{ $restaurant->name }}" height="80" width="80" style="border-radius: 0.275rem;"></td>
                            <td>{{ $restaurant->name }}</td>
                            <td>{{ $restaurant->address }}</td>
                            <td>
                                @if(!$restaurant->is_accepted)
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                {{__('storeDashboard.spRowPending')}}
                                </span>
                                @endif
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                @if($restaurant->is_active) {{__('storeDashboard.spRowActive')}} @else {{__('storeDashboard.spRowInActive')}} @endif
                                </span>
                            </td>
                            <td>{{ $restaurant->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <a href="{{ route('restaurant.get.editRestaurant', $restaurant->id) }}"
                                        class="btn btn-sm btn-primary"> {{__('storeDashboard.edit')}}</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="addNewRestaurantModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">{{__('storeDashboard.spAddNewStoreBtn')}}</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('restaurant.saveNewRestaurant') }}" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblStoreName')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="{{__('storeDashboard.sePhStoreName')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblDescription')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="description"
                                placeholder="{{__('storeDashboard.sePhDescription')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblImage')}}:</label>
                        <div class="col-lg-9">
                            <img class="slider-preview-image hidden"/>
                            <div class="uploader">
                                <input type="file" class="form-control-lg form-control-uniform" name="image" required accept="image/x-png,image/gif,image/jpeg" onchange="readURL(this);">
                                <span class="help-text text-muted">{{__('storeDashboard.sePhImage')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblApproxDeliveryTime')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg delivery_time" name="delivery_time"
                                placeholder="{{__('storeDashboard.sePhApproxDeliveryTime')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblApproxPriceForTwo')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg price_range" name="price_range"
                                placeholder="{{__('storeDashboard.sePhApproxPriceForTwo')}} {{ config('appSettings.currencyFormat') }}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblFullAddress')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="address"
                                placeholder="{{__('storeDashboard.sePhFullAddress')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label" data-popup="tooltip" title="{{__('storeDashboard.seToolTipPincode')}}" data-placement="bottom">{{__('storeDashboard.seLblPincode')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="pincode"
                                placeholder="{{__('storeDashboard.seToolTipPincode')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblLandMark')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="landmark"
                                placeholder="{{__('storeDashboard.sePhLandMark')}}">
                        </div>
                    </div>
                    <fieldset class="gllpLatlonPicker">
                        {{-- <div width="100%" id="map" class="gllpMap" style="position: relative; overflow: hidden;"></div> --}}
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label">{{__('storeDashboard.seLblLat')}}:</label><input type="text" class="form-control form-control-lg gllpLatitude latitude" value="40.6976701" name="latitude" placeholder="{{ __('storeDashboard.storeLatitudeFieldPlaceholder') }}" required="required">
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label">{{__('storeDashboard.seLblLong')}}:</label><input type="text" class="form-control form-control-lg gllpLongitude longitude" value="-74.2598672" name="longitude" placeholder="{{ __('storeDashboard.storeLongitudeFieldPlaceholder') }}" required="required">
                            </div>
                        </div>
                       {{--  <input type="hidden" class="gllpZoom" value="20">
                        <div class="d-flex justify-content-center">
                            <div class="col-lg-6 d-flex location-search-block">       
                                <input type="text" class="form-control form-control-lg gllpSearchField" placeholder="Search for resraurant, city or town...">
                                <button type="button" class="btn btn-primary gllpSearchButton">{{__('storeDashboard.seLblSearch')}}</button>
                            </div>
                        </div> --}}
                        <span class="text-muted">{{__('storeDashboard.sePhTextLatLong1')}} <a href="https://www.mapcoordinates.net/en" target="_blank">https://www.mapcoordinates.net/en</a></span> <br> {{__('storeDashboard.sePhTextLatLong2')}}
                    </fieldset>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblCertificate')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="certificate"
                                placeholder="{{__('storeDashboard.sePhCertificate')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblStoreCharge')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg restaurant_charges" name="restaurant_charges"
                                placeholder="{{__('storeDashboard.sePhStoreCharge')}} {{ config('appSettings.currencyFormat') }}">
                        </div>
                    </div>

                    @if(config("appSettings.enSPU") == "true")
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.storeDeliveryTypeLabel')}}:</label>
                        <div class="col-lg-9">
                            <select class="form-control select-search" name="delivery_type" required>
                                <option value="1" class="text-capitalize">{{__('storeDashboard.storeDeliveryTypeDeliveryOption')}}</option>
                                <option value="2" class="text-capitalize">{{__('storeDashboard.storeDeliveryTypeSelfPickupOption')}}</option>
                                <option value="3" class="text-capitalize">{{__('storeDashboard.storeDeliveryTypeBothOption')}}</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblPureVeg')}}</label>
                        <div class="col-lg-9">
                            <div class="checkbox checkbox-switchery mt-2">
                                <label>
                                <input value="true" type="checkbox" class="switchery-primary" checked="checked" name="is_pureveg">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblMinOrderPrice')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg min_order_price" name="min_order_price"
                                placeholder="{{__('storeDashboard.sePhMinOrderPrice')}} {{ config('appSettings.currencyFormat') }}" value="0">
                        </div>
                    </div>
                    
                    @csrf
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                        {{__('storeDashboard.save')}}
                        <i class="icon-database-insert ml-1"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function readURL(input) {
       if (input.files && input.files[0]) {
           let reader = new FileReader();
           reader.onload = function (e) {
               $('.slider-preview-image')
                   .removeClass('hidden')
                   .attr('src', e.target.result)
                   .width(160)
                   .height(117)
                   .css('borderRadius', '0.275rem');
           };
           reader.readAsDataURL(input.files[0]);
       }
    }
    $(function () {
       $('.select-search').select2({
           minimumResultsForSearch: Infinity,
           placeholder: 'Select Location',
       });
    
       var primary = document.querySelector('.switchery-primary');
       var switchery = new Switchery(primary, { color: '#2196F3' });
       
       $('.form-control-uniform').uniform({
            fileDefaultHtml: '{{ __('storeDashboard.fileSectionNoFileSelected') }}',
            fileButtonHtml: '{{ __('storeDashboard.fileSectionChooseFileButton') }}'
        });

       $('.delivery_time').numeric({allowThouSep:false});
       $('.price_range').numeric({allowThouSep:false});
       $('.latitude').numeric({allowThouSep:false});
       $('.longitude').numeric({allowThouSep:false});
       $('.restaurant_charges').numeric({ allowThouSep:false, maxDecimalPlaces: 2 });
       $('.delivery_charges').numeric({ allowThouSep:false, maxDecimalPlaces: 2 });
        $('.min_order_price').numeric({ allowThouSep:false, maxDecimalPlaces: 2, allowMinus: false });
    });
    
</script>
@endsection