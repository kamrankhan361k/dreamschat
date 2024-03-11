<?php 

  $session = $this->session->userdata('username');
if ($this->uri->segment(1) != "logout") {
       
    /*if (!empty($session)) {
        $language = ($session['language'])?$session['language']:'en';
        $ul = custom_language($session['user'], $language);
    }*/

?>

<!-- Busy Screen Modal -->
<div class="modal fade" id="busy_pop_up" role="document">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content voice_content ml-3">                  
            <div class="modal-body voice_body">
                <div class="call-box incoming-box">
                    <div class="call-wrapper">
                        <div class="call-inner">
                            <div class="call-user">
                                <input type="hidden" id="busy_calllink" value="">
                                <div id="busy-username-img"><img alt="User Image" src="assets/img/avatar-8.jpg" class="call-avatar"></div>
                                <h4 id="busy_user">...</h4>
                                <span class="chat_cal">Is busy</span>
                                <span class="chat_cal">Call after some time</span>
                            </div>
                            <div class="call-items">
                                <a href="#" onclick="cancelonetoone();" data-dismiss="modal" class="btn call-item call-end" >
                                    <i class="fas fa-phone-alt phone_icon"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Call Modal -->
<div class="modal fade" id="call_pop" role="document">
    <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content voice_content">
                <div class="modal-body voice_body">
                    <div class="call-box incoming-box">
                        <div class="call-wrapper">
                            <div class="call-inner">
                                <div class="call-user">
                                    <input type="hidden" id="call_link" value="">
                                    <div id="call-username-img"><img alt="User Image" src="assets/img/profile-img.jpg" class="call-avatar"></div>
                                    <h4 id="call_user">...</h4>
                                    <span id="chat_msg" class="chat_cal"></span>
                                </div>
                                <div class="call-items">
                                    <a href="#" onclick="incomingcallclick('decline');" data-dismiss="modal" class="btn call-item call-end" >
                                    <i class="bx bx-x"></i></a>
                                <a href="#" onclick="incomingcallclick('answer');" class="btn call-item call-start" id="call_attend_icon"> 
                                    <i class="fas fa-phone-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
  <?php  } 
    //Get Current User Details
    if (!empty($session)) { 
        ?>

 
        <input type="hidden" id="current-user-number" name="current-user-number" value="<?php echo html_escape($session['user'])?>"/>
        <input type="hidden" id="current-user" name="current-user" value="<?php echo $session['name']; ?>">
        <input type="hidden" id="current-username" name="current-username" value="<?php echo $session['username']; ?>">
    <?php  } else { ?>
        <input type="hidden" id="current-user-number" name="current-user-number" value=""/>
        <input type="hidden" id="current-user" name="current-user" value="">
        <input type="hidden" id="current-username" name="current-username" value="">
    <?php  } ?>
    <script>
        var envData = <?php echo json_encode(['DB_INTERFACE_THEME' => getenv('DB_INTERFACE_THEME')]); ?>;
    </script>

<input type="hidden" id="apiKey" value="<?php echo getenv('DB_FIREBASE_APIKEY')?>" />
<input type="hidden" id="authDomain" value="<?php echo getenv('DB_FIREBASE_AUTHDOMAIN')?>" />
<input type="hidden" id="databaseURL" value="<?php echo getenv('DB_FIREBASE_DBURL')?>" />
<input type="hidden" id="projectId" value="<?php echo getenv('DB_FIREBASE_PROJECTID')?>" />
<input type="hidden" id="storageBucket" value="<?php echo getenv('DB_FIREBASE_STORAGEBUGKET')?>" />
<input type="hidden" id="messagingSenderId" value="<?php echo getenv('DB_FIREBASE_MESSAGEID')?>" />
<input type="hidden" id="appId" value="<?php echo getenv('DB_FIREBASE_APPID')?>" />
<input type="hidden" id="baseUrl" value="<?php echo base_url()?>" />
<input type="hidden" id="appid" value="<?php echo getenv('DB_AGORA_APIID')?>">
<input type="hidden" id="group_id" value="">
<input type="hidden" id="combinationUsers" value="">
<input type="hidden" id="last_message" value="">
<input type="hidden" id="last_message_time" value="">
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.7.0.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrapValidator.min.js"></script>
<?php if ($this->uri->segment(1) == 'forgot-password') { ?>
<script type="text/javascript">
    
    function resetpwd() {
        var email = $('#email').val();
        if (email == '') {
            swal("Warning!", "Please Enter The Email");
            return false;
        }
        firebase.database().ref("data/users").orderByChild('email').equalTo(email).once('value', function(snapshot) {
            if (snapshot.exists()) {
                if (snapshot.val().adminblock == false || snapshot.val().adminblock == undefined) {
                    firebase.auth().sendPasswordResetEmail(email);
                    swal({
                    title: "Success!",
                    text: "Mail sent successfully",
                    type: "success"
                }).then(function () {
                    window.location.href = 'login';
                });
                } else {
                    swal("Warning!", "User Blocked by admin");
                }
            } else {
                swal("Warning!", "Invalid Username or Password");
            }
        });
    }
</script>
<?php } ?>

