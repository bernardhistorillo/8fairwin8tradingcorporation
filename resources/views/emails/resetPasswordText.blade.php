Hello {{ $data['firstname'] }},

We have received a request to reset the password for your account associated with this email address.

If you did not request this password reset, please ignore this email and your account will remain secure.

To reset your password, copy and paste the link below into your browser:

{{ route('profile.resetPasswordPage', $data['reset_password_uuid']) }}

If you have any questions or concerns, please do not hesitate to contact us.

Best regards,
{{ config('app.name') }}
