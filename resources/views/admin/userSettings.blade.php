@extends('masterProfile')
@section('css')
<link rel="stylesheet" href="{{URL::asset('toaster/toaster.min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{URL::asset('toaster/toaster.min.css')}}">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style type="text/css">
    #inputs {
        text-align: center;
    }

    /* Apply the common styles to multiple otp-inputX classes */
    .otp-input, .otp-input1, .otp-input2, .otp-input3, .otp-input4, .otp-input5, .otp-input6, .otp-input7 {
        display: inline-block;
        font-size: 24px;
        text-align: center;
        width: 40%;
        display: flex;
    }

    /* Define styles for the input elements within otp-inputX classes */
    .otp-input input, .otp-input1 input, .otp-input2 input, .otp-input3 input, .otp-input4 input, .otp-input5 input, .otp-input6 input, .otp-input7 input {
        width: 40px;
        height: 50px;
        text-align: center;
        margin: 0 5px;
        font-size: 24px;
    }


    hr {
        margin-top: 5px;
        margin-bottom: 5px;
    }

    legend {
        margin-bottom: 0;
    }

    .additional_emails_div input {
        width: 100%;
        margin-bottom: 2px;
    }

    .oTable {
        margin-bottom: 10px;
    }

    .editButton {
        margin-right: 5px;
        height: 30px !important;
        line-height: 12px !important;
        width: 50px !important;
    }

    .cancelButton {
        height: 30px !important;
        line-height: 12px !important;
        width: 75px !important;
    }

    .saveBtn {
        height: 30px !important;
        line-height: 12px !important;
        width: 60px !important;
    }

    .profile-pic {
        height: auto !important;
        width: 75px !important;
    }

    .info-div {
        font-weight: 400 !important;
    }

    .font-weight-400 {
        font-weight: 400;
    }

    #otpError {
        color: red;
        text-align: center;
        margin-top: 10px;
        width: 100%;
    }



    .container {
        display: flex;
        align-items: center;
        justify-content: space-around;
        /* margin-top: 50px; */
        border: 2px solid #ccc;
        /* Add border around the main container */
        padding: 20px;
        /* Add some padding to create space between the border and content */
    }

    .image-container {
        width: 50%;
    }

    .image {
        max-width: 100%;
    }



    .verify-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }


    .qr_code_show_form>div:first-child {
        width: calc(100% - 80px);
    }

    .qr_code_show_form>div:last-child {
        width: 100%;
        max-width: 80px;
    }
