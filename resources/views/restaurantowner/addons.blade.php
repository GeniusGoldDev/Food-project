@extends('admin.layouts.master')
@section("title") {{__('storeDashboard.addonPageTitle')}}
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
                <span class="font-weight-normal mr-2">{{__('storeDashboard.sphResultsFor')}} "{{ $query }}"</span>
                @endif
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2" id="addNewAddon"
                    data-toggle="modal" data-target="#addNewAddonModal">
                <b><i class="icon-plus2"></i></b>
                {{__('storeDashboard.btnAddNewAddon')}} 
                </button>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <form action="{{ route('restaurant.post.searchAddons') }}" method="GET">
        <div class="form-group form-group-feedback form-group-feedback-right search-box">
            <input type="text" class="form-control form-control-lg search-input"
                placeholder="{{__('storeDashboard.apSearchPlaceHolder')}}" name="query">
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
                            <th>{{__('storeDashboard.apTableName')}}</th>
                            <th>{{__('storeDashboard.apTablePrice')}}</th>
                            <th>{{__('storeDashboard.apTableAddonCategory')}}</th>
                            <th style="width: 15%">{{__('storeDashboard.apTableCreatedAt')}}</th>
                            <th class="text-center" style="width: 10%;"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($addons as $addon)
                        <tr>
                            <td>{{ $addon->name }}</td>
                            <td>{{ $addon->price }}</td>
                            <td>{{ $addon->addon_category->name }}</td>
                            <td>{{ $addon->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified align-items-center">
                                    <a href="{{ route('restaurant.editAddon', $addon->id) }}"
                                        class="btn btn-sm btn-primary"> {{__('storeDashboard.edit')}}</a>
                                    <div class="checkbox checkbox-switchery ml-1" style="padding-top: 0.8rem;">
                                        <label>
                                        <input value="true" type="checkbox" class="action-switch"
                                        @if($addon->is_active) checked="checked" @endif data-id="{{ $addon->id }}">
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $addons->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="addNewAddonModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">{{__('storeDashboard.btnAddNewAddon')}}</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('restaurant.saveNewAddon') }}" method="POST" enctype="multipart/form-data" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.apInputName')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="{{__('storeDashboard.apInputNamePH')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.apInputPrice')}}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg price" name="price"
                                placeholder="{{__('storeDashboard.apInputPricePH')}} {{ config('appSettings.currencyFormat') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.apInputAddonCategory')}}:</label>
                        <div class="col-lg-9">
                            <select class="form-control select-search select" name="addon_category_id" required>
                                @foreach ($addonCategories as $addonCategory)
                                <option value="{{ $addonCategory->id }}" class="text-capitalize">{{ $addonCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @csrf
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                        {{__('storeDashboard.save')}}
                        <i class="icon-database-insert ml-1"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.select').select2();
         $('.price').numeric({allowThouSep:false, maxDecimalPlaces: 2 });
         //Switch Action Function
         if (Array.prototype.forEach) {
                var elems = Array.prototype.slice.call(document.querySelectorAll('.action-switch'));
                elems.forEach(function(html) {
                    var switchery = new Switchery(html, { color: '#8360c3' });
                });
            }
            else {
                var elems = document.querySelectorAll('.action-switch');
                for (var i = 0; i < elems.length; i++) {
                    var switchery = new Switchery(elems[i], { color: '#8360c3' });
                }
            }

          $('.action-switch').click(function(event) {
             let id = $(this).attr("data-id")
             let url = "{{ url('/store-owner/addon/disable/') }}/"+id;
             window.location.href = url;
          });
    });
</script>
@endsection