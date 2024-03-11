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

    <!-- content -->
    <div class="content main_content">
        <?php //$this->load->view('includes/leftsidebar'); ?>
            <!-- Video Screen -->
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
                       <!--  <figure class="avatar ms-1" id="videouserImg">
                            <img src="assets/img/avatar/avatar-2.jpg" class="rounded-circle" alt="image">
                        </figure> -->
                        <div class="mt-1">
                            <h5 id="current_user_name"></h5>
                            <p><?php echo $current_time;?></p>
                        </div>
                    </div>
                </div>
                <div class="chat-body pt-4 pb-0">
                    <div class="video-screen-inner vid-call">
                        <div class="call-user-avatar">
                            <div class="avatar-col">
                                <div class="loc-call"></div>
                            </div>
                        </div>
                       
                        <div class="record-time">
                            <span><input type="text" id="total_time" value="0" class="input-transparent" disabled></span>
                            <span id="hour" class="timeel hours" style="display:none">00</span>
                            <span id="min" class="timeel minutes" style="display:none">00</span>
                            <span id="sec" class="timeel seconds" style="display:none">00</span>    
                        </div>

                        <div class="video-call-action action-calls">
                            <ul class="center-action d-flex">
                                <li><a href="#" class="call-mute">
                                    <span id="mic-btn-unmute" class="material-icons" style="display:none">volume_off</span>
                                    <span id="mic-btn-mute" class="material-icons" style="display:block">volume_up</span>
                                </a></li>

                                <li><a href="#" class="call-end"  id="leave"><i class="feather-phone-off"  ></i></a></li>
                                <?php if($this->input->get('call_type') == 'video') { ?>
                                    <li><a href="#" class="call-mute">
                                        <span id="video-btn-unmute" class="material-icons" style="display:none">videocam_off</span>
                                        <span id="video-btn-mute" class="material-icons video-off" style="display:block">videocam_up</span>
                                    </a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="video-avatar"><h4>Camera is off</h4></div>
                    </div>
                    
                </div>
            </div>
            <!-- /Chat -->

        </div> 
        <!-- /Content -->
        
    </div>
    <!-- /Main Wrapper -->

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