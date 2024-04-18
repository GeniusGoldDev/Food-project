@extends('admin.layouts.master')
@section("title") Users - Dashboard
@endsection
@section('content')
<style>
    #showPassword {
    cursor: pointer;
    padding: 5px;
    border: 1px solid #E0E0E0;
    border-radius: 0.275rem;
    color: #9E9E9E;
    }
    #showPassword:hover {
    color: #616161;
    }
</style>


<div class="content mt-3">
    <div class="d-flex justify-content-between my-2">
        <h3><strong> <i class="icon-circle-right2 mr-2"></i>  All Users</strong></h3>
        <div>
            <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2" id="addNewUser"
                data-toggle="modal" data-target="#addNewUserModal">
            <b><i class="icon-plus2"></i></b>
            Add New User
            </button>
            <a href={{ route('admin.rolesManagement') }} class="btn btn-secondary btn-labeled btn-labeled-left mr-2">
            <b><i class="icon-collaboration"></i></b>
            Manage Roles and Permissions
            </a>
            <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left" id="clearFilterAndState"> <b><i class=" icon-reload-alt"></i></b> Reset All Filters</button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-striped" id="usersDatatable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>{{ config('appSettings.walletName') }}</th>
                            <th>Created Date</th>                            
                            <th class="text-center"><i class="
                                icon-circle-down2"></i></th>
                            <th>Del</th>    
                        </tr> 
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="addNewUserModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">Add New User</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route("admin.saveNewUser") }}" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name:</label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control form-control-lg"
                                placeholder="Enter Full Name" required autocomplete="new-name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email:</label>
                        <div class="col-lg-9">
                            <input type="text" name="email" class="form-control form-control-lg"
                                placeholder="Enter Email Address" required autocomplete="new-email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Phone:</label>
                        <div class="col-lg-9">
                            <input type="text" name="phone" class="form-control form-control-lg"
                                placeholder="Enter Phone Number" required autocomplete="new-phone">
                        </div>
                    </div>
                    <div class="form-group row form-group-feedback form-group-feedback-right">
                        <label class="col-lg-3 col-form-label">Password:</label>
                        <div class="col-lg-9">
                            <input name="password" type="password" class="form-control form-control-lg" placeholder="Enter Password (min 6 characters)" required
                                autocomplete="new-password" id="newUserPassword">
                        </div>
                        <div class="form-control-feedback form-control-feedback-lg">
                            <span id="showPassword"><i class="icon-unlocked2"></i> Show</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Role:</label>
                        <div class="col-lg-9">
                            <select name="role" class="form-control select" data-fouc>
                                @foreach ($roles->reverse() as $role)
                                <option value="{{ $role->name }}" class="text-capitalize">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="deliveryGuyDetails" class="hidden">
                        <legend class="font-weight-semibold text-uppercase font-size-sm">
                            <i class="icon-truck mr-2"></i> Delivery Guy Details
                        </legend>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Name or Nick Name:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="delivery_name" placeholder="Enter Name or Nickname of Delivery Guy"
                                    autocomplete="new-name">
                                    <span class="help-text text-muted">This name will be displayed to the user/customers</span>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Age</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="delivery_age" placeholder="Enter Delivery Guy's Age">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Delivery Guy's Photo:</label>
                            <div class="col-lg-9">
                                <input type="file" class="form-control-uniform" name="delivery_photo" data-fouc>
                                <span class="help-text text-muted">Image size 250x250</span>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Description</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="delivery_description" placeholder="Enter Short Description about this Delivery Guy">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Vehicle Number</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="delivery_vehicle_number" placeholder="Enter Delivery Guy's Vehicle Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Commission Rate %</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg commission_rate" name="delivery_commission_rate" placeholder="Commission Rate % (By detault, it's set to 5%)" value="5" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tip Commission Rate %</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg tip-commission_rate" name="tip_commission_rate" placeholder="Commission Rate % (By detault, it's set to 5%)" value="100" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                        SAVE
                        <i class="icon-database-insert ml-1"></i></button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.form-control-uniform').uniform();

        $("#showPassword").click(function (e) { 
            $("#newUserPassword").attr("type", "text");
        });
    
        $('.select').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Select Role/s (Old roles will be revoked and these roles will be applied)',
        });

         $("[name='role']").change(function(event) {
            if ($(this).val() == "Delivery Guy") {
                $('#deliveryGuyDetails').removeClass('hidden');
                $("[name='delivery_name']").attr('required', 'required');
            }
            else {
                $('#deliveryGuyDetails').addClass('hidden');
                $("[name='delivery_name']").removeAttr('required')
            }
        });
        
        $('.commission_rate').numeric({ allowThouSep:false, maxDecimalPlaces: 2, max: 100, allowMinus: false });

        $('body').tooltip({selector: '[data-popup="tooltip"]'});
         var datatable = $('#usersDatatable').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            lengthMenu: [ 10, 25, 50, 100, 200, 500 ],
            order: [[ 0, "desc" ]],
            ajax: '{{ route('admin.usersDatatable') }}',
            columns: [
                {data: 'id', visible: false, searchable: false},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'role', sortable: false, name: 'roles.name'},
                {data: 'wallet', sortable: false, searchable: false,},
                {data: 'created_at'},
                {data: 'action', sortable: false, searchable: false},
                {data: 'delete'},
       
            ],
            colReorder: true,
            drawCallback: function( settings ) {
                $('select').select2({
                   minimumResultsForSearch: Infinity,
                   width: 'auto'
                });
            },
            scrollX: true,
            scrollCollapse: true,
            dom: '<"custom-processing-banner"r>flBtip',
            language: {
                search: '_INPUT_',
                searchPlaceholder: 'Search with anything...',
                lengthMenu: '_MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
                processing: '<i class="icon-spinner10 spinner position-left mr-1"></i>Waiting for server response...'
            },
           buttons: {
                   dom: {
                       button: {
                           className: 'btn btn-default'
                       }
                   },
                   buttons: [
                       {extend: 'csv', filename: 'users-'+ new Date().toISOString().slice(0,10), text: 'Export as CSV'},
                   ]
               }
        });

         $('#clearFilterAndState').click(function(event) {
            if (datatable) {
                datatable.state.clear();
                window.location.reload();
            }
         });
        
         $(document).on('click', '.btn-delete', function(event){
            event.preventDefault();
            var r = confirm("Do you really want to delete this user?");
            if(r == true){
                    console.log("Delete Clicked");
                    let id = $(this).attr("data-id")
                    let url = "{{ url('/admin/user/delete/') }}/"+id;
                    let userUrl ="{{ url('/admin/users/') }}";
                    let self = $(this);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON',
                    })
                    .done(function(data) {
                        console.log(data);
                        console.log(self);
                        window.location.href= userUrl;
                        $.jGrowl("", {
                            position: 'bottom-center',
                            header: 'User Delete Successful ✅',
                            theme: 'bg-success',
                            life: '2000'
                        }); 
                    })
                    .fail(function(data) {
                        console.log(data);
                        $.jGrowl("", {
                            position: 'bottom-center',
                            header: 'Something went wrong, please try again.',
                            theme: 'bg-danger',
                            life: '1800'
                        }); 
                    })
                }   
            
         
         });
         
    });

</script>
@endsection