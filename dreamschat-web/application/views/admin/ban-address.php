<?php $this->load->view('admin/includes/header'); ?>

<?php $this->load->view('admin/includes/adminheader'); ?>

<?php $this->load->view('admin/includes/rightsidebar'); ?>

<!-- Page Wrapper -->
<div class="page-wrapper">

    <div class="content container-fluid">
        <div class="page-header">
            <div class="page-title">
                <h4>Ban IP Address</h4>
            </div>
            <div class="page-btn">
                <ul>
                    <li>
                        <a href="javascript:;" class="btn btn-added center-flex " data-bs-toggle="modal" data-bs-target="#ban-address">
                        <i class="bx bx-plus-circle me-1"></i>Add New ban IP</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex">
            
                <!-- Recent Orders -->
                <div class="card card-table flex-fill">
                    <div class="card-body">
                        <div class="table-top">
                            <div class="wordset">
                                <ul>
                                    <li>
                                        <div class="pass-login">
                                            <select class="select">
                                                <option>Select IP</option>
                                                <option >211.11.0.25</option>
                                                <option >211.03.0.11</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="pass-login">
                                            <div class="cal-icon">
                                                <span><i class="bx bx-calendar"></i></span>
                                                <input type="text" class="form-control date-range datetimepicker" placeholder="Date Range">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="refine-filter"><span><i class="bx bx-sort-down me-1"></i></span>Refine filter</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="search-set">
                                <div class="search-input">
                                    <a class="btn btn-searchset"><i class="bx bx-search"></i></a>
                                </div>
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
                                        <th>IP Address</th>
                                        <th>Report Date</th>
                                        <th>Date</th>
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
                                        <td>211.11.0.25</td>
                                        <td>You can get on-demand services in 
                                            order to find a nearby service.</td>
                                        <td>25 Jul 2023</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-gray-light me-2" data-bs-toggle="modal" data-bs-target="#edit-ban-address">
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
                                        <td>211.11.0.19</td>
                                        <td>Extract pricing information at inventory 
                                            levels.</td>
                                        <td>19 Jul 2023</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-gray-light me-2" data-bs-toggle="modal" data-bs-target="#edit-ban-address">
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
                                        <td>211.11.0.15</td>
                                        <td>Fetching data for competitors to gain 
                                            competitive advantage.</td>
                                        <td>15 Jul 2023</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-gray-light me-2" data-bs-toggle="modal" data-bs-target="#edit-ban-address">
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
                                        <td>211.11.0.32</td>
                                        <td>Temporarily block to protect user accounts 
                                            from internet fraudsters.</td>
                                        <td>22 Jul 2023</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="#" class="btn btn-sm bg-gray-light me-2" data-bs-toggle="modal" data-bs-target="#edit-ban-address">
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

<!-- Add Ban -->
<div class="modal fade " id="ban-address">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Add New Ban IP Address
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
                                <label class="form-label">IP Address</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pass-login">
                                <label class="form-label">Reason For Ban</label>
                                <div class="summernote"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="status-logs">
                                <h6>Status</h6>
                                <div class="active-switch">
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="sliders round"></span>
                                      </label>
                                </div>
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
<!-- /Add Ban -->

<!-- Add Ban -->
<div class="modal fade " id="edit-ban-address">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                Edit New Ban IP Address
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
                                <label class="form-label">IP Address</label>
                                <input type="text" class="form-control" value="211.11.0.25">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pass-login">
                                <label class="form-label">Reason For Ban</label>
                                <div class="summernote"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="status-logs">
                                <h6>Status</h6>
                                <div class="active-switch">
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="sliders round"></span>
                                      </label>
                                </div>
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
<!-- /Add Ban -->   
<?php $this->load->view('admin/includes/footer'); ?>