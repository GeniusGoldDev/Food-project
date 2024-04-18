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
                <span class="font-weight-bold mr-2">{{__('storeDashboard.sePageTitleEditing')}}</span>
                <span class="badge badge-primary badge-pill animated flipInX">"{{ $restaurant->name }}"</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <a href="{{ route('restaurant.sortMenusAndItems', $restaurant->id) }}" class="btn btn-secondary btn-labeled btn-labeled-left mr-2">
                <b><i class="icon-sort"></i></b>
                {{  __('storeDashboard.sortMenuAndItemButton') }}
                </a>
            </div>
        </div>

    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('restaurant.updateRestaurant') }}" method="POST" enctype="multipart/form-data">
                        <legend class="font-weight-semibold text-uppercase font-size-sm">
                            <i class="icon-store2 mr-2"></i> {{__('storeDashboard.sePageTitleStoreDetails')}}
                        </legend>
                        <input type="hidden" name="id" value="{{ $restaurant->id }}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblStoreName')}}:</label>
                            <div class="col-lg-9">
                                <input value="{{ $restaurant->name }}" type="text" class="form-control form-control-lg" name="name"
                                    placeholder="{{__('storeDashboard.sePhStoreName')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblDescription')}}:</label>
                            <div class="col-lg-9">
                                <input value="{{ $restaurant->description }}" type="text" class="form-control form-control-lg" name="description"
                                    placeholder="{{__('storeDashboard.sePhDescription')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblImage')}}:</label>
                            <div class="col-lg-9">
                                <img src="{{ substr(url("/"), 0, strrpos(url("/"), '/')) }}{{ $restaurant->image }}" alt="Image" width="160" style="border-radius: 0.275rem;">
                                <img class="slider-preview-image hidden" style="border-radius: 0.275rem;"/>
                                <div class="uploader">
                                    <input type="hidden" name="old_image" value="{{ $restaurant->image }}">
                                    <input type="file" class="form-control-uniform" name="image" accept="image/x-png,image/gif,image/jpeg" onchange="readURL(this);">
                                    <span class="help-text text-muted">{{__('storeDashboard.sePhImage')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblApproxDeliveryTime')}}:</label>
                            <div class="col-lg-9">
                                <input value="{{ $restaurant->delivery_time }}" type="text" class="form-control form-control-lg delivery_time" name="delivery_time"
                                    placeholder="{{__('storeDashboard.sePhApproxDeliveryTime')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblApproxPriceForTwo')}}:</label>
                            <div class="col-lg-9">
                                <input value="{{ $restaurant->price_range }}" type="text" class="form-control form-control-lg price_range" name="price_range"
                                    placeholder="{{__('storeDashboard.sePhApproxPriceForTwo')}} {{ config('appSettings.currencyFormat') }}" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.seLblFullAddress')}}:</label>
                            <div class="col-lg-9">
                                <input value="{{ $restaurant->address }}" type="text" class="form-control form-control-lg" name="address"
                                    placeholder="{{__('storeDashboard.sePhFullAddress')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" data-popup="tooltip" title="{{__('storeDashboard.seToolTipPincode')}}" data-placement="bottom">{{__('storeDashboard.seLblPincode')}}:</label>
                            <div class="col-lg-9">
                                <input value="{{ $restaurant->pincode }}" type="text" class="form-control form-control-lg" name="pincode"
                                    placeholder="{{__('storeDashboard.seToolTipPincode')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblLandMark')}}:</label>
                            <div class="col-lg-9">
                                <input value="{{ $restaurant->landmark }}" type="text" class="form-control form-control-lg" name="landmark"
                                    placeholder="{{__('storeDashboard.sePhLandMark')}}">
                            </div>
                        </div>
                        <fieldset class="gllpLatlonPicker">
                            {{-- <div width="100%" id="map" class="gllpMap" style="position: relative; overflow: hidden;"></div> --}}
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label">{{__('storeDashboard.seLblLat')}}:</label><input type="text" class="form-control form-control-lg gllpLatitude latitude" value="{{ $restaurant->latitude }}" name="latitude" placeholder="{{ __('storeDashboard.storeLatitudeFieldPlaceholder') }}" required="required">
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label">{{__('storeDashboard.seLblLong')}}:</label><input type="text" class="form-control form-control-lg gllpLongitude longitude" value="{{ $restaurant->longitude }}" name="longitude" placeholder="{{ __('storeDashboard.storeLongitudeFieldPlaceholder') }}" required="required">
                                </div>
                            </div>
                            {{-- <input type="hidden" class="gllpZoom" value="20">
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
                                <input value="{{ $restaurant->certificate }}" type="text" class="form-control form-control-lg" name="certificate"
                                    placeholder="{{__('storeDashboard.sePhCertificate')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblStoreCharge')}}:</label>
                            <div class="col-lg-9">
                                <input value="{{ $restaurant->restaurant_charges }}" type="text" class="form-control form-control-lg restaurant_charges" name="restaurant_charges"
                                    placeholder="{{__('storeDashboard.sePhStoreCharge')}} {{ config('appSettings.currencyFormat') }}">
                            </div>
                        </div>

                        @if(config("appSettings.enSPU") == "true")
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.storeDeliveryTypeLabel')}}:</label>
                            <div class="col-lg-9">
                                <select class="form-control select" name="delivery_type" required>
                                <option value="1" class="text-capitalize" @if($restaurant->delivery_type == "1") selected="selected" @endif>{{__('storeDashboard.storeDeliveryTypeDeliveryOption')}}</option>
                                <option value="2" class="text-capitalize" @if($restaurant->delivery_type == "2") selected="selected" @endif>{{__('storeDashboard.storeDeliveryTypeSelfPickupOption')}}</option>
                                <option value="3" class="text-capitalize" @if($restaurant->delivery_type == "3") selected="selected" @endif>{{__('storeDashboard.storeDeliveryTypeBothOption')}}</option>
                                </select>
                            </div>
                        </div>
                        @endif

                        @if(config('appSettings.allowPaymentGatewaySelection') == "true")
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">{{__('storeDashboard.seLblSelectPaymentGateways')}}

                            @if(count($restaurant->payment_gateways) == 0)
                            <p class="text-danger">
                                <strong>{{__('storeDashboard.seNoStorePaymentGatewayMessage')}}</strong>
                            </p>
                            @endif
                            </label>

                            <div class="col-lg-8">
                                <select multiple="multiple" class="form-control select" name="store_payment_gateways[]">
                                @foreach($adminPaymentGateways as $adminPaymentGateway)
                                    <option value="{{ $adminPaymentGateway->id }}" class="text-capitalize" {{ in_array($adminPaymentGateway->id, $restaurant->payment_gateways()->pluck('payment_gateway_id')->toArray()) ? 'selected' : '' }}>{{ $adminPaymentGateway->name }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblPureVeg')}}</label>
                            <div class="col-lg-9">
                                <div class="checkbox checkbox-switchery mt-2">
                                    <label>
                                    <input value="true" type="checkbox" class="switchery-primary" @if($restaurant->is_pureveg) checked="checked" @endif name="is_pureveg">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{__('storeDashboard.seLblMinOrderPrice')}}:</label>
                            <div class="col-lg-9">
                                <input value="{{ $restaurant->min_order_price }}" type="text" class="form-control form-control-lg min_order_price" name="min_order_price"
                                    placeholder="{{__('storeDashboard.sePhMinOrderPrice')}} {{ config('appSettings.currencyFormat') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">{{ __('storeDashboard.seLblAutomaticScheduling') }}</label>
                            <div class="col-lg-9">
                                <div class="checkbox checkbox-switchery mt-2">
                                    <label>
                                    <input value="true" type="checkbox" class="switchery-primary"
                                    @if($restaurant->is_schedulable) checked="checked" @endif name="is_schedulable">
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        @csrf
                        <div class="text-left">
                            <div class="btn-group btn-group-justified" style="width: 150px">
                                @if($restaurant->is_active)
                               <a href="{{ route('restaurant.disableRestaurant', $restaurant->id) }}"
                                    class="btn btn-danger btn-labeled btn-labeled-left mr-2" data-popup="tooltip"
                                    title="{{ __('storeDashboard.closeStoreToolTipMessage') }}" data-placement="bottom">
                                <b><i class="icon-switch2"></i></b>
                                {{__('storeDashboard.seDisable')}}
                                </a>
                                @else
                                <a href="{{ route('restaurant.disableRestaurant', $restaurant->id) }}"
                                    class="btn btn-secondary btn-labeled btn-labeled-left mr-2" data-popup="tooltip"
                                    title="{{ __('storeDashboard.openStoreToolTipMessage') }}" data-placement="bottom">
                                <b><i class="icon-switch2"></i></b>
                                {{__('storeDashboard.seEnable')}}
                                </a>
                                @endif 
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                            {{__('storeDashboard.update')}}
                            <i class="icon-database-insert ml-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('restaurant.updateStorePayoutDetails') }}" method="POST">
                    <legend class="font-weight-semibold text-uppercase font-size-sm">
                        <i class="icon-coin-dollar mr-2"></i> {{ __('storeDashboard.payoutAccountDetailsTitle') }}
                    </legend>
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>{{ __('storeDashboard.bankNameLabel') }}: </strong></label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control form-control-lg" name="bankName" value="@if(!empty($payoutData->bankName)){{ $payoutData->bankName }}@endif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>{{ __('storeDashboard.bankCodeLabel') }}: </strong></label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control form-control-lg" name="bankCode" value="@if(!empty($payoutData->bankCode)){{ $payoutData->bankCode }}@endif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>{{ __('storeDashboard.recipientNameLabel') }}: </strong></label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control form-control-lg" name="recipientName" value="@if(!empty($payoutData->recipientName)){{ $payoutData->recipientName }}@endif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>{{ __('storeDashboard.accountNumberLabel') }}: </strong></label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control form-control-lg" name="accountNumber" value="@if(!empty($payoutData->accountNumber)){{ $payoutData->accountNumber }}@endif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>{{ __('storeDashboard.paypalIdLabel') }}: </strong></label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control form-control-lg" name="paypalId" value="@if(!empty($payoutData->paypalId)){{ $payoutData->paypalId }}@endif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>{{ __('storeDashboard.upiIDLabel') }}: </strong></label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control form-control-lg" name="upiID" value="@if(!empty($payoutData->upiID)){{ $payoutData->upiID }}@endif">
                        </div>
                    </div>
                    @csrf
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                        {{__('storeDashboard.update')}}
                        <i class="icon-database-insert ml-1"></i>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @if($restaurant->is_schedulable)
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('restaurant.updateRestaurantScheduleData') }}" method="POST"
                        enctype="multipart/form-data">
                        <legend class="font-weight-semibold text-uppercase font-size-sm">
                            <i class="icon-alarm mr-2"></i> {{ __('storeDashboard.seStoreSchedulingTimes') }}
                        </legend>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>{{ __('storeDashboard.seMonday') }}</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->monday) && count($schedule_data->monday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->monday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">{{ __('storeDashboard.seOpeningTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="monday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>{{ __('storeDashboard.seClosingTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->close}}"
                                    name="monday[]" required>
                            </div>
                            <div class="col-lg-2" day="monday">
                                <label class="col-form-label text-center" style="width: 43px;"></span><i class="icon-circle-down2"></i></label><br>
                                <button class="remove btn btn-danger" data-popup="tooltip" data-placement="right" title="Remove Time Slot">
                                <i class="icon-cross2"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div id="monday" class="timeSlots">
                        </div>
                        <a href="javascript:void(0)" onclick="add(this)" data-day="monday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>{{ __('storeDashboard.seAddSlot') }}</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>{{ __('storeDashboard.seTuesday') }}</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->tuesday) && count($schedule_data->tuesday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->tuesday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">{{ __('storeDashboard.seOpeningTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="tuesday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>{{ __('storeDashboard.seClosingTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->close}}"
                                    name="tuesday[]" required>
                            </div>
                            <div class="col-lg-2" day="tuesday">
                                <label class="col-form-label text-center" style="width: 43px;"></span><i class="icon-circle-down2"></i></label><br>
                                <button class="remove btn btn-danger" data-popup="tooltip" data-placement="right" title="Remove Time Slot">
                                <i class="icon-cross2"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div id="tuesday" class="timeSlots">
                        </div>
                        <a href="javascript:void(0)" onclick="add(this)" data-day="tuesday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>{{ __('storeDashboard.seAddSlot') }}</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>{{ __('storeDashboard.seWednesday') }}</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->wednesday) && count($schedule_data->wednesday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->wednesday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">{{ __('storeDashboard.seOpeningTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="wednesday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>{{ __('storeDashboard.seClosingTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->close}}"
                                    name="wednesday[]" required>
                            </div>
                            <div class="col-lg-2" day="wednesday">
                                <label class="col-form-label text-center" style="width: 43px;"></span><i class="icon-circle-down2"></i></label><br>
                                <button class="remove btn btn-danger" data-popup="tooltip" data-placement="right" title="Remove Time Slot">
                                <i class="icon-cross2"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div id="wednesday" class="timeSlots">
                        </div>
                        <a href="javascript:void(0)" onclick="add(this)" data-day="wednesday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>{{ __('storeDashboard.seAddSlot') }}</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>{{ __('storeDashboard.seThursday') }}</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->thursday) && count($schedule_data->thursday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->thursday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">{{ __('storeDashboard.seOpeningTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="thursday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>{{ __('storeDashboard.seClosingTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->close}}"
                                    name="thursday[]" required>
                            </div>
                            <div class="col-lg-2" day="thursday">
                                <label class="col-form-label text-center" style="width: 43px;"></span><i class="icon-circle-down2"></i></label><br>
                                <button class="remove btn btn-danger" data-popup="tooltip" data-placement="right" title="Remove Time Slot">
                                <i class="icon-cross2"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div id="thursday" class="timeSlots">
                        </div>
                        <a href="javascript:void(0)" onclick="add(this)" data-day="thursday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>{{ __('storeDashboard.seAddSlot') }}</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>{{ __('storeDashboard.seFriday') }}</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->friday) && count($schedule_data->friday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->friday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">{{ __('storeDashboard.seOpeningTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="friday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>{{ __('storeDashboard.seClosingTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->close}}"
                                    name="friday[]" required>
                            </div>
                            <div class="col-lg-2" day="friday">
                                <label class="col-form-label text-center" style="width: 43px;"></span><i class="icon-circle-down2"></i></label><br>
                                <button class="remove btn btn-danger" data-popup="tooltip" data-placement="right" title="Remove Time Slot">
                                <i class="icon-cross2"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif 
                        <div id="friday" class="timeSlots">
                        </div>
                        <a href="javascript:void(0)" onclick="add(this)" data-day="friday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>{{ __('storeDashboard.seAddSlot') }}</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>{{ __('storeDashboard.seSaturday') }}</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->saturday) && count($schedule_data->saturday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->saturday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">{{ __('storeDashboard.seOpeningTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="saturday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>{{ __('storeDashboard.seClosingTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->close}}"
                                    name="saturday[]" required>
                            </div>
                            <div class="col-lg-2" day="saturday">
                                <label class="col-form-label text-center" style="width: 43px;"></span><i class="icon-circle-down2"></i></label><br>
                                <button class="remove btn btn-danger" data-popup="tooltip" data-placement="right" title="Remove Time Slot">
                                <i class="icon-cross2"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div id="saturday" class="timeSlots">
                        </div>
                        <a href="javascript:void(0)" onclick="add(this)" data-day="saturday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>{{ __('storeDashboard.seAddSlot') }}</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>{{ __('storeDashboard.seSunday') }}</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->sunday) && count($schedule_data->sunday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->sunday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">{{ __('storeDashboard.seOpeningTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="sunday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>{{ __('storeDashboard.seClosingTime') }}</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->close}}"
                                    name="sunday[]" required>
                            </div>
                            <div class="col-lg-2" day="sunday">
                                <label class="col-form-label text-center" style="width: 43px;"></span><i class="icon-circle-down2"></i></label><br>
                                <button class="remove btn btn-danger" data-popup="tooltip" data-placement="right" title="Remove Time Slot">
                                <i class="icon-cross2"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div id="sunday" class="timeSlots">
                        </div>
                        <a href="javascript:void(0)" onclick="add(this)" data-day="sunday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>{{ __('storeDashboard.seAddSlot') }}</a>
                        <hr>
                        <input type="text" name="restaurant_id" hidden value="{{$restaurant->id}}">
                        @csrf
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" data-popup="tooltip" title="{{ __('storeDashboard.seScheduleUpdateMsg') }}" data-placement="bottom">
                            {{ __('storeDashboard.update') }}
                            <i class="icon-database-insert ml-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
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
     function add(data) {
        var para = document.createElement("div");
        let day = data.getAttribute("data-day")
        para.innerHTML ="<div class='form-group row'> <div class='col-lg-5'><label class='col-form-label'>{{ __('storeDashboard.seOpeningTime') }}</label><input type='text' class='form-control clock form-control-lg' name='"+day+"[]' required> </div> <div class='col-lg-5'> <label class='col-form-label'>{{ __('storeDashboard.seClosingTime') }}</label><input type='text' class='form-control clock form-control-lg' name='"+day+"[]'  required> </div> <div class='col-lg-2'> <label class='col-form-label text-center' style='width: 43px'></span><i class='icon-circle-down2'></i></label><br><button class='remove btn btn-danger' data-popup='tooltip' data-placement='right' title='{{ __('storeDashboard.seRemoveTimeSlot') }}'><i class='icon-cross2'></i></button></div></div>";
        document.getElementById(day).appendChild(para);
        $('.clock').bootstrapMaterialDatePicker({
            shortTime: true,
            date: false,
            time: true,
            format: 'HH:mm'
        });
    }
    $(function () {

        $('body').tooltip({
            selector: 'button'
        });
        
        $('.clock').bootstrapMaterialDatePicker({
            shortTime: true,
            date: false,
            time: true,
            format: 'HH:mm'
        });
        $(document).on("click", ".remove", function() {
            $(this).tooltip('hide')
            $(this).parent().parent().remove();
        });
        
        $('.select').select2({
            minimumResultsForSearch: Infinity,
        });
    
         if (Array.prototype.forEach) {
               var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery-primary'));
               elems.forEach(function(html) {
                   var switchery = new Switchery(html, { color: '#2196F3' });
               });
           }
           else {
               var elems = document.querySelectorAll('.switchery-primary');
               for (var i = 0; i < elems.length; i++) {
                   var switchery = new Switchery(elems[i], { color: '#2196F3' });
               }
           }
    
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