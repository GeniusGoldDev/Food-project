<!DOCTYPE html>
<html lang="{{ app()->getLocale()}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/images/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32"
            href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16"
            href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/images/favicons/favicon-16x16.png">
        <title>@yield("title")</title>
        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
            type="text/css">
        <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet"
            type="text/css">
        <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/bootstrap.min.css?v=2.8.2-BUILD-01" rel="stylesheet" type="text/css">
        <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/combined.min.css" rel="stylesheet" type="text/css">
        <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/layout.min.css" rel="stylesheet" type="text/css">
        <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/components.min.css?v=2.8.2-BUILD-01" rel="stylesheet" type="text/css">
        <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/colors.min.css" rel="stylesheet" type="text/css">
        <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/css/extras/animate.min.css" rel="stylesheet"
            type="text/css">
        <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/backend-custom.css?v=2.4.1" rel="stylesheet"
            type="text/css">
        <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/bootstrap-material-datetimepicker.css" rel="stylesheet" type="text/css">

        <link type="text/css" href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/OverlayScrollbars.min.css" rel="stylesheet"/>
        <!-- /global stylesheets -->

        
        <!-- Core JS files -->
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/main/jquery.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

        
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/js/jquery.overlayScrollbars.min.js"></script>
        
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets//js/plugins/ui/moment/moment.min.js"></script>


        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/main/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/loaders/blockui.min.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/ui/slinky.min.js"></script>
        <!-- /core JS files -->
        <!-- Theme JS files -->
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/ui/sticky.min.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/buttons/spin.min.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/buttons/ladda.min.js"></script>

        @if(!Request::is('admin/dashboard'))
            <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/notifications/jgrowl.min.js"></script>
            <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/forms/selects/select2.min.js"></script>
            <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
            <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
            <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/pickers/color/spectrum.js"></script>
            <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/editors/summernote/summernote.js"></script>
            <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/pickers/daterangepicker.js"></script>
            <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
        @endif
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106310733-1"></script>
        <script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-106310733-1'); gtag('evaluation', window.location.hostname);</script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/tables/datatables/extensions/fixed_columns.min.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/tables/datatables/extensions/col_reorder.min.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>

        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/visualization/echarts/echarts.js" defer></script>

        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/js/app.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/js/navbar-sticky.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/js/printThis.js"></script>
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/js/jquery-alphanum.js"></script>
        @if(Request::is('admin/settings'))
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/editors/ace/ace.js"></script>
        @endif 
        
        <script type="text/javascript" src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/js/bootstrap-material-datetimepicker.js"></script>
        <!-- /theme JS files -->
    </head>
    <body>
        @if(!Request::is('auth/*'))
            @include("admin.includes.header")
        @endif
        <div class="page-content container pt-0">
            <div class="content-wrapper">
                @yield("content")
            </div>
        </div>
        @if(!(Request::is('auth/delivery-registration') || Request::is('auth/store-registration') || Request::is('auth/forgot-password')))
        @include('admin.includes.notification')
        @endif
        <script>
            $(function() {
                $('form').submit(function(){
                    $(this).find(':input[type=submit]').prop('disabled', true);
                });
                $('.note-codable').on('blur', function() {
                  var codeviewHtml        = $(this).val();
                  var $summernoteTextarea = $(this).closest('.note-editor').siblings('textarea');
                  $summernoteTextarea.val(codeviewHtml);
                 });
            });
        </script>
    </body>
</html>