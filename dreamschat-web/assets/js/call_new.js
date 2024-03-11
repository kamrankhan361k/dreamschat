/*
Author       : Dreamguys
Template Name: Dreamschat - Call
Version      : 1.0
*/
(function($) {
    //"use strict";
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
        
        if (envData.DB_INTERFACE_THEME == 'light'){
            $('body').removeClass('darkmode');  
        } else {
            $('body').addClass('darkmode');
        }
        var currentuser = $('#current-user-number').val();
        var baseUrl = $("#baseUrl").val();
        firebase.database().ref("data/users/" + currentuser).once('value', function(snapshot) {
            if (snapshot.val().adminblock == true) {
                window.location.href = "logout";
            }
        });
        $(".user-list-item").remove();
        $('.close_profile').trigger('click');
        var i = 0;
        var pathname = window.location.pathname.split("/").pop();

        firebase.database().ref("data/chats").on("child_added", function(snapshot) {
            var string = snapshot.key;
           var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
            var substring = currentuser;
            var substring1 = "roup";

            //Stars
            if (string.startsWith(currentuser+"-") == true) {
                //
                var touser = string.replace(currentuser+"-", '');
                var usersRef = firebase.database().ref("data/users/");
                usersRef.once('value', function(snapshot) {
                    
                   
                    if (snapshot.val().online == true) {
                        var online_status = 'avatar-online';
                    } else {
                        var online_status = 'avatar-offline';
                    }
                    var to_div_time = touser.replace('+', '');
                    var lastMsgCall = '<p class="phone-income"><i class="bx bx-phone-incoming"></i>Just Now</p>';
                        firebase.database().ref("data/calls/"+touser).limitToLast(1).once("value", function(lchatshot) {
                        if (lchatshot.exists() || lchatshot.val()!= null) {
                            lchatshot.forEach(function(childSnapshot) {
                                    if (childSnapshot.val().inOrOut == 'IN' && childSnapshot.val().callerId == currentuser) {
                                        lastMsgCall = '<p class="phone-income"><i class="bx bx-phone-incoming"></i>'+secondsToString(childSnapshot.val().currentMills)+'</p>';
                                    } 

                                    if (childSnapshot.val().inOrOut == 'CANCELED' && childSnapshot.val().callerId != currentuser) {
                                        lastMsgCall = '<p class="phone-missed"><i class="bx bx-phone-off"></i>'+secondsToString(childSnapshot.val().currentMills)+'</p>';
                                    }

                                    if (childSnapshot.val().inOrOut == 'OUT' && childSnapshot.val().callerId != currentuser) {
                                        lastMsgCall = '<p class="phone-outgoing"><i class="bx bx-phone-outgoing"></i>'+secondsToString(childSnapshot.val().currentMills)+'</p>';
                                    }
                            
                    var username = '';
                    if (snapshot.child(touser).val().firstName == null || snapshot.child(touser).val().firstName == undefined) 
                        {
                            username = touser;
                        }
                        else {
                         
                            username = snapshot.child(touser).val().firstName;
                        }
                    if (snapshot.child(touser).exists() == true) {
                        if (snapshot.child(touser).val().image != "" && snapshot.child(touser).val().image != undefined) {
                            imageval = snapshot.child(touser).val().image;
                        }else{
                            imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                        }
                      
                        if (snapshot.child(touser).val().online == true) {
                            var online_status = 'avatar-online';
                        } else {
                            var online_status = 'avatar-offline';
                        }
                        

                        $('<li id="sendclick_' + i + '" class="user-list-item"><a href="javascript:;" ><div class="avatar  ' + online_status + '" onclick="showcallhistory(\'' + currentuser + '\',\'' + touser + '\', \'' + string + '\');"><img src="' + imageval + '" class="rounded-circle mCS_img_loaded" alt="image"></div><div class="users-list-body"><div onclick="showcallhistory(\'' + currentuser + '\',\'' + touser + '\', \'' + string + '\');"><h5>' + username + '</h5>'+lastMsgCall+'</div><div class="last-chat-time"><small id="userlogin_time' + to_div_time + '" class="text-muted">' + secondsToString(snapshot.child(touser).val().timeStamp) + '</small><div class="chat-pin"><i class="bx bx-phone"></i></div></div></div></a></li>').appendTo($('.call-user-list'));
                    } else {
                        $('<li id="sendclick_' + i + '" class="user-list-item"><a href="javascript:;" ><div class="avatar  ' + online_status + '" onclick="showcallhistory(\'' + currentuser + '\',\'' + touser + '\', \'' + string + '\');"><img src="' + imageval + '" class="rounded-circle mCS_img_loaded" alt="image"></div><div class="users-list-body"><div onclick="showcallhistory(\'' + currentuser + '\',\'' + touser + '\', \'' + string + '\');"><h5>' + username + '</h5>'+lastMsgCall+'</div><div class="last-chat-time"><small id="userlogin_time' + to_div_time + '" class="text-muted">' + secondsToString(snapshot.child(touser).val().timeStamp) + '</small><div class="chat-pin"><i class="bx bx-phone"></i></div></div></div></a></li>').appendTo($('.call-user-list'));
                    }
                    });
                        }
                    });
                });
                if (i == 0) {
                    showcallhistoryfirst(currentuser, touser, string);
           }
                i++;
                //
            }
            //
            //Endsw     ith
            if (string.endsWith("-"+currentuser) == true) {
                var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                var touser = string.replace("-"+currentuser, '');
                var usersRef = firebase.database().ref("data/users/");
                usersRef.once('value', function(snapshot) {
                    
                    if (snapshot.val().online == true) {
                        var online_status = 'avatar-online';
                    } else {
                        var online_status = 'avatar-offline';
                    }

                    var lastMsgCall = '<p class="phone-income"><i class="bx bx-phone-incoming"></i>Just Now</p>';
                    firebase.database().ref("data/calls/"+touser).limitToLast(1).once("value", function(lchatshot) {
                        if (lchatshot.exists()) {
                            lchatshot.forEach(function(childSnapshot) {
                                    
                                    if (childSnapshot.val().inOrOut == 'IN' && from == childSnapshot.val().callerId) {
                                        lastMsgCall = '<p class="phone-income"><i class="bx bx-phone-incoming"></i>'+secondsToString(childSnapshot.val().currentMills)+'</p>';
                                    } 
                                    if (childSnapshot.val().inOrOut == 'CANCELED') {
                                        lastMsgCall = '<p class="phone-missed"><i class="bx bx-phone-off"></i>'+secondsToString(childSnapshot.val().currentMills)+'</p>';
                                    }

                                    if (childSnapshot.val().inOrOut == 'OUT') {
                                        lastMsgCall = '<p class="phone-outgoing"><i class="bx bx-phone-outgoing"></i>'+secondsToString(childSnapshot.val().currentMills)+'</p>';
                                    }
                            
                    if (snapshot.child(touser).exists() == true) {
                        if (snapshot.child(touser).val().image != "" && snapshot.child(touser).val().image != undefined) {
                            imageval = snapshot.child(touser).val().image;
                        }else{
                            imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                        }
                        if (snapshot.child(touser).val().online == true) {
                            var online_status = 'avatar-online';
                        } else {
                            var online_status = 'avatar-offline';
                        }
                        if (snapshot.child(touser).val().username == null || snapshot.child(touser).val().username == undefined) 
                        {
                            var username = touser;
                        }
                        else {
                            var username = snapshot.child(touser).val().username;
                        }
                        
                        var to_div_time = touser.replace('+', '');
                        $('<li id="sendclick_' + i + '" class="user-list-item"><a href="javascript:;" ><div class="avatar  ' + online_status + '" onclick="showcallhistory(\'' + currentuser + '\',\'' + touser + '\', \'' + string + '\');"><img src="' + imageval + '" class="rounded-circle mCS_img_loaded" alt="image"></div><div class="users-list-body"><div onclick="showcallhistory(\'' + currentuser + '\',\'' + touser + '\', \'' + string + '\');"><h5>' + username + '</h5>'+lastMsgCall+'</div><div class="last-chat-time"><small id="userlogin_time' + to_div_time + '" class="text-muted">' + secondsToString(snapshot.child(touser).val().timeStamp) + '</small><div class="chat-pin"><i class="bx bx-phone"></i></div></div></div></a></li>').appendTo($('.call-user-list'));
                        
                    } else {

                        var to_div_time = touser.replace('+', '');
                        $('<li id="sendclick_' + i + '" class="user-list-item"><a href="javascript:;" ><div class="avatar  ' + online_status + '" onclick="showcallhistory(\'' + currentuser + '\',\'' + touser + '\', \'' + string + '\');"><img src="' + imageval + '" class="rounded-circle mCS_img_loaded" alt="image"></div><div class="users-list-body"><div onclick="showcallhistory(\'' + currentuser + '\',\'' + touser + '\', \'' + string + '\');"><h5>' + username + '</h5>'+lastMsgCall+'</div><div class="last-chat-time"><small id="userlogin_time' + to_div_time + '" class="text-muted">' + secondsToString(snapshot.child(touser).val().timeStamp) + '</small><div class="chat-pin"><i class="bx bx-phone"></i></div></div></div></a></li>').appendTo($('.call-user-list'));
                    }
                    });
                        }
                    });
                });
                if (i == 0) {
                    showcallhistoryfirst(currentuser, touser, string);
                }
                i++;
            }
            
            if (i == 1) {
                if (touser) {
                    $('.status_update').remove();
                    $('.dream_profile_menu').trigger('click');
                    showcallhistory(currentuser, touser, string);
                }
            }
        });
        $("#callUsers").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $(".call-user-list li").filter(function() {
                       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
        });
        function showcallhistoryfirst(from, to, combination) {
            $('.chat-contact-list').removeClass('d-none');
            $('.recent-calls').removeClass('d-none');
            $('.status-middle-bar').remove();
            $("#missedcall-div").attr('class', '');
            $("#othercall-div").attr('class', '');
            $("#to_call_user").val(to);
            $("#call_combination").val(combination);
            var main_div_group = to.replace('+', '');
            $("#missedcall-div").addClass("card-body main_" + main_div_group);
            $("#othercall-div").addClass("card-body main_other_" + main_div_group);
            $(".call-item-div").remove();
            firebase.database().ref("data/calls/" + from).on("child_added", function(snapshot) {

                var duration = '';
                if (snapshot.val().duration != null && snapshot.val().duration != '') 
                {
                    duration = timeToDayConversion(snapshot.val().duration);
                }
                if (snapshot.val().callDeleteIds != undefined){
                    var userIds = snapshot.val().callDeleteIds;
                } else {
                    var userIds = '';
                }
                if (snapshot.val().callDeleteIds == undefined && snapshot.val().callerId == to && userIds.indexOf(from) == -1) {
                    if (snapshot.val().inOrOut == 'OUT') {
                        $('<div class="chats chats-right"><div class="chat-content"><div class="chat-profile-name text-end"><h6>Alex Smith<span>' + secondsToString(snapshot.val().currentMills) + '</span></h6><div class="chat-action-btns ms-3"><div class="chat-action-col"><a class="#" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i></a><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><a href="#" class="dropdown-item" ><span><i class="bx bx-trash"></i></span>Delete</a></div></div></div></div><div class="message-content "><span class="outgoing-call"><i class="bx bx-phone-outgoing me-1"></i>Outgoing Call</span> ' + duration + '</div></div><div class="chat-avatar"><img src="assets/img/avatar/avatar-10.jpg" class="rounded-circle dreams_chat" alt="image"></div></div>').appendTo('#callList');
                    } else {
                        $('<div class="chats"><div class="chat-avatar"><img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image"></div><div class="chat-content"><div class="chat-profile-name"><h6>Mark Villiams<span>' + secondsToString(snapshot.val().currentMills) + '</span></h6><div class="chat-action-btns ms-3"><div class="chat-action-col"><a class="#" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i></a><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><a href="#" class="dropdown-item" ><span><i class="bx bx-trash"></i></span>Delete</a></div></div></div></div><div class="message-content"><span class="incoming-call"><i class="bx bx-phone-incoming me-1"></i>Incoming Call</span>' + duration + '</div></div></div>').appendTo('#callList');
                    }
                }
                showcallhistory(from, to, combination);
            });
        }
        $("#show_timer").hide();
        $("#chat_cal").show();
        var d = new Date();
        var n = d.getTime();
        firebase.database().ref('data/users/' + currentuser).update({
            timeStamp: n
        });
        /*** After successful authentication, show user interface ***/
        var showUI = function() {
        }
        var currentuser = $('#current-user-number').val();
        var phonenumber = currentuser;
        /*** If no valid session could be started, show the login interface ***/

        function insertcalldetails(from, to, stext, isVideo) {
            var d = new Date();
            var n = d.getTime();
            var from = '+' + from;
            var to = '+' + to;
            var combination = $("#call_combination").val();
            firebase.database().ref("data/calls/" + from).push().set({
                "callerId": to,
                "callerImg": "",
                "callerName": to,
                "currentMills": n,
                "inOrOut": stext,
                "isVideo": isVideo,
                "userId": from
            });
            //showcallhistory(from, to, combination);
            return false;
        }
        firebase.database().ref("data/call_flag").on("child_added", function(snapshot) {
            if (currentuser == '+' + snapshot.val().to) {
                if (snapshot.val().isVideo == true) {
                    $("#videodiv").show();
                    $("#mode_of_call").val("video");
                } else {
                    $("#videodiv").hide();
                    $("#mode_of_call").val("voice");
                }
            }
        });
    }
})(jQuery);

