<!DOCTYPE html>
<html>

<head>
    <title>Radio Buttons Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/radiobutton.js') }}"></script>

    <link rel="stylesheet" href="{{ URL::asset('toaster/toaster.min.css') }}">
    <style>
        .otp-input1 {
            display: inline-block;
            font-size: 24px;
            text-align: center;
        }

        .otp-input1 input {
            width: 40px;
            height: 50px;
            text-align: center;
            margin: 0 5px;
            font-size: 24px;
        }

        .otp-input2 {
            display: inline-block;
            font-size: 24px;
            text-align: center;
            width: 40%;
            display: flex;
        }

        .otp-input2 input {
            width: 40px;
            height: 50px;
            text-align: center;
            margin: 0 5px;
            font-size: 24px;
        }

        .otp-input3 {
            display: inline-block;
            font-size: 24px;
            text-align: center;
            width: 40%;
            display: flex;
        }

        .otp-input3 input {
            width: 40px;
            height: 50px;
            text-align: center;
            margin: 0 5px;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <form>
        <div class="radio-option">
            <label>
                <input type="radio" id="switch-none" name="selected_value" value="NULL"> None
            </label>
        </div>
        <div class="radio-option">
            <label>
                <input type="radio" id="switch-email" name="selected_value" value="email_enable"> Email 2FA
            </label>
        </div>
        <div class="radio-option">
            <label>
                <input type="radio" id="switch-barcode" name="selected_value" value="QR_enable"> QR code 2FA
            </label>
        </div>
    </form>



    <!-- Email enter form -->
    <div class="card" id="email-input"
        style="border: 1px solid #d0cece; background:#f5f5f5; display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
        <!-- <div id="verification_heading" class="card-header d-flex justify-content-center mt-2">2FA Verification with Email</div> -->

        <div class="card-body" style="border: 1px solid #d0cece; background:#f5f5f5;">
            <form id="emailForm" method="post" action="#">
                @csrf
                <!-- <p class="text-center">We sent otp to email: {{ substr($user->email, 0, 5) . '******' . substr($user->email, -2) }}</p> -->
                <div>
                    <p id="verification_heading">Enter your email address</p>
                    <div class="form-group row">
                        <div class="input-group" style="margin-left:10px">
                            <input type="hidden" value="" name="radioButtonValue" id="radioButtonValue">
                            <div class="otp-input">
                                <input class="form-control form-control-lg m-input m-input--square" type="text"
                                    height="10px" name="email" id="emailInput">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="margin-left: 10px; background-color:#2156a6; font-size:12px"
                                id="save-button">Send Code</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- Email OTP Form --}}
    <div class="container email-otp-input" id="email-otp-input"
        style="display:none; width:70%; margin-left:auto; margin-right:5%; margin-bottom:3%">
        <div class="row w-100 align-items-center">
            <div class="col-md-8">
                <form id="emailOtpForm" method="post" action="#">
                    @csrf
                    <input type="hidden" value="" name="radioButtonSecondValue" id="radioButtonSecondValue">
                    <p style="margin-left: 10px;">Enter 6 digit authentication code to complete the process</p>
                    <div class="otp-input2 w-100 qr_code_show_form">
                        <div>
                            <input type="text" maxlength="1" name="email_otp1" id="email_otp1" autofocus>
                            <input type="text" maxlength="1" name="email_otp2" id="email_otp2">
                            <input type="text" maxlength="1" name="email_otp3" id="email_otp3">
                            <input type="text" maxlength="1" name="email_otp4" id="email_otp4">
                            <input type="text" maxlength="1" name="email_otp5" id="email_otp5">
                            <input type="text" maxlength="1" name="email_otp6" id="email_otp6">
                        </div>
                        <div class="d-flex align-self-stretch ">
                            <button style="width: 100%; background-color:#2156a6;"
                                class="btn btn-primary btn-sm verify-button">Verify</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>


