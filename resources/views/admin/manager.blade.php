@extends('admin.layouts.master')
@section("title") Welcome - Dashboard
@endsection
@section('content')
<div class="d-flex mt-5">
<h3>Welcome, <span class="text-capitalize">{{ Auth::user()->name }}</span>.</h3>
</div>
@endsection
