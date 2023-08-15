<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">--}}
{{--    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">--}}
{{--    <style>--}}
{{--        * {--}}
{{--            font-family: Arial, serif;--}}
{{--            color:black;--}}
{{--        }--}}
{{--    </style>--}}

    <style>
        /*! CSS Used from: https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css */
        :root{--bs-blue:#0d6efd;--bs-indigo:#6610f2;--bs-purple:#6f42c1;--bs-pink:#d63384;--bs-red:#dc3545;--bs-orange:#fd7e14;--bs-yellow:#ffc107;--bs-green:#198754;--bs-teal:#20c997;--bs-cyan:#0dcaf0;--bs-black:#000;--bs-white:#fff;--bs-gray:#6c757d;--bs-gray-dark:#343a40;--bs-gray-100:#f8f9fa;--bs-gray-200:#e9ecef;--bs-gray-300:#dee2e6;--bs-gray-400:#ced4da;--bs-gray-500:#adb5bd;--bs-gray-600:#6c757d;--bs-gray-700:#495057;--bs-gray-800:#343a40;--bs-gray-900:#212529;--bs-primary:#0d6efd;--bs-secondary:#6c757d;--bs-success:#198754;--bs-info:#0dcaf0;--bs-warning:#ffc107;--bs-danger:#dc3545;--bs-light:#f8f9fa;--bs-dark:#212529;--bs-primary-rgb:13,110,253;--bs-secondary-rgb:108,117,125;--bs-success-rgb:25,135,84;--bs-info-rgb:13,202,240;--bs-warning-rgb:255,193,7;--bs-danger-rgb:220,53,69;--bs-light-rgb:248,249,250;--bs-dark-rgb:33,37,41;--bs-white-rgb:255,255,255;--bs-black-rgb:0,0,0;--bs-body-color-rgb:33,37,41;--bs-body-bg-rgb:255,255,255;--bs-font-sans-serif:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans","Liberation Sans",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--bs-font-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--bs-gradient:linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));--bs-body-font-family:var(--bs-font-sans-serif);--bs-body-font-size:1rem;--bs-body-font-weight:400;--bs-body-line-height:1.5;--bs-body-color:#212529;--bs-body-bg:#fff;--bs-border-width:1px;--bs-border-style:solid;--bs-border-color:#dee2e6;--bs-border-color-translucent:rgba(0, 0, 0, 0.175);--bs-border-radius:0.375rem;--bs-border-radius-sm:0.25rem;--bs-border-radius-lg:0.5rem;--bs-border-radius-xl:1rem;--bs-border-radius-2xl:2rem;--bs-border-radius-pill:50rem;--bs-link-color:#0d6efd;--bs-link-hover-color:#0a58ca;--bs-code-color:#d63384;--bs-highlight-bg:#fff3cd;}
        *,::after,::before{box-sizing:border-box;}
        @media (prefers-reduced-motion:no-preference){
            :root{scroll-behavior:smooth;}
        }
        body{margin:0;font-family:var(--bs-body-font-family);font-size:var(--bs-body-font-size);font-weight:var(--bs-body-font-weight);line-height:var(--bs-body-line-height);color:var(--bs-body-color);text-align:var(--bs-body-text-align);background-color:var(--bs-body-bg);-webkit-text-size-adjust:100%;-webkit-tap-highlight-color:transparent;}
        h5{margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2;color:var(--bs-heading-color);}
        h5{font-size:1.25rem;}
        p{margin-top:0;margin-bottom:1rem;}
        img{vertical-align:middle;}
        table{caption-side:bottom;border-collapse:collapse;}
        tbody,td,tr{border-color:inherit;border-style:solid;border-width:0;}
        .d-inline-block{display:inline-block!important;}
        .border-0{border:0!important;}
        .w-100{width:100%!important;}
        .mb-0{margin-bottom:0!important;}
        .mb-2{margin-bottom:.5rem!important;}
        .mb-3{margin-bottom:1rem!important;}
        .p-3{padding:1rem!important;}
        .px-3{padding-right:1rem!important;padding-left:1rem!important;}
        .pt-3{padding-top:1rem!important;}
        .pt-4{padding-top:1.5rem!important;}
        .pb-4{padding-bottom:1.5rem!important;}
        .pb-5{padding-bottom:3rem!important;}
        .fw-bold{font-weight:700!important;}
        .text-start{text-align:left!important;}
        .text-center{text-align:center!important;}
        @media (min-width:768px){
            .p-md-5{padding:3rem!important;}
            .px-md-4{padding-right:1.5rem!important;padding-left:1.5rem!important;}
        }
        /*! CSS Used from: http://fairwin.test/css/app.css?id=5a9eaa59846642022a47b92cb24678e6 */
        *{font-family:Code-Pro-LC, serif;}
        .border-radius-0,.border-0{border-radius:0;}
        /*! CSS Used from: Embedded */
        *{font-family:Arial, serif;color:black;}
        /*! CSS Used fontfaces */
        @font-face{font-family:Code-Pro-LC;src:url('http://fairwin.test/fonts/Code%20Pro/Code%20Pro%20LC.otf');}
    </style>
</head>

<body style="background-color:#f3f7f0">
<table class="border-0 w-100">
    <tr>
        <td class="text-center p-3 p-md-5">
            <div class="d-inline-block border-radius-0 w-100" style="max-width:600px; border:1px solid #e3b504; background-color:#ffffff">
                <div class="text-start px-3 px-md-4 pt-4 pb-5">
                    <div class="text-center pt-3 pb-4">
                        <img src="{{ config('app.url_prod') . '/img/logo/fairwin-horizontal.png' }}" class="mb-2" width="200" />
                    </div>

                    <h5 class="mb-3">Verify Your Winners Gem Transfer</h5>

                    <p>Hello {{ $data['firstname'] }},</p>
                    <p>We received a request to transfer your Winners Gem. To verify this, please enter the code below on our website:</p>
                    <p>Code: <span class="fw-bold" style="font-size:22px; letter-spacing:2px">{{ $data['otp'] }}</span></p>
                    <p>If you didn't request this, please contact support at admin@8fairwin8tradingcorp.com.</p>

                    <p class="mb-0">Best regards,</p>
                    <p class="mb-0">{{ config('app.name') }}</p>
                </div>
            </div>
        </td>
    </tr>
</table>
</body>
</html>

