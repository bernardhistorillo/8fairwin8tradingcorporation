<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            font-family: Arial, serif;
            color:black;
            font-size: 16px;
            line-height:22px;
        }
        p {
            margin: 0;
        }
        .mb-5 {
            margin-bottom:5px;
        }
        .mb-20 {
            margin-bottom:20px;
        }
        .text-justify {
            text-align:justify;
        }
        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

<body style="background-color:#f3f7f0">
    <table style="border:0; width:100%">
        <tr>
            <td style="text-align:center">
                <div style="background-color:white; display: inline-block; border-radius:30px; margin:50px 0; max-width:600px; width:100%; border:2px solid #e3b504">
                    <div style="padding:40px 30px; text-align:left">
                        <div style="text-align:center; background-image:url('{{ asset('img/heading.webp') }}'); background-size:cover; background-repeat:no-repeat; background-position:center; border-radius:30px 30px 0 0">
                            <img src="{{ asset('img/logo/fairwin-logo.png') }}" width="80" style="margin-bottom:15px" />
                            <h1 style="margin-top:5px; margin-bottom:30px; font-size:22px">Verify Your Email Address</h1>
                        </div>

                        <p class="text-justify mb-20">Hello {{ $data['firstname'] }},</p>
                        <p class="text-justify mb-20">Thank you for being with us! To verify your email address, please use the following One-Time Pin (OTP):</p>
                        <p class="text-justify mb-20">OTP: <span class="fw-bold" style="font-size:22px; letter-spacing:2px">{{ $data['otp'] }}</span></p>
                        <p class="text-justify mb-20">Please enter this OTP on the dialog you just opened in the website to confirm your email address.</p>
                        <p class="text-justify mb-20">If you did not start this email verification, please ignore this email.</p>
                        <p class="text-justify mb-5">Thank you,</p>
                        <p class="text-justify mb-5">{{ config('app.name') }}</p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
