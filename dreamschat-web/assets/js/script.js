/*
Author       : Dreamguys
Template Name: Dreamschat - Bootstrap Chat Template
Version      : 1.0
*/

(function($) {
    "use strict";
    jQuery(window).on("load resize", function () {
    	var e = $("#current-user-number").val(),
            a = $("#baseUrl").val() + "assets/img/avatar-8.jpg";
            firebase.database().ref("data/users/" + e).once('value', function(snapshot) {
            if (snapshot.val()) {
                if(snapshot.val().image == undefined || snapshot.val().image === '') {
                    a = baseUrl + 'assets/img/avatar-8.jpg';
                } else {
                    a = snapshot.val().image;
                }
                if(snapshot.val().wallpaper == '' || snapshot.val().wallpaper == undefined) {
                    $('#currentuser_wallpaper_image').addClass(""); 
                    $('#currentuser_wallpaper_image').html('');
                } else {
                    //$('#currentuser_wallpaper_image').addClass("avatar avatar-xl mb-3"); 
                    $('#currentuser_wallpaper_image').html('<img class="avatar-img wallpaper-img" src="' + snapshot.val().wallpaper + '" alt="" style="max-width: 300px; max-height: 300px; border-radius: 10px; margin-top: 20px; margin-bottom: 20px;"><a class="wallpaper mt-3" href="#" onclick="deleteWallpaper()"><span class="test"><i class="fas fa-trash-alt mr-2"></i> Delete wallpaper</span></a>');
                }
            }
        });
    });
    var $slimScrolls = $('.slimscroll');

    // Sidebar Slimscroll

	if($slimScrolls.length > 0) {
		$slimScrolls.slimScroll({
			height: 'auto',
			width: '100%',
			position: 'right',
            start: 'bottom',
			size: '7px',
			color: '#ccc',
			wheelStep: 10,
			touchScrollStep: 100
		});
		var wHeight = $(window).height();
		$slimScrolls.height(wHeight);
		$('.left-sidebar .slimScrollDiv, .sidebar-menu .slimScrollDiv, .sidebar-menu .slimScrollDiv').height(wHeight);
		$('.right-sidebar .slimScrollDiv').height(wHeight - 30);
		$('.chat .slimScrollDiv').height(wHeight - 70);
		$('.chat.settings-main .slimScrollDiv').height(wHeight);
		$('.right-sidebar.video-right-sidebar .slimScrollDiv').height(wHeight - 90);
		$(window).resize(function() {
			var rHeight = $(window).height();
			$slimScrolls.height(rHeight);
			$('.left-sidebar .slimScrollDiv, .sidebar-menu .slimScrollDiv, .sidebar-menu .slimScrollDiv').height(rHeight);
			$('.right-sidebar .slimScrollDiv').height(wHeight - 30);
			$('.chat .slimScrollDiv').height(rHeight - 70);
			$('.chat.settings-main .slimScrollDiv').height(wHeight);
			$('.right-sidebar.video-right-sidebar .slimScrollDiv').height(wHeight - 90);
		});
	}

	$("#search-contact").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#chatsidebar ul li").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	jQuery(window).on('load resize', function () {

		// Variable Declarations

		var right_sidebar = $('.right-sidebar').width();
		var left_sidebar = $('.left-sidebar').width();
		var chat_bar = $('.chat').width();
		var win_width = $(window).width();

		$(".user-list-item:not(body.status-page .user-list-item, body.voice-call-page .user-list-item)").on('click', function () {
		if ($(window).width() < 992) {
				$('.left-sidebar').addClass('hide-left-sidebar');
				$('.chat').addClass('show-chatbar');
			}
		});

		$(".star-message-left").on('click', function () {
			$('.right_side_star').addClass('show-right-sidebar');
			$('.right_side_star').removeClass('hide-right-sidebar');
			$('.right-side-contact').addClass('hide-right-sidebar');
			$('.right-side-contact').removeClass('show-right-sidebar');
		});
		$(".remove-star-message").on('click', function () {
			$('.right_side_star').addClass('hide-right-sidebar');
			$('.right_side_star').removeClass('show-right-sidebar');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat").css('margin-left', 0);
			}
			if ($(window).width() < 992) {
				$('.chat').removeClass('hide-chatbar');
			}
		});

		$(".message-info-left").on('click', function () {
			$('.right_sidebar_info').addClass('show-right-sidebar');
			$('.right_sidebar_info').removeClass('hide-right-sidebar');
			$('.right-side-contact').addClass('hide-right-sidebar');
			$('.right-side-contact').removeClass('show-right-sidebar');
			$('.right_side_star').addClass('hide-right-sidebar');
			$('.right_side_star').removeClass('show-right-sidebar');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat:not(.right_sidebar_info .chat)").css('margin-left', - chat_bar);
			}
			if ($(window).width() < 992) {
				$('.chat:not(.right_sidebar_info .chat)').addClass('hide-chatbar');
			}
		});
		$(".remove-message-info").on('click', function () {
			$('.right_sidebar_info').addClass('hide-right-sidebar');
			$('.right_sidebar_info').removeClass('show-right-sidebar');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat").css('margin-left', 0);
			}
			if ($(window).width() < 992) {
				$('.chat').removeClass('hide-chatbar');
			}
		});

		$(".dream_profile_menu").on('click', function () {
			//$('.right-side-contact').addClass('show-right-sidebar');
			$('.right-side-contact').removeClass('hide-right-sidebar');
			$('.right_sidebar_info').addClass('hide-right-sidebar');
			$('.right_sidebar_info').removeClass('show-right-sidebar');
			$('.right_side_star').addClass('hide-right-sidebar');
			$('.right_side_star').removeClass('show-right-sidebar');
			$('.video-right-sidebar').addClass('show-right-sidebar');
			$('.video-right-sidebar').removeClass('hide-right-sidebar');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat:not(.right-side-contact .chat)").css('margin-left', - chat_bar);
				$(".chat:not(.right_side_star .chat)").css('margin-left', - chat_bar);
			}
			if ($(window).width() < 992) {
				$('.chat:not(.right-side-contact .chat)').addClass('hide-chatbar');
				$('.chat:not(.right_side_star .chat)').addClass('hide-chatbar');
			}
		});

		$(".close_profile").on('click', function () {
			$('.right-side-contact').addClass('hide-right-sidebar');
			$('.right-side-contact').removeClass('show-right-sidebar');
			$('.video-right-sidebar').addClass('hide-right-sidebar');
			$('.video-right-sidebar').removeClass('show-right-sidebar');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat").css('margin-left', 0);
			}
			if ($(window).width() < 992) {
				$('.chat').removeClass('hide-chatbar');
			}
		});
		$(".nav-tabs a").on('click', function () {
			$(this).tab('show');
		});

		$(".chat-header .left_side i, .page-header .left_side i").on('click', function () {
			$('.left-sidebar').removeClass('hide-left-sidebar');
			$('.chat').removeClass('show-chatbar');
		});
			
	});


	if($('.emoj-action').length > 0) {
		$(".emoj-action").on('click', function () {
			$('.emoj-group-list').toggle();
		});
	}

    // Loader
    
    setTimeout(function () {
        $('.page-loader');
        setTimeout(function () {
            $(".page-loader").fadeOut("slow");
        }, 500);
    }, 3000);

	//Password

	if($('.toggle-password').length > 0) {
		$(document).on('click', '.toggle-password', function() {
			$(this).toggleClass("fa-solid fa-eye fa-solid fa-eye-slash");
			var input = $(".pass-input");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}

	//New-Password
	if($('.toggle-password').length > 0) {
		$(document).on('click', '.toggle-passwords', function() {
			$(this).toggleClass("fa-solid fa-eye fa-solid fa-eye-slash");
			var input = $(".pass-inputs");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}

	//Confirm-Password
	if($('.toggle-password').length > 0) {
		$(document).on('click', '.conform-toggle-password', function() {
			$(this).toggleClass("fa-solid fa-eye fa-solid fa-eye-slash");
			var input = $(".conform-pass-input");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}

	//Rightside accordian
	$('.accordion-col .accordion-title').on('click', function () {
		$(this).next().slideToggle();
		$(this).toggleClass('active');
	});
	
	//Custom modal click for status view
	$('*[data-target="#status-modal"]').on('click', function () {
		$('body').addClass('custom-model-open');
	});
	$('.custom-status-close').on('click', function () {
		$('body').removeClass('custom-model-open');
	});
	
	// Tooltip
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	})

	//Top Online Contacts
	if($('.top-online-contacts .swiper-container').length > 0 ){
		var swiper = new Swiper('.top-online-contacts .swiper-container', {
	      	slidesPerView: 5,
	      	spaceBetween: 15,
	    });
	}

	// Datetimepicker Date
	
	if($('.datetimepicker').length > 0 ){
		$('.datetimepicker').datetimepicker({
			format: 'DD-MM-YYYY',
			icons: {
				up: "fas fa-angle-up",
				down: "fas fa-angle-down",
				next: 'fas fa-angle-right',
				previous: 'fas fa-angle-left'
			}
		});
	}

	//Chat Search Visible
	$('.chat-search-btn').on('click', function () {
		$('.chat-search').addClass('visible-chat');
	});
	$('.close-btn-chat').on('click', function () {
		$('.chat-search').removeClass('visible-chat');
	});
	$(".chat-search .form-control").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(".chat .chat-body .messages .chats").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	//Chat Search Visible
	$('.user-chat-search-btn').on('click', function () {
		$('.user-chat-search').addClass('visible-chat');
	});
	$('.user-close-btn-chat').on('click', function () {
		$('.user-chat-search').removeClass('visible-chat');
	});

	//Otp Verfication
	$('.digit-group').find('input').each(function() {
	$(this).attr('maxlength', 1);
		$(this).on('keyup', function(e) {
			var parent = $($(this).parent());

			if(e.keyCode === 8 || e.keyCode === 37) {
				var prev = parent.find('input#' + $(this).data('previous'));
				
				if(prev.length) {
					$(prev).select();
				}
			} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
				var next = parent.find('input#' + $(this).data('next'));
				
				if(next.length) {
					$(next).select();
				} else {
					if(parent.data('autosubmit')) {
						parent.submit();
					}
				}
			}
		});
	});

	$('.digit-group input').on('keyup', function(){
	    var self = $(this);
	    if ( self.val() != '' ) {
	        self.addClass('active');
	    } else {
	        self.removeClass('active');
	    }
	});
	
	//Custom Country Code Selector
	/*if($('#phone').length > 0) {
		var input = document.querySelector("#phone");
			window.intlTelInput(input, {
				separateDialCode: true,
            	nationalMode: false,
			  utilsScript: "assets/plugins/intltelinput/js/utils.js",
		}); 	
	}*/

	// Select 2
	if ($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}

	// Mute Audio
	
	if($('.mute-bt').length > 0) {
		$(".mute-bt").on('click', function(){
			if($(this).hasClass("stop")) {
				$(this).removeClass("stop");
				$(".mute-bt i").removeClass("feather-mic-off");
				$(".mute-bt i").addClass("feather-mic");
				$(this).attr("data-bs-original-title","Mute Audio");
				$(".join-video.user-active .more-icon").removeClass("mic-view");
				
				$(".action-info.vid-view li .mute-mic i").removeClass("feather-mic-off");
				$(".action-info.vid-view li .mute-mic i").addClass("feather-mic");
			}
			else{
				$(this).addClass("stop");
				$(".mute-bt i").removeClass("feather-mic");
				$(".mute-bt i").addClass("feather-mic-off");
				$(this).attr("data-bs-original-title","Unmute Audio");				
				$(".join-video.user-active .more-icon").addClass("mic-view");
				
				$(".add-list .user-active .action-info").addClass("vid-view");
				$(".action-info.vid-view li .mute-mic i").removeClass("feather-mic");
				$(".action-info.vid-view li .mute-mic i").addClass("feather-mic-off");
			}
		});
	}

	//Theme Image

	$('.wall-img').on('click', function(){
		$('.wall-img').removeClass('active');
		$(this).addClass('active');
	});

	// Mute Video
	
	if($('.mute-video').length > 0) {
		$(".mute-video").on('click', function(){
			if($(this).hasClass("stop")) {
				$(this).removeClass("stop");
				$(".mute-video i").removeClass("feather-video-off");
				$(".mute-video i").addClass("feather-video");
				$(".join-call .join-video").removeClass("video-hide");
				$(".video-avatar").removeClass("active");
				$(this).attr("data-bs-original-title","Stop Camera");
				$(".meeting .join-video.user-active").removeClass("video-hide");
				
				$(".join-video.user-active .more-icon").removeClass("vid-view");				
				$(".action-info.vid-view li .mute-vid i").removeClass("feather-video-off");
				$(".action-info.vid-view li .mute-vid i").addClass("feather-video");
			}
			else{
				$(this).addClass("stop");
				$(".mute-video i").removeClass("feather-video");
				$(".mute-video i").addClass("feather-video-off");
				$(".join-call .join-video").addClass("video-hide");
				$(".video-avatar").addClass("active");
				$(this).attr("data-bs-original-title","Start Camera");
				$(".meeting .join-video.user-active").addClass("video-hide");
				
				$(".add-list .user-active .action-info").addClass("vid-view");
				$(".action-info.vid-view li .mute-vid i").removeClass("feather-video");
				$(".action-info.vid-view li .mute-vid i").addClass("feather-video-off");
			}
		});
	}
	
	$(document).ready(function(){
		if(window.location.hash == "#DarkMode"){
			document.body.classList.add('darkmode');
			localStorage.setItem('darkMode', 'enabled');
		}
	});
	
	// DarkMode with LocalStorage
	if($('#dark-mode-toggle').length > 0) {
		let darkMode = localStorage.getItem('darkMode'); 
		
		const darkModeToggle = document.querySelector('#dark-mode-toggle');
		
		const enableDarkMode = () => {
		  document.body.classList.add('darkmode');
		  localStorage.setItem('darkMode', 'enabled');
		}

		const disableDarkMode = () => {
		  document.body.classList.remove('darkmode');
		  localStorage.setItem('darkMode', null);
		}
		 
		if (darkMode === 'enabled') {
		  enableDarkMode();
		}

		darkModeToggle.addEventListener('click', () => {
		  darkMode = localStorage.getItem('darkMode'); 
		  
		  if (darkMode !== 'enabled') {
			enableDarkMode();
		  } else {  
			disableDarkMode(); 
		  }
		});
	}

})(jQuery);

$(document).ready(function() {
    $('.close-replay').on('click', function() {
    	// Your event handler code here
    	$('.reply-msg-div').removeClass("d-flex");
    	$('.reply-msg-div').addClass("d-none");
    	$('.reply-content').html("");
    });
});
	
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
function getlanguages() {
	if(uslang == undefined || uslang == '') {
		 uslang = "English";
	}
	$("#ulanguage").empty();
    firebase.database().ref("data/languages").once("value", function (e) {
        e.forEach(function (e) {
            var a = e.key;
            $("#ulanguage").append($("<option></option>").attr("value", a).text(a));
        }),
        $("#ulanguage").val(uslang);  
    });
}

function updatelanguage() {
	var burl = $("#baseUrl").val();

    var e = $("#ulanguage").val(),
        a = $("#current-user-number").val();

    firebase.database().ref("data/languages/" + e).once("value", function (t) {
        $.ajax({
            url: burl + "home/setnewjsonlanguage",
            type: "POST",
            data: { username: a, language: e, languagedata: t.val(), session: "yes" },
            success: function (e) {
            	toastr.success("Language Changed Successfully");
		        setTimeout(function() {
		          window.location.reload();
		        }, 2000); // Adjust the delay as needed
            },
			
        });
    });
}

function updatewallpaper() {
    var e = $("#avatar_upload_img")[0].files;
    if (e) {
        if (validateFile1(e)) {
            if (handleGroupFileUpload(e, "wallpaper")) {
            	toastr.success("Wallpaper Updated Successfully!");
            	setTimeout(function() {
	              window.location.reload();
	            }, 2000); // Adjust the delay as needed
                $("#gallery-image").modal("hide");
                $("#avatar_upload_img").val('');
            } else {
            	toastr.success("Wallpaper Updated Successfully!");
            	setTimeout(function() {
	              window.location.reload();
	            }, 1000); // Adjust the delay as needed
            	$("#gallery-image").modal("hide");
            }
        } else {
        	toastr.warning("Select Only Images!");
        }
    } else {
    	toastr.warning("No file selected!");
    }
}


function updatewallpaperimage(e, a, t, r, s) {
    var l = $("#current-user-number").val(),
        i = {};
    "profile" == s ? ((i.wallpaper = a), $("#currentuser_display_image").html('<img class="avatar-img rounded-circle mCS_img_loaded wallpaper-img" src="' + a + '" alt="">')) : ((i.wallpaper = a), $("#middle").css("background-image", "url(" + a + ")")),$('#currentuser_wallpaper_image').addClass("avatar avatar-xl mb-3"), $('#currentuser_wallpaper_image').html('<img class="avatar-img rounded-circle mCS_img_loaded" src="' + a + '" alt=""><a class="wallpaper" href="#" onclick="deleteWallpaper()"><span class="test"><i class="fas fa-trash-alt mr-2"></i> Delete wallpaper</span></a>'),
        firebase
            .database()
            .ref("data/users/" + l)
            .update(i);
}

function updatepasswordold() {
	//console.log(user); return false;
    var e = $("#current-user-number").val(),
        a = $("#current_password").val(),
        t = $("#new_password").val(),
        r = $("#confirm_password").val();
    firebase.database().ref("data/users/" + e).once("value", function (s) {
        if (s.val().password == a)
            if ("" != t)
                if (t == r) {
                    var l = new Date().getTime();

                    firebase.database().ref("data/users/" + e).update({ password: t, timeStamp: l }),
                        toastr.success("Password Updated Successfully!"),
                        $("#password-security").modal("hide");
                } else toastr.warning("Passwords are mismatched.");
            else toastr.warning("Password should not be empty");
        else toastr.warning("Please enter correct password");
    });
}

// Function to reauthenticate the user
function reauthenticate(currentPassword) {
  const user = firebase.auth().currentUser;
  const credential = firebase.auth.EmailAuthProvider.credential(
    user.email,
    currentPassword
  );

  return user.reauthenticateWithCredential(credential);
}

// Handle form submission for password update
function updatepassword() {
  	var currentPassword = $("#current_password").val();
  	var newPassword = $("#new_password").val();
  	var confirmPassword = $("#confirm_password").val();
  	var currentUser = $("#current-user-number").val();
  	if(newPassword == "") {
  		toastr.warning("Password should not be empty");
  		return false;
  	}

  	if(newPassword != confirmPassword) {
  		toastr.warning("Passwords are mismatched.");
  		return false;
  	}
  	// Reauthenticate the user first
  	reauthenticate(currentPassword).then(() => {
      // User has been successfully reauthenticated
      // Now you can update the password
      const user = firebase.auth().currentUser;

      	user.updatePassword(newPassword).then(() => {
      		var time = new Date().getTime();
            firebase.database().ref("data/users/" + currentUser).update({ password: newPassword, timeStamp: time });
      		$(".login-security").empty();
      		$("#password-security").modal('hide');
      		toastr.success("Password Updated Successfully!");
        }).catch((error) => {
        	toastr.warning("Password not Updated");
        });
    }).catch((error) => {
    	toastr.warning("Please enter valid current password");
    });
}
//});

function generateRandomString1(e) {
    for (var a = "abcdefghijklmnopqrstuvwxyz", t = "", r = 0; r < e; r++) {
        var s = Math.floor(Math.random() * a.length);
        t += a.charAt(s);
    }
    return t;
}
function getFileType1(e) {
    return e.match("image.*") ? 2 : "other";
}

function validateFile1(e) {
    for (var a = ["jpeg", "jpg", "png", "gif", "bmp"], t = 0; t < e.length; t++) {
        var r = e[t].name.split(".").pop().toLowerCase();
        if (-1 === jQuery.inArray(r, a)) return !1;
    }
    return !0;
}


function handleGroupFileUpload(e, a) {
    for (var t = 0; t < e.length; t++) {
        new FormData().append("file", e[t]),
            fireBaseGroupImageUpload({ file: e[t], path: "/Dreamschat", up_path: a }, function (e) {
                if (!e.error && (e.progress, e.downloadURL)) return e.downloadURL;
            });
    }
}


function fireBaseGroupImageUpload(e, a) {
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
                "other" != r ? updatewallpaperimage(r, e, d, n, l) : toastr.warning("Select Only Images"), a({ downloadURL: e, element: t, fileSize: n, fileType: o, fileName: d });
            }
        );
}


