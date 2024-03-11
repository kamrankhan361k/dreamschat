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
            <div class="sidebar-group left-sidebar chat_sidebar" id="contact-sidebar">

                <!-- Chats sidebar -->
                <div id="chats" class="left-sidebar-wrap sidebar active slimscroll">

                    <div class="slimscroll">

                       <!-- Left Chat Title -->
                       <div class="left-chat-title all-chats d-flex justify-content-between align-items-center">
                            <div class="setting-title-head">
                                <h4> <?php echo ($ul['contactspage']['contacts'])?$ul['contactspage']['contacts']: "Contacts"; ?></h4>
                            </div>
                            <div class="add-section">
                                <ul>
                                    <li><a href="javascript:;" class="user-chat-search-btn"><i class="bx bx-search"></i></a></li>
                                    <li><a href="javascript:;" class="contact-added" onclick="addContact();"><i class="bx bx-plus"></i></a></li>
                                </ul>
                                <!-- Chat Search -->
                                <div class="user-chat-search">
                                    <form>
                                        <span class="form-control-feedback"><i class="bx bx-search" ></i></span>
                                        <input type="text" name="contact-search" id="contact-search" placeholder="Search" class="form-control">
                                        <div class="user-close-btn-chat"><span class="material-icons"><?php echo ($ul['contactspage']['close'])?$ul['contactspage']['close']: "close"; ?></span></div>
                                    </form>
                                </div>
                                <!-- /Chat Search -->
                            </div>
                       </div>
                       <!-- /Left Chat Title -->

                        <div class="sidebar-body chat-body" id="chatsidebar">
                           
                            <!-- Left Chat Title -->
                            <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                <div class="fav-title contact-title">
                                    <h6><?php echo ($ul['contactspage']['contacts_list'])?$ul['contactspage']['contacts_list']: "Contacts List"; ?></h6>
                                </div>
                            </div>
                            <!-- /Left Chat Title -->

                            <ul class="user-list contact-users">
                            </ul>
                        </div>

                    </div>

                </div>
                <!-- / Chats sidebar -->
            </div>
            <!-- /Sidebar group -->

            <!-- Chat -->
            <div class="chat chat-contact" id="middle">
                
            </div>
            <!-- /Chat -->

        </div> 
        <!-- /Content -->

        <!-- Password Authentication -->
        <div class="modal fade" id="add-contact">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['contactspage']['add_contact'])?$ul['contactspage']['add_contact']: "Add Contact"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"><?php echo ($ul['contactspage']['close'])?$ul['contactspage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body contact-group">
                        <form action="#">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="pass-login ">
                                        <label class="form-label"> <?php echo ($ul['contactspage']['first_name'])?$ul['contactspage']['first_name']: "First Name"; ?> <span>*</span></label>
                                        <input type="text" name="firstName" id="firstName" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="pass-login">
                                        <label class="form-label"> <?php echo ($ul['contactspage']['last_name'])?$ul['contactspage']['last_name']: "Last Name"; ?> <span>*</span></label>
                                        <input type="text" name="lastName" id="lastName" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="pass-login">
                                        <label class="form-label"><?php echo ($ul['contactspage']['phone_number'])?$ul['contactspage']['phone_number']: "Phone Number"; ?>  <span>*</span></label>
                                        <input class="form-control form-control-lg group_formcontrol numbers" id="mobilenumber" name="mobilenumber" type="text" maxlength="13" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="pass-login">
                                        <label class="form-label"><?php echo ($ul['contactspage']['website_address'])?$ul['contactspage']['website_address']: "Website Address"; ?></label>
                                        <input type="email" name="websiteAddress" id="websiteAddress" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Card -->
                        <div class="mute-chat-btn">      
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['contactspage']['cancel'])?$ul['contactspage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" id="add-new-contact" onclick="addContacts();">
                                <i class="feather-plus me-1"></i><?php echo ($ul['contactspage']['add_contact'])?$ul['contactspage']['add_contact']: "Add Contact"; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Password Authentication -->


        <!-- Password Authentication -->
        <div class="modal fade" id="edit-contact">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['contactspage']['edit_contact'])?$ul['contactspage']['edit_contact']: "Edit Contact"; ?>

                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-icons"> <?php echo ($ul['contactspage']['close'])?$ul['contactspage']['close']: "Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body contact-group">
                        <form action="#">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="pass-login ">
                                        <label class="form-label"><?php echo ($ul['contactspage']['first_name'])?$ul['contactspage']['first_name']: "First Name"; ?> <span>*</span></label>
                                        <input type="text" name="edit-firstName" id="edit-firstName" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="pass-login">
                                        <label class="form-label"><?php echo ($ul['contactspage']['last_name'])?$ul['contactspage']['last_name']: "Last Name "; ?><span>*</span></label>
                                        <input type="text" name="edit-lastName" id="edit-lastName" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="pass-login">
                                        <label class="form-label"><?php echo ($ul['contactspage']['phone_number'])?$ul['contactspage']['phone_number']: "Phone Number"; ?> <span>*</span></label>
                                        <input class="form-control form-control-lg group_formcontrol numbers" id="edit-mobilenumber" name="edit-mobilenumber" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="pass-login">
                                        <label class="form-label"><?php echo ($ul['contactspage']['website_address'])?$ul['contactspage']['website_address']: "Website Address"; ?></label>
                                        <input type="email" name="edit-websiteAddress" id="edit-websiteAddress" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Card -->
                        <div class="mute-chat-btn">
                           
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['contactspage']['cancel'])?$ul['contactspage']['cancel']: "Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" id="edit-contact" onclick="updateContact();">
                                <i class="feather-plus me-1"></i><?php echo ($ul['contactspage']['edit_contact'])?$ul['contactspage']['edit_contact']: ">Edit Contact"; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Password Authentication -->

         <!-- Block -->
         <div class="modal fade" id="block-user">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Block
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['contactspage']['close'])?$ul['contactspage']['close']: ">Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="block-contact-user" id="block-contact-user" value="">
                        <div class="block-user-blk text-center">
                            <img src="assets/img/icon/block.svg"  alt="icon">
                            <p> <?php echo ($ul['contactspage']['blocked_contacts_will_longer'])?$ul['contactspage']['blocked_contacts_will_longer']: ">Blocked contacts will no longer be able to call you or send you messages."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <?php echo ($ul['contactspage']['cancel'])?$ul['contactspage']['cancel']: ">Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="blockContact();">
                               <?php echo ($ul['contactspage']['block'])?$ul['contactspage']['block']: ">Block"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Block -->

        <!-- Deleting a Chat -->
        <div class="modal fade" id="delete-contact">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                             <?php echo ($ul['contactspage']['delete_chat'])?$ul['contactspage']['delete_chat']: ">Delete Chat"; ?>

                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"> <?php echo ($ul['contactspage']['close'])?$ul['contactspage']['close']: ">Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="delete-contact-user" id="delete-contact-user" value="">
                        <div class="block-user-blk text-center">
                            <i class="bx bx-trash change-color "></i>
                            <p><?php echo ($ul['contactspage']['clearing_or_deleting'])?$ul['contactspage']['clearing_or_deleting']: ">Clearing or deleting entire chats will only remove messages from this device and your devices on the newer versions of Dreamschat."; ?></p>
                        </div>
                        <div class="mute-chat-btn justify-content-center">                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                               <?php echo ($ul['contactspage']['cancel'])?$ul['contactspage']['cancel']: ">Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" onclick="deleteContact();">
                                 <?php echo ($ul['contactspage']['delete'])?$ul['contactspage']['delete']: ">Delete"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Deleting a Chat -->
        
    </div>
    <!-- /Main Wrapper -->
<?php $this->load->view('includes/footer'); ?>  

<script type="text/javascript">
$(document).ready(function() {
    $(".numbers").intlTelInput({
        nationalMode: false
    });
});
</script>