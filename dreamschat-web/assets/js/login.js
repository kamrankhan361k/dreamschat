/*
Author       : Dreamguys
Template Name: Dreamschat - Login
Version      : 1.0
*/
"use strict";
(function($) {

    $(document).ready(function() {
        $("#login-in-button").on("click", function() {
            // Reset any previous error messages
            $(".error").remove();
            
            // Validate the Email Address field
            var email = $("#l_username").val();
            if (email === "") {
                $("#l_username").after("<span class='error'>Email is required</span>");
            } else if (!isValidEmail(email)) {
                $("#l_username").after("<span class='error'>Invalid email format</span>");
            }
            var password = $("#l_password").val();
            if (password === "") {
                $("#l_password").after("<span class='error'>Password is required</span>");
            }
    
            // Check if there are no error messages; if so, the form is valid
            if ($(".error").length === 0) {
                // Form is valid, you can proceed with form submission or other actions
                // For example, you can submit the form via AJAX or navigate to another page.
                // Add your code here.
            }
        });
    
        // Event listener to remove error messages when the user interacts with the input fields
        $("#l_username, #l_password").on("input", function() {
            $(this).next(".error").remove();
        });
    
        // Email validation function
        function isValidEmail(email) {
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(email);
        }
    });
    
    /*$(document).ready(function() {
      // Select the password input and message container
      const $password = $('#l_password');
      const $message = $('#password-message');

      // Add an input event listener to the password field
      $password.on('input', function() {
        const password = $password.val();
        const isPasswordValid = validatePassword(password);

        // Display a message based on the validation result
        if (isPasswordValid) {
          $message.text('').css('color', 'green');
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
    });*/
     
  



    window.onload = function() {
        // Listening for auth state changes.
        // firebase.auth().onAuthStateChanged(function(user) {
        //     updateSignInButtonUI();
        //     updateSignInFormUI();
        //     updateVerificationCodeFormUI();
        //     if (firebase.auth().currentUser) {
        //         var d = new Date();
        //         var n = d.getTime();
        //         firebase.database().ref('data/users/' + user.phoneNumber).update({
        //             timeStamp: n
        //         });
        //         setfiresession(user.phoneNumber);
        //     }
        // });
        // Event bindings.
        //load languages
        firebase.database().ref("data/languages").once("value", function(snapshot) {
            snapshot.forEach(function (childsnapshot) 
            {
               var obj = childsnapshot.key;
               $('#language').append($("<option></option>").attr("value", obj).text(obj));
            });
        });

        document.getElementById('login-in-button').addEventListener('click', signin);
    };

    
    


    function signin() {
        var username = $("#l_username").val();
        var password = $("#l_password").val();
        // var language = $("#language").val();
        var phone = $("#phone").val();
        var language = "English";
        var nVer = navigator.appVersion;
        var nAgt = navigator.userAgent;
        var loginType = "email";
        if (username!='' && password!='') {
            //firebase.database().ref("data/authenticationSettings").once("value", function(snapshot) {
                if (loginType == 'email') {
                    firebase.auth().signInWithEmailAndPassword(username, password)
                          .then((userCredential) => {
                        //check username
                        firebase.database().ref("data/users").orderByChild('email').equalTo(username).once('value', function(snapshot) {
                            var name = snapshot.val();
                                name = Object.values(name);
                            var userref = firebase.database().ref("data/users/" + name[0]['id']);
                                    var d = new Date();
                                    var n = d.getTime();
                                    userref.update({
                                        "password": password,
                                        "timeStamp": n
                                    });
                            if (snapshot.exists()) {
                                if (snapshot.val().adminblock == false || snapshot.val().adminblock == undefined) {
                                    /*firebase.database().ref("data/users").orderByChild('password').equalTo(password).once('value', function(pwdsnapshot) 
                                    {*/
                                        //if (pwdsnapshot.exists()) {
                                            //get phone number
                                            var userref = firebase.database().ref("data/users/" + name[0]['id']);
                                            userref.update({
                                                "online":true,
                                                "osType": "web"
                                            });
                                            var username = name[0]['firstName'];
                                            setfiresession(name[0]['id'], name[0]['firstName'], username, language);
                                        /*}
                                        else {
                                            swal("Warning!", "Invalid Username or Password");
                                        }*/
                                    /*});*/
                                } else {
                                    toastr.warning("User Blocked by admin");
                                }
                            }
                            else {
                                toastr.warning("Invalid Username or Password");
                            }
                        });
                    }).catch((error) => {
                        toastr.warning("Authenticated User does not exists");
                    });
                } else {
                    //check username
                    firebase.database().ref("data/users").equalTo(phone).once('value', function(snapshot) {
                        if (snapshot.exists()) {
                            var name = snapshot.val();
                            name = Object.values(name);
                            console.log(snapshot.val().adminblock); //return false;
                            if (snapshot.val().adminblock == false || snapshot.val().adminblock == undefined) {
                                firebase.database().ref("data/users").orderByChild('password').equalTo(password).once('value', function(pwdsnapshot) 
                                {
                                    if (pwdsnapshot.exists()) {
                                        //get phone number
                                        var userref = firebase.database().ref("data/users/" + name[0]['id']);
                                        userref.update({
                                            "online":true,
                                            "osType": "web"
                                        });
                                        var username = name[0]['firstName'];

                                        setfiresession(name[0]['id'], name[0]['firstName'], username, language);
                                    }
                                    else {
                                        toastr.warning("Invalid phone or Password");
                                    }
                                });
                            } else {
                                toastr.warning("User Blocked by admin");
                            }
                        }
                        else {
                            toastr.warning("Invalid phone or Password");
                        }
                    });
                }
           // }); 
        }
        else {
            // swal("Warning!", "Please provide Email, Password");
        }
        
    }
    function setfiresession(user, name, username, language) {
        //create language
        firebase.database().ref("data/languageKeywords/"+language).once('value', function(snapshot) 
        {
            $.ajax({
                url: 'firesession',
                type: 'POST',
                data: {
                    user: user, userName: name, firstName: username, 'state':'no', 'language':language, languagedata: snapshot.val()
                },
                success: function(data) {
                    window.location.href = "home";
                }
            });
        });
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
            document.getElementById('sign-in-form').style.display = 'none';
        }
    }
    /**
     * Updates the state of the Verify code form.
     */
    function updateVerificationCodeFormUI() {
        if (!firebase.auth().currentUser && window.confirmationResult) {
            document.getElementById('verification-code-form').style.display = 'block';
        } else {
            document.getElementById('verification-code-form').style.display = 'none';
        }
    }
    $('#copy_user_details').on('click',function(){
        var username = 'demouser@gmail.com';
        var password = '123456';
        $('#l_username').val(username);
        $('#l_password').val(password); 
    });
})(jQuery);