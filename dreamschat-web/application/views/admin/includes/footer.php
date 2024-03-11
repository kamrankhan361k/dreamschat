    <?php $this->load->view('admin/includes/settings-icon'); ?>

    <div>
        <input type="hidden" id="apiKey" value="<?php echo getenv('DB_FIREBASE_APIKEY')?>" />
        <input type="hidden" id="authDomain" value="<?php echo getenv('DB_FIREBASE_AUTHDOMAIN')?>" />
        <input type="hidden" id="databaseURL" value="<?php echo getenv('DB_FIREBASE_DBURL')?>" />
        <input type="hidden" id="projectId" value="<?php echo getenv('DB_FIREBASE_PROJECTID')?>" />
        <input type="hidden" id="storageBucket" value="<?php echo getenv('DB_FIREBASE_STORAGEBUGKET')?>" />
        <input type="hidden" id="messagingSenderId" value="<?php echo getenv('DB_FIREBASE_MESSAGEID')?>" />
        <input type="hidden" id="appId" value="<?php echo getenv('DB_FIREBASE_APPID')?>" />
        <input type="hidden" id="baseUrl" value="<?php echo base_url()?>" />

        <input type="hidden" id="admin_id" value="<?php echo $this->session->userdata('admin_id')?>" />
    </div>

    <script type="text/javascript">
var cmethod = '<?=$this->router->fetch_method()?>';
    </script>
    <script>
        var envData = <?php echo json_encode(['DB_INTERFACE_THEME' => getenv('DB_INTERFACE_THEME')]); ?>;
    </script>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-3.7.0.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrapValidator.min.js"></script>
    


    <script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Datepicker Core JS -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Datatable JS -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/datatables.min.js"></script>

    <!-- Chart JS -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/apexchart/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/plugins/apexchart/chart-data.js"></script>

    <!-- Select JS -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/select2/js/select2.min.js"></script>

    <!-- Swal JS -->
    <script src="<?php echo base_url(); ?>assets/admin/js/sweetalert.min.js"></script>


    <!-- Summernote JS -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/summernote/summernote-lite.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mainconfig.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/fireconfig.js"></script>

    <script src="<?php echo base_url(); ?>assets/admin/js/admin.js"></script>
    <!-- Mobile Input -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/intltelinput/js/intlTelInput.js"></script>
    <script src="<?php echo base_url();?>assets/js/intlTelInput.js"></script>
    
    <?php  if ($this->uri->segment(1) == "language-settings" || $this->uri->segment(1) == "language-keyword" || $this->uri->segment(1) == "language-keywords-list") { ?>
    <script src="<?php echo base_url(); ?>assets/admin/js/language.js"></script>
    <?php } ?>

    <script src="<?php echo base_url(); ?>assets/admin/js/theme-settings.js"></script>

    <!-- RTL js -->
    <script src="<?php echo base_url(); ?>assets/admin/js/rtl.js"></script>
    
    <!-- Toaster JS -->
    <script src="<?php echo base_url();?>assets/admin/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/toastr/toastr.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo base_url(); ?>assets/admin/js/script.js"></script>

    </body>

    </html>