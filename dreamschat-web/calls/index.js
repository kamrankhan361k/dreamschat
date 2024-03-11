// create Agora client
var client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

var call_type = $("#call_type").val();
var receiver = $("#receiver").val();
var currentuser = $("#current_user").val();

//alert(currentuser);

if (receiver!='') {
    starttimer();//stoptimer();
}
if(call_type == 'audio') {
    var localTracks = {
      //videoTrack: null,
      audioTrack: null
    };  
} else {
    var localTracks = {
      videoTrack: null,
      audioTrack: null
    };
}

var remoteUsers = {};
// Agora client options
var options = {
  appid: null,
  channel: null,
  uid: null,
  token: null
};

// the demo can auto join channel with params in url
$(() => {
  var urlParams = new URL(location.href).searchParams;
  options.appid = urlParams.get("appid");
  options.channel = urlParams.get("channel");
  options.token = urlParams.get("token");
  options.group_name = urlParams.get("group_name");
  options.receiver = urlParams.get("receiver");

  $("#current_user_name").text(options.group_name);
  if (options.appid && options.channel) {
    
    $("#appid").val(options.appid);
    $("#token").val(options.token);
    $("#channel").val(options.channel);
    $("#receiver").val(options.receiver);
    $("#join-form").submit();
  }
    var receiverNumber = '+'+urlParams.get("receiver").trim();
    var callerNumber = '+'+urlParams.get("caller").trim();
    var currentusernum = $("#current-user-number").val();
    var user_call_type = urlParams.get("user_type");

    if (user_call_type == 'group' && call_type == 'audio') {
      var caller_ids = urlParams.get("callerids");
      const numberArray = caller_ids.split(', ');

      numberArray.forEach(function(toUser) {
      var callerNumber = '+'+toUser.trim();

        firebase.database().ref("data/users/" + callerNumber).once('value', function(usersnapshot) {
            var imagevalusr = baseUrl + 'assets/img/user-placeholder.jpg';
                if (usersnapshot.val() != null) {
                    if (usersnapshot.val().image != "") {
                        imagevalusr = usersnapshot.val().image;
                    }
                }
            $('<div class="join-video user-active single-user grid-join"><img src="'+imagevalusr+'" class="img-fluid" alt="Logo"><div class="part-name"><h4><i class="feather-user me-1"></i>'+usersnapshot.val().firstName+'</h4></div><div class="more-icon"> <a href="#" class="handraise-on"><i class="fas fa-hand-paper"></i></a><a href="#" class="mic-off"><i class="feather-mic-off"></i></a></div></div>').appendTo($('#group-call-users'));
        });
      });
    }

    if (user_call_type == 'onetoone') {
        if(callerNumber == currentusernum) {

          firebase.database().ref("data/users/" + receiverNumber).once('value', function(usersnapshot) {
            if (usersnapshot.val().firstName != undefined || usersnapshot.val().firstName != null) {
                var name = usersnapshot.val().firstName;
            } else {
                var name = '';
            }
            $("#receuserName").text(name);
            $("#userName").text(name);
            if (usersnapshot.val().image != '' && usersnapshot.val().image != undefined) {
                $("#rece-user-image").html('<img alt="User Image" src="'+usersnapshot.val().image+'" class="rounded-circle">');
                $("#videouserImg").html('<img alt="User Image" src="'+usersnapshot.val().image+'" class="rounded-circle">');
            } else {
                $("#rece-user-image").html('<img alt="User Image" src="assets/img/avatar/avatar-2.jpg" class="rounded-circle">');
                $("#videouserImg").html('<img alt="User Image" src="assets/img/avatar/avatar-2.jpg" class="rounded-circle">');
            }
          });
          
          firebase.database().ref("data/users/" + callerNumber).once('value', function(usersnapshot) {
            if (usersnapshot.val().firstName != undefined || usersnapshot.val().firstName != null) {
                var name = usersnapshot.val().firstName;
            } else {
                var name = '';
            }
            $("#callerUerName").text(name);
            $("#mobileNumber").text(usersnapshot.val().id);
            if (usersnapshot.val().image != '' && usersnapshot.val().image != undefined) {
                $("#caller-user-image").html('<img alt="User Image" src="'+usersnapshot.val().image+'" class="rounded-circle">');
            } else {
                $("#caller-user-image").html('<img alt="User Image" src="assets/img/avatar/avatar-2.jpg" class="rounded-circle">');
            }
          });
      } else {
        firebase.database().ref("data/users/" + receiverNumber).once('value', function(usersnapshot) {
            if (usersnapshot.val().firstName != undefined || usersnapshot.val().firstName != null) {
                var name = usersnapshot.val().firstName;
            } else {
                var name = '';
            }
            $("#callerUerName").text(name);
            if (usersnapshot.val().image != '' && usersnapshot.val().image != undefined) {
                $("#caller-user-image").html('<img alt="User Image" src="'+usersnapshot.val().image+'" class="rounded-circle">');
            } else {
                $("#caller-user-image").html('<img alt="User Image" src="assets/img/avatar/avatar-2.jpg" class="rounded-circle">');
            }
          });
          
          firebase.database().ref("data/users/" + callerNumber).once('value', function(usersnapshot) {
            $("#receuserName").text(name);
            $("#userName").text(name);
            $("#mobileNumber").text(usersnapshot.val().id);
            if (usersnapshot.val().image != '' && usersnapshot.val().image != undefined) {
                $("#rece-user-image").html('<img alt="User Image" src="'+usersnapshot.val().image+'" class="rounded-circle">');
                $("#videouserImg").html('<img alt="User Image" src="'+usersnapshot.val().image+'" class="rounded-circle">');
            } else {
                $("#rece-user-image").html('<img alt="User Image" src="assets/img/avatar/avatar-2.jpg" class="rounded-circle">');
                $("#videouserImg").html('<img alt="User Image" src="assets/img/avatar/avatar-2.jpg" class="rounded-circle">');
            }
          });
      }
  }
})

