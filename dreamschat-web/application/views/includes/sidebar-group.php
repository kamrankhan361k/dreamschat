<?php
$session = $this->session->userdata('username');
$lang = ($session['language'] != '')?$session['language']:'En';
$ul = custom_language($session['user'], $lang);
?>
<!-- sidebar group -->
<div class="sidebar-group left-sidebar chat_sidebar d-none" id="group-sidebar">

    <!-- Chats sidebar -->
    <div id="chats" class="left-sidebar-wrap sidebar active slimscroll">

        <div class="slimscroll">

           <!-- Left Chat Title -->
           <div class="left-chat-title all-chats d-flex justify-content-between align-items-center">
                <div class="select-group-chat">
                    <div class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <?php echo ($ul['sidebar-group']['all_chats'])?$ul['sidebar-group']['all_chats']: "All Chats"; ?>
                        </a>
                       
                    </div>
                </div>
                <div class="add-section">
                    <ul>
                        <li><a href="javascript:;" class="user-chat-search-btn"><i class="bx bx-search"></i></a></li>
                        <li >
                            <div class="chat-action-btns">
                                <div class="chat-action-col">
                                    <a class="#" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" >
                                        <!-- <a href="javascript:;" class="dropdown-item " data-bs-toggle="modal" data-bs-target="#new-chat"><span><i class="bx bx-message-rounded-add"></i></span>New Chat </a> -->
                                        <a href="javascript:;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#new-group"><span><i class="bx bx-user-circle"></i></span><?php echo ($ul['sidebar-group']['create_group'])?$ul['sidebar-group']['create_group']: "Create Group"; ?></a>
                                        <!-- <a href="javascript:;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#invite-other"><span><i class="bx bx-user-plus"></i></span>Invite Others</a> -->
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- Chat Search -->
                    <div class="user-chat-search">
                        <form>
                            <span class="form-control-feedback"><i class="bx bx-search" ></i></span>
                            <input type="text" id="search-group" name="chat-search" placeholder="Search" class="form-control">
                            <div class="user-close-btn-chat"><span class="material-icons"><?php echo ($ul['sidebar-group']['close'])?$ul['sidebar-group']['close']: "Close"; ?></span></div>
                        </form>
                    </div>
                    <!-- /Chat Search -->
                </div>
           </div>
           <!-- /Left Chat Title -->

            <div class="sidebar-body chat-body" id="chatsidebar">
               
                <!-- Left Chat Title -->
                <!-- <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                    <div class="fav-title pin-chat">
                        <h6>Archived </h6>
                    </div>
                </div> -->
                <!-- /Left Chat Title -->

                <!-- <ul class="user-list">
                    <li class="user-list-item">
                        <a href="javascript:;" >
                            <div class="avatar avatar-online">
                                <img src="assets/img/avatar/avatar-1.jpg" class="rounded-circle" alt="image">
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>User Research</h5>
                                    <p>Hollis:<i class="feather-image ms-1 me-1"></i>Photo</p>
                                </div>
                                <div class="last-chat-time">
                                    <small class="text-muted">10:20 PM</small>
                                    <div class="chat-pin">
                                        <div class="chat-hover">
                                            <div class="chat-action-col">
                                                <span class="d-flex" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </span>
                                                <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                    <span class="dropdown-item "><span><i class="bx bx-archive-in"></i></span>Archive Chat </span>
                                                    <span class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mute-notification"><span><i class="bx bx-volume-mute"></i></span>Mute Notification</span>
                                                    <span class="dropdown-item" ><span><i class="bx bx-log-out"></i></span>Exit Group</span>
                                                    <span class="dropdown-item" ><span><i class="bx bx-pin"></i></span>Unpin Chat</span>
                                                    <span class="dropdown-item" ><span><i class="bx bx-check-square"></i></span>Mark as Unread</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </a>
                    </li>
                </ul> -->
                <!-- Left Chat Title -->
                <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                    <div class="fav-title pin-chat">
                        <h6 class="recent-groups d-none"><?php echo ($ul['sidebar-group']['recent_groups'])?$ul['sidebar-group']['recent_groups']: "Recent Groups"; ?></h6>
                    </div>
                </div>
                <!-- /Left Chat Title -->
                <ul class="user-list group-user-list">
                    <li class="user-list-item">
                        <!-- <a href="javascript:;" >
                            <div class="avatar">
                                <img src="assets/img/avatar/avatar-1.jpg" class="rounded-circle" alt="image">
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>UI UX Designer</h5>
									<p>James:<i class="feather-video ms-1 me-1"></i>Video</p>
                                </div>
                                <div class="last-chat-time">
                                    <small class="text-muted">10:20 PM</small>
                                    <div class="chat-pin">
                                        <div class="chat-hover">
                                            <div class="chat-action-col">
                                                <span class="d-flex" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </span>
                                                <div class="dropdown-menu chat-drop-menu dropdown-menu-end" >
                                                    <span class="dropdown-item "><span><i class="bx bx-archive-in"></i></span>Archive Chat </span>
                                                    <span class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mute-notification"><span><i class="bx bx-volume-mute"></i></span>Mute Notification</span>
                                                    <span class="dropdown-item" ><span><i class="bx bx-log-out"></i></span>Exit Group</span>
                                                    <span class="dropdown-item" ><span><i class="bx bx-pin"></i></span>Unpin Chat</span>
                                                    <span class="dropdown-item" ><span><i class="bx bx-check-square"></i></span>Mark as Unread</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </a>
                    </li>
                    <li class="user-list-item">
                        <a href="javascript:;" >
                            <div>
                                <div class="avatar avatar-online">
                                    <img src="assets/img/avatar/avatar-3.jpg" class="rounded-circle" alt="image">
                                </div>
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>Graphics Team</h5>
									<p><span class="animate-typing-col">Typing
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        <span class="dot"></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="last-chat-time">
									<small class="text-muted">Just Now</small>
									<div class="new-message-count">11</div>                                                
								</div>
                            </div>
                        </a>
                    </li>
                    <li class="user-list-item">
                        <a href="javascript:;" >
                            <div class="avatar">
                                <img src="assets/img/avatar/avatar-4.jpg" class="rounded-circle" alt="image">
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>HTML Team</h5>
                                    <p>Debra:<i class="feather-file-text me-1"></i>Sticker</p>
                                </div>
                                <div class="last-chat-time">
									<small class="text-muted">Just Now</small>
									<div class="new-message-count">11</div>
								</div>   
                            </div>
                        </a>
                    </li>
                    <li class="user-list-item">
                        <a href="javascript:;" >
                            <div>
                                <div class="avatar avatar-online">
                                    <img src="assets/img/avatar/avatar-9.jpg" class="rounded-circle" alt="image">
                                </div>
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>Columbus Studios</h5>
                                    <p>Horace:<i class="feather-file-text ms-1 me-1"></i>Design Guide....</p>
                                </div>
								<div class="last-chat-time">
									<small class="text-muted">Just Now</small>
									<div class="new-message-count">11</div>
								</div>
                            </div>
                        </a>
                    </li>
                    <li class="user-list-item">
                        <a href="javascript:;" >
                            <div>
                                <div class="avatar ">
                                    <img src="assets/img/avatar/avatar-7.jpg" class="rounded-circle" alt="image">
                                </div>
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>Themeforest Group</h5>
                                    <p>Jones:https://youtube...</p>
                                </div>
                                <div class="last-chat-time">
									<small class="text-muted">Just Now</small>
									<div class="new-message-count">11</div>
								</div>
                            </div>
                        </a>
                    </li>
                    <li class="user-list-item">
                        <a href="javascript:;" >
                            <div>
                                <div class="avatar avatar-online">
                                    <img src="assets/img/avatar/avatar-8.jpg" class="rounded-circle" alt="image">
                                </div>
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>Competition Team </h5>
                                    <p >+91 8888888888 joined using...</p>
                                </div>
                                <div class="last-chat-time">
									<small class="text-muted">Just Now</small>
									<div class="new-message-count">11</div>
								</div>
                            </div>
                        </a>
                    </li>
                    <li class="user-list-item">
                        <a href="javascript:;" >
                            <div>
                                <div class="avatar">
                                    <img src="assets/img/avatar/avatar-5.jpg" class="rounded-circle" alt="image">
                                </div>
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>Cricket Team</h5>
                                    <p>Smith:Ok Sure</p>
                                </div>
                                <div class="last-chat-time">
									<small class="text-muted">Just Now</small>
								</div>
                            </div>
                        </a>
                    </li>
                    <li class="user-list-item">
                        <a href="javascript:;" >
                            <div>
                                <div class="avatar avatar-online">
                                    <img src="assets/img/avatar/avatar-6.jpg" class="rounded-circle" alt="image">
                                </div>
                            </div>
                            <div class="users-list-body">
                                <div>
                                    <h5>Dreamguys</h5>
                                    <p>Have you called them?</p>
                                </div>
                                <div class="last-chat-time">
                                    <small class="text-muted">10:20 PM</small>
                                </div>
                            </div>
                        </a> -->
                    </li>
                </ul>
            </div>

        </div>

    </div>
    <!-- / Chats sidebar -->
</div>
<!-- /Sidebar group -->