"use strict";

function deletehistory(callkey) {

        swal({
            title: "Delete Confirmation",
            text: "Are you sure want to delete this call details?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var from = $("#current-user-number").val();
                var to = $("#to_call_user").val();
                var combination = $("#call_combination").val();
                var adaRef = firebase.database().ref('data/calls/' + from + '/' + callkey);
                adaRef.once("value", function(snapshot) {
                    if(snapshot.val().callDeleteIds != undefined) {
                       var callDeleteIds = snapshot.val().callDeleteIds; 
                    }
                    else {
                        var callDeleteIds = [];
                    }
                    callDeleteIds.push(from);
                    adaRef.update({
                        callDeleteIds: callDeleteIds
                    });
                        //if (child.val().inOrOut == 'CANCELED') {
                            //firebase.database().ref("data/calls/" + from + '/' + child.key).remove();
                        //}
                    showcallhistory(from, to, combination);
                    toastr.success("Call History Deleted Successfully");
                });
            }
        });
}

function delete_callhistory() {

        swal({
            title: "Delete Confirmation",
            text: "Are you sure want to delete this call details?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var from = $("#current-user-number").val();
                var to = $("#to_call_user").val();
                var combination = $("#call_combination").val();
                var adaRef = firebase.database().ref("data/calls/" + from);
                adaRef.once("value", function(snapshot) {
                    snapshot.forEach(function(child) {
                        //if (child.val().inOrOut == 'CANCELED') {
                            firebase.database().ref("data/calls/" + from + '/' + child.key).remove();
                        //}
                    });
                    showcallhistory(from, to, combination);
                    toastr.success("Call History Deleted Successfully");
                });
            }
        });
}

