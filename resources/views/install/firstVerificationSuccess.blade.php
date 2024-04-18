@extends('install.layout.master')
@section('title')
License Verification
@endsection
@section('custom-script-one')
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
<noscript>
    <img height="1" width="1" style="display:none" 
        src="https://www.facebook.com/tr?id=381717909185580&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
@endsection
@section('update')
<style>
    .main-col {
    display: none !important;
    }
    body {
    background-color: #fff;
    }
</style>
<div style="text-align: center; font-size: 1.2rem; margin-top: 6rem">
    <h2 class="text-muted mb-3">Redirecting. Please wait...</h2>
    <div class="loadingio-spinner-spin-e5o5ecjioon">
        <div class="ldio-77v4zut62w">
            <div>
                <div></div>
            </div>
            <div>
                <div></div>
            </div>
            <div>
                <div></div>
            </div>
            <div>
                <div></div>
            </div>
            <div>
                <div></div>
            </div>
            <div>
                <div></div>
            </div>
            <div>
                <div></div>
            </div>
            <div>
                <div></div>
            </div>
        </div>
    </div>
    <style type="text/css">
        @keyframes ldio-77v4zut62w{0%{opacity:1;backface-visibility:hidden;transform:translateZ(0) scale(1.5,1.5)}100%{opacity:0;backface-visibility:hidden;transform:translateZ(0) scale(1,1)}}.ldio-77v4zut62w div>div{position:absolute;width:24px;height:24px;border-radius:50%;background:#1d3f72;animation:ldio-77v4zut62w 1s linear infinite}.ldio-77v4zut62w div:nth-child(1)>div{left:148px;top:88px;animation-delay:-875ms}.ldio-77v4zut62w>div:nth-child(1){transform:rotate(0);transform-origin:160px 100px}.ldio-77v4zut62w div:nth-child(2)>div{left:130px;top:130px;animation-delay:-.75s}.ldio-77v4zut62w>div:nth-child(2){transform:rotate(45deg);transform-origin:142px 142px}.ldio-77v4zut62w div:nth-child(3)>div{left:88px;top:148px;animation-delay:-625ms}.ldio-77v4zut62w>div:nth-child(3){transform:rotate(90deg);transform-origin:100px 160px}.ldio-77v4zut62w div:nth-child(4)>div{left:46px;top:130px;animation-delay:-.5s}.ldio-77v4zut62w>div:nth-child(4){transform:rotate(135deg);transform-origin:58px 142px}.ldio-77v4zut62w div:nth-child(5)>div{left:28px;top:88px;animation-delay:-375ms}.ldio-77v4zut62w>div:nth-child(5){transform:rotate(180deg);transform-origin:40px 100px}.ldio-77v4zut62w div:nth-child(6)>div{left:46px;top:46px;animation-delay:-.25s}.ldio-77v4zut62w>div:nth-child(6){transform:rotate(225deg);transform-origin:58px 58px}.ldio-77v4zut62w div:nth-child(7)>div{left:88px;top:28px;animation-delay:-125ms}.ldio-77v4zut62w>div:nth-child(7){transform:rotate(270deg);transform-origin:100px 40px}.ldio-77v4zut62w div:nth-child(8)>div{left:130px;top:46px;animation-delay:0s}.ldio-77v4zut62w>div:nth-child(8){transform:rotate(315deg);transform-origin:142px 58px}.loadingio-spinner-spin-e5o5ecjioon{width:200px;height:200px;display:inline-block;overflow:hidden;background:#fff}.ldio-77v4zut62w{width:100%;height:100%;position:relative;transform:translateZ(0) scale(1);backface-visibility:hidden;transform-origin:0 0;opacity:0.3;}.ldio-77v4zut62w div{box-sizing:content-box}
    </style>
    <p class="text-muted">You will be automaitcally redirected in 3 seconds.</p>
</div>
<script>
    $(function() {
    	setTimeout(function() {
    		window.location.reload();
    	}, 2500);
    });
</script>
@endsection