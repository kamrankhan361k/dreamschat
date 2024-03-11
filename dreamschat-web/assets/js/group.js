/*
Author       : Dreamguys
Template Name: Dreamschat - Group
Version      : 1.0
*/
(function($) {
    "use strict";
    var baseUrl = $("#baseUrl").val();
    // Initializes and creates emoji set from sprite sheet
    window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: baseUrl + 'assets/img',
        popupButtonClasses: 'fa fa-smile-o'
    });
    // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
    // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
    // It can be called as many times as necessary; previously converted input fields will not be converted again
    window.emojiPicker.discover();
    var currentuser = $('#current-user-number').val();
    firebase.database().ref("data/users/" + currentuser).once('value', function(snapshot) {
        if (snapshot.val().adminblock == true) {
            window.location.href = "logout";
        }

        if (snapshot.val().wallpaper) {
            //change chat wallpaper
            $("#middle").css('background-image', 'url('+snapshot.val().wallpaper+')');
        } else {
            $("#middle").css('background-image', '');
        }
    });
    $('#chat_message , .emoji-wysiwyg-editor').on("keypress", function(e) {
        $('#chat_message').val($('.emoji-wysiwyg-editor').html());
        var group_id = $("#to_usergroup").val();
        firebase.database().ref('data/users/' + currentuser).update({
            typing: group_id
        });
        if (e.keyCode == 13) {
            sendGroupMessage();
            return false; // prevent the button click from happening
        }
    });
    $('#chat_message , .emoji-wysiwyg-editor').on("focusout", function(e) {
        firebase.database().ref('data/users/' + currentuser).update({
            typing: ''
        });
    });
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
        $('.fa-smile').on('click', function() {
            $(".emoji-menu").toggle();
        });
        $('.bx-smile').on('click', function() {
            $(".emoji-menu").toggle();
        });
        $(".user-list-item").remove();
        var i = 0;
        var currentuser = $('#current-user-number').val();
        var d = new Date();
        var n = d.getTime();
        firebase.database().ref('data/users/' + currentuser).update({
            timeStamp: n
        });
        $('.close_profile').trigger('click');
        //New Coding
        firebase.database().ref("data/groups").on("child_added", function(snapshot) {
            var string = snapshot.key;
            var substring = currentuser;
            var userIds = snapshot.val().userIds;
            if (typeof snapshot.val().grpExitUserIds !== undefined && snapshot.val().grpExitUserIds !== '') {
                var grpExitUserIds = snapshot.val().grpExitUserIds;
            }
            else {
                var grpExitUserIds = [];
            }

            if (typeof userIds !== 'undefined') {
                var usercount = userIds.length;
                if (snapshot.val().image != "" && snapshot.val().image != undefined) {
                    var imageval = snapshot.val().image;
                } else {
                    var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                }
                var userdetails = [];
                var divid = string.replace(/[.*+?^${}()|[\]\\]/g, "");
                if ($.inArray(currentuser, userIds) !== -1 && $.inArray(currentuser, grpExitUserIds) === -1) {
                    var jcnt = 0;
                    userIds.forEach(function(entry) {
                        var usersRef = firebase.database().ref("data/users/" + entry);
                        usersRef.once('value', function(usersnapshot) {
                            jcnt++;
                            var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';
                            if (usersnapshot.val() != null) {
                                if (usersnapshot.val().image != "") {
                                    imagevalusr = usersnapshot.val().image;
                                }
                            }
                            $('#grp_user_img' + jcnt + '_' + divid).attr('src', imagevalusr);
                        });
                    });

                    if (userIds.length > 1) {
                        var img_content = '<div class="avatar group_img group_header"><img class="avatar-img rounded-circle border border-white" id="grp_user_img1_' + divid + '" alt="User Image" src="assets/img/user-placeholder.jpg"></div><div class="avatar group_img group_header"><img class="avatar-img rounded-circle border border-white"  id="grp_user_img2_' + divid + '" alt="User Image" src="assets/img/user-placeholder.jpg"></div><div class="avatar group_img group_header"><span class="avatar-title rounded-circle border border-white">' + (userIds.length) + '</span></div>';
                    } else {
                        var img_content = '<div><div class="avatar group_img group_header"><img class="avatar-img rounded-circle border border-white" alt="User Image" id="grp_user_img1_' + divid + '"  src="assets/img/user-placeholder.jpg"></div><div class="avatar group_img group_header"><span class="avatar-title rounded-circle border border-white">' + (userIds.length) + '</span></div></div>';
                    }

                    firebase.database().ref("data/chats/"+string).orderByChild('date').limitToLast(1).once("value", function(lchatshot) {
                            if (lchatshot.exists()) {
                                lchatshot.forEach(function(childSnapshot) {
                                    var usersRef = firebase.database().ref("data/users/" + childSnapshot.val().senderId);
                                    usersRef.once('value', function(usersnapshot) {
                                        if (usersnapshot.val().nameToDisplay == undefined || usersnapshot.val().nameToDisplay == undefined) {
                                            var username = childSnapshot.val().senderId;
                                        } else {
                                            var username = usersnapshot.val().nameToDisplay;
                                        }
                                        var lastMsgName = '';
                                        if (childSnapshot.val().attachmentType != 3) {
                                            lastMsgName = username + ':' + childSnapshot.val().body;
                                        } else {
                                            lastMsgName = username + ':' + '<i class="bx bx-microphone me-1"></i>Audio';
                                        }

                                        if(childSnapshot.val().attachmentType == 2) {
                                            lastMsgName = username + ':' + '<i class="feather-image ms-1 me-1"></i>Photo';
                                        }

                                        if(childSnapshot.val().attachmentType == 5) {
                                            lastMsgName = username + ':' + '<i class="feather-file-text ms-1 me-1"></i>Doc';
                                        }

                                        if(childSnapshot.val().attachmentType == 1) {
                                            lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-video ms-1 me-1"></i>Video';
                                        }

                                        if(childSnapshot.val().attachmentType == 9) {
                                            lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-link ms-1 me-1"></i>Link';
                                        }

                                        if (childSnapshot.val().delivered == false && childSnapshot.val().readMsg == false) {
                                            var msgStatus = '<div class="chat-pin"><i class="bx bx-check"></i></div>';
                                        } else if(childSnapshot.val().delivered == true && childSnapshot.val().readMsg == false) {
                                            var msgStatus = '<div class="chat-pin"><i class="bx bx-check-double"></i></div>';
                                        } else if (childSnapshot.val().delivered == true && childSnapshot.val().readMsg == true) {
                                            var msgStatus = '<div class="chat-pin"><i class="bx bx-check-double check"></i></div>';
                                        } else {
                                           var msgStatus = '<div class="chat-pin"><i class="bx bx-check"></i></div>';
                                        }

                                        if ($.inArray(currentuser, childSnapshot.val().unreadusers) !== -1 ) {
                                            var reads = '<span class="dropdown-item"  onclick=markread(\'' + snapshot.key + '\')><span><i class="bx bx-check-square"></i></span>Mark as read</span>';
                                        } else {
                                            var reads = '<span class="dropdown-item"  onclick=markunread(\'' + snapshot.key + '\')><span><i class="bx bx-check-square"></i></span>Mark as unread</span>';
                                        }
                                        firebase.database().ref("data/chats/" + string).once('value', function(gsnapshot) {
                                            var unreadMsgCounts = 0;

                                            gsnapshot.forEach(function(gchildSnapshot) {
                                                var ureadMsg = gchildSnapshot.val().readMsg;

                                                if (ureadMsg === false && gchildSnapshot.val().senderId != currentuser) {
                                                    unreadMsgCounts++;
                                                }
                                            });
                                            /*if (unreadMsgCounts != 0) {
                                                var messagecount = '<div class="new-message-count">' + unreadMsgCounts +'</div>';
                                            } else {
                                                var messagecount = '';
                                            }*/

                                            if(unreadMsgCounts == 0) {
                                                       var messagecount = msgStatus;
                                                    } else {
                                                        var messagecount = '<div class="new-message-count">'+ unreadMsgCounts +'</div>';
                                                    }
                                            var showtime = secondsToString(childSnapshot.val().date);
                                            $('<li id="sendclick_' + divid + '" class="user-list-item" onclick="showgroupchathistory(\'' + currentuser + '\',\'' + snapshot.key + '\',false);"><a href="javascript:;" ><div class="avatar" id="user_'+ divid +'"><img src="' + imageval + '" class="rounded-circle" alt="groupmage"></div><div class="users-list-body"><div><h5>' + snapshot.val().name + '</h5><p class="lastMsg capitalize-first-letter" id="lastmsg_'+divid+'">'+lastMsgName+'</p></div><div class="last-chat-time"><small class="text-muted" id="lastmsgtime_'+divid+'">' + showtime + '</small>' + messagecount + '<div class="chat-pin"><div class="chat-hover"><div class="chat-action-col"><span class="d-flex" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></span><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><span class="dropdown-item" onclick=exit_group()><span><i class="bx bx-log-out"></i></span>Exit Group</span>'+reads+'</div></div></div></div></div></div></a></li>').appendTo($('.group-user-list'));
                                        });
                                    });
                                });
                            } else {
                                var showtime = secondsToString(snapshot.val().date);
                                var reads = '';
                                var lastMsgName = '';
                                $('<li id="sendclick_' + divid + '" class="user-list-item" onclick="showgroupchathistory(\'' + currentuser + '\',\'' + snapshot.key + '\',false);"><a href="javascript:;" ><div class="avatar" id="user_'+ divid +'"><img src="' + imageval + '" class="rounded-circle" alt="groupmage"></div><div class="users-list-body"><div><h5>' + snapshot.val().name + '</h5><p class="lastMsg capitalize-first-letter">'+lastMsgName+'</p></div><div class="last-chat-time"><small class="text-muted" id="lastmsgtime_'+divid+'">' + showtime + '</small><div class="chat-pin"><div class="chat-hover"><div class="chat-action-col"><span class="d-flex" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></span><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><span class="dropdown-item" onclick=exit_group()><span><i class="bx bx-log-out"></i></span>Exit Group</span>'+reads+'</div></div></div></div></div></div></a></li>').appendTo($('.group-user-list'));
                            }
                        });
                    
                    showgroupchathistoryfirst(currentuser, snapshot.key,true);

                    if (i == 1) {
                        $('.status-middle-bar').remove();
                        $('#group-sidebar').removeClass('d-none');
                        $('.chat-messages').removeClass('d-none');
                        //$('.dream_profile_menu').trigger('click');
                        showgroupchathistory(currentuser, snapshot.key,true);
                    }
                    i++;
                }
            }
        });
        //
        firebase.database().ref("data/groups").on("child_removed", function(snapshot) {
            var string = snapshot.key;
            var divid = string.replace(/[.*+?^${}()|[\]\\]/g, "");
            $('#sendclick_' + divid).remove();
            showgroupchathistory(currentuser, snapshot.key);
        });
        /*firebase.database().ref("data/users/").once('value', function(snapshot) {
              snapshot.forEach(function(childSnapshot) {
                       var name = childSnapshot.val().firstName+' '+ childSnapshot.val().lastName;

                       var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                        if (childSnapshot.val().image != undefined) {
                            if (childSnapshot.val().image != "") {
                                imageval = childSnapshot.val().image;
                            }
                        }

                       //var imageval = childSnapshot.val().image;
                       //if (snapshot.val(currentuser).exists() == false) {
                       if(childSnapshot.val().firstName != undefined && childSnapshot.val().lastName != undefined && childSnapshot.val().id != currentuser) {
                            $('<li class="user-list-item contact-user-list-item"><a href="javascript:;"><input type="hidden" id="email" value="'+childSnapshot.val().email+'"><div class="avatar"><img src="' + imageval + '" class="rounded-circle" alt="image"></div><div class="users-list-body"><div><h5>'+ name +'</h5><p>' + secondsToString(childSnapshot.val().timeStamp) + '</p></div></div><div class="notify-check parti-notify-check"><div class="form-check d-flex align-items-center justify-content-start ps-0"><label class="custom-check mt-0 mb-0"><input type="checkbox" class="custom-control-input" name="friends_list_arr[]" id="mobileNumber" value="'+childSnapshot.val().id+'"><span class="checkmark"></span></label></div></div></a></li>').appendTo($('.contact-user-list'));
                       }
                   //}
                       
                       //console.log(childSnapshot.val()); return false;
              });
              
         });*/
        firebase.database().ref("data/contacts/" + currentuser).orderByChild("firstName").once('value', function(snapshot) {
        if (snapshot.val() != null) {
        snapshot.forEach(function(childSnapshot) {
            if(childSnapshot.val().isBlocked == undefined || childSnapshot.val().isBlocked == false) {
                firebase.database().ref("data/users/" + childSnapshot.key).once('value', function(userSnapshot) {
                    if (userSnapshot.val() != null) {
                        var name = childSnapshot.val().firstName+' '+ childSnapshot.val().lastName;
                        $('<li class="user-list-item contact-user-list-item"><a href="javascript:;"><input type="hidden" id="email" value="'+childSnapshot.val().email+'"><div class="avatar"><img src="assets/img/user-placeholder.jpg" class="rounded-circle" alt="image"></div><div class="users-list-body"><div><h5>'+ name +'</h5><p>Active on ' + secondsToString(userSnapshot.val().timeStamp) + '</p></div></div><div class="notify-check parti-notify-check"><div class="form-check d-flex align-items-center justify-content-start ps-0"><label class="custom-check mt-0 mb-0"><input type="checkbox" name="mobileNumber[]" id="mobileNumber" value="'+childSnapshot.val().mobilenumber+'"><span class="checkmark"></span></label></div></div></a></li>').appendTo($('.contact-user-list'));
                    }
                });
            }
        }); 
    } else {
        $('.empty-users-body').hide();
        $('.empty-users').removeClass('d-none');
    }
    });
    }
    $("#search-contact-participants").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $(".contact-user-list li").filter(function() {
                   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
     });
    //Forward User List Search
    $("#search-contacts").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".forward-message-users-list .recent-block-group").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $(".search_call").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".my-group-list .form-check").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $("#search-member-participants").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#member-user-list li").filter(function() {
                   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
     });
    $("#search-group").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".user-list li").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $("#search-group-chats").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".message-content").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $(".newgroup_search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".group-friends-list .group_card_mb").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
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
        var myRef = firebase.database().ref("data/calls/" + from).push();
        myRef.set({
            "callerId": to,
            "callerImg": "",
            "callerName": to,
            "currentMills": n,
            "inOrOut": stext,
            "isVideo": isVideo,
            "userId": from,
            "id": myRef.key
        });
        return myRef.key;
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
    /*** Create audio elements for progresstone and incoming sound */
    const audioProgress = document.createElement('audio');
    const audioRingTone = document.createElement('audio');
    const audioIncoming = document.createElement('audio');
    const videoIncoming = document.getElementById('videoincoming');
    const videoOutgoing = document.getElementById('videooutgoing');
    /*** Define listener for managing calls ***/
    var to = $("#to_call_user").val();
    var from = currentuser;
    var callListeners = {
        onCallProgressing: function(call) {
            audioProgress.src = 'ringtone/ringback.wav';
            audioProgress.loop = true;
            audioProgress.play();
            videoOutgoing.srcObject = call.outgoingStream;
            var to = call.toId;
            var from = call.fromId;
            var newfrom = from.replace("dreamchat-", "");
            var newto = to.replace("dreamchat-", "");
            if (newfrom == phonenumber) {
                var statustext = "OUT";
                if ($("#mode_of_call").val() == "video") {
                    var isVideo = true;
                    $("#videodiv").show();
                } else {
                    $("#videodiv").hide();
                    var isVideo = false;
                }
                var callid = insertcalldetails(newfrom, newto, statustext, isVideo);
                $("#call_id").val(callid);
                firebase.database().ref("data/call_flag").remove();
                firebase.database().ref("data/call_flag").push().set({
                    "to": to,
                    "isVideo": isVideo,
                    "from": from
                });
                $("#call-username").text(to);
                firebase.database().ref("data/users/+" + to).once('value', function(snapshot) {
                    var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                    if (snapshot.val()) {
                        if (snapshot.val().image != "") {
                            imageval = snapshot.val().image;
                        } else {
                            imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                        }
                        $('#call-username-img').html('<img src="' + imageval + '" class="call-avatar" alt="image">');
                    } else {
                        $('#call-username-img').html('<img src="' + imageval + '" class="call-avatar" alt="image">');
                    }
                });
            }
        },
        onCallEstablished: function(call) {
            audioIncoming.srcObject = call.incomingStream;
            audioIncoming.play();
            audioProgress.pause();
            audioRingTone.pause();
            videoOutgoing.srcObject = call.outgoingStream;
            videoIncoming.srcObject = call.incomingStream;
            $("#show_timer").show();
            $("#chat_cal").hide();
            calltimerdiv();
        },
        onCallEnded: function(call) {
            audioProgress.pause();
            audioRingTone.pause();
            audioIncoming.srcObject = null;
            videoIncoming.srcObject = null;
            videoOutgoing.srcObject = null;
            var to = call.toId;
            var from = call.fromId;
            var newto = to.replace('dreamchat-', '');
            var newfrom = from.replace('dreamchat-', '');
            var call_id = $("#call_id").val();
            if (newto == phonenumber) 
            {
                
                if (call.getEndCause() == 'HUNG_UP' ) {
                    //update duration
                    if (call_id != '') {
                        var duration = $("#call_duration").val();
                        firebase.database().ref('data/calls/'+currentuser+'/'+call_id).update({duration:duration});
                    }
                    
                }
                if (call.getEndCause() == 'DENIED') {
                    var statustext = call.getEndCause();
                    if ($("#mode_of_call").val() == "video") {
                        var isVideo = true;
                    } else {
                        var isVideo = false;
                    }
                    insertcalldetails(newto, newfrom, statustext, isVideo);
                }
            }
            if (newfrom == phonenumber) 
            {
                if (call.getEndCause() == 'HUNG_UP' ) {
                    //update duration
                    if (call_id != '') {
                        var duration = $("#call_duration").val();
                        firebase.database().ref('data/calls/'+currentuser+'/'+call_id).update({duration:duration});
                    }
                    
                }
            }
            setcalltimerzero();
            $('#voice_call').modal("hide");
            firebase.database().ref("data/call_flag").remove();
        }
    }
    /*** Log out user ***/
    $('button#logOut').on('click', function(event) {
        event.preventDefault();
        clearError();
        //Remember to destroy / unset the session info you may have stored
        delete localStorage[sessionName];
        //Allow re-login
        $('button#loginUser').attr('disabled', false);
        $('button#createUser').attr('disabled', false);
        //Reload page.
        window.location.reload();
    });
    var handleError = function(error) {
        //$('#voice_call').modal("hide");   
        firebase.database().ref("data/call_flag").remove();
    }
    //file attachment 
    var obj = $("#drop-zone");
    obj.on('dragenter', function(e) {
        e.stopPropagation();
        e.preventDefault();
        // $(this).css('border', '2px solid #0B85A1');
    });
    obj.on('dragover', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });
    obj.on('drop', function(e) {
        //  $(this).css('border', '2px dotted #0B85A1');
        e.preventDefault();
        var files = e.originalEvent.dataTransfer.files;
        var valflag = validateFile(files);
        if (valflag) {
            handleFileUpload(files, obj);
        } else {
            toastr.warning("Attach Only Images/Audios/Videos/documents!");
            window.location.reload();
        }
        //We need to send dropped files to Server
    });
    $(document).on('dragenter', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });
    $(document).on('dragover', function(e) {
        e.stopPropagation();
        e.preventDefault();
        // obj.css('border', '2px dotted #0B85A1');
    });
    $(document).on('drop', function(e) {
        e.stopPropagation();
        e.preventDefault();
    });
    // automatically submit the form on file select
    //$('#drop-zone-file').on('change', function(e) {
    $('#drop-zone-filesss').on('change', function(e) {
        var files = $('#drop-zone-filesss')[0].files;
        var valflag = validateFile1(files);
        if (!valflag) {
            $('#send-attachement').addClass('disabled');
            toastr.warning("Select Only valid File!");
        } else {
            $('#send-attachement').removeClass('disabled');
        }
    });

    $('#send-attachement').on('click', function(e) {
        var files = $('#drop-zone-filesss')[0].files;
        var valflag = validateFile(files);
        if (valflag) {
            handleFileUpload(files, obj);
        } else {
            toastr.warning("Attach Only Images/Audios/Videos/documents!");
            window.location.reload();
        }
        $("#drag_files").hide();
        $("#previewImage").attr("src", "");
        $("#drop-zone-filesss").val('');
    });
    $(document).on('click', '.add_newuser', function() {
        var append_data='<br><div class="row"><div class="col-md-8"><input class="form-control form-control-lg group_formcontrol numbers invitegroup" name="invitegroup" type="text" placeholder="+39 02 87 21 43 19"></div><div class="col-md-4"><button type="button" class="btn btn-info btn-sm add_newuser">Add</button><button type="button" class="btn btn-danger btn-sm remove_newuser">Remove</button></div></div>';
        $("#new_users").append(append_data);
    });

    $(document).on('click', '.remove_newuser', function() {
        $(this).closest('div.row').remove();
    });
})(jQuery);

