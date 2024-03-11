<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper profile-set-wrapper">

    <div class="content container-fluid profile-set-content">
        <div class="page-header">
            <div class="page-title">
                <h4>Localization Setting</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                
                <div class="noti-header">
                    <div class="noti-wrapper local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Language</h6>
                            <p>Select Language of the Website</p>
                        </div>                                    
                        <div class="drop-eng customize-select">
                            <select name="english" class="select">
                                <option value="english">English</option>
                                <option value="english">English</option>
                                <option value="english">English</option>
                                <option value="english">English</option>
                            </select>
                        </div>
                    </div>
                    <div class="noti-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Language Switcher</h6>
                            <p>To Display in all the pages</p>
                        </div> 
                        <div class="active-switch">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="sliders round"></span>
                              </label>
                        </div>
                    </div>
                    <div class="noti-wrapper local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Time zone</h6>
                            <p>Select Time zone in website</p>
                        </div>                                    
                        <div class="drop-eng customize-select">
                            <select name="time" class="select">
                                <option value="time">UTC 5:30</option>
                                <option value="time">UTC 5:30</option>
                                <option value="time">UTC 5:30</option>
                            </select>
                        </div>
                    </div>
                    <div class="noti-wrapper local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Date Format</h6>
                            <p>Select date format to display in website</p>
                        </div>                                    
                        <div class="drop-eng customize-select">
                            <select name="date" class="select">
                                <option value="date">09 Aug 2023</option>
                                <option value="date">09 Aug 2023</option>
                                <option value="date">09 Aug 2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="noti-wrapper local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Time Format</h6>
                            <p>Select time format to display in website</p>
                        </div>                                    
                        <div class="drop-eng customize-select">
                            <select name="hours" class="select">
                                <option value="english">12 Hours</option>
                                <option value="english">12 Hours</option>
                                <option value="english">12 Hours</option>
                            </select>
                        </div>
                    </div>
                    <div class="noti-wrapper local-wrapper d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Financial Year</h6>
                            <p>Select year for finance</p>
                        </div>                                    
                        <div class="drop-eng customize-select">
                            <select name="year" class="select">
                                <option value="2023">2023</option>
                                <option value="2023">2023</option>
                                <option value="2023">2023</option>                                            
                            </select>
                        </div>
                    </div>
                    <div class="noti-wrapper local-wrapper mb-0 d-flex align-items-center justify-content-between">
                        <div class="local-set-head">
                            <h6>Starting Month</h6>
                            <p>Select year for finance</p>
                        </div>                                    
                        <div class="drop-eng customize-select">
                            <select name="month" class="select">
                                <option value="august">August</option>
                                <option value="august">August</option>
                                <option value="august">August</option>
                            </select>
                        </div>
                    </div>
                </div>             
            
                
                

                <div class="acc-submit wrapp-set-system">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <a href="#" class="btn btn-primary">Save Changes</a>
                </div>
           </div>
        </div>
    </div>          
</div>
<!-- /Page Wrapper -->

<?php $this->load->view('admin/includes/footer'); ?>