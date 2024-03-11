/*
Author       : Dreamguys
Template Name: Dreamschat - Logout
Version      : 1.0
*/
(function($) {
    "use strict";

    //window.onload = function() {
    $(document).ready(function() {
        //check session
        $.get('home/getsession', {}, function(data) {
            var chk_session = Object.keys(data).length;
            
            if (chk_session > 0) 
            {
                if (data.state == 'no') {
                    var phoneNumber = data.user;
                    firebase.database().ref('data/users/' + phoneNumber).update({
                        online: false
                    });
                    onSignOutClick(phoneNumber, 'no');
                } else {
                    firebase.auth().onAuthStateChanged(function(user) {
                        firebase.database().ref('data/users/' + user.phoneNumber).update({
                             online: false
                        });
                        onSignOutClick(user.phoneNumber, 'yes');
                    });
                }
            }
        }, 'json');
    });

    function unsetfiresession() {
        $.ajax({
            url: 'firesession',
            type: 'POST',
            data: {
                user: '', 'state':''
            },
            success: function(data) {
                // 
            }
        });
    }
    /**
     * Signs out the user when the sign-out button is clicked.
     */
    function onSignOutClick(phoneNumber, state) 
    {
        firebase.database().ref('data/users/' + phoneNumber).update({
            online: false
        }).then(function() {
            unsetfiresession();
            if (state == 'yes') {
                firebase.auth().signOut();
            } else {
                firebase.auth().signOut().then(function() {
                    window.location.href = "login";
                }).catch(function(error) {
                    // An error occurred.
                });
                //firebase.auth().signOut();
            }
        })
        .catch(function(error) {
            // An error occurred
            console.error("Update failed: " + error.message);
        });
    }
})(jQuery);