"use strict";

function phoneNumberValid(phoneNumber) {
    var pattern = /^\+[0-9\s\-\(\)]+$/;
    return phoneNumber.search(pattern) !== -1;
}

function addGroup() {
    var currentuser = $("#current-user-number").val();
    var new_group_title = $("#new-group-title").val();
    var new_group_description = $("#new-group-description").val();

   
    var searchIDs = [];
    searchIDs = $('#mobileNumber:checked').map(function() {
        return $(this).val();
    }).get();
    /*s = !0;
    var groupImage = $("#drop-zone-group-image")[0].files;
        var valflag = validateFile1(groupImage);
        if (valflag) {
          var images = handleFileUpload1(groupImage, "groupprofile");
          console.log(images); return false;
        }*/
    //var images = groupImage && (validateFile1(groupImage) ? (s = handleFileUpload1(groupImage, "profile")) : swal("Warning!", "Select Only Images!", "warning"));
    //console.log(images); return false;
    if (!new_group_title) {
        toastr.warning("Team name cannot be empty");
    } else if (searchIDs == '') {
        toastr.warning("No buddys selected");
    } else {
        var d = new Date();
        var n = d.getTime();
        var userId = "group_" + currentuser + "_" + n;
        var files = $('#new_group_img')[0].files;
        var reflag = true;
        if (files) {
            var valflag = validateFile1(files);
            if (valflag) {
                reflag = handleFileUpload1(files, userId);
            } else {
                toastr.warning("Select Only Images!");
            }
        }
        if (reflag != false) {
            searchIDs.push(currentuser);
            firebase.database().ref("data/groups/" + userId).set({
                "admin": currentuser,
                "date": n,
                "id": userId,
                "image": '',
                "name": new_group_title,
                "status": new_group_description,
                "userIds": searchIDs,
            });
            toastr.success("Group created successfully");
            $('.new-group-add').removeClass('hash-group');
            $('.parti-group').removeClass('show-participant');
            $('.new-group-add').addClass('show-group-add');
            $('.parti-group').addClass('hash-participant');
            $('#new-group').modal('hide');
            $("#new-group-title").val('');
            $("#new-group-description").val('');
            $("input[name='friends_list_arr[]']:checkbox").prop('checked', false);
        }
    }
}

