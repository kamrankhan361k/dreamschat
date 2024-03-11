/*
Author       : Dreamguys
Template Name: Dreamschat - Login
Version      : 1.0
*/
"use strict";
(function($) {

    window.onload = function() {
        var currentUser = $("#current-user-number").val();
        var baseUrl = $("#baseUrl").val();
        firebase.database().ref("data/users/" + currentUser).once('value', function(snapshot) {
            var userName = snapshot.val().firstName +' '+ snapshot.val().lastName;
            var name = (userName)?userName:'--';
            var userStatus = (snapshot.val().status)?snapshot.val().status:'--';
            var userDob = (snapshot.val().dob)?snapshot.val().dob:'DD MM YYYY';
            var userGender = (snapshot.val().gender)?snapshot.val().gender:'--';
            var userCountry = (snapshot.val().countryName)?snapshot.val().countryName:'--';
            var userImage = (snapshot.val().image)?snapshot.val().image: baseUrl+'assets/img/user-placeholder.jpg';

            $("#current-user-name").text(name);
            $("#current-user-status").text(userStatus);
            $("#current-user-dob").text(userDob);
            $("#current-user-gender").text(userGender);
            $("#current-user-country").text(userCountry);
            $("#current-user-profile").attr("src", userImage);
            $("#current-user-profile-left").attr("src", userImage);
        });
    };
})(jQuery);

function getProfileDetails() {
    var currentUser = $("#current-user-number").val();
    var baseUrl = $("#baseUrl").val();
    firebase.database().ref("data/users/" + currentUser).once('value', function(snapshot) {
        var firstName = snapshot.val().firstName;
        var lastName = snapshot.val().lastName;
        var userStatus = (snapshot.val().status)?snapshot.val().status:'';
        var userDob = (snapshot.val().dob)?snapshot.val().dob:'';
        var userGender = (snapshot.val().gender)?snapshot.val().gender:'';
        var userCountry = (snapshot.val().countryName)?snapshot.val().countryName:'';
        var userImage = (snapshot.val().image)?snapshot.val().image: baseUrl+'assets/img/user-placeholder.jpg';

        $("#user-first-name").val(firstName);
        $("#user-last-name").val(lastName);
        $("#user-current-status").text(userStatus);
        $("#user-dob").val(userDob);
        $("#user-gender").val(userGender);
        $("#user-country").val(userCountry);
        $("#drop-zone-profile-file").attr("src", userImage);
        $("#add_image").attr("src", userImage);

        $("#edit-setting-condition").modal('show');
    });
}

function handleprofileUpload(e, a) {
    for (var t = 0; t < e.length; t++) {
        new FormData().append("file", e[t]),
            fireBaseProfileImageUpload({ file: e[t], path: "/Dreamchat", up_path: a }, function (e) {
                if (!e.error && (e.progress, e.downloadURL)) return e.downloadURL;
            });
    }
}

function fireBaseProfileImageUpload(e, a) {
    var t,
        r = e.file,
        s = e.path,
        l = e.up_path;
    r || a({ error: "file required to interact with Firebase storage" }), s || a({ error: "Node name required to interact with Firebase storage" });
    var i = { contentType: r.type },
        n = (r.name.split("."), r.size),
        o = r.type,
        d = +new Date() + "-" + r.name;
    t = generateRandomString1(12);
    var u = getFileType1(o),
        c = "";
    1 == u ? (c = "/Video") : 2 == u ? (c = "/Image") : 3 == u ? (c = "/Audio") : 5 == u ? (c = "/Document") : 8 == u && (c = "/Recording");
    var f = s + c + "/" + d,
        p = storageRef.child(f).put(r, i);
    a({ id: t, fileSize: n, fileType: o, fileName: d }),
        p.on(
            "state_changed",
            function (e) {
                var r = (e.bytesTransferred / e.totalBytes) * 100;
                (r = Math.floor(r)), a({ progress: r, element: t, fileSize: n, fileType: o, fileName: d });
            },
            function (e) {
                a({ error: e });
            },
            function () {
                var e = p.snapshot.downloadURL,
                    r = getFileType1(o);
                "other" != r ? updateprofileimage(r, e, d, n, l) : toastr.warning("Select Only Images!"), a({ downloadURL: e, element: t, fileSize: n, fileType: o, fileName: d });
            }
        );
}

function getFileType1(e) {
    return e.match("image.*") ? 2 : "other";
}

function generateRandomString1(e) {
    for (var a = "abcdefghijklmnopqrstuvwxyz", t = "", r = 0; r < e; r++) {
        var s = Math.floor(Math.random() * a.length);
        t += a.charAt(s);
    }
    return t;
}

function validateFile1(e) {
    for (var a = ["jpeg", "jpg", "png", "gif", "bmp"], t = 0; t < e.length; t++) {
        var r = e[t].name.split(".").pop().toLowerCase();
        if (-1 === jQuery.inArray(r, a)) return !1;
    }
    return !0;
}