</style>
@endsection
@section('content')
<!-- Main Content -->
<section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; margin-top:25px; margin-bottom:25px;">
    <div class="row" style="border: 1px solid #d0cece; background:#f5f5f5;">
        <div class="col-md-12">
            <div class="oSide">
                <div class="oLeftNav ctabsleft">
                    <div>
                        <a id="link-company-profile" href="{{route('userView')}}" data-corr-div-id="#sec-company-profile" style="background: #a00008; color: #ffffff; border-left: 5px #37a000;" class="isCurrent ltab" title="My Info">
                            <i class="oIconUser oIconSmall oIconLight oLeftNavIconSmall"></i>
                            User Profile
                        </a>
                    </div>
                    <div>
                        <a href="{{url('admin')}}" title="Password &amp; Security" id="dashboardLink" style="border-left: 5px solid #37a000;">
                            <i class="oIconLock oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Dashboard
                        </a>
                    </div>
                    <div>
                        <a href="{{url('logout')}}" title="Password &amp; Security" id="logoutLink" style="border-left: 5px solid #37a000;">
                            <i class="oIconLock oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>

            <div id="loadAjaxFrom">
                <form method="post" action="/admin/profile/user/view/edit/{{$user->user_name}}" id="pageForm">
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="{{$user->user_id}}">
                    <div class="oMain">
                        <div class="m-content">
                            <fieldset style="margin-top:15px !important;" class="tab-content first" id="sec-company-profile">
                                <legend>User Profile</legend>
                                <div class="row oTable" style="margin-left:0; margin-right:0;">
                                    <div class="col-md-2">
                                        <strong>First name:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="info-div">
                                            {{$user->first_name}}
                                        </div>
                                        <div class="edit-div">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-field">
                                                        <input class="form-control m-input m-input--square" id="first_name" type="text" name="first_name" value="{{$user->first_name}}">
                                                    </div>
                                                    <label for="phone" class="error"></label>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px;">
                                                <div class="col-md-12"><button class="btn btn-success saveBtn" type="submit">Save</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:void(0);" class="btn btn-primary editButton pull-left">Edit</a>
                                        <a href="javascript:void(0);" class="btn btn-danger cancelButton pull-left">Cancel</a>
                                    </div>
                                </div>
                                <div class="row oTable" style="margin-left:0; margin-right:0;">
                                    <div class="col-md-2">
                                        <strong>Last name:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="info-div">
                                            {{$user->last_name}}
                                        </div>
                                        <div class="edit-div">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-field">
                                                        <input class="form-control m-input m-input--square" id="last_name" type="text" name="last_name" value="{{$user->last_name}}">
                                                    </div>
                                                    <label for="phone" class="error"></label>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px;">
                                                <div class="col-md-12"><button class="btn btn-success saveBtn" type="submit">Save</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:void(0);" class="btn btn-primary editButton pull-left">Edit</a>
                                        <a href="javascript:void(0);" class="btn btn-danger cancelButton pull-left">Cancel</a>
                                    </div>
                                </div>
                                <!-- <div class="row oTable" style="margin-left:0; margin-right:0;">
                                    <div class="col-md-2">
                                        <strong>Name:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="info-div">
                                            {{$user->first_name}}
                                        </div>
                                        <div class="edit-div">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-field">
                                                        <input class="form-control m-input m-input--square" id="first_name" type="text" name="first_name" value="{{$user->first_name}}">
                                                    </div>
                                                    <label for="phone" class="error"></label>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px;">
                                                <div class="col-md-12"><button class="btn btn-success saveBtn" type="submit">Save</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:void(0);" class="btn btn-primary editButton pull-left">Edit</a>
                                        <a href="javascript:void(0);" class="btn btn-danger cancelButton pull-left">Cancel</a>
                                    </div>
                                </div> -->
                                <div class="row oTable" style="margin-left:0; margin-right:0;">
                                    <div class="col-md-2">
                                        <strong>Username:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="info-div">
                                            {{$user->user_name}}
                                        </div>
                                        @error('user_name')
                                        <div id="message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="edit-div">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-field">
                                                        <input class="form-control m-input m-input--square" id="user_name" type="text" name="user_name" value="{{$user->user_name}}">
                                                    </div>
                                                    <label for="phone" class="error"></label>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px;">
                                                <div class="col-md-12"><button class="btn btn-success saveBtn" type="submit">Save</button></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <a href="javascript:void(0);" class="btn btn-primary editButton pull-left">Edit</a>
                                        <a href="javascript:void(0);" class="btn btn-danger cancelButton pull-left">Cancel</a>
                                    </div>
                                </div>
                                <div class="row oTable" style="margin-left:0; margin-right:0;">
                                    <div class="col-md-2">
                                        <strong>Email:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="info-div">
                                            {{ substr($user->email, 0, 3) . '******' . substr($user->email, -3) }}
                                        </div>
                                        @error('email')
                                        <div id="message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="edit-div">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="input-field">
                                                        <input class="form-control m-input m-input--square" id="email" type="text" name="email" value="{{$user->email}}">
                                                    </div>
                                                    <label for="email" class="error"></label>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px;">
                                                <div class="col-md-12"><button class="btn btn-success saveBtn" type="submit">Save</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:void(0);" class="btn btn-primary editButton pull-left">Edit</a>
                                        <a href="javascript:void(0);" class="btn btn-danger cancelButton pull-left">Cancel</a>
                                    </div>
                                </div>
                                <div class="row oTable" style="margin-left:0; margin-right:0;">
                                    <div class="col-md-2">
                                        <strong>Password:</strong>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="info-div">
                                        </div>
                                        <div class="edit-div">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="input-field">
                                                        <input class="form-control m-input m-input--square" id="password" type="text" name="password" value="">
                                                    </div>
                                                    <label for="email" class="error"></label>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px;">
                                                <div class="col-md-12"><button class="btn btn-success saveBtn" type="submit">Save</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:void(0);" class="btn btn-primary editButton pull-left">Edit</a>
                                        <a href="javascript:void(0);" class="btn btn-danger cancelButton pull-left">Cancel</a>
                                    </div>
                                </div>


                                <div class="row oTable" style="margin-left:0; margin-right:0;">
                                    <div class="col-md-2">
                                        <strong>Enable 2FA Authentications:</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-div">
                                            <div class="custom-control custom-radio">
                                                <div class="radio">
                                                    <label><input type="radio" name="checkbox" value="NULL" id="switch-none">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-div">
                                            <div class="custom-control custom-radio">
                                                <div class="radio">
                                                    <label><input type="radio" name="checkbox" value="email_enable" id="switch-email">Enable Email 2FA</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-div">
                                            <div class="custom-control custom-radio">
                                                <div class="radio">
                                                    <label><input type="radio" name="checkbox" value="barcode_enable" id="switch-barcode">Enable Qrcode 2FA</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </fieldset>

            </div>
        </div>
        </form>


        <!-- Email enter form -->
        <div class="card" id="email-input" style="border: 1px solid #d0cece; background:#f5f5f5; display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
            <!-- <div id="verification_heading" class="card-header d-flex justify-content-center mt-2">2FA Verification with Email</div> -->

            <div class="card-body" style="border: 1px solid #d0cece; background:#f5f5f5;">
                <form id="emailForm" method="post" action="{{route('email.sent')}}">
                    @csrf
                    <!-- <p class="text-center">We sent otp to email: {{ substr($user->email, 0, 5) . '******' . substr($user->email, -2) }}</p> -->
                    <div>
                        <p id="verification_heading">Enter your email address</p>
                        <div class="form-group row">
                            <div class="input-group" style="margin-left:10px">
                                <input type="hidden" value="" name="radioButtonValue" id="radioButtonValue">
                                <div class="otp-input">
                                    <input class="form-control form-control-lg m-input m-input--square" type="text" height="10px" name="email" id="emailInput">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg" style="margin-left: 10px; background-color:#2156a6; font-size:12px" id="save-button">Send Code</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="container email-otp-input" id="email-otp-input" style="display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
            <div class="row w-100 align-items-center">
                <div class="col-md-8">
                    <form id="emailOtpForm" method="post" action="#">
                        @csrf
                        <input type="hidden" value="" name="radioButtonSecondValue" id="radioButtonSecondValue">
                        <p style="margin-left: 10px;">Enter 6 digit authentication code to complete the process</p>
                        <div class="otp-input1 w-100 qr_code_show_form">
                            <div>
                                <input type="text" maxlength="1" name="email_otp1" id="email_otp1" autofocus>
                                <input type="text" maxlength="1" name="email_otp2" id="email_otp2">
                                <input type="text" maxlength="1" name="email_otp3" id="email_otp3">
                                <input type="text" maxlength="1" name="email_otp4" id="email_otp4">
                                <input type="text" maxlength="1" name="email_otp5" id="email_otp5">
                                <input type="text" maxlength="1" name="email_otp6" id="email_otp6">
                            </div>
                            <div class="d-flex align-self-stretch ">
                                <button style="width: 100%; background-color:#2156a6;" id="otp-input1Button" class="btn btn-primary btn-sm verify-button">Verify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>











        <div class="container" id="qr_code_show" style="display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
            <div class="row w-100 align-items-center">
                <div class="col-md-4">
                    <div class="image-container w-100">
                        <div class="d-flex justify-content-center w-100" id="qrCodeContainer"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form id="qrCodeForm" method="post" action="#">
                        @csrf
                        <input type="hidden" value="" name="radioButtonQrValue" id="radioButtonQrValue">
                        <p style="margin-left: 10px;">Enter 6 digit authentication code</p>
                        <div class="otp-input2 w-100 qr_code_show_form">
                            <div>
                                <input type="text" maxlength="1" name="qr_otp1" id="otp1" autofocus>
                                <input type="text" maxlength="1" name="qr_otp2" id="otp2">
                                <input type="text" maxlength="1" name="qr_otp3" id="otp3">
                                <input type="text" maxlength="1" name="qr_otp4" id="otp4">
                                <input type="text" maxlength="1" name="qr_otp5" id="otp5">
                                <input type="text" maxlength="1" name="qr_otp6" id="otp6">
                            </div>
                            <div class="d-flex align-self-stretch ">
                                <button style="width: 100%; background-color:#2156a6;" id="otp-input2Button" class="btn btn-primary btn-sm verify-button">Verify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="container" id="qr_code_show_second" style="display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
            <div class="row w-100 align-items-center">
                <div class="col-md-4">
                    <div class="image-container w-100">
                        <div class="d-flex justify-content-center w-100" id="qrCodeSecondContainer"></div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div style="width:100%;">
                        <input type="hidden" value="" name="radioButtonQrValue" id="radioButtonQrValue">
                        <p style="margin-left: 10px;">Enter 6 digit authentication code</p>
                        <div class="otp-input2 w-100 qr_code_show_form">
                            <div>
                                <input type="text" maxlength="1" id="responseotp1" autofocus disabled>
                                <input type="text" maxlength="1" id="responseotp2" disabled>
                                <input type="text" maxlength="1" id="responseotp3" disabled>
                                <input type="text" maxlength="1" id="responseotp4" disabled>
                                <input type="text" maxlength="1" id="responseotp5" disabled>
                                <input type="text" maxlength="1" id="responseotp6" disabled>
                            </div>
                            <div class="d-flex align-self-stretch">
                                <button style="width: 100%; background-color:#888888;" class="btn btn-primary btn-sm verify-button">Verify</button>
                            </div>
                        </div>

                        <form id="qrCodeSecondOtpForm" style="width:100%;" method="post" action="#">
                            @csrf
                            <p style="margin-left: 10px;">Enter second authentication code to complete the process</p>
                            <input type="hidden" value="" name="radioButtonSecondQrValue" id="radioButtonSecondQrValue">
                            <!-- <input class="form-control" type="text" id="otp" name="otp" required> -->
                            <div class="otp-input3 w-100 qr_code_show_form">
                                <div>
                                    <input type="text" maxlength="1" name="qr_otp1" id="otp1" autofocus>
                                    <input type="text" maxlength="1" name="qr_otp2" id="otp2">
                                    <input type="text" maxlength="1" name="qr_otp3" id="otp3">
                                    <input type="text" maxlength="1" name="qr_otp4" id="otp4">
                                    <input type="text" maxlength="1" name="qr_otp5" id="otp5">
                                    <input type="text" maxlength="1" name="qr_otp6" id="otp6">
                                </div>
                                <div class="d-flex align-self-stretch">
                                    <button style="width: 100%; background-color:#2156a6;" id="otp-input3Button" class="btn btn-primary btn-sm verify-button">Verify</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Form for QR Old OTP to change 2fa -->
        <div class="container" id="qr_code_old_otp_form" style="display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
            <div class="row w-100 align-items-center">
                <!-- <div class="col-md-4">
                    <div class="image-container w-100">
                        <div class="d-flex justify-content-center w-100" id="qrCodeContainer"></div>
                    </div>
                </div> -->
                <div class="col-md-8">
                    <form id="qrCodeOldOtpForm" method="post" action="#">
                        @csrf
                        <input type="hidden" value="" name="radioButtonselectedCheckbox" id="radioButtonselectedCheckbox">
                        <p style="margin-left: 10px;">Enter 6 digit authentication code</p>
                        <input type="hidden" value="" name="radioButtonOldValueForQR" id="radioButtonOldValueForQR">
                        <div class="otp-input4 w-100 qr_code_show_form">
                            <div>
                                <input type="text" maxlength="1" name="qr_otp1" id="otp1" autofocus>
                                <input type="text" maxlength="1" name="qr_otp2" id="otp2">
                                <input type="text" maxlength="1" name="qr_otp3" id="otp3">
                                <input type="text" maxlength="1" name="qr_otp4" id="otp4">
                                <input type="text" maxlength="1" name="qr_otp5" id="otp5">
                                <input type="text" maxlength="1" name="qr_otp6" id="otp6">
                            </div>
                            <div class="d-flex align-self-stretch ">
                                <button style="width: 100%; background-color:#2156a6;" id="otp-input4Button" class="btn btn-primary btn-sm verify-button">Verify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>







        <!-- Form for Email Old OTP to change 2fa -->
        <div class="container" id="email_code_old_otp_form" style="display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
            <div class="row w-100 align-items-center">
                <!-- <div class="col-md-4">
                    <div class="image-container w-100">
                        <div class="d-flex justify-content-center w-100" id="qrCodeContainer"></div>
                    </div>
                </div> -->
                <div class="col-md-8">
                    <form id="emailCodeOldOtpForm" method="post" action="#">
                        @csrf
                        <input type="hidden" value="" name="radioButtonselectedCheckbox" id="radioButtonselectedCheckbox">
                        <p style="margin-left: 10px;">Enter 6 digit authentication code</p>
                        <input type="hidden" value="" name="radioButtonOldValueForEmail" id="radioButtonOldValueForEmail">
                        <div class="otp-input5 w-100 qr_code_show_form">
                            <div>
                                <input type="text" maxlength="1" name="email_otp1" id="otp1" autofocus>
                                <input type="text" maxlength="1" name="email_otp2" id="otp2">
                                <input type="text" maxlength="1" name="email_otp3" id="otp3">
                                <input type="text" maxlength="1" name="email_otp4" id="otp4">
                                <input type="text" maxlength="1" name="email_otp5" id="otp5">
                                <input type="text" maxlength="1" name="email_otp6" id="otp6">
                            </div>
                            <div class="d-flex align-self-stretch ">
                                <button style="width: 100%; background-color:#2156a6;" id="otp-input5Button" class="btn btn-primary btn-sm verify-button">Verify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Form for Email Old OTP to change 2fa -->
        <div class="container" id="email_code_old_otp_form_for_null" style="display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
            <div class="row w-100 align-items-center">
                <!-- <div class="col-md-4">
                    <div class="image-container w-100">
                        <div class="d-flex justify-content-center w-100" id="qrCodeContainer"></div>
                    </div>
                </div> -->
                <div class="col-md-8">
                    <form id="emailCodeOldOtpFormForNull" method="post" action="#">
                        @csrf
                        <input type="hidden" value="" name="radioButtonselectedCheckbox" id="radioButtonselectedCheckbox">
                        <p style="margin-left: 10px;">Enter 6 digit authentication code</p>
                        <input type="hidden" value="" name="radioButtonOldValueForEmailForNull" id="radioButtonOldValueForEmailForNull">
                        <div class="otp-input6 w-100 qr_code_show_form">
                            <div>
                                <input type="text" maxlength="1" name="email_otp1" id="otp1" autofocus>
                                <input type="text" maxlength="1" name="email_otp2" id="otp2">
                                <input type="text" maxlength="1" name="email_otp3" id="otp3">
                                <input type="text" maxlength="1" name="email_otp4" id="otp4">
                                <input type="text" maxlength="1" name="email_otp5" id="otp5">
                                <input type="text" maxlength="1" name="email_otp6" id="otp6">
                            </div>
                            <div class="d-flex align-self-stretch ">
                                <button style="width: 100%; background-color:#2156a6;" id="otp-input6Button" class="btn btn-primary btn-sm verify-button">Verify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <!-- Form for Email Old OTP to change 2fa -->
        <div class="container" id="qr_code_old_otp_form_for_null" style="display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
            <div class="row w-100 align-items-center">
                <!-- <div class="col-md-4">
                    <div class="image-container w-100">
                        <div class="d-flex justify-content-center w-100" id="qrCodeContainer"></div>
                    </div>
                </div> -->
                <div class="col-md-8">
                    <form id="qrCodeOldOtpFormForNull" method="post" action="#">
                        @csrf
                        <input type="hidden" value="" name="radioButtonselectedCheckbox" id="radioButtonselectedCheckbox">
                        <p style="margin-left: 10px;">Enter 6 digit authentication code</p>
                        <input type="hidden" value="" name="radioButtonOldValueForQrForNull" id="radioButtonOldValueForQrForNull">
                        <div class="otp-input7 w-100 qr_code_show_form">
                            <div>
                                <input type="text" maxlength="1" name="qr_otp1" id="otp1" autofocus>
                                <input type="text" maxlength="1" name="qr_otp2" id="otp2">
                                <input type="text" maxlength="1" name="qr_otp3" id="otp3">
                                <input type="text" maxlength="1" name="qr_otp4" id="otp4">
                                <input type="text" maxlength="1" name="qr_otp5" id="otp5">
                                <input type="text" maxlength="1" name="qr_otp6" id="otp6">
                            </div>
                            <div class="d-flex align-self-stretch ">
                                <button style="width: 100%; background-color:#2156a6;" id="otp-input7Button" class="btn btn-primary btn-sm verify-button">Verify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>
    </div>
    </div>
