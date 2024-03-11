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
<?php 
    $caller = $this->input->get('caller');
    $currentUser = $this->input->get('currentuser');
 ?>
 <?php 
    $caller = $this->input->get('caller');
    $currentUser = $this->input->get('currentuser');
    $current_time = date('F jS, Y | h:i A', time());
 ?>
 <style type="text/css">
     .player div {
        position: absolute !important;
     }

     .player {
        height: 100% !important;
     }
     .video-screen-inner {
        z-index: 1;
    }
 </style>
  <input id="appid" type="hidden" placeholder="enter appid" value="<?php echo getenv('DB_AGORA_APIID')?>">
    <input id="channel" type="hidden" placeholder="enter channel name" value="<?php echo $this->input->get('channelname'); ?>">
    <input id="call_type" type="hidden" plceholder="enter call type" value="<?php echo $this->input->get('call_type'); ?>">
    <input id="caller" type="hidden" placeholder="" value="<?php echo $this->input->get('caller'); ?>">
    <input id="receiver" type="hidden" placeholder="" value="<?php echo $this->input->get('receiver'); ?>">
    <input id="current_user" type="hidden" placeholder="" value="<?php echo $this->input->get('currentuser'); ?>">
    <input id="cid" type="hidden" placeholder="" value="<?php echo $this->input->get('cid'); ?>">
    <input type="hidden" id="total_time1" value="0">
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

            <!-- Left Sidebar Menu -->
            <div class="sidebar-menu">
                <div class="logo-col">
                    <a href="index.html"><img src="assets/img/logo.png" alt="Logo"></a>
                </div>
                <div class="menus-col">
                    <div class="chat-menus">
                        <ul>
                            <li>
                                <a href="index.html" class="chat-unread active" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Chat">
                                    <i class="bx bx-message-square-dots"></i>
                                </a>
                            </li>
                            <li>
                                <a href="group.html" class="chat-unread" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Group">
                                    <i class="bx bx-group"></i>
                                </a>
                            </li>
                            <li>
                                <a href="empty-status.html" class="chat-unread" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Status">
                                    <i class="bx bx-stop-circle"></i>
                                </a>
                            </li>
                            <li>
                                <a href="call.html" class="chat-unread" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Call">
                                    <i class="bx bx-phone"></i>
                                </a>
                            </li>
                            <li>
                                <a href="contact.html" class="chat-unread" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Contact">
                                    <i class="bx bx-user-pin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="settings.html" class="chat-unread" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Settings">
                                    <i class="bx bx-cog"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="bottom-menus">
                        <ul>
                            <li>
                                <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
                                    <i class="bx bx-moon"></i>
                                </a>
                            </li>
                            <li>
                                <div class="avatar avatar-online">
                                    <a href="<?php echo base_url(); ?>" class="chat-profile-icon" data-bs-toggle="dropdown">
                                        <img id="current-user-profile-left" src="" alt="">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="settings.html" class="dropdown-item"><span><i class="bx bx-cog"></i></span><?php echo ($ul['group-callpage']['settings'])?$ul['group-callpage']['settings']: "Settings"; ?></a>
                                        <a href="email-login.html" class="dropdown-item"><span><i class="bx bx-log-out"></i></span><?php echo ($ul['group-callpage']['logout'])?$ul['group-callpage']['logout']: "Logout"; ?></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Left Sidebar Menu -->
            <!-- Chat -->
            <div class="join-grid">
                <div class="slimscroll">
                    <div class="meeting-list">
                        <div class="recession-meet-blk">
                            <div class="reccession-head">
                                <h5 id="current_user_name"></h5>
                                <ul class="nav">
                                    <li><?php echo $current_time;?> </li>
                                    <li class="recording-time">
                                        <span>Recording<input type="text" id="total_time" value="0" class="input-transparent" disabled></span>
                                        <span id="hour" class="timeel hours" style="display:none">00</span>
                                        <span id="min" class="timeel minutes" style="display:none">00</span>
                                        <span id="sec" class="timeel seconds" style="display:none">00</span>  
                                    </li>
                                </ul>
                            </div>
                            <!-- <div class="partispant-blk">
                                <a href="javascript:;" class="btn btn-primary "><i class="feather-plus me-1"></i>Add Participant</a>
                            </div> -->
                        </div>
                        <!-- Grid View -->
                        <div class="join-contents grid-view fade-whiteboard vid-call" id="group-call-users">
                            <div class="loc-call"></div>
                        </div>

                        <div class="video-call-action video-grid action-calls">
                            <ul class="center-action d-flex">
                                <li>
                                    <a href="#" class="call-mute">
                                        <span id="mic-btn-unmute" class="material-icons" style="display:none">volume_off</span>
                                        <span id="mic-btn-mute" class="material-icons" style="display:block">volume_up</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="call-end"  id="leave"><i class="feather-phone-off"  ></i></a>
                                </li>
                                <?php if($this->input->get('call_type') == 'video') { ?>
                                    <li>
                                        <a href="#" class="call-mute">
                                            <span id="video-btn-unmute" class="material-icons" style="display:none">videocam_off</span>
                                            <span id="video-btn-mute" class="material-icons video-off" style="display:block">videocam_up</span>
                                        </a>
                                    </li>
                                <?php } ?>
                                
                            </ul>
                        </div>
                        <!-- /Grid View -->
                        
                    </div>
                </div>
            </div>

        </div> 
        <!-- /Content -->
        
    <form id="join-form">
        <button id="join" type="submit" class="btn btn-primary btn-sm" style="display:none">Join</button>
    </form>
    <input type="hidden" id="appid" value="<?php echo getenv('DB_AGORA_APIID')?>">
    <input type="hidden" id="apiKey" value="<?php echo getenv('DB_FIREBASE_APIKEY')?>" />
    <input type="hidden" id="authDomain" value="<?php echo getenv('DB_FIREBASE_AUTHDOMAIN')?>" />
    <input type="hidden" id="databaseURL" value="<?php echo getenv('DB_FIREBASE_DBURL')?>" />
    <input type="hidden" id="projectId" value="<?php echo getenv('DB_FIREBASE_PROJECTID')?>" />
    <input type="hidden" id="storageBucket" value="<?php echo getenv('DB_FIREBASE_STORAGEBUGKET')?>" />
    <input type="hidden" id="messagingSenderId" value="<?php echo getenv('DB_FIREBASE_MESSAGEID')?>" />
    <input type="hidden" id="appId" value="<?php echo getenv('DB_FIREBASE_APPID')?>" />
    <input type="hidden" id="baseUrl" value="<?php echo base_url()?>" />
    <input type="hidden" id="groupcallids" value="" />
    <input type="hidden" id="currentcalluser" value="<?php echo $this->session->userdata('username')['user'] ?>" />
      <script src="./calls/vendor/jquery-3.4.1.min.js"></script>
      <script src="./calls/vendor/bootstrap.bundle.min.js"></script>
      <script src="./calls/AgoraRTC_N-4.14.0.js"></script>
      <script src="./calls/index.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/mainconfig.js"></script>
      <script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/fireconfig.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        document.getElementById("join").click();
    });
</script>
    <?php $this->load->view('includes/footer'); ?>