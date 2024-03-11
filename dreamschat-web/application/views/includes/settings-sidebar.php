<?php
$session = $this->session->userdata('username');

$lang = ($session['language'] != '')?$session['language']:'En';
$ul = custom_language($session['user'], $lang);
 
?>
<div class="sidebar-group left-sidebar chat_sidebar " id="settings-sidebar" style="display: none;">
    <!-- Chats sidebar -->
    <div id="chats" class="left-sidebar-wrap sidebar active slimscroll">
        <div class="slimscroll">
        
            <!-- Left Chat Title -->
            <div class="left-chat-title d-flex justify-content-between align-items-center">
                <div class="setting-title-head">
                    <h4><a href="#" id="close-settings-sidebar" onclick="closesidebar()"><img src="assets/img/icon/arrow-left.svg" alt="Icon"></a>  <?php echo ($ul['settings-sidebarpage']['settings'])?$ul['settings-sidebarpage']['settings']: "Settings"; ?> </h4>
                </div>
            </div>
            <!-- /Left Chat Title -->

            <div class="setting-profile-card">
                <div class="settings-option">
                    <a href="#" class="user-list-item"><?php echo ($ul['settings-sidebarpage']['edit_settings'])?$ul['settings-sidebarpage']['edit_settings']: "Edit Settings"; ?> </a>
                </div>
                <div class="account-setting">
                    <h5><?php echo ($ul['settings-sidebarpage']['account_setting'])?$ul['settings-sidebarpage']['account_setting']: "Account Setting"; ?></h5>
                    <a href="#" onclick="getProfileDetails();"> <i class="bx bx-pencil set-search"></i></a>
               </div>
               <div class="profile-card">
                   <div class="profile-cover text-center">
                       <label class="profile-cover-avatar" for="avatar_upload">
                           <img class="avatar-img" id="current-user-profile" src="assets/img/avatar/avatar-2.jpg" alt="Profile Image">
                       </label>
                   </div>
                   <div class="profile-info">
                       <div class="profile-listout">
                           <p class="info-title mb-0"><?php echo ($ul['settings-sidebarpage']['your_name'])?$ul['settings-sidebarpage']['your_name']: "Your Name"; ?></p>
                           <span class="info-text" id="current-user-name"></span>
                       </div>
                       <div class="profile-listout">
                           <p class="info-title mb-0"><?php echo ($ul['settings-sidebarpage']['about'])?$ul['settings-sidebarpage']['about']: "About"; ?></p>
                           <span class="info-text"  id="current-user-status"></span>
                       </div>
                       <div class="profile-listout">
                           <p class="info-title mb-0"><?php echo ($ul['settings-sidebarpage']['date_of_birth'])?$ul['settings-sidebarpage']['date_of_birth']: "Date of Birth"; ?></p>
                           <span class="info-text"  id="current-user-dob"></span>
                       </div>
                       <div class=" profile-listout">
                            <p class="info-title mb-0"><?php echo ($ul['settings-sidebarpage']['gender'])?$ul['settings-sidebarpage']['gender']: "Gender"; ?></p>
                            <span class="info-text"  id="current-user-gender"></span>
                        </div>
                        <div class="profile-listout mb-0">
                            <p class="info-title mb-0"><?php echo ($ul['settings-sidebarpage']['country'])?$ul['settings-sidebarpage']['country']: "Country"; ?></p>
                            <span class="info-text"  id="current-user-country"></span>
                        </div>
                   </div>
               </div>
            </div>
            <div class="settings-card">
                <div class="settings-control">
                    <ul>
                        <li >
                            <a href="javascript:;"  data-bs-toggle="modal" data-bs-target="#password-security">
                                <div class="setting-card-list">
                                    <i class="bx bx-lock-alt"></i>
                                    <span><?php echo ($ul['settings-sidebarpage']['password_security'])?$ul['settings-sidebarpage']['password_security']: "Password & Security"; ?></span>
                                </div>
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </li>
                        <li >
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#gallery-image">
                                <div class="setting-card-list">
                                    <i class="bx bx-message-square-dots"></i>
                                    <span><?php echo ($ul['settings-sidebarpage']['wallpaper'])?$ul['settings-sidebarpage']['wallpaper']: "Wallpaper"; ?></span>
                                </div>
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </li>
                        <li >
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#setting-languages" onclick="getlanguages()">
                                <div class="setting-card-list">
                                    <i class="bx bx-globe"></i>
                                    <span><?php echo ($ul['settings-sidebarpage']['languages'])?$ul['settings-sidebarpage']['languages']: "Languages"; ?></span>
                                </div>
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </li>
                        <li >
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#blocked-user" onclick="viewblockedusers();">
                                <div class="setting-card-list">
                                    <i class="bx bx-block"></i>
                                    <span><?php echo ($ul['settings-sidebarpage']['blocked_user'])?$ul['settings-sidebarpage']['blocked_user']: "Blocked User"; ?></span>
                                </div>
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </li>
                        <li >
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#blocked-contacts" onclick="viewblockedcontacts();">
                                <div class="setting-card-list">
                                    <i class="bx bx-block"></i>
                                    <span>Blocked Contact</span>
                                </div>
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </li>
                        <li >
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#delete-account">
                                <div class="setting-card-list">
                                    <i class="bx bx-trash"></i>
                                    <span><?php echo ($ul['settings-sidebarpage']['delete_account'])?$ul['settings-sidebarpage']['delete_account']: "Delete Account"; ?></span>
                                </div>
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url()?>logout">
                                <div class="setting-card-list">
                                    <i class="bx bx-lock-alt"></i>
                                    <span><?php echo ($ul['settings-sidebarpage']['logout'])?$ul['settings-sidebarpage']['logout']: "Logout"; ?></span>
                                </div>
                                <i class="bx bx-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- / Chats sidebar -->
    
