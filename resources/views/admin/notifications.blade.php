@extends('admin.layouts.master')
@section("title") Send Notifications - Dashboard
@endsection
@section('content')
<style>
    .dropzone {
    border: 2px dotted #EEEEEE !important;
    }
</style>
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-1">{{ count($users) }} Users</span>
                <i class="icon-question3" data-popup="tooltip" title="These are total registered users on your websites who can receives only Alerts messages." data-placement="top"></i>
                <br>
                <span class="font-weight-bold mr-2">TOTAL</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-1">{{ $subscriberCount }} Subscribers</span>
                <i class="icon-question3" data-popup="tooltip" title="These are total registered push notification subscribed users on your websites who can receives only Alerts and Push Notifications messages." data-placement="top"></i>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-muted mb-3"><strong>Send push notification & alert to all users</strong></h3>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Notification Image: </label>
                        <div class="col-lg-9">
                            <img class="slider-preview-image hidden"/>
                            <div class="uploader">
                                <form method="POST" action="{{ route('admin.uploadNotificationImage') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfToken">
                                </form>
                                <span class="help-text text-muted">Image size: 1600x1100</span>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('admin.sendNotifiaction') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Notification Title:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="data[title]"
                                    placeholder="Notification Title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Message:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="data[message]"
                                    placeholder="Notification Message" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">URL:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="data[click_action]"
                                    placeholder="This link will be opened when the notification is clicked">
                            </div>
                        </div>
                        <input type="hidden" name="data[badge]" value="/assets/img/favicons/favicon-96x96.png">
                        <input type="hidden" name="data[icon]" value="/assets/img/favicons/favicon-512x512.png">
                        <input type="hidden" name="data[image]" value="" class="notificationImage">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left">
                            <b><i class="icon-paperplane"></i></b>
                            SEND
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if($countJunkData > 0)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-muted mb-3"><strong>Junk data count <strong class="text-warning">{{ $countJunkData }}</strong></strong></h3>
                    
                    <p class="text-muted mb-3">Alters older than 7 days are not shown to the users and hence are of no use. Clicking on the below button will only delete <b>{{ $countJunkData }} Alerts data</b> which are older than 7 days.</p>

                    <button class="btn btn-danger btn-md float-right" onclick="confirmDelete()">Delete Junk Data</button>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-muted mb-3"><strong>Send push notification & alert to selected users</strong></h3>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Notification Image: </label>
                        <div class="col-lg-9">
                            <img class="slider-preview-image hidden"/>
                            <div class="uploader">
                                <form method="POST" action="{{ route('admin.uploadNotificationImage') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrfToken">
                                </form>
                                <span class="help-text text-muted">Image size: 1600x1100</span>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('admin.sendNotificationToSelectedUsers') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Select Users:</label>
                            <div class="col-lg-9">
                                <select multiple="multiple" class="form-control select" data-fouc name="users[]" required="required">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" class="text-capitalize">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Notification Title:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="data[title]"
                                    placeholder="Notification Title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Message:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="data[message]"
                                    placeholder="Notification Message" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">URL:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" name="data[click_action]"
                                    placeholder="This link will be opened when the notification is clicked">
                            </div>
                        </div>
                        <input type="hidden" name="data[badge]" value="/assets/img/favicons/favicon-96x96.png">
                        <input type="hidden" name="data[icon]" value="/assets/img/favicons/favicon-512x512.png">
                        <input type="hidden" name="data[image]" value="" class="notificationImage">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left">
                            <b><i class="icon-paperplane"></i></b>
                            SEND
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function readURL(input) {
       if (input.files && input.files[0]) {
           let reader = new FileReader();
           reader.onload = function (e) {
               $('.slider-preview-image')
                   .removeClass('hidden')
                   .attr('src', e.target.result)
                   .width(300)
           };
           reader.readAsDataURL(input.files[0]);
       }
    }
    

    $(function() {
       $('.form-control-uniform').uniform();

       $('.select').select2({
           minimumResultsForSearch: Infinity,
           placeholder: 'Select Users',
       });

    });

    @if($subscriberCount == 0)
        $.jGrowl("There are no subscribers to send push notifications.", {
            position: 'bottom-center',
            header: 'Wooopsss ⚠️',
            theme: 'bg-warning',
            life: '5000'
        }); 
    @endif
</script>
<script type="text/javascript">
    Dropzone.options.dropzone =
     {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        removedfile: function(file) 
        {
           $('.notificationImage').attr('value', "");
            var fileRef;
            return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) 
        {
            console.log(response.success);
            $('.notificationImage').attr('value', '/assets/img/various/' +response.success);
        },
        error: function(file, response)
        {
           return false;
        }
    };

    function confirmDelete()
    {
          var r = confirm("Are you sure? This action is irreversible!");
          if (r == true) {
            let url = "{{ url('admin/delete-alerts-junk') }}";
            window.location.href = url;
          }
    }
</script>
@endsection