</section>
@endsection

@section('js')
<script src="{{URL::asset('toaster/toaster.min.js')}}"></script>
@if(Session::has('error'))
<script>
    toastr.options = {
        "progressBar": true,
        "closeButton": true,
    }
    toastr.error("{{Session::get('error')}}")
</script>
@endif
@if(Session::has('success'))
<script>
    toastr.options = {
        "progressBar": true,
        "closeButton": true,
    }
    toastr.success("{{Session::get('success')}}")
</script>
@endif
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-oCz8w4K6cB0JodB1MKLGf/Xa8whC7g6Sq94P3Jip1ps=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js" integrity="sha256-8Hjb5CPMgRKuHC7FSkTbNsf5Hq6T5vRBEW1wA3ZoyMU=" crossorigin="anonymous"></script>


<script src="{{URL::asset('toaster/toaster.min.js')}}"></script>
<script>
    $(document).ready(function() {
        var countdownActive = false;

        // Function to start the 30 seconds countdown
        function startCountdown() {
            countdownActive = true;
            var countdownSeconds = 30;
            var countdownInterval = setInterval(function() {
                if (countdownSeconds <= 0) {
                    countdownActive = false;
                    clearInterval(countdownInterval);
                }
                countdownSeconds--;
            }, 1000);
        }

        // First Ajax call
        $('#qrCodeForm').submit(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');


            // Step 1: Function to check if all fields are filled
            function areAllFieldsFilled() {
                var allFieldsFilled = true;
                form.find('input').each(function() {
                    if ($(this).val().trim() === '') {
                        allFieldsFilled = false;
                        return false; // Exit the loop early if any field is empty
                    }
                });
                return allFieldsFilled;
            }

            // Step 2: Call the validation function
            if (!areAllFieldsFilled()) {
                toastr.error('All fields are required');
                return; // Prevent the AJAX request if any field is empty
            }
            var formData = form.serialize();
            $.ajax({
                url: '{{ route("qrcode.otp.verify") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#radioButtonSecondQrValue').val(response.radioButtonQrValue);
                    $('#qr_code_show_second').show();
                    $('#qr_code_show').hide();
                    $('#responseotp1').val(response.qr_otp1);
                    $('#responseotp2').val(response.qr_otp2);
                    $('#responseotp3').val(response.qr_otp3);
                    $('#responseotp4').val(response.qr_otp4);
                    $('#responseotp5').val(response.qr_otp5);
                    $('#responseotp6').val(response.qr_otp6);

                    document.getElementById("qrCodeSecondContainer").innerHTML = response.google2faUrl;
                    $('#qrCodeForm')[0].reset();
                },
                error: function(xhr) {
                    var response = xhr.responseJSON;
                    toastr.error(response.message);
                    $('#qrCodeForm')[0].reset();
                }
            });
        });

        // Second Ajax call
        $('#qrCodeSecondOtpForm').submit(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');

            // Step 1: Function to check if all fields are filled
            function areAllFieldsFilled() {
                var allFieldsFilled = true;
                form.find('input').each(function() {
                    if ($(this).val().trim() === '') {
                        allFieldsFilled = false;
                        return false; // Exit the loop early if any field is empty
                    }
                });
                return allFieldsFilled;
            }

            // Step 2: Call the validation function
            if (!areAllFieldsFilled()) {
                toastr.error('All fields are required');
                return; // Prevent the AJAX request if any field is empty
            }


            var formData = form.serialize();
            $("#verify_first_button").prop("disabled", true);
            $.ajax({
                url: '{{ route("qrcode.second.otp.verify") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    toastr.success("2FA enabled Successfully");
                    // ... Rest of your code ...
                    $('#radioButtonSecondQrValue').val(response.radioButtonQrValue);
                    $('#qr_code_show_second').hide();
                    $('#qr_code_show').hide();
                    // location.reload();
                    var url = "{{ route('checkbox.get') }}";

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            if (response === 'email_enable') {
                                $('#switch-email').prop('checked', true);
                                updateRadioButtons('email_enable');
                            } else if (response === 'barcode_enable') {
                                $('#switch-barcode').prop('checked', true);
                                updateRadioButtons('barcode_enable');
                            } else {
                                $('#switch-none').prop('checked', true);
                                updateRadioButtons('none');
                            }
                            $('#qrCodeSecondOtpForm')[0].reset();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log(xhr.responseText);
                            $('#qrCodeSecondOtpForm')[0].reset();
                        }
                    });
                    $('#qrCodeSecondOtpForm')[0].reset();
                    // setTimeout(function() {
                    //     location.reload();
                    // }, 3000);
                },
                error: function(xhr) {
                    var response = xhr.responseJSON;
                    toastr.error(response.message);
                    $('#qrCodeSecondOtpForm')[0].reset();
                }
            });
        });




        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('#qrCodeOldOtpForm').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = form.serializeArray();
            var hasEmptyFields = false;

            // Check if any field is empty
            for (var i = 0; i < formData.length; i++) {
                if (formData[i].name.startsWith("qr_otp") && formData[i].value.trim() === '') {
                    hasEmptyFields = true;
                    break; // Exit the loop early if any OTP field is empty
                }
            }

            // Display error message if any OTP field is empty
            if (hasEmptyFields) {
                toastr.error('All fields are required');
                return; // Prevent the AJAX request if any OTP field is empty
            }

            // All OTP fields are filled, proceed with AJAX request
            $.ajax({
                url: '{{ route("qrcode.old.otp.verify") }}',
                type: 'POST',
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.status) {
                        $('#switch-barcode').prop('checked', false).prop('disabled', false);
                        $('#switch-null').prop('checked', false).prop('disabled', false);
                        $('#switch-email').prop('checked', true);
                        $('#radioButtonValue').val(response.selectedCheckbox);
                        $('#email-input').show();
                        $('#qr_code_old_otp_form').hide();
                        $('#email_code_old_otp_form').hide();
                        $('#qr_code_show').hide();
                        $('#qr_code_show_second').hide();
                        $('.email-otp-input').hide();
                        $('#emailForm')[0].reset();
                        $('#emailOtpForm')[0].reset();
                        toastr.success("Please enter your email to enable 2FA");
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('An error occurred');
                    }
                },
                complete: function() {
                    // Reset the form after the AJAX request, regardless of success or error
                    form[0].reset();
                }
            });
        });






        $('#emailCodeOldOtpForm').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = form.serializeArray();
            var hasEmptyFields = false;

            // Check if any field is empty
            for (var i = 0; i < formData.length; i++) {
                if (formData[i].name.startsWith("email_otp") && formData[i].value.trim() === '') {
                    hasEmptyFields = true;
                    break; // Exit the loop early if any OTP field is empty
                }
            }

            // Display error message if any OTP field is empty
            if (hasEmptyFields) {
                toastr.error('All fields are required');
                return; // Prevent the AJAX request if any OTP field is empty
            }

            // All OTP fields are filled, proceed with AJAX request
            $.ajax({
                url: '{{ route("email.old.otp.verify") }}',
                type: 'POST',
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.status) {
                        $('#switch-email').prop('checked', false).prop('disabled', false);
                        $('#switch-null').prop('checked', false).prop('disabled', false);
                        $('#switch-barcode').prop('checked', true);
                        $('#qr_code_show').show();
                        $('#email-input').hide();
                        $('.email-otp-input').hide();
                        $('#qr_code_old_otp_form').hide();
                        $('#email_code_old_otp_form').hide();
                        $('#qr_code_show_second').hide();
                        $('#radioButtonQrValue').val(response.selectedCheckbox);
                        $('#qrCodeForm')[0].reset();
                        $('#qrCodeSecondOtpForm')[0].reset();
                        document.getElementById("qrCodeContainer").innerHTML = response.google2faUrl;
                        toastr.success("Scan the QR code to enable 2FA");
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('An error occurred');
                    }
                },
                complete: function() {
                    // Reset the form after the AJAX request, regardless of success or error
                    form[0].reset();
                }
            });
        });



        $('#emailCodeOldOtpFormForNull').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = form.serializeArray();
            var hasEmptyFields = false;
            console.log(form);
            console.log(formData);
            // return;

            // Check if any field is empty
            for (var i = 0; i < formData.length; i++) {
                if (formData[i].name.startsWith("email_otp") && formData[i].value.trim() === '') {
                    hasEmptyFields = true;
                    break; // Exit the loop early if any OTP field is empty
                }
            }

            // Display error message if any OTP field is empty
            if (hasEmptyFields) {
                toastr.error('All fields are required');
                return; // Prevent the AJAX request if any OTP field is empty
            }

            // All OTP fields are filled, proceed with AJAX request
            $.ajax({
                url: '{{ route("email.old.otp.verify.for.null") }}',
                type: 'POST',
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.status) {
                        $('#switch-email').prop('checked', false).prop('disabled', false);
                        $('#switch-barcode').prop('checked', false).prop('disabled', false);
                        $('#switch-null').prop('checked', true);
                        $('#qr_code_show').hide();
                        $('#email-input').hide();
                        $('.email-otp-input').hide();
                        $('#qr_code_old_otp_form').hide();
                        $('#email_code_old_otp_form').hide();
                        $('#qr_code_show_second').hide();
                        $('#qrCodeForm')[0].reset();
                        $('#qrCodeSecondOtpForm')[0].reset();
                        $('#email_code_old_otp_form_for_null').hide();
                        $('#qr_code_old_otp_form_for_null').hide();
                        toastr.success("Updated Successfully");


                        var url = "{{ route('checkbox.get') }}";
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                if (response === 'email_enable') {
                                    $('#switch-email').prop('checked', true);
                                    updateRadioButtons('email_enable');
                                } else if (response === 'barcode_enable') {
                                    $('#switch-barcode').prop('checked', true);
                                    updateRadioButtons('barcode_enable');
                                } else {
                                    $('#switch-none').prop('checked', true);
                                    updateRadioButtons('none');
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.log(xhr.responseText);
                            }
                        });
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('An error occurred');
                    }
                },
                complete: function() {
                    // Reset the form after the AJAX request, regardless of success or error
                    form[0].reset();
                }
            });
        });


        $('#qrCodeOldOtpFormForNull').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = form.serializeArray();
            var hasEmptyFields = false;

            // Check if any field is empty
            for (var i = 0; i < formData.length; i++) {
                if (formData[i].name.startsWith("qr_otp") && formData[i].value.trim() === '') {
                    hasEmptyFields = true;
                    break; // Exit the loop early if any OTP field is empty
                }
            }

            // Display error message if any OTP field is empty
            if (hasEmptyFields) {
                toastr.error('All fields are required');
                return; // Prevent the AJAX request if any OTP field is empty
            }

            // All OTP fields are filled, proceed with AJAX request
            $.ajax({
                url: '{{ route("qr.old.otp.verify.for.null") }}',
                type: 'POST',
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.status) {
                        $('#switch-email').prop('checked', false).prop('disabled', false);
                        $('#switch-barcode').prop('checked', false).prop('disabled', false);
                        $('#switch-null').prop('checked', true);
                        $('#qr_code_show').hide();
                        $('#email-input').hide();
                        $('.email-otp-input').hide();
                        $('#qr_code_old_otp_form').hide();
                        $('#email_code_old_otp_form').hide();
                        $('#qr_code_show_second').hide();
                        $('#qrCodeForm')[0].reset();
                        $('#qrCodeSecondOtpForm')[0].reset();
                        $('#email_code_old_otp_form_for_null').hide();
                        $('#qr_code_old_otp_form_for_null').hide();
                        toastr.success("Updated Successfully");


                        var url = "{{ route('checkbox.get') }}";
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                if (response === 'email_enable') {
                                    $('#switch-email').prop('checked', true);
                                    updateRadioButtons('email_enable');
                                } else if (response === 'barcode_enable') {
                                    $('#switch-barcode').prop('checked', true);
                                    updateRadioButtons('barcode_enable');
                                } else {
                                    $('#switch-none').prop('checked', true);
                                    updateRadioButtons('none');
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.log(xhr.responseText);
                            }
                        });
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('An error occurred');
                    }
                },
                complete: function() {
                    // Reset the form after the AJAX request, regardless of success or error
                    form[0].reset();
                }
            });
        });



    });
