"use strict";
window.onload = function() {
    var ref = firebase.database().ref("data/report");
    //Language List
    ref.orderByChild("timeStamp").limitToLast(100).on("child_added", function(snapshot) {
        var reportkey = snapshot.key;
        //check user is blocked
        var adminblock = 'no';
        firebase.database().ref("data/users/"+snapshot.val().reportUser).once('value', function(usershot) {
            if (usershot.val()) {
                console.log(snapshot.val());

                 if (usershot.val().adminblock != undefined && usershot.val().adminblock == true) {
                   $('<tr><td>' + snapshot.val().reportBy + '</td><td><b>'+ snapshot.val().reportUser +'</b></td><td class="text-center">' + secondsToString(snapshot.val().timeStamp) + '</td><td><button type="button" class="btn btn-info btn-sm" onclick="viewmessage(\'' + snapshot.val().chatPath + '\',\'' + snapshot.val().messageId + '\');">View Message</button></td><td>Blocked</td></tr>').prependTo('.report-list');
                }
                else {
                    var admin_id = $('#admin_id').val();
                    if (admin_id == 'admin') {
                        $('<tr><td>' + snapshot.val().reportBy + '</td><td><b>'+ snapshot.val().reportUser +'</b></td><td class="text-center">' + secondsToString(snapshot.val().timeStamp) + '</td><td><button type="button" class="btn btn-info btn-sm" onclick="viewmessage(\'' + snapshot.val().chatPath + '\',\'' + snapshot.val().messageId + '\');">View Message</button></td><td><a onclick="checkblockuser(\'' + snapshot.val().reportUser + '\')" href="#" class="btn btn-sm bg-warning-light" >Block</a></td></tr>').prependTo('.report-list');
                    } else {
                        $('<tr><td>' + snapshot.val().reportBy + '</td><td><b>'+ snapshot.val().reportUser +'</b></td><td>' + secondsToString(snapshot.val().timeStamp) + '</td><td><button type="button" class="btn btn-info btn-sm" onclick="viewmessage(\'' + snapshot.val().chatPath + '\',\'' + snapshot.val().messageId + '\');">View Message</button></td><td><a  href="#" class="btn btn-sm bg-warning-light" >Block</a></td></tr>').prependTo('.report-list');
                    }
                }
            }
           
        });
        
    });
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
}

function viewmessage(chatPath, messageId) {
    //get message
    var msgref = firebase.database().ref("data/chats/"+chatPath+"/"+messageId);
    msgref.once("value", function(snapshot) {
        var message = '';
        if (snapshot.val().attachment != undefined) {
            var attachment = snapshot.val().attachment;
            if (snapshot.val().attachmentType == 1) { //Video
                message = '<video width="100%" height="300" controls><source src="'+attachment.url+'" type="video/mp4"><source src="'+attachment.url+'" type="video/ogg">Your browser does not support the video tag.</video>';
            }
            else if (snapshot.val().attachmentType == 2) { //image
                message = '<img width="100%" height="300" src="'+attachment.url+'" />';
            }
            else if (snapshot.val().attachmentType == 3) { //Audio
                message = '<audio width="100%" height="300" controls><source src="'+attachment.url+'" type="audio/mpeg"><source src="'+attachment.url+'" type="audio/ogg">Your browser does not support the audio element.</audio>';
            }
            else if (snapshot.val().attachmentType == 5) { //Document
                message = '<a target="_blank" href="'+attachment.url+'" download>Document</a>';
            }
            else {
                message = '<a target="_blank" href="'+attachment.url+'">Open the Link</a>';
            }
        }
        else {
            message = snapshot.val().body;
        }
        $("#modal-vmsg").modal('show');
        $(".message_content").html(message);
    });
}

function checkblockuser(username) 
{
    $("#modal-confirm").modal('show');
    var ref = firebase.database().ref("data/users/"+username);
    ref.once("value", function(snapshot) {
        if (snapshot.val().adminblock != undefined && snapshot.val().adminblock == true) {
            $("#msg").text("User already blocked");
            $("#blk_btn").css("display", "none");
            $("#block_user_id").val('');
        }
        else {
            $("#msg").text("Are you sure want to block?");
            $("#block_user_id").val(username);
            $("#blk_btn").css("display", "block");
        }
    });
}

function blockuser() {
    var user_id = $("#block_user_id").val();
    firebase.database().ref('data/users/' + user_id).update({
        adminblock: true
    });
    toastr.success("User Blocked Successfully!");
    setTimeout(function() {
      window.location.reload();
    }, 2000); // Adjust the delay as needed
}