$(document).ready(function() {
    // Get references to the elements
    var $fileInput = $('#new_group_img');
    var $imagePreview = $('#new-group-image');

    // Listen for changes in the file input
    $fileInput.on('change', function(e) {
        var file = e.target.files[0];

        if (file) {
            var files = $('#new_group_img')[0].files;
            var valflag = validateFile1(files);
            if (!valflag) {
                $('#next-parti').addClass('disabled');
                toastr.warning("Select Only valid image!");
            } else {
                $('#next-parti').removeClass('disabled');
            }   
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

$(document).ready(function() {
    // Get references to the elements
    var $fileInput = $('#avatar_uplo_img');
    var $imagePreview = $('#current-group-profile-image');

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

function EditGroup() {
    var currentuser = $("#current-user-number").val();
    var new_group_title = $("#edit-group-title").val();
    var new_group_description = $("#edit-group-description").val();
    var to = document.getElementById("to_usergroup").value;

    if (!new_group_title) {
        toastr.warning("Team name cannot be empty");
    } else {
        var d = new Date();
        var n = d.getTime();
        var userId = "group_" + currentuser + "_" + n;
        var files = $('#avatar_uplo_img')[0].files;
        var reflag = true;
        if (files) {
            var valflag = validateFile1(files);
            if (valflag) {
                reflag = handleFileUpload1(files, to);
            } else {
                toastr.warning("Select Only Images!");
            }
        }
        if (reflag != false) {
        //files && (validateFile1(files) ? (s = handleFileUpload1(files, to)) : swal("Warning!", "Select Only Images!", "warning"));
        firebase.database().ref("data/groups/" + to).update({ 
                date: n, 
                name: new_group_title, 
                status: new_group_description, 
            }),
            toastr.success("Group Details Updated Successfully!");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
            $("#edit-group-details").modal("hide");
        }
    }
}

function clearChat() {
    $('#clear-chat').modal('show');
}

function clearUserChat() {
    var combination = $('#combination_user').val();
    var currentuser = $('#current-user-number').val();
    var from = $('#from_usergroup').val(from);
    var to = $('#to_usergroup').val(to);
    var username = $('#username').val();
    var adaRef = firebase.database().ref("data/chats/" + to);
    adaRef.once("value", function(snapshot) {
        snapshot.forEach(function(child) {
            if (child.val().delete == "") {
                child.ref.update({
                    delete: currentuser
                });
            } else {
                if (child.val().delete != "") {
                    firebase.database().ref("data/chats/" + to + '/' + child.key).remove();
                }
            }
        });
        showgroupchathistoryfirst(from, to);
        $('#clear-chat').modal('hide');
         toastr.success("Chat Deleted Successfully!");
    });
    var chatRef = firebase.database().ref("data/chats/");
    chatRef.once('value', function(snapshot) {
        if (snapshot.child(to).exists() != true) {
            firebase.database().ref("data/chats/" + to).set(true);
        }
    });
}

function showgroupchathistoryfirst(from, to,intflag) {
    $('.chat-messages').removeClass('d-none');
    $('.recent-groups').removeClass('d-none');
    $('#group-sidebar').removeClass('d-none');
    $('.status-middle-bar').remove();
    $("#messages_groupdiv").attr('class', '');
    var main_div_group = to.replace('+', '');
    $("#messages_groupdiv").addClass("messages main_" + main_div_group);
    $('#from_usergroup').val(from);
    $('#to_usergroup').val(to);
    $(".chats").remove();
    $('#selected_usertime').text("");
    $('.list-group-item').remove();
    $('.list-images').remove();
    $('.list-videos').remove();
    $('.media-link-grp').remove();
    $('.media-file').remove();

    //Shared Media - Documents Tab
    $('#media').empty();
    $('#media').hide();
    $('#nav-home-tab').hide();

    //Shared Media - Link Tab
    $('#link').empty();
    $('#link').hide();
    $('#nav-profile-tab1').hide();

    //Shared Media - Video Tab
    $('#attachment-documents').empty();
    $('#attachment-documents').hide();
    $('#nav-profile-tab2').hide();

    //Shared Media - Images Tab
    $('#side_media_list').empty();
    $('#side_media_list').hide();
    $('#nav-profile-tab3').hide();

    //Shared Media - All Tabs
    $('.share-media').hide();
    firebase.database().ref("data/chats/" + to).on("child_added", function(snapshot) {
        $('.list-images').remove();
        $('.list-videos').remove();
        $('.media-link-grp').remove();
        $('.media-file').remove();
        $('.list-group-item').remove();
        var msgdisplay = ''; 
        if (snapshot.val().body && snapshot.val().attachmentType == 9) {
            if(snapshot.val().isurl && snapshot.val().isurl == true) {
                var messageUrl = snapshot.val().body;

                msgdisplay = '<a href = "'+messageUrl+'" target="_blank">'+messageUrl;
                if(snapshot.val().urlImageurl != "") { 
                    msgdisplay += '<br><img src="'+snapshot.val().urlImageurl+'" alt="" style=width:100px; height:100px;>';
                }
                if(snapshot.val().urlTitle != "" || snapshot.val().urlDescription != "") { 
                    var urlDescriptions = (snapshot.val().urlTitle)?snapshot.val().urlTitle:snapshot.val().urlDescription;
                    msgdisplay += '<br><h7 class="card-title">'+snapshot.val().urlTitle+'</h7>';
                }
                msgdisplay += '</a>';
            } else {
                msgdisplay = snapshot.val().body;
            }
        }  else if (snapshot.val().body && snapshot.val().attachmentType == 6) {

            if(snapshot.val().isForward == true) {
                msgdisplay = '<div class="message-content reply-getcontent"><div class="forward-msg"><i class="bx bx-share me-1"></i>Forwarded</div>'+ snapshot.val().body +'</div>';
            } else if(snapshot.val().isReply == true) {
                var replyMsg = snapshot.val().replyContent;
                var splitMsg = replyMsg.split(',');
                var replyContent = splitMsg[0];
                var user = splitMsg[1];
                msgdisplay = '<div class="message-content reply-getcontent"><div class="replay-msg mb-1">'+ replyContent +'</div>'+ snapshot.val().body +'</div>';
            } else {
                msgdisplay = snapshot.val().body;
            }

        } else if(snapshot.val().attachmentType == 1) { 
                msgdisplay = '<video id="videoPlayer" controls><source src="' + snapshot.val().attachment.url + '" type="video/mp4">Video Play</video>';
        } else if(snapshot.val().attachmentType == 5) {
                msgdisplay = '<div class="file-download d-flex align-items-center mb-0"><div class="file-type d-flex align-items-center justify-content-center me-2"><i class="bx bxs-file-doc"></i></div><div class="file-details"><span class="file-name">'+snapshot.val().attachment.name+'</span><ul><li>'+snapshot.val().attachment.bytesCount+' bytes</li><li><a target="_blank" href="'+snapshot.val().attachment.url+'">Download</a></li></ul></div></div>';
        } else if(snapshot.val().attachmentType == 3) {
            /*msgdisplay = '<div class="chat-voice-group"><ul><li><a target="_blank" href="' + snapshot.val().attachment.url + '"><span><img src="assets/img/icon/play-01.svg" alt="image"></span></a></li><li><img src="assets/img/voice.svg" alt="image"></li><li></li></ul></div>';*/
            msgdisplay = '<audio id="audioPlayer" controls><source src="' + snapshot.val().attachment.url + '" type="audio/mp3">Audion Play</audio>';
        } else {
            if(snapshot.val().attachment != undefined){
                msgdisplay = '<div class="download-col"><ul class="nav mb-0"><li><div class="image-download-col"><a href="' + snapshot.val().attachment.url + '" data-fancybox="gallery" class="fancybox" download target="_blank"><img src="'+snapshot.val().attachment.url+'" alt=""></a></div></ul></div>';
            }
        }

        if (snapshot.val().delivered == false && snapshot.val().readMsg == false) {
            var tickimg = 'single-tick.png';
        } else if(snapshot.val().delivered == true && snapshot.val().readMsg == false) {
            var tickimg = 'grey-tick.png';
        } else if (snapshot.val().readMsg == true) {
            var tickimg = 'double-tick.png';
        } else {
           var tickimg = 'grey-tick.png'; 
        }
        if (intflag == false && snapshot.val().senderId == from) {
            firebase.database().ref('data/chats/' + to + '/' + snapshot.key).update({
                readMsg: true,
                delivered: true
            });
        }
        if (snapshot.val().delete != from) {
        if(snapshot.val().attachmentType != undefined) {
           if(snapshot.val().attachmentType == 6) {
                var forwardMsgName = snapshot.val().body;
                var forwardMsgBytes = '';
                var forwardMsgUrl = '';
                var forwardMsgType = snapshot.val().attachmentType;
            } else {
                if (snapshot.val().attachment != undefined) {
                    var forwardMsgName = snapshot.val().attachment.name;
                    var forwardMsgBytes = snapshot.val().attachment.bytesCount;
                    var forwardMsgUrl = snapshot.val().attachment.url;
                }
                var forwardMsgType = snapshot.val().attachmentType;
            } 
        } else {
            var forwardMsgName = '';
            var forwardMsgBytes = '';
            var forwardMsgUrl = '';
            var forwardMsgType = '';
        }
        if (snapshot.val().delivered == false && snapshot.val().readMsg == false) {
            var messageStatus = '<div class="chat-pin"><i class="bx bx-check"></i></div>';
        } else if(snapshot.val().delivered == true && snapshot.val().readMsg == false) {
            var messageStatus = '<div class="chat-pin"><i class="bx bx-check-double"></i></div>';
        } else if (snapshot.val().delivered == true && snapshot.val().readMsg == true) {
            var messageStatus = '<div class="chat-pin"><i class="bx bx-check-double check"></i></div>';
        } else {
           var messageStatus = '<div class="chat-pin"><i class="bx bx-check"></i></div>';
        }
        var currentuser = $('#current-user-number').val();
        var userIds = snapshot.val().userIds;
        if (userIds && userIds.indexOf(from) !== -1) {
            if (snapshot.val().senderId == from) {
                var toid = snapshot.val().senderId;
                var divid = toid.replace(/[.*+?^${}()|[\]\\]/g, "");
                var forwardMsg = '';
                var replyMsg = '';
                var username = '';
                var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';
                var usersRef = firebase.database().ref("data/users/" + toid);
                usersRef.once('value', function(usersnapshot) {
                    
                    if (usersnapshot.val() != null) {
                        if (usersnapshot.val().image != "") {
                            imagevalusr = usersnapshot.val().image;
                            $('#img_pro_' + divid + snapshot.key).attr('src', imagevalusr);
                        }
                    }
                    if (usersnapshot.val().id == currentuser) {
                        username = 'You';
                    } else {
                        username = usersnapshot.val().name;
                    }
                    });
                $('<div class="chats chats-right"><div class="chat-avatar"><img id="img_pro_' + divid + snapshot.key + '" src="' + imagevalusr + '" class="rounded-circle dreams_chat" alt="image"></div><div class="chat-content"><div class="chat-profile-name"><h6 class="capitalize-first-letter">You<span>' + secondsToString(snapshot.val().date) + '</span></h6><div class="chat-action-btns ms-3"></div><div class="chat-action-col"><a class="#" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i></a><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><a href="#" class="dropdown-item"  onclick="replyMessages(\''+snapshot.val().body+'\',\'' + to + '\',\'' + snapshot.val().senderId + '\')";><span><i class="bx bx-share"></i></span>Reply</a><a href="#" class="dropdown-item"   onclick="forwardMessages(\''+forwardMsgType+'\',\''+forwardMsgName+'\',\''+forwardMsgBytes+'\',\''+forwardMsgUrl+'\')";><span><i class="bx bx-reply"></i></span>Forward</a><a href="#" class="dropdown-item" onclick="deletechat(\'' + snapshot.val().id + '\')"><span><i class="bx bx-trash"></i></span>Delete</a></div></div></div><div class="message-content">' + msgdisplay + messageStatus +'</div></div></div>').appendTo($('.main_' + main_div_group)).addClass('new');
                $('.message-input').val(null);
                
            } else {
                if (snapshot.val().blocked == false) {
                    var toid = snapshot.val().senderId;
                    var divid = toid.replace(/[.*+?^${}()|[\]\\]/g, "");
                    var forwardMsg = '';
                    var replyMsg = '';
                    var username = '';
                    var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';
                    var usersRef = firebase.database().ref("data/users/" + toid);
                    usersRef.once('value', function(usersnapshot) {
                        
                        if (usersnapshot.val() != null) {
                            if (usersnapshot.val().image != "") {
                                imagevalusr = usersnapshot.val().image;
                                $('#img_pro_' + divid + snapshot.key).attr('src', imagevalusr);
                            }
                        }  

                    });
                    $('<div class="chats"><div class="chat-avatar"><img id="img_pro_' + divid + snapshot.key + '" src="' + imagevalusr + '" class="rounded-circle dreams_chat" alt="image"></div><div class="chat-content"><div class="chat-profile-name"><h6 class="receiverName capitalize-first-letter"><span>' + secondsToString(snapshot.val().date) + '</span></h6><div class="chat-action-btns ms-3"></div><div class="chat-action-col"><a class="#" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i></a><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><a href="#" class="dropdown-item"  onclick="replyMessages(\''+snapshot.val().body+'\',\'' + to + '\',\'' + snapshot.val().senderId + '\')";><span><i class="bx bx-share"></i></span>Reply</a><a href="#" class="dropdown-item" onclick="forwardMessages(\''+forwardMsgType+'\',\''+forwardMsgName+'\',\''+forwardMsgBytes+'\',\''+forwardMsgUrl+'\')";><span><i class="bx bx-reply"></i></span>Forward</a><a href="#" class="dropdown-item" onclick="reportchat(\'' + snapshot.val().id + '\')"><span><i class="bx bx-dislike"></i></span>Report<input type="checkbox" class="smsg" msgtype="received" value="'+snapshot.val().id+'" style="display:none;"/></a><a href="#" class="dropdown-item" onclick="deletechat(\'' + snapshot.val().id + '\')"><span><i class="bx bx-trash"></i></span>Delete</a></div></div></div><div class="message-content">' + msgdisplay + messageStatus +'</div></div></div>').appendTo($('.main_' + main_div_group)).addClass('new');

                        usersRef.once('value', function(usersnapshot) {
                            var receiverName = '';
                            if (usersnapshot.val() != null) {
                                if(usersnapshot.val().firstName != '' || usersnapshot.val().firstName != undefined) {
                                    receiverName = usersnapshot.val().firstName;
                                }
                                $('.receiverName').text(receiverName);
                            }
                        });
                }
            }

            //Shared Images
                if (snapshot.val().attachment != undefined && snapshot.val().attachmentType == 2 && snapshot.val().blocked == false) {
                    $('.share-media').show();
                    $('#side-media-list').show();
                    $('#nav-home-tab').show();
                    $('<li class="list-images"><a href="' + snapshot.val().attachment.url + '" data-fancybox="gallery" class="fancybox"><img src="' + snapshot.val().attachment.url + '" alt=""></a></li>').appendTo($('#side-media-list'));
                }
                //Shared Documents
                if (snapshot.val().attachment != undefined && snapshot.val().attachmentType == 5 && snapshot.val().blocked == false) {
                    $('.share-media').show();
                    $('#media').show();
                    $('#nav-profile-tab2').show();
                    var attachmentFile = snapshot.val().attachment.url;
                    

                    // Extract the file name
                    var fileName = attachmentFile.substring(attachmentFile.lastIndexOf('/') + 1);

                    // Split the file name by dot (.) to get the file extension
                    var fileExtension = fileName.split('.').pop();
                    var fileMatch = fileExtension.match(/(.+)\?(.+)/);
                    
                    if(fileMatch[1] == 'doc' || fileMatch[1] == 'docx') {
                        var fileType = '<i class="bx bxs-file-doc"></i>';
                    } else if(fileMatch[1] == 'pdf') {
                        var fileType = '<i class="bx bxs-file-pdf"></i>';
                    } else if(fileMatch[1] == 'txt') {
                        var fileType = '<i class="bx bxs-file"></i>';
                    } else {
                        var fileType = '<i class="bx bxs-file-doc"></i>';
                    }
                    
                    $('<div class="media-file"><div class="media-doc-blk"><span>'+ fileType +'</span><div class="document-detail"><h6>'+snapshot.val().attachment.name+'</h6><ul><li>'+secondsToString(snapshot.val().date)+'</li><li>'+snapshot.val().attachment.bytesCount +' bytes</li></ul></div></div><div class="media-download"><a href="'+ snapshot.val().attachment.url +'" download target="_blank"><i class="bx bx-download"></i></a></div>').appendTo($('#media'));
                }

                //Shared Links
                if (snapshot.val().attachmentType == 9 && snapshot.val().blocked == false) {
                    $('.share-media').show();
                    $('#link').show();
                    $('#nav-profile-tab3').show();
                    if(snapshot.val().isurl && snapshot.val().isurl == true) {
                        $('<div class="media-link-grp mb-0"><div class="link-img"><a href="'+ snapshot.val().body +'"><img src="'+ snapshot.val().urlImageurl +'" alt="Img" style="height: 30px; width: 60px;"></a></div><div class="media-link-detail"><h6><a href="'+ snapshot.val().body +'">'+ snapshot.val().urlTitle +'</a></h6><span><a href="javascript:;">'+ snapshot.val().body +'</a></span></div></div>').appendTo($('#link'));
                    } 
                }

                //Shared Videos
                if (snapshot.val().attachment != undefined && snapshot.val().attachmentType == 1 && snapshot.val().blocked == false) {
                    $('.share-media').show();
                    $('#attachment-documents').show();
                    $('#nav-profile-tab1').show();
                    $('<li class="list-videos"><a href="'+ snapshot.val().attachment.url +'" data-fancybox class="fancybox" target="_blank"><img src="assets/img/media/media-01.jpg" alt="img"><span><i class="bx bx-play-circle"></i></span></a></li>').appendTo($('#attachment-documents'));
                }
            }
        }
    });

        firebase.database().ref("data/groups/" + to).once('value', function(snapshot) {

        $('.list-group-item').remove();
        $('.contact-users-list-item').remove();
        if (snapshot.val()) {
            $('#sidestatus').text(snapshot.val().status);
            $('#selected_username').text(snapshot.val().name);
            var showtime = secondsToString(snapshot.val().date);
            $('#selected_usertime').text(showtime);
            $('#sidephone').text(snapshot.val().admin);
            $('.profile-name').html(snapshot.val().name);
            $('#selected_group_id').val(to);
            $('#group-desc').text(snapshot.val().status);

            var usersRef = firebase.database().ref("data/users/" + snapshot.val().admin);
                    usersRef.once('value', function(usersnapshot) {
                    var username = usersnapshot.val().nameToDisplay;
                     $('#description-date').html('Group created by '+username+', on '+showtime+'');
            });

            var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
            if (snapshot.val().image != "") {
                imageval = snapshot.val().image;
                $('#current_group_image').addClass("avatar avatar-xl mb-3"); 
                $('#current_group_image').html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + imageval + '" alt="">');
            } else {
                $('#current_group_image').removeClass("avatar avatar-xl mb-3"); 
                $('#current_group_image').html('');
            }

            $('#addmember').html('<a href="#" onclick="addmember(\'' + snapshot.val().id + '\')"><div class="stared-group"><span class="" data-users="' + snapshot.val().id + '"> <i class="fas fa-user"></i></span><h6>Add Participants</h6></div><div class="count-group"><i class="feather-chevron-right"></i></div></a>');

            var userIds = snapshot.val().userIds;
            var currentuser = $('#current-user-number').val();
            firebase.database().ref("data/contacts/" + currentuser).orderByChild("firstName").once('value', function(csnapshot) {
                csnapshot.forEach(function(childSnapshot) {
                    if(childSnapshot.val().isBlocked == undefined || childSnapshot.val().isBlocked == false) {
                    firebase.database().ref("data/users/" + childSnapshot.key).once('value', function(userSnapshot) {
                                if (userSnapshot.val() != null) {
                                if (userSnapshot.val().image == '' || userSnapshot.val().image == undefined) {
                                    imageval = baseUrl + 'assets/img/user-placeholder.jpg';  
                                } else {
                                    imageval = userSnapshot.val().image;
                                }

                                if (userSnapshot.val().firstName == '' || userSnapshot.val().firstName == undefined) {
                                    var name = userSnapshot.val().id;
                                } else {
                                    var name = userSnapshot.val().firstName;
                                }
                                if (userSnapshot.val().id != undefined) {
                                    if ($.inArray(userSnapshot.val().id, snapshot.val().userIds) === -1) {
                                        $('.contact-users-list-item').remove();
                                        $('<li class="user-list-item contact-users-list-item"><a href="javascript:;"><input type="hidden" id="email" value="'+userSnapshot.val().email+'"><div class="avatar"><img src="' + imageval + '" class="rounded-circle" alt="image"></div><div class="users-list-body"><div><h5>'+ name +'</h5><p>' + secondsToString(userSnapshot.val().timeStamp) + '</p></div></div><div class="notify-check parti-notify-check"><div class="form-check d-flex align-items-center justify-content-start ps-0"><label class="custom-check mt-0 mb-0"><input type="checkbox" class="custom-control-input" name="friends_list_arr[]" id="mobileNumber" value="'+userSnapshot.val().id+'"><span class="checkmark"></span></label></div></div></a></li>').appendTo($('#member-user-list'));
                                    } 
                                    /*else {
                                        $(".recent-block-group").remove();
                                       $(".show-participant").remove();
                                        $('<div class="recent-block-group">Contact users not found</div>').appendTo('#empty-group-member');
                                    }*/
                                }  
                            }    
                        });
                    }
                });
            });
            $("#userids").val(userIds.toString());
            $('#selected_userimage').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#sideprofileimg').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#groupnav-profile').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#rightside_member_count_text').text('Group: '+(userIds.length) + ' Participants');
            $('#rightside_member_count_texts').text((userIds.length) + ' Participants');
            
            var currentuser = $('#current-user-number').val();
            var imagevalusryou = baseUrl + 'assets/img/user-placeholder.jpg';
            var onlinecounts = 0;
            userIds.forEach(function(entry) {
                var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';
                var usersRef = firebase.database().ref("data/users/" + entry);
                usersRef.once('value', function(usersnapshot) {

                   /* if (userIds.length > 1) {
                        $('<div class="avatar avatar-xs group_img group_header"><img class="avatar-img rounded-circle" id="grp_user_img1_" alt="User Image" src="' + imagevalusr + '"></div><div class="avatar avatar-xs group_img group_header"><img class="avatar-img rounded-circle"  id="grp_user_img2_" alt="User Image" src="' + imagevalusr + '"></div><div class="avatar avatar-xs group_img group_header"><span class="avatar-title rounded-circle border border-white">' + (userIds.length) + '</span></div>').appendTo($('#append_images'));
                    } else {
                        $('<div class="avatar avatar-xs group_img group_header"><img class="avatar-img rounded-circle" alt="User Image" id="grp_user_img1_"  src="' + imagevalusr + '"></div><div class="avatar avatar-xs group_img group_header"><span class="avatar-title rounded-circle border border-white">' + (userIds.length) + '</span></div>').appendTo($('#append_images'));
                    }
*/

                    if (usersnapshot.val().online != undefined && usersnapshot.val().online != '') {
                        var online = usersnapshot.val().online;

                        // Assuming online is a boolean value, check if it's true
                        if (online === true) {
                            onlinecounts++;
                        }
                    }

                    // Assuming userIds is defined elsewhere in your code
                    $('#last-seen').html(userIds.length + ' Members, <span class="active-online">' + onlinecounts + ' Online</span>');

                    if (typeof snapshot.val().grpExitUserIds !== 'undefined') {
                        var grpExitUserIds = snapshot.val().grpExitUserIds;
                    }
                    else {
                        var grpExitUserIds = [];
                    }

                    if (usersnapshot.val() != null) {
                        if (usersnapshot.val().image != undefined && usersnapshot.val().image != '') {
                            imagevalusr = usersnapshot.val().image;
                        }
                        if (entry == currentuser) {
                            namedisplay = 'You';
                        } else {
                            namedisplay = usersnapshot.val().name;
                        }
                        statusdisplay = usersnapshot.val().status;
                    } else {
                        namedisplay = entry;
                        statusdisplay = "";
                    }
                    if (usersnapshot.val().id == snapshot.val().admin) {
                        var admin = '<span class="admin-profiles">Admin</span>';
                        var delete_parti = '';
                    } else {
                        var admin = '';
                        var delete_parti = '<a href="#"><span><i class="bx bx-trash"></i></span></a>';
                    }
                    if (snapshot.val().admin == currentuser && usersnapshot.val().id != snapshot.val().admin) {
                        var delete_parti = '<a href="#"><span><i class="bx bx-trash" onclick="remove_group_member(\'' + usersnapshot.val().id + '\')"></i></span></a>';
                    } else {
                        var delete_parti = '';
                    }
                    if ($.inArray(usersnapshot.val().id, grpExitUserIds) === -1) {
                        $('<li class="d-flex list-group-item"><div><div class="avatar"><img src="' + imagevalusr + '" class="rounded-circle" alt="image"></div></div><div class="users-list-body d-flex justify-content-between"><div><h5>' + namedisplay + '</h5><p>' + statusdisplay + '</p></div><div>' + admin +'</div></div>' + delete_parti + '</li>').appendTo($('#side_member_list'));
                    }
                });
            });
        }
    });
}

function delete_chat() {
    var currentuser = $('#current-user-number').val();
    var from = $('#from_usergroup').val();
    var to = $('#to_usergroup').val();
    var adaRef = firebase.database().ref("data/chats/" + to);
    adaRef.once("value", function(snapshot) {
        snapshot.forEach(function(child) {
            var userarray = child.val().userIds;
            if (Array.isArray(userarray)) {
                var index = userarray.indexOf(currentuser);
                if (index !== -1) {
                    userarray.splice(index, 1);
                }
                child.ref.update({
                    userIds: userarray
                });
            } else {
                console.log("userarray is not an array");
            }
        });
        showgroupchathistory(from, to);
        toastr.success("Chat deleted successfully!");
    });
}

function deleteGroupIcon() {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to delete this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var groupID = $('#selected_group_id').val();
            firebase.database().ref('data/groups/' + groupID).update({
                image: ""
            });
            var divid = groupID.replace(/[.*+?^${}()|[\]\\]/g, "")
            var groups = '#user_'+divid;

            var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';

            $("#sideprofileimg").html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + imagevalusr + '" alt="">'),$("#selected_userimage").html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + imagevalusr + '" alt="">'),$(groups).html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + imagevalusr + '" alt="">'),$("#current_group_image").html('');$('#current_group_image').removeClass("avatar avatar-xl mb-3"); 
            toastr.success("Group Image Deleted Successfully!");
        }
    });
}

