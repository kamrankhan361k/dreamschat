<?php
$session = $this->session->userdata('username');
$lang = ($session['language'] != '')?$session['language']:'En';
$ul = custom_language($session['user'], $lang);
//print_r($ul);
//exit;
?>
<?php 
$this->load->view('includes/header'); 
/*$session = $this->session->userdata('username');
$ul = custom_language($session['user'], $session['language']);*/
?>

<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- content -->
    <div class="content main_content">
        <?php 
            $this->load->view('includes/leftsidebar'); 
            $this->load->view('includes/sidebar-group');
        ?>

            <!-- Chat -->
            <div class="chat" id="middle">
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
                            <figure class="avatar ms-1" id="groupnav-profile">
                            </figure>
                            <div class="mt-1">
                                <h5 id="selected_username"></h5>
                                <small class="last-seen" id="last-seen">
                                </small>
                            </div>
                        </div>
                        <div class="avatar-group" id="append_images">
                           
                        </div>
                        <div class="chat-options ">
                            <ul class="list-inline">
                                <li class="list-inline-item" >
                                    <a href="javascript:void(0)" class="btn btn-outline-light chat-search-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Search">
                                        <i class="bx bx-search" ></i>
                                    </a>
                                </li>
                                <li class="list-inline-item" >
                                    <a href="javascript:void(0);" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video Call"  onclick="selectusers('video');">
                                        <i class="bx bx-video" ></i>
                                    </a>
                                </li>
                                <li class="list-inline-item" >
                                    <a href="javascript:void(0);" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom"  data-original-title="Voice Call" onclick="selectusers('audio');">
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
                                        <i class="bx bx-dots-horizontal-rounded" ></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" >
                                        <a href="#" class="dropdown-item "><span><i class="bx bx-x" ></i></span><?php echo ($ul["grouppage"]["close_chat"])?$ul["grouppage"]["close_chat"]:"Close Chat";?></a>
                                        <a href="#" class="dropdown-item" onclick="delete_chat()"><span><i class="bx bx-brush-alt"></i></span><?php echo ($ul["grouppage"]["clear_message"])?$ul["grouppage"]["clear_message"]: "Clear Message"; ?></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Chat Search -->
                        <div class="chat-search">
                            <form>
                                <span class="form-control-feedback"><i class="bx bx-search" ></i></span>
                                <input type="text" id="search-group-chats" name="chat-search" placeholder="Search Chats" class="form-control">
                                <div class="close-btn-chat"><span class="material-icons"><?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span></div>
                            </form>
                        </div>
                        <!-- /Chat Search -->
                    </div>
                    <div class="chat-body slimscroll">
                        <div class="messages" id="messages_groupdiv">
                            
                        </div>
                    </div>
                </div>
                <div class="chat-footer">
                    <form>
                        <input type="hidden" id="from_usergroup" >
                        <input type="hidden" id="to_usergroup" >
                        <div class="smile-foot">
                            <div class="chat-action-btns">
                                <div class="chat-action-col">
                                    <a class="action-circle" href="#" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" >
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#drag_files"><span><i class="bx bx-image"></i></span><?php echo ($ul['grouppage']['gallery'])?$ul['grouppage']['gallery']: "Gallery"; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="smile-foot emoj-action">
                            <a href="#" class="action-circle"><i class="bx bx-smile"></i></a>
                        </div>
                        <div class="smile-foot">
                            <a href="#"  class="action-circle"  data-bs-toggle="modal" data-bs-target="#record_audio"><i class="bx bx-microphone-off"></i></a>
                        </div>
                        <input type="text" data-emojiable="true" id="chat_message" class="form-control chat_form" placeholder="Type your message here...">
                        <div class="form-buttons">
                            <button class="btn send-btn" type="button" onclick="sendGroupMessage()">
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
                                <h6><?php echo ($ul["grouppage"]["group_info"])?$ul["grouppage"]["group_info"]:"Group Info"; ?></h6>
                            </div>
                            <div class="contact-close_call text-end">
                                <a href="#"
                                    class="close_profile close_profile4">
                                    <span class="material-icons"><?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="sidebar-body">
                            <div class="mt-0 right_sidebar_logo">
                                <div class="text-center right-sidebar-profile">
                                    <figure class="avatar avatar-xl mb-3" id="sideprofileimg">
                                        <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="image">
                                    </figure>
                                    <h5 class="profile-name"></h5>
                                    <div class="last-seen-profile">
                                        <span id="rightside_member_count_text"><?php echo ($ul['grouppage']['group'])?$ul['grouppage']['group']: "Group :"; ?></span>
                                    </div>
                                    <div class="chat-options chat-option-profile">
                                        <ul class="list-inline">
                                            <li class="list-inline-item" >
                                                <a href="javascript:void(0);" class="btn btn-outline-light " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voice Call"  onclick="selectusers('audio');">
                                                    <i class="bx bx-phone" ></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item " >
                                                <a href="javascript:void(0);" class="btn btn-outline-light profile-open" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video Call"  onclick="selectusers('video');">
                                                    <i class="bx bx-video" ></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" >
                                                <a href="javascript:void(0)" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat">
                                                    <i class="bx bx-message-square-dots"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="group-description">
                                    <div class="description-sub">
                                        <h5><?php echo ($ul['grouppage']['group_description'])?$ul['grouppage']['group_description']: "Group Description"; ?><span><a hre="javascript:;" onclick="getGroupDetails();"><i class="bx bx-pencil"></i></a></span></h5>
                                        <p id="group-desc"><?php echo ($ul['grouppage']['lorem_ipsum'])?$ul['grouppage']['lorem_ipsum']: "Lorem ipsum dolor sit amet, consectetur adipiscing elit,"; ?></p>
                                        <p class="description-date" id="description-date"><?php echo ($ul['grouppage']['group_created_james'])?$ul['grouppage']['group_created_james']: "Group created by James Albert, on 18 Feb 2022 at 1:32 pm"; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="right-sidebar-head share-media">
                            <div class="share-media-blk">
                                <h5><?php echo ($ul['grouppage']['shared_media'])?$ul['grouppage']['shared_media']: "Shared Media"; ?></h5>
                               <!--  <a href="javascript:;">View All</a> -->
                            </div>
                             <div class="about-media-tabs">       
                                <nav>
                                    <div class="nav nav-tabs " id="nav-tab">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#info"><?php echo ($ul['grouppage']['photos'])?$ul['grouppage']['photos']: "Photos"; ?></a>
                                        <a class="nav-item nav-link" id="nav-profile-tab1" data-bs-toggle="tab" href="#Participants"><?php echo ($ul['grouppage']['videos'])?$ul['grouppage']['videos']: "Videos"; ?></a>
                                        <a class="nav-item nav-link" id="nav-profile-tab2" data-bs-toggle="tab" href="#media"><?php echo ($ul['grouppage']['file'])?$ul['grouppage']['file']: "File"; ?></a>
                                        <a class="nav-item nav-link" id="nav-profile-tab3" data-bs-toggle="tab" href="#link"><?php echo ($ul['grouppage']['link'])?$ul['grouppage']['link']: "Link"; ?></a>
                                    </div>
                                </nav>
                                <div class="tab-content pt-0" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="info">
                                        <ul class="nav share-media-img mb-0" id="side-media-list">
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
                        
                        <div class="participants-list">
                            <div class="participants-list-group">
                                <h6 id="rightside_member_count_texts"><span class="parti-search"><i class="bx bx-search"></i></span></h6>
                                <ul class="user-listss mt-2" id="side_member_list">
                
                                </ul>
                                <div class="text-left group-view-all">
                                    <!-- <a href="#" class="load-more-btn">View all</a> -->
                                </div>
                            </div>
                       </div>
                       <div class="chat-message-grp group-exits">
                            <ul>
                                <li>
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#exit-group" >
                                        <div class="stared-group">
                                            <span class="exit-bg-message"> <i class="bx bx-log-out"></i></span>
                                            <h6><?php echo ($ul['grouppage']['exit_group'])?$ul['grouppage']['exit_group']: "Exit Group"; ?></h6>
                                        </div>
                                        <div class="count-group">
                                            <i class="feather-chevron-right"></i>
                                        </div>
                                    </a>
                                </li>
                                <li id="addmember">
 
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right sidebar -->

            <!-- Group Setting -->
            <div class="right-sidebar right_side_star hide-right-sidebar" id="middle2">
                <div class="right-sidebar-wrap active">
                <div class="slimscroll">
                        <div class="left-chat-title d-flex justify-content-between align-items-center border-bottom-0">
                            <div class="fav-title mb-0">
                                <h6><a href="#" class="remove-star-message"><img src="assets/img/icon/arrow-left.svg" class="me-2" alt="Icon"></a><?php echo ($ul['grouppage']['group_setting'])?$ul['grouppage']['group_setting']: "Group Setting"; ?></h6>
                            </div>
                            <div class="star-drop">
                                <a class="btn btn-outline-light" href="#" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-horizontal-rounded" ></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" >
                                    <a href="#" class="dropdown-item"><span><i class="bx bx-x" ></i></span> <?php echo ($ul['grouppage']['close_chat'])?$ul['grouppage']['close_chat']: "Close Chat"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mute-notification"><span><i class="bx bx-volume-mute"></i></span> <?php echo ($ul['grouppage']['mute_notification'])?$ul['grouppage']['mute_notification']: "Mute Notification"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disappearing-messages"><span><i class="bx bx-time-five"></i></span><?php echo ($ul['grouppage']['disappearing_message'])?$ul['grouppage']['disappearing_message']: "Disappearing Message"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#clear-chat"><span><i class="bx bx-brush-alt"></i></span><?php echo ($ul['grouppage']['clear_message'])?$ul['grouppage']['clear_message']: "Clear Message"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change-chat"><span><i class="bx bx-trash-alt"></i></span><?php echo ($ul['grouppage']['delete_chat'])?$ul['grouppage']['delete_chat']: "Delete Chat"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span><?php echo ($ul['grouppage']['report'])?$ul['grouppage']['report']: "Report"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#block-user"><span><i class="bx bx-block"></i></span><?php echo ($ul['grouppage']['block'])?$ul['grouppage']['block']: "Block"; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-body group-setting">
                            <div class="chat-message-grp">
                                <ul>
                                    <li>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#edit-group">
                                            <div class="stared-group">
                                                <span class="disapper-message"> <img src="assets/img/icon/edit-group.svg" alt="icon"></span>
                                                <div class="edit-set-details">
                                                    <h6><?php echo ($ul['grouppage']['edit_group_settings'])?$ul['grouppage']['edit_group_settings']: "Edit Group Settings"; ?></h6>
                                                    <p><?php echo ($ul['grouppage']['all_participants'])?$ul['grouppage']['all_participants']: "All Participants"; ?></p>
                                                </div>
                                            </div>
                                            <div class="count-group">
                                                <i class="feather-chevron-right"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#send-message">
                                            <div class="stared-group">
                                                <span class="group-send-msg"> <img src="assets/img/icon/send-message.svg" alt="icon"></span>
                                                <div class="edit-set-details">
                                                    <h6><?php echo ($ul['grouppage']['send_messages'])?$ul['grouppage']['send_messages']: "Send Messages"; ?></h6>
                                                    <p><?php echo ($ul['grouppage']['all_participants'])?$ul['grouppage']['all_participants']: "All Participants"; ?></p>
                                                </div>
                                            </div>
                                            <div class="count-group">
                                                <i class="feather-chevron-right"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#edit-admin">
                                            <div class="stared-group">
                                                <span class="mute-message"> <img src="assets/img/icon/users-group.svg" alt="icon"></span>
                                                <div class="edit-set-details">
                                                    <h6><?php echo ($ul['grouppage']['edit_group_admins'])?$ul['grouppage']['edit_group_admins']: "Edit Group Admins"; ?></h6>
                                                </div>
                                            </div>
                                            <div class="count-group">
                                                <i class="feather-chevron-right"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#approve-participant">
                                            <div class="stared-group">
                                                <span class="report-message"> <img src="assets/img/icon/group-checked.svg" alt="icon"></span>
                                                <div class="edit-set-details">
                                                    <h6><?php echo ($ul['grouppage']['approve_new_participants'])?$ul['grouppage']['approve_new_participants']: "Approve New Participants"; ?></h6>
                                                    <p><?php echo ($ul['grouppage']['off'])?$ul['grouppage']['off']: "Off"; ?></p>
                                                </div>
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
            </div>
            <!-- Group Setting -->

            <!-- Message Info Right sidebar -->
            <div class="right-sidebar right_sidebar_info hide-right-sidebar" id="middle3">
                <div class="right-sidebar-wrap active">
                <div class="slimscroll">
                        <div class="left-chat-title d-flex justify-content-between align-items-center border-bottom-0">
                            <div class="fav-title mb-0">
                                <h6><a href="#" class="remove-message-info"><i class="bx bx-arrow-back me-2"></i></a><?php echo ($ul['grouppage']['messages_info'])?$ul['grouppage']['messages_info']: "Messages Info"; ?></h6>
                            </div>
                            <div class="star-drop">
                                <a class="btn btn-outline-light" href="#" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" >
                                    <a href="#" class="dropdown-item "><span><i class="bx bx-x" ></i></span><?php echo ($ul['grouppage']['close_chat'])?$ul['grouppage']['close_chat']: "Close Chat"; ?> </a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mute-notification"><span><i class="bx bx-volume-mute"></i></span><?php echo ($ul['grouppage']['mute_notification'])?$ul['grouppage']['mute_notification']: "Mute Notification"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disappearing-messages"><span><i class="bx bx-time-five"></i></span><?php echo ($ul['grouppage']['disappearing_message'])?$ul['grouppage']['disappearing_message']: "Disappearing Message"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#clear-chat"><span><i class="bx bx-brush-alt"></i></span><?php echo ($ul['grouppage']['clear_message'])?$ul['grouppage']['clear_message']: "Clear Message"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change-chat"><span><i class="bx bx-trash-alt"></i></span><?php echo ($ul['grouppage']['delete_chat'])?$ul['grouppage']['delete_chat']: "Delete Chat"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span><?php echo ($ul['grouppage']['report'])?$ul['grouppage']['report']: "Report"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#block-user"><span><i class="bx bx-block"></i></span><?php echo ($ul['grouppage']['block'])?$ul['grouppage']['block']: "Block"; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-body chat star-chat-group">
                            <div class="chat-body">
                                <div class="messages">
                                    <div class="chats">
                                        <div class="chat-avatar ps-0">
                                            <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                                        </div>
                                        <div class="chat-content">
                                            <div class="chat-profile-name">
                                                <h6><?php echo ($ul['grouppage']['mark_villiams'])?$ul['grouppage']['mark_villiams']: "Mark Villiams"; ?><span><?php echo ($ul['grouppage']['8:16_PM'])?$ul['grouppage']['8:16_PM']: "8:16 PM"; ?></span></h6>
                                                <div class="chat-action-btns ms-3">
                                                    <div class="chat-action-col">
                                                        <a class="#" href="#" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                                        </a>
                                                        <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                            <a href="#" class="dropdown-item "><span><i class="bx bx-info-circle"></i></span><?php echo ($ul['grouppage']['message_info'])?$ul['grouppage']['message_info']: "Message Info"; ?> </a>
                                                            <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span><?php echo ($ul['grouppage']['reply'])?$ul['grouppage']['reply']: "Reply"; ?> </a>
                                                            <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span><?php echo ($ul['grouppage']['react'])?$ul['grouppage']['react']: "React"; ?> </a>
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span><?php echo ($ul['grouppage']['forward'])?$ul['grouppage']['forward']: "Forward"; ?></a>
                                                            <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span><?php echo ($ul['grouppage']['star_message'])?$ul['grouppage']['star_message']: "Star Message"; ?></a>
                                                            <a href="#" class="dropdown-item"><span><i class="bx bx-dislike"></i></span><?php echo ($ul['grouppage']['report'])?$ul['grouppage']['report']: "Report"; ?></a>
                                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span><?php echo ($ul['grouppage']['delete'])?$ul['grouppage']['delete']: "Delete"; ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="message-content fancy-msg-box">
                                                <div class="download-col">
                                                    <ul class="nav mb-0">
                                                        <li>
                                                            <div class="image-download-col">
                                                                <a href="assets/img/media/media-01.jpg" data-fancybox="gallery" class="fancybox">
                                                                    <img src="assets/img/media/media-01.jpg" alt="">
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="image-download-col ">
                                                                <a href="assets/img/media/media-02.jpg" data-fancybox="gallery" class="fancybox">
                                                                    <img src="assets/img/media/media-02.jpg" alt="">
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-info-box">
                                        <h6><span class="material-icons check-active"><?php echo ($ul['grouppage']['doneall'])?$ul['grouppage']['doneall']: "done_all"; ?></span><?php echo ($ul['grouppage']['read'])?$ul['grouppage']['read']: "Read"; ?></h6>
                                        <span>Today at 7:12 AM</span>
                                    </div>
                                    <div class="message-info-box">
                                        <h6><span class="material-icons check"><?php echo ($ul['grouppage']['doneall'])?$ul['grouppage']['doneall']: "done_all"; ?></span><?php echo ($ul['grouppage']['delivered'])?$ul['grouppage']['delivered']: "Delivered"; ?></h6>
                                        <span>Today at 7:09 AM</span>
                                    </div>
                                    <div class="message-info-box">
                                        <h6><i class="feather-check sent"></i><?php echo ($ul['grouppage']['sent'])?$ul['grouppage']['sent']: "Sent"; ?></h6>
                                        <span>Today at 7:09 AM</span>
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
        
        <!-- Send Messages -->
        <div class="modal fade mute-notify" id="send-message">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                          <?php echo ($ul['grouppage']['send_messages'])?$ul['grouppage']['send_messages']: "Send Messages"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="notify-check">
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['grouppage']['all_participants'])?$ul['grouppage']['all_participants']: "All Participants"; ?></span>
                                    <input type="checkbox" name="remeber" checked>                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['grouppage']['only_admins'])?$ul['grouppage']['only_admins']: "Only admins"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mute-chat-btn">
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['grouppage']['confirm'])?$ul['grouppage']['confirm']: "Confirm"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Send Messages -->

        <!-- Exit UI UX Designer Group? -->
        <div class="modal fade " id="exit-group">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                         <?php echo ($ul['grouppage']['are_you_sure'])?$ul['grouppage']['are_you_sure']: "Are you sure to exit this gorup? "; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="notify-check parcipant-check">
                            <p><?php echo ($ul['grouppage']['only_group_admins'])?$ul['grouppage']['only_group_admins']: "Only group admins will be notified that you left the group."; ?></p>
                            
                        </div>
                        <div class="mute-chat-btn">
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" onclick="exit_group()">
                               <?php echo ($ul["grouppage"]["exit_group"])?$ul["grouppage"]["exit_group"]: "Exit group"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                 <?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Exit UI UX Designer Group? -->

        <!-- Remove UI UX Designer Group? -->
        <div class="modal fade " id="remove-group">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                       
                         <?php echo ($ul['grouppage']['are_you_sure_to_remove'])?$ul['grouppage']['are_you_sure_to_remove']: "Are you sure to remove this participant from this gorup?"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="notify-check parcipant-check">
                            <p><?php echo ($ul['grouppage']['only_group_admin_will_notified'])?$ul['grouppage']['only_group_admin_will_notified']: "Only group admins will be notified that you left the group."; ?></p>
                            
                        </div>
                        <div class="mute-chat-btn">
                            <input type="hidden" name="remove-parti-id" id="remove-parti-id" value="">
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" onclick="remove_group_member_confirm()">
                              <?php echo ($ul['grouppage']['remove_group'])?$ul['grouppage']['remove_group']: "Remove group"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Remove UI UX Designer Group? -->
        
        <!-- Add Group Members -->
        <div class="modal fade custom-border-modal" id="add-group-member">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span class="material-icons group-add-btn">  <?php echo ($ul['grouppage']['groupadd'])?$ul['grouppage']['groupadd']: "group_add"; ?></span> <?php echo ($ul['grouppage']['add_group_members'])?$ul['grouppage']['add_group_members']: "Add Group Members"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"><?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="search_chat has-search me-0 ms-0">
                            <span class="fas fa-search form-control-feedback"></span>
                            <input class="form-control chat_input" id="search-contact1" type="text" placeholder="Search Contacts">
                        </div>
                        <div class="sidebar">
                            <span class="contact-name-letter"><?php echo ($ul['grouppage']['a'])?$ul['grouppage']['a']: "A"; ?></span>
                            <ul class="user-list mt-2">
                                <li class="user-list-item">
                                    <div class="avatar avatar-online">
                                        <img src="assets/img/avatar/avatar-1.jpg" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="users-list-body align-items-center">
                                        <div>
                                            <h5><?php echo ($ul['grouppage']['albert_rodarte'])?$ul['grouppage']['albert_rodarte']: "Albert Rodarte"; ?></h5>
                                        </div>
                                        <div class="last-chat-time">
                                            <label class="custom-check">
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="user-list-item">
                                    <div class="avatar avatar-online">
                                        <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="users-list-body align-items-center">
                                        <div>
                                            <h5><?php echo ($ul['grouppage']['allison_etter'])?$ul['grouppage']['allison_etter']: "Allison Etter"; ?></h5>
                                        </div>
                                        <div class="last-chat-time">
                                            <label class="custom-check">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="user-list mt-2">
                                <li class="user-list-item">
                                    <div class="avatar avatar-online">
                                        <img src="assets/img/avatar/avatar-3.jpg" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="users-list-body align-items-center">
                                        <div>
                                            <h5><?php echo ($ul['grouppage']['craig_smiley'])?$ul['grouppage']['craig_smiley']: "Craig Smiley"; ?></h5>
                                        </div>
                                        <div class="last-chat-time">
                                            <label class="custom-check">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="user-list-item">
                                    <div class="avatar avatar-online">
                                        <img src="assets/img/avatar/avatar-4.jpg" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="users-list-body align-items-center">
                                        <div>
                                            <h5><?php echo ($ul['grouppage']['caniel_clay'])?$ul['grouppage']['caniel_clay']: "Caniel Clay"; ?></h5>
                                        </div>
                                        <div class="last-chat-time">
                                            <label class="custom-check">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-row profile_form text-end float-end m-0 mt-3 align-items-center">
                            <div class="cancel-btn me-3">
                                <a href="#" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                            </div>
                            <div class="">
                                <button type="button" class="btn newgroup_create previous mb-0 me-3" data-bs-toggle="modal" data-bs-target="#add-new-group" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['grouppage']['previous'])?$ul['grouppage']['previous']: "Previous"; ?>
                                </button>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-block newgroup_create mb-0" data-bs-dismiss="modal" aria-label="Close">
                                 <?php echo ($ul['grouppage']['create_group'])?$ul['grouppage']['create_group']: "Create Group"; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Group Members -->

        <!-- New Chat -->
        <div class="modal fade " id="new-chat">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                             <?php echo ($ul['grouppage']['new_chat'])?$ul['grouppage']['new_chat']: "New Chat"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-block-group mb-4">
                            <div class="search_chat has-search">
                                <span class="fas fa-search form-control-feedback"></span>
                                <input class="form-control chat_input" id="search-new-contacts" type="text" placeholder="Search">
                            </div>
                            <h5><?php echo ($ul['grouppage']['contacts'])?$ul['grouppage']['contacts']: "Contacts"; ?></h5>
                            <div class="sidebar">
                                <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                    <div class="fav-title contact-title">
                                        <h6>A</h6>
                                    </div>
                                </div>
                                <ul class="user-list">
                                    <li class="user-list-item">
                                        <a href="javascript:;">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-4.jpg" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="users-list-body">
                                                <div>
                                                    <h5><?php echo ($ul['grouppage']['alexander_manuel'])?$ul['grouppage']['alexander_manuel']: "Alexander Manuel"; ?></h5>
                                                    <p><?php echo ($ul['grouppage']['active_4min_ago'])?$ul['grouppage']['active_4min_ago']: "Active 4Min Ago"; ?></p>
                                                </div>    
                                            </div>
                                        </a>
                                    </li>
                                    <li class="user-list-item">
                                        <a href="javascript:;">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-5.jpg" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="users-list-body">
                                                <div>
                                                    <h5><?php echo ($ul['grouppage']['annette_theriot'])?$ul['grouppage']['annette_theriot']: "Annette Theriot"; ?></h5>
                                                    <p><?php echo ($ul['grouppage']['online'])?$ul['grouppage']['online']: "Online"; ?></p>
                                                </div>    
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                    <div class="fav-title contact-title">
                                        <h6><?php echo ($ul['grouppage']['b'])?$ul['grouppage']['b']: "B"; ?></h6>
                                    </div>
                                </div>
                                <ul class="user-list">
                                    <li class="user-list-item">
                                        <a href="javascript:;">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-4.jpg" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="users-list-body">
                                                <div>
                                                    <h5><?php echo ($ul['grouppage']['bacon_mark'])?$ul['grouppage']['bacon_mark']: "Bacon Mark"; ?></h5>
                                                    <p><?php echo ($ul['grouppage']['active_8min_ago'])?$ul['grouppage']['active_8min_ago']: "Active 8Min Ago"; ?></p>
                                                </div>    
                                            </div>
                                        </a>
                                    </li>
                                    <li class="user-list-item ">
                                        <a href="javascript:;" class="mb-0">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-5.jpg" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="users-list-body">
                                                <div>
                                                    <h5><?php echo ($ul['grouppage']['bennett_gerard'])?$ul['grouppage']['bennett_gerard']: "Bennett Gerard"; ?></h5>
                                                    <p><?php echo ($ul['grouppage']['last_seen_today'])?$ul['grouppage']['last_seen_today']: "Last Seen Today at 12:35 AM"; ?></p>
                                                </div>    
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mute-chat-btn">                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <img src="assets/img/icon/send.svg" class="me-1" alt="image">
                                <?php echo ($ul['grouppage']['send'])?$ul['grouppage']['send']: "Send"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /New Chat -->

        <!-- Add Participants -->
        <div class="modal fade " id="add-parti">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['grouppage']['add_participants'])?$ul['grouppage']['add_participants']: "Add Participants"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <form>
                            <div class="parti-groups show-participant">
                                <div class="user-block-group mb-4">
                                    <div class="search_chat has-search group-name-search">
                                        <span class="fas fa-search form-control-feedback"></span>
                                        <input class="form-control chat_input" id="search-member-participants" type="text" placeholder="Search">
                                    </div>
                                    <h5><?php echo ($ul['grouppage']['contacts'])?$ul['grouppage']['contacts']: "Contacts"; ?></h5>
                                    <div class="sidebar">
                                         <ul class="user-list contact-user-lists" id="member-user-list">
                                            
                                        </ul>
                                    </div>
                                </div>
                                <input type="hidden" name="addgroupmemberid" id="addgroupmemberid" value="">
                                <div class="mute-chat-btn">                            
                                    <a class="btn btn-secondary close" data-bs-dismiss="modal" aria-label="Close" id="previous-groups">
                                        <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                                    </a>
                                    <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#Success-group" onclick="addGroupMember()">
                                        <i class="bx bx-send me-1"></i> <?php echo ($ul['grouppage']['submit'])?$ul['grouppage']['submit']: "Submit"; ?>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
                
            </div>
        </div>

        <!-- /Add Participants -->

        <!-- New Group -->
        <div class="modal fade " id="new-group">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['grouppage']['new_group'])?$ul['grouppage']['new_group']: "New Group"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <form>
                            <div class="new-group-add show-group-add">
                                <div class="user-profiles-group mb-4">
                                    <div class="profile-cover text-center">
                                    <label class="profile-cover-avatar">
                                        <img class="avatar-img" name="current-profile-image" id="new-group-image" src="assets/img/user-placeholder.jpg" alt="Profile Image">
                                        <input type="file" id="new_group_img" accept="image/*">
                                        <span class="avatar-edit">
                                             <img src="assets/img/icon/camera.svg" alt="Image">
                                        </span>
                                    </label>
                                    </div>
                                    <div class="pass-login">
                                        <label class="form-label"><?php echo ($ul["grouppage"]["group_name"])?$ul["grouppage"]["group_name"]: "Group Name"; ?></label>
                                        <input name="new-group-title" id="new-group-title" type="text" class="form-control pass-input">
                                    </div>
                                    <div class="pass-login">
                                        <label class="form-label"><?php echo ($ul['grouppage']['description'])?$ul['grouppage']['description']: "Description"; ?> </label>
                                        <textarea class="form-control" name="new-group-description" id="new-group-description"></textarea>
                                    </div>
                                </div>
                                <div class="mute-chat-btn">
                                
                                    <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                                    </a>
                                    <a class="btn btn-primary" id="next-parti">
                                        <i class="feather-arrow-right me-1"></i><?php echo ($ul['grouppage']['next'])?$ul['grouppage']['next']: "Next"; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="parti-group hash-participant">
                                <div class="user-block-group mb-4">
                                    <div class="search_chat has-search group-name-search">
                                        <span class="fas fa-search form-control-feedback"></span>
                                        <input class="form-control chat_input" id="search-contact-participants" type="text" placeholder="Search">
                                    </div>
                                    <h5><?php echo ($ul['grouppage']['contacts'])?$ul['grouppage']['contacts']: "Contacts"; ?></h5>
                                    <div class="sidebar">
                                         <ul class="user-list contact-user-list" id="contact-user-list">
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="mute-chat-btn">                            
                                    <a class="btn btn-secondary" id="previous-group">
                                        <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['previous'])?$ul['grouppage']['previous']: "Previous"; ?>
                                    </a>
                                    <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#Success-group" onclick="addGroup()">
                                        <i class="bx bx-send me-1"></i> <?php echo ($ul['grouppage']['create'])?$ul['grouppage']['create']: "Create"; ?>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
                
            </div>
        </div>
        <!-- /New Group -->

        <!-- Edit Group -->
        <div class="modal fade " id="edit-group-details">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title">
                          <?php echo ($ul['grouppage']['edit_group'])?$ul['grouppage']['edit_group']: "Edit Group"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <form>
                            <div class="new-group-add show-group-add">
                                <div class="user-profiles-group mb-4">
                                    <div class="profile-cover text-center">
                                        <label class="profile-cover-avatar" id="image-preview">
                                            <img class="avatar-img" name="current-profile-image" id="current-group-profile-image" src="assets/img/user-placeholder.jpg" alt="Profile Image">
                                            <input type="file" id="avatar_uplo_img" accept="image/*">
                                            <span class="avatar-edit">
                                                 <img src="assets/img/icon/camera.svg" alt="Image">
                                            </span>
                                        </label>
                                    </div>
                                    <div class="pass-login">
                                        <label class="form-label"><?php echo ($ul['grouppage']['group_name'])?$ul['grouppage']['group_name']: "Group Name"; ?> </label>
                                        <input name="new-group-title" id="edit-group-title" type="text" class="form-control pass-input" value="">
                                    </div>
                                    <div class="pass-login">
                                        <label class="form-label"> <?php echo ($ul['grouppage']['description'])?$ul['grouppage']['description']: "Description"; ?></label>
                                        <textarea class="form-control" name="new-group-description" id="edit-group-description"></textarea>
                                    </div>
                                </div>
                                <div class="mute-chat-btn">
                                    <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                                    </a>
                                    <a class="btn btn-primary" onclick="EditGroup();">
                                        <i class="feather-check me-1"></i><?php echo ($ul['grouppage']['save_changes'])?$ul['grouppage']['save_changes']: "Save Changes"; ?>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
                
            </div>
        </div>
        <!-- /Edit Group -->

        <!-- New Chat -->
        <div class="modal fade " id="group-parti">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['grouppage']['add_group_participants'])?$ul['grouppage']['add_group_participants']: "Add Group Participants"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-block-group mb-4">
                            <div class="search_chat has-search group-name-search">
                                <span class="fas fa-search form-control-feedback"></span>
                                <input class="form-control chat_input" id="search-contact3" type="text" placeholder="Search">
                            </div>
                            <div class=" parti-wrapper">
                                <img src="./assets/img/avatar/group-01.png" alt="Img" class="img-fluid me-2">
                                <img src="./assets/img/avatar/group-02.png" alt="Img" class="img-fluid">
                            </div>
                            <h5><?php echo ($ul['grouppage']['contacts'])?$ul['grouppage']['contacts']: "Contacts"; ?></h5>
                            <div class="sidebar">
                                <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                    <div class="fav-title contact-title">
                                        <h6><?php echo ($ul['grouppage']['a'])?$ul['grouppage']['a']: "A"; ?></h6>
                                    </div>
                                </div>
                                <ul class="user-list">
                                    <li class="user-list-items">
                                        <a href="javascript:;">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-4.jpg" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="users-list-body">
                                                <div>
                                                    <h5><?php echo ($ul['grouppage']['alexander_manuel'])?$ul['grouppage']['alexander_manuel']: "Alexander Manuel"; ?></h5>
                                                    <p><?php echo ($ul['grouppage']['active_4min_ago'])?$ul['grouppage']['active_4min_ago']: "Active 4Min Ago"; ?></p>
                                                </div>    
                                            </div>
                                            <div class="notify-check parti-notify-check">
                                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                                    <label class="custom-check mt-0 mb-0">
                                                        <input type="checkbox" name="remeber">                                        
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>                                          
                                        </a>                                        
                                    </li>
                                    <li class="user-list-item">
                                        <a href="javascript:;">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-5.jpg" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="users-list-body">
                                                <div>
                                                    <h5><?php echo ($ul['grouppage']['annette_theriot'])?$ul['grouppage']['annette_theriot']: "Annette Theriot"; ?></h5>
                                                    <p><?php echo ($ul['grouppage']['online'])?$ul['grouppage']['online']: "Online"; ?></p>
                                                </div>    
                                            </div>
                                            <div class="notify-check parti-notify-check">
                                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                                    <label class="custom-check mt-0 mb-0">
                                                        <input type="checkbox" name="remeber">                                        
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                    <div class="fav-title contact-title">
                                        <h6>B</h6>
                                    </div>
                                </div>
                                <ul class="user-list">
                                    <li class="user-list-item">
                                        <a href="javascript:;">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-4.jpg" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="users-list-body">
                                                <div>
                                                    <h5><?php echo ($ul['grouppage']['bacon_mark'])?$ul['grouppage']['bacon_mark']: "Bacon Mark"; ?></h5>
                                                    <p><?php echo ($ul['grouppage']['active_8min_ago'])?$ul['grouppage']['active_8min_ago']: "Active 8Min Ago"; ?></p>
                                                </div>    
                                            </div>
                                            <div class="notify-check parti-notify-check">
                                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                                    <label class="custom-check mt-0 mb-0">
                                                        <input type="checkbox" name="remeber">                                        
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div> 
                                        </a>
                                    </li>
                                    <li class="user-list-item ">
                                        <a href="javascript:;" class="mb-0">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-5.jpg" class="rounded-circle" alt="image">
                                            </div>
                                            <div class="users-list-body">
                                                <div>
                                                    <h5><?php echo ($ul['grouppage']['bennett_gerard'])?$ul['grouppage']['bennett_gerard']: "Bennett Gerard"; ?></h5>
                                                    <p><?php echo ($ul['grouppage']['last_seen_today'])?$ul['grouppage']['last_seen_today']: "Last Seen Today at 12:35 AM"; ?></p>
                                                </div>    
                                            </div>
                                            <div class="notify-check parti-notify-check">
                                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                                    <label class="custom-check mt-0 mb-0">
                                                        <input type="checkbox" name="remeber" checked>                                        
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mute-chat-btn">                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#Success-group" onclick="addGroup()">
                                <img src="assets/img/icon/send.svg" class="me-1" alt="image"> <?php echo ($ul['grouppage']['create'])?$ul['grouppage']['create']: "Create"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /New Chat -->

        <!-- New Group -->
        <div class="modal fade " id="invite-other">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?php echo ($ul['grouppage']['invite_friends'])?$ul['grouppage']['invite_friends']: "Invite Friends"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-profiles-group mb-4">
                            <form>
                                <div class="pass-login">
                                    <label class="form-label"><?php echo ($ul['grouppage']['invite_friends'])?$ul['grouppage']['invite_friends']: "Invite Friends"; ?></label>
                                    <input type="password" class="form-control pass-input">
                                </div>
                                <div class="pass-login">
                                    <label class="form-label"><?php echo ($ul['grouppage']['invite_message'])?$ul['grouppage']['invite_message']: "Invitation Message "; ?></label>
                                    <textarea class="form-control "></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="mute-chat-btn">                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-plus me-1"></i><?php echo ($ul['grouppage']['send_invitation'])?$ul['grouppage']['send_invitation']: "Send Invitation"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /New Group -->

         <!-- Forward Message To -->
         <div class="modal fade " id="forward-message">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                          <?php echo ($ul['grouppage']['forward_message_to'])?$ul['grouppage']['forward_message_to']: "  Forward Message To"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-block-group mb-4">
                            <div class="search_chat has-search">
                                <span class="fas fa-search form-control-feedback"></span>
                                <input class="form-control chat_input" id="search-contacts" type="text" placeholder="Search">
                            </div>
                            <h5><?php echo ($ul['grouppage']['recent_chats'])?$ul['grouppage']['recent_chats']: "Recent Chats"; ?></h5>
                            <div class="forward-message-users-list">
                                
                            </div>
                        </div>
                        <div class="mute-chat-btn">                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="sendForwardMessages();">
                                <img src="assets/img/icon/send.svg" class="me-1" alt="image"><?php echo ($ul['grouppage']['send'])?$ul['grouppage']['send']: "Send"; ?>
                            </a>
                    </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Forward Message To -->


             <!-- Delete Message To -->
             <div class="modal fade " id="delete-message">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content delete-model-head">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <?php echo ($ul['grouppage']['delete_message'])?$ul['grouppage']['delete_message']: "Delete Message"; ?>
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span class="material-icons"><?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="deleteMsgKey" id="deleteMsgKey" value="">
                            <div class="notify-check delete-chat-notify">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me"><?php echo ($ul['grouppage']['delete_for_me'])?$ul['grouppage']['delete_for_me']: "Delete for Me"; ?></span>
                                        <input type="checkbox" name="deleteType[]" id="deleteType" value="me">                                         
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me"><?php echo ($ul['grouppage']['delete_for_everyone'])?$ul['grouppage']['delete_for_everyone']: "Delete for Everyone"; ?></span>
                                        <input type="checkbox" name="deleteType[]" id="deleteType" value="all">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>  
                            <div class="mute-chat-btn delete-pop-btn justify-content-end">                                
                                <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                                </a>
                                <a class="btn btn-primary" onclick="deleteselectedchat();">
                                    <img src="assets/img/icon/send.svg" class="me-1" alt="image"><?php echo ($ul['grouppage']['delete'])?$ul['grouppage']['delete']: "Delete"; ?>
                                </a>
                            </div>
                        </div>       
                    </div>
                </div>
            </div>
            <!-- /Delete Message To -->

             <!-- Block -->
        <div class="modal fade" id="block-user">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['grouppage']['block_mark_villiams'])?$ul['grouppage']['block_mark_villiams']: "Block Mark Villiams"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <i class="bx bx-block change-color "></i>
                            <p><?php echo ($ul['grouppage']['blocked_contacts'])?$ul['grouppage']['blocked_contacts']: "Blocked contacts will no longer be able to call you or send you messages."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                  <?php echo ($ul['grouppage']['block'])?$ul['grouppage']['block']: "Block"; ?>
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
                             <?php echo ($ul['grouppage']['report'])?$ul['grouppage']['report']: "Report"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <img src="assets/img/icon/report-01.svg"  alt="icon">
                            <p><?php echo ($ul['grouppage']['are_you_sure'])?$ul['grouppage']['are_you_sure']: "Are you sure to report this message and user?"; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                            <input type="hidden" name="reportMsgKey" id="reportMsgKey" value="">
                            <a class="btn btn-primary" onclick="confirmreport()">
                                 <?php echo ($ul['grouppage']['report'])?$ul['grouppage']['report']: "Report"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Report -->

        <!-- Deleting a Chat -->
        <div class="modal fade" id="change-chat">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?php echo ($ul['grouppage']['delete_chat'])?$ul['grouppage']['delete_chat']: "Delete Chat"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <i class="bx bx-trash change-color "></i>
                            <p> <?php echo ($ul['grouppage']['clearing_or_deleting'])?$ul['grouppage']['clearing_or_deleting']: "Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of Dreamschat."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" onclick="delete_chat()">
                                 <?php echo ($ul['grouppage']['delete'])?$ul['grouppage']['delete']: "Delete"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Deleting a Chat -->

        <!--Voice Modal-->
        <div class="modal fade" id="record_audio">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                         <?php echo ($ul['grouppage']['voice_message'])?$ul['grouppage']['voice_message']: "Voice Message"; ?>
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
                                <button type="button" class="btn btn-warning btn-sm" id="startRecording"><?php echo ($ul['grouppage']['start'])?$ul['grouppage']['start']: "Start"; ?></button>
                                <button type="button" class="btn btn-dark btn-sm" id="stopRecording" disabled><?php echo ($ul['grouppage']['stop'])?$ul['grouppage']['stop']: "Stop"; ?></button>

                                <button type="button" class="btn btn-info btn-sm" id="send_voice" disabled><?php echo ($ul['grouppage']['send'])?$ul['grouppage']['send']: "Send"; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Voice Modal-->

         <!-- Deleting a Chat -->
         <div class="modal fade" id="clear-chat">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                             <?php echo ($ul['grouppage']['clear_chat'])?$ul['grouppage']['clear_chat']: "Clear Chat"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <i class="bx bx-trash change-color "></i>
                            <p><?php echo ($ul['grouppage']['clearing_or_deleting'])?$ul['grouppage']['clearing_or_deleting']: "Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of Dreamschat."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="clearUserChat();">
                                <?php echo ($ul['grouppage']['clear'])?$ul['grouppage']['clear']: "Clear"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Deleting a Chat -->

        <!-- Drag and Drop -->
        <div class="modal fade" id="drag_files">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           
                            <?php echo ($ul['grouppage']['drag_and_drop'])?$ul['grouppage']['drag_and_drop']: "Drag and Drop or Upload Files"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['grouppage']['close'])?$ul['grouppage']['close']: "close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="file-drop mb-4">
                            <form action="#" class="dropzone dz-clickable">
                                <div id="drop-zone-file-status">
                                    <img src="assets/img/icon/drag-file.svg" class="img-fluid" alt="upload">
                                    <p><?php echo ($ul['grouppage']['drag_and_drop'])?$ul['grouppage']['drag_and_drop']: "Drag & drop your files here or choose file"; ?></p>
                                    <span><?php echo ($ul['grouppage']['maximum_size'])?$ul['grouppage']['maximum_size']: "Maximum size: 50MB"; ?></span>
                                    <div class="dz-default dz-message"><span><?php echo ($ul['grouppage']['drop_files_here'])?$ul['grouppage']['drop_files_here']: "Drop files here to upload"; ?></span>
                                    <!-- <input type="file"id="drop-zone-filesss" class="grpattach" name="files[]" multiple> -->
                                </div>
                                </div>
                            </form>
                        </div>
                        <div class="file-drop mt-4">
                            <input type="file"  class="grpattach" id="drop-zone-filesss" name="files[]" multiple>
                            <br>
                            <!-- <img id="previewImage" alt="Preview" style="max-width: 200px; max-height: 200px;"> -->
                            <div id="imagePreview mt-4">
                                  <img id="previewImage" src="#" alt=""  style="max-width: 200px; max-height: 200px; border-radius: 10px; margin-top: 20px;">
                            </div>
                        </div>

                        <div class="mute-chat-btn ">
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['grouppage']['cancel'])?$ul['grouppage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" id="send-attachement">
                                <i class="feather-arrow-right me-1"></i><?php echo ($ul['grouppage']['submit'])?$ul['grouppage']['submit']: "Submit"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- Drag and Drop -->
        <!-- Group Call Modal -->
        <div class="modal fade" id="groupcall_modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo ($ul['grouppage']['participants'])?$ul['grouppage']['participants']: "Participants"; ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times close_icon"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <nav class="list-group list-group-flush mb-n6">
                            <!-- Search -->
                            <form class="mb-3 newgroup_content">
                                
                                <div class="col-md-12">
                                    <label><?php echo ($ul['grouppage']['select_maximum8'])?$ul['grouppage']['select_maximum8']: "Select maximum 8"; ?></label>
                                    <input type="hidden" id="call_type" value="">
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg search_call" placeholder="Search" aria-label="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-lg btn-ico btn-secondary btn-minimal newgroup_search_btn" type="button">
                                            <i class="fas fa-search newgroup_fa_search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>                         
                            <div class="col-md-12">
                            <!-- Friend -->
                                <div class="my-group-list">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <b id="err_call" class="text-danger"></b>
                            </div>
                            <!-- Friend -->
                        </nav>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" onclick="onetogroupnew('video');"><?php echo ($ul['grouppage']['call'])?$ul['grouppage']['call']: "Call"; ?></button>
                    </div>
                </div>
            </div>
        </div>
       <!-- /Group Call Modal -->
        
    </div>
    <!-- /Main Wrapper -->

<?php $this->load->view('includes/footer'); ?>	
