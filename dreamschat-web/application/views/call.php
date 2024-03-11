<?php
$session = $this->session->userdata('username');
$lang = ($session['language'] != '')?$session['language']:'En';
$ul = custom_language($session['user'], $lang);
?>
<?php 
    $this->load->view('includes/header');
    /*$session = $this->session->userdata('username');
    $ul = custom_language($session['user'], $session['language']);*/
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
        <?php $this->load->view('includes/leftsidebar'); ?>
        <!-- sidebar group -->
            <div class="sidebar-group left-sidebar chat_sidebar" id="call-sidebar">

                <!-- Chats sidebar -->
                <div id="chats" class="left-sidebar-wrap sidebar active slimscroll">

                    <div>

                       <!-- Left Chat Title -->
                       <div class="left-chat-title all-chats d-flex justify-content-between align-items-center">
                            <div class="select-group-chat">
                                <div class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown">
                                       <?php echo ($ul["callpage"]["all_calls"])?$ul["callpage"]["all_calls"]:"All Calls"; ?> <!-- <i class="fas fa-chevron-down"></i> -->
                                    </a>
                                    <!-- <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:;">Archive Call</a></li>
                                    </ul> -->
                                </div>
                            </div>
                            <div class="add-section">
                                <ul>
                                    <li><a href="javascript:;" class="user-chat-search-btn"><i class="bx bx-search"></i></a></li>
                                </ul>
                                <!-- Chat Search -->
                                <div class="user-chat-search">
                                    <form>
                                        <span class="form-control-feedback"><i class="bx bx-search" ></i></span>
                                        <input type="text" name="chat-search" placeholder="Search" class="form-control" id="callUsers">
                                        <div class="user-close-btn-chat"><span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span></div>
                                    </form>
                                </div>
                                <!-- /Chat Search -->
                            </div>
                       </div>
                       <!-- /Left Chat Title -->

                        <div class="sidebar-body chat-body" id="chatsidebar">
                           
                            <!-- Left Chat Title -->
                            <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                <div class="fav-title pin-chat">
                                    <h6 class="recent-calls d-none">Recent Calls</h6>
                                </div>
                            </div>
                            <!-- /Left Chat Title -->

                            <ul class="user-list call-user-list">
                               
                            </ul>
                        </div>

                    </div>

                </div>
                <!-- / Chats sidebar -->
            </div>
            <!-- /Sidebar group -->
        <!-- Chat -->
            <div class="chat call-log-group" id="middle">
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
                            <figure class="avatar ms-1" id="selected_userimage">

                            </figure>
                            <div class="mt-1">
                                <h5 id="selected_username"></h5>
                                <small class="last-seen" id="selected_usertime">
                                </small>
                            </div>
                        </div>
                        <div class="chat-options chat-contact-list d-none">
                            <ul class="list-inline">
                                <li class="list-inline-item" >
                                    <a href="javascript:void(0);" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Video Call"  onclick="onetoonenew('video');">
                                        <i class="bx bx-video "></i>
                                    </a>
                                </li>
                                <li class="list-inline-item" >
                                    <a href="javascript:void(0);" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Voice Call"  onclick="onetoonenew('audio');">
                                        <i class="bx bx-phone" ></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-outline-light no-bg" href="#" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" >
                                    
                                        <a href="#" class="dropdown-item" onclick="delete_callhistory()"><span><i class="bx bx-trash"></i></span><?php echo ($ul['callpage']['clear_call_history'])?$ul['callpage']['clear_call_history']: "Clear Call History"; ?></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="chat status-middle-bar d-flex align-items-center justify-content-center">
                        <div class="status-right">
                            <div class="empty-chat-img"><img src="assets/img/empty-img-01.png" alt="Image"></div>
                            <div class="select-message-box">
                                <p>Contact Users Not Found, Kindly create new contact in your contact module.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-body slimscroll">
                        <div class="messages" id="callList">
                            
                        </div>
            <!-- /Chat -->

                    </div> 
        <!-- /Content -->

        <!-- Mute -->
        <div class="modal fade mute-notify" id="mute-notification">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?php echo ($ul['callpage']['mute_notification'])?$ul['callpage']['mute_notification']: "Mute Notifications"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="notify-check">
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['callpage']['15_minutes'])?$ul['callpage']['15_minutes']: "15 Minutes"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['callpage']['1_hour'])?$ul['callpage']['1_hour']: "1 Hour"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['callpage']['1_day'])?$ul['callpage']['1_day']: "1 Day"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['callpage']['1_week'])?$ul['callpage']['1_week']: "1 Week"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['callpage']['1_month'])?$ul['callpage']['1_month']: "1 Month"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                <label class="custom-check mt-0 mb-0">
                                    <span class="remember-me"><?php echo ($ul['callpage']['always'])?$ul['callpage']['always']: "Always"; ?></span>
                                    <input type="checkbox" name="remeber">                                        
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mute-chat-btn">
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['callpage']['mute'])?$ul['callpage']['mute']: "Mute"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
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
                            <?php echo ($ul['callpage']['block_mark_villiams'])?$ul['callpage']['block_mark_villiams']: "Block Mark Villiams"; ?>
                            
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <img src="assets/img/icon/block.svg"  alt="icon">
                            <p><?php echo ($ul['callpage']['blocked_contacts'])?$ul['callpage']['blocked_contacts']: "Blocked contacts will no longer be able to call you or send you messages."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                  <?php echo ($ul['callpage']['block'])?$ul['callpage']['block']: "Block"; ?>
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
                            <?php echo ($ul['callpage']['report_mark_villiams'])?$ul['callpage']['report_mark_villiams']: "Report Mark Villiams"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <img src="assets/img/icon/report-01.svg"  alt="icon">
                            <p><?php echo ($ul['callpage']['if_you_block'])?$ul['callpage']['if_you_block']: "If you block this contact and clear the chat, messages will only be removed from this device and your devices on the newer versions of Dreamschat"; ?></p>
                            <div class="notify-check">
                                <div class="form-check d-flex align-items-center justify-content-center ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me"><?php echo ($ul['callpage']['block_contact'])?$ul['callpage']['block_contact']: "Block contact and clear chat"; ?></span>
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['callpage']['report'])?$ul['callpage']['report']: "Report"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
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
                          <?php echo ($ul['callpage']['delete_chat'])?$ul['callpage']['delete_chat']: "Delete Chat"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <img src="assets/img/icon/delete-chat-01.svg"  alt="icon">
                            <p><?php echo ($ul['callpage']['clearing_deleting'])?$ul['callpage']['clearing_deleting']: "Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of Dreamschat."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                 <?php echo ($ul['callpage']['continue'])?$ul['callpage']['continue']: "Continue"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                 <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
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
                          
                            <?php echo ($ul['callpage']['disappearing_messages'])?$ul['callpage']['disappearing_messages']: "Disappearing messages"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk">
                            <p><?php echo ($ul['callpage']['for_more_privacy'])?$ul['callpage']['for_more_privacy']: "For more privacy and storage, all new messages will disappear from this chat for everyone after the selected duration, except when kept. Anyone in the chat can change this setting."; ?></p>
                            <div class="notify-check">
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me"><?php echo ($ul['callpage']['24_hours'])?$ul['callpage']['24_hours']: "24 Hours"; ?></span>
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me"><?php echo ($ul['callpage']['7_days'])?$ul['callpage']['7_days']: "7 Days"; ?></span>
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me"><?php echo ($ul['callpage']['90_days'])?$ul['callpage']['90_days']: "90 Days"; ?></span>
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center justify-content-start ps-0">
                                    <label class="custom-check mt-0 mb-0">
                                        <span class="remember-me"><?php echo ($ul['callpage']['off'])?$ul['callpage']['off']: "Off"; ?></span>
                                        <input type="checkbox" name="remeber">                                        
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['callpage']['save'])?$ul['callpage']['save']: "Save"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                   <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
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
                           
                            <?php echo ($ul['callpage']['change_toclearing'])?$ul['callpage']['change_toclearing']: "Changes to Clearing or Deleting a Chat"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <img src="assets/img/icon/delete-chat-01.svg"  alt="icon">
                            <p><?php echo ($ul['callpage']['cleaning_or_deleting_entire'])?$ul['callpage']['cleaning_or_deleting_entire']: "Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of Dreamschat."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                               <?php echo ($ul['callpage']['continue'])?$ul['callpage']['continue']: " Continue"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                 <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Deleting a Chat -->

        <!-- Forward Message To -->
        <div class="modal fade " id="forward-message">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                          
                            <?php echo ($ul['callpage']['forward_message_to'])?$ul['callpage']['forward_message_to']: "Forward Message To"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-block-group mb-4">
                            <div class="search_chat has-search">
                                <span class="fas fa-search form-control-feedback"></span>
                                <input class="form-control chat_input" id="search-contacts" type="text" placeholder="Search">
                            </div>
                            <h5><?php echo ($ul['callpage']['recent_chats'])?$ul['callpage']['recent_chats']: "Recent Chats"; ?></h5>
                            <div class="recent-block-group">
                                <div class="user-block-profile">
                                    <div class="avatar">
                                        <img src="assets/img/avatar/avatar-1.jpg" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="block-user-name">
                                        <h6><?php echo ($ul['callpage']['horace_keene'])?$ul['callpage']['horace_keene']: "Horace Keene"; ?></h6>
                                        <span><?php echo ($ul['callpage']['sleeping'])?$ul['callpage']['sleeping']: "Sleeping"; ?></span>
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
                                        <h6><?php echo ($ul['callpage']['bacon_mark'])?$ul['callpage']['bacon_mark']: "Bacon Mark"; ?></h6>
                                        <span><?php echo ($ul['callpage']['available'])?$ul['callpage']['available']: "Available"; ?></span>
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
                                        <h6><?php echo ($ul['callpage']['debra_jones'])?$ul['callpage']['debra_jones']: "Debra Jones"; ?></h6>
                                        <span><?php echo ($ul['callpage']['at_work'])?$ul['callpage']['at_work']: "At Work"; ?></span>
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
                                        <h6><?php echo ($ul['callpage']['dina_brown'])?$ul['callpage']['dina_brown']: "Dina Brown"; ?></h6>
                                        <span><?php echo ($ul['callpage']['talk_whatsapp'])?$ul['callpage']['talk_whatsapp']: "Can’t Talk, WhatsApp only"; ?></span>
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
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <img src="assets/img/icon/send.svg" class="me-1" alt="image">
                                <?php echo ($ul['callpage']['send'])?$ul['callpage']['send']: "Send"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i> <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
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
                           <?php echo ($ul['callpage']['new_chat'])?$ul['callpage']['new_chat']: "New Chat"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-block-group mb-4">
                            <div class="search_chat has-search">
                                <span class="fas fa-search form-control-feedback"></span>
                                <input class="form-control chat_input" id="search-contacts" type="text" placeholder="Search">
                            </div>
                            <h5><?php echo ($ul['callpage']['contacts'])?$ul['callpage']['contacts']: "Contacts"; ?></h5>
                            <div class="sidebar">
                                <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                    <div class="fav-title contact-title">
                                        <h6><?php echo ($ul['callpage']['a'])?$ul['callpage']['a']: "A"; ?></h6>
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
                                                    <h5><?php echo ($ul['callpage']['alexander_manuel'])?$ul['callpage']['alexander_manuel']: "Alexander Manuel"; ?></h5>
                                                    <p><?php echo ($ul['callpage']['active_4min_ago'])?$ul['callpage']['active_4min_ago']: "Active 4Min Ago"; ?></p>
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
                                                    <h5><?php echo ($ul['callpage']['annette_theriot'])?$ul['callpage']['annette_theriot']: "Annette Theriot"; ?></h5>
                                                    <p><?php echo ($ul['callpage']['online'])?$ul['callpage']['online']: "Online"; ?></p>
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
                                                    <h5><?php echo ($ul['callpage']['bacon_mark'])?$ul['callpage']['bacon_mark']: "Bacon Mark"; ?></h5>
                                                    <p><?php echo ($ul['callpage']['active_8min_ago'])?$ul['callpage']['active_8min_ago']: "Active 8Min Ago"; ?></p>
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
                                                    <h5><?php echo ($ul['callpage']['bennett_gerard'])?$ul['callpage']['bennett_gerard']: "Bennett Gerard"; ?></h5>
                                                    <p><?php echo ($ul['callpage']['last_seen_today_at'])?$ul['callpage']['last_seen_today_at']: "Last Seen Today at 12:35 AM"; ?></p>
                                                </div>    
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mute-chat-btn">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i> <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <img src="assets/img/icon/send.svg" class="me-1" alt="image"><?php echo ($ul['callpage']['send'])?$ul['callpage']['send']: "Send"; ?>
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
                           <?php echo ($ul['callpage']['new_group'])?$ul['callpage']['new_group']: "New Group"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
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
                                    <label class="form-label"> <?php echo ($ul['callpage']['group_subject'])?$ul['callpage']['group_subject']: "Group Subject"; ?> </label>
                                    <input type="password" class="form-control pass-input">
                                </div>
                                <div class="pass-login">
                                    <label class="form-label"><?php echo ($ul['callpage']['group_type'])?$ul['callpage']['group_type']: "Group Type"; ?></label>
                                    <select class="select">
                                        <option><?php echo ($ul['callpage']['select_type'])?$ul['callpage']['select_type']: "Select Type"; ?></option>
                                        <option ><?php echo ($ul['callpage']['personal'])?$ul['callpage']['personal']: "Personal"; ?></option>
                                    </select>
                                </div>
                                <div class="pass-login">
                                    <label class="form-label"><?php echo ($ul['callpage']['group_description'])?$ul['callpage']['group_description']: "Group Description"; ?> </label>
                                    <textarea class="form-control " ></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="mute-chat-btn">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-check me-1"></i><?php echo ($ul['callpage']['create'])?$ul['callpage']['create']: "Create"; ?>
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
                            <?php echo ($ul['callpage']['invite_friends'])?$ul['callpage']['invite_friends']: "Invite Friends"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-profiles-group mb-4">
                            <form>
                                <div class="pass-login">
                                    <label class="form-label"><?php echo ($ul['callpage']['invite_friends'])?$ul['callpage']['invite_friends']: "Invite Friends"; ?></label>
                                    <input type="password" class="form-control pass-input">
                                </div>
                                <div class="pass-login">
                                    <label class="form-label"><?php echo ($ul['callpage']['invitation_message'])?$ul['callpage']['invitation_message']: "Invitation Message"; ?> </label>
                                    <textarea class="form-control " ></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="mute-chat-btn">
                           
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-plus me-1"></i><?php echo ($ul['callpage']['send_invitation'])?$ul['callpage']['send_invitation']: "Send Invitation"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /New Group -->
        <!-- Block -->
        <div class="modal fade" id="block-user">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?php echo ($ul['callpage']['block_mark_villiams'])?$ul['callpage']['block_mark_villiams']: "Block Mark Villiams"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <i class="bx bx-block change-color "></i>
                            <p><?php echo ($ul['callpage']['blocked_contacts_will'])?$ul['callpage']['blocked_contacts_will']: "Blocked contacts will no longer be able to call you or send you messages."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['callpage']['block'])?$ul['callpage']['block']: "Block"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Block -->

          <!-- Deleting a Chat -->
          <div class="modal fade" id="clear-call">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           
                            <?php echo ($ul['callpage']['delete_call_log'])?$ul['callpage']['delete_call_log']: "Delete Call Log"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['callpage']['close'])?$ul['callpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="block-user-blk text-center">
                            <i class="bx bx-trash change-color "></i>
                            <p><?php echo ($ul['callpage']['clearing_or_deleting_entire'])?$ul['callpage']['clearing_or_deleting_entire']: "Clearing or deleting entire call will only remove call log from this device and your devices on the newer versions of Dreamschat."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <?php echo ($ul['callpage']['cancel'])?$ul['callpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                   <?php echo ($ul['callpage']['delete'])?$ul['callpage']['delete']: "Delete"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Deleting a Chat -->
        <input type="hidden" name="to_call_user" id="to_call_user" value=""/>
        <input type="hidden" name="mode_of_call" id="mode_of_call" value="voice"/>
    </div>
    <!-- /Main Wrapper -->
<?php $this->load->view('includes/footer'); ?>	