<script src="{{ URL::asset('toaster/toaster.min.js') }}"></script>
<script>
    // public/js/radiobutton.js
    $(document).ready(function() {

        var url = "{{ route('checkbox.get') }}";

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                console.log(response)
                // return;
                if (response.checkBoxValue === 'email_enable') {
                    $('#switch-email').prop('checked', true);
                    updateRadioButtons('email_enable');
                } else if (response.checkBoxValue === 'barcode_enable') {
                    $('#switch-barcode').prop('checked', true);
                    updateRadioButtons('barcode_enable');
                } else {
                    $('#switch-none').prop('checked', true);
                    updateRadioButtons('none');
                }
                $('#emailForm')[0].reset();
                $('#emailOtpForm')[0].reset();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            }
        });






        $('input[type="radio"]').on('change', function() {
            var selectedValue = $(this).val();
            $.ajax({
                type: 'POST',
                url: '/store-radio-value',
                data: {
                    selected_value: selectedValue,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {
                    console.log(selectedValue);
                    if (selectedValue == 'email_enable') {
                        if (data.message == "alreadyupdated") {
                            $('#qr_code_show').hide();
                            $('#email-input').hide();
                            $('.email-otp-input').hide();
                            $('#qr_code_show_second').hide();
                            toastr.success("This 2FA setting is Already enabled");
                        } else {
                            $('#email-input').show();
                            $('.email-otp-input').hide();
                            $('#radioButtonValue').val(selectedValue);
                            toastr.success("Please enter your email to enable 2FA");
                            $('#emailForm')[0].reset();
                        }
                    } else if (selectedValue == 'barcode_enable') {
                        $('#email-input').hide();
                        $('.email-otp-input').hide();
                    } else {
                        $('#email-input').hide();
                        $('.email-otp-input').hide();
                    }
                },
                error: function(xhr) {
                    console.error('Error storing value');
                },
            });
        });



        $('#emailForm').submit(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            var formData = form.serialize();
            $.ajax({
                url: "{{ route('email.sent') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#email-input').hide();
                    $('.email-otp-input').show();
                    $('#email_code_old_otp_form').hide();
                    $('#radioButtonSecondValue').val(response.radioButtonValue);
                    toastr.success("Please enter OTP");
                    $('#emailForm')[0].reset();
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    toastr.clear();

                    $.each(errors, function(field, error) {
                        toastr.error(error[0]);
                    });
                    $('#emailForm')[0].reset();
                },
            });
        });




        $('#emailOtpForm').submit(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            console.log(form)
            function areAllFieldsFilled() {
                var allFieldsFilled = true;
                form.find('input:visible').each(function() {
                    if ($(this).val().trim() === '') {
                        allFieldsFilled = false;
                        return false;
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
            console.log(formData)
            $.ajax({
                url: '{{ route('enable.email.otp') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    toastr.success("Updated Successfully");
                    console.log(response);
                    // return;
                    $('#radioButtonSecondQrValue').val(response.radioButtonQrValue);
                    $('#qr_code_show_second').hide();
                    $('#qr_code_show').hide();
                    $('#email-otp-input').hide();
                    $('.email-otp-input').hide();
                    $('#emailForm')[0].reset();
                    $('#emailOtpForm')[0].reset();
                    // location.reload();
                    var url = "{{ route('checkbox.get') }}";

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            console.log(response)
                            // return;
                            if (response.checkBoxValue === 'email_enable') {
                                $('#switch-email').prop('checked', true);
                                updateRadioButtons('email_enable');
                            } else if (response.checkBoxValue ===
                                'barcode_enable') {
                                $('#switch-barcode').prop('checked', true);
                                updateRadioButtons('barcode_enable');
                            } else {
                                $('#switch-none').prop('checked', true);
                                updateRadioButtons('none');
                            }
                            $('#emailForm')[0].reset();
                            $('#emailOtpForm')[0].reset();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log(xhr.responseText);
                        }
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



        function updateRadioButtons(selectedCheckbox) {
            if (selectedCheckbox === 'none') {
                $('#switch-email').prop('checked', false);
                $('#switch-barcode').prop('checked', false);
                $('#switch-none').prop('checked', true);
            } else if (selectedCheckbox === 'email_enable') {
                $('#switch-email').prop('checked', true);
                $('#switch-barcode').prop('checked', false);
                $('#switch-none').prop('checked', false).prop('disabled', false);
                // console.log('email checked')
            } else if (selectedCheckbox === 'barcode_enable') {
                $('#switch-email').prop('checked', false);
                $('#switch-barcode').prop('checked', true);
                $('#switch-none').prop('checked', false).prop('disabled', false);
            }
        }

    });
</script>


<script>
    // Get references to the OTP input fields
    const otpInputs1 = document.querySelectorAll('.otp-input1 input');

    // Add event listeners to each OTP input field
    otpInputs1.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            const nextInput = otpInputs1[index + 1];
            const prevInput = otpInputs1[index - 1];

            // Move focus to the next input field after entering a digit
            if (input.value.length === 1 && nextInput) {
                nextInput.focus();
            }

            // Move focus to the previous input field if the current field is empty
            if (input.value.length === 0 && prevInput) {
                prevInput.focus();
            }
        });

        // Handle backspace key press to move focus to the previous input field
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && input.value.length === 0) {
                const prevInput = otpInputs1[index - 1];
                if (prevInput) {
                    prevInput.focus();
                }
            }
        });

        otpInputs1[0].addEventListener('paste', (e) => {
            e.preventDefault();
            const pastedText = e.clipboardData.getData('text/plain').trim();
            const numInputs = otpInputs1.length;
            for (let i = 0; i < numInputs; i++) {
                if (pastedText[i] && otpInputs1[i]) {
                    otpInputs1[i].value = pastedText[i];
                } else {
                    break;
                }
            }

            if (pastedText.length <= numInputs) {
                otpInputs1[pastedText.length - 1].focus();
            } else {
                otpInputs1[numInputs - 1].focus();
            }
        });
    });



    // Get references to the OTP input fields
    const otpInputs2 = document.querySelectorAll('.otp-input2 input');

    // Add event listeners to each OTP input field
    otpInputs2.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            const nextInput = otpInputs2[index + 1];
            const prevInput = otpInputs2[index - 1];

            // Move focus to the next input field after entering a digit
            if (input.value.length === 1 && nextInput) {
                nextInput.focus();
            }

            // Move focus to the previous input field if the current field is empty
            if (input.value.length === 0 && prevInput) {
                prevInput.focus();
            }
        });

        // Handle backspace key press to move focus to the previous input field
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && input.value.length === 0) {
                const prevInput = otpInputs2[index - 1];
                if (prevInput) {
                    prevInput.focus();
                }
            }
        });

        otpInputs2[0].addEventListener('paste', (e) => {
            e.preventDefault();
            const pastedText = e.clipboardData.getData('text/plain').trim();
            const numInputs = otpInputs2.length;
            for (let i = 0; i < numInputs; i++) {
                if (pastedText[i] && otpInputs2[i]) {
                    otpInputs2[i].value = pastedText[i];
                } else {
                    break;
                }
            }

            if (pastedText.length <= numInputs) {
                otpInputs2[pastedText.length - 1].focus();
            } else {
                otpInputs2[numInputs - 1].focus();
            }
        });
    });


    const otpInputs3 = document.querySelectorAll('.otp-input3 input');

    // Add event listeners to each OTP input field
    otpInputs3.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            const nextInput = otpInputs3[index + 1];
            const prevInput = otpInputs3[index - 1];

            // Move focus to the next input field after entering a digit
            if (input.value.length === 1 && nextInput) {
                nextInput.focus();
            }

            // Move focus to the previous input field if the current field is empty
            if (input.value.length === 0 && prevInput) {
                prevInput.focus();
            }
        });

        // Handle backspace key press to move focus to the previous input field
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && input.value.length === 0) {
                const prevInput = otpInputs3[index - 1];
                if (prevInput) {
                    prevInput.focus();
                }
            }
        });

        otpInputs3[0].addEventListener('paste', (e) => {
            e.preventDefault();
            const pastedText = e.clipboardData.getData('text/plain').trim();
            const numInputs = otpInputs3.length;
            for (let i = 0; i < numInputs; i++) {
                if (pastedText[i] && otpInputs3[i]) {
                    otpInputs3[i].value = pastedText[i];
                } else {
                    break;
                }
            }

            if (pastedText.length <= numInputs) {
                otpInputs3[pastedText.length - 1].focus();
            } else {
                otpInputs3[numInputs - 1].focus();
            }
        });
    });
</script>
