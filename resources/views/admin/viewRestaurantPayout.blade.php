@extends('admin.layouts.master')
@section("title") Store Payouts - Dashboard
@endsection
@section('content')
<div class="content">
   <div class="row mt-4">
      <div class="col-xl-8">
         <div class="card">
            <div class="card-body">
               <h4>
                  {{ $restaurantPayout->restaurant->name }} has requested a payout of <strong>{{ config('appSettings.currencyFormat') }}{{ $restaurantPayout->amount }}</strong>
               </h4>
               <form action="{{ route('admin.updateRestaurantPayout') }}" method="POST" enctype="multipart/form-data">
                  <legend class="font-weight-semibold text-uppercase font-size-sm">
                     <i class="icon-piggy-bank mr-2"></i> Store Payout
                  </legend>
                  <input type="hidden" name="id" value="{{ $restaurantPayout->id }}">
                  <div class="form-group row">
                     <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Status:</label>
                     <div class="col-lg-9">
                        <select class="form-control select" name="status" required>
                        <option value="PENDING" @if($restaurantPayout->status === "PENDING") selected="selected" @endif>PENDING</option>
                        <option value="PROCESSING" @if($restaurantPayout->status === "PROCESSING") selected="selected" @endif>PROCESSING</option>
                        <option value="COMPLETED" @if($restaurantPayout->status === "COMPLETED") selected="selected" @endif>COMPLETED</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-lg-3 col-form-label">Transaction Mode:</label>
                     <div class="col-lg-9">
                        <input value="{{ $restaurantPayout->transaction_mode }}" type="text" class="form-control form-control-lg" name="transaction_mode"
                           placeholder="Transaction Mode">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-lg-3 col-form-label">Transaction ID:</label>
                     <div class="col-lg-9">
                        <input value="{{ $restaurantPayout->transaction_id }}" type="text" class="form-control form-control-lg" name="transaction_id"
                           placeholder="Transaction ID">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-lg-3 col-form-label">Message:</label>
                     <div class="col-lg-9">
                        <input value="{{ $restaurantPayout->message }}" type="text" class="form-control form-control-lg" name="message"
                           placeholder="Message">
                     </div>
                  </div>
                  @csrf
                  <div class="text-right">
                     <button type="submit" class="btn btn-primary">
                     UPDATE
                     <i class="icon-database-insert ml-1"></i>
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-xl-4">
         <div class="card">
            <div class="card-body">
               <legend class="font-weight-semibold text-uppercase font-size-sm">
                  <i class="icon-coin-dollar mr-2"></i> Payout Account Details
               </legend>
               <p>
                  <span class=""><b>Bank Name: </b></span> <span>@if(!empty($payoutData->bankName)){{ $payoutData->bankName }}@endif</span><br>
               </p>
               <p>
                  <span class=""><b>Bank Code/IFSC: </b></span> <span>@if(!empty($payoutData->bankCode)){{ $payoutData->bankCode }}@endif</span><br>
               </p>
               <p>
                  <span class=""><b>Account Holder Name: </b></span> <span>@if(!empty($payoutData->recipientName)){{ $payoutData->recipientName }}@endif</span><br>
               </p>
               <p><span class=""><b>Account Number: </b></span> <span>@if(!empty($payoutData->accountNumber)){{ $payoutData->accountNumber }}@endif</span><br></p>
               <p><span class=""><b>PayPal ID: </b></span> <span>@if(!empty($payoutData->paypalId)){{ $payoutData->paypalId }}@endif</span><br></p>
               <p><span class=""><b>UPI ID: </b></span> <span>@if(!empty($payoutData->upiID)){{ $payoutData->upiID }}@endif</span><br>
               </p>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $('.select').select2({
       minimumResultsForSearch: Infinity,
   });
</script>
@endsection