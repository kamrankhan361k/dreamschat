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
                <h4>Language Keyword</h4>
            </div>
            <div class='page-btn'>
                <ul>
                    <li>
                        <a href='javascript:;' class='btn btn-added center-flex ' data-bs-toggle='modal'
                            data-bs-target='#add-transaction'>
                            <i class='bx bx-plus-circle me-1'></i>Add Keyword</a>
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
                            <ul>
                                <li>
                                    <div class="pass-login">
                                        <input type="text" id="search-languages-keyword" class="form-control" placeholder="Search">
                                    </div>  
                                </li>
                            </ul>
                        </div>
                        <div class='table-responsive'>
                            <table class='table datanews table-hover table-center mb-0' id='language-listkeyword'>
                                <thead>
                                <tr>
								<th width="30%">Key</th>
								<th width="30%">Value</th>
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
<div class='modal fade ' id='add-transaction'  id="modal-addlang">
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>
                    Add Keyword
                </h5>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span class='material-icons'>close</span>
                </button>
            </div>
            <div class='modal-body'>
                <div class='user-profiles-group mb-4'>
                    <form action="" autocomplete="off" enctype="multipart/form-data">
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <!-- <label class='form-label'>Languages <span class='dark-red'>*</span></label>
                                    <input type='text' id='new_language' name='new_language' class='form-control pass-input'> -->
                                    <select id="languageKeywords" class="form-control form-control-lg group_formcontrol">
                                 </select>
                                </div>

                              
                            </div>
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Page <span class='dark-red'>*</span></label>
                                    <input type='text' id='new_page' name='new_page' class='form-control pass-input'>
                                </div>
                            </div>

                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>Label <span class='dark-red'>*</span></label>
                                    <input type='text' id='new_label' name='new_label' class='form-control pass-input'>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='pass-login'>
                                    <label class='form-label'>value <span class='dark-red'>*</span></label>
                                    <input type='text' id='new_value' name='new_value' class='form-control pass-input'>
                                </div>
                            </div>
                           
                        </div>
                    </form>
                </div>
                <div class='mute-chat-btn'>
                    <a class='btn btn-primary' data-bs-dismiss='modal' aria-label='Close' id="languagekeyvalidation" onclick='addLanguagekeyword()'>
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
<div class='modal fade' id='modal-editlanguage'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4 class='modal-title'>Edit Keyword</h4>
                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                    <span class='material-icons'>close</span>
                </button>
            </div>
            <div class='modal-body'>
                <div class='col-md-12'>
                    <div class='pass-login'>
                        <label class='form-label'>Languages <span class='dark-red'>*</span></label>
                        <input type='text' id='e_language' name='e_language' readonly
                            class='form-control form-control-lg group_formcontrol edit'>
                    </div>
                </div>

               
                <div class='form-group'>
                    <label>page</label>
                    <input type='text' class='form-control form-control-lg group_formcontrol edit' id='page'
                        name='page' readonly>
                </div>
                <div class='form-group'>
                    <label>label</label>
                    <input type='text' class='form-control form-control-lg group_formcontrol edit' id='label'
                        name='label' readonly>
                </div>
                <div class='form-group'>
                    <label>value</label>
                    <input type='text' class='form-control form-control-lg group_formcontrol edit' id='value'
                        name='value'>
                </div>
              
                <div class='form-row profile_form mt-3 mb-1'>
                    <!-- Button -->
                    <button type='button' class='btn btn-block btn-primary'  onclick='updatelanguages()'>
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