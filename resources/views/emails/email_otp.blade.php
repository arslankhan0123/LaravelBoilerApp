@component('mail::message')
    <div class="logo-cont">
        <img src="{{ asset('/new_work_design/images/logo3.svg') }}" alt="" id="login-logo" />
    </div>




    # One-Time Password (OTP)

    Your OTP for login is: {{ $otp }}

    If you did not request this OTP, please ignore this email.

    Thanks,<br>
    From {{ config('app.name') }}
@endcomponent
