@extends('admin.layouts.master')
@section("title") Coupons - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ count($coupons) }} Coupons</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left" id="addNewCoupon"
                    data-toggle="modal" data-target="#addNewCouponModal">
                    <b><i class="icon-plus2"></i></b>
                    Add New Coupon
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
                            <th>Name</th>
                            <th>Coupon Applicable Store</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th>Usage</th>
                            <th style="min-width: 150px;">Expiry Date</th>
                            <th>Min Subtotal</th>
                            <th>Max Discount</th>
                            <th class="text-center" style="width: 10%;"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->name }}</td>
                            <td>
                            @if(count($coupon->restaurants) > 1)
                           <span class="badge badge-flat border-grey-800 text-default text-capitalize">MULTIPLE
                               STORES</span>
                           @else
                           @foreach($coupon->restaurants as $couponRestaurant)
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">{{ $couponRestaurant->name }}</span>
                           @endforeach
                           @endif
                           </td>
                            <td><b>{{ $coupon->code }}</b></td>
                            <td>
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                    {{ $coupon->discount_type }}
                                </span>
                            </td>
                            <td>
                                @if($coupon->discount_type == "AMOUNT")
                                {{ config('appSettings.currencyFormat') }} {{ $coupon->discount }}
                                @else
                                {{ $coupon->discount }} <strong>%</strong>
                                @endif
                            </td>
                            <td>@if($coupon->is_active)
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                    Active
                                </span>
                                @else
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                    Inactive
                                </span>
                                @endif
                            </td>
                            <td><span
                                    class="badge badge-flat border-grey-800 text-default text-capitalize">{{ $coupon->count }}</span>
                            </td>
                            <td class="small">{{ $coupon->expiry_date->diffForHumans() }}
                                <br>({{ $coupon->expiry_date->format('Y-m-d') }})
                            </td>
                            <td>{{ $coupon->min_subtotal }}</td>
                            <td>@if($coupon->max_discount) {{ $coupon->max_discount }} @else <span class="badge badge-flat border-grey-800 text-default text-capitalize">NA</span> @endif</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <a href="{{ route('admin.get.getEditCoupon', $coupon->id) }}"
                                        class="btn btn-sm btn-primary"> Edit</a>
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
<div id="addNewCouponModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">Add New Coupon</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.post.saveNewCoupon') }}" method="POST">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Coupon Name:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="Coupon Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Coupon Description:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="description"
                                placeholder="Coupon Description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Coupon Code:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="code"
                                placeholder="Coupon Code" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Dicsount Type:</label>
                        <div class="col-lg-9">
                            <select class="form-control select-search select" name="discount_type" required>
                                <option value="AMOUNT" class="text-capitalize">
                                    Fixed Amount Discount
                                </option>
                                <option value="PERCENTAGE" class="text-capitalize">
                                    Percentage Discount
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row hidden" id="max_discount">
                        <label class="col-lg-3 col-form-label">Max Discount</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg max_discount" name="max_discount"
                                placeholder="Max discount applicable in {{ config('appSettings.currencyFormat') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Coupon
                            Discount:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg discount" name="discount"
                                placeholder="Coupon Discount" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Expiry
                                Date:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg daterange-single"
                                    value="{{ $todaysDate }}" name="expiry_date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Coupon Applicable Stores:</label>
                        <div class="col-lg-9">
                            <select multiple="multiple" class="form-control select-search couponStoreSelect" name="restaurant_id[]" required id="storeSelect">
                                @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}" class="text-capitalize">{{ $restaurant->name }}
                                </option>
                                @endforeach
                            </select>
                             <input type="checkbox" id="selectAllStores"><span class="ml-1">Select All Stores</span>
                        </div>
                    </div>
                    <script>
                        $("#selectAllStores").click(function(){
                            if($("#selectAllStores").is(':checked') ){
                                $("#storeSelect > option").prop("selected","selected");
                                $("#storeSelect").trigger("change");
                            }else{
                                $("#storeSelect > option").removeAttr("selected");
                                 $("#storeSelect").trigger("change");
                             }
                        });
                    </script>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Max number of
                            use in total</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg max_count" name="max_count"
                                placeholder="Max number of use" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Min Subtotal</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg min_subtotal" name="min_subtotal"
                                placeholder="Min subtotal required for coupon in {{ config('appSettings.currencyFormat') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Subtotal not reached message</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="subtotal_message"
                                placeholder="Subtotal not reached message">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Coupon User Type</label>
                        <div class="col-lg-9">
                    <select class="form-control select-search select" name="user_type" required>
                        <option value="ALL" class="text-capitalize">
                            Unlimited times for all users
                        </option>
                        <option value="ONCENEW" class="text-capitalize">
                            Once for new user for first order
                        </option>
                        <option value="ONCE" class="text-capitalize">
                            Once per user
                        </option>
                        <option value="CUSTOM" class="text-capitalize">
                            Define custom limit per user
                        </option>
                     </select>
                     </div>
                    </div>
                    <div class="form-group row hidden" id="maxUsePerUser">
                        <label class="col-lg-3 col-form-label">Max number of
                            use per user:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg max_count_per_user" name="max_count_per_user"
                                placeholder="Max number of use per user">
                        </div>
                    </div>
                    <script>
                        $("[name='user_type']").change(function() {
                            let selectedUserType = $(this).val();
                            if (selectedUserType == "CUSTOM") {
                                 $("[name='max_count_per_user']").attr('required', 'required');
                                $('#maxUsePerUser').removeClass('hidden');
                            } else {
                               $("[name='max_count_per_user']").removeAttr('required')
                               $('#maxUsePerUser').addClass('hidden');
                            }
                        });
                    </script>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Is Active?</label>
                        <div class="col-lg-9 d-flex align-items-center">
                            <div class="checkbox checkbox-switchery">
                                    <input value="true" type="checkbox" class="switchery-primary isactive"
                                        checked="checked" name="is_active">
                                </label>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            SAVE
                            <i class="icon-database-insert ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
           $('.select').select2();
           $('.couponStoreSelect').select2({
               closeOnSelect: false
           })
    
           var isactive = document.querySelector('.isactive');
           new Switchery(isactive, { color: '#2196f3' });
           
           $('.form-control-uniform').uniform();
    
           $('.daterange-single').daterangepicker({ 
               singleDatePicker: true,
           });
           $('[name="discount_type"]').change(function(event) {
            console.log($(this).val());
               if ($(this).val() == "PERCENTAGE") {
                $('#max_discount').removeClass('hidden');
               } else {
                 $('#max_discount').addClass('hidden');
               }
           });
           $('.min_subtotal').numeric({ allowThouSep:false, maxDecimalPlaces: 2, allowMinus: false });
           $('.max_discount').numeric({ allowThouSep:false, maxDecimalPlaces: 2, allowMinus: false });
           $('.max_count').numeric({ allowThouSep:false, maxDecimalPlaces: 0, allowMinus: false });
           $('.max_count_per_user').numeric({ allowThouSep:false, maxDecimalPlaces: 0, allowMinus: false, max: 99999999 });
           $('.discount').numeric({ allowThouSep:false, maxDecimalPlaces: 2, allowMinus: false });
       });    
</script>
@endsection