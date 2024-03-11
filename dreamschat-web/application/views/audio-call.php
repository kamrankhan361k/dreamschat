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

    <!-- content -->
    <div class="content main_content">
        <?php //$this->load->view('includes/leftsidebar'); ?>
             <!-- Chat -->
            <div class="chat video-screen" id="middle">
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
                        <figure class="avatar ms-1" id="caller-user-image">
                            <!-- <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="image"> -->
                        </figure>
                        <div class="mt-1">
                            <h5 id="callerUerName"></h5>
                            <small class="last-seen" id="mobileNumber">
                                <!-- 555-66-666-55 -->
                            </small>
                        </div>
                    </div>
                    <div class="chat-options chat-contact-list">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light" href="#" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded" ></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" >
                                    <a href="#" class="dropdown-item "><span><i class="bx bx-x" ></i></span><?php echo ($ul['audio-call']['close_chat'])?$ul['audio-call']['close_chat']: "Close Chat"; ?></a>
                                    <a href="#" class="dropdown-item"><span><i class="bx bx-volume-mute"></i></span><?php echo ($ul['audio-call']['mute_notification'])?$ul['audio-call']['mute_notification']: "Mute Notification"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disappearing-messages"><span><i class="bx bx-time-five"></i></span><?php echo ($ul['audio-call']['disappearing_message'])?$ul['audio-call']['disappearing_message']: "Disappearing Message"; ?></a>
                                    <a href="#" class="dropdown-item"><span><i class="bx bx-brush-alt"></i></span><?php echo ($ul['audio-call']['clear_message'])?$ul['audio-call']['clear_message']: "Clear Message"; ?></a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change-chat"><span><i class="bx bx-trash-alt"></i></span><?php echo ($ul['audio-call']['delete_chat'])?$ul['audio-call']['delete_chat']: "Delete Chat"; ?></a>
                                    <a href="#" class="dropdown-item"><span><i class="bx bx-dislike"></i></span><?php echo ($ul['audio-call']['report'])?$ul['audio-call']['report']: "Report"; ?></a>
                                    <a href="#" class="dropdown-item" ><span><i class="bx bx-block"></i></span><?php echo ($ul['audio-call']['block'])?$ul['audio-call']['block']: "Block"; ?></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="chat-body pt-4 pb-0">
                    <div class="video-screen-inner audio-screen-inner">
                        <div class="more-icon">
                            <a href="#" class="mic-off">
                                <i class="feather-mic-off"></i>
                            </a>
                        </div>
                        <div class="audio-call-group">
                            <div>
                                <figure class="avatar" id="rece-user-image">
                                    <!-- <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="image"> -->
                                </figure>
                                <h6 id="receuserName"></h6>
                                <span><input type="text" id="total_time" value="0" class="input-transparent" disabled></span>
                                <div class="record-time d-none">
                                    <span id="hour" class="timeel hours" style="display:none">00</span>
                                    <span id="min" class="timeel minutes" style="display:none">00</span>
                                    <span id="sec" class="timeel seconds" style="display:none">00</span>
                                </div>
                            </div>
                        </div>
                        <div class="video-call-action action-calls">
                            <ul class="center-action d-flex">
                                <!-- <li>
                                    <a class="mute-bt" href="javascript:void(0);" >
                                        <i class="feather-mic"  ></i>
                                    </a>
                                </li> -->

                                <li><a href="#" class="call-mute">
                                    <span id="mic-btn-unmute" class="material-icons" style="display:none"><?php echo ($ul['audio-call']['volumeoff'])?$ul['audio-call']['volumeoff']: "volume_off"; ?></span>
                                    <span id="mic-btn-mute" class="material-icons" style="display:block"><?php echo ($ul['audio-call']['volumeup'])?$ul['audio-call']['volumeup']: "volume_up"; ?></span>
                                </a></li>
                                <li><a href="#" class="call-end" id="leave"><i class="feather-phone-off"  ></i></a></li>
                                <?php if($this->input->get('call_type') == 'video') { ?>
                                    <li><a href="#" class="call-mute">
                                        <span id="video-btn-unmute" class="material-icons" style="display:none"><?php echo ($ul['audio-call']['videocamoff'])?$ul['audio-call']['videocamoff']: "videocam_off"; ?></span>
                                        <span id="video-btn-mute" class="material-icons" style="display:block"><?php echo ($ul['audio-call']['videocamup'])?$ul['audio-call']['videocamup']: "videocam_up"; ?></span>
                                    </a></li>
                                <?php } ?>

                                <!-- <li >
                                    <a class="mute-video" href="javascript:void(0);">
                                        <i class="feather-video"  ></i>
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Chat -->

        </div> 
        <!-- /Content -->
        
    </div>
    <!-- /Main Wrapper -->
    <form id="join-form">
        <button id="join" type="submit" class="btn btn-primary btn-sm" style="display:none"><?php echo ($ul['audio-call']['join'])?$ul['audio-call']['join']: "Join"; ?></button>
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
      <script src="<?php echo base_url(); ?>assets/js/mainconfig.js"></script>
      <script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/fireconfig.js"></script>
      <script src="./calls/index.js"></script>
      
<script type="text/javascript">
    $(document).ready(function(){
        document.getElementById("join").click();
    });
</script>
    <?php $this->load->view('includes/footer'); ?>