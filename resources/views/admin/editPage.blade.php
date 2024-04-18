@extends('admin.layouts.master')
@section("title") Edit Page - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Editing</span>
                <span class="badge badge-primary badge-pill animated flipInX">"{{ $page->name }}"</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.updatePage') }}" method="POST" enctype="multipart/form-data">
                    <legend class="font-weight-semibold text-uppercase font-size-sm">
                        <i class="icon-address-book mr-2"></i> Page Details
                    </legend>
                    <input type="hidden" name="id" value="{{ $page->id }}">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Page Name:</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="Page Name" required value="{{ $page->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Slug:</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control form-control-lg" name="slug"
                                placeholder="page-url-like-this" required value="{{ $page->slug }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><strong>Page Content:</strong></label>
                        <div class="col-lg-12">
                            <textarea class="summernote-editor" name="body" rows="6">{{ $page->body }}</textarea>
                        </div>
                    </div>
                    @csrf
                    <div class="text-left">
                        <div class="btn-group btn-group-justified" style="width: 225px">    
                            <a class="btn btn-danger text-white" data-toggle="modal" data-target="#deletePageConfirmModal" id="deleteRestaurantButton">
                            DELETE
                            <i class="icon-trash ml-1"></i>
                            </a>
                        </div>
                    </div>
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
<div id="deletePageConfirmModal" class="modal fade mt-5" tabindex="-1">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">Are you sure?</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-footer mt-4">
                    <a href="{{ route('admin.deletePage', $page->id) }}" class="btn btn-primary">Yes</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.select').select2({
            minimumResultsForSearch: Infinity,
        });
    
      if (Array.prototype.forEach) {
               var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery-primary'));
               elems.forEach(function(html) {
                   var switchery = new Switchery(html, { color: '#2196F3' });
               });
           }
           else {
               var elems = document.querySelectorAll('.switchery-primary');
               for (var i = 0; i < elems.length; i++) {
                   var switchery = new Switchery(elems[i], { color: '#2196F3' });
               }
           }
    
       $('.form-control-uniform').uniform();
       $('.summernote-editor').summernote({
               height: 300,
               popover: {
                   image: [
                      ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                      ['float', ['floatLeft', 'floatRight', 'floatNone']],
                      ['remove', ['removeMedia']]
                    ],
                   link: [
                      ['link', ['linkDialogShow', 'unlink']]
                    ],
                   table: [
                      ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                      ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    ]
                 }
        });
    });
</script>
@endsection