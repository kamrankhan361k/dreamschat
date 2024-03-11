/*
Author       : Dreamguys
Template Name: Dreamschat - Login
Version      : 1.0
*/
"use strict";
(function($) {

    window.onload = function() {
        // Listening for auth state changes.
        //firebase.auth().signOut();
        firebase.auth().onAuthStateChanged(function(user) {
            //console.log(user.phoneNumber)
            updateSignInButtonUI();
            updateSignInFormUI();
            updateVerificationCodeFormUI();
            if (firebase.auth().currentUser) {
                var d = new Date();
                var n = d.getTime();
                firebase.database().ref('data/users/' + user.phoneNumber).update({
                    timeStamp: n
                });
                //setfiresession(user.phoneNumber);
            }
        });
        // Event bindings.
        document.getElementById('phone-number').addEventListener('keyup', updateSignInButtonUI);
        document.getElementById('phone-number').addEventListener('change', updateSignInButtonUI);
        document.getElementById('verification-code').addEventListener('keyup', updateVerifyCodeButtonUI);
        document.getElementById('verification-code').addEventListener('change', updateVerifyCodeButtonUI);
        document.getElementById('verification-code-form').addEventListener('submit', onVerifyCodeSubmit);
        document.getElementById('cancel-verify-code-button').addEventListener('click', cancelVerification);
        // [START appVerifier]
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sign-in-button', {
            'size': 'invisible',
            'callback': function(response) {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                onSignInSubmit();
            }
        });
        // [END appVerifier]
        recaptchaVerifier.render().then(function(widgetId) {
            window.recaptchaWidgetId = widgetId;
            updateSignInButtonUI();
        });
        
        $('.numbers').on('keyup',function () { 
            this.value = this.value.replace(/[^0-9\+]/g,'');
        });
    };
    /**
     * Function called when clicking the Login/Logout button.
     */
    function onSignInSubmit() {
        if (isPhoneNumberValid()) {
            var phoneNumber = getPhoneNumberFromUserInput();
            firebase.database().ref("data/users/" + phoneNumber).once('value', function(snapshot) {
                if (snapshot.val() && snapshot.val().adminblock == true) {
                    toastr.warning("SYou Are Blocked By Admin!");
                    window.location.href = "login";
                } else {
                    window.signingIn = true;
                    updateSignInButtonUI();
                    var appVerifier = window.recaptchaVerifier;
                    firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                        .then(function(confirmationResult) {
                            // SMS sent. Prompt user to type the code from the message, then sign the
                            // user in with confirmationResult.confirm(code).
                            window.confirmationResult = confirmationResult;
                            window.signingIn = false;
                            updateSignInButtonUI();
                            updateVerificationCodeFormUI();
                            updateVerifyCodeButtonUI();
                            updateSignInFormUI();
                        }).catch(function(error) {
                            // Error; SMS not sent
                            toastr.warning(error.message);
                            window.signingIn = false;
                            updateSignInFormUI();
                            updateSignInButtonUI();
                        });
                }
            });
        } else {
            toastr.warning("Please Enter Vaild Number (eg : +2993299999)");
        }
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
            var new_password = $("#new_password").val();
            var confirm_password = $("#confirm_password").val();
            if (new_password.trim().length>0) {
                if (new_password === confirm_password) {
                    confirmationResult.confirm(code).then(function(result) {
                // User signed in successfully.
                        var user = result.user;
                        window.verifyingCode = false;
                        window.confirmationResult = null;
                        updateVerificationCodeFormUI();
                        //update password
                        updatepassword(user.phoneNumber, new_password);
                        
                        //insertusertofirebase(user.phoneNumber);
                    }).catch(function(error) {
                        // User couldn't sign in (bad verification code?)
                        toastr.warning(error.message);
                        window.verifyingCode = false;
                        updateSignInButtonUI();
                        updateVerifyCodeButtonUI();
                    });
                }
                else {
                    toastr.warning("Passwords are mismatched");
                }
            }
            else {
                toastr.warning("Password should not be empty");
            }
            
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
    function updatepassword(user, new_password) {
        var d = new Date();
        var n = d.getTime();
        var userref = firebase.database().ref("data/users/" + user);
        userref.update({
            "password": new_password,
            "timeStamp": n
        });
        firebase.auth().signOut();
        window.location.href = 'login';
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
    /**
     * Updates the Sign-in button state depending on ReCAptcha and form values state.
     */
    function updateSignInButtonUI() {
        document.getElementById('sign-in-button').disabled = !isPhoneNumberValid() ||
            !!window.signingIn;
    }
    /**
     * Updates the Verify-code button state depending on form values state.
     */
    function updateVerifyCodeButtonUI() {
        document.getElementById('verify-code-button').disabled = !!window.verifyingCode ||
            !getCodeFromUserInput();
    }
    /**
     * Updates the state of the Sign-in form.
     */
    function updateSignInFormUI() {
        if (firebase.auth().currentUser || window.confirmationResult) {
            document.getElementById('sign-in-form').style.display = 'none';
        } else {
            resetReCaptcha();
            document.getElementById('sign-in-form').style.display = 'block';
        }
    }
    /**
     * Updates the state of the Verify code form.
     */
    function updateVerificationCodeFormUI() {
        console.log(firebase.auth().currentUser);
        console.log(window.confirmationResult);
        if (!firebase.auth().currentUser && window.confirmationResult) {
            document.getElementById('verification-code-form').style.display = 'block';
        } else {
            document.getElementById('verification-code-form').style.display = 'none';
        }
    }
})(jQuery);