</script>

<script>
    $(document).ready(function() {
        // Handle form submission
        $('#emailForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            var form = $(this).closest('form'); // Get the parent form
            var url = form.attr('action'); // Get the form's action URL
            var formData = form.serialize(); // Serialize the form data

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#email-input').hide();
                    $('.email-otp-input').show();
                    $('#email_code_old_otp_form').hide();
                    $('#radioButtonSecondValue').val(response[0]);
                    toastr.success("Please enter OTP");
                    $('#emailForm')[0].reset();
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    toastr.clear(); // Clear any existing toastr messages

                    $.each(errors, function(field, error) {
                        toastr.error(error[0]); // Display toastr error message for each validation error
                    });
                    $('#emailForm')[0].reset();
                },
            });
        });



        $('#emailOtpForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serializeArray();
            var hasEmptyFields = false;

            // Check if any field is empty
            for (var i = 0; i < formData.length; i++) {
                if (formData[i].name.startsWith("email_otp") && formData[i].value.trim() === '') {
                    hasEmptyFields = true;
                    break; // Exit the loop early if any OTP field is empty
                }
            }

            // Display error message if any OTP field is empty
            if (hasEmptyFields) {
                toastr.error('All fields are required');
                return; // Prevent the AJAX request if any OTP field is empty
            }

            var formData = form.serialize();
            $.ajax({
                url: '{{ route("enable.email.otp") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    toastr.success("2FA enabled Successfully");
                    // return;
                    $('#radioButtonSecondQrValue').val(response.radioButtonQrValue);
                    $('#qr_code_show_second').hide();
                    $('#qr_code_show').hide();
                    $('#email_code_old_otp_form').hide();
                    $('#email_code_old_otp_form_for_null').hide();
                    $('#email_code_old_otp_form').hide();
                    $('#email-otp-input').hide();
                    $('#emailForm')[0].reset();
                    $('#emailOtpForm')[0].reset();
                    // location.reload();
                    var url = "{{ route('checkbox.get') }}";

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            if (response === 'email_enable') {
                                $('#switch-email').prop('checked', true);
                                updateRadioButtons('email_enable');
                            } else if (response === 'barcode_enable') {
                                $('#switch-barcode').prop('checked', true);
                                updateRadioButtons('barcode_enable');
                            } else {
                                $('#switch-none').prop('checked', true);
                                updateRadioButtons('none');
                            }
                            $('#emailForm')[0].reset();
                            $('#emailOtpForm')[0].reset();
                        },
                        error: function(xhr, textStatus, errorThrown) {}
                    });
                    $('#emailOtpForm')[0].reset();
                    // setTimeout(function() {
                    //     location.reload();
                    // }, 3000);
                },
                error: function(xhr) {
                    var response = xhr.responseJSON;
                    toastr.error(response.message);
                    $('#emailOtpForm')[0].reset();
                }
            });
        });



    });
