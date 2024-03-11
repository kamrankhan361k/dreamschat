<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">
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
    <div class="content container-fluid profile-set-content">
        <div class="page-header">
            <div class="page-title">
                <h4>Appearance Setting</h4>
            </div>
        </div>
        <div class="appearance-settings-wrapper">
            <div class="row">
                <div class="col-12">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="appear-set">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <h6>Interface Theme</h6>
                                <p>Select or customize your UI theme</p>
                            </div>
                            <input type="hidden" id="theme_color" value="<?php echo getenv('DB_INTERFACE_THEME');?>">
                           
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="theme-image <?=(getenv('DB_INTERFACE_THEME') == "light") ? 'active':''?>" onclick="toggleTheme('light')">
                                    <div class="theme-image-set">
                                        <img src="<?php echo base_url(); ?>assets/admin/img/light-theme.png"  id ="light" alt="img">
                                        <h6>Light</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="theme-image <?=(getenv('DB_INTERFACE_THEME') == "dark") ? 'active':''?>"  onclick="toggleTheme('dark')">
                                    <div class="theme-image-set">
                                        <img src="<?php echo base_url(); ?>assets/admin/img/dark-theme.png" id="dark" alt="img">
                                        <h6>Dark</h6>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                   
                </div>  
            </div>
        </div>  
        
        <div class="acc-submit wrapp-set-system">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <!-- <a href="#" class="btn btn-primary">Save Changes</a> -->
            <button type="button" onclick="insertappearancesettings()" class="btn btn-primary">Save Changes</button>
        </div>                    
        </form>
    </div>          
</div>
<!-- /Page Wrapper -->

<?php $this->load->view('admin/includes/footer'); ?>