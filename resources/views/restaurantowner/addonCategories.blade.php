@extends('admin.layouts.master')
@section("title") {{ __('storeDashboard.addonCategoriesTitle')}}
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                @if(empty($query))
                    <span class="font-weight-bold mr-2">{{ __('storeDashboard.total')}}</span>
                    <i class="icon-circle-right2 mr-2"></i>
                    <span class="font-weight-bold mr-2">{{ $count }}</span>
                @else
                <span class="font-weight-bold mr-2">{{ __('storeDashboard.total')}}</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $count }}</span>
                <br>
                <span class="font-weight-normal mr-2">{{ __('storeDashboard.sphResultFor')}} "{{ $query }}"</span>
                @endif
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <a class="btn btn-secondary btn-labeled btn-labeled-left" href="{{route('restaurant.newAddonCategory')}}">
                    <b><i class="icon-plus2"></i></b>
                     {{ __('storeDashboard.btnAddNewCat')}} 
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <form action="{{ route('restaurant.post.searchAddonCategories') }}" method="GET">
        <div class="form-group form-group-feedback form-group-feedback-right search-box">
            <input type="text" class="form-control form-control-lg search-input"
                placeholder="{{ __('storeDashboard.acpSearchPlaceHolder')}}" name="query">
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
                            <th>{{ __('storeDashboard.acpTableName')}}</th>
                            <th>{{ __('storeDashboard.acpTableType')}}</th>
                            <th>{{ __('storeDashboard.acpTableNOA')}}</th>
                            <th style="width: 15%">{{ __('storeDashboard.acpTableCA')}}</th>
                            <th class="text-center" style="width: 10%;"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($addonCategories as $addonCategory)
                        <tr>
                            <td>{{ $addonCategory->name }}</td>
                            <td>
                                @if($addonCategory->type == "SINGLE")
                                 <span class="btn btn-xs btn-info p-1">
                                {{__('storeDashboard.acpRowSingleSelection')}}
                                </span>
                                @endif
                                @if($addonCategory->type == "MULTI")
                                <span class="btn btn-xs btn-secondary p-1">
                                {{__('storeDashboard.acpRowMultipleSelection')}}
                                </span>
                                @endif
                            </td>
                            <td>{{ $addonCategory->addons_count }}</td>
                            <td>{{ $addonCategory->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <a href="{{ route('restaurant.editAddonCategory', $addonCategory->id) }}"
                                        class="btn btn-sm btn-primary"> {{__('storeDashboard.edit')}}</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $addonCategories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection