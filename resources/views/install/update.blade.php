@extends('install.layout.master')
@section('title')
Update
@endsection

@section('update')
    <style>
         .main-col {
            display: none !important;
        }

        .hidden {
            display: none !important;
        }

        .update-messages {
            margin-top: 3rem;
        }

        .update-messages>p {
            margin-bottom: 1.5rem;
        }

        .update-messages>p>i {
            color: #673AB7;
            font-size: 2rem;
            margin-right: 1rem;
        }

        .message-overlay {
            position: absolute;
            height: 17rem;
            width: 100%;
            background-color: #fafafa;
            transform: translateY(0px);
            transition: 0.1s linear all;
        }
    </style>
    <div class="col-lg-4 col-lg-offset-4 mt-5">

        @if(!$extensionSatisfied)
            <div class="box">
                <p>Please make sure the PHP extensions listed below are installed.</p>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 100%;">Extensions</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($requirement->extensions() as $label => $satisfied)
                                @if(!$satisfied)
                                    <tr>
                                        <td>
                                            {{ $label }}
                                        </td>
                                        <td class="text-center">
                                            <i class="fa fa-{{ $satisfied ? 'check' : 'times' }}" aria-hidden="true"></i>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if(!$permissionSatisfied)
            <div class="box">
                <p>Please make sure you have set the correct permissions for the directories listed below. All these directories/files should be writable.</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 100%;">Directories</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($requirement->directories() as $label => $satisfied)
                                @if(!$satisfied)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td class="text-center">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if($requirement->satisfied())
            <div class="thankyou-box">
                <h2>
                    Update Available {{ $updateVersion }} 🔥
                </h2>
                <p>
                    This is the update wizard.
                </p>

                <form action="{{ url('install/update') }}" method="POST" style="margin-top: 5rem;">
                    <div class="form-group text-left" style="margin-top: 3rem">
                        <label>Admin Password</label>
                        <input class="form-control mt-2" name="password" placeholder="Enter the Admin Password" style="margin-top: 1.5rem" type="password" autocomplete="new-password" required="required"/>
                        {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                    </div>
                    @csrf
                    <button class="btn btn-primary update-button" style="margin-top: 2rem;" type="submit">
                        Update Now
                    </button>
                    
                </form>
                <div class="box error-msg">
                    <div class="text-danger">
                        @if(Session::has('message'))
                        {{ Session::get('message') }}
                        @endif
                    </div>
                </div>

                <div class="warning-msg hidden" style="margin-top: 1.5rem">
                    <p class="text-danger">
                        Update process can take upto 30 seconds.
                    </p>
                    <p class="text-danger">
                        <strong>
                            DONOT
                        </strong>
                        close or reload this window.
                    </p>
                </div>
            </div>
        @else
        <div class="text-left" style="margin-top: 5rem;">
            <strong>Fix the above issues and reload the page to update Foodomaa to {{ $updateVersion }}</strong>
        </div>
        @endif

        <div class="update-messages">
            <div class="message-overlay">
            </div>
            <p>
                <i class="fa fa-check-circle">
                </i>
                <span>
                    Migrating new tables...
                </span>
            </p>
            <p>
                <i class="fa fa-check-circle">
                </i>
                <span>
                    Populating new settings...
                </span>
            </p>
            <p>
                <i class="fa fa-check-circle">
                </i>
                <span>
                    Setting API routes...
                </span>
            </p>
            <p>
                <i class="fa fa-check-circle">
                </i>
                <span>
                    Clearing junk files...
                </span>
            </p>
            <p>
                <i class="fa fa-check-circle">
                </i>
                <span>
                    Adding some magic beans...just a sec...
                </span>
            </p>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("form").on("submit", function(e) {
               let invalid =  $('input:invalid');
               if (invalid.length == 0) {
                    var button = $('.update-button');
                     button
                         .css("pointer-events", "none")
                         .data("loading-text", button.html())
                         .addClass("btn-loading")
                         .button("loading");

                    $('.error-msg').remove();
                    $('.warning-msg').removeClass("hidden");

                    
                    setTimeout(() => {
                            console.log("Exec timeout")
                            let startTime = Date.now();
                            let count = 30;
                            let buffer = 0
                            var msgShowInterval = setInterval(() => {
                                if (Date.now() - startTime > 8000) { // run only for 8 seconds 
                                    clearInterval(msgShowInterval);
                                     return;
                                 }
                                console.log("Exec interval")
                                $('.message-overlay').css({
                                    'transform':'translateY('+count+'px)',
                                    'transition':'0.1s linear all'
                                });
                                buffer = buffer + 3
                                count = count + 30 + buffer;
                            }, 1500);
                        }, 2000)
                    $(this).attr('disabled', 'disabled');
                }
            });
        });
    </script>
    
@endsection
