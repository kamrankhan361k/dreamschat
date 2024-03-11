<?php
$session = $this->session->userdata('username');
//$ul = custom_language($session['user'], $session['language']);
?>
<script type="text/javascript">
    var uslang = '<?=$session['language']?>';
</script>
<!-- Left Sidebar Menu -->
<div class="sidebar-menu">
     <div class="logo-col">
        <!-- <a href="<//?php echo base_url(); ?>home"><img src="assets/img/logo.png" alt="Logo"></a> -->
        <a href="<?php echo base_url(); ?>home"><img src="<?php echo base_url(); ?>uploads/website/<?=getenv('DB_COMPANY_ICON')?>" alt="Logo"></a>
       </div> 

   
    <div class="menus-col">
        <div class="chat-menus">
            <ul>
                <li>
                    <a href="<?php echo base_url(); ?>home" class="chat-unread <?=($this->uri->segment(1) == "home") ? 'active':''?>" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Chat">
                        <i class="bx bx-message-square-dots"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>group" class="chat-unread <?=($this->uri->segment(1) == "group") ? 'active':''?>" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Group">
                        <i class="bx bx-group"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>status" class="chat-unread <?=($this->uri->segment(1) == "status") ? 'active':''?>" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Status">
                        <i class="bx bx-stop-circle"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>call" class="chat-unread <?=($this->uri->segment(1) == "call") ? 'active':''?>" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Call">
                        <i class="bx bx-phone"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>contacts" class="chat-unread <?=($this->uri->segment(1) == "contacts") ? 'active':''?>" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Contact">
                        <i class="bx bx-user-pin"></i>
                    </a>
                </li>
                <li>
                    <!-- <a href="<?php echo base_url(); ?>settings" class="chat-unread <?=($this->uri->segment(1) == "settings") ? 'active':''?>" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Settings">
                        <i class="bx bx-cog"></i>
                    </a> -->
                    <a href="javascript:void(0);" class="chat-unread <?=($this->uri->segment(1) == "settings") ? 'active':''?>" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Settings" onclick="sidebaractive()">
                        <i class="bx bx-cog"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bottom-menus">
            <ul>
                <li>
                    <a href="#" id="dark-mode-toggle" class="dark-mode-toggle <?=(getenv('DB_INTERFACE_THEME') == "dark") ? 'active':''?>"  onclick="lightappearancesettings()">
                        <i class="bx bx-sun"></i>
                    </a>
                    <a href="#" id="light-mode-toggle" class="dark-mode-toggle <?=(getenv('DB_INTERFACE_THEME') == "light") ? 'active':''?>"  onclick="darkappearancesettings()">
                        <i class="bx bx-moon"></i>
                    </a>
                </li>
                <li>
                    <div class="avatar avatar-online">
                        <a href="<?php echo base_url(); ?>" class="chat-profile-icon" data-bs-toggle="dropdown">
                            <img id="current-user-profile-left" src="" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- <a href="<?php //echo base_url(); ?>settings" class="dropdown-item"><span><i class="bx bx-cog"></i></span>Settings</a> -->
                            <a href="<?php echo base_url(); ?>logout" class="dropdown-item"><span><i class="bx bx-log-out"></i></span>Logout </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Left Sidebar Menu -->
<?php $this->load->view('includes/settings-sidebar'); ?>