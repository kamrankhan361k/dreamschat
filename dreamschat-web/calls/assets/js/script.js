/*
Author       : Dreamguys
Template Name: Dreamschat - Bootstrap Chat Template
Version      : 1.0
*/

(function($) {
    "use strict";

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

		$(".user-list-item").on('click', function () {
		if ($(window).width() < 992) {
				$('.left-sidebar').addClass('hide-left-sidebar');
				$('.chat').addClass('show-chatbar');
			}
		});

		$(".dream_profile_menu").on('click', function () {
			$('.right-sidebar').addClass('show-right-sidebar');
			$('.right-sidebar').removeClass('hide-right-sidebar');
				if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat").css('margin-left', - chat_bar);
			}
			if ($(window).width() < 992) {
				$('.chat').addClass('hide-chatbar');
			}
		});

		$(".close_profile").on('click', function () {
			$('.right-sidebar').addClass('hide-right-sidebar');
			$('.right-sidebar').removeClass('show-right-sidebar');
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

		$(".chat-header .left_side i").on('click', function () {
			$('.left-sidebar').removeClass('hide-left-sidebar');
			$('.chat').removeClass('show-chatbar');
		});
			
	});

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

	//Custom scroll bar
	if ($(window).width() > 992) {
		if($('.chat-body, .left-sidebar .sidebar-body, .right-sidebar').length > 0 ){
			$('.chat-body, .left-sidebar .sidebar-body, .right-sidebar').mCustomScrollbar();
		}
	}
	
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
	
})(jQuery);