function remove_group_member(memberId) {
    $("#remove-group").modal('show');
    $('#remove-parti-id').val(memberId);
}

function remove_group_member_confirm(userId) {
    var remove_member = $('#remove-parti-id').val();
    var currentuser = $('#current-user-number').val();
    var from = $('#from_usergroup').val();
    var to = $('#to_usergroup').val();
    var block_ids = [];
    var adaRef = firebase.database().ref("data/groups/" + to);
    adaRef.once("value", function(snapshot) {
            var userarray = snapshot.val().userIds;
            if(snapshot.val().grpExitUserIds != undefined) {
               var grpExitUserIds = snapshot.val().grpExitUserIds; 
            }
            else {
                var grpExitUserIds = [];
            }
            grpExitUserIds.push(remove_member);
            userarray.pop(remove_member);
            adaRef.update({
                grpExitUserIds: grpExitUserIds,
                userIds: userarray
            });
            toastr.success("Group member successfully removed");
            setTimeout(function() {
                showgroupchathistoryfirst(from, to);
            }, 2000); // Adjust the delay as needed
    });
}

function markread(groupid) {
    var from = $('#from_usergroup').val();
    var to = $('#to_usergroup').val();
    firebase.database().ref("data/chats/"+groupid).orderByChild('date').limitToLast(1).once("value", function(lchatshot) {
        lchatshot.forEach(function(childSnapshot) {
        var currentuser = $('#current-user-number').val();
           
        var unreadusers = childSnapshot.val().unreadusers || [];

        // Find the index of the number to remove
        var indexToRemove = unreadusers.indexOf(currentuser);

        if (indexToRemove !== -1) {
            // Remove the number from the array
            unreadusers.splice(indexToRemove, 1);

            // Update the 'unreadusers' field in the database with the modified array
            firebase.database().ref('data/chats/' + groupid + '/' + childSnapshot.key + '/unreadusers')
                .set(unreadusers)
                .then(function() {
                    console.log('Successfully removed ' + currentuser + ' from unreadusers.');
                })
                .catch(function(error) {
                    console.error('Error removing number:', error);
                });
        } else {
            console.log('Number ' + numberToRemove + ' not found in unreadusers.');
        }
        toastr.success("Mark as read the last message successfully");
        setTimeout(function() {
            showgroupchathistoryfirst(from, to);
            window.location.reload();
        }, 2000); // Adjust the delay as needed
        });
    });
}

function markunread(groupid) {
    var from = $('#from_usergroup').val();
    var to = $('#to_usergroup').val();
    firebase.database().ref("data/chats/"+groupid).orderByChild('date').limitToLast(1).once("value", function(lchatshot) {
        lchatshot.forEach(function(childSnapshot) {
            var currentuser = $('#current-user-number').val();

            var existingArray = childSnapshot.val().unreadusers || [];
    
            // Add the current user to the array if not already present
            if (existingArray.indexOf(currentuser) === -1) {
                existingArray.push(currentuser);
            }

            // Update the unreadusers field in the database
            firebase.database().ref('data/chats/' + groupid + '/' + childSnapshot.key).update({
                unreadusers: existingArray
            });
            toastr.success("Mark as unread the last message successfully");
            setTimeout(function() {
                showgroupchathistoryfirst(from, to);
                window.location.reload();
            }, 2000); // Adjust the delay as needed
        });
    });
}

function exit_group() {
    var currentuser = $('#current-user-number').val();
    var from = $('#from_usergroup').val();
    var to = $('#to_usergroup').val();
    var block_ids = [];
    var adaRef = firebase.database().ref("data/groups/" + to);
    adaRef.once("value", function(snapshot) {
        if (currentuser == snapshot.val().admin) {
            //make another user as admin
            var userIds = snapshot.val().userIds;
            //remove me from userids
            var index = userIds.indexOf(currentuser);
            if (index !== -1) {
                userIds.splice(index, 1);
            }
            var makeadmin = userIds[0];
            if(snapshot.val().grpExitUserIds != undefined) {
               var grpExitUserIds = snapshot.val().grpExitUserIds; 
            }
            else {
                var grpExitUserIds = [];
            }
            grpExitUserIds.push(currentuser);
            adaRef.update({
                admin: makeadmin,
                grpExitUserIds: grpExitUserIds
            });
            toastr.success("You successfully exited this group.");
            setTimeout(function() {
                showgroupchathistoryfirst(from, to);
                window.location.reload();
            }, 2000); // Adjust the delay as needed            
        } else {
            var userarray = snapshot.val().userIds;
            if(snapshot.val().grpExitUserIds != undefined) {
               var grpExitUserIds = snapshot.val().grpExitUserIds; 
            }
            else {
                var grpExitUserIds = [];
            }
            grpExitUserIds.push(currentuser);
            adaRef.update({
                grpExitUserIds: grpExitUserIds
            });
            toastr.success("You successfully exited this group.p");
            setTimeout(function() {
                showgroupchathistoryfirst(from, to);
                window.location.reload();
            }, 2000); // Adjust the delay as needed
        }
    });
    //window.location.reload();
}

function remove_group() {
    var currentuser = $('#current-user-number').val();
    var from = $('#from_usergroup').val();
    var to = $('#to_usergroup').val();
    var block_ids = [];
    firebase.database().ref("data/chats/" + to).remove();
    firebase.database().ref("data/groups/" + to).remove();
    showgroupchathistory(from, to);
}