function updateprofileimage(e, a, t, r, s) {
    var l = $("#current-user-number").val(),
        i = {};
    "profile" == s ? ((i.image = a), $(".profile-cover-avatar").html('<img class="avatar-img" name="drop-zone-profile-file" id="drop-zone-profile-file" src="'+ a +'" alt="Profile Image">')) : "",
        firebase
            .database()
            .ref("data/users/" + l)
            .update(i);
}

    $(document).ready(function() {
        // Get references to the elements
        var $fileInput = $('#drop-zone-profile-file');
        var $imagePreview = $('#add_image');

        // Listen for changes in the file input
        $fileInput.on('change', function(e) {
            var file = e.target.files[0];

            if (file) {
                // Create a FileReader object
                var reader = new FileReader();

                // Set up a function to run when the image is loaded
                reader.onload = function(e) {
                    // Set the source of the image preview to the selected file
                    $imagePreview.attr('src', e.target.result);
                };

                // Read the selected file as a data URL (base64 encoded)
                reader.readAsDataURL(file);
            } else {
                // If no file is selected or an error occurs, set a default image
                $imagePreview.attr('src', 'assets/img/avatar/avatar-2.jpg');
            }
        });
    });

function updateprofile() {
    var currentUser = $("#current-user-number").val();
    var baseUrl = $("#baseUrl").val();
    var profileImg = $("#drop-zone-profile-file")[0].files;
    var firstName = $("#user-first-name").val(),
        lastName = $("#user-last-name").val(),
        status = $("#user-current-status").val(),
        country = $("#user-country").val(),
        gender = $("#user-gender").val(),
        dob = $("#user-dob").val(),
        s = !0;
    var valflag = validateFile1(profileImg);
            if (valflag) {
                handleprofileUpload(profileImg, "profile");
            } else {
                toastr.warning("Select Only valid File!");
            }
    //profileImg && (validateFile1(profileImg) ? (s = handleprofileUpload(profileImg, "profile")) : toastr.warning("Select Only Images!"));
    0 != s && firebase.database().ref("data/users/" + currentUser).update({ 
        firstName: firstName, 
        lastName: lastName, 
        status: status, 
        countryName: country, 
        gender: gender,
        dob:dob
    }),
    toastr.success("Profile Updated Successfully!");
    setTimeout(function() {
      window.location.reload();
    }, 2000); // Adjust the delay as needed
    $("#edit-setting-condition").modal("hide");
}

function deleteUserAccout() {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to Delete your Account?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        var currentUser = $("#current-user-number").val();
        var user = firebase.auth().currentUser;
        if (user) {
            user.delete().then(function() {
                firebase.database().ref("data/users/" + currentUser).update({
                    image: '',
                    isDelted: true
                });
                var grpExitUserIds = []; // Declare and initialize it here
                var adaRef = firebase.database().ref("data/groups/").once("value", function(snapshot) {
                    snapshot.forEach(function(childSnapshot) { 
                        // Check user exists in the Group  
                        if ($.inArray(currentUser, childSnapshot.val().userIds) !== -1) {
                            if (currentUser == childSnapshot.val().admin) {
                                // Make another user as admin
                                var userIds = childSnapshot.val().userIds;
                                // Remove me from userids
                                var index = userIds.indexOf(currentUser);
                                if (index !== -1) {
                                    userIds.splice(index, 1);
                                }
                                var makeadmin = userIds[0];
                                if (childSnapshot.val().grpExitUserIds != undefined) {
                                    grpExitUserIds = childSnapshot.val().grpExitUserIds; 
                                }

                                grpExitUserIds.push(currentUser);
                                firebase.database().ref("data/groups/" + childSnapshot.key).update({
                                    admin: makeadmin,
                                    grpExitUserIds: grpExitUserIds
                                });     
                            } else {
                                var userarray = childSnapshot.val().userIds;
                                if (childSnapshot.val().grpExitUserIds != undefined) {
                                    grpExitUserIds = childSnapshot.val().grpExitUserIds; 
                                }
                                grpExitUserIds.push(currentUser);
                                
                                firebase.database().ref("data/groups/" + childSnapshot.key).update({
                                    grpExitUserIds: grpExitUserIds
                                });
                            }
                        } 
                    });
                });
                toastr.success("Your account has been deleted successfully!");
                setTimeout(function() {
                  window.location.replace("logout");
                }, 2000); // Adjust the delay as needed
                
            }).catch(function(error) {
                // An error occurred while deleting the user
                //toastr.error(error.message);
                //console.error("Error deleting user: " + error.message);
            });
        } else {
            // No user is signed in, handle this case as needed
            toastr.warning("Your account has been deleted successfully!");
        }
    });
}