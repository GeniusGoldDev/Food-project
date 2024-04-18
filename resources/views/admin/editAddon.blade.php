@extends('admin.layouts.master')
@section("title") Edit Addon - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">Editing</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $addon->name }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.updateAddon') }}" method="POST" enctype="multipart/form-data">
                    <legend class="font-weight-semibold text-uppercase font-size-sm">
                        <i class="icon-list2 mr-2"></i> Addon Details
                    </legend>
                    <input type="hidden" name="id" value="{{ $addon->id }}">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Addon Name:</label>
                        <div class="col-lg-9">
                            <input value="{{ $addon->name }}" type="text" class="form-control form-control-lg" name="name"
                                placeholder="Addon Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Price:</label>
                        <div class="col-lg-9">
                            <input value="{{ $addon->price }}" type="text" class="form-control form-control-lg price" name="price"
                                placeholder="Addon Price in {{ config('appSettings.currencyFormat') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Addon's Category:</label>
                        <div class="col-lg-9">
                            <select class="form-control select-search select" name="addon_category_id" required>
                                @foreach ($addonCategories as $addonCategory)
                                <option value="{{ $addonCategory->id }}" class="text-capitalize" @if($addon->addon_category->id == $addonCategory->id) selected="selected" @endif >{{ $addonCategory->name }}</option>
                                @endforeach
                            </select>
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
</div>
<script>
    $(function () {
        $('.price').numeric({allowThouSep:false, maxDecimalPlaces: 2 });
        $('.select').select2();
    });
</script>
@endsection