function showgroupchathistory(from, to,intflag) {
    if ($(window).width() < 992) {
        $(document).on('click','.user-list-item',function(){
            $('.left-sidebar').addClass('hide-left-sidebar');
            $('.chats').addClass('show-chatbar');
        });
        $('.chats').removeClass('hide-chatbar');
        // $('.chat').addClass('show-chatbar');
    }
    $("#messages_groupdiv").attr('class', '');
    var main_div_group = to.replace('+', '');
    $("#messages_groupdiv").addClass("messages main_" + main_div_group);
    $('#from_usergroup').val(from);
    $('#to_usergroup').val(to);
    $(".chats").remove();
    $('#selected_usertime').text("");
    $('.list-group-item').remove();
    $('.list-images').remove();
    $('.list-videos').remove();
    $('.media-link-grp').remove();
    $('.media-file').remove();
    firebase.database().ref("data/chats/" + to).once('value', function(snapshot) {
        $('.list-images').remove();
        $('.list-videos').remove();
        $('.media-link-grp').remove();
        $('.media-file').remove();
        $('.list-group-item').remove();
        var msgdisplay = ''; 
        snapshot.forEach(function(childSnapshot) {

        if (childSnapshot.val().body && childSnapshot.val().attachmentType == 9) {
            if(childSnapshot.val().isurl && childSnapshot.val().isurl == true) {
                var messageUrl = childSnapshot.val().body;

                msgdisplay = '<a href = "'+messageUrl+'" target="_blank">'+messageUrl;
                if(childSnapshot.val().urlImageurl != "") { 
                    msgdisplay += '<br><img src="'+childSnapshot.val().urlImageurl+'" alt="" style=width:100px; height:100px;>';
                }
                if(childSnapshot.val().urlTitle != "" || childSnapshot.val().urlDescription != "") { 
                    var urlDescriptions = (childSnapshot.val().urlTitle)?childSnapshot.val().urlTitle:childSnapshot.val().urlDescription;
                    msgdisplay += '<br><h7 class="card-title">'+childSnapshot.val().urlTitle+'</h7>';
                }
                msgdisplay += '</a>';
            } else {
                msgdisplay = childSnapshot.val().body;
            }
        }  else if (childSnapshot.val().body && childSnapshot.val().attachmentType == 6) {

            if(childSnapshot.val().isForward == true) {
                msgdisplay = '<div class="message-content reply-getcontent"><div class="forward-msg"><i class="bx bx-share me-1"></i>Forwarded</div>'+ childSnapshot.val().body +'</div>';
            } else if(childSnapshot.val().isReply == true) {
                var replyMsg = childSnapshot.val().replyContent;
                var splitMsg = replyMsg.split(',');
                var replyContent = splitMsg[0];
                var user = splitMsg[1];
                msgdisplay = '<div class="message-content reply-getcontent"><div class="replay-msg mb-1">'+ replyContent +'</div>'+ childSnapshot.val().body +'</div>';
            } else {
                msgdisplay = childSnapshot.val().body;
            }
        } else if(childSnapshot.val().attachmentType == 1) { 
                msgdisplay = '<a data-fancybox="gallery" class="fancybox" href="'+ childSnapshot.val().attachment.url +'"><video id="videoPlayer" controls><source src="' + childSnapshot.val().attachment.url + '" type="video/mp4">Video Play</video></a>';
        } else if(childSnapshot.val().attachmentType == 5) {
                msgdisplay = '<div class="file-download d-flex align-items-center mb-0"><div class="file-type d-flex align-items-center justify-content-center me-2"><i class="bx bxs-file-doc"></i></div><div class="file-details"><span class="file-name">'+childSnapshot.val().attachment.name+'</span><ul><li>'+childSnapshot.val().attachment.bytesCount+' bytes</li><li><a target="_blank" href="'+childSnapshot.val().attachment.url+'">Download</a></li></ul></div></div>';
        } else if(childSnapshot.val().attachmentType == 3) {
            msgdisplay = '<audio id="audioPlayer" controls><source src="' + childSnapshot.val().attachment.url + '" type="audio/mp3">Audion Play</audio>';

        }  else if(childSnapshot.val().attachmentType == 0) {
            if(childSnapshot.val().attachment != undefined) {
                msgdisplay = childSnapshot.val().attachment.name; 
                    msgdisplay += '<br><div class="chat-avatar"><img src="'+baseUrl+'assets/img/avatar-8.jpg" class="rounded-circle dreams_chat" alt="image"></div>';
            }
        } else if(childSnapshot.val().attachmentType == 4) {
            var data = childSnapshot.val().attachment.data;
            var locationData = JSON.parse(data)
            var latitude = locationData.latitude;
            var longitude = locationData.longitude;
            var googleMapsUrl = "https://www.google.com/maps?q=" + latitude + "," + longitude;
            msgdisplay = '<a href="' + googleMapsUrl + '" download target="_blank">Current Location</a>';
        } else {
            if(childSnapshot.val().attachment != undefined){
                msgdisplay = '<div class="download-col"><ul class="nav mb-0"><li><div class="image-download-col"><a href="' + childSnapshot.val().attachment.url + '" data-fancybox="gallery" class="fancybox" download target="_blank"><img src="'+childSnapshot.val().attachment.url+'" alt=""></a></div></ul></div>';
            } else {
                msgdisplay = '';
            }
        }

        if (childSnapshot.val().delivered == false && childSnapshot.val().readMsg == false) {
            var tickimg = 'single-tick.png';
        } else if(childSnapshot.val().delivered == true && childSnapshot.val().readMsg == false) {
            var tickimg = 'grey-tick.png';
        } else if (childSnapshot.val().readMsg == true) {
            var tickimg = 'double-tick.png';
        } else {
           var tickimg = 'grey-tick.png'; 
        }
        if (intflag == false && childSnapshot.val().senderId == from) {
            firebase.database().ref('data/chats/' + to + '/' + childSnapshot.key).update({
                readMsg: true,
                delivered: true
            });
        }
        if (childSnapshot.val().delete != from) {
        if(childSnapshot.val().attachmentType != undefined) {
           if(childSnapshot.val().attachmentType == 6) {
                var forwardMsgName = childSnapshot.val().body;
                var forwardMsgBytes = '';
                var forwardMsgUrl = '';
                var forwardMsgType = childSnapshot.val().attachmentType;
            } else {
                if (childSnapshot.val().attachment != undefined) {
                    var forwardMsgName = childSnapshot.val().attachment.name;
                    var forwardMsgBytes = childSnapshot.val().attachment.bytesCount;
                    var forwardMsgUrl = childSnapshot.val().attachment.url;
                }
                var forwardMsgType = childSnapshot.val().attachmentType;
            } 
        } else {
            var forwardMsgName = '';
            var forwardMsgBytes = '';
            var forwardMsgUrl = '';
            var forwardMsgType = '';
        }
        if (childSnapshot.val().delivered == false && childSnapshot.val().readMsg == false) {
            var messageStatus = '<div class="chat-pin"><i class="bx bx-check"></i></div>';
        } else if(childSnapshot.val().delivered == true && childSnapshot.val().readMsg == false) {
            var messageStatus = '<div class="chat-pin"><i class="bx bx-check-double"></i></div>';
        } else if (childSnapshot.val().delivered == true && childSnapshot.val().readMsg == true) {
            var messageStatus = '<div class="chat-pin"><i class="bx bx-check-double check"></i></div>';
        } else {
           var messageStatus = '<div class="chat-pin"><i class="bx bx-check"></i></div>';
        }
        var currentuser = $('#current-user-number').val();
        var userIds = childSnapshot.val().userIds;
        if (userIds && userIds.indexOf(from) !== -1) {
            if (childSnapshot.val().senderId == from) {
                var toid = childSnapshot.val().senderId;
                var divid = toid.replace(/[.*+?^${}()|[\]\\]/g, "");
                var forwardMsg = '';
                var replyMsg = '';
                var username = '';
                var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';
                var usersRef = firebase.database().ref("data/users/" + toid);
                usersRef.once('value', function(usersnapshot) {
                    
                    if (usersnapshot.val() != null) {
                        if (usersnapshot.val().image != "") {
                            imagevalusr = usersnapshot.val().image;
                            $('#img_pro_' + divid + snapshot.key).attr('src', imagevalusr);
                        }
                    }
                });
                $('<div class="chats chats-right"><div class="chat-avatar"><img id="img_pro_' + divid + childSnapshot.key + '" src="' + imagevalusr + '" class="rounded-circle dreams_chat" alt="image"></div><div class="chat-content"><div class="chat-profile-name"><h6>You<span>' + secondsToString(childSnapshot.val().date) + '</span></h6><div class="chat-action-btns ms-3"></div><div class="chat-action-col"><a class="#" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i></a><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><a href="#" class="dropdown-item"  onclick="replyMessages(\''+childSnapshot.val().body+'\',\'' + to + '\',\'' + childSnapshot.val().senderId + '\')";><span><i class="bx bx-share"></i></span>Reply</a><a href="#" class="dropdown-item"   onclick="forwardMessages(\''+forwardMsgType+'\',\''+forwardMsgName+'\',\''+forwardMsgBytes+'\',\''+forwardMsgUrl+'\')";><span><i class="bx bx-reply"></i></span>Forward</a><a href="#" class="dropdown-item" onclick="deletechat(\'' + childSnapshot.val().id + '\')"><span><i class="bx bx-trash"></i></span>Delete</a></div></div></div><div class="message-content">' + msgdisplay + messageStatus +'</div></div></div>').appendTo($('.main_' + main_div_group)).addClass('new');
                $('.message-input').val(null);
            } else {
                if (childSnapshot.val().blocked == false) {
                    var toid = childSnapshot.val().senderId;
                    var divid = toid.replace(/[.*+?^${}()|[\]\\]/g, "");
                    var forwardMsg = '';
                    var replyMsg = '';
                    var username = '';
                    var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';
                    var usersRef = firebase.database().ref("data/users/" + toid);
                    usersRef.once('value', function(usersnapshot) {
                        
                        if (usersnapshot.val() != null) {
                            if (usersnapshot.val().image != "") {
                                imagevalusr = usersnapshot.val().image;
                                $('#img_pro_' + divid + snapshot.key).attr('src', imagevalusr);
                            }
                        }  
                        if (usersnapshot.val().id == currentuser) {
                            username = 'You';
                        } else {
                            username = usersnapshot.val().name;
                        }
                    });
                    $('<div class="chats"><div class="chat-avatar"><img id="img_pro_' + divid + childSnapshot.key + '" src="' + imagevalusr + '" class="rounded-circle dreams_chat" alt="image"></div><div class="chat-content"><div class="chat-profile-name"><h6 class="receiverName capitalize-first-letter"></h6><span>' + secondsToString(childSnapshot.val().date) + '</span><div class="chat-action-btns ms-3"></div><div class="chat-action-col"><a class="#" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i></a><div class="dropdown-menu chat-drop-menu dropdown-menu-end" ><a href="#" class="dropdown-item"  onclick="replyMessages(\''+childSnapshot.val().body+'\',\'' + to + '\',\'' + childSnapshot.val().senderId + '\')";><span><i class="bx bx-share"></i></span>Reply</a><a href="#" class="dropdown-item" onclick="forwardMessages(\''+forwardMsgType+'\',\''+forwardMsgName+'\',\''+forwardMsgBytes+'\',\''+forwardMsgUrl+'\')";><span><i class="bx bx-reply"></i></span>Forward</a><a href="#" class="dropdown-item" onclick="reportchat(\'' + childSnapshot.val().id + '\')"><span><i class="bx bx-dislike"></i></span>Report<input type="checkbox" class="smsg" msgtype="received" value="'+childSnapshot.val().id+'" style="display:none;"/></a><a href="#" class="dropdown-item" onclick="deletechat(\'' + childSnapshot.val().id + '\')"><span><i class="bx bx-trash"></i></span>Delete</a></div></div></div><div class="message-content">' + msgdisplay + messageStatus +'</div></div></div>').appendTo($('.main_' + main_div_group)).addClass('new');

                        usersRef.once('value', function(usersnapshot) {
                            var receiverName = '';
                            if (usersnapshot.val() != null) {
                                if(usersnapshot.val().firstName != '' || usersnapshot.val().firstName != undefined) {
                                    receiverName = usersnapshot.val().firstName;
                                }
                                $('.receiverName').text(receiverName);
                            }
                        });
                }
            }

            //Shared Images
                if (childSnapshot.val().attachment != undefined && childSnapshot.val().attachmentType == 2 && childSnapshot.val().blocked == false) {
                    $('.share-media').show();
                    $('#side-media-list').show();
                    $('#nav-home-tab').show();
                    $('<li class="list-images"><a href="' + childSnapshot.val().attachment.url + '" data-fancybox="gallery" class="fancybox"><img src="' + childSnapshot.val().attachment.url + '" alt=""></a></li>').appendTo($('#side-media-list'));
                }
                //Shared Documents
                if (childSnapshot.val().attachment != undefined && childSnapshot.val().attachmentType == 5 && childSnapshot.val().blocked == false) {
                    $('.share-media').show();
                    $('#media').show();
                    $('#nav-profile-tab2').show();
                    var attachmentFile = childSnapshot.val().attachment.url;
                    

                    // Extract the file name
                    var fileName = attachmentFile.substring(attachmentFile.lastIndexOf('/') + 1);

                    // Split the file name by dot (.) to get the file extension
                    var fileExtension = fileName.split('.').pop();
                    var fileMatch = fileExtension.match(/(.+)\?(.+)/);
                    
                    if(fileMatch[1] == 'doc' || fileMatch[1] == 'docx') {
                        var fileType = '<i class="bx bxs-file-doc"></i>';
                    } else if(fileMatch[1] == 'pdf') {
                        var fileType = '<i class="bx bxs-file-pdf"></i>';
                    } else if(fileMatch[1] == 'txt') {
                        var fileType = '<i class="bx bxs-file"></i>';
                    } else {
                        var fileType = '<i class="bx bxs-file-doc"></i>';
                    }
                    
                    $('<div class="media-file"><div class="media-doc-blk"><span>'+ fileType +'</span><div class="document-detail"><h6>'+childSnapshot.val().attachment.name+'</h6><ul><li>'+secondsToString(childSnapshot.val().date)+'</li><li>'+childSnapshot.val().attachment.bytesCount +' bytes</li></ul></div></div><div class="media-download"><a href="'+ childSnapshot.val().attachment.url +'" download target="_blank"><i class="bx bx-download"></i></a></div>').appendTo($('#media'));
                }

                //Shared Links
                if (childSnapshot.val().attachmentType == 9 && childSnapshot.val().blocked == false) {
                    $('.share-media').show();
                    $('#link').show();
                    $('#nav-profile-tab3').show();
                    if(childSnapshot.val().isurl && childSnapshot.val().isurl == true) {
                        $('<div class="media-link-grp mb-0"><div class="link-img"><a href="'+ childSnapshot.val().body +'"><img src="'+ childSnapshot.val().urlImageurl +'" alt="Img" style="height: 30px; width: 60px;"></a></div><div class="media-link-detail"><h6><a href="'+ childSnapshot.val().body +'">'+ childSnapshot.val().urlTitle +'</a></h6><span><a href="javascript:;">'+ childSnapshot.val().body +'</a></span></div></div>').appendTo($('#link'));
                    } 
                }

                //Shared Videos
                if (childSnapshot.val().attachment != undefined && childSnapshot.val().attachmentType == 1 && childSnapshot.val().blocked == false) {
                    $('.share-media').show();
                    $('#attachment-documents').show();
                    $('#nav-profile-tab1').show();
                    $('<li class="list-videos"><a href="'+ childSnapshot.val().attachment.url +'" data-fancybox class="fancybox" target="_blank"><img src="assets/img/media/media-01.jpg" alt="img"><span><i class="bx bx-play-circle"></i></span></a></li>').appendTo($('#attachment-documents'));
                }
            }
        }
        });
    });
    firebase.database().ref("data/groups/" + to).once('value', function(snapshot) {

        $('.list-group-item').remove();
        if (snapshot.val()) {
            $('#sidestatus').text(snapshot.val().status);
            $('#selected_username').text(snapshot.val().name);
            var showtime = secondsToString(snapshot.val().date);
            $('#selected_usertime').text(showtime);
            $('#sidephone').text(snapshot.val().admin);
            $('.profile-name').html(snapshot.val().name);
            $('#selected_group_id').val(to);
            $('#group-desc').text(snapshot.val().status);

            var usersRef = firebase.database().ref("data/users/" + snapshot.val().admin);
                    usersRef.once('value', function(usersnapshot) {
                    var username = usersnapshot.val().nameToDisplay;
                     $('#description-date').html('Group created by '+username+', on '+showtime+'');
            });

            var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
            if (snapshot.val().image != "") {
                imageval = snapshot.val().image;
                $('#current_group_image').addClass("avatar avatar-xl mb-3"); 
                $('#current_group_image').html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + imageval + '" alt="">');
            } else {
                $('#current_group_image').removeClass("avatar avatar-xl mb-3"); 
                $('#current_group_image').html('');
            }

            $('#addmember').html('<a href="#" onclick="addmember(\'' + snapshot.val().id + '\')"><div class="stared-group"><span class="" data-users="' + snapshot.val().id + '"> <i class="fas fa-user"></i></span><h6>Add Participants</h6></div><div class="count-group"><i class="feather-chevron-right"></i></div></a>');

            var userIds = snapshot.val().userIds;
            var currentuser = $('#current-user-number').val();
            firebase.database().ref("data/contacts/" + currentuser).orderByChild("firstName").once('value', function(csnapshot) {
                csnapshot.forEach(function(childSnapshot) {
                    if(childSnapshot.val().isBlocked == undefined || childSnapshot.val().isBlocked == false) {
                    firebase.database().ref("data/users/" + childSnapshot.key).once('value', function(userSnapshot) {
                                if (userSnapshot.val() != null) {
                                    if (userSnapshot.val().image == '' || userSnapshot.val().image == undefined) {
                                        imageval = baseUrl + 'assets/img/user-placeholder.jpg';  
                                    } else {
                                        imageval = userSnapshot.val().image;
                                    }

                                    if (userSnapshot.val().firstName == '' || userSnapshot.val().firstName == undefined) {
                                        var name = userSnapshot.val().id;
                                    } else {
                                        var name = userSnapshot.val().firstName;
                                    }
                                    if (userSnapshot.val().id != undefined) {
                                        if ($.inArray(userSnapshot.val().id, snapshot.val().userIds) === -1) {
                                            $('.contact-users-list-item').remove();
                                            $('<li class="user-list-item contact-users-list-item"><a href="javascript:;"><input type="hidden" id="email" value="'+userSnapshot.val().email+'"><div class="avatar"><img src="' + imageval + '" class="rounded-circle" alt="image"></div><div class="users-list-body"><div><h5>'+ name +'</h5><p>' + secondsToString(userSnapshot.val().timeStamp) + '</p></div></div><div class="notify-check parti-notify-check"><div class="form-check d-flex align-items-center justify-content-start ps-0"><label class="custom-check mt-0 mb-0"><input type="checkbox" class="custom-control-input" name="friends_list_arr[]" id="mobileNumber" value="'+userSnapshot.val().id+'"><span class="checkmark"></span></label></div></div></a></li>').appendTo($('#member-user-list'));
                                        } 
                                        /*else {
                                            $(".recent-block-group").remove();
                                            $(".show-participant").remove();
                                        $('<div class="recent-block-group">Contact users not found</div>').appendTo('#empty-group-member');
                                    }*/
                                    } 
                                }     
                        });
                    }
                });
            });
            //var userids = userIds.toString();
            $("#userids").val(userIds.toString());
            $('#selected_userimage').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#sideprofileimg').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#groupnav-profile').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#rightside_member_count_text').text('Group: '+(userIds.length) + ' Participants');
            $('#rightside_member_count_texts').text((userIds.length) + ' Participants');
            
            var currentuser = $('#current-user-number').val();
            var imagevalusryou = baseUrl + 'assets/img/user-placeholder.jpg';
            var onlinecounts = 0;
            userIds.forEach(function(entry) {
                var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';
                var usersRef = firebase.database().ref("data/users/" + entry);
                usersRef.once('value', function(usersnapshot) {

                   /* if (userIds.length > 1) {
                        $('<div class="avatar avatar-xs group_img group_header"><img class="avatar-img rounded-circle" id="grp_user_img1_" alt="User Image" src="' + imagevalusr + '"></div><div class="avatar avatar-xs group_img group_header"><img class="avatar-img rounded-circle"  id="grp_user_img2_" alt="User Image" src="' + imagevalusr + '"></div><div class="avatar avatar-xs group_img group_header"><span class="avatar-title rounded-circle border border-white">' + (userIds.length) + '</span></div>').appendTo($('#append_images'));
                    } else {
                        $('<div class="avatar avatar-xs group_img group_header"><img class="avatar-img rounded-circle" alt="User Image" id="grp_user_img1_"  src="' + imagevalusr + '"></div><div class="avatar avatar-xs group_img group_header"><span class="avatar-title rounded-circle border border-white">' + (userIds.length) + '</span></div>').appendTo($('#append_images'));
                    }
*/

                    if (usersnapshot.val().online != undefined && usersnapshot.val().online != '') {
                        var online = usersnapshot.val().online;

                        // Assuming online is a boolean value, check if it's true
                        if (online === true) {
                            onlinecounts++;
                        }
                    }

                    // Assuming userIds is defined elsewhere in your code
                    $('#last-seen').html(userIds.length + ' Members, <span class="active-online">' + onlinecounts + ' Online</span>');

                    if (typeof snapshot.val().grpExitUserIds !== 'undefined') {
                        var grpExitUserIds = snapshot.val().grpExitUserIds;
                    }
                    else {
                        var grpExitUserIds = [];
                    }

                    if (usersnapshot.val() != null) {
                        if (usersnapshot.val().image != undefined && usersnapshot.val().image != '') {
                            imagevalusr = usersnapshot.val().image;
                        }
                        if (entry == currentuser) {
                            namedisplay = 'You';
                        } else {
                            namedisplay = usersnapshot.val().name;
                        }
                        statusdisplay = usersnapshot.val().status;
                    } else {
                        namedisplay = entry;
                        statusdisplay = "";
                    }
                    if (usersnapshot.val().id == snapshot.val().admin) {
                        var admin = '<span class="admin-profiles">Admin</span>';
                        var delete_parti = '';
                    } else {
                        var admin = '';
                        var delete_parti = '<a href="#"><span><i class="bx bx-trash"></i></span></a>';
                    }
                    if (snapshot.val().admin == currentuser && usersnapshot.val().id != snapshot.val().admin) {
                        var delete_parti = '<a href="#"><span><i class="bx bx-trash" onclick="remove_group_member(\'' + usersnapshot.val().id + '\')"></i></span></a>';
                    } else {
                        var delete_parti = '';
                    }
                    if ($.inArray(usersnapshot.val().id, grpExitUserIds) === -1) {
                        $('<li class="d-flex list-group-item"><div><div class="avatar"><img src="' + imagevalusr + '" class="rounded-circle" alt="image"></div></div><div class="users-list-body d-flex justify-content-between"><div><h5>' + namedisplay + '</h5><p>' + statusdisplay + '</p></div><div>' + admin +'</div></div>' + delete_parti + '</li>').appendTo($('#side_member_list'));
                    }
                });
            });
        }
    });
}
var hr = 0;
var min = 0;
var sec = 0;
var cycle = '';

function reportchat(chatKey) {
    $("#report-user").modal('show');
    $('#reportMsgKey').val(chatKey);
}

function confirmreport() {
    var chat_id = $('#reportMsgKey').val();
    
   var selected = $(".smsg:checked").length;

       
        var currentuser = $('#current-user-number').val();
        var from = $('#from_usergroup').val();
        var to_user = $('#to_usergroup').val();
        var d = new Date();
        var n = d.getTime();

        firebase.database().ref("data/chats/" + to_user + "/" + chat_id).once('value', function(snapshot) {
                if (snapshot.val().senderId) {
                    var senderId = snapshot.val().senderId;
                }
            var myRef = firebase.database().ref("data/report").push();
            myRef.set({
                "chatPath": to_user,
                //"id": myRef.key,
                "messageId": chat_id,
                "reportBy": currentuser,
                "reportUser": senderId,
                "timeStamp": n
            });
        });
        $("#report-user").modal('hide');
        toastr.success("User reported successfully");
        $(".smsg").prop('checked', false);
        $(".useractions").css("display","none");
}

function addmember(chatKey) {
    $("#add-parti").modal('show');
    $('#addgroupmemberid').val(chatKey);
}


function addGroupMember() {
    var group_id = $('#addgroupmemberid').val();
    var currentuser = $("#current-user-number").val();
    var searchIDs = $('#mobileNumber:checked').map(function() {
        return $(this).val();
    }).get();

    if (searchIDs.length === 0) {
        toastr.warning("No buddies selected");
    } else {
        var from = $('#from_usergroup').val();
        var to = $('#to_usergroup').val();
        var adaRef = firebase.database().ref("data/groups/" + group_id);
        adaRef.once("value", function(snapshot) {
            var userarray = snapshot.val().userIds;
            var userIds = (snapshot.val().userIds !== undefined) ? snapshot.val().userIds : [];
            var grpExitUserIds = snapshot.val().grpExitUserIds;
            $.each( searchIDs, function( key, value ) {
                grpExitUserIds.pop(value);
            });
            // Concatenate the arrays, not push
            userIds = userIds.concat(searchIDs);

            adaRef.update({
                grpExitUserIds: grpExitUserIds,
                userIds: userIds
            });
            toastr.success("New Participants added successfully");
            setTimeout(function() {
                $('#add-parti').modal('hide');
                $("input[name='friends_list_arr[]']:checkbox").prop('checked', false);
                showgroupchathistoryfirst(from, to);
            }, 2000); // Adjust the delay as needed
        });
    }
}


/*function addGroupMember() {
    var group_id = $('#addgroupmemberid').val();
    var currentuser = $("#current-user-number").val();
    var searchIDs = [];
    //var searchIDs = $('#mobileNumber:checked').val();
   var searchIDs = $('#mobileNumber:checked').map(function() {
        return $(this).val();
    }).get();
    if (searchIDs == '') {
        swal("Warning!","No buddys selected", "warning");
    } else {
        var from = $('#from_usergroup').val();
        var to = $('#to_usergroup').val();
        var adaRef = firebase.database().ref("data/groups/" + group_id);
        adaRef.once("value", function(snapshot) {
                var userarray = snapshot.val().userIds;
                if(snapshot.val().userIds != undefined) {
                   var userIds = snapshot.val().userIds; 
                }
                else {
                    var userIds = [];
                }
                console.log(searchIDs);
                userIds.push(searchIDs);
                adaRef.update({
                    userIds: userIds
                });
                swal({
                    title: "Success!",
                    text: "New Participants added successfully",
                    type: "success"
                }).then(function () {
                    $('#add-parti').modal('hide');
                    $("input[name='friends_list_arr[]']:checkbox").prop('checked', false);
                    showgroupchathistoryfirst(from, to);
                    window.location.reload();
                });
        });


    }
}*/

        /*var d = new Date();
        var n = d.getTime();
        //var userId = "group_" + currentuser + "_" + n;
        searchIDs.push(currentuser);
        //console.log(searchIDs);return false;
        firebase.database().ref('data/groups/' + group_id).update({
            "userIds": searchIDs
        });
        swal("Success!", "New Participants added successfully", "success");
        $('#add-parti').modal('hide');
        $("input[name='friends_list_arr[]']:checkbox").prop('checked', false);*/