</script>




<script>
    $(document).ready(function() {
        $('#logoutLink').click(function(event) {
            event.preventDefault(); // Prevent the default behavior of the link

            // Perform logout action by navigating to the logout URL
            window.location.href = "{{url('logout')}}";

            // Hide the element with ID qr_code_old_otp_form_for_null
            $('#qr_code_old_otp_form_for_null').hide();
            $('#qr_code_old_otp_form').hide();
            $('#email_code_old_otp_form').hide();
            $('#email_code_old_otp_form_for_null').hide();
            $('#email-input').hide();
            $('#qr_code_show').hide();
            $('#qr_code_show_second').hide();
            $('.email-otp-input').hide();

            $.ajax({
                url: "{{ route('email_otp_null') }}",
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    handleResponse(response);
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });


        $('#dashboardLink').click(function(event) {
            event.preventDefault(); // Prevent the default behavior of the link

            // Perform logout action by navigating to the logout URL
            window.location.href = "{{url('admin')}}";

            // Hide the element with ID qr_code_old_otp_form_for_null
            $('#qr_code_old_otp_form_for_null').hide();
            $('#qr_code_old_otp_form').hide();
            $('#email_code_old_otp_form').hide();
            $('#email_code_old_otp_form_for_null').hide();
            $('#email-input').hide();
            $('#qr_code_show').hide();
            $('#qr_code_show_second').hide();
            $('.email-otp-input').hide();

            $.ajax({
                url: "{{ route('email_otp_null') }}",
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    handleResponse(response);
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function() {

        // Function to update the checkboxes based on the selectedCheckbox value
        function updateRadioButtons(selectedCheckbox) {
            if (selectedCheckbox === 'none') {
                $('#switch-email').prop('checked', false);
                $('#switch-barcode').prop('checked', false);
                $('#switch-none').prop('checked', true);
            } else if (selectedCheckbox === 'email_enable') {
                $('#switch-email').prop('checked', true);
                $('#switch-barcode').prop('checked', false);
                $('#switch-none').prop('checked', false).prop('disabled', false);
            } else if (selectedCheckbox === 'barcode_enable') {
                $('#switch-email').prop('checked', false);
                $('#switch-barcode').prop('checked', true);
                $('#switch-none').prop('checked', false).prop('disabled', false);
            }
        }

        // Function to handle the response from AJAX and set the checkboxes accordingly
        function handleResponse(response) {
            if (response === 'email_enable') {
                updateRadioButtons('email_enable');
            } else if (response === 'barcode_enable') {
                updateRadioButtons('barcode_enable');
            } else {
                updateRadioButtons('none');
            }
        }

        // Event handler for the "none" checkbox
        $('#switch-none').on('click', function() {
            if ($(this).prop('checked')) {
                $(this).prop('checked', true); // Ensure the checkbox stays checked
            }
        });

        // Event handler for the "email" checkbox
        $('#switch-email').on('click', function() {
            if ($(this).prop('checked')) {
                $('#switch-barcode').prop('checked', false);
                $('#switch-none').prop('checked', false).prop('disabled', false);
            }
        });

        // Event handler for the "barcode" checkbox
        $('#switch-barcode').on('click', function() {
            if ($(this).prop('checked')) {
                $('#switch-email').prop('checked', false);
                $('#switch-none').prop('checked', false).prop('disabled', false);
            }
        });

        // Retrieve the checkbox value from the database via AJAX
        var url = "{{ route('checkbox.get') }}";

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                console.log(response);
                handleResponse(response);
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            }
        });


        $('input[type="radio"]').on('change', function() {
            // Identify the selected toggle button
            var selectedCheckbox = $(this).val();
            // return;
            var url = "{{ route('2fa.enable.store') }}";

            // Send AJAX request to the server
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    selected_checkbox: selectedCheckbox
                },
                success: function(response) {
                    console.log(response);
                    // return;
                    toastr.options = {
                        "progressBar": true,
                        "closeButton": true,
                    }


                    $('#switch-email').on('click', function() {
                        // Check if selectedCheckbox is 'email_enable'
                        if (selectedCheckbox === 'email_enable') {
                            $(this).prop('checked', true);
                        } else {
                            // If not 'email_enable', update the checkboxes as before
                            if ($(this).prop('checked')) {
                                $('#switch-barcode').prop('checked', false);
                                $('#switch-none').prop('checked', false);
                            }
                        }
                    });
                    $('#switch-barcode').on('click', function() {
                        // Check if selectedCheckbox is 'email_enable'
                        if (selectedCheckbox === 'barcode_enable') {
                            $(this).prop('checked', true);
                        } else {
                            // If not 'email_enable', update the checkboxes as before
                            if ($(this).prop('checked')) {
                                $('#switch-email').prop('checked', false);
                                $('#switch-none').prop('checked', false);
                            }
                        }
                    });
                    $('#switch-null').on('click', function() {
                        // Check if selectedCheckbox is 'email_enable'
                        if (selectedCheckbox === 'NULL') {
                            $(this).prop('checked', true);
                        } else {
                            // If not 'email_enable', update the checkboxes as before
                            if ($(this).prop('checked')) {
                                $('#switch-barcode').prop('checked', false);
                                $('#switch-email').prop('checked', false);
                            }
                        }
                    });
                    if (selectedCheckbox === 'email_enable') {
                        if (response.master_user.enable_2fa == 'barcode_enable') {
                            $('#qr_code_old_otp_form').show();
                            $('#qr_code_show').hide();
                            $('#email_code_old_otp_form').hide();
                            $('#qr_code_old_otp_form_for_null').hide();
                            $('#email_code_old_otp_form_for_null').hide();
                            $('#email-input').hide();
                            $('.email-otp-input').hide();
                            $('#qr_code_show_second').hide();

                            $('#radioButtonOldValueForQR').val(response.selectedCheckbox);
                            toastr.success("First enter current QR otp");
                            return;
                        } else {
                            if (response.message == "alreadyupdated") {
                                $('#qr_code_show').hide();
                                $('#qr_code_old_otp_form').hide();
                                $('#email_code_old_otp_form').hide();
                                $('#qr_code_old_otp_form_for_null').hide();
                                $('#email_code_old_otp_form_for_null').hide();
                                $('#email-input').hide();
                                $('.email-otp-input').hide();
                                $('#qr_code_show_second').hide();
                                toastr.success("Already enabled");
                            } else {
                                $('#switch-barcode').prop('checked', false).prop('disabled', false);
                                $('#switch-null').prop('checked', false).prop('disabled', false);
                                $('#switch-email').prop('checked', true);
                                $('#radioButtonValue').val(response.selectedCheckbox);
                                $('#email-input').show();
                                $('#qr_code_old_otp_form').hide();
                                $('#email_code_old_otp_form').hide();
                                $('#qr_code_show').hide();
                                $('#qr_code_show_second').hide();
                                $('.email-otp-input').hide();
                                $('#emailForm')[0].reset();
                                $('#emailOtpForm')[0].reset();
                                toastr.success("Please enter your email to enable 2FA");
                            }
                        }
                    } else if (selectedCheckbox === 'barcode_enable') {
                        if (response.master_user.enable_2fa == 'email_enable') {
                            $('#email_code_old_otp_form').show();
                            $('#qr_code_old_otp_form').hide();
                            $('#qr_code_show').hide();
                            $('#qr_code_old_otp_form_for_null').hide();
                            $('#email_code_old_otp_form_for_null').hide();
                            $('#email-input').hide();
                            $('.email-otp-input').hide();
                            $('#qr_code_show_second').hide();
                            $('#radioButtonOldValueForEmail').val(response.selectedCheckbox);
                            toastr.success("First enter current email otp");
                            console.log(response)
                            return;
                        } else {
                            if (response.message == "alreadyupdated") {
                                $('#qr_code_show').hide();
                                $('#email-input').hide();
                                $('#qr_code_old_otp_form').hide();
                                $('#email_code_old_otp_form').hide();
                                $('#qr_code_old_otp_form_for_null').hide();
                                $('#email_code_old_otp_form_for_null').hide();
                                $('.email-otp-input').hide();
                                $('#qr_code_old_otp_form').hide();
                                $('#email_code_old_otp_form').hide();
                                $('#qr_code_show_second').hide();
                                toastr.success("Already enabled");
                            } else {
                                $('#switch-email').prop('checked', false).prop('disabled', false);
                                $('#switch-null').prop('checked', false).prop('disabled', false);
                                $('#switch-barcode').prop('checked', true);
                                $('#qr_code_show').show();
                                $('#email-input').hide();
                                $('#email_code_old_otp_form_for_null').hide();
                                $('.email-otp-input').hide();
                                $('#qr_code_old_otp_form').hide();
                                $('#email_code_old_otp_form').hide();
                                $('#qr_code_show_second').hide();
                                $('#radioButtonQrValue').val(response.selectedCheckbox);
                                $('#qrCodeForm')[0].reset();
                                $('#qrCodeSecondOtpForm')[0].reset();
                                document.getElementById("qrCodeContainer").innerHTML = response.google2faUrl;
                                toastr.success("Scan the QR code to enable 2FA");
                            }
                        }


                    } else {
                        if (response.message == "emailEnabled") {
                            $('#email_code_old_otp_form_for_null').show();
                            $('#email_code_old_otp_form').hide();
                            $('#qr_code_old_otp_form').hide();
                            $('#qr_code_show').hide();
                            $('#qr_code_old_otp_form_for_null').hide();
                            $('#email-input').hide();
                            $('.email-otp-input').hide();
                            $('#qr_code_show_second').hide();
                            $('#radioButtonOldValueForEmailForNull').val(response.selectedCheckbox);
                            toastr.success("First enter current email otp");
                            return;
                        } else if (response.message == "barcodeEnabled") {
                            $('#qr_code_old_otp_form_for_null').show();
                            $('#email_code_old_otp_form_for_null').hide();
                            $('#email-input').hide();
                            $('#qr_code_show_second').hide();
                            $('#qr_code_old_otp_form').hide();
                            $('#email_code_old_otp_form').hide();
                            $('#qr_code_show').hide();
                            $('.email-otp-input').hide();
                            $('#radioButtonOldValueForQrForNull').val(response.selectedCheckbox);
                            toastr.success("First enter current QR otp");
                            return;
                        }
                        $('#switch-barcode').prop('checked', false).prop('disabled', false);
                        $('#switch-email').prop('checked', false).prop('disabled', false);
                        $('#switch-null').prop('checked', true);
                        $('#email-input').hide();
                        $('#qr_code_show_second').hide();
                        $('#qr_code_old_otp_form').hide();
                        $('#email_code_old_otp_form').hide();
                        $('#qr_code_show').hide();
                        $('.email-otp-input').hide();
                        $('#qr_code_old_otp_form_for_null').hide();
                        $('#email_code_old_otp_form_for_null').hide();

                        toastr.success("Updated Successfully");
                        // location.reload();
                        var url = "{{ route('checkbox.get') }}";

                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                if (response === 'email_enable') {
                                    $('#switch-email').prop('checked', true);
                                    updateRadioButtons('email_enable');
                                } else if (response === 'barcode_enable') {
                                    $('#switch-barcode').prop('checked', true);
                                    updateRadioButtons('barcode_enable');
                                } else {
                                    $('#switch-none').prop('checked', true);
                                    updateRadioButtons('none');
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.log(xhr.responseText);
                            }
                        });
                        // setTimeout(function() {
                        //     location.reload();
                        // }, 3000);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        });

    });
</script>


<script>
    $(document).ready(function() {
        $('body').on('click', '#remove_email', function() {
            $(this).parent().parent().remove();
        });

        $('.ctabsleft a.ltab').click(function(e) {
            e.preventDefault();
        });

        $("body").on("mouseover", '.content-wrap', function(e) {
            $('.editButton').click(function(e) {
                $(this).parents('.oTable').find('.info-div').hide();
                $(this).parents('.oTable').find('.edit-div').fadeIn('slow');
            });

            $('.cancelButton').click(function(e) {
                $(this).parents('.oTable').find('.edit-div').hide();
                $(this).parents('.oTable').find('.info-div').fadeIn('slow');
                $("#pageForm")[0].reset();

                function updateRadioButtons(selectedCheckbox) {
                    if (selectedCheckbox === 'none') {
                        $('#switch-email').prop('checked', false);
                        $('#switch-barcode').prop('checked', false);
                        $('#switch-none').prop('checked', true);
                    } else if (selectedCheckbox === 'email_enable') {
                        $('#switch-email').prop('checked', true);
                        $('#switch-barcode').prop('checked', false);
                        $('#switch-none').prop('checked', false).prop('disabled', false);
                    } else if (selectedCheckbox === 'barcode_enable') {
                        $('#switch-email').prop('checked', false);
                        $('#switch-barcode').prop('checked', true);
                        $('#switch-none').prop('checked', false).prop('disabled', false);
                    }
                }

                // Function to handle the response from AJAX and set the checkboxes accordingly
                function handleResponse(response) {
                    if (response === 'email_enable') {
                        updateRadioButtons('email_enable');
                    } else if (response === 'barcode_enable') {
                        updateRadioButtons('barcode_enable');
                    } else {
                        updateRadioButtons('none');
                    }
                }

                // Event handler for the "none" checkbox
                $('#switch-none').on('click', function() {
                    if ($(this).prop('checked')) {
                        $(this).prop('checked', true); // Ensure the checkbox stays checked
                    }
                });

                // Event handler for the "email" checkbox
                $('#switch-email').on('click', function() {
                    if ($(this).prop('checked')) {
                        $('#switch-barcode').prop('checked', false);
                        $('#switch-none').prop('checked', false).prop('disabled', false);
                    }
                });

                // Event handler for the "barcode" checkbox
                $('#switch-barcode').on('click', function() {
                    if ($(this).prop('checked')) {
                        $('#switch-email').prop('checked', false);
                        $('#switch-none').prop('checked', false).prop('disabled', false);
                    }
                });

                // Retrieve the checkbox value from the database via AJAX
                var url = "{{ route('checkbox.get') }}";

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        handleResponse(response);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText);
                    }
                });
            });

        });

        $("#pageForm").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                user_name: "required",
                password: "required",
                email: {
                    required: true,
                    email: true
                },
            },
        });








        function setupOTPInputs(otpInputs, verifyButton, numInputs) {
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    const nextInput = otpInputs[index + 1];
                    const prevInput = otpInputs[index - 1];

                    if (input.value.length === 1 && nextInput) {
                        nextInput.focus();
                    }

                    if (input.value.length === 0 && prevInput) {
                        prevInput.focus();
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value.length === 0) {
                        const prevInput = otpInputs[index - 1];
                        if (prevInput) {
                            prevInput.focus();
                        }
                    }
                });

                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const pastedText = e.clipboardData.getData('text/plain').trim();
                    for (let i = 0; i < numInputs; i++) {
                        if (pastedText[i] && otpInputs[i]) {
                            otpInputs[i].value = pastedText[i];
                        } else {
                            break;
                        }
                    }

                    if (pastedText.length <= numInputs) {
                        otpInputs[pastedText.length - 1].focus();
                    } else {
                        otpInputs[numInputs - 1].focus();
                    }
                });
            });

            verifyButton.addEventListener('click', () => {
                otpInputs[0].focus();
            });
        }

        // Repeat the setup for different sets of OTP inputs

        const otpInputs1 = document.querySelectorAll('.otp-input1 input');
        const verifyButton1 = document.getElementById('otp-input1Button');
        setupOTPInputs(otpInputs1, verifyButton1, otpInputs1.length);

        const otpInputs2 = document.querySelectorAll('.otp-input2 input');
        const verifyButton2 = document.getElementById('otp-input2Button');
        setupOTPInputs(otpInputs2, verifyButton2, otpInputs2.length);

        const otpInputs3 = document.querySelectorAll('.otp-input3 input');
        const verifyButton3 = document.getElementById('otp-input3Button');
        setupOTPInputs(otpInputs3, verifyButton3, otpInputs3.length);

        const otpInputs4 = document.querySelectorAll('.otp-input4 input');
        const verifyButton4 = document.getElementById('otp-input4Button');
        setupOTPInputs(otpInputs4, verifyButton4, otpInputs4.length);

        const otpInputs5 = document.querySelectorAll('.otp-input5 input');
        const verifyButton5 = document.getElementById('otp-input5Button');
        setupOTPInputs(otpInputs5, verifyButton5, otpInputs5.length);

        const otpInputs6 = document.querySelectorAll('.otp-input6 input');
        const verifyButton6 = document.getElementById('otp-input6Button');
        setupOTPInputs(otpInputs6, verifyButton6, otpInputs6.length);

        const otpInputs7 = document.querySelectorAll('.otp-input7 input');
        const verifyButton7 = document.getElementById('otp-input7Button');
        setupOTPInputs(otpInputs7, verifyButton7, otpInputs7.length);

        // ... Repeat for otpInputs3, otpInputs4, otpInputs5, otpInputs6, otpInputs7



    });
</script>
@endsection