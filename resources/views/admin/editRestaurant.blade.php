@extends('admin.layouts.master')
@section("title") Edit Store - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">Editing</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $restaurant->name }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>

<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="min-height: 75vh;">
                <form action="{{ route('admin.updateRestaurant') }}" method="POST" enctype="multipart/form-data" id="storeMainForm" style="min-height: 75vh;">
                    @csrf
                    <input type="hidden" name="window_redirect_hash" value="">
                    <input type="hidden" name="id" value="{{ $restaurant->id }}">

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left btn-lg btnUpdateStore">
                        <b><i class="icon-database-insert ml-1"></i></b>
                        Update Store
                        </button>
                    </div>

                    <div class="d-lg-flex justify-content-lg-left">
                        <ul class="nav nav-pills flex-column mr-lg-3 wmin-lg-250 mb-lg-0">
                            <li class="nav-item">
                                <a href="#generalSettings" class="nav-link active" data-toggle="tab">
                                <i class="icon-store2 mr-2"></i>
                                General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#metaDataSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-info22 mr-2"></i>
                                Meta Data
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#operationAreaSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-map mr-2"></i>
                                Operation Area
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#deliverySettings" class="nav-link" data-toggle="tab">
                                <i class="icon-truck mr-2"></i>
                                Delivery
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#extraSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-strategy mr-2"></i>
                                Extras
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#actionSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-square-up-right mr-2"></i>
                                Actions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#paymentGatewaySettings" class="nav-link" data-toggle="tab">
                                <i class="icon-coin-dollar mr-2"></i>
                                Payment Gateways
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#commissionSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-percent mr-2"></i>
                                Commissions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link" id="payoutDetails">
                                <i class="icon-coin-dollar mr-2"></i>
                                Payout Details
                                </a>
                            </li>
                            @if($restaurant->is_schedulable)
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link" id="schedulingSettings">
                                    <i class="icon-alarm mr-2"></i>
                                    Scheduling
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('admin.sortMenusAndItems', $restaurant->id) }}" class="nav-link">
                                <i class="icon-sort mr-2"></i>
                                Sort Menus and Items
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.viewStoreReviews', $restaurant->id) }}" class="nav-link">
                                <i class="icon-stars mr-2"></i>
                                Rating & Reviews <span class="ml-1 badge badge-flat text-white {{ ratingColorClass($rating) }}">{{ $rating }} <i class="icon-star-full2 text-white" style="font-size: 0.6rem;"></i></span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" style="width: 100%; padding: 0 25px;">

                            <div class="tab-pane fade show active" id="generalSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    General Settings
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Store Name:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->name }}" type="text" class="form-control form-control-lg" name="name"
                                            placeholder="Store Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Description:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->description }}" type="text" class="form-control form-control-lg" name="description"
                                            placeholder="Store Short Description" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Image:</label>
                                    <div class="col-lg-9">
                                        <img src="{{ substr(url("/"), 0, strrpos(url("/"), '/')) }}{{ $restaurant->image }}" alt="Image" width="160" style="border-radius: 0.275rem;">
                                        <img class="slider-preview-image hidden" style="border-radius: 0.275rem;"/>
                                        <div class="uploader">
                                            <input type="hidden" name="old_image" value="{{ $restaurant->image }}">
                                            <input type="file" class="form-control-uniform" name="image" accept="image/x-png,image/gif,image/jpeg" onchange="readURL(this);">
                                            <span class="help-text text-muted">Image dimension 160x117</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Store Charge (Packing/Extra):</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->restaurant_charges }}" type="text" class="form-control form-control-lg restaurant_charges" name="restaurant_charges"
                                            placeholder="Store Charge in {{ config('appSettings.currencyFormat') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Min Order Price <i class="icon-question3 ml-1" data-popup="tooltip" title="Set the value as 0 if not required" data-placement="top"></i></label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->min_order_price }}" type="text" class="form-control form-control-lg min_order_price" name="min_order_price"
                                            placeholder="Min Cart Value before discount and tax {{ config('appSettings.currencyFormat') }}" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Store Categories: </label>
                                    <div class="col-lg-9">
                                        <select multiple="multiple" class="form-control selectRestaurantCategory" data-fouc name="restaurant_category_restaurant[]">
                                            @foreach($restaurantCategories as $rC)
                                            <option value="{{ $rC->id }}" class="text-capitalize" {{isset($restaurant) &&  in_array($restaurant->id, $rC->restaurants()->pluck('restaurant_id')->toArray()) ? 'selected' : '' }}>{{ $rC->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Store URL</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->slug }}" type="text" class="form-control form-control-lg" name="store_url"
                                            placeholder="Store URL" required>
                                            <p onclick="copyURL()" class="text-muted">https://{{ request()->getHttpHost() }}/stores/<strong><span id="storeURL">{{ $restaurant->slug }}</span></strong></p>
                                    </div>

                                </div>
                                
                            </div>

                            <div class="tab-pane fade" id="metaDataSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Meta Settings
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Full Address:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->address }}" type="text" class="form-control form-control-lg" name="address"
                                            placeholder="Full Address of Store" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" data-popup="tooltip" title="Pincode / Postcode / Zip Code" data-placement="bottom">Pincode:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->pincode }}" type="text" class="form-control form-control-lg" name="pincode"
                                            placeholder="Pincode / Postcode / Zip Code of Store">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Land Mark:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->landmark }}" type="text" class="form-control form-control-lg" name="landmark"
                                            placeholder="Any Near Landmark">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Rating:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->rating }}" type="text" class="form-control form-control-lg rating" name="rating"
                                            placeholder="Rating from 1-5" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Approx Delivery Time:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->delivery_time }}" type="text" class="form-control form-control-lg delivery_time" name="delivery_time"
                                            placeholder="Time in Minutes" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Approx Price for Two:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->price_range }}" type="text" class="form-control form-control-lg price_range" name="price_range"
                                            placeholder="Approx Price for 2 People in {{ config('appSettings.currencyFormat') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Certificate/License Code:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->certificate }}" type="text" class="form-control form-control-lg" name="certificate"
                                            placeholder="Certificate Code or License Code">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Custom Store Message
                                    <i class="icon-question3 ml-1" data-popup="tooltip" title="This will be displayed above search bar on Stores page (Custom HTML can be used)" data-placement="left"></i>
                                    </strong></label>
                                    <div class="col-lg-9">
                                        <textarea class="summernote-editor" name="custom_message" placeholder="Custom Store Message - Leave empty to hide" rows="6">{{ $restaurant->custom_message }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="operationAreaSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Operation Area Settings
                                </legend>
                                
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Latitude:</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg gllpLatitude latitude" value="{{ $restaurant->latitude }}" name="latitude" placeholder="Latitude of the Store" required="required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Longitude:</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg gllpLongitude longitude" value="{{ $restaurant->longitude }}" name="longitude" placeholder="Longitude of the Store" required="required">
                                    </div>
                                </div>
                                <span class="text-muted">You can use services like: <a href="https://www.mapcoordinates.net/en" target="_blank">https://www.mapcoordinates.net/en</a></span> <br> <span class="text-muted">If you enter an invalid Latitude/Longitude the map system might crash with a white screen.</span>

                            <div style="padding: 25px; margin-top: 2rem; border-radius: 0.5rem; border: 1px solid #dedede">
                                <h3>Radius Wise Area</h3>
                                <hr class="my-2" style="border-color: rgba(224, 224, 224, 59%)">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Delivery Radius in Km:</label>
                                    <div class="col-lg-9">
                                        <input type="text" value="{{ $restaurant->delivery_radius }}" class="form-control form-control-lg delivery_radius" name="delivery_radius"
                                            placeholder="Delivery Radius in KM (If left blank, delivery radius will be set to 10 KM)" @if($dapCheck && count($restaurant->delivery_areas) > 0) disabled="disabled" style="cursor: not-allowed;" title="Radius is ignored when areas are assigned to store." @endif>
                                    </div>
                                </div>
                            </div>

                                @if($dapCheck)
                                <div class="mt-4 d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-info"> <i class="icon-exclamation mr-2" style="font-size: 1.8rem; opacity: 0.3;"></i></span>
                                    </div>
                                    <div>
                                        <p class="mb-0">You have enabled Delivery Area Pro module. The application will start using Areas insetead of Radius if atleast one area is assigned to store <b>{{ $restaurant->name }}.</b></p>
                                    </div>
                                </div>
                                @endif

                                <!-- Delivery Area Pro Module -->
                                @if($dapCheck)
                                <div style="padding: 25px; margin-top: 2rem; border-radius: 0.5rem; border: 1px solid #dedede">
                                    <h3><i class="icon-medal-star mr-2"></i> Delivery Area Pro </h3>
                                    <hr class="my-2" style="border-color: rgba(224, 224, 224, 59%)">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            @if(count($restaurant->delivery_areas) > 0)
                                                <b>Operational Areas:</b>
                                                <br>
                                                <div class="my-2">
                                                    @foreach($restaurant->delivery_areas as $deliveryArea)
                                                    <span class="badge badge-flat border-grey-800 mr-1 mb-2" style="font-size: 0.9rem;">{{ $deliveryArea->name }}</span>
                                                    @endforeach
                                                </div>
                                                <a href="{{ route('dap.assignAreasToStore', $restaurant->id) }}" class="btn btn-md btn-secondary">Manage Areas</a>
                                            @else
                                                <p class="text-warning mb-0 my-2" style="line-height: 2.4rem;"><b>{{ $restaurant->name }}</b> is not assigned to any area for operation.</p>
                                                <a href="{{ route('dap.assignAreasToStore', $restaurant->id) }}" class="btn btn-md btn-secondary">Assign Areas</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <!-- END Delivery Area Pro Module -->
                            </div>

                            <div class="tab-pane fade" id="deliverySettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Delivery Settings
                                </legend>
                                @if(config("appSettings.enSPU") == "true")
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Delivery Type:</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select" name="delivery_type" required>
                                        <option value="1" class="text-capitalize" @if($restaurant->delivery_type == "1") selected="selected" @endif>Delivery</option>
                                        <option value="2" class="text-capitalize" @if($restaurant->delivery_type == "2") selected="selected" @endif>Self Pickup</option>
                                        <option value="3" class="text-capitalize" @if($restaurant->delivery_type == "3") selected="selected" @endif>Both Delivery & Self Pickup</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Delivery Charge Type:</label>
                                    <div class="col-lg-9">
                                        <select class="form-control select" name="delivery_charge_type" required>
                                        <option value="FIXED" @if($restaurant->delivery_charge_type == "FIXED") selected="selected" @endif class="text-capitalize">Fixed Charge</option>
                                        <option value="DYNAMIC" @if($restaurant->delivery_charge_type == "DYNAMIC") selected="selected" @endif class="text-capitalize">Dynamic Charge</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="deliveryCharge">
                                    <label class="col-lg-3 col-form-label">Delivery Charge:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->delivery_charges }}" type="text" class="form-control form-control-lg delivery_charges" name="delivery_charges"
                                            placeholder="Delivery Charge in {{ config('appSettings.currencyFormat') }}">
                                    </div>
                                </div>
                                <div id="dynamicChargeDiv">
                                    <div class="form-group">
                                        <div class="col-lg-12 row p-0">
                                            <div class="col-lg-3">
                                                <label class="col-lg-12 col-form-label p-0 pb-1">Base Delivery Charge:</label>
                                                <input value="{{ $restaurant->base_delivery_charge }}" type="text" class="form-control form-control-lg base_delivery_charge" name="base_delivery_charge"
                                                    placeholder="In {{ config('appSettings.currencyFormat') }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="col-lg-12 col-form-label p-0 pb-1">Base Delivery Distance:</label>
                                                <input value="{{ $restaurant->base_delivery_distance }}" type="text" class="form-control form-control-lg base_delivery_distance" name="base_delivery_distance"
                                                    placeholder="In Kilometer (KM)">
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="col-lg-12 col-form-label p-0 pb-1">Extra Delivery Charge:</label>
                                                <input value="{{ $restaurant->extra_delivery_charge }}" type="text" class="form-control form-control-lg extra_delivery_charge" name="extra_delivery_charge"
                                                    placeholder="In {{ config('appSettings.currencyFormat') }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="col-lg-12 col-form-label p-0 pb-1">Extra Delivery Distance:</label>
                                                <input value="{{ $restaurant->extra_delivery_distance }}" type="text" class="form-control form-control-lg extra_delivery_distance" name="extra_delivery_distance" placeholder="In Kilometer (KM)">
                                            </div>
                                        </div>
                                        <p class="help-text mt-2 mb-0 text-muted"> Base delivery charges will be applied to the base delivery distance. And for every extra delivery distance, extra delivery charge will be applied.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="extraSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Extras
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Is Pure Veg?</label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary" @if($restaurant->is_pureveg) checked="checked" @endif name="is_pureveg">
                                            </label>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Is Featured?</label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary" @if($restaurant->is_featured) checked="checked" @endif name="is_featured">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Auto Accept Order</label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if($restaurant->auto_acceptable) checked="checked" @endif name="auto_acceptable">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">SMS Notification for New Orders</label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if($restaurant->is_notifiable) checked="checked" @endif name="is_notifiable">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Automatic Scheduling</label>
                                    <div class="col-lg-9">
                                        <div class="checkbox checkbox-switchery mt-2">
                                            <label>
                                            <input value="true" type="checkbox" class="switchery-primary"
                                            @if($restaurant->is_schedulable) checked="checked" @endif name="is_schedulable">
                                            </label>
                                        </div>
                                    Learn more about Automatic Scheduling (Open/Close) time  <a href="https://docs.foodomaa.com/configurations/store-scheduling-open-close-times" target="_blank"> here</a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="actionSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Action Settings
                                </legend>
                                <div class="text-left">
                                    <div class="btn-group btn-group-justified" style="width: 300px">
                                        @if($restaurant->is_accepted)
                                        <a href="{{ route('admin.acceptRestaurant', $restaurant->id) }}"
                                            class="btn btn-danger btn-labeled btn-labeled-left mr-2" data-popup="tooltip"
                                            title="The restaurant won't show up on customer's screen" data-placement="bottom">
                                        <b><i class="icon-exclamation"></i></b>
                                        Deactivate
                                        </a>
                                        @else
                                        <a href="{{ route('admin.acceptRestaurant', $restaurant->id) }}"
                                            class="btn btn-secondary btn-labeled btn-labeled-left mr-2" data-popup="tooltip"
                                            title="Restaurant is not Active, it won't show up on the customer screen" data-placement="bottom">
                                        <b><i class="icon-exclamation"></i></b>
                                        Activate
                                        </a>
                                        @endif 
                                        @if($restaurant->is_active)
                                        <a href="{{ route('admin.disableRestaurant', $restaurant->id) }}"
                                            class="btn btn-danger btn-labeled btn-labeled-left mr-2" data-popup="tooltip"
                                            title="Users won't be able to place order from this Store if Disabled" data-placement="bottom">
                                        <b><i class="icon-switch2"></i></b>
                                        Close
                                        </a>
                                        @else
                                        <a href="{{ route('admin.disableRestaurant', $restaurant->id) }}"
                                            class="btn btn-secondary btn-labeled btn-labeled-left mr-2" data-popup="tooltip"
                                            title="Store is Disabled. Enable to accept orders." data-placement="bottom">
                                        <b><i class="icon-switch2"></i></b>
                                        Open
                                        </a>
                                        @endif 
                                    </div>
                                    <p class="mt-2 text-muted">Manual intervention on Open/Close will disable Automatic Scheduling if it was previosuly enabled.</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="paymentGatewaySettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Payment Gateways
                                </legend>

                                @if(count($restaurant->payment_gateways) == 0)
                                <p class="text-danger">
                                    <strong>No Payment Gateways Active</strong>
                                    <br>
                                    Admin selected Payment Gateways will be inherited.
                                </p>
                                @endif
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Select Payment Gateways</label>
                                    <div class="col-lg-8">
                                         <select multiple="multiple" class="form-control select" name="store_payment_gateways[]">
                                        @foreach($adminPaymentGateways as $adminPaymentGateway)
                                            <option value="{{ $adminPaymentGateway->id }}" class="text-capitalize" {{ in_array($adminPaymentGateway->id, $restaurant->payment_gateways()->pluck('payment_gateway_id')->toArray()) ? 'selected' : '' }}>{{ $adminPaymentGateway->name }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="commissionSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Commission Settings
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Commission Rate %:</label>
                                    <div class="col-lg-9">
                                        <input value="{{ $restaurant->commission_rate }}" type="text" class="form-control form-control-lg commission_rate" name="commission_rate"
                                            placeholder="Commission Rate %" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left btn-lg btnUpdateStore">
                        <b><i class="icon-database-insert ml-1"></i></b>
                        Update Store
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>


<div class="content" id="payoutDetailsBlock">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.updateStorePayoutDetails') }}" method="POST">
                <legend class="font-weight-semibold text-uppercase font-size-sm">
                    <i class="icon-coin-dollar mr-2"></i> Payout Account Details
                </legend>
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Bank Name: </strong></label>
                    <div class="col-lg-9">
                         <input type="text" class="form-control form-control-lg" name="bankName" value="@if(!empty($payoutData->bankName)){{ $payoutData->bankName }}@endif">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Bank Code/IFSC: </strong></label>
                    <div class="col-lg-9">
                         <input type="text" class="form-control form-control-lg" name="bankCode" value="@if(!empty($payoutData->bankCode)){{ $payoutData->bankCode }}@endif">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Recipient Name: </strong></label>
                    <div class="col-lg-9">
                         <input type="text" class="form-control form-control-lg" name="recipientName" value="@if(!empty($payoutData->recipientName)){{ $payoutData->recipientName }}@endif">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Account Number: </strong></label>
                    <div class="col-lg-9">
                         <input type="text" class="form-control form-control-lg" name="accountNumber" value="@if(!empty($payoutData->accountNumber)){{ $payoutData->accountNumber }}@endif">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Paypal ID: </strong></label>
                    <div class="col-lg-9">
                         <input type="text" class="form-control form-control-lg" name="paypalId" value="@if(!empty($payoutData->paypalId)){{ $payoutData->paypalId }}@endif">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>UPI ID: </strong></label>
                    <div class="col-lg-9">
                         <input type="text" class="form-control form-control-lg" name="upiID" value="@if(!empty($payoutData->upiID)){{ $payoutData->upiID }}@endif">
                    </div>
                </div>
                @csrf
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                    Update
                    <i class="icon-database-insert ml-1"></i>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($restaurant->is_schedulable)
    <div class="content" id="autoSchedulingBlock">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.updateRestaurantScheduleData') }}" method="POST"
                        enctype="multipart/form-data">
                        <legend class="font-weight-semibold text-uppercase font-size-sm">
                            <i class="icon-alarm mr-2"></i> Store Scheduling Times
                        </legend>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>Monday</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->monday) && count($schedule_data->monday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->monday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">Opening Time</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="monday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>Closing Time</label>
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
                        <a href="javascript:void(0)" onclick="add(this)" data-day="monday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>Add Slot</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>Tuesday</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->tuesday) && count($schedule_data->tuesday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->tuesday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">Opening Time</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="tuesday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>Closing Time</label>
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
                        <a href="javascript:void(0)" onclick="add(this)" data-day="tuesday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>Add Slot</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>Wednesday</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->wednesday) && count($schedule_data->wednesday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->wednesday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">Opening Time</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="wednesday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>Closing Time</label>
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
                        <a href="javascript:void(0)" onclick="add(this)" data-day="wednesday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>Add Slot</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>Thursday</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->thursday) && count($schedule_data->thursday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->thursday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">Opening Time</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="thursday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>Closing Time</label>
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
                        <a href="javascript:void(0)" onclick="add(this)" data-day="thursday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>Add Slot</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>Friday</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->friday) && count($schedule_data->friday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->friday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">Opening Time</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="friday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>Closing Time</label>
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
                        <a href="javascript:void(0)" onclick="add(this)" data-day="friday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>Add Slot</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>Saturday</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->saturday) && count($schedule_data->saturday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->saturday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">Opening Time</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="saturday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>Closing Time</label>
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
                        <a href="javascript:void(0)" onclick="add(this)" data-day="saturday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>Add Slot</a>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-lg-4">
                                <h3>Sunday</h3>
                            </div>
                        </div>
                        <!-- Checks if there is any schedule data -->
                        @if(!empty($schedule_data->sunday) && count($schedule_data->sunday) > 0)
                        <!-- If yes Then Loop Each Data as Time SLots -->
                        @foreach($schedule_data->sunday as $time)
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <label class="col-form-label">Opening Time</label>
                                <input type="text" class="form-control clock form-control-lg" value="{{$time->open}}"
                                    name="sunday[]" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="col-form-label"></span>Closing Time</label>
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
                        <a href="javascript:void(0)" onclick="add(this)" data-day="sunday" class="btn btn-secondary btn-labeled btn-labeled-left mr-2"> <b><i class="icon-plus22"></i></b>Add Slot</a>
                        <hr>
                        <input type="text" name="restaurant_id" hidden value="{{$restaurant->id}}">
                        @csrf
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left btn-lg" data-popup="tooltip" title="Make sure the Closing Time is always greater than the Opening Time for all the entries" data-placement="bottom">
                            <b><i class="icon-alarm ml-1"></i></b>
                            Update Scheduling Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

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
        para.innerHTML ="<div class='form-group row'> <div class='col-lg-5'><label class='col-form-label'>Opening Time</label><input type='text' class='form-control clock form-control-lg' name='"+day+"[]' required> </div> <div class='col-lg-5'> <label class='col-form-label'>Closing Time</label><input type='text' class='form-control clock form-control-lg' name='"+day+"[]'  required> </div> <div class='col-lg-2'> <label class='col-form-label text-center' style='width: 43px'></span><i class='icon-circle-down2'></i></label><br><button class='remove btn btn-danger' data-popup='tooltip' data-placement='right' title='Remove Time Slot'><i class='icon-cross2'></i></button></div></div>";
        document.getElementById(day).appendChild(para);
        $('.clock').bootstrapMaterialDatePicker({
            shortTime: true,
            date: false,
            time: true,
            format: 'HH:mm'
        });
    }
    
    $(function () {
        
        $('input[name=store_url]').keyup(function(event) {
            let slug = $(this).val();
            slug = slug.toLowerCase();
            slug = slug.replace(/[^a-zA-Z0-9]+/g,'-');
            $(this).val(slug);
            $('#storeURL').html(slug);
        });

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
        
        $('.selectRestaurantCategory').select2({
            closeOnSelect: false
        })
    
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
    
       $('.form-control-uniform').uniform();
    
       $('.rating').numeric({allowThouSep:false,  min: 1, max: 5, maxDecimalPlaces: 1 });
       $('.delivery_time').numeric({allowThouSep:false});
       $('.price_range').numeric({allowThouSep:false});
       $('.latitude').numeric({allowThouSep:false});
       $('.longitude').numeric({allowThouSep:false});
       $('.restaurant_charges').numeric({ allowThouSep:false, maxDecimalPlaces: 2 });
       $('.delivery_charges').numeric({ allowThouSep:false, maxDecimalPlaces: 2 });
       $('.commission_rate').numeric({ allowThouSep:false, maxDecimalPlaces: 2, max: 100 });
    
       $('.base_delivery_charge').numeric({ allowThouSep:false, maxDecimalPlaces: 2, allowMinus: false });
        $('.base_delivery_distance').numeric({ allowThouSep:false, maxDecimalPlaces: 0, allowMinus: false });
        $('.extra_delivery_charge').numeric({ allowThouSep:false, maxDecimalPlaces: 2, allowMinus: false });
        $('.extra_delivery_distance').numeric({ allowThouSep:false, maxDecimalPlaces: 0, allowMinus: false });
        
        $('.min_order_price').numeric({ allowThouSep:false, maxDecimalPlaces: 2, allowMinus: false });
        
    
        @if($restaurant->delivery_charge_type == "FIXED")
            $('#dynamicChargeDiv').addClass('hidden');
        @else
            $('#deliveryCharge').addClass('hidden');
        @endif
       
        $("[name='delivery_charge_type']").change(function(event) {
             if ($(this).val() == "FIXED") {
                 $('#dynamicChargeDiv').addClass('hidden');
                 $('#deliveryCharge').removeClass('hidden')
             } else {
                 $('#deliveryCharge').addClass('hidden');
                 $('#dynamicChargeDiv').removeClass('hidden')
             }
         });

        $('#schedulingSettings').click(function(event) {
            var targetOffset = $('#autoSchedulingBlock').offset().top - 70;
            $('html, body').animate({scrollTop: targetOffset}, 500);
        });

        $('#payoutDetails').click(function(event) {
            var targetOffset = $('#payoutDetailsBlock').offset().top - 70;
            $('html, body').animate({scrollTop: targetOffset}, 500);
        });
   

        $('.summernote-editor').summernote({
           height: 200,
           popover: {
               image: [],
               link: [],
               air: []
             }
        });

        /* Navigate with hash */
        var hash = window.location.hash;
        $("[name='window_redirect_hash']").val(hash);
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');
        $('.nav-pills a').click(function (e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $("[name='window_redirect_hash']").val(this.hash);
            $('html, body').scrollTop(scrollmem);
        });

        $('.btnUpdateStore').click(function () {
            $('input:invalid').each(function () {
                // Find the tab-pane that this element is inside, and get the id
                var $closest = $(this).closest('.tab-pane');
                var id = $closest.attr('id');

                // Find the link that corresponds to the pane and have it show
                $('ul.nav a[href="#' + id + '"]').tab('show');

                var hash = '#'+id;
                window.location.hash = hash;
                $("[name='window_redirect_hash']").val(hash);

                return false;
            });
        });

     });
</script>
@endsection