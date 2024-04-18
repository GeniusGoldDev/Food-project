@extends('admin.layouts.master')
@section("title") Add Addon Category - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Add</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.saveNewAddonCategory') }}" method="POST" enctype="multipart/form-data" enctype="multipart/form-data">
                    <legend class="font-weight-semibold text-uppercase font-size-sm">
                        <i class="icon-tree6 mr-2"></i> New Addon Category
                    </legend>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Name:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="name"
                                placeholder="Addon Category Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Type:</label>
                        <div class="col-lg-9">
                            <select name="type" class="form-control form-control-lg select">
                                <option value="SINGLE"> Single Selection  </option>
                                <option value="MULTI"> Multiple Selection </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Description:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-lg" name="description"
                                placeholder="Short Description (50-80 characters)" >
                                <span class="help-text text-muted"> This will be disaplayed in the Items page while selecting Addon Categories</span>
                        </div>
                    </div>

                    <div id="addon" class="mt-4">
                        <legend class="font-weight-semibold text-uppercase font-size-sm hidden" id="addonsLegend">
                            <i class="icon-list2 mr-2"></i> Addons
                        </legend>
                    </div>

                    <a href="javascript:void(0)" onclick="add(this)" class="btn btn-secondary btn-labeled btn-labeled-left mt-3"> <b><i class="icon-plus22"></i></b>Add Addon</a>
                    @csrf
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                        SAVE
                        <i class="icon-database-insert ml-1"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
     $('body').tooltip({selector: '[data-popup="tooltip"]'});
     function add(data) {
        $('#addonsLegend').removeClass('hidden');
        var newAddon = document.createElement("div");
        newAddon.innerHTML ="<div class='form-group row'> <div class='col-lg-5'><input type='text' class='form-control  form-control-lg' placeholder='Addon Name' name='addon_names[]' required> </div> <div class='col-lg-5'> <input type='text' class='form-control  form-control-lg' name='addon_prices[]' placeholder='Addon Price'  required> </div> <div class='col-lg-2'><button class='remove btn btn-danger' data-popup='tooltip' data-placement='right' title='Remove Addon'><i class='icon-cross2'></i></button></div></div>";
        document.getElementById('addon').appendChild(newAddon);
    }

    $(function() {
        $('.select').select2({
            minimumResultsForSearch: -1,
        });

        $(document).on("click", ".remove", function() {
            $(this).tooltip('hide')
            $(this).parent().parent().remove();
        });
    });   
</script>

@endsection