function deletechat(chatKey) {
    $("#delete-message").modal('show');
    $('#deleteMsgKey').val(chatKey);
}

function deleteselectedchat() {
    var chat_id = $('#deleteMsgKey').val();
    var deleteMsgType = $('#deleteType:checked').val();
    var checkedCount = $('#deleteType:checked').length;

    if(checkedCount == 0) {
        alert("Kindly Select Anyone Delete Type");
        return false;
    }
    if(checkedCount == 2) {
        var delete_type = 'all';
    } else {
        var delete_type = deleteMsgType;
    }

    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to delete this?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var from = $('#from_usergroup').val();
            var to = $('#to_usergroup').val();
            var combination = $('#combination_user').val();
            var currentuser = $('#current-user-number').val();
            /*var from = $('#from_user').val();
            var to = $('#to_user').val();*/
            var username = $('#username').val();
            $("#delete-message").modal('hide');
            var adaRef = firebase.database().ref("data/chats/" + to + "/" + chat_id);  
            if (delete_type == 'me') {
                adaRef.once("value", function(snapshot) {     
                    if (snapshot.key) {
                        if (snapshot.val().delete=='') {
                            adaRef.update({
                                delete: currentuser
                            });
                        }
                        else {
                            firebase.database().ref("data/chats/" + to + '/' + chat_id).remove();
                        }
                    }
                });
            }
            else {
                firebase.database().ref("data/chats/" + to + '/' + chat_id).remove();
            }
            showgroupchathistory(from, to);
            var chatRef = firebase.database().ref("data/chats/");
            chatRef.once('value', function(snapshot) {
                if (snapshot.child(to).exists() != true) {
                    firebase.database().ref("data/chats/" + to).set(true);
                }
            });
        }
    });
}

function calltimerdiv() {
    sec = parseInt(sec);
    min = parseInt(min);
    hr = parseInt(hr);

    var hour = document.getElementById("hours_id");
    var mint = document.getElementById("minutes_id");
    var secd = document.getElementById("seconds_id");

    sec = sec + 1;

    if (sec == 60) {
        min = min + 1;
        sec = 0;
    }
    if (min == 60) {
        hr = hr + 1;
        min = 0;
        sec = 0;
    }

    if (sec < 10 || sec == 0) {
        sec = '0' + sec;
    }
    if (min < 10 || min == 0) {
        min = '0' + min;
    }
    if (hr < 10 || hr == 0) {
        hr = '0' + hr;
    }
    hour.innerHTML = hr;
    mint.innerHTML = min;
    secd.innerHTML = sec;
    var call_duration = document.getElementById("call_duration");
    if (call_duration) {
        call_duration.value = hr+':'+min+':'+sec;
    }
    cycle = setTimeout(calltimerdiv, 1000);
}
function setcalltimerzero() {
    var hr = 0;
    var min = 0;
    var sec = 0;
    var cycle = '';
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
    var fltYearDays = 356.2425;
    var intMonthSeconds = (fltYearDays / 12) * 86400;
    var intSecondsDifference = Math.floor(((new Date()).getTime() / 1000) - millis / 1000);
    var strOut = '',
        blFuture = intSecondsDifference < 0;
    if (intSecondsDifference < 60) {
        if (!blFuture &&
            intSecondsDifference < 10) {
            return 'Just now';
        } else {
            return blFuture ? 'In a moment' : 'A moment ago';
        }
    } else if (intSecondsDifference < 120) {
        return (blFuture) ? 'In an minute' : 'A minute ago';
    } else if (intSecondsDifference < 3600) {
        strOut = Math.floor(intSecondsDifference / 60) + ' minutes';
    } else if (intSecondsDifference < 7200) {
        return (blFuture) ? 'In an hour' : 'An hour ago';
    } else if (intSecondsDifference < 86400) {
        strOut = Math.floor(intSecondsDifference / 3600) + ' hours';
    } else if (intSecondsDifference < 172800) {
        return (blFuture) ? 'Tomorrow' : 'Yesterday';
    } else if (intSecondsDifference < intMonthSeconds) {
        strOut = Math.floor(intSecondsDifference / 86400) + ' days';
    } else if (intSecondsDifference < intMonthSeconds * 2) {
        return (blFuture) ? 'In a month' : 'A month ago';
    } else if (intSecondsDifference < fltYearDays * 86400) {
        strOut = Math.floor(intSecondsDifference / intMonthSeconds) + ' months';
    } else if (intSecondsDifference < fltYearDays * 86400 * 2) {
        return (blFuture) ? 'In a year' : 'A year ago';
    } else {
        strOut = Math.floor(intSecondsDifference / (fltYearDays * 86400)) + ' years';
    }
    return (blFuture) ? 'In ' + strOut : strOut + ' ago';
}

function thumbnailPreviewImg(messageUrl) {
    var getData = '';
    $.ajax({
        async: false,
        url: 'home/initializeDom',
        type: 'POST',
        data: {url: messageUrl},
        dataType: 'json',
        success: function (response) {
            getData = response;
        }
    });
    return getData;
}

function sendGroupMessage() {
    var no_of_unblock_link = $('.unblock_link').length;
    if (no_of_unblock_link) {
        toastr.warning("Unblock Group to Send Message!");
        return false;
    }
    var message = document.getElementById("chat_message").value;
    if (message == '') {
        toastr.warning("Type your message");
        return false;
    }

    var thumbnailImg = '';
    var previewTitle = '';
    var previewImages = '';
    var previewOgImages = '';
    var previewDescription = '';
    const isValidUrl = urlString=> {
        var urlPattern = new RegExp('^(https?:\\/\\/)?'+ // validate protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // validate domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // validate OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // validate port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // validate query string
        '(\\#[-a-z\\d_]*)?$','i'); // validate fragment locator
      return !!urlPattern.test(urlString);
    }

    if(isValidUrl(message) == true) {
        var isurl = true; //Link
        var attachmentType = 9; //Link
        thumbnailImg = thumbnailPreviewImg(message);
        previewTitle = (thumbnailImg.title)?thumbnailImg.title:'';
        previewOgImages = thumbnailImg.ogimage;
        previewImages = thumbnailImg.images;
        previewDescription = (thumbnailImg.description)?thumbnailImg.description:'';
        //console.log(thumbnailImg); return false;
    } else {
        var isurl = false; //Normal Message
        var attachmentType = 6;
    }

    var from = document.getElementById("from_usergroup").value;
    var to = document.getElementById("to_usergroup").value;
    var d = new Date();
    var n = d.getTime();
    var blocked = false;
    var readmsg = false;
    var userIds = [];
    var grpExitUserIds = [];
    firebase.database().ref("data/users/" + to).once('value', function(usersnapshot) {
        if (usersnapshot.val()) {
            if (usersnapshot.val().blockedUsersIds) {
                blockids = usersnapshot.val().blockedUsersIds;
                if (jQuery.inArray(from, blockids) !== -1) {
                    blocked = true;
                    readmsg = false;
                }
            }
        }
    });
    firebase.database().ref("data/groups/" + to).once('value', function(usersnapshot) {
        if (usersnapshot.val()) {
            if (usersnapshot.val().userIds) {
                userIds = usersnapshot.val().userIds;
            }
            if (typeof usersnapshot.val().grpExitUserIds !== 'undefined') {
                grpExitUserIds = usersnapshot.val().grpExitUserIds;
            }
        }
    });

    //New Code
    if($.inArray(from, grpExitUserIds) === -1) {
        var available_users = userIds.filter(x => grpExitUserIds.indexOf(x) === -1);
        var myRef = firebase.database().ref("data/chats/" + to).push(); 
        myRef.set({
            "attachmentType": attachmentType,
            "blocked": blocked,
            "body": message,
            "date": n,
            "delete": "",
            "delivered": false,
            "id": myRef.key,
            "readMsg": readmsg,
            "recipientId": to,
            "replyId": "0",
            "selected": false,
            "senderId": from,
            "senderName": from,
            "sent": true,
            "userIds": available_users,
            "isurl": isurl,
            "urlDescription": previewDescription,
            "urlImageurl": (previewOgImages) ? previewOgImages : previewImages,
            "urlTitle": previewTitle
        });
        var usersRef = firebase.database().ref("data/users/" + from);
        usersRef.once('value', function(usersnapshot) {
            var lastMsgName = '';
            if (attachmentType != 3) {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + message;
            } else {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="bx bx-microphone me-1"></i>Audio';
            }

            if(attachmentType == 2) {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-image ms-1 me-1"></i>Photo';
            }
            if(attachmentType == 9) {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-link ms-1 me-1"></i>Link';
            }
            var divid = to.replace(/[.*+?^${}()|[\]\\]/g, "");
            $('#lastmsg_' + divid).html(lastMsgName);

            var showtime = secondsToString(n);
            $('#lastmsgtime_' + divid).html(showtime);

        });
        
        var myindex = available_users.indexOf(from);
        if (myindex !== -1) {
          available_users.splice(myindex, 1);
        }
        /*if (available_users.length>0) {
            $.each(available_users, function( index, value ) {
                firebase.database().ref("data/users/" + value).once('value', function(usersnapshot1) 
                {
                    if (usersnapshot1.val().deviceToken!='') {
                        $.ajax({
                            url: 'home/usernotification',
                            type: 'POST',
                            data: {
                                deviceToken: usersnapshot1.val().deviceToken,body:message,to:to,osType:usersnapshot1.val().osType,attachimg:message,from:from,attachmentType:'text'
                            },
                            success: function(data) {
                            }
                        });
                    }
                    
                });
            });
        }*/
    }
    //
    $('#chat_message').val("");
    $('.emoji-wysiwyg-editor').html("");
    return false;
}

function updateGroupIcon() {
    var e = $("#drop-zone-update-group-image")[0].files,
        a = !0;
    e && (validateFile1(e) ? (a = handleFileUpload2(e, "groupIcon")) : toastr.warning("Select Only Images!"));
    0 != a && (toastr.success("Group Image Updated Successfully!"), $("#group_image_modal").modal("hide"));
    $("#drop-zone-update-group-image").val('');
}
function handleFileUpload2(e, a) {
    for (var t = 0; t < e.length; t++) {
        new FormData().append("file", e[t]),
            fireBaseImageUpload2({ file: e[t], path: "/Dreamchat", up_path: a }, function (e) {
                if (!e.error && (e.progress, e.downloadURL)) return e.downloadURL;
            });
    }
}
function fireBaseImageUpload2(e, a) {
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
                "other" != r ? updategroupimage(r, e, d, n, l) : toastr.warning("Select Only Images!"), a({ downloadURL: e, element: t, fileSize: n, fileType: o, fileName: d });
            }
        );
}
function updategroupimage(e, a, t, r, s) {
    var groupIds = $("#selected_group_id").val();
    var divid = groupIds.replace(/[.*+?^${}()|[\]\\]/g, "")
    var groups = '#user_'+divid;

    var l = $("#selected_group_id").val(),
        i = {};
    "profile" == s ? ((i.image = a), $("#current_group_image").html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + a + '" alt="">')) : ((i.image = a)),$("#sideprofileimg").html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + a + '" alt="">'),$("#selected_userimage").html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + a + '" alt="">'),$(groups).html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + a + '" alt="">'),$("#current_group_image").html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + a + '" alt="">');$('#current_group_image').addClass("avatar avatar-xl mb-3"); 
        firebase 
            .database()
            .ref("data/groups/" + l)
            .update(i);
}

function validateFile(files) {
    var allowedExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'mpg', 'mov', 'wmv', 'rm', '3g2', '3gp', 'm2v', 'm4v', 'wav', 'aif', 'mp3', 'mp4', 'mid', 'doc', 'pdf', 'docx', 'xls', 'xlsx', 'csv'];
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var fileExtension = file.name.split('.').pop().toLowerCase();
        if (jQuery.inArray(fileExtension, allowedExtension) === -1) {
            return false;
        }
    }
    return true;
}

function handleFileUpload(files, obj) {
    for (var i = 0; i < files.length; i++) {
        var fd = new FormData();
        fd.append('file', files[i]);
        fireBaseImageUpload({
            'file': files[i],
            'path': '/Dreamchat'
        }, function(data) {
            if (!data.error) {
                if (data.progress) {
                    // progress update to view here
                }
                if (data.downloadURL) {
                    // update done
                    // download URL here "data.downloadURL"
                }
            } else {
            }
        });
    }
};

function handleFileUpload1(files, groupId) {
    for (var i = 0; i < files.length; i++) {
        var fd = new FormData();
        fd.append('file', files[i]);
        fireBaseImageUpload1({
            'file': files[i],
            'path': '/Dreamchat',
            'groupId' : groupId
        }, function(data) {
            if (!data.error) {
                if (data.progress) {
                    // progress update to view here
                }
                if (data.downloadURL) {
                    // update done
                    return data.downloadURL;
                }
            } else {
            }
        });
    }
}

function validateFile1(files) {
    var allowedExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var fileExtension = file.name.split('.').pop().toLowerCase();
        if (jQuery.inArray(fileExtension, allowedExtension) === -1) {
            return false;
        }
    }
    return true;
}

function fireBaseImageUpload1(parameters, callBackData) {
        // expected parameters to start storage upload
        var file = parameters.file;
        var path = parameters.path;
        var groupId = parameters.groupId;
        var name;
        //just some error check
        if (!file) {
            callBackData({
                error: 'file required to interact with Firebase storage'
            });
        }
        if (!path) {
            callBackData({
                error: 'Node name required to interact with Firebase storage'
            });
        }
        var metaData = {
            'contentType': file.type
        };
        var arr = file.name.split('.');
        var fileSize = (file.size); // get clean file size (function below)
        var fileType = file.type;
        var n = (+new Date()) + '-' + file.name;
        // generate random string to identify each upload instance
        name = generateRandomString1(12); //(location function below)        
        var checktypeflag = getFileType1(fileType);
        var subpath = '';
        if (checktypeflag == 1) {
            subpath = '/Video';
        } else if (checktypeflag == 2) {
            subpath = '/Image';
        } else if (checktypeflag == 3) {
            subpath = '/Audio';
        } else if (checktypeflag == 5) {
            subpath = '/Document';
        } else if (checktypeflag == 8) {
            subpath = '/Recording';
        }
        var fullPath = path + subpath + '/' + n;
        var uploadFile = storageRef.child(fullPath).put(file, metaData);
        // first instance identifier
        callBackData({
            id: name,
            fileSize: fileSize,
            fileType: fileType,
            fileName: n
        });
        uploadFile.on('state_changed', function(snapshot) {
            var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
            progress = Math.floor(progress);
            callBackData({
                progress: progress,
                element: name,
                fileSize: fileSize,
                fileType: fileType,
                fileName: n
            });
        }, function(error) {
            callBackData({
                error: error
            });
        }, function() {
            var downloadURL = uploadFile.snapshot.downloadURL;
            var checktypeflag = getFileType1(fileType);
            if (checktypeflag != 'other') {
                updateGroupImage(checktypeflag, downloadURL, n, fileSize, groupId);
            } else {
                toastr.warning("Select Only Images!");
            }
            callBackData({
                downloadURL: downloadURL,
                element: name,
                fileSize: fileSize,
                fileType: fileType,
                fileName: n
            });
        });
    }

    function generateRandomString1(length) {
        var chars = "abcdefghijklmnopqrstuvwxyz";
        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        return pass;
    }

    function getFileType1(fileType) {
        if (fileType.match('image.*'))
            return 2;
        return 'other';
    }

    function updateGroupImage(checktypeflag, downloadURL, name, fileSize, groupId) {
        var groupIds = groupId;

        var divid = groupIds.replace(/[.*+?^${}()|[\]\\]/g, "");
        var groups = '#user_'+divid;

        firebase.database().ref('data/groups/' + groupIds).update({
            image: downloadURL
        });

        $("#sideprofileimg").html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + downloadURL + '" alt="">'),$("#selected_userimage").html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + downloadURL + '" alt="">'),$(groups).html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + downloadURL + '" alt="">'),$("#current_group_image").html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + downloadURL + '" alt="">');$('#current_group_image').addClass("avatar avatar-xl mb-3"); 
    }

