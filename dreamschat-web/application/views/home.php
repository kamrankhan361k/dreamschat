<?php
$session = $this->session->userdata('username');
$lang = ($session['language'] != '')?$session['language']:'En';
$ul = custom_language($session['user'], $lang);

?>
<?php 
    $this->load->view('includes/header');
    //$session = $this->session->userdata('username');
    //echo "<pre>"; print_r($session); exit;
   // $ul = custom_language($session['user'], $session['language']);
    //echo "<pre>"; print_r($ul); exit;
?>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Loader -->
    <div class="page-loader">
        <div class="page-loader-inner">
            <div class="loader-box">
                <?php
                    $filePath = base_url() . 'uploads/website/' . getenv('DB_COMPANY_ICON');
                    $alter_img = base_url() . 'assets/img/logo.png';

                    if (!file_exists($filePath)) {
                        // If the file exists, display the image
                        echo '<img src="' . $filePath . '" alt="Company Icon">';
                    } else {
                        // If the file doesn't exist, display an alternative image
                        echo '<img src="' . $alter_img . '" alt="Loader">';
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- /Loader -->
    <!-- content -->
    <div class="content main_content">
        <?php 
            $this->load->view('includes/leftsidebar'); 
            $this->load->view('includes/sidebargroup'); 
        ?>
        <!-- Top Online Contacts -->
            <div class="top-online-contacts">
                <div class="fav-title d-none">
                    <h6><?php echo ($ul['homepage']['online_now'])?$ul['homepage']['online_now']: "Online Now"; ?></h6>
                </div>
               <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- <div class="swiper-slide">
                            <div class="top-contacts-box">
                                <div class="profile-img online">
                                    <img src="assets/img/avatar/avatar-2.jpg" alt="">
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- /Top Online Contacts -->
            <div class="sidebar-body chat-body" id="chatsidebar">
                <!-- Left Chat Title -->
                <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                    <div class="fav-title pin-chat">
                        <h6 class="recent-chats d-none"><i class="bx bx-message-square-dots me-1"></i>Recent Chat</h6>
                    </div>
                </div>
                <!-- /Left Chat Title -->
                <ul class="user-list recent-user-list">
                    
                </ul>
            </div>

        </div>

    </div>
    <!-- / Chats sidebar -->
</div>
<!-- /Sidebar group -->
        <!-- Chat -->
            <!-- <div class="chat status-middle-bar d-flex align-items-center justify-content-center" id="add-new-user" style="display:none">
                <div class="status-right">
                    <div><img src="assets/img/empty-img-01.png" alt=""></div>
                    <div class="select-message-box">
                        <h4>Select Message</h4>
                        <p>To see your existing conversation or share a link below to start new</p>
                        <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-chat"><i class="bx bx-plus me-1"></i>Add New Message</a>
                    </div>
                </div>
            </div> -->
            <!-- /Chat -->
        <!-- Chat -->

        <!-- Chat -->
        <div class="chat status-middle-bar d-flex align-items-center justify-content-center">
            <div class="status-right">
                <div class="empty-chat-img"><img src="assets/img/empty-img-01.png" alt="Image"></div>
                <div class="select-message-box">
                    <h4>Select Message</h4>
                    <p>To see your existing conversation or share a link below to start new</p>
                    <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-chat"><i class="bx bx-plus me-1"></i>Add New Message</a>
                </div>
            </div>
        </div>
        <!-- /Chat -->

        <div class="chat chat-messages d-none" id="middle">
            <div>
                <div class="chat-header">
                    <div class="user-details">
                        <div class="d-lg-none">
                            <ul class="list-inline mt-2 me-2">
                                <li class="list-inline-item">
                                    <a class="text-muted px-0 left_side" href="#" data-chat="open">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <figure class="avatar ms-1" id="selected_userimage">
                            <!-- <img src="" class="rounded-circle" alt="image"> -->
                        </figure>
                        <div class="mt-1">
                            <h5 class="capitalize-first-letter" id="selected_username"></h5>
                            <small class="last-seen"  id="selected_usertime"></small>
                        </div>
                    </div>
                    <div class="chat-options ">
                        <ul class="list-inline">
                            <li class="list-inline-item" >
                                <a href="javascript:void(0)" class="btn btn-outline-light chat-search-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Search">
                                    <i class="bx bx-search" ></i>
                                </a>
                            </li>
                            <li class="list-inline-item" >
                                <a href="javascript:void(0);" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video Call"  onclick="onetoonenew('video');">
                                    <i class="bx bx-video" ></i>
                                </a>
                            </li>
                            <li class="list-inline-item" >
                                <a href="javascript:void(0);" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voice Call" onclick="onetoonenew('audio');">
                                    <i class="bx bx-phone" ></i>
                                </a>
                            </li>
                            <li class="list-inline-item dream_profile_menu" >
                                <a href="javascript:void(0)" class="btn btn-outline-light not-chat-user">
                                    <i class="bx bx-info-circle" ></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light no-bg" href="#" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded" ></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" >
                                    <!-- <a href="#" class="dropdown-item "><span><i class="bx bx-x" ></i></span>Close Chat </a> -->
                                    <!-- <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mute-notification"><span><i class="bx bx-volume-mute"></i></span>Mute Notification</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disappearing-messages"><span><i class="bx bx-time-five"></i></span>Disappearing Message</a> -->
                                    <a href="#" class="dropdown-item" onclick="clearChat()"><span><i class="bx bx-brush-alt"></i></span><?php echo ($ul['homepage']['clear_message'])?$ul['homepage']['clear_message']: "Clear Message"; ?></a>
                                    <!-- <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change-chat"><span><i class="bx bx-trash-alt"></i></span>Delete Chat</a> -->
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span><?php echo ($ul['homepage']['report'])?$ul['homepage']['report']: "Report"; ?></a>
                                    <a href="#" class="dropdown-item" onclick="blockUserModal();"><span><i class="bx bx-block"></i></span><?php echo ($ul['homepage']['block'])?$ul['homepage']['block']: "Block"; ?></a>
                                    <a href="#" class="dropdown-item" onclick="unblock_chat();"><span><i class="bx bx-block"></i></span><?php echo ($ul['homepage']['unblock'])?$ul['homepage']['unblock']: "Unblock"; ?></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Chat Search -->
                    <div class="chat-search">
                        <form>
                            <span class="form-control-feedback"><i class="bx bx-search" ></i></span>
                            <input type="text" name="chat-search" placeholder="Search Chats" class="form-control">
                            <div class="close-btn-chat"><span class="material-icons"><?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span></div>
                        </form>
                    </div>
                    <!-- /Chat Search -->
                </div>
                <div class="chat-body chat-page-group slimscroll">
                    <div class="messages" id="user_groupdiv">
                        
                    </div>
                </div>
            </div>
            <div class="chat-footer">
                <form>
                    <div class="smile-foot">
                        <div class="chat-action-btns">
                            <div class="chat-action-col">
                                <a class="action-circle" href="#" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" >
                                    <!-- <a href="#" class="dropdown-item"><span><i class="bx bx-file"></i></span>Document</a> -->
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#drag_files"><span><i class="bx bx-image"></i></span><?php echo ($ul['homepage']['gallery'])?$ul['homepage']['gallery']: "Gallery"; ?></a>
                                    <!-- <a href="#" class="dropdown-item" ><span><i class="bx bx-volume-full"></i></span>Audio</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="smile-foot emoj-action">
                        <a href="#" class="action-circle"><i class="bx bx-smile"></i></a>
                    </div>
                    <div class="smile-foot">
                        <a href="#"  class="action-circle" data-bs-toggle="modal" data-bs-target="#record_audio"><i class="bx bx-microphone"></i></a>
                    </div>
                    <div class="replay-forms test overflow-visible">
                        <div class="reply-chats forward-chat-msgs reply-msg-div d-none">
                            <div class="contact-close_call text-end">
                                <a href="#" class="close-replay">
                                    <i class="bx bx-x"></i>
                                </a>
                            </div>
                            <div class="chat-avatar">
                                <img src="" id="reply-avatar" class="rounded-circle dreams_chat" alt="image">
                            </div>
                            <div class="chat-content">
                                <div class="chat-profile-name">
                                    <h6 id="reply-user-name"></h6>
                                </div>
                                <input type="hidden" name="selected-message" id="selected-message" value="">
                                <input type="hidden" name="selected-user" id="selected-user" value="">
                                <input type="hidden" name="replymsgType" id="replymsgType" value="">
                                <input type="hidden" name="replyattachmentBytes" id="replyattachmentBytes" value="">
                                <input type="hidden" name="replyattachmentUrl" id="replyattachmentUrl" value="">
                                <input type="hidden" name="combinationReplyUsers" id="combinationReplyUsers" value="">
                                <div class="message-content reply-content">
                                </div>
                            </div>
                        </div>
                        <input type="text" data-emojiable="true" class="form-control chat_form" id="chat_messages" placeholder="Type your message here...">
                    </div>
                    <input type="hidden" id="from_user" >
                    <input type="hidden" id="to_user" >
                    <input type="hidden" id="username" >
                    <input type="hidden" id="combination_user" >
                    <div class="form-buttons">
                        <button class="btn send-btn" type="button" onclick="sendMessage()">
                            <i class="bx bx-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Chat -->

        <!-- Right sidebar -->
        <div class="right-sidebar right_sidebar_profile right-side-contact hide-right-sidebar" id="middle1">
            <div class="right-sidebar-wrap active">
            <div class="slimscroll">
                    <div class="left-chat-title d-flex justify-content-between align-items-center border-bottom-0">
                        <div class="fav-title mb-0">
                            <h6><?php echo ($ul['homepage']['contact_info'])?$ul['homepage']['contact_info']: "Contact Info"; ?></h6>
                        </div>
                        <div class="contact-close_call text-end">
                            <a href="#"
                                class="close_profile close_profile4">
                                <span class="material-icons"><?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-body">
                        <div class="mt-0 right_sidebar_logo">
                            <div class="text-center right-sidebar-profile">
                                <figure class="avatar avatar-xl mb-3" id="sideprofileimg">
                                    <img src="" class="rounded-circle" alt="image">
                                </figure>
                                <h5 class="profile-name"></h5>
                                <div class="last-seen-profile">
                                   <!--  <span>last seen at 07:15 PM</span> -->
                                </div>
                                <div class="chat-options chat-option-profile">
                                    <ul class="list-inline">
                                        <li class="list-inline-item" >
                                            <a href="javascript:void(0);" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voice Call" onclick="onetoonenew('audio');">
                                                <i class="bx bx-phone" ></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item " >
                                            <a href="javascript:void(0);" class="btn btn-outline-light profile-open" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video Call" onclick="onetoonenew('video');">
                                                <i class="bx bx-video" ></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" >
                                            <a href="javascript:void(0)" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat" >
                                                <i class="bx bx-message-square-dots"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-member-details">
                                <div class="member-details">
                                    <ul>
                                        <li>
                                            <h5><?php echo ($ul['homepage']['info'])?$ul['homepage']['info']: "Info"; ?></h5>
                                        </li>
                                        <li>
                                            <h6 class="profile-name"></h6>
                                            <span id="sidestatus" class="user-status" ></span>
                                        </li>
                                        <li>
                                            <h6><?php echo ($ul['homepage']['phone'])?$ul['homepage']['phone']: "Phone"; ?></h6>
                                            <span id="sidephone"></span>
                                        </li>
                                        <li>
                                            <h6><?php echo ($ul['homepage']['email_address'])?$ul['homepage']['email_address']: "Email Address"; ?></h6>
                                            <span id="sideemail"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="right-sidebar-head share-media">
                        <div class="share-media-blk">
                            <h5><?php echo ($ul['homepage']['shared_media'])?$ul['homepage']['shared_media']: "Shared Media"; ?></h5>
                            <!-- <a href="javascript:;">View All</a> -->
                        </div>
                         <div class="about-media-tabs">       
                            <nav>
                                <div class="nav nav-tabs " id="nav-tab">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#info"><?php echo ($ul['homepage']['photos'])?$ul['homepage']['photos']: "Photos"; ?></a>
                                    <a class="nav-item nav-link" id="nav-profile-tab1" data-bs-toggle="tab" href="#Participants" ><?php echo ($ul['homepage']['videos'])?$ul['homepage']['videos']: "Videos"; ?></a>
                                    <a class="nav-item nav-link" id="nav-profile-tab2" data-bs-toggle="tab" href="#media" ><?php echo ($ul['homepage']['file'])?$ul['homepage']['file']: "File"; ?></a>
                                    <a class="nav-item nav-link" id="nav-profile-tab3" data-bs-toggle="tab" href="#link" ><?php echo ($ul['homepage']['link'])?$ul['homepage']['link']: "Link"; ?></a>
                                </div>
                            </nav>
                            <div class="tab-content pt-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="info">
                                    <ul class="nav share-media-img mb-0" id="side_media_list">
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="Participants">
                                    <ul class="nav share-media-img mb-0" id="attachment-documents">
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="media">
                                    <div class="media-file">
                                        <div class="media-doc-blk">
                                            <span><i class="bx bxs-file-doc"></i></span>
                                            <div class="document-detail">
                                            </div>
                                        </div>
                                        <div class="media-download">
                                            <a href="javascript:;"><i class="bx bx-download"></i></a>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="tab-pane fade" id="link">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="group-comman-theme">
                        <h6>2 Group in Common</h6>
                        <ul>
                            <li>
                                <div class="avatar">
                                    <img src="assets/img/avatar/avatar-14.png" class="rounded-circle" alt="image">
                                </div>
                                <div class="theme-content">
                                    <h6>Themeforest Group</h6>
                                    <p>Mark  Villiams, Elizabeth, Michael....</p>
                                </div>
                            </li>
                            <li>
                                <div class="avatar">
                                    <img src="assets/img/avatar/avatar-15.png" class="rounded-circle" alt="image">
                                </div>
                                <div class="theme-content">
                                    <h6>Graphic Designers</h6>
                                    <p>Mark  Villiams, Elizabeth, Michael....</p>
                                </div>
                            </li>
                        </ul>
                    </div> -->
                    <div class="chat-message-grp">
                        <ul>
                            <li>
                                <a href="javascript:;" onclick="blockUserModal();">
                                    <div class="stared-group">
                                        <span class="block-message"> <i class="bx bx-block"></i></span>
                                        <h6><?php echo ($ul['homepage']['block_user'])?$ul['homepage']['block_user']: "Block User"; ?></h6>
                                    </div>
                                    <div class="count-group">
                                        <i class="feather-chevron-right"></i>
                                    </div>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#report-user">
                                    <div class="stared-group">
                                        <span class="report-message"> <i class="bx bx-dislike"></i></span>
                                        <h6><?php echo ($ul['homepage']['report_user'])?$ul['homepage']['report_user']: "Report User"; ?></h6>
                                    </div>
                                    <div class="count-group">
                                        <i class="feather-chevron-right"></i>
                                    </div>
                                </a>
                            </li> -->
                            <li>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#delete-chat">
                                    <div class="stared-group">
                                        <span class="delete-message"> <i class="bx bx-trash"></i></span>
                                        <h6><?php echo ($ul['homepage']['delete_chat'])?$ul['homepage']['delete_chat']: "Delete Chat"; ?></h6>
                                    </div>
                                    <div class="count-group">
                                        <i class="feather-chevron-right"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right sidebar -->

        <!-- Star Message Right sidebar -->
        <div class="right-sidebar right_side_star hide-right-sidebar" id="middle2">
            <div class="right-sidebar-wrap active">
            <div class="slimscroll">
                    <div class="left-chat-title d-flex justify-content-between align-items-center border-bottom-0">
                        <div class="fav-title mb-0">
                            <h6><a href="#" class="remove-star-message"><img src="assets/img/icon/arrow-left.svg" class="me-2" alt="Icon"></a><?php echo ($ul['homepage']['starred_messages'])?$ul['homepage']['starred_messages']: "Starred Messages"; ?></h6>
                        </div>
                        <div class="star-drop">
                            <a class="btn btn-outline-light" href="#" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" >
                                <a href="#" class="dropdown-item "><span><i class="feather-star"></i></span><?php echo ($ul['homepage']['unstar_all'])?$ul['homepage']['unstar_all']: "Unstar All"; ?> </a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-body chat star-chat-group">
                        <div class="chat-body">
                            <div class="messages">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Star Message Right sidebar -->

        <!-- Message Info Right sidebar -->
        <div class="right-sidebar right_sidebar_info hide-right-sidebar" id="middle3">
            <div class="right-sidebar-wrap active">
            <div class="slimscroll">
                    <div class="left-chat-title d-flex justify-content-between align-items-center border-bottom-0">
                        <div class="fav-title mb-0">
                            <h6><a href="#" class="remove-message-info"><img src="assets/img/icon/arrow-left.svg" class="me-2" alt="Icon"></a><?php echo ($ul['homepage']['messages_info'])?$ul['homepage']['messages_info']: "Messages Info"; ?> </h6>
                        </div>
<!--                                 <a href="#" class="dropdown-item "><span><i class="bx bx-x" ></i></span><?php echo ($ul['homepage']['close_chat'])?$ul['homepage']['close_chat']: "Close Chat"; ?> </a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mute-notification"><span><i class="bx bx-volume-mute"></i></span><?php echo ($ul['homepage']['mute_notification'])?$ul['homepage']['mute_notification']: "Mute Notification"; ?></a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disappearing-messages"><span><i class="bx bx-time-five"></i></span><?php echo ($ul['homepage']['disappearing_message'])?$ul['homepage']['disappearing_message']: "Disappearing Message"; ?></a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#clear-chat"></a>><span><i class="bx bx-brush-alt"></i></span><?php echo ($ul['homepage']['clear_message'])?$ul['homepage']['clear_message']: "Clear Message"; ?></a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change-chat"><span><i class="bx bx-trash-alt"></i></span><?php echo ($ul['homepage']['delete_chat'])?$ul['homepage']['delete_chat']: "Delete Chat"; ?></a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span><?php echo ($ul['homepage']['report'])?$ul['homepage']['report']: "Report"; ?></a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#block-user"><span><i class="bx bx-block"></i></span><?php echo ($ul['homepage']['block'])?$ul['homepage']['block']: "Block"; ?></a> -->
                    </div>
                    <div class="sidebar-body chat star-chat-group">
                        <div class="chat-body">
                            <div class="messages">
                                <div class="message-info-box">
                                    <h6><span class="material-icons check-active"><?php echo ($ul['homepage']['doneall'])?$ul['homepage']['doneall']: "done_all"; ?></span><?php echo ($ul['homepage']['read'])?$ul['homepage']['read']: "Read"; ?></h6>
                                    <span id="read-time">--</span>
                                </div>
                                <div class="message-info-box">
                                    <h6><span class="material-icons check"><?php echo ($ul['homepage']['doneall'])?$ul['homepage']['doneall']: "done_all"; ?></span><?php echo ($ul['homepage']['delivered'])?$ul['homepage']['delivered']: "Delivered"; ?></h6>
                                    <span><?php echo ($ul['homepage']['today_at_7:09_am'])?$ul['homepage']['today_at_7:09_am']: "Today at 7:09 AM"; ?></span>
                                </div>
                                <div class="message-info-box">
                                    <h6><i class="feather-check sent"></i><?php echo ($ul['homepage']['sent'])?$ul['homepage']['sent']: "Sent"; ?></h6>
                                    <span><?php echo ($ul['homepage']['today_at_7:09_am'])?$ul['homepage']['today_at_7:09_am']: "Today at 7:09 AM"; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Message Right sidebar -->

    </div> 
    <!-- /Content -->

    <!-- Mute -->
    <div class="modal fade mute-notify" id="mute-notification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                       <?php echo ($ul['homepage']['mute_notifications'])?$ul['homepage']['mute_notifications']: "Mute Notifications"; ?>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"> <?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="notify-check">
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me"><?php echo ($ul['homepage']['15_minutes'])?$ul['homepage']['15_minutes']: "15 Minutes"; ?></span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me"><?php echo ($ul['homepage']['1_hour'])?$ul['homepage']['1_hour']: "1 Hour"; ?></span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me"><?php echo ($ul['homepage']['1_day'])?$ul['homepage']['1_day']: "1 Day"; ?></span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me"><?php echo ($ul['homepage']['1_week'])?$ul['homepage']['1_week']: "1 Week"; ?></span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me"><?php echo ($ul['homepage']['1_month'])?$ul['homepage']['1_month']: "1 Month"; ?></span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me"><?php echo ($ul['homepage']['always'])?$ul['homepage']['always']: "Always"; ?></span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <?php echo ($ul['homepage']['mute'])?$ul['homepage']['mute']: "Mute"; ?>
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /Mute -->

    <!-- Block -->
    <div class="modal fade" id="block-user">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="block-user-name">
                        <?php echo ($ul['homepage']['block'])?$ul['homepage']['block']: "Block"; ?>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"><?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <i class="bx bx-block change-color "></i>
                        <p><?php echo ($ul['homepage']['blocked_contacts_will'])?$ul['homepage']['blocked_contacts_will']: "Blocked contacts will no longer be able to call you or send you messages."; ?></p>
                    </div>
                    <div class="mute-chat-btn justify-content-center">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" onclick="block_chat();">
                         <?php echo ($ul['homepage']['block'])?$ul['homepage']['block']: "Block"; ?>
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /Block -->

    <!-- Report -->
    <div class="modal fade" id="report-user">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                          <?php echo ($ul['homepage']['report_mark_villiams'])?$ul['homepage']['report_mark_villiams']: "Report Mark Villiams"; ?>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"> <?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <img src="assets/img/icon/report-01.svg"  alt="icon">
                        <p> <?php echo ($ul['homepage']['if_you_block_this'])?$ul['homepage']['if_you_block_this']: "If you block this contact and clear the chat, messages will only be removed from this device and your devices on the newer versions of Dreamschat"; ?></p>
                        <div class="notify-check">
                            <div class="form-check d-flex align-items-center justify-content-center ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"> <?php echo ($ul['homepage']['report_contact'])?$ul['homepage']['report_contact']: "Report Contact"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mute-chat-btn justify-content-center">                           
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                              <?php echo ($ul['homepage']['report'])?$ul['homepage']['report']: "Report"; ?>
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /Report -->

    <!-- Delete -->
    <div class="modal fade" id="delete-chat">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                       <?php echo ($ul['homepage']['delete_chat'])?$ul['homepage']['delete_chat']: "Delete Chat"; ?>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"><?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <i class="bx bx-trash change-color "></i>
                        <p><?php echo ($ul['homepage']['clearing_or_deleting'])?$ul['homepage']['clearing_or_deleting']: ""; ?></p>
                    </div>
                    <div class="mute-chat-btn justify-content-center">
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                              <?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" onclick="clearUserChat();">
                             <?php echo ($ul['homepage']['continue'])?$ul['homepage']['continue']: "Continue"; ?>
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /Delete -->

    <!-- Disappearing Messages -->
    <div class="modal fade" id="disappearing-messages">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                         <?php echo ($ul['homepage']['disappearing_messages'])?$ul['homepage']['disappearing_messages']: "Disappearing messages"; ?>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"><?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk">
                        <p><?php echo ($ul['homepage']['for_more_privacy_and_storange'])?$ul['homepage']['for_more_privacy_and_storange']: "For more privacy and storage, all new messages will disappear from this chat for everyone after the selected duration, except when kept. Anyone in the chat can change this setting."; ?></p>
                        <div class="notify-check">
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['homepage']['24_hours'])?$ul['homepage']['24_hours']: "24 Hours"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['homepage']['7_days'])?$ul['homepage']['7_days']: "7 Days"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['homepage']['90_days'])?$ul['homepage']['90_days']: "90 Days"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['homepage']['off'])?$ul['homepage']['off']: "Off"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                             <?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <?php echo ($ul['homepage']['save'])?$ul['homepage']['save']: "Save"; ?>
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /Disappearing Messages -->

    <!-- Deleting a Chat -->
    <div class="modal fade" id="change-chat">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <?php echo ($ul['homepage']['delete_chat'])?$ul['homepage']['delete_chat']: "Delete Chat"; ?>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"> <?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <i class="bx bx-trash change-color "></i>
                        <p><?php echo ($ul['homepage']['clearing-or-deleting'])?$ul['homepage']['clearing-or-deleting']: ""; ?></p>
                    </div>
                    <div class="mute-chat-btn justify-content-center">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                           <?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                             <?php echo ($ul['homepage']['delete'])?$ul['homepage']['delete']: "Delete"; ?>
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /Deleting a Chat -->

     <!--Clear Chat -->
     <div class="modal fade" id="clear-chat">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <?php echo ($ul['homepage']['clear_chat'])?$ul['homepage']['clear_chat']: "Clear Chat"; ?>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">  <?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <i class="bx bx-trash change-color "></i>
                        <p><?php echo ($ul['homepage']['clearing_or_deleting'])?$ul['homepage']['clearing_or_deleting']: ""; ?></p>
                    </div>
                    <div class="mute-chat-btn justify-content-center">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                             <?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" onclick="clearUserChat();">
                             <?php echo ($ul['homepage']['clear'])?$ul['homepage']['clear']: "Clear"; ?>
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /Clear a Chat -->

    <!-- Forward Message To -->
    <div class="modal fade " id="forward-message">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <?php echo ($ul['homepage']['forward_message_to'])?$ul['homepage']['forward_message_to']: "Forward Message To"; ?>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"> <?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-block-group mb-4">
                        <div class="search_chat has-search">
                            <span class="fas fa-search form-control-feedback"></span>
                            <input class="form-control chat_input" id="search-contacts" type="text" placeholder="Search">
                        </div>
                        <h5><?php echo ($ul['homepage']['recent_chats'])?$ul['homepage']['recent_chats']: "Recent Chats"; ?></h5>
                        <div class="forward-message-users-list sroll-side-view">
                        </div>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x me-1"></i><?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" onclick="sendForwardMessages();">
                            <img src="assets/img/icon/send.svg" class="me-1" alt="image"><?php echo ($ul['homepage']['send'])?$ul['homepage']['send']: "Create Chat"; ?>
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /Forward Message To -->


         <!-- Forward Message To -->
         <div class="modal fade " id="delete-message">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content delete-model-head">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['homepage']['delete_message'])?$ul['homepage']['delete_message']: "Delete Message"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="deleteMsgKey" id="deleteMsgKey" value="">
                        <div class="notify-check delete-chat-notify">
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['homepage']['delete_for_me'])?$ul['homepage']['delete_for_me']: "Delete for Me"; ?></span>
                                    <input type="checkbox" name="deleteType[]" id="deleteType" value="me">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['homepage']['delete_for_everyone'])?$ul['homepage']['delete_for_everyone']: "Delete for Everyone"; ?></span>
                                    <input type="checkbox" name="deleteType[]" id="deleteType" value="all">                               
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>  
                        <div class="mute-chat-btn delete-pop-btn justify-content-end">                                
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="close">
                                <i class="feather-x me-1"></i><?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="deleteselectedchat();">
                                <img src="assets/img/icon/send.svg" class="me-1" alt="image">
                                <?php echo ($ul['homepage']['delete'])?$ul['homepage']['delete']: "Delete"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Forward Message To -->

        <!-- /Image Upload -->
         <div class="modal fade " id="upload-images">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content delete-model-head">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?php echo ($ul['homepage']['image_upload'])?$ul['homepage']['image_upload']: "Image Upload"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="notify-check delete-chat-notify">
                            <div class="row">
                                <span class="btn newgroup_create m-0 file_posti">
                                    <input type="file" id="wallpaper" accept="image/x-png,image/gif,image/jpeg">
                                </span>
                            </div>
                        </div>  
                        <div class="mute-chat-btn delete-pop-btn justify-content-end">                                
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="handleFileUpload();">
                                <img src="assets/img/icon/send.svg" class="me-1" alt="image"><?php echo ($ul['homepage']['delete'])?$ul['homepage']['delete']: "Delete"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Image Upload -->


    <!-- New Chat -->
    <div class="modal fade " id="new-chat">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                       <?php echo ($ul['homepage']['new_chat'])?$ul['homepage']['new_chat']: "New Chat"; ?>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"><?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?>
  </span>
                    </button>
                </div>
                <div class="empty-users d-none">Contact users not found, Kindly create new contact in your Contact Module.</div>
                <div class="modal-body empty-users-body">
                    <div class="user-block-group mb-4">
                        <div class="search_chat has-search">
                            <span class="fas fa-search form-control-feedback"></span>
                            <input class="form-control chat_input" id="search-contacts-user" type="text" placeholder="Search">
                        </div>
                        <h5><?php echo ($ul['homepage']['contacts'])?$ul['homepage']['contacts']: "Contacts"; ?></h5>
                        <div class="sidebar sroll-side-view">
                            <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                <!-- <div class="fav-title contact-title">
                                    <h6>A</h6>
                                </div> -->
                            </div>
                            <ul class="user-list contact-user-list" id="contact-user-list">
                            </ul>
                        </div>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x me-1"></i><?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" id="add-new-friend" onclick="addFriend()">
                            <img src="assets/img/icon/send.svg" class="me-1" alt="image"><?php echo ($ul['homepage']['send'])?$ul['homepage']['send']: "Send"; ?>
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /New Chat -->
<!-- Upload Documents -->
         <div class="modal fade" id="drag_files">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['homepage']['drag_and_drop'])?$ul['homepage']['drag_and_drop']: "Drag and Drop or Upload Files"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['homepage']['close'])?$ul['homepage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="file-drop mb-4">
                            <form action="#" class="dropzone dz-clickable">
                                <div id="drop-zone-file-status">
                                    <img src="assets/img/icon/drag-file.svg" class="img-fluid" alt="upload">
                                    <p><?php echo ($ul['homepage']['drag_and_drop'])?$ul['homepage']['drag_and_drop']: "Drag & drop your files here or choose file"; ?></p>
                                    <span><?php echo ($ul['homepage']['drag_and_drop'])?$ul['homepage']['maximum_size_50MB']:"Maximum size: 50MB"; ?></span>
                                    <div class="dz-default dz-message"><span><?php echo ($ul['homepage']['drop_files'])?$ul['homepage']['drop_files']:"Drop files here to upload"; ?></span>
                                        <span>Drop files here to upload</span>
                                        <input type="file"id="drop-zone-filesss" name="files[]" multiple>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="file-drop mb-4">
                            <input type="file" name="user-status" id="user-status">
                            <br>
                            <!-- <img id="previewImage" alt="Preview" style="max-width: 200px; max-height: 200px;"> -->
                        </div>
                        <div class="mute-chat-btn ">
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']:"Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" id="send-attachement">
                                <i class="feather-arrow-right me-1"></i><?php echo ($ul['homepage']['submit'])?$ul['homepage']['submit']:"Submit"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div> 
        <!-- <div id="drag_filesww" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo ($ul['homepage']['drag_and_drop_or'])?$ul['homepage']['drag_and_drop_or']:"Drag and drop or upload files"; ?></h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <center><?php echo ($ul['homepage']['max_upload_size'])?$ul['homepage']['max_upload_size']:" Max upload size - 2Mb"; ?>)  </center>
                        <form id="js-upload-form" class="box" method="post" action="" enctype="multipart/form-data">
                            <div id="drop-zone">
                                <div class="drop-zone-caption upload-drop-zone" >
                                <i class="fa fa-cloud-upload fa-2x"></i> <span class="upload-text"> <?php echo ($ul['homepage']['just_drag_and_drop_files'])?$ul['homepage']['just_drag_and_drop_files']:"Just drag and drop files here"; ?></span>
                                </div>
                                <div class="text-center mt-0">
                                <span class="btn newgroup_create m-0 file_posti">
                                    <span><?php echo ($ul['homepage']['choose_files'])?$ul['homepage']['choose_files']:"Choose files"; ?>&nbsp;&nbsp;&nbsp;</span>
                                    <input type="file"id="drop-zone-filesss" name="files[]" multiple>
                                </span>
                                </div>
                                <div id="imagePreview">
                                  <img id="previewImage" src="#" alt="Preview">
                                </div>
                            </div>
                            <div class="mute-chat-btn ">
                            <a class="btn btn-primary" id="send-attachement">
                                <i class="feather-arrow-right me-1"></i><?php echo ($ul['homepage']['submit'])?$ul['homepage']['submit']:"Submit"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['homepage']['cancel'])?$ul['homepage']['cancel']:"Cancel"; ?>
                            </a>
                        </div>
                        </form> 
                        
                    </div>
                </div>
            </div>
        </div> -->
        <!-- /Upload Documents -->
        <!--Voice Modal-->
        <div class="modal fade" id="record_audio">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['homepage']['voice_message'])?$ul['homepage']['voice_message']:"Voice Message"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times close_icon"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="center-align">
                                <audio controls id="audio"></audio>
                                <br>
                                <button type="button" class="btn btn-warning btn-sm" id="startRecording"><?php echo ($ul['homepage']['start'])?$ul['homepage']['start']:"Start"; ?></button>
                                <button type="button" class="btn btn-dark btn-sm" id="stopRecording" disabled><?php echo ($ul['homepage']['stop'])?$ul['homepage']['stop']:"Stop"; ?></button>

                                <button type="button" class="btn btn-info btn-sm" id="send_voice" disabled><?php echo ($ul['homepage']['send'])?$ul['homepage']['send']:"Send"; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Voice Modal-->

</div>
<!-- /Main Wrapper -->  
<?php $this->load->view('includes/footer'); ?>	
