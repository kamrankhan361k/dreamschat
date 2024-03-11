<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper">
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
    <div class="content container-fluid">
        <div class="page-header">
            <div class="page-title">
                <h4>Stories <span class="count-details" id="userstories_total_count">0</span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex">

                <!-- Recent Orders -->
                <div class="card card-table flex-fill">
                    <div class="card-body">
                        <div class='table-top'>
                            <div class='wordset'>
                            </div>
                            <ul>
                                <li>
                                    <div class="col-auto">
                                        <input type="text" id="search-calllistadmin-content" class="user-filter" placeholder="Search">
                                    </div>  
                                </li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table class="table datanews table-hover table-center mb-0" id="user-status-list">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Email Address</th>
                                        <th>Stories Date</th>
                                        <th>Stories Time</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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

<?php $this->load->view('admin/includes/footer'); ?>