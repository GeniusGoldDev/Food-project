@extends('install.layout.master')
@section('title')
Completed
@endsection
@section('content')
<div class="box">
    <div class="installation-message text-center">
        <i class="fa fa-check-circle-o" aria-hidden="true"></i>
        <h3>Installation Successful</h3>
    </div>
    <div class="clearfix"></div>
    <div class="visit-wrapper text-center clearfix">
        <div class="row">
            <div class="col-sm-6">
                <div class="visit text-center">
                    <div class="icon">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                    </div>
                    <a href="{{ substr(url("/"), 0, strrpos(url("/"), '/')) }}" class="btn btn-primary" target="_blank">Home Page</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="visit text-center">
                    <div class="icon">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </div>
                    {{-- later change it to route to admin dashboard --}}
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" target="_blank">Admin Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("custom-script-one")
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '381717909185580');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=381717909185580&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5QV6BDV');</script>
<!-- End Google Tag Manager -->
@endsection
@section("custom-script-two")
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5QV6BDV"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@endsection