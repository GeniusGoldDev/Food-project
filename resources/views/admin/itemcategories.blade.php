@extends('admin.layouts.master')
@section("title") Item Categories - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $count }} Menu Categories</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left"
                    data-toggle="modal" data-target="#addNewItemCategory">
                <b><i class="icon-plus2"></i></b>
                Add New Category
                </button>
            </div>
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
                            <th>Category ID</th>
                            <th>Name</th>
                            <th>No of Items</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th class="text-center"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemCategories as $itemCategory)
                        <tr>
                            <td>{{ $itemCategory->id }}</td>
                            <td>{{ $itemCategory->name }}</td>
                            <td>{{ $itemCategory->items_count }}</td>
                            <td><span class="badge badge-flat border-grey-800 text-default text-capitalize">@if($itemCategory->is_enabled) ENABLED @else DISABLED @endif</span></td>
                            <td>
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                @if($itemCategory->user !== NULL)
                                {{ $itemCategory->user->name }}
                                @else
                                Admin
                                @endif
                                </span>
                            </td>
                            <td>{{ $itemCategory->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-justified align-items-center">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#editItemCategory" data-catid="{{ $itemCategory->id }}" data-catname="{{ $itemCategory->name }}" class="btn btn-sm btn-primary editItemCategory"> Edit</a>
                                <div class="checkbox checkbox-switchery ml-1" style="padding-top: 0.8rem;">
                                    <label>
                                    <input value="true" type="checkbox" class="action-switch"
                                    @if($itemCategory->is_enabled) checked="checked" @endif data-id="{{ $itemCategory->id }}">
                                    </label>
                                </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="addNewItemCategory" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">Add New Item Category</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.createItemCategory') }}" method="POST">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="Enter Category Name" required>
                        </div>
                    </div>
                    @csrf
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                        SAVE
                        <i class="icon-database-insert ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="editItemCategory" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">Edit Item Category Name</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.updateItemCategory') }}" method="POST">
                    <input type="hidden" name="id" id="itemCatId">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="Enter Category Name" required id="itemCatName">
                        </div>
                    </div>
                    @csrf
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                        SAVE
                        <i class="icon-database-insert ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.editItemCategory').click(function(event) {
            $('#itemCatId').val($(this).data("catid"));
            $('#itemCatName').val($(this).data("catname"));
        });
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
            let url = "{{ url('/admin/itemcategory/disable/') }}/"+id;
            window.location.href = url;
         });
    });
</script>
@endsection