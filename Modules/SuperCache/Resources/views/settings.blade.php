@extends('admin.layouts.master')
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">Modules</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">SuperCache Settings</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <a href="{{ route('supercache.purgeCache', "everything") }}"
                class="btn btn-danger btn-labeled btn-labeled-left">
                <b><i class="icon-cross"></i></b>
                Purge Everything
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Stores Cache</strong></td>
                            <td>Stores attributes, Active/Inactive Stores(Delivery/Selfpickup)</td>
                            <td class="text-center">
                                @if($storesCacheKeys)
                                <span class="badge badge-success border-grey-800 text-white text-capitalize" style="min-width: 100px;"><i class="icon-database-check mr-1"></i> Cached </span>
                                @else
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize" style="min-width: 100px;"><i class="icon-database-remove mr-1"></i> Not Cached </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Items Cache</strong></td>
                            <td>Recommended items, Items listing with menu categories</td>
                            <td class="text-center">
                                @if($itemsCacheKeys)
                                <span class="badge badge-success border-grey-800 text-white text-capitalize" style="min-width: 100px;"><i class="icon-database-check mr-1"></i> Cached </span>
                                @else
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize" style="min-width: 100px;"><i class="icon-database-remove mr-1"></i> Not Cached </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Languages Cache</strong></td>
                            <td>All langauge info with translation data</td>
                            <td class="text-center">
                                @if($languagesCacheKeys)
                                <span class="badge badge-success border-grey-800 text-white text-capitalize" style="min-width: 100px;"><i class="icon-database-check mr-1"></i> Cached </span>
                                @else
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize" style="min-width: 100px;"><i class="icon-database-remove mr-1"></i> Not Cached </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Sliders Cache</strong></td>
                            <td>All sliders info with slides images and data (Promo Sliders/Store Category Sliders)</td>
                            <td class="text-center">
                                @if($slidersCacheKeys)
                                <span class="badge badge-success border-grey-800 text-white text-capitalize" style="min-width: 100px;"><i class="icon-database-check mr-1"></i> Cached </span>
                                @else
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize" style="min-width: 100px;"><i class="icon-database-remove mr-1"></i> Not Cached </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>App Settings Cache</strong></td>
                            <td>Customer/Delivery Application settings/keys/colors/images</td>
                            <td class="text-center">
                                @if($settingsCacheKeys)
                                <span class="badge badge-success border-grey-800 text-white text-capitalize" style="min-width: 100px;"><i class="icon-database-check mr-1"></i> Cached </span>
                                @else
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize" style="min-width: 100px;"><i class="icon-database-remove mr-1"></i> Not Cached </span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection