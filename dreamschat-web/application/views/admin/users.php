<?php $this->load->view( 'admin/includes/header' );
?>

<?php $this->load->view( 'admin/includes/adminheader' );
?>

<?php $this->load->view( 'admin/includes/rightsidebar' );
?>

<!-- Page Wrapper -->
<div class='page-wrapper'>
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

    <div class='content container-fluid'>
        <div class='page-header'>
            <div class='page-title'>
					<h4>Users <span class="count-details"id="userspage_total_count">0</span></h4>
            </div>
            <div class='page-btn'>
                <ul>
                    <li>
                        <a href='javascript:;' class='btn btn-added center-flex ' data-bs-toggle='modal'
                            data-bs-target='#add-users'>
                            <i class='bx bx-plus-circle me-1'></i>Add New User</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-12 d-flex'>

                <!-- Recent Orders -->
                <div class='card card-table flex-fill'>
                    <div class='card-body'>
                        <div class='table-top'>
                            <div class='wordset'>
                            </div>
                            <ul>
                                <li>
                                    <div class="col-auto">
                                        <input type="text" id="search-userlist-content" class="user-filter" placeholder="Search">
                                    </div>   
                                </li>
                            </ul>
                        </div>
                        <div class='table-responsive'>
                            <table class="table datanews table-hover table-center mb-0" id="userlist-list-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Email Address</th>
                                        <th>Reg Date</th>
                                        <th>Login Time</th>
                                        <th>Country</th>
                                        <th>Last Seen</th>
                                        <th class='text-end'>Action</th>
                                    </tr>
                                </thead>
									<tbody>
										<!-- <tr>
										</tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Recent Orders -->

            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->

<!-- New Group -->
<div class='modal fade ' id='add-users'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>
					Add User
                </h5>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span class='material-icons'>close</span>
                </button>
				
            </div>
            <div class='modal-body'>
                <div class='user-profiles-group mb-4'>
                    <!-- <div class='profile-cover text-center'>
              <label class='profile-cover-avatar' >
            <div class='circular-avatar'>
                <img class='avatar-img' src='<?php echo base_url(); ?>assets/img/user-placeholder.jpg' alt='Profile Image'>
                  <input type='file' id='dropprofilefile' accept='image/x-png,image/gif,image/jpeg' name='profilefiles[]' onchange='previewImage(this)'> 
                  <input type='hidden' id='himg' value=''>
            </div>
            <span class='avatar-edit'>
                <i class='bx bx-camera'></i>
            </span>
        </label>
                    </div> -->
                    <div class='profile-cover text-center'>
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
                    
                    <form>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='pass-login'>
                                    <label class='form-label'>First Name<span class='dark-red'>*</span></label>
                                    <input type='text' class='form-control pass-input' id='firstname' name='firstname'
                                        onkeypress='return /[0-9a-zA-Z]/i.test(event.key)'>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='pass-login'>
                                    <label class='form-label'>Last Name<span class='dark-red'>*</span></label>
                                    <input type='text' class='form-control pass-input' id='lastname' name='lastname'
                                        onkeypress='return /[0-9a-zA-Z]/i.test(event.key)'>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Email Addess<span class='dark-red'>*</span></label>
                                    <input type='email' class='form-control pass-input' id='email' name='email'
                                       >
                                </div>
                            </div>
                            <!-- <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Password<span class='dark-red'>*</span></label>
                                    <input type='password' class='form-control pass-input' id='password' name='password'
                                       >
                                    </div> -->
                                   
                                    <div class='col-md-12'>
        <div class='pass-login'>
            <label class='form-label'>Password<span class='dark-red'>*</span></label>
            <div class="password-toggle">
                <input type='password' class='form-control pass-input' id='password' name='password'>
                <span class="toggle-password fa fa-eye" onclick="togglePassword()"></span>
            </div>
        </div>
    </div>

                            
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Phone Number<span class='dark-red'>*</span></label>
                                    <input class='form-control form-control-lg group_formcontrol numbers' id='phonenumber'
                                        name='phonenumber' type='text'>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Country<span class='dark-red'>*</span></label>
                                    <select id='country_name' name='country_name' class="form-control">
                                        <option value=''></option>
                                        <option value='usa'>United States</option>
                                        <option value='canada'>Canada</option>
                                        <option value='India'>India</option>
                                        <option value='uk'>United Kingdom</option>
                                        <option value='australia'>Australia</option>
                                        <option value='germany'>Germany</option>
                                        <option value='paris'>Paris</option>
                                        <option value='australia'>Australia</option>
                                        <option value='denmark'>Denmark</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
       
                <div class='mute-chat-btn'>
                    <a class='btn btn-primary' onclick='addnewuser()' data-bs-dismiss='modal' aria-label='Close'>
                        <i class='feather-check me-1'></i>Add User
                    </a>
                    <a class='btn btn-secondary' data-bs-dismiss='modal' aria-label='Close'>
                        <i class='feather-x me-1'></i>Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /New Group -->