function deleteWallpaper() {
	var currentuser = $('#current-user-number').val();
	//alert(currentuser); return false;
	swal({
		title: "Delete Confirmation",
		text: "Are you sure want to delete this wallpaper?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			firebase.database().ref('data/users/' + currentuser).update({
				wallpaper: ""
			});
			$("#gallery-image").modal('hide');
			$('#currentuser_wallpaper_image').removeClass("avatar avatar-xl mb-3"); 
			$('#currentuser_wallpaper_image').html('');
			//$("#middle").removeAttr('style');
			toastr.success("Wallpaper Deleted Successfully!");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
			//window.location.reload();
		}
	});
}

function incomingcallclick(type) {
        $("#call_pop").modal('hide');
        var currentuser = $('#current-user-number').val();
        var calllink = $("#call_link").val();

        var audio = getUrlVars(calllink);

        if (audio['user_type'] == 'onetoone') {
        	if (audio['call_type'] == 'audio') {
        		var href = baseUrl+'audio-call?'+calllink;
        	} else {
        		var href = baseUrl+'video-call?'+calllink;
        	}
        } else {
        	if (audio['call_type'] == 'video') {
        		var href = baseUrl+'group-video-call?'+calllink;
        	} else {
        		var href = baseUrl+'group-call?'+calllink;
        	}
        	//var href = baseUrl+'group-call?'+calllink;
        }

        var querystring = getUrlVars(href);
        var isVideo = (querystring['call_type'] == 'video') ? true : false;
        
        if (type == 'answer') {
            var cid = '';
            if (querystring['group'] == '') {
                cid = pushcalldetails(currentuser, querystring['caller'], 'IN', isVideo);
                href = href+'&cid='+cid;
                firebase.database().ref('data/users/' + currentuser).update({call_status: false});
                window.open(href, '_blank');
            }
            else {
                //get groupcall users
                var gcusers = '';
                firebase.database().ref("data/users/" + currentuser).once('value', function(snapshot) 
                {
                    if (snapshot.val().groupcallusers) {
                        gcusers = snapshot.val().groupcallusers;
                        if (Array.isArray(gcusers)) {
                            //remove me
                             gcusers = gcusers;
                        }
                        else {
                            //convert to array
                            var gcusers = JSON.parse(gcusers);
                        }
                        var myindex = gcusers.indexOf(currentuser);
                        if (myindex !== -1) {
                          gcusers.splice(myindex, 1);
                        }
                        if (gcusers!='') {
                            cid = grouppushcalldetails(currentuser, gcusers, '', 'IN', isVideo);
                        }
                        href = href+'&cid='+cid+'&callerids='+gcusers;
                        firebase.database().ref('data/users/' + currentuser).update({call_status: false});
                        window.open(href, '_blank');
                    }
                }); 
            }
        }
        else {
            //cancel the call
            if (querystring['user_type'] == 'group') {
                var gcusers = '';
                firebase.database().ref("data/users/" + currentuser).once('value', function(snapshot) 
                {
                    if (snapshot.val().groupcallusers) {
                        gcusers = snapshot.val().groupcallusers;
                        //remove me
                        var myindex = gcusers.indexOf(currentuser);
                        if (myindex !== -1) {
                          gcusers.splice(myindex, 1);
                        }
                    }
                });
                grouppushcalldetails(currentuser, gcusers, '', 'CANCELED', isVideo);
            }
            else {
                //get call type
                var calltype = (querystring['call_type'] == 'video') ? 'Video call' : 'Audio call';
                pushcalldetails(currentuser, querystring['caller'], 'CANCELED', isVideo);
                callpushnotification(currentuser, querystring['caller'], calltype, 'User Declined', '');
                firebase.database().ref('data/users/' + querystring['caller']).update({incomingcall:'',call_status: true});
            }
            //update call status
            firebase.database().ref('data/users/' + currentuser).update({incomingcall:'',call_status: true, groupcallusers:''});
            
        }
    }
    function getUrlVars(url)
    {
        var vars = [], hash;
        var hashes = url.slice(url.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    //cancel when busy
    function cancelonetoone() {
        var currentuser = $('#current-user-number').val();
        var calllink = $("#busy_calllink").val();
        var href = baseUrl+'call_first?'+calllink;
        var querystring = getUrlVars(href);
        var isVideo = (querystring['call_type'] == 'video') ? true : false;
        if (querystring['user_type'] == 'group') {
            grouppushcalldetails(querystring['receiver'], querystring['group'], querystring['caller'], 'CANCELED', isVideo);
        }
        else {
            pushcalldetails(querystring['receiver'], querystring['caller'], 'CANCELED', isVideo);
        }
        $("#busy_pop_up").modal('hide');
        window.location.reload();
        firebase.database().ref("data/users/" + querystring['receiver']).once('value', function(snapshot) {
        var imageval = baseUrl + 'assets/img/avatar-8.jpg';
        if (snapshot.val()) {
            $('#selected_username').text(snapshot.val().username);
            $('.profile-name').html(snapshot.val().username);
            $("#to_call_user").val(snapshot.val().id);
           
            if(snapshot.val().image == undefined || snapshot.val().image === '') {
                imageval = baseUrl + 'assets/img/avatar-8.jpg';
            } else {
                imageval = snapshot.val().image;
            }
            $('#selected_userimage').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#sideprofileimg').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
        } else {
            $('#selected_userimage').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
            $('#sideprofileimg').html('<img src="' + imageval + '" class="rounded-circle" alt="image">');
        }
    });
    }
    //call details
    function pushcalldetails(from, to, stext, isVideo) {
        var d = new Date();
        var n = d.getTime();
        
        var myRef = firebase.database().ref("data/calls/" + from).push();
        myRef.set({
            "callerId": [to],
            "callerImg": "",
            "callerName": "",
            "currentMills": n,
            "inOrOut": stext,
            "isVideo": isVideo,
            "type":"single",
            "userId": from,
            "id": myRef.key
        });
        return myRef.key;
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

    function logout() {
    var user = $("#current-user-number").val();
    var d = new Date();
    var utcd = new Date(d.toUTCString().slice(0, -4));
    var n = utcd.getTime();
    if (user!='') {
        firebase.database().ref('data/users/' + user).update({
            webqrcode:'',
            "timeStamp": n,
            online: false
        });
    }
    //unset language
    $.ajax({
        url: 'firesession',
        type: 'POST',
        data: {
            user: ''
        },
        success: function(data) {
            window.location.href = burl;
        }
    });
}
//firebase if any changes in user table for call
var loginuser = $("#current-user-number").val();
firebase.database().ref("data/users/"+loginuser).on("child_changed", function(snapshot) {
	if (snapshot.key == 'incomingcall' && snapshot.val()!='') {
		var url = baseUrl+'?'+snapshot.val();
		var QueryString = getUrlVars(url);
		var lbl_incoming_call = 'Incoming Call';
		$("#call_pop").modal('show');
		var usersRef = firebase.database().ref("data/users/" + QueryString['caller']);
        usersRef.once('value', function(usersnapshot) {

        	var imageval = baseUrl + 'assets/img/avatar-8.jpg';
            if (usersnapshot.val().image != "") {
                imageval = usersnapshot.val().image;
                $('#call-username-img').html('<img class="call-avatar" src="' + imageval + '" alt="User Image">');
            } else {
                $('#call-username-img').html('');
            }

			$("#call_user").html(usersnapshot.val().firstName);
		});
		if (QueryString['call_type'] == 'audio') {
			$("#call_attend_icon").html('<i class="bx bx-phone-call"></i>');
		}
		else {
			$("#call_attend_icon").html('<i class="feather-video"></i>');
		}
		$("#chat_msg").html(lbl_incoming_call+'..');
		$("#call_link").val(snapshot.val());
	}
});

function getUrlVars(url)
{
    var vars = [], hash;
    var hashes = url.slice(url.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars[hash[0]] = hash[1];
    }
    return vars;
}
function GetQueryStringByParameter(name, url) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(url);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function answervcall() {
    var loginuser = $("#current-user-number").val();
    var tocalluser = $("#tocalluser").val();
    var vcalllink = $("#vcalllink").val();
    $("#video_call").modal('hide');
    pushcalldetailsfooter(tocalluser, loginuser, 'IN', true);
    var href = baseUrl+'joinvideocall?'+vcalllink;
    window.open(href, '_blank');
}

function endvideocall() {
    var loginuser = $("#current-user-number").val();
    var tocalluser = $("#tocalluser").val();
    $("#video_call").modal('hide');
    pushcalldetailsfooter(tocalluser, loginuser, 'DECLINED', true);
    firebase.database().ref("data/users/" + tocalluser).once('value', function(usersnapshot) {
        if (usersnapshot.val().deviceToken != '') {
             $.ajax({
                url: 'home/callnotification',
                type: 'POST',
                data: {
                    deviceToken: usersnapshot.val().deviceToken,from:'', body:'', to:'',osType:usersnapshot.val().osType, attachimg:'', title:'decline', attachmentType:'text'
                },
                success: function(data) {
                    console.log(data); 
                }
            });
        }
    });
    firebase.database().ref('data/users/' + loginuser).update({channelname: ''});
}

function pushcalldetailsfooter(from, to, stext, isVideo) {
    var d = new Date();
    var n = d.getTime();
   
    firebase.database().ref("data/calls/" + from).push().set({
        "callerId": to,
        "callerImg": "",
        "callerName": to,
        "currentMills": n,
        "inOrOut": stext,
        "isVideo": isVideo,
        "userId": from
    });
    return false;
}

function viewblockedusers() {
    var e = $("#current-user-number").val();
    $("#blocked-users").empty();
    firebase
        .database()
        .ref("data/users/" + e + "/blockedUsersIds")
        .once("value", function (e) {
            if (($("#bu_div").html(""), null != e.val())) {
                var a = '';
                $.each(e.val(), function (e, t) {
                var usersName=''; 
                var usersRef = firebase.database().ref("data/users/"+t);
                    usersRef.once('value', function(snapshot) {
                    if(snapshot.val()!=null){
                        if (snapshot.val().firstName == null || snapshot.val().firstName == undefined || snapshot.val().firstName == '') 
                        {
                            usersName = t;
                        }
                        else {
                            usersName = snapshot.val().firstName;
                        }

                        if (snapshot.val().image != "" && snapshot.val().image != undefined) {
	                        var imagevaluser = snapshot.val().image;
	                    } else {
	                        var imagevaluser = baseUrl + 'assets/img/user-placeholder.jpg';
	                    }
                    }     
                	a = "<div class='user-block-profile'><div class='avatar'><img src='"+imagevaluser+"' class='rounded-circle' alt='image'></div><div class='block-user-name'><h6 class='capitalize-first-letter'>" + usersName + '</h6><span>'+ snapshot.val().status +'</span></div></div><div class="user-blocked"><a class="btn btn-primary" onclick="unblockuser(\'' + e + "', '" + t + "')\">Unblock</a></div>";
                    
                    /*a = a + "<div class='row mb-3'><div class='col-lg-6'>" + usersName + ' </div><div class="col-lg-6"><button type="button" class="btn btn-primary btn-sm" onclick="unblockuser(\'' + e + "', '" + t + "')\">Unblock</button></div>";
                    (a += "</div>"),*/
                    $("#blocked-users").html(a);
                })
                });
                    
            } else {
                $("#blocked-users").append("No Users");
            }
        });
}
function unblockuser(e, a) {
    var t = $("#current-user-number").val();
    firebase
        .database()
        .ref("data/users/" + t + "/blockedUsersIds")
        .once("value", function (a) {
            if (null != a.val()) {
                var r = a.val();
                r.splice(e, 1),
                    firebase
                        .database()
                        .ref("data/users/" + t)
                        .update({ blockedUsersIds: r });
            }
        });
        swal({
		title: "Unblock Confirmation",
		text: "Are you sure want to unblock this user?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			$("#blocked-user").modal('hide');
			toastr.success("User Unblocked Successfully");
	        setTimeout(function() {
	          window.location.reload();
	        }, 2000); // Adjust the delay as needed
		}
	});
}


function viewblockedcontacts() {
    var currentUser = $("#current-user-number").val();
    var usersName = "";
    var a = '';
    firebase.database().ref("data/contacts/" + currentUser).once("value", function (snapshot) {
    	if(snapshot.val()) {
    		snapshot.forEach(function(childSnapshot) {
    			if(childSnapshot.val() != null) {
    				if(childSnapshot.val().isBlocked == true) {
    				console.log(childSnapshot.val());
	    				if (childSnapshot.val().firstName != null || childSnapshot.val().firstName != undefined || childSnapshot.val().firstName == '' && childSnapshot.val().lastName != null || childSnapshot.val().lastName != undefined || childSnapshot.val().lastName == '') {
	    					
	                        usersName = childSnapshot.val().firstName +' '+ childSnapshot.val().lastName;
	                    }
	                    else {
	                        usersName = '';
	                    }
	                    
	                    if (childSnapshot.val().image != "" && childSnapshot.val().image != undefined) {
	                        var imagevaluser = childSnapshot.val().image;
	                    } else {
	                        var imagevaluser = baseUrl + 'assets/img/user-placeholder.jpg';
	                    }

	                    a = $('<div class="user-block-profile"><div class="avatar"><img src='+imagevaluser+' class="rounded-circle" alt="image"></div><div class="block-user-name"><h6>' + usersName + '</h6></div></div><div class="user-blocked"><a class="btn btn-primary" onclick="unBlockContact(\''+childSnapshot.val().mobilenumber+'\')";>Unblock</a></div>');

	                    a.appendTo($('#block-contacts'));
	                }
    			} else {
    				$("#block-contacts").html("Blocked Contact User Not Found");
    			}
    		});
    	} else {
    		$("#block-contacts").html("Contact User Not Found");
    	}
    });
}

function unBlockContact(contactNumber) {
    var currentuser = $("#current-user-number").val();
    firebase.database().ref("data/contacts/" + currentuser + "/" + contactNumber).once("value", function (snapshot) {
    	if (null != snapshot.val()) {
    		swal({
				title: "Unblock Confirmation",
				text: "Are you sure want to unblock this user?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((willDelete) => {
				firebase.database().ref("data/contacts/" + currentuser + "/" + contactNumber).update({ isBlocked: false });
				$("#blocked-user").modal('hide');
				toastr.success("Contact User Unblocked Successfully");
			    setTimeout(function() {
			      window.location.reload();
			    }, 2000); // Adjust the delay as needed
			});
    	} else {
    		toastr.warning("Contact User not found");
    	}
    });
}


$(document).ready(function() {
    // Get references to the elements
    var $fileInput = $('#avatar_upload_img');
    var $imagePreview = $('#current-profile-image');

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

$(document).ready(function() {
    // Get references to the elements
    var $fileInput = $('#avatar_upload_img');
    var $imagePreview = $('#currentuser_wallpaper_image');

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

function sidebaractive() {

	$("#settings-sidebar").show();
	$("#home-sidebar").hide();
	$("#group-sidebar").hide();
	$("#status-sidebar").hide();
	$("#call-sidebar").hide();
	$("#contact-sidebar").hide();
}

function closesidebar() {
	$("#settings-sidebar").hide();
	$("#home-sidebar").show();
	$("#group-sidebar").show();
	$("#status-sidebar").show();
	$("#call-sidebar").show();
	$("#contact-sidebar").show();
}

function lightappearancesettings() {
    var theme_color = 'light'; 
    var form_data = new FormData();
    form_data.append('theme_color', theme_color);

    $.ajax({
        url: 'home/insertappearancesettings', // Replace with the correct URL
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            if (response == 'success') {
                window.location.reload();
            } else {
            	toastr.error("Failed to save settings");
            }
        },
        error: function (xhr, status, error) {
        	toastr.error("Failed to save settings: " + error)
        }
    });
}

function darkappearancesettings() {
    var theme_color = 'dark'; 
    var form_data = new FormData();
    form_data.append('theme_color', theme_color);

    $.ajax({
        url: 'home/insertappearancesettings', // Replace with the correct URL
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            if (response == 'success') {
                window.location.reload();
            } else {
            	toastr.error("Failed to save settings")
            }
        },
        error: function (xhr, status, error) {
        	toastr.error("Failed to save settings: " + erro)
        }
    });
}