</div>


<!-- Social Profile -->
        <!-- <div class="modal fade " id="social-profile">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Social Profiles
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="social-profile-blk">
                            <ul>
                                <li>
                                    <a href="javascript:;">
                                        <h6>Facebook <span><i class="fa-brands fa-facebook-f"></i></span></h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <h6>Google + <span><i class="fa-brands fa-google"></i></span></h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <h6>Twitter <span><i class="fa-brands fa-twitter"></i></span></h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <h6>Linkedin <span><i class="fa-brands fa-linkedin"></i></span></h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <h6>Youtube <span><i class="fa-brands fa-youtube"></i></span></h6>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mute-chat-btn">
                           
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['commonpage']['cancel'])?$ul['commonpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-check me-1"></i><?php echo ($ul['commonpage']['save_changes'])?$ul['commonpage']['save_changes']: "Save Changes"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div> -->
        <!-- /Social Profile -->
        
        <!-- Password Authentication -->
        <div class="modal fade" id="password-security">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                             <?php echo ($ul['settings-sidebarpage']['password_security'])?$ul['settings-sidebarpage']['password_security']: "Password & Security"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"><?php echo ($ul['settings-sidebarpage']['close'])?$ul['settings-sidebarpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body login-security">
                        <!-- Card -->
                        <!-- <div class="settings-switch">
                            <h6>Security</h6>
                            <ul>
                                <li class="d-flex align-items-center">
                                    <div>
                                        <span>Use two-factor authentication</span>
                                    </div>
                                    <label class="switch ms-auto">
                                        <input type="checkbox" >
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                            </ul>
                        </div> -->
                        <form action="new-friends">
                            <h6><?php echo ($ul['settings-sidebarpage']['change_password'])?$ul['settings-sidebarpage']['change_password']: "Change Password"; ?></h6>
                            <div class="pass-login">
                                <label class="form-label"><?php echo ($ul['settings-sidebarpage']['current_password'])?$ul['settings-sidebarpage']['current_password']: "Current Password"; ?> </label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input" name="current_password" id="current_password" value="">
                                    <span class="toggle-password fa-solid fa-eye"></span>
                                </div>
                            </div>
                            <div class="pass-login">
                                <label class="form-label"><?php echo ($ul['settings-sidebarpage']['new_password'])?$ul['settings-sidebarpage']['new_password']: "New Password"; ?></label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-inputs" name="new_password" id="new_password" value="">
                                    <span class="toggle-passwords fa-solid fa-eye"></span>
                                </div>
                            </div>
                            <div class="pass-login">
                                <label class="form-label"><?php echo ($ul['settings-sidebarpage']['confirm_password'])?$ul['settings-sidebarpage']['confirm_password']: "Confirm Password"; ?></label>
                                <div class="pass-group">
                                    <input type="password" class="form-control conform-pass-input" name="confirm_password" id="confirm_password" value="">
                                    <span class="conform-toggle-password fa-solid fa-eye"></span>
                                </div>
                            </div>
                        </form>
                        <!-- Card -->
                        <div class="mute-chat-btn">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['commonpage']['cancel'])?$ul['commonpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="updatepassword();">
                                <i class="feather-check me-1"></i><?php echo ($ul['commonpage']['save_changes'])?$ul['commonpage']['save_changes']: "Save Changes"; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Password Authentication -->

        <!-- Blocked Users -->
        <div class="modal fade " id="blocked-user">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                             <?php echo ($ul['settings-sidebarpage']['blocked_users'])?$ul['settings-sidebarpage']['blocked_users']: "Blocked Users"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['settings-sidebarpage']['close'])?$ul['settings-sidebarpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-block-group">
                            <div class="recent-block-group" id="blocked-users">
                                
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Blocked Users -->

        <!-- Blocked Contacts -->
        <div class="modal fade " id="blocked-contacts">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Blocked Contacts
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-block-group">
                            <div class="recent-block-group" id="block-contacts">
                                
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Blocked Contacts -->

         <!-- Languages -->
         <div class="modal fade " id="setting-languages">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                             <?php echo ($ul['settings-sidebarpage']['languages'])?$ul['settings-sidebarpage']['languages']: "Languages"; ?> 
                            <!-- <//?=$ul['settingspage']['lbl_change_language']?>  -->
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['settings-sidebarpage']['close'])?$ul['settings-sidebarpage']['close']: "Close"; ?> </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="languages-group mb-4">
                            <!-- <div> -->
                                <!-- <select class="select">
                                    <option>Choose Language</option>
                                    <option >English</option>
                                </select> -->
                                <div class="form-group">
                                <select id="ulanguage" class="form-control form-control-lg group_formcontrol">
                                 </select>
                                </div>
                            <!-- </div> -->
                        </div>
                        <div class="mute-chat-btn">
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['commonpage']['cancel'])?$ul['commonpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="updatelanguage()">
                                <i class="feather-check me-1" ></i> <?php echo ($ul["settings-sidebarpage"]["change_language"])?$ul["settings-sidebarpage"]["change_language"]: "Change Language"; ?> 
                            </a>
                        
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Languages -->

        <!-- Logout -->
        <div class="modal fade " id="setting-logout">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?php echo ($ul['settings-sidebarpage']['log_out'])?$ul['settings-sidebarpage']['log_out']: " Log Out"; ?> 
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['settings-sidebarpage']['close'])?$ul['settings-sidebarpage']['close']: "Close"; ?> </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="logout-group mb-4">
                            <p><?php echo ($ul['settings-sidebarpage']['are_logout'])?$ul['settings-sidebarpage']['are_logout']: "Are you sure you want to log out?"; ?></p>
                        </div>
                        <div class="mute-chat-btn">                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['commonpage']['cancel'])?$ul['commonpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-check me-1"></i><?php echo ($ul['commonpage']['save_changes'])?$ul['commonpage']['save_changes']: "Save Changes"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Logout -->

        <!-- Device History -->
        <!-- <div class="modal fade device-modal" id="setting-device">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Device History
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="device-group mb-4">
                            <div class="manage-device-detail setting-device-details">
                                <div class="manage-histry manage-wrapper-histry flkex-grow-1">
                                    <h6>Device History</h6>
                                    <p>If you see a device here that you believe wasn’t you, please contact our account fraud department immediately.</p>
                                </div>
                                <a href="javascript:;" class="btn btn-primary set-manage-pri flex-shrink-0 d-flex align-items-center" ><img src="assets/img/icon/logout.svg" class="me-1" alt="Icon">Log out all Devices</a>
                            </div>
                            <div class="connectetapps setting-connect">
                                <div class="connectetappsimg setting-connect-img">
                                    <div class="connectet-img">
                                        <i class="fa-solid fa-laptop"></i>
                                    </div>
                                    <div class="connectet-content">
                                        <p>16 Feb 2023 at 06:25PM</p>
                                        <h6>Mac OS Safari 15.1</h6>
                                    </div>
                                </div>
                                <div class="connectetappscontent">
                                    <a href="javascript:;" class="btn btn-primary">Current Session</a>
                                    <span class="device-remove"><a href="javascript:;"><i class="feather-trash-2"></i></a></span>
                                </div>
                           </div>
                           <div class="connectetapps">
                                <div class="connectetappsimg">
                                    <div class="connectet-img">
                                        <i class="fa-solid fa-laptop"></i>
                                    </div>
                                    <div class="connectet-content">
                                        <p>22 Jan 2023 at 04:32AM</p>
                                        <h6>Windows 11 Mozilla Firefox</h6>
                                    </div>
                                </div>
                                <div class="connectetappscontent">
                                    <span class="device-remove"><a href="javascript:;"><i class="feather-trash-2"></i></a></span>
                                </div>
                           </div>
                           <div class="connectetapps">
                                <div class="connectetappsimg">
                                    <div class="connectet-img">
                                        <i class="feather-tablet"></i>
                                    </div>
                                    <div class="connectet-content">
                                        <p>06 Dec 2023 at 06:30AM</p>
                                        <h6>iOS Safari 15.1</h6>
                                    </div>
                                </div>
                                <div class="connectetappscontent">
                                    <span class="device-remove"><a href="javascript:;"><i class="feather-trash-2"></i></a></span>
                                </div>
                           </div>
                        </div>
                        <div class="mute-chat-btn">                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><//?php echo ($ul['commonpage']['cancel'])?$ul['commonpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-check me-1"></i><//?php echo ($ul['commonpage']['save_changes'])?$ul['commonpage']['save_changes']: "Save Changes"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div> -->
        <!-- /Device History -->

        <!-- Logout -->
        <div class="modal fade " id="delete-account">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['settings-sidebarpage']['delete_myaccount'])?$ul['settings-sidebarpage']['delete_myaccount']: "Delete My Account"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['settings-sidebarpage']['close'])?$ul['settings-sidebarpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="logout-group mb-4">
                            <p><?php echo ($ul['settings-sidebarpage']['delete_profile_photo'])?$ul['settings-sidebarpage']['delete_profile_photo']: "Delete your account info and profile photo"; ?></p>
                            <p>
                            <?php echo ($ul['settings-sidebarpage']['delete_dreamschat'])?$ul['settings-sidebarpage']['delete_dreamschat']: "Delete you from all dreamschat groups"; ?>
                            </p>

                            <p> <?php echo ($ul['settings-sidebarpage']['delete_your_account'])?$ul['settings-sidebarpage']['delete_your_account']: "Are you sure want to Delete your Account?"; ?></p>
                            <!-- <p>Delete your message history on this phone and your icloud backup</p>
                            <div class="form-group">
                                <label class="form-label">Phone Number <span>*</span></label>
                                <input class="form-control form-control-lg group_formcontrol" id="phone" name="phone" type="text">
                            </div> -->
                        </div>
                        <div class="mute-chat-btn">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <?php echo ($ul['commonpage']['cancel'])?$ul['commonpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="deleteUserAccout();">
                                <?php echo ($ul['settings-sidebarpage']['delete_my_account'])?$ul['settings-sidebarpage']['delete_my_account']: "Yes, Delete My Account"; ?></p>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Logout -->
        
        <!-- Gallery -->
        <div class="modal fade" id="gallery-image">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content setting-wall">
                    <div class="modal-header set-wall-header">
                        <h5 class="modal-title">
                            
                            <?php echo ($ul['settings-sidebarpage']['select_wallpaper'])?$ul['settings-sidebarpage']['select_wallpaper']: "Select Wallpaper"; ?> 
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['settings-sidebarpage']['close'])?$ul['settings-sidebarpage']['close']: "Close"; ?> </span>
                        </button>
                    </div>
                    <!-- <div class="profile-cover text-center form-group">
                        <label class="profile-cover-avatar" id="image-preview">
                            <img class="avatar-img" name="currentuser_wallpaper_image" id="currentuser_wallpaper_image" src="assets/img/user-placeholder.jpg" alt="Profile Image">
                            <input type="file" id="avatar_upload_img" accept="image/*">
                            <span class="avatar-edit">
                                 <img src="assets/img/icon/camera.svg" alt="Image">
                            </span>
                        </label>
                    </div> -->
                    <!-- <div class="form-group" id="currentuser_wallpaper_image_delete"></div> -->
                     <div class="file-drop mt-4">
                       <input class="update_wallpaper" type="file" id="avatar_upload_img" accept="image/x-png,image/gif,image/jpeg">

                        <br>
                        <div class="form-group" id="currentuser_wallpaper_image"></div>
                    <div class="form-row profile_form mt-3 mb-1"></div>
                    </div>

                    <div class="mute-chat-btn ">
                        <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="feather-x me-1"></i><?php echo ($ul['commonpage']['cancel'])?$ul['commonpage']['cancel']: "Cancel"; ?>
                        </a>
                        <a class="btn btn-primary" onclick="updatewallpaper()">
                            <i class="feather-arrow-right me-1"></i>
                            <?php echo ($ul['settings-sidebarpage']['submit'])?$ul['settings-sidebarpage']['submit']: "Submit"; ?> </span>
                        </a>
                    </div>
                    

                    <!-- <div class="modal-body wall-set-body">
                        <div class="mute-chat-btn wall-btn">                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                               Cancel
                            </a>
                            <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" onclick="updatewallpaper()">
                                Select
                            </a>
                        </div>
                    </div>  -->

                   
                </div>
            </div>
        </div>
        <!-- /Gallery -->

            <!-- Account -->
        <div class="modal fade " id="edit-setting-condition">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                          <?php echo ($ul['settings-sidebarpage']['account_setting'])?$ul['settings-sidebarpage']['account_setting']: "Account Setting "; ?> </span>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['settings-sidebarpage']['close'])?$ul['settings-sidebarpage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-profiles-group mb-4">
                            <div class="profile-cover text-center">
                                <label class='profile-cover-avatar' >
                            <div class='circular-avatar'>
                                <img class='avatar-img' src='<?php echo base_url(); ?>assets/img/user-placeholder.jpg' alt='Profile Image' id='add_image'>
                                  <input type='file' id='drop-zone-profile-file' accept='image/x-png,image/gif,image/jpeg' name='profilefiles[]'> 
                                  <!-- <input type='file' id='edit_profile_img' accept='image/x-png,image/gif,image/jpeg' name='profilefiles[]'> -->
                                 <input type='hidden' id='himg' value=''>
                            </div>
                            <span class='avatar-edit'>
                                <i class='bx bx-camera'></i>
                            </span>
                        </label>
                            </div>
                            <form action="#">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="pass-login ">
                                            <label class="form-label"><?php echo ($ul['settings-sidebarpage']['first_name'])?$ul['settings-sidebarpage']['first_name']: "First Name"; ?> <span>*</span></label>
                                            <input type="text" name="user-first-name" id="user-first-name" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="pass-login">
                                            <label class="form-label"><?php echo ($ul['settings-sidebarpage']['last_name'])?$ul['settings-sidebarpage']['last_name']: "Last Name"; ?><span>*</span></label>
                                            <input type="text"  name="user-last-name" id="user-last-name" class="form-control" value="Manuel">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="pass-login">
                                            <label class="form-label"><?php echo ($ul['settings-sidebarpage']['gender'])?$ul['settings-sidebarpage']['gender']: "Gender"; ?> </label>
                                            <!-- <select class="select pass-login-dropdown" name="user-gender" id="user-gender"> -->
                                                <select class="form-control" name="user-gender" id="user-gender">
                                                <option value=""><?php echo ($ul['settings-sidebarpage']['select_gender'])?$ul['settings-sidebarpage']['select_gender']: "Select Gender"; ?></option>
                                                <option value="Male"><?php echo ($ul['settings-sidebarpage']['male'])?$ul['settings-sidebarpage']['male']: "Male"; ?></option>
                                                <option value="Female"><?php echo ($ul['settings-sidebarpage']['female'])?$ul['settings-sidebarpage']['female']: "Female"; ?></option>
                                                <option value="Other"><?php echo ($ul['settings-sidebarpage']['trans_gender'])?$ul['settings-sidebarpage']['trans_gender']: "Trans-Gender"; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-control-label"><?php echo ($ul['settings-sidebarpage']['date_of_birth'])?$ul['settings-sidebarpage']['date_of_birth']: "Date of Birth"; ?> <span >*</span></label>
                                            <div class="cal-icon">
                                                <span><img src="assets/img/icon/calendar.svg" alt="Icon"></span>
                                                <input type="text" class="form-control datetimepicker" placeholder="19-09-2023" name="user-dob" id="user-dob">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="pass-login">
                                            <label class="form-label"><?php echo ($ul['settings-sidebarpage']['country'])?$ul['settings-sidebarpage']['country']: "Country"; ?> </label>
                                            <!-- <select id="edit_country_name" name="edit_country_name" class="form-control"> -->
                                            <select class="form-control" name="user-country" id="user-country">
                                                <option value=""><?php echo ($ul["settings-sidebarpage"]["select_country"])?$ul["settings-sidebarpage"]["select_country"]: "Select Country"; ?></option>
                                                <option value="India">India</option>
                                                <option value="USA"><?php echo ($ul['settings-sidebarpage']['usa'])?$ul['settings-sidebarpage']['usa']: "USA"; ?></option>
                                                <option value="China"><?php echo ($ul['settings-sidebarpage']['china'])?$ul['settings-sidebarpage']['china']: "China"; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="pass-login">
                                            <label class="form-label"><?php echo ($ul['settings-sidebarpage']['about'])?$ul['settings-sidebarpage']['about']: "About"; ?></label>
                                            <textarea class="form-control"  name="user-current-status" id="user-current-status"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mute-chat-btn">
                          
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['commonpage']['cancel'])?$ul['commonpage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="updateprofile();">
                                <i class="feather-check me-1"></i><?php echo ($ul['commonpage']['save_changes'])?$ul['commonpage']['save_changes']: "Save Changes"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Account -->