function delete_missedcall() {
    var other_call_count = $('.other-div').length;
    var missed_call_count = $('.missed-div').length;

    if(missed_call_count > 0) {
        swal({
            title: "Delete Confirmation",
            text: "Are you sure want to delete this call details?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var from = $("#current-user-number").val();
                var to = $("#to_call_user").val();
                var combination = $("#call_combination").val();
                var adaRef = firebase.database().ref("data/calls/" + from);
                adaRef.once("value", function(snapshot) {
                    snapshot.forEach(function(child) {
                        if (child.val().inOrOut == 'CANCELED') {
                            firebase.database().ref("data/calls/" + from + '/' + child.key).remove();
                        }
                    });
                    showcallhistory(from, to, combination);
                    toastr.success("Call History Deleted Successfully");
                });
            }
        });
    } else {
        toastr.warning("Call Details Not Found");
    }
    
}

function delete_othercall() {
    var other_call_count = $('.other-div').length;

    if(other_call_count > 0) {
        swal({
            title: "Delete Confirmation",
            text: "Are you sure want to delete this call details?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var from = $("#current-user-number").val();
                var to = $("#to_call_user").val();
                var combination = $("#call_combination").val();
                var adaRef = firebase.database().ref("data/calls/" + from);
                adaRef.once("value", function(snapshot) {
                    snapshot.forEach(function(child) {
                        if (child.val().inOrOut != 'CANCELED') {
                            firebase.database().ref("data/calls/" + from + '/' + child.key).remove();
                        }
                    });
                    showcallhistory(from, to, combination);
                    toastr.success("Call History Deleted Successfully");
                });
            }
        });
    } else {
        toastr.warning("Call Details Not Fou");
    }
}

