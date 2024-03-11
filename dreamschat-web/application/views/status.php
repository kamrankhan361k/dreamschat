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
        <?php 
            $this->load->view('includes/leftsidebar'); 
        ?>
        
        <!-- sidebar group -->
          <div class="sidebar-group left-sidebar chat_sidebar flex-shrink-0" id="status-sidebar">

                <!-- Chats sidebar -->
                <div id="chats" class="left-sidebar-wrap sidebar active slimscroll">

                    <div class="slimscroll">

                       <!-- Left Chat Title -->
                       <div class="left-chat-title all-chats d-flex justify-content-between align-items-center">
                            <div class="setting-title-head">
                                <h4><?php echo ($ul['statuspage']['status'])?$ul['statuspage']['status']:"Status"; ?></h4>
                            </div>
                            <div class="add-section">
                                <ul>
                                    <li><a href="javascript:;" class="contact-added" data-bs-toggle="modal" data-bs-target="#upload-file"><i class="feather-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Left Chat Title -->

                        <div class="sidebar-body chat-body" id="chatsidebar">
                           
                            <!-- Left Chat Title -->
                            <div class="d-flex justify-content-between align-items-center ps-0 pe-0">
                                <div class="fav-title pin-chat">
                                    <h6><?php echo ($ul['statuspage']['my_status'])?$ul['statuspage']['my_status']:"My Status"; ?></h6>
                                </div>
                            </div>
                            <!-- /Left Chat Title -->

                            <ul class="user-list current-user-list">
                            </ul>
                            <div class="d-flex justify-content-between align-items-center ps-0 pe-0" id="recent-updates">
                            </div>
                            <ul class="user-list recent-user-status">
                            </ul>
                            
                        </div>

                    </div>

                </div>
                <!-- / Chats sidebar -->
            </div>
            <!-- /Sidebar group -->
            <div class="chat status-empty-group d-flex align-items-center justify-content-center" id="empty-status">
                <div class="status-message-box text-center">
                    <img src="assets/img/icon/load-status.svg" alt="Icon">
                    <p><?php echo ($ul['statuspage']['click_on_contact'])?$ul['statuspage']['click_on_contact']:"Click on a contact to view their status updates"; ?></p>
                </div>
            </div>
          <div class="user-status-group">
                <!-- Status-->
                <div class="user-stories-box">
                    <div class="inner-popup">
                        <div id="carouselIndicators" class="carousel slide slider" data-bs-ride="carousel">
                            <div class="view-status-list">
                                <span id="status-caption" style="color: #fff;"></span>
                                <a href="javascript:;" onclick="statusViewedUsers();" class="views-counts"><i class="feather-eye" id="views-count"></i>0</a>
                            </div>
                            <div class="chat status-chat-footer">
                                <div class="chat-footer">
                                    <form>
                                        <input type="hidden" id="from_user" >
                                        <input type="hidden" id="to_user" >
                                        <input type="hidden" id="combination_user" >
                                        <div class="smile-foot emoj-action">
                                            <a href="#" class="action-circle"><i class="bx bx-smile"></i></a>
                                        </div>
                                        <div class="smile-foot">
                                            <a href="#"  class="action-circle" data-bs-toggle="modal" data-bs-target="#record_audio"><i class="bx bx-microphone"></i></a>
                                        </div>
                                        <div class="smile-foot">
                                            <a href="#"  class="action-circle" data-bs-toggle="modal" data-bs-target="#drag_files"><i class="bx bx-image"></i></a>
                                        </div>
                                        <input type="text" data-emojiable="true" class="form-control chat_form" name="status-reply-msesage" id="status-reply-msesage" placeholder="Type your message here...">
                                        <div class="form-buttons">
                                            <a class="btn send-btn" onclick="sendstatusMessage();">
                                                <i class="bx bx-paper-plane"></i>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="status-user-blk">
                                <div class="user-details">
                                    <figure class="avatar ms-1">
                                        <img src="assets/img/user-placeholder.jpg" class="rounded-circle" alt="image">
                                    </figure>
                                    <div class="user-online">
                                        <h5 id="selected-status-user-name"><?php echo ($ul['statuspage']['my_status'])?$ul['statuspage']['my_status']:"My Status"; ?></h5>
                                        <span id="status-time"></span>
                                    </div>
                                </div>
                            </div>
                            <ol id="image_statusol" class="carousel-indicators">
                            </ol>
                            <div id="image_statusli" class="carousel-inner status_slider" role="listbox">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Status -->
            </div>

        </div> 
        <!-- /Content -->

        <!-- Viewed By -->
        <div class="modal fade " id="view-user-status">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['statuspage']['viewed_by'])?$ul['statuspage']['viewed_by']:"Viewed By"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['statuspage']['close'])?$ul['statuspage']['close']:"Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="user-block-group mb-0">
                            <!-- <div class="search_chat has-search">
                                <span class="fas fa-search form-control-feedback"></span>
                                <input class="form-control chat_input" id="search-contacts" type="text" placeholder="Search">
                            </div> -->
                            <h5 class="recent-view-text"><?php echo ($ul['statuspage']['recent_view'])?$ul['statuspage']['recent_view']:"Recent View"; ?></h5>
                            <div class="status-viewed-user-list">
                                <!-- Users List -->
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Viewed By -->

        <!-- Drag and Drop -->
        <div class="modal fade" id="upload-file">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['statuspage']['drag_and_drop'])?$ul['statuspage']['drag_and_drop']:"Drag and Drop or Upload Files"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['statuspage']['close'])?$ul['statuspage']['close']:"Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="file-drop mb-4">
                            <form action="#" class="dropzone dz-clickable">
                                <img src="assets/img/icon/drag-file.svg" class="img-fluid" alt="upload">

                                <p>Drag & drop your files here or choose file</p>
                                <span>Maximum size: 50MB</span>
                            <div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>
                        </div>

                         <input type="file" class="d-flex" name="user-status" id="user-status">
                        <div class="mute-chat-btn ">
                            
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i>Cancel
                            </a>
                            <a class="btn btn-primary" id="upload-status-image">
                                <i class="feather-arrow-right me-1"></i>Next
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- <div class="modal fade" id="upload-file">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Drag and Drop or Upload Files
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="file-drop mb-4">
                            <form action="#" class="dropzone dz-clickable">
                                <div id="drop-zone-file-status">
                                    <img src="assets/img/icon/drag-file.svg" class="img-fluid" alt="upload">
                                    <p><?php echo ($ul['statuspage']['drag_and_drop_your_file'])?$ul['statuspage']['drag_and_drop_your_file']:"Drag & drop your files here or choose file"; ?></p>
                                    <span><?php echo ($ul['statuspage']['maximum_size_50mb'])?$ul['statuspage']['maximum_size_50mb']:"Maximum size: 50MB"; ?></span>
                                    <div class="dz-default dz-message"><span><?php echo ($ul['statuspage']['drop_files'])?$ul['statuspage']['drop_files']:"Drop files here to upload"; ?></span>
                                    <input type="file" name="drop-zone-file-status" id="drop-zone-file-statusssss"></div>
                                </div>
                            </form>
                        </div>
                        <div class="file-drop mb-4">
                            <input type="file" name="user-status" id="user-status">
                            <br>
                        </div>
                        <div class="mute-chat-btn ">
                            <a class="btn btn-primary" onclick="uploadStatusImage();">
                                <i class="feather-arrow-right me-1"></i><?php echo ($ul['statuspage']['next'])?$ul['statuspage']['next']:"Next"; ?>
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['statuspage']['cancel'])?$ul['statuspage']['cancel']:"Cancel"; ?>
                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div> -->
        <!-- /Drag and Drop -->

        <!-- Upload File -->
        <div class="modal fade upload-img-file" id="upload-file-image">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['statuspage']['close'])?$ul['statuspage']['close']:"Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="uplaod-image">
                            <img src="assets/img/status.jpg" id="uplaod-new-status-image" class="img-fluid" alt="upload">
                            <div class="chat status-chat-footer">
                                <div class="chat-footer">
                                    <form>
                                        <div class="smile-foot emoj-action">
                                            <a href="#" class="action-circle"><i class="bx bx-smile"></i></a>  
                                        </div>
                                        <input type="text" data-emojiable="true" name="status-captions" id="status-captions" class="form-control chat_form" placeholder="Type your message here...">
                                        <div class="form-buttons">
                                            <a class="btn send-btn" id="send-status">
                                                <i class="bx bx-paper-plane"></i>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        <!-- /Upload File -->
        
        <!--Voice Modal-->
        <div class="modal fade" id="record_audio">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['statuspage']['voice_message'])?$ul['statuspage']['voice_message']:"Voice Message"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times close_icon"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="center-align">
                                <audio controls id="audio"></audio>
                                <br>
                                <button type="button" class="btn btn-warning btn-sm" id="startRecording"> <?php echo ($ul['statuspage']['start'])?$ul['statuspage']['start']:"Start"; ?></button>
                                <button type="button" class="btn btn-dark btn-sm" id="stopRecording" disabled><?php echo ($ul['statuspage']['stop'])?$ul['statuspage']['stop']:"Stop"; ?></button>

                                <button type="button" class="btn btn-info btn-sm" id="send_voice" disabled><?php echo ($ul['statuspage']['send'])?$ul['statuspage']['send']:"Send"; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Voice Modal-->

        <!-- Upload Reply Documents -->
        <div class="modal fade" id="drag_files">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                           <?php echo ($ul['statuspage']['drag_and_drop'])?$ul['statuspage']['drag_and_drop']:"Drag and Drop or Upload Files"; ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="material-icons"><?php echo ($ul['statuspage']['close'])?$ul['statuspage']['close']:"Close"; ?></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="file-drop mb-4">
                            <form action="#" class="dropzone dz-clickable">
                                <div id="drop-zone-file-status">
                                    <img src="assets/img/icon/drag-file.svg" class="img-fluid" alt="upload">
                                    <p><?php echo ($ul['statuspage']['drag_drop_your_files'])?$ul['statuspage']['drag_drop_your_files']:"Drag & drop your files here or choose file"; ?></p>
                                    <span><?php echo ($ul['statuspage']['maximum_size_50mb'])?$ul['statuspage']['maximum_size_50mb']:"Maximum size: 50MB"; ?></span>
                                    <div class="dz-default dz-message"><span><?php echo ($ul['statuspage']['drop_files_here'])?$ul['statuspage']['drop_files_here']:"Drop files here to upload"; ?></span>
                                    <input type="file"id="drop-zone-filesss" name="files[]" multiple>
                                </div>
                            </form>
                        </div>
                        <div class="file-drop mb-4">
                            <input type="file" name="reply-attachment" id="reply-attachment">
                            <br>
                            <!-- <img id="previewImage" alt="Preview" style="max-width: 200px; max-height: 200px;"> -->
                        </div>
                        <div class="mute-chat-btn ">
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i><?php echo ($ul['statuspage']['cancel'])?$ul['statuspage']['cancel']:"Cancel"; ?>
                            </a>
                            <a class="btn btn-primary" id="send-attachement">
                                <i class="feather-arrow-right me-1"></i><?php echo ($ul['statuspage']['submit'])?$ul['statuspage']['submit']:"Submit"; ?>

                            </a>
                        </div>
                    </div>       
                </div>
            </div>
        </div> 
        <!-- <div id="drag_files" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Drag and drop or upload files</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <center> Max upload size - 2Mb)  </center>
                        <form id="js-upload-form" class="box" method="post" action="" enctype="multipart/form-data">
                            <div id="drop-zone">
                                <div class="drop-zone-caption upload-drop-zone" >
                                <i class="fa fa-cloud-upload fa-2x"></i> <span class="upload-text"> Just drag and drop files here</span>
                                </div>
                                <div class="text-center mt-0">
                                <span class="btn newgroup_create m-0 file_posti">
                                    <span>Choose files&nbsp;&nbsp;&nbsp;</span>
                                    <input type="file"id="drop-zone-filesss" name="files[]" multiple>
                                </span>
                                </div>
                                <div id="imagePreview">
                                  <img id="previewImage" src="#" alt="Preview">
                                </div>
                            </div>
                            <div class="mute-chat-btn ">
                            <a class="btn btn-primary" id="send-attachement">
                                <i class="feather-arrow-right me-1"></i>Submit
                            </a>
                            <a class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                <i class="feather-x me-1"></i>Cancel
                            </a>
                        </div>
                        </form> 
                        
                    </div>
                </div>
            </div>
        </div> -->
        <!-- /Upload Reply Documents -->
    </div>
    <!-- /Main Wrapper -->

<?php $this->load->view('includes/footer'); ?>	