$("#join-form").submit(async function (e) {
  e.preventDefault();
  $("#join").attr("disabled", true);
  try {
    options.appid = $("#appid").val();
    options.token = $("#token").val();
    options.channel = $("#channel").val();
    await join();
    if(options.token) {
      $("#success-alert-with-token").css("display", "block");
    } else {
      $("#success-alert a").attr("href", `index.html?appid=${options.appid}&channel=${options.channel}&token=${options.token}`);
      $("#success-alert").css("display", "block");
    }
  } catch (error) {
    console.error(error);
  } finally {
    $("#leave").attr("disabled", false);
  }
})

$("#leave").click(function (e) {
  leave();
})

async function join() {
  // add event listener to play remote tracks when remote user publishs.
  client.on("user-published", handleUserPublished);
  client.on("user-unpublished", handleUserUnpublished);
  cycle = setInterval(timerCycle, 1000);
    if(call_type == 'audio') {
        // join a channel and create local tracks, we can use Promise.all to run them concurrently
        [ options.uid, localTracks.audioTrack] = await Promise.all([
        // join the channel
        client.join(options.appid, options.channel, options.token || null),
        // create local tracks, using microphone and camera
        AgoraRTC.createMicrophoneAudioTrack()
        //AgoraRTC.createCameraVideoTrack()
        ]);
    } else {
        // join a channel and create local tracks, we can use Promise.all to run them concurrently
        [ options.uid, localTracks.audioTrack, localTracks.videoTrack] = await Promise.all([
        // join the channel
        client.join(options.appid, options.channel, options.token || null),
        // create local tracks, using microphone and camera
        AgoraRTC.createMicrophoneAudioTrack(),
        AgoraRTC.createCameraVideoTrack()
        ]);
    }
  
    if(call_type == 'video') {
      // play local video track
      const localplayer = $(`
        <div id="player-wrapper-${options.uid}">
        <div id="player-${options.uid}" class="player"></div>
      </div>`);
      $(".loc-call").append(localplayer);
        localTracks.videoTrack.play(`player-${options.uid}`);
      //localTracks.videoTrack.play(".loc-call");
      $("#local-player-name").text(`localVideo(${options.uid})`);
    }
  // publish local tracks to channel
  await client.publish(Object.values(localTracks));
  console.log("publish success");
}

