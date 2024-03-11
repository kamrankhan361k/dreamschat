/*
Author       : Dreamguys
Template Name: Dreamschat - Login
Version      : 1.0
*/
"use strict";
(function($) {


    //validation 
    $(document).ready(function() {
    $("#sign-in-button").on("click", function() {
        // Reset any previous error messages
        $(".error").remove();
      var firstname = $("#firstname").val();
        if (firstname === "") {
            $("#firstname").after("<span class='error'>First Name is required</span>");
        }
      var lastname = $("#lastname").val();
        if (lastname === "") {
            $("#lastname").after("<span class='error'>Last Name is required</span>");
        }
      var email = $("#e-mail").val();
        if (email === "") {
            $("#e-mail").after("<span class='error'>Email is required</span>");
        } else if (!isValidEmail(email)) {
            $("#e-mail").after("<span class='error'>Invalid email format</span>");
        }
    var phoneNumber = $("#phone-number").val();
        if (phoneNumber === "") {
            $("#phone-number").after("<span class='error'>Phone Number is required</span>");
        } else if (!isValidPhoneNumber(phoneNumber)) {
            $("#phone-number").after("<span class='error'>Invalid phone number format</span>");
        }

    var password = $("#password").val();
        if (password === "") {
            $("#password").after("<span class='error'>Password is required</span>");
        }

    var isChecked = $("#remeber").prop('checked');
    if (!isChecked) {
        $("#remeber").after("<span class='error'>Please agree to the terms</span>");
        $('#sign-in-button').addClass('disabled');
    } else {
        $('#sign-in-button').removeClass('disabled');
    }
    });

    $("#remeber").on("click", function() {
        $('#sign-in-button').removeClass('disabled');
    });
    

   $("#firstname, #lastname, #e-mail, #phone-number, #password, #remeber").on("input", function() {
        $(this).next(".error").remove();
    });

    // Email validation function
    function isValidEmail(email) {
        var emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        return email.match(emailPattern);
    }

    // Phone number validation function
    function isValidPhoneNumber(phoneNumber) {
        var phonePattern = /\+[0-9\s\-\(\)]+/;
        return phoneNumber.match(phonePattern);
    }
});

     $(document).ready(function() {
      // Select the password input and message container
      const $password = $('#password');
      const $message = $('#password-message');

      // Add an input event listener to the password field
      $password.on('input', function() {
        const password = $password.val();
        const isPasswordValid = validatePassword(password);

        // Display a message based on the validation result
        if (isPasswordValid) {
          $message.text('Password is valid').css('color', 'green');
        } else {
          $message.text('The password must be more than 8 characters long. The password should contain at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character.').css('color', 'red');
        }
    });

    function validatePassword(password) {
        // Define your password criteria
        const minLength = 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasDigit = /\d/.test(password);

        // Perform validation
        const isLengthValid = password.length >= minLength;
        const isComplexityValid = hasUppercase && hasLowercase && hasDigit;

        return isLengthValid && isComplexityValid;
      }
    });
    window.onload = function() {
        // Listening for auth state changes.
        firebase.auth().onAuthStateChanged(function(user) {
            // updateSignInButtonUI();
            /*updateSignInFormUI();*/
            /*updateVerificationCodeFormUI();*/
            if (firebase.auth().currentUser) {
                var d = new Date();
                var n = d.getTime();
                firebase.database().ref('data/users/' + user.phoneNumber).update({
                    timeStamp: n
                });
                //setfiresession(user.phoneNumber);
            }
        });
       
        $('.numbers').on('keyup',function () { 
            this.value = this.value.replace(/[^0-9\+]/g,'');
        });
    };

    document.getElementById('sign-in-button').addEventListener('click', onSignInSubmit);
    /**
     * Function called when clicking the Login/Logout button.
     */
    function onSignInSubmit() {
        var phoneNumber = getPhoneNumberFromUserInput();
        //get user name and password
       // var username = $("#l_username").val();
        var password = $("#password").val();
        var email = $("#e-mail").val();
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var remeber = $("#remeber").val();

        var isChecked = $("#remeber").prop("checked");

        if (isPhoneNumberValid()) {           
            window.signingIn = true;           
            //Email with Password Authentication
            firebase.auth().createUserWithEmailAndPassword(email, password)
            .then((userCredential) => {
                insertusertofirebase(phoneNumber, password, email, firstname, lastname, remeber);
            }).catch(function(error) {
                // Error; SMS not sent
                toastr.warning(error.message);
                window.signingIn = false;
                /*updateSignInFormUI();*/
                updateSignInButtonUI();
            });
            
        } 
    }

    function setfiresession(user) 
    {
        firebase.database().ref("data/languages/English-en").once('value', function(snapshot) 
        {
            //console.log(snapshot.val());
            $.ajax({
                url: 'firesession',
                type: 'POST',
                data: {
                    user: user, 'state':'no', 'language':'English-en', languagedata: snapshot.val()
                },
                success: function(data) {
                    //console.log(data);
                    window.location.href = "home";
                }
            });
        });
    }
    /**
     * Function called when clicking the "Verify Code" button.
     */
    function onVerifyCodeSubmit(e) {
        e.preventDefault();
        if (!!getCodeFromUserInput()) {
            window.verifyingCode = true;
            updateVerifyCodeButtonUI();
            var code = getCodeFromUserInput();
            confirmationResult.confirm(code).then(function(result) {
                // User signed in successfully.
                var user = result.user;
                var username = $("#l_username").val();
                var password = $("#l_password").val();
                var email_id = $("#e-mail").val();
                window.verifyingCode = false;
                window.confirmationResult = null;
                updateVerificationCodeFormUI();
                //Insert user data to firebase
                insertusertofirebase(user.phoneNumber, username, password, email_id);
            }).catch(function(error) {
                // User couldn't sign in (bad verification code?)
                toastr.warning(error.message);
                window.verifyingCode = false;
                updateSignInButtonUI();
                updateVerifyCodeButtonUI();
            });
        }
    }
    /**
     * Cancels the verification code input.
     */
    function cancelVerification(e) {
        e.preventDefault();
        window.confirmationResult = null;
        updateVerificationCodeFormUI();
        updateSignInFormUI();
    }

    function insertusertofirebase(user,password, email_id, firstname, lastname, remeber) {
        var d = new Date();
        var n = d.getTime();
        var userref = firebase.database().ref("data/users/" + user);
        userref.update({
            "id": user,
            "image": "",
            "name": user,
            "nameToDisplay":firstname + lastname,
            "profileName": user,
            "firstName" : firstname,
            "lastName": lastname,
            "remeber": remeber,
            "online": true,
            "selected": true,
            "status": "Hey I am available",
            "timeStamp": n,
            "typing": '',
            "osType": "web",
            "deviceToken": "",
           
            "password":password,
            "email":email_id
        });
        window.location.href = "home";
    }
    /**
     * Reads the verification code from the user input.
     */
    function getCodeFromUserInput() {
        return document.getElementById('verification-code').value;
    }
    /**
     * Reads the phone number from the user input.
     */
    function getPhoneNumberFromUserInput() {
        return document.getElementById('phone-number').value;
    }
    /**
     * Returns true if the phone number is valid.
     */
    function isPhoneNumberValid() {
        var pattern = /^\+[0-9\s\-\(\)]+$/;
        var phoneNumber = getPhoneNumberFromUserInput();
        return phoneNumber.search(pattern) !== -1;
    }
    /**
     * Re-initializes the ReCaptacha widget.
     */
    function resetReCaptcha() {
        if (typeof grecaptcha !== 'undefined' &&
            typeof window.recaptchaWidgetId !== 'undefined') {
            grecaptcha.reset(window.recaptchaWidgetId);
        }
    }
   
    function updateVerifyCodeButtonUI() {
        document.getElementById('verify-code-button').disabled = !!window.verifyingCode ||
            !getCodeFromUserInput();
    }
   
  


})(jQuery);