function showcallhistory(from, to, combination) {
    $("#missedcall-div").attr('class', '');
    $("#othercall-div").attr('class', '');
    $("#to_call_user").val(to);
    $("#call_combination").val(combination);
    
    var main_div_group = to.replace('+', '');
    $("#missedcall-div").addClass("card-body main_" + main_div_group);
    $("#othercall-div").addClass("card-body main_other_" + main_div_group);
    $('#missedcall-count').text($("#lbl_missed_call").val()+' (' + 0 + ')');
    $('#othercall-count').text($("#lbl_other_call").val()+' (' + 0 + ')');
    firebase.database().ref("data/calls/" + from).once('value', function(snapshot) {
        $(".chats").remove();
        $(".call-item-div").remove();
        snapshot.forEach(function(childSnapshot) {
            if (childSnapshot.val().isVideo == true) {
                var callimgico = 'fa-video';
            } else {
                var callimgico = 'fa-phone-alt';
            }
            var duration = '';
            if (childSnapshot.val().duration != null && childSnapshot.val().duration != '') 
            {
                duration = timeToDayConversion(childSnapshot.val().duration);
            }
            if (childSnapshot.val().callDeleteIds != undefined){
                var userIds = childSnapshot.val().callDeleteIds;
            } else {
                var userIds = '';
            }
            if (childSnapshot.val().callDeleteIds == undefined && childSnapshot.val().callerId == to && userIds.indexOf(from) == -1) {
                if (childSnapshot.val().inOrOut == 'OUT') {
                    var outgoimage = childSnapshot.val().userId;
                    firebase.database().ref("data/users/" + outgoimage).once('value', function(usersnapshot) {
                        var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                        if (usersnapshot.val().image == '' || usersnapshot.val().image == undefined) {
                            imageval = baseUrl + 'assets/img/user-placeholder.jpg';  
                        } else {
                            imageval = usersnapshot.val().image;
                        }
                        if (usersnapshot.val().firstName == undefined) {
                            var username = from;
                        } else {
                            var username = usersnapshot.val().firstName;
                        }
                        $('<div class="chats chats-right"><div class="chat-content"><div class="chat-profile-name text-end"><h6>' + username +'<span>' + secondsToString(childSnapshot.val().currentMills) + '</span></h6><div class="chat-action-btns ms-3"><div class="chat-action-col"><a class="#" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i></a><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><a href="#" class="dropdown-item" onclick="deletehistory(\'' + childSnapshot.val().id + '\')"><span><i class="bx bx-trash"></i></span>Delete</a></div></div></div></div><div class="message-content "><span class="outgoing-call"><i class="bx bx-phone-outgoing me-1"></i>Outgoing Call</span>' + duration + ' </div></div><div class="chat-avatar"><img src="'+imageval+'" class="rounded-circle dreams_chat" alt="image"></div></div>').appendTo('#callList');
                    });
                } else {
                    var callerId = childSnapshot.val().callerId;
                    var incomeimage = callerId[0];
                    firebase.database().ref("data/users/" + incomeimage).once('value', function(usersnapshot) {
                    var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                    if (usersnapshot.val().image == '' || usersnapshot.val().image == undefined) {
                        imageval = baseUrl + 'assets/img/user-placeholder.jpg';  
                    } else {
                        imageval = usersnapshot.val().image;
                    }
                    if (usersnapshot.val().firstName == undefined) {
                        var username = from;
                    } else {
                        var username = usersnapshot.val().firstName;
                    }
                    $('<div class="chats"><div class="chat-avatar"><img src="'+imageval+'" class="rounded-circle dreams_chat" alt="image"></div><div class="chat-content"><div class="chat-profile-name"><h6>' + username +'<span>' + secondsToString(childSnapshot.val().currentMills) + '</span></h6><div class="chat-action-btns ms-3"><div class="chat-action-col"><a class="#" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i></a><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><a href="#" class="dropdown-item" onclick="deletehistory(\'' + childSnapshot.val().id + '\')"><span><i class="bx bx-trash"></i></span>Delete</a></div></div></div></div><div class="message-content"><span class="incoming-call"><i class="bx bx-phone-incoming me-1"></i>Incoming Call</span>  ' + duration + ' </div></div></div>').appendTo('#callList');
                    });
                }

                var missed_div = $('.missed-div').length;
                $('#missedcall-count').text($("#lbl_missed_call").val()+' (' + missed_div + ')');
                //$('#missedcall-count').text('(' + missed_div + ')');
                if (missed_div >= 5) {
                    //$('#missedcall-more').html('<a href="#"><i class="fas fa-chevron-down mr-1"></i> <span >'+(missed_div-5)+' More</span></a>');
                } else {
                    $('#missedcall-more').html('<br>');
                }
                var other_div = $('.other-div').length;
                $('#othercall-count').text($("#lbl_other_call").val()+' (' + other_div + ')');
                //$('#othercall-count').text('(' + other_div + ')');
                if (other_div >= 5) {
                    //$('#othercall-more').html('<a href="#"><i class="fas fa-chevron-down mr-1"></i> <span >'+(other_div-5)+' More</span></a>');
                } else {
                    $('#othercall-more').html('<br>');
                }
            }
        });
    });
    $('#sidestatus').text('');
    firebase.database().ref("data/users/" + to).once('value', function(snapshot) {
        var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
        if (snapshot.val()) {
            $('#selected_usertime').text(secondsToString(snapshot.val().timeStamp));
            $('#selected_username').text(snapshot.val().firstName);
            $('.profile-name , #sidephone').text(snapshot.val().firstName);
            $('#sidestatus').text(snapshot.val().status);
            $('#sidestatus').text(snapshot.val().status);
            if (snapshot.val().image == undefined || snapshot.val().image == '') {
                var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
            } else {
                var imageval = snapshot.val().image;
            }

            if (snapshot.val().username == undefined) {
                var username = to;
            } else {
                var username = snapshot.val().username;
            }

            $('#selected_userimage').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#sideprofileimg').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
        } else {
            $('#selected_userimage').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#sideprofileimg').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
        }
    });
}
var minutesLabel = 0;
var secondsLabel = 0;
var totalSeconds = 0;

