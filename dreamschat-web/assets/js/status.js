/*
Author       : Dreamguys
Template Name: Dreamschat - Home
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
    // You may want to delay this stp if you have dynamically created input fields that appear later in the loading process
    // It can be called as many times as necessary; previously converted input fields will not be converted again
    window.emojiPicker.discover();
    var currentuser = $('#current-user-number').val();
	
    firebase.database().ref("data/users/" + currentuser).once('value', function(snapshot) {
        if (snapshot.val().adminblock == true) {
            window.location.href = "logout";
        }
    });
    var d = new Date();
    var n = d.getTime();
    firebase.database().ref('data/users/' + currentuser).update({
        timeStamp: n
    });
    $('#status-reply-msesage , .emoji-wysiwyg-editor').on("keypress", function(e) {
        var to_user = $("#to_user").val();
        firebase.database().ref('data/users/' + currentuser).update({
            typing: to_user
        });
        if (e.keyCode == 13) {
            sendstatusMessage();
            return false; // prevent the button click from happening
        }
    });
    $('#status-reply-msesage , .emoji-wysiwyg-editor').focusout(function() {
        $('#carouselIndicators').carousel('cycle');
    });
    $('#status-reply-msesage , .emoji-wysiwyg-editor').focusin(function() {
        $('#carouselIndicators').carousel('pause');
    });
    $(".user-status-group").hide();
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
        $(".empty-status").hide();
        var i = 0;
        var currentuser = $('#current-user-number').val();
        var d = new Date();
        var n = d.getTime();
        firebase.database().ref('data/users/' + currentuser).update({
            timeStamp: n
        });
        statusofimage(currentuser);
        setInterval(function(){
            statusofimage(currentuser);
        }, 600000);
        function statusofimage(user) {
            //return false;
            //$('<div class="status-message-box text-center"><img src="assets/img/icon/load-status.svg" alt="Icon"><p>Click on a contact to view their status updates</p></div>').appendTo('.status-empty-group');
            $('.user-status-group').hide();
            $('.empty-status').show();

            //$('.status-message-box').hide();
            var i = 0;
            var j = 0;
            firebase.database().ref("data/userstatus/" + user).on("child_added", function(snapshot) {
                firebase.database().ref('data/userstatus/' + user + '/' + snapshot.key).update({
                    id: snapshot.key
                });
                
                $(".user-stories-box").attr("style", "display:block");
                    var activecon = '';
                    var blockflag = 1;
                    var current = new Date();
                    var currenttime = current.getTime();
                    var followingDay = snapshot.val().date + 86400000;
                    //console.log(snapshot.val().attachment);
                    if(snapshot.val().attachment != undefined) {
                        //console.log('iffff');
                        var imageStatus = snapshot.val().attachment.urlList;
                    } else {
                        //console.log('else');
                        var imageStatus = snapshot.val().attachment;
                    }
                    /*var statusImage = snapshot.val().attachment.urlList[0];
                    var status = statusImage.url;*/
                     //console.log(imageStatus);
                    //console.log(snapshot.val().attachment.urlList);
                    

                    if (currenttime < followingDay) {
                        if (i == 0) {
                            if (user == currentuser) {
                                $(".user-stories-box").hide();
                                $("ol li.carouselIndicators").remove();
                                $(".carousel-item").remove();
                                var currentUserName = $('#current-username').val();
                                $('#status-user-name').text(currentUserName);
                                $('#status-caption').text(snapshot.val().caption);
                                
                                if(imageStatus) {
                                    var data = imageStatus.pop();
                                } else {
                                    var data = '';
                                }
                                var statusTime = secondsToString(data.uploadTime);
                                $("#status-time").text(statusTime);
                                
                                $('ul li.status-list-item:first-child').remove();
                                $('<li class="user-list-item status-list-item"><a href="#" class="status-active" onclick="showstatusofimage(\'' + user + '\', \'me\')"><div class="avatar avatar-online"><img src="' + data.url + '" id="status-avatar" class="rounded-circle" alt="image"></div><div class="users-list-body"><div><h5 id="status-user-name">My Status</h5><p id="status-user-info">' + statusTime + '</p></div></div></a><div class="list-inline-item"><a class="btn btn-outline-light no-bg" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu dropdown-menu-end contact-menus" ><a href="#" class="dropdown-item" onclick="deleteuserstatus(\'' + snapshot.key  + '\')"><span><i class="bx bx-trash"></i></span>Delete</a></div></div></li>').prependTo($('.current-user-list'));
                            } else {
                                $('#recent-updates').empty();
                                $('<div class="fav-title pin-chat"><h6>Recent Updates</h6></div>').appendTo('#recent-updates');
                                if(imageStatus) {
                                    var data = imageStatus.pop();
                                } else {
                                    var data = '';
                                }
                                firebase.database().ref("data/chats").on("child_added", function(chatsnapshot) {
                                    var string = chatsnapshot.key;
                                    var substring = currentuser.slice(1);
                                    var substring1 = "roup";
                                    if (string.indexOf(substring) !== -1 && string.indexOf(substring1) !== 1) {
                                        var touser = string.replace(currentuser, '').replace('-', '');
                                        if (touser == user) {
                                            firebase.database().ref("data/users/" + currentuser).once('value', function(usersnapshot) {
                                                var userImage = (usersnapshot.val().image)?usersnapshot.val().image:baseUrl+'assets/img/user-placeholder.jpg';
                                                if (usersnapshot.val()) {
                                                    if (usersnapshot.val().blockedUsersIds) {
                                                        var blockids = usersnapshot.val().blockedUsersIds;
                                                        firebase.database().ref("data/users/" + user).once('value', function(statussnapshot) {
                                                        var status_username=''; 
                                                        if (statussnapshot.val().nameToDisplay == null || statussnapshot.val().nameToDisplay == undefined || statussnapshot.val().nameToDisplay == '') 
                                                            {
                                                                status_username = user;
                                                            }
                                                            else {
                                                                status_username = statussnapshot.val().nameToDisplay;
                                                            }

                                                        if (blockids) {
                                                            if ($.inArray(user, blockids) === -1) {
                                                                // Your code to append when user is not in the blockids array
                                                        $('<li class="list-group-item"><a class="first_list" href="#" onclick="showstatusofimage(\'' + user + '\', \'others\')"><div><div class="avatar status-active"><img src="' + userImage + '" class="rounded-circle" alt="image"></div></div><div class="users-list-body mt-2"><div><h5>' + status_username + '</h5><p class="text-muted">' + secondsToString(data.uploadTime) + '</p></div></div></a></li>').appendTo($('.recent-user-status'));    
                                                    }

                                                        }
                                                        })
                                                    } else {
                                                        var status_username=''; 
                                                        firebase.database().ref("data/users/" + user).once('value', function(statussnapshot) {
                                                            if (statussnapshot.val().nameToDisplay == null || statussnapshot.val().nameToDisplay == undefined || statussnapshot.val().nameToDisplay == '') 
                                                            {
                                                                status_username = user;
                                                            }
                                                            else {
                                                                status_username = statussnapshot.val().nameToDisplay;
                                                            }

                                                            var userImage = (usersnapshot.val().image)?usersnapshot.val().image:baseUrl+'assets/img/user-placeholder.jpg';

                                                        $('<li class="user-list-item status-list-item"><a href="#" onclick="showstatusofimage(\'' + user + '\', \'others\')"><div class="avatar"><img src="' + userImage + '" class="rounded-circle" alt="image"></div><div class="users-list-body"><div><h5 id="status-user-name">'+ status_username +'</h5><p id="status-user-info">' + secondsToString(data.uploadTime) + '</p></div></div></a></li>').appendTo($('.recent-user-status'));
                                                        })
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });
                            }
                        }
                        i++;   
                    } else {
                        //alert();
                        firebase.database().ref('data/userstatus/' + user + '/' + snapshot.key).remove();
                    }
                    j++;
            });
            
        }

        firebase.database().ref("data/chats").on("child_added", function(snapshot) {
            var string = snapshot.key;
            var substring = currentuser.slice(1);
            if (string.indexOf(substring) !== -1) {
                var touser = string.replace(currentuser, '').replace('-', '');
                var usersRef = firebase.database().ref("data/users/");
                usersRef.once('value', function(snapshot) {
                    if (snapshot.child(touser).exists() == true) {
                        statusofimage(touser);
                    }
                });
            }
        });
        $("#search-contact").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#user-list li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
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
    }

    var hr = 0;
    var min = 0;
    var sec = 0;
    var cycle = '';
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
    function pad(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }

    function secondsToString(millis) {
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
    //file attachment 
    var obj = $("#drop-zone-status");
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
            toastr.success("Status Added Successfully!");
        } else {
            toastr.warning("Select Only Images!");
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
    $('#drop-zone-file-status').on('change', function(e) {
        var files = $('#drop-zone-file-status')[0].files;
        console.log(files); return false;
        var valflag = validateFile(files);
        if (valflag) {
            handleFileUpload(files, obj);
            toastr.success("Status Added Successfully!");
        } else {
            toastr.warning("Select Only Images!");
        }
    });
    $('#send-status').on('click', function(e) {
        var files = $('#user-status')[0].files;
        //var files = $('#status-image')[0].files;
        //console.log(files); return false;
        var valflag = validateFile(files);
        if (valflag) {
            handleFileUpload(files, obj, 'send');
            toastr.success("Status Added Successfully!");
        } else {
            toastr.warning("Select Only Images!");
        }
    });

    // automatically submit the form on file select
    $('#send-attachement').on('click', function(e) {
        var files = $('#reply-attachment')[0].files;

        var valflag = validateFile(files);
        if (valflag) {
            handleFileUpload(files, obj, 'reply');
        } else {
            toastr.warning("Attach Only Images/Audios/Videos/documents!");
        }
    });

    function validateFile(files) {
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

    function handleFileUpload(files, obj, type) {
        for (var i = 0; i < files.length; i++) {
            var fd = new FormData();
            fd.append('file', files[i]);
            fireBaseImageUpload({
                'file': files[i],
                'path': '/Dreamchat',
                'type': type
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

    function fireBaseImageUpload(parameters, callBackData) {
        // expected parameters to start storage upload
        var file = parameters.file;
        var path = parameters.path;
        var name;
        var statusType = parameters.type;
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
            if (checktypeflag != 'other') {
                if(statusType == 'send') {
                    sendAttacheMessage(checktypeflag, downloadURL, n, fileSize);
                } else {
                    sendAttachmentStatusMessage(checktypeflag, downloadURL, n, fileSize);
                }
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

    function sendAttacheMessage(checktypeflag, downloadURL, name, fileSize) {
        //alert(); return false;
        var from = $('#current-user-number').val();
       // var caption = $('#status-caption').val();
        var caption = document.getElementById("status-captions").value;
        //var caption = document.getElementById("status-caption").value;
        var d = new Date();
        var n = d.getTime();
        var userurllist = {};
        userurllist['expiry'] = true;
        userurllist['uploadTime'] = n;
        userurllist['url'] = downloadURL;
        userurllist['caption'] = caption;
        userurllist['views'] = 0;
        userurllist['viewerId'] = "";
        var finalurllist = [];
        var mute_ids = [];
        finalurllist.push(userurllist);
        firebase.database().ref("data/userstatus/" + from).once('value', function(snapshot) {
            var statusKey = snapshot.val();
            if(snapshot.val() != null) {
                snapshot.forEach(function(childSnapshot) {
                    var childKey = childSnapshot.key;
                    var attachments = childSnapshot.val().attachment.urlList;
                    if(attachments) {
                        mute_ids = attachments;
                    }
                    mute_ids.push(userurllist);
                    firebase.database().ref('data/userstatus/' + from + '/' + childKey + '/attachment/').update({
                        urlList : mute_ids
                    });
                });
            } else {
                firebase.database().ref("data/userstatus/" + from).push().set({
                    "attachment": {
                        "bytesCount": fileSize,
                        "name": name,
                        "urlList": finalurllist,
                        "views": 0,
                        "viewerId": ""
                    },
                    "attachmentType": checktypeflag,
                    "date": n,
                    "delivered": true,
                    "id": "",
                    "selected": false,
                    "senderId": from,
                    "senderName": from,
                    "sent": true,
                    "caption": caption
                });
            }
        });
        /**/
        $('#user-status').val('');
        $('#status-caption').val('');
        $('#upload-file-image').modal('hide');  
        return false;
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
            'path': '/Dreamchat',
            'type': 'reply'
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

})(jQuery);

"use strict";

function showstatusofimage(user, type) {
    $('.user-status-group').show();
    $('.status-message-box').hide();
    if(type == 'me') {
        $('.status-chat-footer').hide();
    }
    var i = 0;
    var currentuser = $('#current-user-number').val();
    var main_div_status = user.replace('+', '');
    $("#image_statusol").html('');
    $("#image_statusli").html('');
    var chatRef = firebase.database().ref("data/chats/");
    chatRef.once('value', function(snapshot) {
        var combination1 = user + '-' + currentuser;
        var combination2 = currentuser + '-' + user;
        if (snapshot.child(combination1).exists() == true) {
            $("#from_user").val(currentuser);
            $("#to_user").val(user);
            $("#combination_user").val(combination1);
        } else {
            if (snapshot.child(combination2).exists() == true) {
                $("#from_user").val(currentuser);
                $("#to_user").val(user);
                $("#combination_user").val(combination2);
            }
        }
    });
    $("#image_statusol").attr('class', '');
    $("#image_statusol").addClass("carousel-indicators mainstatus_" + main_div_status);
    $("#image_statusli").attr('class', '');
    $("#image_statusli").addClass("carousel-inner status_slider mainshowstatus_" + main_div_status);
    if (user == currentuser) {
        $(".bottom-message-col").hide();
    } else {
        $(".bottom-message-col").show();
    }
    firebase.database().ref("data/userstatus/" + user).on("child_added", function(snapshot) {
        var attachList = snapshot.val().attachment.urlList;
        var existsViewerIds = [];

        $.each(attachList, function (key, value) {
            if(type != 'me') {
                //$('#selected-status-user-name').html('Karthik');
                //$('#status-time').text('14 Oct 2023');
                existsViewerIds = (value.viewerId)?value.viewerId:[];
                var viewCount = value.views;
                //var currentusers = "+919876543210";
                if (jQuery.inArray(currentuser, existsViewerIds) == -1) {
                    existsViewerIds.push(currentuser);
                    viewCount++;
                    firebase.database().ref('data/userstatus/' + user + '/' + snapshot.key + '/attachment/urlList/'+ key).update({
                        views: viewCount,
                        viewerId: existsViewerIds
                    });
                }
            } else {
                $('#status-caption').text(value.caption);
                $('.views-counts').html('<i class="feather-eye" id="views-count">'+ value.views +'</i>');
            }
            var activecon = '';
            if (i == 0) {
                activecon = 'active';
            }
            $('<li data-bs-target="#carouselIndicators" data-bs-slide-to="' + i + '" class="' + activecon + '"></li>').appendTo($('.mainstatus_' + main_div_status));
            $('<div class="carousel-item ' + activecon + '"><img src="' + value.url + '" alt="Image"></div>').appendTo($('.mainshowstatus_' + main_div_status));
            i++;
        });
    });
    $(".user-stories-box").attr("style", "display:block");
}

function sendAttachmentStatusMessage(checktypeflag, downloadURL, name, fileSize) {
    var from = $("#from_user").val();
    var to = $("#to_user").val();
    var combination = $("#combination_user").val();

    var d = new Date();
    var n = d.getTime();
    var blocked = false;
    var readmsg = false;
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

    var statusUrl = $("#image_statusli .active img").attr('src');
    var newRef = firebase.database().ref("data/chats/" + combination).push().set({
        "attachment": {
            "bytesCount": fileSize,
            "name": name,
            "url": downloadURL
        },
        "attachmentType": checktypeflag,
        "blocked": blocked,
        "body": "",
        "date": n,
        "delete": "",
        "delivered": true,
        "id": "",
        "readMsg": readmsg,
        "statusUrl": statusUrl,
        "recipientId": to,
        "replyId": "0",
        "selected": false,
        "senderId": from,
        "senderName": from,
        "sent": true
    });
    $('#status-reply-msesage').val("");
    $('.emoji-wysiwyg-editor').html("");
    toastr.success("Status Reply Sent Successfully!");
    $("#drag_files").modal('hide');
    return false;
}

function sendstatusMessage() {
    var message = $("#status-reply-msesage").val();

    if (message == '') {
        toastr.warning("Type Message...!");
        return false;
    }
    var from = $("#from_user").val();
    var to = $("#to_user").val();
    var combination = $("#combination_user").val();

    var d = new Date();
    var n = d.getTime();
    var blocked = false;
    var readmsg = false;
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
    var statusUrl = $("#image_statusli .active img").attr('src');
    var newRef = firebase.database().ref("data/chats/" + combination).push().set({
        "attachmentType": 6,
        "blocked": blocked,
        "body": message,
        "date": n,
        "delete": "",
        "delivered": true,
        "id": "",
        "readMsg": readmsg,
        "statusUrl": statusUrl,
        "recipientId": to,
        "replyId": "0",
        "selected": false,
        "senderId": from,
        "senderName": from,
        "sent": true
    });
    $('#status-reply-msesage').val("");
    $('.emoji-wysiwyg-editor').html("");
    toastr.success("Status Reply Sent Successfully!");
    return false;
}

//To delete the user status
function deleteuserstatus(status_id) {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure want to delete this status?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var currentuser = $('#current-user-number').val();
            firebase.database().ref("data/userstatus/" + currentuser).on("child_added", function(snapshot) {
                var list = snapshot.val().attachment.urlList;
                list.pop();

                if(list == '') {
                    var adaRef = firebase.database().ref('data/userstatus/'+currentuser+'/'+status_id);
                    adaRef.remove();
                } else {
                    firebase.database().ref('data/userstatus/' + currentuser + '/' + status_id + '/attachment/').update({
                        urlList : list
                    });
                }
            });
            toastr.success("Status Deleted Successfully!");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        }
    });
}

//To delete all status
function deleteuserstatus1(status_id) {
    var currentuser = $('#current-user-number').val();
    var adaRef = firebase.database().ref('data/userstatus/'+currentuser+'/'+status_id);
    adaRef.remove();
    window.location.reload();
}

//$('#user-status').change(function() {
/*$('#upload-status-image').click(function() {
    //var imgSrc = $(".dz-image img").attr("src");

    var file = $("#user-status")[0].files;
    if (file) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(e) {
            $("#status-images").data("src-value", file);
            //$("#status-images").click();
            $("#uplaod-new-status-image").attr("src", file);
            $('#upload-file').modal('hide');
            $('#upload-file-image').modal('show');
            //console.log(e.target.result);
           //previewImage.src = e.target.result;
        }
    }
});*/

$('#user-status').change(function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(e) {
            //$("#previewImage").attr("src", e.target.result);
            $("#uplaod-new-status-image").attr("src", e.target.result);
            $('#upload-file').modal('hide');
            $('#upload-file-image').modal('show');
            //console.log(e.target.result);
           //previewImage.src = e.target.result;
        }
    }
});

function statusViewedUsers() {
    $('.status-viewed-user-list').empty();
    $('.recent-view-text').hide();
    $('#view-user-status').modal('show');
    var currentuser = $('#current-user-number').val();
    firebase.database().ref("data/userstatus/" + currentuser).on("child_added", function(snapshot) {
        var statusDetails = snapshot.val().attachment.urlList;
        statusDetails.forEach(function(attachments) {
            var files = attachments.viewerId;
            console.log(files);
            if(files) {
                $('.recent-view-text').show();
                files.forEach(function(users) {
                    var usersRef = firebase.database().ref("data/users/" + users);
                    usersRef.once('value', function(usersnapshot) {
                    var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';
                    if (usersnapshot.val() != null) {
                        if (usersnapshot.val().image != undefined) {
                            imagevalusr = usersnapshot.val().image;
                        }
                        if (usersnapshot.val().firstName != undefined && usersnapshot.val().lastName != undefined) {
                            var userName = usersnapshot.val().firstName +' '+usersnapshot.val().lastName;
                        } else {
                            var userName = users;
                        }
                        if (usersnapshot.val().status != undefined) {
                            var status = usersnapshot.val().status;
                        } else {
                            var status = 'Hey!! I am Available Now!!';
                        }
                        
                    }
                    $('<div class="recent-block-group"><div class="user-block-profile"><div class="avatar"><img src="'+ imagevalusr +'" class="rounded-circle" alt="image"></div><div class="block-user-name"><h6>'+ userName +'</h6><span>'+ status +'</span></div></div></div>').appendTo('.status-viewed-user-list');
                });
            });    
        } else {
            $('.status-viewed-user-list').empty();
            $('<div class="recent-block-group">No Views Yet</div>').appendTo('.status-viewed-user-list');
        }   
            
        });
                       
    });
    //
}

