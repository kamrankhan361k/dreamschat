<?php 
    $this->load->view('includes/header');
    /*$session = $this->session->userdata('username');
    $ul = custom_language($session['user'], $session['language']);*/
?>

<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- content -->
    <div class="content main_content">
        <?php $this->load->view('includes/leftsidebar'); 
            $this->load->view('includes/sidebar-group'); ?>

        <!-- Chat -->
        <div class="chat chat-messages" id="middle">
            <div class="slimscroll">
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
                        <figure class="avatar ms-1">
                            <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="image">
                        </figure>
                        <div class="mt-1">
                            <h5>Mark Villiams</h5>
                            <small class="last-seen">
                                Last Seen at 07:15 PM
                            </small>
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
                                <a href="<?php echo base_url(); ?>video-call" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video Call">
                                    <i class="bx bx-video" ></i>
                                </a>
                            </li>
                            <li class="list-inline-item" >
                                <a href="<?php echo base_url(); ?>audio-call" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voice Call">
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
                                    <a href="#" class="dropdown-item "><span><i class="bx bx-x" ></i></span>Close Chat </a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mute-notification"><span><i class="bx bx-volume-mute"></i></span>Mute Notification</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disappearing-messages"><span><i class="bx bx-time-five"></i></span>Disappearing Message</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#clear-chat"><span><i class="bx bx-brush-alt"></i></span>Clear Message</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change-chat"><span><i class="bx bx-trash-alt"></i></span>Delete Chat</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#block-user"><span><i class="bx bx-block"></i></span>Block</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Chat Search -->
                    <div class="chat-search">
                        <form>
                            <span class="form-control-feedback"><i class="bx bx-search" ></i></span>
                            <input type="text" name="chat-search" placeholder="Search Chats" class="form-control">
                            <div class="close-btn-chat"><span class="material-icons">close</span></div>
                        </form>
                    </div>
                    <!-- /Chat Search -->
                </div>
                <div class="chat-body">
                    <div class="messages">
                        <div class="chats">
                            <div class="chat-avatar">
                                <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                            </div>
                            <div class="chat-content">
                                <div class="chat-profile-name">
                                    <h6>Mark Villiams<span>8:16 PM</span></h6>
                                    <div class="chat-action-btns ms-3">
                                        <div class="chat-action-col">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                <a href="#" class="dropdown-item message-info-left"><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span>Star Message</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message" ><span><i class="bx bx-trash"></i></span>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content">
                                    Hello <a href="javascript:;">@Alex</a> Thank you for the beautiful web design ahead schedule.
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:;"  ><i class="bx bx-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-01.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-02.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-03.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-04.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-05.svg"  alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:;" ><i class="feather-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="bx bx-share"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-line">
                            <span class="chat-date">Today, July 24</span>
                        </div>
                        <div class="chats chats-right">
                            <div class="chat-content">
                                <div class="chat-profile-name text-end">
                                    <h6>Alex Smith<span>8:16 PM</span></h6>
                                    <div class="chat-action-btns ms-3">
                                        <div class="chat-action-col">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                <a href="#" class="dropdown-item message-info-left"><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span>Star Message</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content ">
                                    <div class="emoj-group rig-emoji-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:;"  ><i class="bx bx-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-01.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-02.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-03.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-04.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-05.svg"  alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:;" ><i class="feather-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="bx bx-share"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="chat-voice-group">
                                        <ul>
                                            <li><a href="javascript:;"><span><img src="assets/img/icon/play-01.svg" alt="image"></span></a></li>
                                            <li><img src="assets/img/voice.svg" alt="image"></li>
                                            <li>0:05</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-avatar">
                                <img src="assets/img/avatar/avatar-10.jpg" class="rounded-circle dreams_chat" alt="image">
                            </div>
                        </div>
                        <div class="chats">
                            <div class="chat-avatar">
                                <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                            </div>
                            <div class="chat-content">
                                <div class="chat-profile-name">
                                    <h6>Mark Villiams<span>8:16 PM</span><span class="check-star"><i class="bx bxs-star"></i></span></h6>
                                    <div class="chat-action-btns ms-3">
                                        <div class="chat-action-col">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                <a href="#" class="dropdown-item message-info-left"><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bxs-star"></i></span>Unstar Message</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content award-link chat-award-link">
                                    <a href="javascript:;">https://www.youtube.com/watch?v=GCmL3mS0Psk</a>
                                    <img src="assets/img/award.jpg" alt="img">
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:;"  ><i class="bx bx-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-01.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-02.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-03.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-04.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-05.svg"  alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:;" ><i class="feather-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="bx bx-share"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chats chats-right">
                            <div class="chat-content">
                                <div class="chat-profile-name justify-content-end">
                                    <h6>Alex Smith<span>8:16 PM</span></h6>
                                    <div class="chat-action-btns ms-3">
                                        <div class="chat-action-col">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                <a href="#" class="dropdown-item message-info-left"><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span>Star Message</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content fancy-msg-box">
                                    <div class="emoj-group wrap-emoji-group ">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:;"  ><i class="bx bx-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-01.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-02.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-03.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-04.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-05.svg"  alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:;" ><i class="feather-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="bx bx-share"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="download-col">
                                        <ul class="nav mb-0">
                                            <li>
                                                <div class="image-download-col">
                                                    <a href="assets/img/media/media-02.jpg" data-fancybox="gallery" class="fancybox">
                                                        <img src="assets/img/media/media-02.jpg" alt="">
                                                    </a>
                                                    
                                                </div>
                                            </li>
                                            <li>
                                                <div class="image-download-col ">
                                                    <a href="assets/img/media/media-03.jpg" data-fancybox="gallery" class="fancybox">
                                                        <img src="assets/img/media/media-03.jpg" alt="">
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="image-download-col image-not-download">
                                                    <a href="assets/img/media/media-01.jpg" data-fancybox="gallery" class="fancybox">
                                                        <img src="assets/img/media/media-01.jpg" alt="">
                                                        <span>10+</span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-avatar">
                                <img src="assets/img/avatar/avatar-10.jpg" class="rounded-circle dreams_chat" alt="image">
                            </div>
                        </div>

                        <div class="chats">
                            <div class="chat-avatar">
                                <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                            </div>
                            <div class="chat-content">
                                <div class="chat-profile-name">
                                    <h6>Mark Villiams<span>8:16 PM</span></h6>
                                    <div class="chat-action-btns ms-3">
                                        <div class="chat-action-col">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                <a href="#" class="dropdown-item message-info-left"><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span>Star Message</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content review-files">
                                    <p>Please check and review the files<span class="ms-1"><img src="assets/img/icon/smile-chat.svg" alt="Icon"></span></p>
                                    <div class="file-download d-flex align-items-center mb-0">
                                        <div class="file-type d-flex align-items-center justify-content-center me-2">
                                            <i class="bx bxs-file-doc"></i>
                                        </div>
                                        <div class="file-details">
                                            <span class="file-name">Landing_page_V1.doc</span>
                                            <ul>
                                                <li>80 Bytes</li>
                                                <li><a href="javascript:;">Download</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="emoj-group">
                                        <ul>
                                            <li class="emoj-action"><a href="javascript:;"  ><i class="bx bx-smile"></i></a>
                                                <div class="emoj-group-list">
                                                    <ul>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-01.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-02.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-03.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-04.svg"  alt="Icon"></a></li>
                                                        <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-05.svg"  alt="Icon"></a></li>
                                                        <li class="add-emoj"><a href="javascript:;" ><i class="feather-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="bx bx-share"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="like-chat-grp">
                                    <ul>
                                        <li class="like-chat"><a href="javascript:;">2<img src="assets/img/icon/like.svg"  alt="Icon"></a></li>
                                        <li class="comment-chat"><a href="javascript:;">2<img src="assets/img/icon/heart.svg"  alt="Icon"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="chats">
                            <div class="chat-avatar">
                                <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                            </div>
                            <div class="chat-content">
                                <div class="chat-profile-name">
                                    <h6>Mark Villiams<span>8:16 PM</span></h6>
                                    <div class="chat-action-btns ms-3">
                                        <div class="chat-action-col">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                <a href="#" class="dropdown-item message-info-left"><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span>Star Message</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content">
                                    Thank you for your support
                                        <div class="emoj-group">
                                            <ul>
                                                <li class="emoj-action"><a href="javascript:;"  ><i class="bx bx-smile"></i></a>
                                                    <div class="emoj-group-list">
                                                        <ul>
                                                            <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-01.svg"  alt="Icon"></a></li>
                                                            <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-02.svg"  alt="Icon"></a></li>
                                                            <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-03.svg"  alt="Icon"></a></li>
                                                            <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-04.svg"  alt="Icon"></a></li>
                                                            <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-05.svg"  alt="Icon"></a></li>
                                                            <li class="add-emoj"><a href="javascript:;" ><i class="feather-plus"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#forward-message"><i class="bx bx-share"></i></a></li>
                                            </ul>
                                        </div>
                                </div>                                    
                            </div>
                        </div>

                        <div class="chats">
                            <div class="chat-avatar">
                                <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                            </div>
                            <div class="chat-content chat-cont-type">
                                <div class="chat-profile-name chat-type-wrapper">
                                    <p>Mark Villiams Typing...</p>
                                </div>
                            </div>
                        </div>




                        <div class="chats forward-chat-msg">
                            <div class="chat-avatar">
                                <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                            </div>
                            <div class="chat-content">
                                <div class="chat-profile-name">
                                    <h6>Mark Villiams<span>8:16 PM</span></h6>
                                    <div class="chat-action-btns ms-3">
                                        <div class="chat-action-col">
                                            <a class="#" href="#" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                <a href="#" class="dropdown-item message-info-left"><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span>Star Message</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content">
                                    Thank you for your support
                                </div>
                            </div>
                        </div>                           
                    
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
                                    <a href="#" class="dropdown-item "><span><i class="bx bx-file"></i></span>Document</a>
                                    <a href="#" class="dropdown-item"><span><i class="bx bx-camera"></i></span>Camera</a>
                                    <a href="#" class="dropdown-item"><span><i class="bx bx-image"></i></span>Gallery</a>
                                    <a href="#" class="dropdown-item" ><span><i class="bx bx-volume-full"></i></span>Audio</a>
                                    <a href="#" class="dropdown-item"><span><i class="bx bx-map"></i></span>Location</a>
                                    <a href="#" class="dropdown-item" ><span><i class="bx bx-user-pin"></i></span>Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="smile-foot emoj-action">
                        <a href="#" class="action-circle"><i class="bx bx-smile"></i></a>
                            <div class="emoj-group-list down-emoji-circle">
                                <ul>
                                    <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-01.svg"  alt="Icon"></a></li>
                                    <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-02.svg"  alt="Icon"></a></li>
                                    <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-03.svg"  alt="Icon"></a></li>
                                    <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-04.svg"  alt="Icon"></a></li>
                                    <li><a href="javascript:;" ><img src="assets/img/icon/emoj-icon-05.svg"  alt="Icon"></a></li>
                                    <li class="add-emoj"><a href="javascript:;" ><i class="feather-plus"></i></a></li>
                                </ul>
                            </div>
                    </div>
                    <div class="smile-foot">
                        <a href="#"  class="action-circle"><i class="bx bx-microphone-off"></i></a>
                    </div>
                    <input type="text" class="form-control chat_form" placeholder="Type your message here...">
                    <div class="form-buttons">
                        <button class="btn send-btn" type="submit">
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
                            <h6>Contact Info</h6>
                        </div>
                        <div class="contact-close_call text-end">
                            <a href="#"
                                class="close_profile close_profile4">
                                <span class="material-icons">close</span>
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-body">
                        <div class="mt-0 right_sidebar_logo">
                            <div class="text-center right-sidebar-profile">
                                <figure class="avatar avatar-xl mb-3">
                                    <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="image">
                                </figure>
                                <h5 class="profile-name">Mark Villiams</h5>
                                <div class="last-seen-profile">
                                    <span>last seen at 07:15 PM</span>
                                </div>
                                <div class="chat-options chat-option-profile">
                                    <ul class="list-inline">
                                        <li class="list-inline-item" >
                                            <a href="<?php echo base_url(); ?>audio-call" class="btn btn-outline-light " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voice Call">
                                                <i class="bx bx-phone" ></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item " >
                                            <a href="<?php echo base_url(); ?>video-call" class="btn btn-outline-light profile-open" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video Call">
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
                            <div class="chat-member-details">
                                <div class="member-details">
                                    <ul>
                                        <li>
                                            <h5>Info</h5>
                                        </li>
                                        <li>
                                            <h6>Bio</h6>
                                            <span>Hello, I am using DreamsChat</span>
                                        </li>
                                        <li>
                                            <h6>Phone</h6>
                                            <span>555-555-21541</span>
                                        </li>
                                        <li>
                                            <h6>Email Address</h6>
                                            <span>info@example.com</span>
                                        </li>
                                        <li>
                                            <h6>Social Media</h6>
                                            <div class="social-icons ">
                                                <a href="javascript:;"><i class="bx bxl-facebook"></i></a>
                                                <a href="javascript:;"><i class="bx bxl-twitter"></i></a>
                                                <a href="javascript:;"><i class="bx bxl-youtube"></i></a>
                                                <a href="javascript:;"><i class="bx bxl-linkedin"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="right-sidebar-head share-media">
                        <div class="share-media-blk">
                            <h5>Shared Media</h5>
                            <a href="javascript:;">View All</a>
                        </div>
                         <div class="about-media-tabs">       
                            <nav>
                                <div class="nav nav-tabs " id="nav-tab">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#info">Photos</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab1" data-bs-toggle="tab" href="#Participants" >Videos</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab2" data-bs-toggle="tab" href="#media" >File</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab3" data-bs-toggle="tab" href="#link" >Link</a>
                                </div>
                            </nav>
                            <div class="tab-content pt-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="info">
                                    <ul class="nav share-media-img mb-0">
                                        <li>
                                            <a href="assets/img/media/media-01.jpg" data-fancybox="gallery" class="fancybox">
                                                <img src="assets/img/media/media-01.jpg" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="assets/img/media/media-02.jpg" data-fancybox="gallery" class="fancybox">
                                                <img src="assets/img/media/media-02.jpg" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="assets/img/media/media-03.jpg" data-fancybox="gallery" class="fancybox">
                                                <img src="assets/img/media/media-03.jpg" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="assets/img/media/media-04.jpg" data-fancybox="gallery" class="fancybox">
                                                <img src="assets/img/media/media-04.jpg" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="assets/img/media/media-05.jpg" data-fancybox="gallery" class="fancybox">
                                                <img src="assets/img/media/media-05.jpg" alt="">
                                            </a>
                                        </li>
                                        <li class="blur-media">
                                            <a href="assets/img/media/media-02.jpg" data-fancybox="gallery" class="fancybox">
                                                <img src="assets/img/media/media-02.jpg" alt="">
                                            </a>
                                            <span>+10</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="Participants">
                                    <ul class="nav share-media-img mb-0">
                                        <li>
                                            <a href="https://www.youtube.com/embed/Mj9WJJNp5wA" data-fancybox class="fancybox">
                                                <img src="assets/img/media/media-01.jpg" alt="img">
                                                <span><i class="bx bx-play-circle"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.youtube.com/embed/Mj9WJJNp5wA" data-fancybox class="fancybox">
                                                <img src="assets/img/media/media-02.jpg" alt="img">
                                                <span><i class="bx bx-play-circle"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.youtube.com/embed/Mj9WJJNp5wA" data-fancybox class="fancybox">
                                                <img src="assets/img/media/media-03.jpg" alt="img">
                                                <span><i class="bx bx-play-circle"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.youtube.com/embed/Mj9WJJNp5wA" data-fancybox class="fancybox">
                                                <img src="assets/img/media/media-04.jpg" alt="img">
                                                <span><i class="bx bx-play-circle"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.youtube.com/embed/Mj9WJJNp5wA" data-fancybox class="fancybox">
                                                <img src="assets/img/media/media-05.jpg" alt="img">
                                                <span><i class="bx bx-play-circle"></i></span>
                                            </a>
                                        </li>
                                        <li class="blur-media">
                                            <a href="https://www.youtube.com/embed/Mj9WJJNp5wA" data-fancybox class="fancybox">
                                                <img src="assets/img/media/media-03.jpg" alt="img">
                                            </a>
                                            <span>+10</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="media">
                                    <div class="media-file">
                                        <div class="media-doc-blk">
                                            <span><i class="bx bxs-file-doc"></i></span>
                                            <div class="document-detail">
                                                <h6>Landing_page_V1.doc</h6>
                                                <ul>
                                                    <li>12 Mar 2023</li>
                                                    <li>246.3 KB</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="media-download">
                                            <a href="javascript:;"><i class="bx bx-download"></i></a>
                                        </div>
                                    </div>
                                    <div class="media-file">
                                        <div class="media-doc-blk">
                                            <span><i class="bx bxs-file-pdf"></i></span>
                                            <div class="document-detail">
                                                <h6>Design Guideless.pdf</h6>
                                                <ul>
                                                    <li>12 Mar 2023</li>
                                                    <li>246.3 KB</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="media-download">
                                            <a href="javascript:;"><i class="bx bx-download"></i></a>
                                        </div>
                                    </div>
                                    <div class="media-file">
                                        <div class="media-doc-blk">
                                            <span><i class="bx bxs-file"></i></span>
                                            <div class="document-detail">
                                                <h6>sample site.txt</h6>
                                                <ul>
                                                    <li>12 Mar 2023</li>
                                                    <li>246.3 KB</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="media-download">
                                            <a href="javascript:;"><i class="bx bx-download"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="link">
                                    <div class="media-link-grp">
                                        <div class="link-img">
                                            <a href="javascript:;"><img src="assets/img/media-link-01.jpg" alt="Img"></a>
                                        </div>
                                        <div class="media-link-detail">
                                            <h6><a href="javascript:;">Digital Marketing Guide</a></h6>
                                            <span><a href="javascript:;">https://elements.envato.com/all-items/blog</a></span>
                                        </div>
                                    </div>
                                    <div class="media-link-grp mb-0">
                                        <div class="link-img">
                                            <a href="javascript:;"><img src="assets/img/media-link-02.jpg" alt="Img"></a>
                                        </div>
                                        <div class="media-link-detail">
                                            <h6><a href="javascript:;">Blog Post</a></h6>
                                            <span><a href="javascript:;">https://elements.envato.com/blog-post-TXQ5FB8</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="group-comman-theme">
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
                    </div>
                    <div class="chat-message-grp">
                        <ul>
                            <li>
                                <a href="javascript:;" class="star-message-left" >
                                    <div class="stared-group">
                                        <span class="star-message"> <i class="bx bxs-star"></i></span>
                                        <h6>Starred Messages</h6>
                                    </div>
                                    <div class="count-group">
                                        <span>10</span>
                                        <i class="feather-chevron-right"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#mute-notification">
                                    <div class="stared-group">
                                        <span class="mute-message"> <i class="bx bxs-microphone-off"></i></span>
                                        <h6>Mute Notifications</h6>
                                    </div>
                                    <div class="count-group">
                                        <i class="feather-chevron-right"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#block-user">
                                    <div class="stared-group">
                                        <span class="block-message"> <i class="bx bx-block"></i></span>
                                        <h6>Block User</h6>
                                    </div>
                                    <div class="count-group">
                                        <i class="feather-chevron-right"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#report-user">
                                    <div class="stared-group">
                                        <span class="report-message"> <i class="bx bx-dislike"></i></span>
                                        <h6>Report User</h6>
                                    </div>
                                    <div class="count-group">
                                        <i class="feather-chevron-right"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#delete-user">
                                    <div class="stared-group">
                                        <span class="delete-message"> <i class="bx bx-trash"></i></span>
                                        <h6>Delete Chat</h6>
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
                            <h6><a href="#" class="remove-star-message"><img src="assets/img/icon/arrow-left.svg" class="me-2" alt="Icon"></a>Starred Messages</h6>
                        </div>
                        <div class="star-drop">
                            <a class="btn btn-outline-light" href="#" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" >
                                <a href="#" class="dropdown-item "><span><i class="feather-star"></i></span>Unstar All </a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-body chat star-chat-group">
                        <div class="chat-body">
                            <div class="messages">
                                <div class="chats">
                                    <div class="chat-avatar">
                                        <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                                    </div>
                                    <div class="chat-content">
                                        <div class="chat-profile-name">
                                            <h6>Mark Villiams<span>8:16 PM</span></h6>
                                            <div class="chat-action-btns ms-3">
                                                <div class="chat-action-col">
                                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                        <a href="#" class="dropdown-item "><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                        <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                        <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                        <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span>Star Message</a>
                                                        <a href="#" class="dropdown-item"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="message-content mb-2">
                                            Hello <a href="javascript:;">@Alex</a> Thank you for the beautiful web design ahead schedule.
                                        </div>
                                        <div class="message-star">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="Icon">
                                            </div>
                                            <h6>Alex Smith<span class="ms-1"><i class="fa-solid fa-star"></i></span></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="chats">
                                    <div class="chat-avatar">
                                        <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle dreams_chat" alt="image">
                                    </div>
                                    <div class="chat-content">
                                        <div class="chat-profile-name">
                                            <h6>Mark Villiams<span>8:16 PM</span></h6>
                                            <div class="chat-action-btns ms-3">
                                                <div class="chat-action-col">
                                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                        <a href="#" class="dropdown-item "><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                        <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                        <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                        <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span>Star Message</a>
                                                        <a href="#" class="dropdown-item"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="message-content mb-2 award-link">
                                            <a href="javascript:;">https://www.youtube.com/watch?v=GCmL3mS0Psk</a>
                                            <img src="assets/img/award.jpg" alt="img">
                                        </div>
                                        <div class="message-star">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="Icon">
                                            </div>
                                            <h6>Alex Smith<span class="ms-1"><i class="fa-solid fa-star"></i></span></h6>
                                        </div>
                                    </div>
                                </div>
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
                            <h6><a href="#" class="remove-message-info"><img src="assets/img/icon/arrow-left.svg" class="me-2" alt="Icon"></a>Messages Info</h6>
                        </div>
                        <div class="star-drop">
                            <a class="btn btn-outline-light" href="#" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" >
                                <a href="#" class="dropdown-item "><span><i class="bx bx-x" ></i></span>Close Chat </a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mute-notification"><span><i class="bx bx-volume-mute"></i></span>Mute Notification</a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disappearing-messages"><span><i class="bx bx-time-five"></i></span>Disappearing Message</a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#clear-chat"></a>><span><i class="bx bx-brush-alt"></i></span>Clear Message</a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change-chat"><span><i class="bx bx-trash-alt"></i></span>Delete Chat</a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report-user"><span><i class="bx bx-dislike"></i></span>Report</a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#block-user"><span><i class="bx bx-block"></i></span>Block</a>
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
                                            <h6>Mark Villiams<span>8:16 PM</span></h6>
                                            <div class="chat-action-btns ms-3">
                                                <div class="chat-action-col">
                                                    <a class="#" href="#" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                        <a href="#" class="dropdown-item "><span><i class="bx bx-info-circle"></i></span>Message Info </a>
                                                        <a href="#" class="dropdown-item"><span><i class="bx bx-share"></i></span>Reply</a>
                                                        <a href="#" class="dropdown-item" ><span><i class="bx bx-smile"></i></span>React</a>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#forward-message"><span><i class="bx bx-reply"></i></span>Forward</a>
                                                        <a href="#" class="dropdown-item" ><span><i class="bx bx-star"></i></span>Star Message</a>
                                                        <a href="#" class="dropdown-item"><span><i class="bx bx-dislike"></i></span>Report</a>
                                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-message"><span><i class="bx bx-trash"></i></span>Delete</a>
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
                                    <h6><span class="material-icons check-active">done_all</span>Read</h6>
                                    <span>Today at 7:12 AM</span>
                                </div>
                                <div class="message-info-box">
                                    <h6><span class="material-icons check">done_all</span>Delivered</h6>
                                    <span>Today at 7:09 AM</span>
                                </div>
                                <div class="message-info-box">
                                    <h6><i class="feather-check sent"></i>Sent</h6>
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

    <!-- Mute -->
    <div class="modal fade mute-notify" id="mute-notification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Mute Notifications
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="notify-check">
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me">15 Minutes</span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me">1 Hour</span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me">1 Day</span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me">1 Week</span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me">1 Month</span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center justify-content-start ps-0">
                            <label class="custom-check mt-0 mb-0">
                                <span class="remember-me">Always</span>
                                <input type="checkbox" name="remeber">                                        
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            Mute
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
                    <h5 class="modal-title">
                        Block Mark Villiams
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <i class="bx bx-block change-color "></i>
                        <p>Blocked contacts will no longer be able to call you or send you messages.</p>
                    </div>
                    <div class="mute-chat-btn justify-content-center">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            Block
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
                        Report Mark Villiams
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <img src="assets/img/icon/report-01.svg"  alt="icon">
                        <p>If you block this contact and clear the chat, messages will only be removed from this device and your devices on the newer versions of Dreamschat</p>
                        <div class="notify-check">
                            <div class="form-check d-flex align-items-center justify-content-center ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me">Report Contact</span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mute-chat-btn justify-content-center">                           
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            Report
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /Report -->

    <!-- Delete -->
    <div class="modal fade" id="delete-user">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Delete Chat
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <i class="bx bx-trash change-color "></i>
                        <p>Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of Dreamschat.</p>
                    </div>
                    <div class="mute-chat-btn justify-content-center">
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            Continue
                        </a>
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
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
                        Disappearing messages
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk">
                        <p>For more privacy and storage, all new messages will disappear from this chat for everyone after the selected duration, except when kept. Anyone in the chat can change this setting.</p>
                        <div class="notify-check">
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me">24 Hours</span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me">7 Days</span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me">90 Days</span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me">Off</span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            Save
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
                        Delete Chat
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <i class="bx bx-trash change-color "></i>
                        <p>Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of Dreamschat.</p>
                    </div>
                    <div class="mute-chat-btn justify-content-center">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            Delete
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
                        Clear Chat
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block-user-blk text-center">
                        <i class="bx bx-trash change-color "></i>
                        <p>Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of Dreamschat.</p>
                    </div>
                    <div class="mute-chat-btn justify-content-center">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            Clear
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
                        Forward Message To
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-block-group mb-4">
                        <div class="search_chat has-search">
                            <span class="fas fa-search form-control-feedback"></span>
                            <input class="form-control chat_input" id="search-contacts" type="text" placeholder="Search">
                        </div>
                        <h5>Recent Chats</h5>
                        <div class="recent-block-group">
                            <div class="user-block-profile">
                                <div class="avatar">
                                    <img src="assets/img/avatar/avatar-1.jpg" class="rounded-circle" alt="image">
                                </div>
                                <div class="block-user-name">
                                    <h6>Horace Keene</h6>
                                    <span>Sleeping</span>
                                </div>
                            </div>
                            <div class="notify-check mb-0">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="recent-block-group">
                            <div class="user-block-profile">
                                <div class="avatar">
                                    <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="image">
                                </div>
                                <div class="block-user-name">
                                    <h6>Bacon Mark</h6>
                                    <span>Available</span>
                                </div>
                            </div>
                            <div class="notify-check mb-0">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="recent-block-group">
                            <div class="user-block-profile">
                                <div class="avatar">
                                    <img src="assets/img/avatar/avatar-3.jpg" class="rounded-circle" alt="image">
                                </div>
                                <div class="block-user-name">
                                    <h6>Debra Jones</h6>
                                    <span>At Work</span>
                                </div>
                            </div>
                            <div class="notify-check mb-0">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="recent-block-group mb-0">
                            <div class="user-block-profile">
                                <div class="avatar">
                                    <img src="assets/img/avatar/avatar-4.jpg" class="rounded-circle" alt="image">
                                </div>
                                <div class="block-user-name">
                                    <h6>Dina Brown</h6>
                                    <span>Can’t Talk, WhatsApp only</span>
                                </div>
                            </div>
                            <div class="notify-check">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x me-1"></i>Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <img src="assets/img/icon/send.svg" class="me-1" alt="image">Send
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
                            Delete Message 
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="notify-check delete-chat-notify">
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me">Delete for Me</span>
                                    <input type="checkbox" name="remeber" checked>                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me">Delete for Everyone</span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>  
                        <div class="mute-chat-btn delete-pop-btn justify-content-end">                                
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i>Cancel
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <img src="assets/img/icon/send.svg" class="me-1" alt="image">Delete
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Forward Message To -->

    <!-- New Chat -->
    <div class="modal fade " id="new-chat">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        New Chat
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-block-group mb-4">
                        <div class="search_chat has-search">
                            <span class="fas fa-search form-control-feedback"></span>
                            <input class="form-control chat_input" id="search-contacts" type="text" placeholder="Search">
                        </div>
                        <h5>Contacts</h5>
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
                                                <h5>Alexander Manuel</h5>
                                                <p>Active 4Min Ago</p>
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
                                                <h5>Annette Theriot</h5>
                                                <p>Online</p>
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
                                                <h5>Bacon Mark</h5>
                                                <p>Active 8Min Ago</p>
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
                                                <h5>Bennett Gerard</h5>
                                                <p>Last Seen Today at 12:35 AM</p>
                                            </div>    
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x me-1"></i>Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <img src="assets/img/icon/send.svg" class="me-1" alt="image">Send
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /New Chat -->

    <!-- New Group -->
    <div class="modal fade " id="new-group">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        New Group
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-profiles-group mb-4">
                        <div class="profile-cover text-center">
                            <label class="profile-cover-avatar" for="avatar_upload">
                                <img class="avatar-img" src="assets/img/avatar/avatar-2.jpg" alt="Profile Image">
                                <input type="file" id="avatar_upload">
                                <span class="avatar-edit">
                                     <img src="assets/img/icon/camera.svg" alt="Image">
                                </span>
                            </label>
                        </div>
                        <form >
                            <div class="pass-login">
                                <label class="form-label">Group Subject </label>
                                <input type="password" class="form-control pass-input">
                            </div>
                            <div class="pass-login">
                                <label class="form-label">Group Type</label>
                                <select class="select">
                                    <option>Select Type</option>
                                    <option >Personal</option>
                                </select>
                            </div>
                            <div class="pass-login">
                                <label class="form-label">Group Description </label>
                                <textarea class="form-control "></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x me-1"></i>Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-check me-1"></i>Create
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /New Group -->

    <!-- New Group -->
    <div class="modal fade " id="invite-other">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Invite Friends
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-profiles-group mb-4">
                        <div class="pass-login">
                            <label class="form-label">Invite Friends</label>
                            <input type="password" class="form-control pass-input">
                        </div>
                        <div class="pass-login">
                            <label class="form-label">Invitation Message </label>
                            <textarea class="form-control " ></textarea>
                        </div>
                    </div>
                    <div class="mute-chat-btn">                            
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x me-1"></i>Cancel
                        </a>
                        <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-plus me-1"></i>Send Invitation
                        </a>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <!-- /New Group -->
    
</div>
<!-- /Main Wrapper -->  
<?php $this->load->view('includes/footer'); ?>	
