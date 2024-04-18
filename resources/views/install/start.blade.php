@extends('install.layout.master')
@section('title')
Installation
@endsection
@section('thankyou')
<style>
    .main-col {
        display: none !important;
    }
</style>
<div class="col-lg-4 col-lg-offset-4 mt-5">
    <div class="thankyou-box">
        <h2>Thank-you for your purchase 🤟</h2>
        <p>This is the installation wizard. Please follow the steps provided in the <a
                href="https://stackcanyon.com/docs/foodomaa/installation" target="_blank">documentation</a> if you face
            any issue.</p>
        <a href="{{ url('install/pre-installation') }}" class="btn btn-primary" style="margin-top: 2rem;">Let's Go</a>
    </div>
</div>
@endsection