function fireBaseImageUpload(parameters, callBackData) {
    // expected parameters to start storage upload
    var file = parameters.file;
    var path = parameters.path;
    var name;
    //just some error check
    if (!file) {
        callBackData({
            error: 'file required to interact with Firebase storage'
        });
    }
    if (!path) {
        callBackData({
            error: 'Node name required to interact with Firebase storage'
        });
    }
    var metaData = {
        'contentType': file.type
    };
    var arr = file.name.split('.');
    var fileSize = (file.size); // get clean file size (function below)
    var fileType = file.type;
    var fileExt = file.name.split('.').pop().toLowerCase();
    var n = (+new Date()) + '-' + file.name;
    // generate random string to identify each upload instance
    name = generateRandomString(12); //(location function below)
    //var fullPath = path + '/' + name + '.' + arr.slice(-1)[0];
    var checktypeflag = getFileType(fileType, fileExt);
    var subpath = '';
    var atttype = '';
    if (checktypeflag == 1) {
        subpath = '/Video';
        atttype = 'Video';
    } else if (checktypeflag == 2) {
        subpath = '/Image';
        atttype = 'Image';
    } else if (checktypeflag == 3) {
        subpath = '/Audio';
        atttype = 'Audio';
    } else if (checktypeflag == 5) {
        subpath = '/Document';
        atttype = 'Document';
    } else if (checktypeflag == 8) {
        subpath = '/Recording';
        atttype = 'Recording';
    }
    var fullPath = path + subpath + '/' + n;
    var uploadFile = storageRef.child(fullPath).put(file, metaData);
    // first instance identifier
    callBackData({
        id: name,
        fileSize: fileSize,
        fileType: fileType,
        fileName: n
    });
    uploadFile.on('state_changed', function(snapshot) {
        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
        progress = Math.floor(progress);
        callBackData({
            progress: progress,
            element: name,
            fileSize: fileSize,
            fileType: fileType,
            fileName: n
        });
    }, function(error) {
        callBackData({
            error: error
        });
    }, function() {
        var downloadURL = uploadFile.snapshot.downloadURL;
        if (checktypeflag != 'other') {
            sendAttacheMessage(checktypeflag, downloadURL, n, fileSize,atttype);
        }
        callBackData({
            downloadURL: downloadURL,
            element: name,
            fileSize: fileSize,
            fileType: fileType,
            fileName: n
        });
    });
}

function sendAttacheMessage(checktypeflag, downloadURL, name, fileSize,atttype) {
    var no_of_unblock_link = $('.unblock_link').length;
    if (no_of_unblock_link) {
        toastr.warning("Unblock Group to Send Message!");
        return false;
    }
    var from = document.getElementById("from_usergroup").value;
    var to = document.getElementById("to_usergroup").value;
    var d = new Date();
    var n = d.getTime();
    var blocked = false;
    var readmsg = false;
    var userIds = [];
    var grpExitUserIds = [];
    firebase.database().ref("data/users/" + to).once('value', function(usersnapshot) {
        if (usersnapshot.val()) {
            if (usersnapshot.val().blockedUsersIds) {
                blockids = usersnapshot.val().blockedUsersIds;
                if (jQuery.inArray(from, blockids) !== -1) {
                    blocked = true;
                    readmsg = false;
                }
            } else {
            }
        }
    });
    firebase.database().ref("data/groups/" + to).once('value', function(usersnapshot) {
        if (usersnapshot.val()) {
            if (usersnapshot.val().userIds) {
                userIds = usersnapshot.val().userIds;
            }
            if (typeof usersnapshot.val().grpExitUserIds !== 'undefined') {
                grpExitUserIds = usersnapshot.val().grpExitUserIds;
            }
        }
    });

    if($.inArray(from, grpExitUserIds) === -1) 
    {
        var available_users = userIds.filter(x => grpExitUserIds.indexOf(x) === -1);

        var myRef1 = firebase.database().ref("data/chats/" + to).push(); 
        myRef1.set({
            "attachment": {
                "bytesCount": fileSize,
                "name": name,
                "url": downloadURL
            },
            "attachmentType": checktypeflag,
            "blocked": blocked,
            "date": n,
            "delete": "",
            "delivered": false,
            "id": myRef1.key,
            "readMsg": readmsg,
            "recipientId": to,
            "replyId": "0",
            "selected": false,
            "senderId": from,
            "senderName": from,
            "sent": true,
            "statusUrl": "",
            "userIds": available_users
        });
        var usersRef = firebase.database().ref("data/users/" + from);
        usersRef.once('value', function(usersnapshot) {
            var lastMsgName = '';
            if (checktypeflag == 3) {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="bx bx-microphone me-1"></i>Audio';
            }
            if(checktypeflag == 2) {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-image ms-1 me-1"></i>Photo';
            }
            if(checktypeflag == 5) {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-file-text ms-1 me-1"></i>Doc';
            }
            if(checktypeflag == 1) {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-video ms-1 me-1"></i>Video';
            }
            var divid = to.replace(/[.*+?^${}()|[\]\\]/g, "");
            $('#lastmsg_' + divid).html(lastMsgName);

            var showtime = secondsToString(n);
            $('#lastmsgtime_' + divid).html(showtime);
        });

        var myindex = available_users.indexOf(from);
        if (myindex !== -1) {
          available_users.splice(myindex, 1);
        }

        /*if (available_users.length>0) {
            $.each(available_users, function( index, value ) {
                firebase.database().ref("data/users/" + value).once('value', function(usersnapshot1) 
                {
                    if (usersnapshot1.val().deviceToken!='') {
                        $.ajax({
                            url: 'home/usernotification',
                            type: 'POST',
                            data: {
                                deviceToken: usersnapshot1.val().deviceToken,body:downloadURL,to:to,osType:usersnapshot1.val().osType,attachimg:downloadURL,from:from,attachmentType:'text'
                            },
                            success: function(data) {
                                
                                console.log(data);
                            }
                        });
                    }
                    
                });
            });
        }*/
    }
   //scrollOnBottom();
    
    $('#drag_files').modal('hide');
    //scrollOnBottom();
    return false;
}
$(document).on('click','.user-list-item',function(){
    $('.chat_form').empty();  
});
function scrollOnBottom() {
    $(".chat-body").mCustomScrollbar("update");
    $('.chat-body').mCustomScrollbar("scrollTo", "bottom", {scrollEasing:"easeOut"});
}

function getFileType(fileType, fileExt) {
    var iallowedExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    var vallowedExtension = ['mpg', 'mov', 'wmv', 'rm', '3g2', '3gp', 'm2v', 'm4v', 'mp4'];
    var aallowedExtension = ['wav', 'aif', 'mp3', 'mid'];
    var dallowedExtension = ['doc', 'pdf', 'docx', 'xls', 'xlsx', 'csv'];
    if (jQuery.inArray(fileExt, iallowedExtension) !== -1)
        return 2;
    if (jQuery.inArray(fileExt, vallowedExtension) !== -1)
        return 1;
    if (jQuery.inArray(fileExt, aallowedExtension) !== -1)
        return 3;
    if (jQuery.inArray(fileExt, dallowedExtension) !== -1)
        return 5;
    return 'other';
}

