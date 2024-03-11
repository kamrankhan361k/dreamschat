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
                    <h6 id="current-date"></h6>
                    <h4 id="user_time">Good Morning, Anderson</h4>
                </div>
            </div>
            <div class="dash-widget-group">
                <ul>
                    <!-- Widget 1: User Count -->
                    <li>
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon">
                                        <img src="<?php echo base_url(); ?>assets/admin/img/icon/widget-icon-01.svg" alt="icon">
                                    </span>
                                    <div class="dash-count">
                                        <a href="#" class="count-title">User</a>
                                        <a href="#" class="count" id="user_total_count">0</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Widget 2: Video Calls Count -->
                    <li>
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon">
                                        <img src="<?php echo base_url(); ?>assets/admin/img/icon/widget-icon-02.svg" alt="icon">
                                    </span>
                                    <div class="dash-count">
                                        <a href="#" class="count-title">Video Calls</a>
                                        <a href="#" class="count" id="videocalls_total_count">0</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Widget 3: Public Groups Count -->
                    <li>
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon">
                                        <img src="<?php echo base_url(); ?>assets/admin/img/icon/widget-icon-03.svg" alt="icon">
                                    </span>
                                    <div class="dash-count">
                                        <a href="#" class="count-title">Public Groups</a>
                                        <a href="#" class="count" id="groups_total_count">0</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Widget 4: Chats Count -->
                    <li>
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon">
                                        <img src="<?php echo base_url(); ?>assets/admin/img/icon/widget-icon-04.svg" alt="icon">
                                    </span>
                                    <div class="dash-count">
                                        <a href="#" class="count-title">Chats</a>
                                        <a href="#" class="count" id="chats_totals_count">0</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Widget 5: Status Count -->
                    <li>
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon">
                                        <img src="<?php echo base_url(); ?>assets/admin/img/icon/widget-icon-05.svg" alt="icon">
                                    </span>
                                    <div class="dash-count">
                                        <a href="#" class="count-title">Status’s</a>
                                        <a href="#" class="count" id="status_total_count">0</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="row">
                <!-- Widget 6: Recent Joined Members -->
                <div class="col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Recent Joined Members</h5>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="search-admin-content" class="user-filter" placeholder="Search">
                                    <div id="error-message" style="display: none; color: black;">No matching results found</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Reg Date</th>
                                            <th>Login Time</th>
                                            <th>Country</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-list-table">
                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Widget 7: Recent Created Groups -->
                <div class="col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Recent Created Groups</h5>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="search-group-content" class="user-filter" placeholder="Search">
                                    <div id="errorr-message" style="display: none; color: black;">No matching results found</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Reg Date</th>
                                            <th>Members</th>
                                        </tr>
                                    </thead>
                                    <tbody id="groups-list-table">
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-8 col-sm-6 d-flex">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Report</h5>
                                </div>
                                <div class="col-6">  
                                    <div class="year-report d-flex justify-content-end">
                                        <select class="select">
                                            <option>Year</option>
                                            <option>Month</option>
                                        </select>
                                    </div>                                      
                                </div>
                            </div>                        
                        </div>
                        <div class="card-body">
                            <div id="school-area"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 d-flex">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Invited User</h5>
                                </div>
                                <div class="col-6">                                        
                                </div>
                            </div>                        
                        </div>
                        <div class="card-body">
                            <div class="invite-user-list">
                                <ul>
                                    <li>
                                        <div class="table-avatar">
                                            <a href="javascript:;"><img class="avatar avatar-sm me-2 avatar-img rounded-circle" src="<?php echo base_url(); ?>assets/admin/img/profiles/avatar-01.jpg" alt="User Image">Alexander Manuel</a>
                                        </div>
                                        <div class="invite-check-user">
                                            <span class="check-user"><a href="javascript:;"><i class="bx bx-check"></i></a></span>
                                            <span class="uncheck-user"><a href="javascript:;"><i class="bx bx-x"></i></a></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- /Page Wrapper -->

<?php $this->load->view('admin/includes/footer'); ?>