function calltimerdiv() {
    minutesLabel = 0;
    secondsLabel = 0;
    totalSeconds = 0;
    setInterval(setTime, 1000);
}

function setTime() {
    ++totalSeconds;
    $("#seconds_id").text(pad(totalSeconds % 60));
    $("#minutes_id").text(pad(parseInt(totalSeconds / 60)));
}

function pad(val) {
    var valString = val + "";
    if (valString.length < 2) {
        return "0" + valString;
    } else {
        return valString;
    }
}
function getDeviceType() {
    var nVer = navigator.appVersion;
    var nAgt = navigator.userAgent;
    var browserName  = '';

    if(nAgt.indexOf("Chrome")!=-1) {
        browserName = "Chrome"; 
    } else if ((nAgt.indexOf("OPR"))!=-1) {
        browserName = "Opera";  
    } else if ((nAgt.indexOf("Edg"))!=-1) {
        browserName = "Microsoft Edge";
    } else if ((nAgt.indexOf("MSIE"))!=-1) {
        browserName = "Microsoft Internet Explorer";
    } else if ((nAgt.indexOf("Safari"))!=-1) {
        browserName = "Safari";
    } else if ((nAgt.indexOf("Firefox"))!=-1) {
        browserName = "Firefox";
    } else {
        browserName = "Other";
    }

    return browserName;
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
function timeToDayConversion(millis) {
// Example input time in HH:MM:SS format

// Split the input time into hours, minutes, and seconds
var timeComponents = millis.split(":");
var hours = parseInt(timeComponents[0]);
var minutes = parseInt(timeComponents[1]);
var seconds = parseInt(timeComponents[2]);

// Convert the time to a more human-readable format
var humanReadableTime = "";

if (hours > 0) {
  humanReadableTime += hours + " hr ";
}

if (minutes > 0) {
  humanReadableTime += minutes + " min ";
}

if (seconds > 0) {
  humanReadableTime += seconds + " sec";
}

// Output the human-readable time
return(humanReadableTime);

}
function onetoonenew(type) {

        var currentuser = $("#current-user-number").val();
        var touser = $("#to_call_user").val();
        var caller = currentuser.replace(' ', '');
        var receiver = touser.replace(' ', '');
        //channelname
        //var channel_name = caller+"_"+receiver;
        var channel_name = makeid(10);
        
        //console.log(channel_name); return false;
        var calllink = 'user_type=onetoone&call_type='+type+'&channelname='+channel_name+'&caller='+caller+'&receiver='+receiver+'&group=&currentuser='+currentuser;
        var title = (type == 'audio')?'Audio':'Video';
        var isVideo = (type == 'audio')?false:true;
        //console.log(calllink); return false;
        var d = new Date();
        var n = d.getTime();
        var blocked = false;
        var readmsg = false;
        //insert in call for caller
        
        //console.log(callid); return false;
        //return false;
        //check already in call
        firebase.database().ref("data/users/" + currentuser).once('value', function(snapshot) {
            if(snapshot.val().blockedUsersIds && snapshot.val().blockedUsersIds.indexOf(touser)>=0){
                toastr.warning("Blocked this user.!");
                
            } else {
        firebase.database().ref("data/users/" + touser).once('value', function(snapshot) {
        if(snapshot.val().blockedUsersIds && snapshot.val().blockedUsersIds.indexOf(currentuser)>=0){
            toastr.warning("Blocked this user.!");
           
        }
        else {
            var callid = pushcalldetails(currentuser, touser, 'OUT', isVideo);
            if (snapshot.val().call_status == undefined || snapshot.val().call_status == true)
            {
                 //console.log('iff'); return false;
                firebase.database().ref('data/users/' + currentuser).update({call_status: false});
                //go for the call
                firebase.database().ref('data/users/' + touser).update({call_status: false, incomingcall: calllink});
                if(currentuser != '' && touser != '') {
                    callpushnotification(currentuser, touser, channel_name, title, '');
                }
                //open url
                if (title == 'Audio') {
                    var href = baseUrl+'audio-call?'+calllink+'&cid='+callid;
                } else {
                    var href = baseUrl+'video-call?'+calllink+'&cid='+callid;
                }
                window.open(href, '_blank');
            }
            else {
                // console.log('else'); return false;
                //show the receiver is busy
                $('#busy_pop_up').modal('show');
                if (snapshot.val().image!='') {
                    $("#busy-username-img").html('<img alt="User Image" src="'+snapshot.val().image+'" class="call-avatar">');
                }
                $("#busy_user").text(snapshot.val().username);
                $("#busy_calllink").val(calllink);
            }
    
    }
        });
    }

        });
}

//Agora
function onetoone(type) {
    var currentuser = $("#current-user-number").val();
    var touser = $("#to_call_user").val();
    var caller = currentuser.replace(' ', '');
    var receiver = touser.replace(' ', '');
    //channelname
    var channel_name = makeid(10);
    
    var calllink = 'user_type=onetoone&call_type='+type+'&channelname='+channel_name+'&caller='+caller+'&receiver='+receiver+'&group=';
    var title = (type == 'audio')?'Audio call':'Video call';
    var isVideo = (type == 'audio')?false:true;
    var d = new Date();
    var n = d.getTime();
    var blocked = false;
    var readmsg = false;
    //insert in call for caller
    var callid = pushcalldetails(currentuser, touser, 'OUT', isVideo);
    firebase.database().ref("data/users/" + currentuser).once('value', function(usersnapshot) {

    var blockids = usersnapshot.val().blockedUsersIds;
    if (jQuery.inArray(touser, blockids) !== -1) {
        toastr.warning("Unblock User to Send Message!");
        return false;
    }
    //check already in call
    firebase.database().ref("data/users/" + touser).once('value', function(snapshot) {
                console.log('vall---'+snapshot.val());
        console.log('stt---'+snapshot.val().call_status);
        if (snapshot.val().call_status == undefined || snapshot.val().call_status == true)
        {
            firebase.database().ref('data/users/' + currentuser).update({call_status: false});
            //go for the call
            firebase.database().ref('data/users/' + touser).update({call_status: false, incomingcall: calllink});
            if(currentuser != '' && touser != '') {
                //callpushnotification(currentuser, touser, channel_name, title, '');
            }
            //open url
            var href = baseUrl+'call_first?'+calllink+'&cid='+callid;
            window.open(href, '_blank');
        }
        else {
            // console.log('else'); return false;
            //show the receiver is busy
            $('#busy_pop_up').modal('show');
            if (snapshot.val().image!='') {
                $("#busy-username-img").html('<img alt="User Image" src="'+snapshot.val().image+'" class="call-avatar">');
            }
            $("#busy_user").text(snapshot.val().username);
            $("#busy_calllink").val(calllink);
        }
    });
    });
}
function pushcalldetails(from, to, stext, isVideo) {
    var d = new Date();
    var n = d.getTime();
    var combination = $("#call_combination").val();
    var myRef = firebase.database().ref("data/calls/" + from).push();
    myRef.set({
        "callerId": [to],
        "callerImg": "",
        "callerName": "",
        "currentMills": n,
        "inOrOut": stext,
        "type":"single",
        "isVideo": isVideo,
        "userId": from,
        "id": myRef.key
    });
    showcallhistory(from, to, combination);
    return myRef.key;
}

function callpushnotification(fromuser, touser, channel_name, title, message) {
    firebase.database().ref("data/users/" + touser).once('value', function(usersnapshot) {
        if (usersnapshot.val().deviceToken != '') {
             $.ajax({
                url: 'home/callnotification',
                type: 'POST',
                data: {
                    deviceToken: usersnapshot.val().deviceToken,from:fromuser, body:channel_name,to:touser,osType:usersnapshot.val().osType,attachimg:message,title:title,attachmentType:'text'
                },
                success: function(data) {
                    console.log(data); 
                }
            });
        }
    });
}

function makeid(length) {
    var result           = [];
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result.push(characters.charAt(Math.floor(Math.random() * charactersLength)));
    }
    return result.join('');
}