async function leave() {
  for (trackName in localTracks) {

    var track = localTracks[trackName];
    if(track) {
        var d = new Date();
        var n = d.getTime();
        var from = $("#caller").val();
        var to = $("#receiver").val();
        var duration = $("#total_time").val();
        var call_type = $("#call_type").val();
        var cid = $("#cid").val();
        var currentuser = $("#current-user-number").val().trim();
        //alert('drr--'+from);
        //alert('too-- '+to); return false;
        var user1 = to.trim();

        var endCallUser = '+'+user1;
        //var currentuser = '+'+currentuser1;
    firebase.database().ref('data/users/' + currentuser).update({incomingcall:'', call_status:true, groupcallusers: ''});
    //update duration
    firebase.database().ref('data/calls/'+currentuser+'/'+cid).update({duration:duration});
    if (endCallUser!='' && endCallUser != '+') {
        firebase.database().ref('data/users/' + endCallUser).update({incomingcall:'', call_status:true});
    } 
      track.stop();
      track.close();
      localTracks[trackName] = undefined;
      window.top.close();
    }
  }

  // remove remote users and player views
  remoteUsers = {};
  $(".vid-call").html("");

  // leave the channel
  await client.leave();

  $("#local-player-name").text("");
  $("#join").attr("disabled", false);
  $("#leave").attr("disabled", true);
  console.log("client leaves channel success");
}

async function subscribe(user, mediaType) {
  const uid = user.uid;
  // subscribe to a remote user
  await client.subscribe(user, mediaType);
  console.log("subscribe success");
  //if (mediaType === 'video') {
  if(call_type == 'video') {
    //console.log('id-- '+${uid});
    const player = $(`
      <div id="player-wrapper-${uid}">
        <p class="player-name">remoteUser(${uid})</p>
        <div id="player-${uid}" class="player"></div>
      </div>
    `);
    $(".vid-call").append(player);
    user.videoTrack.play(`player-${uid}`);
  }
  if (mediaType === 'audio') {
    user.audioTrack.play();
    console.log('sec-- '+localStorage.getItem('sec')); 
  }
}

function handleUserPublished(user, mediaType) {
  const id = user.uid;
  remoteUsers[id] = user;
  subscribe(user, mediaType);
}

function handleUserUnpublished(user) {
  const id = user.uid;
  delete remoteUsers[id];
  $(`#player-wrapper-${id}`).remove();
}

if (localStorage.getItem('sec') != null) {
    var sec = localStorage.getItem('sec');
    var min = localStorage.getItem('min');
    var hr = localStorage.getItem('hr');
    if (receiver!='') {
        timerCycle();
    }
}
else {
    var hr = 0;
    var min = 0;
    var sec = 0;
}

var cycle = '';
function groupstarttimer() {
    //alert(receiver);
    if (receiver=='') {
        var total_time = document.getElementById("total_time");
        alert(total_time);
        if (total_time) {
            total_time.value = "";
        }
        timerCycle();
    }
}
function starttimer() {
    if (receiver!='') {
        var total_time = document.getElementById("total_time");
        if (total_time) {
            total_time.value = "";
        }
        timerCycle();
    } else {
        leave();
    }
}

/*if (receiver!='') {
    //checking call declined and ended
    firebase.database().ref("data/users/"+receiver).on("child_changed", function(snapshot) 
    {
        if (snapshot.key == 'call_status' && snapshot.val()==false) 
        {
            firebase.database().ref('data/users/' + receiver).update({incomingcall:'', call_status:true});
            document.querySelector('.exitBtn').click();
        }
        //call ended
        if (snapshot.key == 'incomingcall' && snapshot.val()=='') {
            firebase.database().ref('data/users/' + receiver).update({incomingcall:'', call_status:true});
            document.querySelector('.exitBtn').click();
        }
    });
}*/

// Initialise UI controls
enableUiControls();

// Action buttons
function enableUiControls() {
    $("#mic-btn-mute").click(function () {
        $('#mic-btn-unmute').css('display','block');
        $('#mic-btn-mute').css('display','none');
        localTracks.audioTrack.setEnabled(false);
        console.log("Audio Muted.");
        //alert(); return false;
        //toggleMic();
    });

    $("#mic-btn-unmute").click(function () {
        $('#mic-btn-mute').css('display','block');
        $('#mic-btn-unmute').css('display','none');
        localTracks.audioTrack.setEnabled(true);
        console.log("Audio Unmuted.");
        //toggleMic();
    });

    $("#video-btn-mute").click(function () {
        $('#video-btn-unmute').css('display','block');
        $('#video-btn-mute').css('display','none');
        localTracks.videoTrack.setEnabled(false);
        console.log("Video Muted.");
        //alert(); return false;
        //toggleMic();
    });

    $("#video-btn-unmute").click(function () {
        $('#video-btn-mute').css('display','block');
        $('#video-btn-unmute').css('display','none');
        localTracks.videoTrack.setEnabled(true);
        console.log("Video Unmuted.");
        //toggleMic();
    });

    /*$("#video-btn").click(function () {
        toggleVideo();
    });*/
}

