@extends('admin.layouts.master')
@section("title") Addon Categories - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                @if(empty($query))
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $count }} Addon Categories</span>
                @else
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $count }} Addon Categories</span>
                <br>
                <span class="font-weight-normal mr-2">Showing results for "{{ $query }}"</span>
                @endif
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
         <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
            <a class="btn btn-secondary btn-labeled btn-labeled-left" href="{{route('admin.newAddonCategory')}}">
                <b><i class="icon-plus2"></i></b>
                Add New Addon Category
            </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <form action="{{ route('admin.post.searchAddonCategories') }}" method="GET">
        <div class="form-group form-group-feedback form-group-feedback-right search-box">
            <input type="text" class="form-control form-control-lg search-input"
                placeholder="Search with addon category name" name="query">
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
                            <th>Name</th>
                            <th>Type</th>
                            <th>Limit</th>
                            <th>No. of Addons</th>
                            <th style="width: 15%">Created At</th>
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
                                    Single Selection
                                </span>
                                @endif
                                @if($addonCategory->type == "MULTI")
                                <span class="btn btn-xs btn-secondary p-1">
                                    Multiple Selection
                                </span>
                                @endif
                            </td>
                            <td>@if($addonCategory->type == "SINGLE") -- @else {{ $addonCategory->addon_limit }} @endif</td>
                            <td>{{ $addonCategory->addons_count }}</td>
                            <td>{{ $addonCategory->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified">
                                    <a href="{{ route('admin.editAddonCategory', $addonCategory->id) }}"
                                        class="btn btn-sm btn-primary"> Edit </a>
                                </div>
                                   </td>
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