@extends('admin.layouts.master')
@section("title") Roles and Permission Management - Dashboard
@endsection
@section('content')
<style>
    .assigning-checkboxes label {
    margin-right: 10px;
    background-color: rgba(250, 250, 250, 0.3);
    border-radius: 8px;
    margin-bottom: 1.2rem;
    }
    .assigning-checkboxes label:hover {
        cursor: pointer;
    }
    .assigning-checkboxes label span {
    text-align: center;
    display: block;
    padding: 4px 7.5px;
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    }
    .assigning-checkboxes label input {
    position: absolute;
    top: -20px;
    display: none;
    }
    .assigning-checkboxes input:checked + span {
    background-color: #2ebf91;
    padding: 8px 15px;
    color: #fff;
    border: 1px solid #e0e0e0;
    }
</style>
@if(count($roles) == 0)
<div class="d-flex justify-content-center my-5" id="noRoleFoundBlock">
    <div class="text-center">
        <h3>No custom roles created yet!</h3>
        <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2 text-center" id="addNewRole">
        <b><i class="icon-plus2"></i></b>
        Add New Role
        </button>
    </div>
</div>
@endif
<div class="content mt-5" id="createNewRoleBlock" style="display: none;">
    <div class="card">
        <div class="card-body">
            <legend class="font-weight-semibold text-uppercase font-size-sm">
                <i class="icon-collaboration mr-2"></i> New Role
            </legend>

            <form action="{{ route('admin.createNewRoleWithPermissions') }}" method="POST" enctype="multipart/form-data">
                
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label"><strong>Role name:</strong></label>
                    <div class="col-lg-10">
                        <input type="text" name="name" placeholder="Enter the role name. Example: Manager" required="required" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-9 col-form-label"><strong>Permissions:</strong></label>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left btn-sm" id="checkAll" data-popup="tooltip" title="Double Click to Check all Permissions" data-placement="top">
                        <b><i class="icon-check ml-1"></i></b>
                            Check All
                        </button>
                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-left btn-sm" id="unCheckAll" data-popup="tooltip" title="Double Click to Un-check all Permissions" data-placement="top">
                        <b><i class="icon-cross3 ml-1"></i></b>
                            Un-check All
                        </button>
                    </div>
                    <div class="assigning-checkboxes">
                        <div class="col-lg-12">
                            <div class="form-group form-group-feedback form-group-feedback-right search-box">
                                <input type="text" class="form-control form-control-lg search-input"
                                    placeholder="Filter with permission name..." style="border: 1px solid #ccc; box-shadow: none; height: 2.5rem;">
                                <div class="form-control-feedback form-control-feedback-lg">
                                    <i class="icon-search4"></i>
                                </div>
                            </div>

                            @foreach($permissions as $permission)
                            <label class="mr-2 mb-2">
                                <input type="checkbox" value="{{ $permission->name }}" name="permission[]">
                                <span>{{ $permission->readable_name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                @csrf

                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left btn-lg btnUpdateUser">
                    <b><i class="icon-database-insert ml-1"></i></b>
                    Save Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(count($roles) > 0)
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ count($roles) }} Custom Roles</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left" id="addNewRole">
                <b><i class="icon-plus2"></i></b>
                Add New Role
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
                            <th style="width: 180px">Role</th>
                            <th>Permissions</th>
                            <th class="text-center" style="width: 100px"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->permissions as $rolePermission)
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                    {{ $rolePermission->readable_name }}
                                </span>
                                @endforeach
                            </td>
                            
                            <td class="text-center">
                                <div class="btn-group btn-group-justified align-items-center">
                                <a href="{{ route('admin.editRoleAndPermissions', $role->id) }}" class="btn btn-sm btn-primary"> Edit</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endif

<script>
    $(function() {
        $('.assigning-checkboxes label').each(function(){
            $(this).attr('data-name', $(this).text().toLowerCase());
        });

        $('.search-input').on('keyup', function(){
        var searchTerm = $(this).val().toLowerCase();
            $('.assigning-checkboxes label').each(function(){
                if ($(this).filter('[data-name *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('#addNewRole').click(function(event) {
            $('#createNewRoleBlock').toggle(500);
            $('#noRoleFoundBlock').remove();
        });
        $('#checkAll').dblclick(function(event) {
            $("input:checkbox").prop("checked", true);
        });
        $('#unCheckAll').dblclick(function(event) {
            $("input:checkbox").prop("checked", false);
        });
    });
</script>
@endsection