// Toggle Mic
function toggleMic() {
    if ($("#mic-icon").hasClass('fa-microphone')) {
        localTracks.audioTrack.setEnabled(false);
        console.log("Audio Muted.");
    } else {
        localTracks.audioTrack.setEnabled(true);
        console.log("Audio Unmuted.");
    }
    $("#mic-icon").toggleClass('fa-microphone').toggleClass('fa-microphone-slash');
}

// Toggle Video
function toggleVideo() {
    if ($("#video-icon").hasClass('fa-video')) {
        localTracks.videoTrack.setEnabled(false);
        console.log("Video Muted.");
    } else {
        localTracks.videoTrack.setEnabled(true);
        console.log("Video Unmuted.");
    }
    $("#video-icon").toggleClass('fa-video').toggleClass('fa-video-slash');
}

function stoptimer() {
    localStorage.clear();
    var hour = document.getElementById("hour");
    var mint = document.getElementById("min");
    var secd = document.getElementById("sec");
    hour.innerHTML = '00';
    mint.innerHTML = '00';
    secd.innerHTML = '00';
    var total_time = document.getElementById("total_time");
    if (total_time) {
        total_time.value = hr+':'+ min+':'+sec;
    }
    hr = 0;
    min = 0;
    sec = 0;
    clearTimeout(cycle);
}
var hr = 0;
var min = 0;
var sec = 0;
var cycle;

function startTimer() {
  /*cycle = setInterval(timerCycle, 1000);*/
}

function stopTimer() {
  clearInterval(cycle);
}

function resetTimer() {
  hr = 0;
  min = 0;
  sec = 0;
  localStorage.clear();
  // Update the UI to show 00:00:00
  document.getElementById("hour").innerHTML = '00';
  document.getElementById("min").innerHTML = '00';
  document.getElementById("sec").innerHTML = '00';
}

function timerCycle() {
  sec++;
  if (sec == 60) {
    min++;
    sec = 0;
  }
  if (min == 60) {
    hr++;
    min = 0;
    sec = 0;
  }

  // Format the values to display with leading zeros
  var hourText = hr < 10 ? '0' + hr : hr;
  var minText = min < 10 ? '0' + min : min;
  var secText = sec < 10 ? '0' + sec : sec;

  // Update the UI to display the timer
  document.getElementById("hour").innerHTML = hourText;
  document.getElementById("min").innerHTML = minText;
  document.getElementById("sec").innerHTML = secText;

  var total_time = document.getElementById("total_time");
    if (total_time) {
        total_time.value = hourText+':'+ minText+':'+secText;
    }
}

// Example usage:
// Start the timer
startTimer();

// Stop the timer
// stopTimer();

// Reset the timer
// resetTimer();

/*function timerCycle() {
    sec = parseInt(sec);
    min = parseInt(min);
    hr = parseInt(hr);

    var hour = document.getElementById("hour");
    var mint = document.getElementById("min");
    var secd = document.getElementById("sec");

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

    localStorage.setItem('hr', hr);
    localStorage.setItem('min', min);
    localStorage.setItem('sec', sec);
    // console.log(timer);
    // console.log(timer.innerHTML);

    hour.innerHTML = hr;
    mint.innerHTML = min;
    secd.innerHTML = sec;
    var total_time = document.getElementById("total_time");
    if (total_time) {
        total_time.value = hr+':'+ min+':'+sec;
    }
    cycle = setTimeout(timerCycle, 1000);
}*/

if($('#volume').length > 0 ){
    $("#volume").slider({
        min: 0,
        max: 100,
        orientation: "vertical",
        value: 0,
            range: "min",
        slide: function(event, ui) {
            setVolume(ui.value / 100);
        }
        });
        
        var myMedia = document.createElement('audio');
        $('#player').append(myMedia);
        myMedia.id = "myMedia";
        
        function playAudio(fileName, myVolume) {
                myMedia.src = fileName;
                myMedia.setAttribute('loop', 'loop');
            setVolume(myVolume);
            myMedia.play();
        }
        
        function setVolume(myVolume) {
        var myMedia = document.getElementById('myMedia');
        myMedia.volume = myVolume;
    }
}