<script src="<?php echo base_url(); ?>assets/js/mainconfig.js"></script>

<!-- Swal JS -->
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>

<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fireconfig.js"></script>

<?php  if ($this->uri->segment(1) == "logout") { ?>
<script type="text/javascript">
    localStorage.clear();
</script>
<script src="<?php echo base_url(); ?>assets/js/logout.js"></script>
<?php } ?>



<!-- Slimscroll JS -->
<script src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Swiper JS -->
<script src="<?php echo base_url(); ?>assets/plugins/swiper/swiper.min.js"></script>

<!-- FancyBox JS -->
<script src="<?php echo base_url(); ?>assets/plugins/fancybox/jquery.fancybox.min.js"></script>

<!-- Select JS -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

<!-- Toaster JS -->
<script src="<?php echo base_url();?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/toastr/toastr.js"></script>


<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>


<script src="<?php echo base_url(); ?>assets/js/settings.js"></script>

<?php if($this->uri->segment(1) == 'register' || $this->uri->segment(1) == 'forgot-password' || $this->uri->segment(1) == 'phone-login' || $this->uri->segment(1) == 'group' || $this->uri->segment(1) == 'contacts' || $this->uri->segment(1) == 'settings') { ?>
<!-- Mobile Input -->
<script src="<?php echo base_url(); ?>assets/plugins/intltelinput/js/intlTelInput.js"></script>
<script src="<?php echo base_url();?>assets/js/intlTelInput.js"></script>
<?php } ?>


<?php  if(!$this->uri->segment(1) || $this->uri->segment(1) == "home" || $this->uri->segment(1) == "group" || $this->uri->segment(1) == "status") { ?>
<!-- Begin emoji-picker JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/config.js"></script>
<script src="<?php echo base_url(); ?>assets/js/util.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.emojiarea.js"></script>
<script src="<?php echo base_url(); ?>assets/js/emoji-picker.js"></script>
<!-- End emoji-picker JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/recorder.js"></script>
<script src="<?php echo base_url(); ?>assets/js/MediaStreamRecorder.js"></script>
<?php } ?>
<?php  if ($this->uri->segment(1) == "call") { ?>
    <script src="<?php echo base_url(); ?>assets/js/call_new.js"></script>
<?php } ?>
<?php  if ($this->uri->segment(1) == "group") { ?>
<script src="<?php echo base_url(); ?>assets/js/group.js"></script>
<?php } ?>

<?php  if ($this->uri->segment(1) == "status") { ?>
<script src="<?php echo base_url(); ?>assets/js/status.js"></script>
<?php } ?>

    <?php  if ($this->uri->segment(1) == "login" || $this->uri->segment(1) == "email-login" || $this->uri->segment(1) == "phone-login") { ?>
<script src="<?php echo base_url(); ?>assets/js/login.js"></script>
<?php } ?>

<?php if($this->uri->segment(1) == 'register' || $this->uri->segment(1) == 'reset-password') { ?>
<!-- Password -->
<script src="<?php echo base_url(); ?>assets/js/validation.js"></script>
<?php } ?>
<?php if ($this->uri->segment(1) == "contacts") { ?>
<script src="<?php echo base_url(); ?>assets/js/contacts.js"></script>
<?php } ?>
<!-- Dropzone JS -->
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.min.js"></script>

<!-- Custom JS -->
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

    <!-- <script src="<?php //echo base_url(); ?>assets/js/config.js"></script>
    <script src="<?php //echo base_url(); ?>assets/js/jquery.emojiarea.js"></script>
    <script src="<?php //echo base_url(); ?>assets/js/emoji-picker.js"></script> -->

<?php if($this->uri->segment(1) == 'home') { ?>
<script src="<?php echo base_url(); ?>assets/js/home.js"></script>
<?php } ?>


</body>

</html>