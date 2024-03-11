<?php
$session = $this->session->userdata('username');
$lang = ($session['language'] != '')?$session['language']:'En';
$ul = custom_language($session['user'], $lang);
?>
<!-- sidebar group -->
<div class="sidebar-group left-sidebar chat_sidebar d-none" id="home-sidebar">

    <!-- Chats sidebar -->
    <div id="chats" class="left-sidebar-wrap sidebar active slimscroll">

        <div class="slimscroll">

           <!-- Left Chat Title -->
           <div class="left-chat-title all-chats d-flex justify-content-between align-items-center">
                <div class="select-group-chat">
                    <div class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <?php echo ($ul['sidebargroup']['all_chats'])?$ul['sidebargroup']['all_chats']: " All Chats"; ?> 
                        </a>
                        <!-- <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url();?>home">All Chat</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url();?>home">Archive Chat</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url();?>home">Pinned Chat</a></li>
                        </ul> -->
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
                                        <a href="javascript:;" class="dropdown-item " data-bs-toggle="modal" data-bs-target="#new-chat"><span><i class="bx bx-message-rounded-add"></i></span><?php echo ($ul['sidebargroup']['new_chat'])?$ul['sidebargroup']['new_chat']: "New Chat"; ?> </a>
                                        <!-- <a href="javascript:;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#new-group"><span><i class="bx bx-user-circle"></i></span>Create Group</a> -->
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
                            <input type="text" name="chat-search" id="chat-search" placeholder="Search" class="form-control">
                            <div class="user-close-btn-chat"><span class="material-icons"><?php echo ($ul['sidebargroup']['close'])?$ul['sidebargroup']['close']: "Close"; ?> </span></div>
                        </form>
                    </div>
                    <!-- /Chat Search -->
                </div>
           </div>
           <!-- /Left Chat Title -->        
