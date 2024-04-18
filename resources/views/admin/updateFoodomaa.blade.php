@extends('admin.layouts.master')
@section("title") Update Foodomaa - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Foodomaa Updater</span>
                @if($versionMsg != null)
                <span class="badge badge-primary badge-pill animated flipInX mr-2">{{ $versionMsg }}</span>
                @endif
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.uploadUpdateZipFile') }}" enctype="multipart/form-data"  class="dropzone" id="foodomaa_uploader">
                @csrf
            </form>
            {{-- <button class="btn btn-lg btn-primary" id="uploadFile">UPLOAD</button> --}}
        </div>
    </div>
</div>
<div id="updateNowModal" class="modal fade mt-5" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">New version is ready to be installed ✅</span></h5>
            </div>
            <div class="modal-body">
                <span class="help-text">
                <br>
                This process generally takes
                <b> 40-60s </b>
                <br>You will be automatically redirected after the update is completed.
                </span>
                <div class="mt-4">
                    <button onClick="location.href='{{ route('admin.updateFoodomaaNow') }}'" class="btn btn-primary btn-lg btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#fff" data-spinner-size="20" id="btnUpdateNowConfirm" data-spinner-lines="9" style="width: 100%; height: 3rem; font-size: 1.1rem;">Update Now</button>
                </div>
                <div id="updateMessage" class="hidden mt-0">
                    <br>
                    <span class="text-warning"><b>Do Not Close This Window (Or Click The Back Button)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    Dropzone.autoDiscover = false;
    $(function() {
        
       var myDropzone =  $("#foodomaa_uploader").dropzone({
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 50, // MB
        maxFiles: 1,
        dictDefaultMessage: 'Drag & Drop <h3><strong>UPLOAD-THIS.zip</strong></h3> <span>file from <b class="text-danger"> "Update from older version" </b> folder.</span>',
        autoProcessQueue: false,
        acceptedFiles: '.zip',
        init: function() {
            this.on('addedfile', function(file){
                if (this.fileTracker) {
                this.removeFile(this.fileTracker);
            }
                this.fileTracker = file;
            });
    
            var dropzone = this;
    
            //when file added or dropped, process the file for auto-upload
            dropzone.on("addedfile", function(file) {
                if (file.name == "UPLOAD-THIS.zip") {
                    $.jGrowl("Uploading file please wait...", {
                        position: 'bottom-center',
                        header: 'File Added ✅',
                        theme: 'bg-success',
                        life: '1800'
                    }); 
                    setTimeout(function() {
                        dropzone.processQueue();
                    }, 2200);
                }
            });
    
            //on upload success to server's filesystem, show popup
            dropzone.on("success", function(file) {
                setTimeout(function() {
                    dropzone.removeFile(file);
                    $('#updateNowModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }, 500);
                
            });
            //if anything goes wrong during upload, show error message and remove file
            dropzone.on("error", function(file, errorMessage, xhr) {
                dropzone.removeFile(file);
                console.log(errorMessage);
                $.jGrowl("Server Error. Check the console for full log.", {
                    position: 'bottom-center',
                    header: 'Wooopsss ⚠️',
                    theme: 'bg-warning',
                    life: '5000'
                }); 
            });
        },
        accept: function(file, done) {
            //if file name is UPLOAD-THIS.zip then accept the file
            if (file.name == "UPLOAD-THIS.zip") {
                done();
            }
            else {
                //else remove the file and show error message
                this.removeFile(file);
                $(function () {
                    alert("This seems to be an incorrect file. Please get the 'UPLOAD-THIS.zip' file from inside the ''Update from older version' folder.")
                    $.jGrowl("This seems to be an incorrect file. Please get the 'UPLOAD-THIS.zip' file from inside the ''Update from older version' folder.", {
                        position: 'bottom-center',
                        header: 'Wooopsss ⚠️',
                        theme: 'bg-warning',
                        life: '5000'
                    });    
                });
                done();
            }
        },
        success: function(file, response) 
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
    });
    
    $('#btnUpdateNowConfirm').click(function () {
        $('#updateMessage').removeClass('hidden');
    });
    
    Ladda.bind('#btnUpdateNowConfirm', { timeout: 9999999999 } );
    
    });
</script>
@endsection