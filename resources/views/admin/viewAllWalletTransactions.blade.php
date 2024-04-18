@extends('admin.layouts.master')
@section("title") Wallet Transactions - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                @if(empty($query))
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $count }}</span>
                @else
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $count }}</span>
                <br>
                <span class="font-weight-bold mr-2">Showing results for "{{ $query }}"</span>
                @endif
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <form action="{{ route('admin.searchWalletTransactions') }}" method="GET">
        <div class="form-group form-group-feedback form-group-feedback-right search-box">
            <input type="text" class="form-control form-control-lg search-input"
                placeholder="Search with transaction id" name="query">
            <div class="form-control-feedback form-control-feedback-lg">
                <i class="icon-search4"></i>
            </div>
        </div>
        @csrf
    </form>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Transaction ID
                            </th>
                            <th>
                                Type
                            </th>
                            <th width="20%">
                                Amount
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                {{ $transaction->uuid }}
                            </td>
                            <td>
                                @if($transaction->type === "deposit")
                                    <span class="badge badge-flat border-grey-800 text-success text-capitalize">{{$transaction->type}}</span>
                                @else
                                    <span class="badge badge-flat border-grey-800 text-danger text-capitalize">{{$transaction->type}}</span>
                                @endif
                            </td>
                            <td>
                                {{ config('appSettings.currencyFormat') }} {{ number_format($transaction->amount / 100, 2,'.', '') }}
                            </td>
                            <td>
                                {{ $transaction->meta["description"] }}
                            </td>
                            <td>
                                {{ $transaction->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection