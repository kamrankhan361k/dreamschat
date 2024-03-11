/*
Author       : Dreamguys
Template Name: Dreamschat - Login
Version      : 1.0
*/
"use strict";
(function($) {
    var currentUser = $("#current-user-number").val();
    var baseUrl = $("#baseUrl").val();

    window.onload = function() {
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

        //$('.contact-title').hide();
        //$('.chat_sidebar').hide();
        
        var i = 0;
        firebase.database().ref("data/contacts/" + currentUser).orderByChild("firstName").once('value', function(snapshot) {
            if (snapshot.exists()) {
                snapshot.forEach(function(childSnapshot) {
                    if(childSnapshot.val().isBlocked == false) {
                            if(childSnapshot.val().image == undefined || childSnapshot.val().image == "") {
                                var profileImage = baseUrl+'assets/img/user-placeholder.jpg';
                            } else {
                                var profileImage = childSnapshot.val().image;
                            }
                            $('<li class="user-list-item"><a href="javascript:;" onclick=showContactDetails(\'' + currentUser + '\',\'' + childSnapshot.key + '\'); ><div class="avatar"><img src="'+ profileImage +'" class="rounded-circle" alt="image"></div><div class="users-list-body"><div><h5>'+ childSnapshot.val().firstName +' '+ childSnapshot.val().lastName + '</h5></div></div></a></li>').appendTo('.contact-users');
                            i++;

                            $('.contact-title').show();
                            $('.chat-contact').show();

                        if(i == 1) {
                            showContactDetails(currentUser, childSnapshot.key);
                        }
                    }
                });
            } else {
                $('.contact-title').hide();
                $('<div class="status-right"><div class="empty-dark-img"><img src="assets/img/empty-img-dark.png" alt="Image"></div><div class="select-message-box"><h4>Select Contact</h4><p>To see your existing conversation or share a link below to start new</p><a href="javascript:;" class="btn btn-primary"  onclick="addContact();"><i class="bx bx-plus me-1"></i>Add New Contacts</a></div></div>').appendTo('.chat-contact');
                $('Contact List Not Found').appendTo('.contact-users');
            }
        
        });
    }

})(jQuery);

//New User Search
$("#contact-search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".contact-users li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

function showContactDetails(currentUser, contactUser) {
    $('.chat-contact').empty();
    firebase.database().ref("data/contacts/" + currentUser + '/' + contactUser).once('value', function(snapshot) {

        //var contactImg = baseUrl+'assets/img/user-placeholder.jpg';
        var websiteAddress = '--';
        if(snapshot.val() != null && snapshot.val().isBlocked == false) {
            if(snapshot.val().websiteAddress != "" || snapshot.val().websiteAddress != undefined) {
                websiteAddress = snapshot.val().websiteAddress;
            }
            if(snapshot.val().isBlocked == true) {
                var blockUnblockDetails = '<a href="#" class="dropdown-item" onclick="unblockContact(\'' + contactUser + '\');"><span><i class="bx bx-block"></i></span>Unblock</a>';
            } else {
                var blockUnblockDetails = '<a href="#" class="dropdown-item" onclick="blockContact(\'' + contactUser + '\');"><span><i class="bx bx-block"></i></span>Block</a>';
            }
            firebase.database().ref("data/users/" + contactUser).once('value', function(childSnapshot) {
                if(childSnapshot.val()) {
                    var lastSeen = 'Last seen at '+ secondsToString(childSnapshot.val().timeStamp);
                } else {
                    var lastSeen = '--';
                }
                if(childSnapshot.val().image != "") {
                    var contactImg = childSnapshot.val().image;
                } else if(childSnapshot.val().image != null || childSnapshot.val().image != undefined) {
                    var contactImg = baseUrl+'assets/img/user-placeholder.jpg';
                } else {
                    var contactImg = baseUrl+'assets/img/user-placeholder.jpg';
                }

                $('<div class="slimscroll"><div class="chat-header mb-4"><div class="user-details"><div class="d-lg-none"><ul class="list-inline mt-2 me-2"><li class="list-inline-item"><a class="text-muted px-0 left_side" href="#" data-chat="open"><i class="fas fa-arrow-left"></i></a></li></ul></div><figure class="avatar"><img src="'+ contactImg +'" class="rounded-circle" alt="image"></figure><div class="mt-1"><h5 id="selected-contact-user">'+ snapshot.val().firstName+ ' ' +snapshot.val().lastName + '</h5><small class="last-seen">'+ lastSeen +'</small></div></div><div class="chat-options chat-contact-list"><ul class="list-inline"><li class="list-inline-item" ></li><li class="list-inline-item" ><a href="javascript:void(0)" onclick="createChat(\'' + currentUser + '\', \'' + contactUser + '\');" class="btn btn-outline-light not-chat-user"><i class="bx bx-message-square-dots"></i></a></li><li class="list-inline-item"><a class="btn btn-outline-light no-bg" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu dropdown-menu-end contact-menus" ><a href="#" class="dropdown-item" onclick="editContact(\'' + contactUser + '\');"><span><i class="bx bx-pencil"></i></span>Edit</a><a href="#" class="dropdown-item" onclick="deleteContact(\'' + contactUser + '\');"><span><i class="bx bx-trash"></i></span>Delete</a>'+ blockUnblockDetails +'</div></li></ul></div></div><div class="row"><div class="col-xl-8"><div class="personal-info card"><h5>Personal Informations</h5><ul><li><h6><i class="bx bx-phone"></i>Phone Number</h6><span>'+ snapshot.val().mobilenumber +'</span></li><li><h6><i class="bx bx-globe"></i>Website Address</h6><span>'+ websiteAddress +'</span></li></ul></div></div></div></div>').appendTo('.chat-contact');
            });
        }
    });
}

$("#mobilenumber").on("change", function() {
        var frienduser = $('#mobilenumber').val();
        var currentUser = $("#current-user-number").val();
        //check user available in dreamchat
        firebase.database().ref("data/users").orderByChild("id").equalTo(frienduser).once('value', function(checkusershot) {
            if (!checkusershot.exists()) {
                $('#add-new-contact').addClass('disabled');
                toastr.warning("Sorry there is no user available");
                return false;
            } else {
                firebase.database().ref("data/contacts/" + currentUser + '/'+frienduser).once('value', function(snapshot) {
                    if (snapshot.exists()) {
                        $('#add-new-contact').addClass('disabled');
                        toastr.warning("Sorry, This user already exists in your contact list");
                        return false;
                    } else {
                        $('#add-new-contact').removeClass('disabled');
                    }
                });   
            }
        });
    });

function editContact(contactUser) {
    var baseUrl = $("#baseUrl").val();
    var currentUser = $("#current-user-number").val();

    firebase.database().ref("data/contacts/" + currentUser + "/" + contactUser).once('value', function(snapshot) {
        var firstName = snapshot.val().firstName;
        var lastName = snapshot.val().lastName;
        var mobilenumber = (snapshot.val().mobilenumber)?snapshot.val().mobilenumber:'';
        var websiteAddress = (snapshot.val().websiteAddress)?snapshot.val().websiteAddress:'';
        var userImage = (snapshot.val().image)?snapshot.val().image: baseUrl+'assets/img/user-placeholder.jpg';

        $("#edit-firstName").val(firstName);
        $("#edit-lastName").val(lastName);
        $("#edit-mobilenumber").val(mobilenumber);
        $("#edit-websiteAddress").val(websiteAddress);
        $("#edcontact-user-img").attr("src", userImage);

        $("#edit-contact").modal('show');
    });
}

function updateContact() {
    var baseUrl = $("#baseUrl").val();
    var currentUser = $("#current-user-number").val();

    var firstName = $('#edit-firstName').val();
    var lastName = $('#edit-lastName').val();
    var mobilenumber = $('#edit-mobilenumber').val();
    var websiteAddress = $('#edit-websiteAddress').val();

        firebase.database().ref("data/contacts/" + currentUser +"/"+ mobilenumber).update({ 
            firstName: firstName, 
            lastName: lastName,  
            mobilenumber: mobilenumber, 
            websiteAddress: websiteAddress
        }),
        toastr.success("User Details Updated Successfully!");
        setTimeout(function() {
          window.location.reload();
        }, 2000); // Adjust the delay as needed
        //showContactDetails(currentUser, mobilenumber);
        $("#edit-contact").empty();
        $("#edit-contact").modal("hide");
}

function createChat(currentUser, contactUser) {
    var chatCombination = currentUser +'-'+ contactUser;
    firebase.database().ref("data/chats/" + chatCombination).once("value", function(snapshot) {
        if (snapshot.child(chatCombination).exists() != true) {
            var d = new Date();
            var n = d.getTime();
            var newChat = firebase.database().ref("data/chats/" + chatCombination).push();
            newChat.set({
                "date": n
            });
            window.location.href = baseUrl+"home";
        } else {
            window.location.href = baseUrl+"home";
        }
    });
}

function blockContact(contactUser) {
    var currentUser = $("#current-user-number").val();
    var contactUserName = "";
    var blockedContactUser = $("#block-contact-user").val();
    if(blockedContactUser == "") {
        $("#block-contact-user").val(contactUser);
        firebase.database().ref("data/contacts/" + currentUser + "/" + contactUser).once('value', function(snapshot) {
            contactUserName = snapshot.val().firstName+' '+snapshot.val().lastName;

            $('.modal-title').text('Block ' + contactUserName);
            $('#block-user').modal('show');
        });
    } else {
        firebase.database().ref("data/contacts/" + currentUser + "/" + blockedContactUser).update({
            isBlocked: true
        });
        $('#block-user').modal('hide');
        toastr.success("Contact Blocked Successfully!");
        setTimeout(function() {
          window.location.reload();
        }, 2000); // Adjust the delay as needed
    }
}

function deleteContact(contactUser) {
    var currentUser = $("#current-user-number").val();
    var contactUserName = "";
    var deleteContactUser = $("#delete-contact-user").val();
    if(deleteContactUser == "") {
        $("#delete-contact-user").val(contactUser);
        firebase.database().ref("data/contacts/" + currentUser + "/" + contactUser).once('value', function(snapshot) {
            contactUserName = snapshot.val().firstName+' '+snapshot.val().lastName;

            $('.modal-title').text('Delete ' + contactUserName);
            $('#delete-contact').modal('show');
        });
    } else {
        firebase.database().ref("data/contacts/" + currentUser + "/" + deleteContactUser).remove();
        $('#delete-contact').modal('hide');
        showContactDetails(currentUser, contactUser);
        toastr.success("Contact Deleted Successfully!");
    }
}

function addContact() {
    $("#add-contact").modal("show");
    $('.modal-title').text('Add Contact');
    $('#add-new-contact').text('Add Contact');
    //$("#add-contact").empty();
}

function addContacts() {
    var currentUser = $("#current-user-number").val();
    var firstName = $('#firstName').val();
    var lastName = $('#lastName').val();
    var mobilenumber = $('#mobilenumber').val();
    var websiteAddress = $('#websiteAddress').val();

    if(!firstName && !lastName) {
        toastr.warning("First Name, Last Name cannot be empty");
        return false;
    }

    if(!mobilenumber) {
        toastr.warning("Mobile Numbe cannot be empty");
        return false;
    }

    firebase.database().ref("data/contacts/" + currentUser +"/"+ mobilenumber).update({ 
        firstName: firstName, 
        lastName: lastName, 
        mobilenumber: mobilenumber, 
        websiteAddress: websiteAddress,
        isBlocked: false
    }),
        toastr.success("Contact User Added Successfully");
        setTimeout(function() {
          window.location.reload();
        }, 2000); // Adjust the delay as needed
    $("#add-contact").empty();
    $("#add-contact").modal("hide");
}

function secondsToString(millis) {

    var currentDate = new Date();
    var timestampDate = new Date(millis);

    var formattedDate = formatDate(timestampDate);
    var todayDate = formatDate(currentDate);

    var todaysDate = new Date(todayDate);
    var pastDate = new Date(formattedDate);

    var date1 = todaysDate.getTime();
    var date2 = pastDate.getTime();

    // Compare the current date with the timestamp date
    if (date1 > date2) {
        var formattedDate = formatDateWithCustomFormat(timestampDate);
        var strOut = formattedDate;
    } else if (date1 < date2) {
        var formattedDate = formatDateWithCustomFormat(timestampDate);
        var strOut = formattedDate;
    } else {
        var data = new Date(parseInt(millis));
        var data1 = data.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric' });
        var strOut = data1;
    }

    return strOut;
}

function formatDate(date) {
      var day = date.getDate();
      var month = date.getMonth() + 1; // Months are 0-based
      var year = date.getFullYear();

      // Add leading zeros if needed
      if (day < 10) day = '0' + day;
      if (month < 10) month = '0' + month;

      return month + '-' + day + '-' + year;
    }

function formatDateWithCustomFormat(date) {
    var months = [
        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];

    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? "PM" : "AM";
    hours = hours % 12;
    hours = hours ? hours : 12; // Handle midnight (12:00) as 12 AM
    minutes = minutes < 10 ? "0" + minutes : minutes;

    return (
        day + "-" + months[monthIndex] + "-" + year + " " +
        hours + ":" + minutes + " " + ampm
      );
}