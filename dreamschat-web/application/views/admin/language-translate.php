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
                <h4>Language</h4>
            </div>
            <div class="page-btn">
                <ul>
                    <li>
                        <a href="javascript:;" class="btn btn-added center-flex " data-bs-toggle="modal" data-bs-target="#add-transaction">
                        <i class="bx bx-plus-circle me-1"></i>Add Translation</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex">
            
                <!-- Recent Orders -->
                <div class="card card-table translate-table  flex-fill">
                    <div class="card-body">
                        <div class="table-top">
                            <div class="wordset">
                                <ul>
                                    <li>
                                        <a href="<?php echo base_url(); ?>language-settings" class="refine-filter back-transaction"><span><i class="bx bx-arrow-back me-1"></i></span>Back to Translations </a>
                                    </li>
                                    <li>
                                        <div href="javascript:;" class="language-blk">
                                            <h2 class="table-avatar language-avatar">
                                                <a href="language-translate.html" data-bs-toggle="modal" data-bs-target="#translate-language"><img class="avatar-img rounded-circle me-2" src="<?php echo base_url(); ?>assets/admin/img/flag/flag-01.png"  alt="User Image">English</a>
                                            </h2>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="layout-blk">
                                <ul>
                                    <li><a class="active" href="javascript:;">LTR</a></li>
                                    <li><a href="javascript:;">RTL</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table datanew table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                        <th>Medium</th>
                                        <th>File</th>
                                        <th>Total</th>
                                        <th>Complete</th>
                                        <th>Progress</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>Web</td>
                                        <td class="file-language"><a href="javascript:;">Group</a></td>
                                        <td>3456</td>
                                        <td>3456</td>
                                        <td>
                                            <div class="track-statistics mb-0">
                                                <div class="progress mb-0">
                                                    <div class="progress-bar bg-info progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="statistic-head ">
                                                    <p>80 %</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-gray-light me-2">
                                                    <i class="bx bx-pencil"></i> 
                                                </a>
                                                <a href="#" class="btn btn-sm bg-danger-light">
                                                    <i class="bx bx-x"></i> 
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>Web</td>
                                        <td class="file-language"><a href="javascript:;">Chat</a></td>
                                        <td>3456</td>
                                        <td>3456</td>
                                        <td>
                                            <div class="track-statistics mb-0">
                                                <div class="progress mb-0">
                                                    <div class="progress-bar bg-success progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="statistic-head ">
                                                    <p>50 %</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-gray-light me-2">
                                                    <i class="bx bx-pencil"></i> 
                                                </a>
                                                <a href="#" class="btn btn-sm bg-danger-light">
                                                    <i class="bx bx-x"></i> 
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>Web</td>
                                        <td class="file-language"><a href="javascript:;">Status</a></td>
                                        <td>3456</td>
                                        <td>3456</td>
                                        <td>
                                            <div class="track-statistics mb-0">
                                                <div class="progress mb-0">
                                                    <div class="progress-bar bg-warning progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="statistic-head ">
                                                    <p>60 %</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-gray-light me-2">
                                                    <i class="bx bx-pencil"></i> 
                                                </a>
                                                <a href="#" class="btn btn-sm bg-danger-light">
                                                    <i class="bx bx-x"></i> 
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>Web</td>
                                        <td class="file-language"><a href="javascript:;">Setting</a></td>
                                        <td>3456</td>
                                        <td>3456</td>
                                        <td>
                                            <div class="track-statistics mb-0">
                                                <div class="progress mb-0">
                                                    <div class="progress-bar bg-info progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="statistic-head ">
                                                    <p>90 %</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-gray-light me-2">
                                                    <i class="bx bx-pencil"></i> 
                                                </a>
                                                <a href="#" class="btn btn-sm bg-danger-light">
                                                    <i class="bx bx-x"></i> 
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    
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
<div class="modal fade language-translate" id="translate-language">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Add Transalation 
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span class="material-icons">close</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="user-profiles-group mb-4">
                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>English</th>
                                <th>Arabic</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bugs</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="البق">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bugs Email</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="لبق البريد الإلكتروني">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bug Assigned</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="علة المخصصة">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bug Comments</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="علة تعليقات">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bug Attachment</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="البقعلة مرفق">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bug Updated</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="البق بمجلس تم الحفظ بنجاح">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bug Reported</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="توقيت بمجلس المحذوفة بنجاح                                                   ">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bugs information successfully updated</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="البق بمجلس المحذوفة بنجاح                                                    ">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> Bugs information successfully Saved</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="علة التحديث">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Timer information successfully Deleted</td>
                                <td>
                                    <div class="pass-login mb-0">
                                        <input type="text" class="form-control" value="آخر البق الجديدة التي تمت إضافتها">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mute-chat-btn">
                <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                    Submit
                </a>
                <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    Cancel
                </a>
            </div>
        </div>       
    </div>
</div>
</div>
<!-- /Transaction -->

<!-- Transaction -->
<div class="modal fade " id="add-transaction">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Add Transalation 
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span class="material-icons">close</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="user-profiles-group mb-4">
                <form >
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pass-login">
                                <label class="form-label">Languages <span class="dark-red">*</span></label>
                                <input type="password" class="form-control pass-input">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pass-login">
                                <label class="form-label">Code <span class="dark-red">*</span></label>
                                <input type="password" class="form-control pass-input">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mute-chat-btn">
                <a class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                    Submit
                </a>
                <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    Cancel
                </a>
            </div>
        </div>       
    </div>
</div>
</div>
<!-- /Transaction -->
            
<?php $this->load->view('admin/includes/footer'); ?>