<!-- New Group -->
<div class='modal fade ' id='modal-edituser'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>
                    Edit User
                </h5>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span class='material-icons'>close</span>
                </button>
                
            </div>
            <div class='modal-body'>
                <div class='user-profiles-group mb-4'>
                    <div class='profile-cover text-center'>
                        <label class='profile-cover-avatar' >
                            <div class='circular-avatar'>
                                <img class='avatar-img' src='<?php echo base_url(); ?>assets/img/user-placeholder.jpg' alt='Profile Image' id='edit_image'>
                                  <input type='file' id='edit_profile_img' accept='image/x-png,image/gif,image/jpeg' name='profilefiles[]'> 
                                  <!-- <input type='file' id='edit_profile_img' accept='image/x-png,image/gif,image/jpeg' name='profilefiles[]'> -->
                                 <input type='hidden' id='himg' value=''>
            </div>
            <span class='avatar-edit'>
                <i class='bx bx-camera'></i>
            </span>
        </label>
    </div> 
                            </div>
                            <span class='avatar-edit'>
                                <i class='bx bx-camera'></i>
                            </span>
                        </label>
                    </div>
                    <form>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='pass-login'>
                                    <label class='form-label'>First Name <span class='dark-red'>*</span></label>
                                    <input type='text' class='form-control pass-input' id='firstName' name='firstname'
                                        placeholder='firstname' onkeypress='return /[0-9a-zA-Z]/i.test(event.key)'>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='pass-login'>
                                    <label class='form-label'>Last Name <span class='dark-red'>*</span></label>
                                    <input type='text' class='form-control pass-input' id='lastName' name='lastname'
                                        placeholder='lastname' onkeypress='return /[0-9a-zA-Z]/i.test(event.key)'>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Email Addess <span class='dark-red'>*</span></label>
                                    <input type='email' class='form-control pass-input' id='e_mail' name='email'
                                        placeholder='Email ID'>
                                </div>
                            </div>
                            <!-- <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Password <span class='dark-red'>*</span></label>
                                    <input type='password' class='form-control pass-input' id='password' name='password'
                                        placeholder='Password'>
                                </div>
                            </div> -->
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Phone Number <span class='dark-red'>*</span></label>
                                    <input class='form-control form-control-lg group_formcontrol numbers' id='edit_phone_no'
                                        name='phonenumber' type='text'  placeholder='Phone Number'>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Country <span class='dark-red'>*</span></label>
                                    <select id='edit_country_name' name='country_name' class="form-control">
                                        <option value=''>Select Country</option>
                                        <option value='usa'>United States</option>
                                        <option value='canada'>Canada</option>
                                        <option value='India'>India</option>
                                        <option value='uk'>United Kingdom</option>
                                        <option value='australia'>Australia</option>
                                        <option value='germany'>Germany</option>
                                        <option value='paris'>Paris</option>
                                        <option value='australia'>Australia</option>
                                        <option value='denmark'>Denmark</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type = 'hidden' id = 'hid' value = ''>
                    </form>
                </div>
                <div class='mute-chat-btn'>
                    <a class='btn btn-primary' onclick='updateuser()' data-bs-dismiss='modal' aria-label='Close'>
                        <i class='feather-check me-1'></i>Update
                    </a>
                    <a class='btn btn-secondary' data-bs-dismiss='modal' aria-label='Close'>
                        <i class='feather-x me-1'></i>Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /New Group -->

<?php $this->load->view( 'admin/includes/footer' );
?>
<script type="text/javascript">
$(document).ready(function() {
    $(".numbers").intlTelInput({
        nationalMode: false
    });
});
</script>
