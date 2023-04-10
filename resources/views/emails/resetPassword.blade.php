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
        .mb-30 {
            margin-bottom:30px;
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
                            <h1 style="margin-top:5px; margin-bottom:30px; font-size:22px">Reset Your Password</h1>
                        </div>

                        <p class="text-justify mb-20">Hello {{ $data['firstname'] }},</p>
                        <p class="text-justify mb-20">We have received a request to reset the password for your account associated with this email address.</p>
                        <p class="text-justify mb-20">If you did not request this password reset, please ignore this email and your account will remain secure.</p>
                        <p class="text-justify mb-30">To reset your password, please click the following link or copy and paste it into your browser:</p>

                        <p class="text-justify mb-30">
                            <a href="{{ route('profile.resetPasswordPage', $data['reset_password_uuid']) }}" class="text-justify" style="background-color:#104d22; color:#ffffff; padding:10px 20px; text-decoration:none">Reset Password Here</a>
                        </p>

                        <p class="text-justify mb-20">If you have any questions or concerns, please do not hesitate to contact us.</p>
                        <p class="text-justify mb-5">Best regards,</p>
                        <p class="text-justify mb-5">{{ config('app.name') }}</p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
