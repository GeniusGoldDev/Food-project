@extends('install.layout.master')
@section('title')
License Verification
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
            height: 21rem;
            width: 100%;
            background-color: #fafafa;
            transform: translateY(0px);
            transition: 0.1s linear all;
        }
        .product-name {
            background-color: rgba(103, 59, 183, 20%);
            padding: 0 12px;
            border-radius: 5px;
            color: #000;
        }
    </style>
    <div class="col-lg-4 col-lg-offset-4 mt-5">

            <div class="thankyou-box">
                <h2>
                    License Verification
                </h2>

                <form action="{{ route('liVerPost') }}" method="POST" style="margin-top: 5rem;">
                    <input type="hidden" value="{{ $envato_id }}" name="envato_id">
                    <div class="form-group text-left">
                        <label>Purchase code for <span class="product-name"> {{ $productName }} </span></label>

                        @if($envato_id == "24534953")
                        <input class="form-control mt-2" @if($loc) value="6ca6296f-4b8b-4de3-9971-e252308cdb6f" @endif name="purchase_code" placeholder="Purchase Code for {{ $productName }}" style="margin-top: 1.5rem" type="text" autocomplete="new-name" required="required" @if($loc) readonly="readonly" @endif />
                        @if($loc)
                            <p class="text-danger">Purchase code is pre-added for local installation.</p>
                        @endif
                        @else
                        <input class="form-control mt-2" value="{{ old('purchase_code') }}" name="purchase_code" placeholder="Purchase Code for {{ $productName }}" style="margin-top: 1.5rem" type="text" autocomplete="new-name" required="required"/>
                        @endif
                        {!! $errors->first('purchase_code', '<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group text-left" style="margin-top: 3rem">
                        <label>Admin Password</label>
                        <input class="form-control mt-2" name="password" placeholder="Enter the Admin Password" style="margin-top: 1.5rem" type="password" autocomplete="new-password" required="required"/>
                        {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                    </div>
                    @csrf
                    <button class="btn btn-primary update-button" style="margin-top: 2rem;" type="submit">
                        Verify Now
                    </button>
                    
                </form>


                <div class="box error-msg">
                    {!! $errors->first('envato_id', '<p class="text-danger">:message</p>') !!}
                    <div class="text-danger">
                        @if(Session::has('message'))
                        {{ Session::get('message') }}
                        @endif
                        @if(Session::has('error'))
                        {{ Session::get('error') }}
                        @endif
                    </div>
                </div>

                <div class="warning-msg hidden" style="margin-top: 1.5rem">
                    <p class="text-danger">
                        Verification process can take upto 30 seconds.
                    </p>
                    <p class="text-danger">
                        <strong>
                            DONOT
                        </strong>
                        close or reload this window.
                    </p>
                </div>
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

                    $(this).attr('disabled', 'disabled');
                }
            });
        });
    </script>
    
@endsection