function generateRandomString(length) {
    var chars = "abcdefghijklmnopqrstuvwxyz";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function formatBytes(bytes, decimals) {
    if (bytes == 0) return '0 Byte';
    var k = 1000;
    var dm = decimals + 1 || 3;
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
function sendgroupinvite() {
    var currentuser = $('#current-user-number').val();
    var group_id = $("#group_id").val();
    var encode = encodeURIComponent(group_id);
    var message = '<a target="_blank" href="'+baseUrl+'joingroup?groupid='+encode+'">Click the Link to join Group</a>';
    var d = new Date();
    var n = d.getTime();
    var noofusers = $('.invitegroup').length;
    if (noofusers > 0) {
        $("#error_user").html("");
        //get invited members
        $(".invitegroup").each( function() {
            //check available combination
            var combination_1 = currentuser+'-'+$(this).val();
            var combination_2 = $(this).val()+'-'+currentuser;
            var combination = '';
            firebase.database().ref("data/chats/" + combination_1).once('value', function(checksnapshot1) 
            {
                if (checksnapshot1.val() == null) {
                    //check another combination
                    firebase.database().ref("data/chats/" + combination_2).once('value', function(checksnapshot2) 
                    {
                        if (checksnapshot2.val() == null) {
                            combination = combination_1;
                        }
                        else {
                            combination = combination_2;
                        }
                        
                    }); 
                }
                else {
                    combination = combination_1;
                }
            });
            //send msg to them
            var myRef = firebase.database().ref("data/chats/" + combination).push();
            myRef.set({
                "attachmentType": 6,
                "blocked": false,
                "body": message,
                "date": n,
                "delete": "",
                "delivered": true,
                "id": myRef.key,
                "readMsg": false,
                "recipientId": $(this).val(),
                "replyId": "0",
                "selected": false,
                "senderId": currentuser,
                "senderName": currentuser,
                "sent": true
            });
        });
        $(".invitegroup").val('');
        $("#group_invite_modal").modal('hide');
        toastr.success("Selected user Successfully invited!");
    }
    else {
        $("#error_user").html("Please select users");
    }
}

$(document).on('click','.users-list-body div',function(){
    $("#drop-zone-file").val(''); 
    $('.chat_form').empty();
});

function selectusers(call_type) {
    var currentuser = $('#current-user-number').val();
    var group_id = $('#to_usergroup').val();
    //var group_id = $("#group_id").val();
    $("#groupcall_modal").modal('show');
    $('.my-group-list').html('');
    //users of the group
    $("#call_type").val(call_type);
    firebase.database().ref("data/groups/" + group_id).once('value', function(usersnapshot) {
        var userIds = usersnapshot.val().userIds;
        if (typeof usersnapshot.val().grpExitUserIds !== 'undefined') {
            var grpExitUserIds = usersnapshot.val().grpExitUserIds;
        }
        else {
            var grpExitUserIds = [];
        }
        var available_users = userIds.filter(x => grpExitUserIds.indexOf(x) === -1);
        var users = $.grep(available_users, function(value) {
          return value != currentuser;
        });

        if(users.length > 0) {
            $.each(users, function( index, value ) {
                var usersRef = firebase.database().ref("data/users/" + value);
                usersRef.once('value', function(usersnapshots) {
                    if (usersnapshots.val().nameToDisplay == undefined || usersnapshots.val().nameToDisplay == '') {
                        var username = value;
                    } else {
                        var username = usersnapshots.val().nameToDisplay;
                    }
                    $('<div class="form-check"><input class="form-check-input callusers" type="checkbox" value="'+value+'" id="check'+value+'" /><label class="form-check-label" for="check'+value+'">'+username+'</label></div>').appendTo($('.my-group-list'));
                });
            });
        }
    });
}

function onetogroupnew(type) {
/*    var deviceType = getDeviceType();
    if(deviceType != 'Firefox') {
        $('#call_status_popup').modal('show');
    } else {*/
        var currentuser = $('#current-user-number').val();
        var group_id = $('#to_usergroup').val();
        var call_type = $("#call_type").val();
        var isVideo = (call_type=='video') ? true:false;
        var title = (call_type=='video') ? 'Group-video-call':'Group-audio-call';
        //channelname
        var channel_name = makeid(10);
        //insert in call for caller
        var callerids = $(".callusers:checked").map(function(){
            return $(this).val();
        }).get(); 

        firebase.database().ref("data/groups/" + group_id).once('value', function(gsnapshot) {
            var group_name = gsnapshot.val().name;
        

        var cid = grouppushcalldetails(currentuser, callerids, '', 'OUT', isVideo);
        var calllink = 'user_type=group&call_type='+call_type+'&channelname='+channel_name+'&caller='+currentuser+'&receiver=&group='+group_id+'&cid='+cid+'&group_name='+group_name;
        
        //var calllink = 'user_type=onetoone&call_type='+type+'&channelname='+channel_name+'&caller='+caller+'&receiver='+receiver+'&group=&currentuser='+currentuser;

        //go to call
        $(".callusers:checked").each(function() {
            //check user is busy
            var cuser = $(this).val();
            firebase.database().ref("data/users/" + cuser).once('value', function(snapshot) {
                if (snapshot.val().call_status == undefined || snapshot.val().call_status == true)
                {
                    firebase.database().ref('data/users/' + cuser).update({incomingcall: calllink, groupcallusers:callerids});
                    if (snapshot.val().webqrcode == undefined || snapshot.val().webqrcode=='') {
                        //grouppushnotification(currentuser, cuser, group_id, channel_name, title, '', callerids);
                    }
                    
                }
            });

        });
        //open url
        if (title == 'Group-audio-call') {
            var href = baseUrl+'group-call?'+calllink+'&cid='+cid+'&callerids='+callerids;
        } else {
            var href = baseUrl+'group-video-call?'+calllink+'&cid='+cid+'&callerids='+callerids;
        }
        //open url
        //var href = baseUrl+'group-call?'+calllink+'&cid='+cid+'&callerids='+callerids;
        window.open(href, '_blank');
        });
    //}
}

function grouppushcalldetails(from, callerIds, callerName, stext, isVideo) {
    var d = new Date();
    var n = d.getTime();
    var myRef = firebase.database().ref("data/calls/" + from).push();
    myRef.set({
        "callerId": callerIds,
        "callerImg": "",
        "callerName": "",
        "currentMills": n,
        "inOrOut": stext,
        "isVideo": isVideo,
        "type" : "group",
        "userId": from,
        "id": myRef.key
    });
    return myRef.key;
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

function grouppushnotification(fromuser, touser, group_id, channel_name, title, message, userIds) {
    firebase.database().ref("data/users/" + touser).once('value', function(usersnapshot) 
    {
        if (usersnapshot.val().deviceToken != '') {
             $.ajax({
                url: 'home/groupcallnotification',
                type: 'POST',
                data: {
                    deviceToken: usersnapshot.val().deviceToken,from:fromuser, body:channel_name,to:touser,osType:usersnapshot.val().osType,attachimg:message,title:title,attachmentType:'text', userIds:userIds, group_id:group_id
                },
                success: function(data) {
                    console.log(data); 
                }
            });
        }
    });
}

//New Group

    $('#next-parti').on('click', function () {
        $('.parti-group').addClass('show-participant');
        $('.parti-group').removeClass('hash-participant');
        $('.new-group-add').addClass('hash-group');
        $('.new-group-add').removeClass('show-group-add');
    });
    $('#previous-group').on('click', function () {
        $('.parti-group').addClass('hash-participant');
        $('.parti-group').removeClass('show-participant');
        $('.new-group-add').addClass('show-group-add');
        $('.new-group-add').removeClass('hash-group ');
    });

setInterval(function(){
    var from = $('#from_usergroup').val();
    var to = $('#to_usergroup').val();
    showgroupchathistory(from, to)
}, 60000);

//Recorder

let recorder;
let context;
let audio = document.querySelector('audio');
let startBtn = document.getElementById('startRecording');
let stopBtn = document.getElementById('stopRecording');
let send_voice = document.getElementById('send_voice');
window.URL = window.URL || window.webkitURL;

/** 
 * Detecte the correct AudioContext for the browser 
 * */
window.AudioContext = window.AudioContext || window.webkitAudioContext;
navigator.getUserMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

let onFail = function(e) {
    alert('Error '+e);
    console.log('Rejected!', e);
};

let onSuccess = function(s) {
    let tracks = s.getTracks();
    startBtn.setAttribute('disabled', true);
    send_voice.setAttribute('disabled', true);
    stopBtn.removeAttribute('disabled');
    context = new AudioContext();
    let mediaStreamSource = context.createMediaStreamSource(s);
    recorder = new Recorder(mediaStreamSource);
    recorder.record();

    stopBtn.addEventListener('click', ()=>{
        stopBtn.setAttribute('disabled', true);
        startBtn.removeAttribute('disabled');
        send_voice.removeAttribute('disabled');
        recorder.stop();
        tracks.forEach(track => track.stop());
        recorder.exportWAV(function(s) {
            audio.src = window.URL.createObjectURL(s);
            const blobFile = new File([s], 'file' + Date.now() + '.wav', {type:"audio/wav"});
        });
    });

    send_voice.addEventListener('click', ()=>{
        stopBtn.setAttribute('disabled', true);
        startBtn.setAttribute('disabled', true);
        tracks.forEach(track => track.stop());

        recorder.exportWAV(function(s) {
            const blobFile = new File([s], 'file' + Date.now() + '.wav', {type:"audio/wav"});
            voiceupload(blobFile, '');
            $("#record_audio").modal('hide');
            audio.removeAttribute('src');
        });
    });
}

startBtn.addEventListener('click', ()=>{
    navigator.mediaDevices.getUserMedia({audio: true}).then(onSuccess).catch(onFail);
});

function voiceupload(files) {
    var fd = new FormData();
    fd.append('file', files);
    fireBaseImageUpload({
        'file': files,
        'path': '/Dreamchat'
    }, function(data) {
        if (!data.error) {
            if (data.progress) {
                // progress update to view here
            }
            if (data.downloadURL) {
                // update done
                return data.downloadURL;
            }
        } else {
        }
    });
}

function replyMessages(selectedMessage, selectedUser , grpsender_id) {
    var currentuser = $('#current-user-number').val();
    var otherUser = $('#to_user').val();
    $('.reply-msg-div').removeClass("d-none");
    $('.reply-msg-div').addClass("d-flex");
    $('.reply-content').html(selectedMessage);
    $('.send-btn').attr('onclick', 'sendReplyMsgs()');
    /*var senderId = '';
    firebase.database().ref("data/chats/" + selectedUser + '/' + grpchat_id).once('value', function(chatsnapshot) {
        var senderId = chatsnapshot.val().senderId;
        console.log(chatsnapshot.val());return false;
    });*/
    firebase.database().ref("data/contacts/" + currentuser + '/' + grpsender_id).once('value', function(usersnapshot) {
        if(grpsender_id == currentuser) {
           var userName = "You";
           var userImage = baseUrl+'assets/img/user-placeholder.jpg';
        } else {
           var userName = usersnapshot.val().firstName;
           if(usersnapshot.val().image != undefined) {
                var userImage = usersnapshot.val().image;
           } else {
                var userImage = baseUrl+'assets/img/user-placeholder.jpg'; 
           }
        } 
        $('#reply-avatar').attr('src', userImage);
        $('#reply-user-name').text(userName);
    });
}

function sendReplyMsgs(selectedMessage, selectedUser) {
    var from = document.getElementById("from_usergroup").value;
    var to = document.getElementById("to_usergroup").value;
    var combination = from+'-'+to;
    var selectedMessage = $('.reply-content').html();
    var selectedUser = $('#reply-user-name').text();
    var selectedUserImage = $('#reply-avatar').attr('src');
    var message = $("#chat_message").val();
    if(message == "") {
        toastr.warning("Chat Message is Empty");
    }
    var d = new Date();
    var n = d.getTime();
    var blocked = false;
    var readmsg = true;
    var userIds = [];
    var grpExitUserIds = [];
    firebase.database().ref("data/users/" + to).once('value', function(usersnapshot) {
        if (usersnapshot.val()) {
            if (usersnapshot.val().blockedUsersIds) {
                blockids = usersnapshot.val().blockedUsersIds;
                if (jQuery.inArray(from, blockids) !== -1) {
                    blocked = true;
                    readmsg = false;
                }
            }
        }
    });
    firebase.database().ref("data/groups/" + to).once('value', function(usersnapshot) {
        if (usersnapshot.val()) {
            if (usersnapshot.val().userIds) {
                userIds = usersnapshot.val().userIds;
            }
            if (typeof usersnapshot.val().grpExitUserIds !== 'undefined') {
                grpExitUserIds = usersnapshot.val().grpExitUserIds;
            }
        }
    });
    //New Code
    if($.inArray(from, grpExitUserIds) === -1) {
        var available_users = userIds.filter(x => grpExitUserIds.indexOf(x) === -1);
        var myRef = firebase.database().ref("data/chats/" + to).push(); 
        myRef.set({
            "attachmentType": 6,
            "blocked": blocked,
            "body": message,
            "date": n,
            "delete": "",
            "delivered": true,
            "id": myRef.key,
            "readMsg": readmsg,
            "recipientId": to,
            "replyId": "0",
            "selected": false,
            "senderId": from,
            "senderName": from,
            "sent": true,
            "userIds": available_users,
            "isForward": false,
            "isReply": true,
            "replyContent": selectedMessage,
            "replyUser": selectedUser,
            "replyUserImg": selectedUserImage,
            "deliveredTime": "",
            "readTime": ""
        });

        /*var usersRef = firebase.database().ref("data/users/" + from);
        usersRef.once('value', function(usersnapshot) {
            var lastMsgName = '';
            if (attachmentType != 3) {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + message;
            } else {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="bx bx-microphone me-1"></i>Audio';
            }

            if(attachmentType == 2) {
                lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-image ms-1 me-1"></i>Photo';
            }
            var divid = to.replace(/[.*+?^${}()|[\]\\]/g, "");
            $('#lastmsg_' + divid).html(lastMsgName);

            var showtime = secondsToString(n);
            $('#lastmsgtime_' + divid).html(showtime);

        });*/
        
        var myindex = available_users.indexOf(from);
        if (myindex !== -1) {
          available_users.splice(myindex, 1);
        }
        /*if (available_users.length>0) {
            $.each(available_users, function( index, value ) {
                firebase.database().ref("data/users/" + value).once('value', function(usersnapshot1) 
                {
                    if (usersnapshot1.val().deviceToken!='') {
                        $.ajax({
                            url: 'home/usernotification',
                            type: 'POST',
                            data: {
                                deviceToken: usersnapshot1.val().deviceToken,body:message,to:to,osType:usersnapshot1.val().osType,attachimg:message,from:from,attachmentType:'text'
                            },
                            success: function(data) {
                            }
                        });
                    }
                    
                });
            });
        }*/
    }
    //
    var j = 0;
        $('.reply-msg-div').addClass("d-none");
        $('.reply-msg-div').removeClass("d-flex");
        $('.reply-content').html("");
        $('.send-btn').attr('onclick', 'sendGroupMessage()');
        $('#forward-message').modal('hide');
        $('.emoji-wysiwyg-editor').html("");
        return false;
}

function forwardMessages(msgType, message,attachmentBytes,attachmentUrl) {
    $("#forward-message .forward-message-users-list").empty();
    var currentuser = $('#current-user-number').val();
    $("#forward-message").modal('show');

    //Groups List
    firebase.database().ref("data/groups").on("child_added", function(snapshot) {
        var string = snapshot.key;
        var substring = currentuser;
        var userIds = snapshot.val().userIds;
        if (typeof snapshot.val().grpExitUserIds !== undefined && snapshot.val().grpExitUserIds !== '') {
            var grpExitUserIds = snapshot.val().grpExitUserIds;
        } else {
            var grpExitUserIds = [];
        }

        if (typeof userIds !== 'undefined') {
            var usercount = userIds.length;
            if (snapshot.val().image != "" && snapshot.val().image != undefined) {
                var imageval = snapshot.val().image;
            } else {
                var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
            }
            var userdetails = [];
            var divid = string.replace(/[.*+?^${}()|[\]\\]/g, "");
            if ($.inArray(currentuser, userIds) !== -1 && $.inArray(currentuser, grpExitUserIds) === -1) {
                $('<div class="recent-block-group"><div class="user-block-profile"><div class="avatar"><img src="'+ imageval +'" class="rounded-circle" alt="image"></div><div class="block-user-name" ><input type="hidden" name="selectedMessage" id="selectedMessage" value="'+ message +'"><input type="hidden" name="msgType" id="msgType" value="'+ msgType +'"><input type="hidden" name="attachmentBytes" id="attachmentBytes" value="'+ attachmentBytes +'"><input type="hidden" name="attachmentUrl" id="attachmentUrl" value="'+ attachmentUrl +'"><input type="hidden" name="group-user-ids" id="group-user-ids" value="'+ snapshot.val().userIds +'"><h6 class="forward-user-name" id="forward-user-name">'+ snapshot.val().name +'</h6><span>'+ snapshot.val().status +'</span></span></div></div><div class="notify-check mb-0 checkbox-container"><div class="form-check d-flex align-items-center justify-content-start ps-0"><label class="custom-check mt-0 mb-0"><input type="checkbox" name="forward-user-number[]" id="forward-user-number" value="'+ snapshot.val().id +'" class="position-relative"><span class="checkmark"></span></label></div></div></div').appendTo($('.forward-message-users-list'));
            }
        }
    });

    //Contact Users List
    firebase.database().ref("data/contacts/" + currentuser).orderByChild("firstName").once('value', function(snapshot) {
        snapshot.forEach(function(childSnapshot) {
            if(childSnapshot.val().isBlocked == undefined || childSnapshot.val().isBlocked == false) {
                firebase.database().ref("data/users/" + childSnapshot.key).once('value', function(userSnapshot) {
                    if (userSnapshot.val() != null) {
                        var name = childSnapshot.val().firstName+' '+ childSnapshot.val().lastName;
                        if (userSnapshot.val().image != "" && userSnapshot.val().image != undefined) {
                            var imageval = userSnapshot.val().image;
                        } else {
                            var imageval = baseUrl + 'assets/img/user-placeholder.jpg';
                        }

                        $('<div class="recent-block-group"><div class="user-block-profile"><div class="avatar"><img src="'+ imageval +'" class="rounded-circle" alt="image"></div><div class="block-user-name" ><input type="hidden" name="selectedMessage" id="selectedMessage" value="'+ message +'"><input type="hidden" name="msgType" id="msgType" value="'+ msgType +'"><input type="hidden" name="attachmentBytes" id="attachmentBytes" value="'+ attachmentBytes +'"><input type="hidden" name="attachmentUrl" id="attachmentUrl" value="'+ attachmentUrl +'"><input type="hidden" name="group-user-ids" id="group-user-ids" value=""><h6 class="forward-user-name" id="forward-user-name">'+ name +'</h6><span>'+ userSnapshot.val().status +'</span></div></div><div class="notify-check mb-0 checkbox-container"><div class="form-check d-flex align-items-center justify-content-start ps-0"><label class="custom-check mt-0 mb-0"><input type="checkbox" name="forward-user-number[]" id="forward-user-number" value="'+ userSnapshot.val().id +'" class="position-relative"><span class="checkmark"></span></label></div></div></div').appendTo($('.forward-message-users-list'));
                    }
                });
            }
        }); 
    });
}

function sendForwardMessages() {
    var from = $("#current-user-number").val();
    var to =  $('#forward-user-number:checked').val();
    var selectedIDs = [];
    selectedIDs = $('#forward-user-number:checked').map(function() {
        return $(this).val();
    }).get();

    var msgType = $("#msgType").val();
    var attachmentBytes = $("#attachmentBytes").val();
    var attachmentUrl = $("#attachmentUrl").val();
    var attachmentName = $("#selectedMessage").val();

    if(msgType == 6) {
        var message = $("#selectedMessage").val();
    } else {
        var message = "";
    }

    var d = new Date();
    var n = d.getTime();
    var blocked = false;
    var readmsg = false;
    var selectedUserIds = $('#group-user-ids').val();

    selectedIDs.forEach(function(toUser) {
        var toUserNumber = toUser.split('_');
        var combinations = "";

        if(toUserNumber[0] == "group") {
            var combinations = toUser;
            $("#combinationUsers").val(combinations);
        } else {
            var chatRef = firebase.database().ref("data/chats/");
            chatRef.once('value', function(snapshot) {
                var combination1 = toUser + '-' + from;
                var combination2 = from + '-' + toUser;
                if (snapshot.child(combination1).exists() == true) {
                    var combinations = combination1;
                    $("#combinationUsers").val(combination1); 
                } else {
                    if (snapshot.child(combination2).exists() == true) {
                       var combinations = combination2; 
                       $("#combinationUsers").val(combination2); 
                    }
                }
            });
           
        }
        var combination = $("#combinationUsers").val();
        firebase.database().ref("data/users/" + toUser).once('value', function(usersnapshot) {
            if (usersnapshot.val()) {
                if (usersnapshot.val().blockedUsersIds) {
                    blockids = usersnapshot.val().blockedUsersIds;
                    if (jQuery.inArray(from, blockids) !== -1) {
                        toastr.warning("Unblock User to Send Message!");
                        return false;
                        blocked = true;
                        readmsg = false;
                    }
                } else {}
            }

            var existUsers = [];
            var userIds = selectedUserIds.split(',');
            userIds.forEach(function(entry) {
                existUsers.push(entry);
            });
            
            var myRef = firebase.database().ref("data/chats/" + combination).push(); 
            myRef.set({
                
                "attachmentType": msgType,
                "blocked": blocked,
                "body": message,
                "date": n,
                "delete": "",
                "delivered": false,
                "id": myRef.key,
                "readMsg": readmsg,
                "recipientId": to,
                "replyId": "0",
                "selected": false,
                "senderId": from,
                "senderName": from,
                "sent": true,
                "isForward": true,
                "isReply": false,
                "replyContent": "",
                "userIds": selectedUserIds
            });

            var usersRef = firebase.database().ref("data/users/" + from);
            usersRef.once('value', function(usersnapshot) {
                 if (usersnapshot.val().nameToDisplay == undefined || usersnapshot.val().nameToDisplay == undefined) {
                    var username = from;
                } else {
                    var username = usersnapshot.val().nameToDisplay;
                }
                var lastMsgName = '';
                if (msgType != 3) {
                    lastMsgName = username + ':' + message;
                } else {
                    lastMsgName = username + ':' + '<i class="bx bx-microphone me-1"></i>Audio';
                }

                if(msgType == 2) {
                    lastMsgName = username + ':' + '<i class="feather-image ms-1 me-1"></i>Photo';
                }

                if(msgType == 5) {
                    lastMsgName = username + ':' + '<i class="feather-file-text ms-1 me-1"></i>Doc';
                }

                if(msgType == 1) {
                    lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-video ms-1 me-1"></i>Video';
                }

                if(msgType == 9) {
                    lastMsgName = usersnapshot.val().nameToDisplay + ':' + '<i class="feather-link ms-1 me-1"></i>Link';
                }

                var divid = to.replace(/[.*+?^${}()|[\]\\]/g, "");
                $('#lastmsg_' + divid).html(lastMsgName);

                var showtime = secondsToString(n);
                $('#lastmsgtime_' + divid).html(showtime);

            });

            if(msgType != 6) {
                firebase.database().ref("data/chats/" + combination + "/" + myRef.key).update({
                    attachment: {
                        "bytesCount": attachmentBytes,
                        "name": attachmentName,
                        "url": attachmentUrl
                    },
                });
            }
            var check_mute = 0;
            firebase.database().ref("data/users/" + from).once('value', function(usersnapshot) {
                var muteids = usersnapshot.val().mutedUsersIds;
                if (muteids) {
                    if (jQuery.inArray(to, muteids) !== -1) {
                        check_mute = 1;
                    }
                }
            });
            //check muted user
            /*if(toUserNumber[0] == "group") {
                if (check_mute == 0) {
                    firebase.database().ref("data/users/" + toUser).once('value', function(usersnapshot) {
                        if (usersnapshot.val().deviceToken) {
                            $.ajax({
                                url: 'home/usernotification',
                                type: 'POST',
                                data: {
                                    deviceToken: usersnapshot.val().deviceToken,body:message,to:toUser,osType:usersnapshot.val().osType,attachimg:message,from:from,attachmentType:'text'
                                },
                                success: function(data) {
                                }
                            });
                        }
                            
                    });
                }
            }*/
            var j = 0;
            $('#forward-message').modal('hide');
            $('.emoji-wysiwyg-editor').html("");
            return false;
        });
    });
}


$(document).ready(function() {
  // Listen for changes in the file input
  $('.grpattach').change(function() {
    var input = this;

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        // Display the preview image
        $('#imagePreview').css('display', 'block');
        $('#previewImage').attr('src', e.target.result);
      };

      // Read the selected file as a data URL
      reader.readAsDataURL(input.files[0]);
    }
  });
});

function getGroupDetails() {
    var currentUser = $("#current-user-number").val();
    var to = document.getElementById("to_usergroup").value;
    var baseUrl = $("#baseUrl").val();
    firebase.database().ref("data/groups/" + to).once('value', function(snapshot) {
        var name = snapshot.val().name;
        var description = (snapshot.val().status)?snapshot.val().status:'';
        var groupImage = (snapshot.val().image)?snapshot.val().image: baseUrl+'assets/img/user-placeholder.jpg';

        $("#edit-group-title").val(name);
        $("#edit-group-description").text(description);
        $("#current-group-profile-image").attr("src", groupImage);

        $("#edit-group-details").modal('show');
    });
}

// Function to format a date as "Month Day" (e.g., "July 24")
function formatDatelist(date) {
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  return months[date.getMonth()] + " " + date.getDate();
}