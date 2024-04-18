@extends('admin.layouts.master')
@section("title") Store Payouts - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $count }}</span>
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
                            <th>
                                Store
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Transaction Mode
                            </th>
                            <th>
                                Transaction ID
                            </th>
                            <th>
                                Message
                            </th>
                            <th>
                                Created At
                            </th>
                           <th class="text-center" style="width: 10%;"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($restaurantPayouts as $restaurantPayout)
                        <tr>
                            <td>{{ $restaurantPayout->restaurant->name }}</td>
                            <td>{{ $restaurantPayout->amount }}</td>
                            <td><span class="badge badge-flat border-grey-800 text-default text-capitalize">{{ $restaurantPayout->status }}</span></td>
                            <td>
                                @if($restaurantPayout->transaction_mode != NULL)
                                {{ $restaurantPayout->transaction_mode }}
                                @else
                                ----
                                @endif
                            </td>
                            <td>
                                @if($restaurantPayout->transaction_id != NULL)
                                {{ $restaurantPayout->transaction_id }}
                                @else
                                ----
                                @endif
                            </td>
                             <td>
                                @if($restaurantPayout->message != NULL)
                                {{ $restaurantPayout->message }}
                                @else
                                ----
                                @endif
                            </td>
                            <td>{{ $restaurantPayout->created_at->format('Y-m-d  - h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.viewRestaurantPayout', $restaurantPayout->id) }}"
                                    class="btn btn-sm btn-primary"> View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $restaurantPayouts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection