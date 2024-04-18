@extends('install.layout.master') 
@section('title')
Pre-Installation
@endsection
@section('content')
<style>
    .text-danger {
        color: #f44336;
    }
</style>
<h2>1. Pre-Installation </h2>

<div class="box">
    <p>Please make sure the PHP extensions listed below are installed.</p>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 100%;">Extensions</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($requirement->extensions() as $label => $satisfied)
                <tr>
                    <td>
                        {{ $label }}
                        @if($label == "PHP = 7.2.x" && !$satisfied)
                            <br>
                            <span class="text-danger"><b>PHP Version must be 7.2 (or 7.2.x)
                            <br>
                            <a href="https://docs.foodomaa.com/installation/installation-on-server#requirements" target="_blank"> Learn More </a></span>
                        @endif
                    </td>
                    <td class="text-center">
                        <i class="fa fa-{{ $satisfied ? 'check' : 'times' }}" aria-hidden="true"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="box">
    <p>Please make sure you have set the correct permissions for the directories listed below. All these directories/files should be writable.</p>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 100%;">Directories</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($requirement->directories() as $label => $satisfied)
                <tr>
                    <td>{{ $label }}</td>
                    <td class="text-center">
                        <i class="fa fa-{{ $satisfied ? 'check' : 'times' }}" aria-hidden="true"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="content-buttons clearfix">
    <a href="{{ $requirement->satisfied() ? url('install/configuration') : '#' }}" class="btn btn-primary pull-right" {{ $requirement->satisfied() ? '' : 'disabled' }}>
            Continue
        </a>
</div>
@endsection