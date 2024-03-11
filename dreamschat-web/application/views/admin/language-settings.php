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
                <h4>Language</h4>
            </div>
            <div class='page-btn'>
                <ul>
                    <li>
                        <a href='javascript:;' class='btn btn-added center-flex ' data-bs-toggle='modal'
                            data-bs-target='#add-transaction'>
                            <i class='bx bx-plus-circle me-1'></i>Add Language</a>
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
                                        <input type="text" id="search-language" class="user-filter" placeholder="Search">
                                    </div>  
                                </li>
                            </ul>
                        </div>
                        <div class='table-responsive'>
                            <table class='table datanews table-hover table-center mb-0' id='language-lists'>
                                <thead>
                                    <tr>
                                        <th>Language</th>
                                        <th>Code</th>
                                        <th>RTL</th>
                                        <th>Default Language</th>
                                        <th>Total</th>
                                        <th>Done</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </li>
                                    </tr>
                                </thead>
                                <tbody>
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

<!-- Transaction -->
<div class='modal fade ' id='add-transaction'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>
                    Add Languages
                </h5>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span class='material-icons'>close</span>
                </button>
            </div>
            <div class='modal-body'>
                <div class='user-profiles-group mb-4'>
                    <form>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Languages <span class='dark-red'>*</span></label>
                                    <input type='text' id='languages' name='languages' class='form-control pass-input'>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Code <span class='dark-red'>*</span></label>
                                    <input type='text' id='code' name='code' class='form-control pass-input'>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='status-logs'>
                                    <h6>Status</h6>
                                    <div class='active-switch'>
                                        <label class='switch'>
                                            <input type='checkbox' id='status' name='status'>
                                            <span class='sliders round'></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class='mute-chat-btn'>
                    <a class='btn btn-primary' data-bs-dismiss='modal' aria-label='Close' onclick='addLanguage()'>
                        Submit
                    </a>
                    <a class='btn btn-secondary' data-bs-dismiss='modal' aria-label='Close'>
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal fade' id='modal-editlang'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4 class='modal-title'>Edit</h4>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span class='material-icons'>close</span>
                </button>
            </div>
            <div class='modal-body'>
                <div class='col-md-12'>
                    <div class='pass-login'>
                        <label class='form-label'>Languages <span class='dark-red'>*</span></label>
                        <input type='text' id='language' name='language'
                            class='form-control form-control-lg group_formcontrol edit'>
                    </div>
                </div>
                <div class='form-group'>
                    <label>code</label>
                    <input type='text' class='form-control form-control-lg group_formcontrol edit' id='e_code'
                        name='e_code'>
                </div>
                <h6>Status</h6>
                <div class='active-switch'>
                    <label class='switch'>
                        <input type='checkbox' id='e_status' name='e_status'>
                        <span class='sliders round'></span>
                    </label>
                </div>
                <div class='form-row profile_form mt-3 mb-1'>
                    <!-- Button -->
                    <button type='button' class='btn btn-block btn-primary' onclick='updatelanguage()'>
                        Update
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Transaction -->

<?php $this->load->view( 'admin/includes/footer' );
?>