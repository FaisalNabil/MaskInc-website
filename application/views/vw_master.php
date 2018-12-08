<?php 
/*echo '<pre>';
print_r($this->aauth->get_menu()); die();*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="ISOL Limited" />
    <meta name="author" content="Rakib Ibna Hamid" />
    <link rel="icon" href="<?= base_url() ?>assets/images/fav.png">
    <title>MaskInc - Dashboard</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-core.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-components.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-skins.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

    <!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

</head>
<body class="page-body">
<div class="settings-pane">

    <a href="#" data-toggle="settings-pane" data-animate="true">
        &times;
    </a>

    <div class="settings-pane-inner">

        <div class="row">

            <div class="col-md-4">

                <div class="user-info">

                    <div class="user-image">
                        <a href="extra-profile.html">
                            <img src="<?php echo base_url(); ?>assets/images/user-2.png" class="img-responsive img-circle" />
                        </a>
                    </div>

                    <div class="user-details">

                        <h3>
                            <a href="extra-profile.html"><?php if($this->session->has_userdata('user_name'))
                                { echo $this->session->userdata('user_name'); }
                                ?></a>

                            <!-- Available statuses: is-online, is-idle, is-busy and is-offline -->
                            <span class="user-status is-online"></span>
                        </h3>

                        <p class="user-title"><?php if($this->session->has_userdata('designation'))
                            { echo $this->session->userdata('designation'); }
                            ?></p>

                        <!--<div class="user-links">
                            <a href="extra-profile.html" class="btn btn-primary">Edit Profile</a>
                            <a href="extra-profile.html" class="btn btn-success">Upgrade</a>
                        </div>-->
                        <div class="user-links">
                            <!--                            <a href="extra-profile.html" class="btn btn-primary">Edit Profile</a>-->
                            <a href="<?php echo base_url()?>change_password" class="btn btn-success">Change Password</a>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-8 link-blocks-env">

                <div class="links-block left-sep">
                </div>

                <div class="links-block left-sep">
                </div>

            </div>

        </div>

    </div>

</div>

<div class="page-container">
    <div class="sidebar-menu toggle-others fixed">

        <div class="sidebar-menu-inner">
            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="<?= base_url()?>" class="logo-expanded">
                        <img src="<?php echo base_url(); ?>assets/images/logo.png" style="width: 80%;height: 50px;" />
                    </a>

                    <!--<a href="<?/*= base_url()*/?>" class="logo-collapsed">
                        <img src="<?php /*echo base_url(); */?>assets/images/fav.png" alt="ISOL Logo" />
                    </a>-->
                </div>

                <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                <div class="mobile-menu-toggle visible-xs">
                    <a href="<?php echo base_url() ?>admin/login/logout" >
                        <i class="fa-lock"></i>
                    </a>

                    <a href="#" data-toggle="mobile-menu">
                        <i class="fa-bars"></i>
                    </a>
                </div>

                <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
                <div class="settings-icon">
                    <a href="#" data-toggle="settings-pane" data-animate="true">
                        <i class="linecons-cog"></i>
                    </a>
                </div>

            </header>

            <?php echo $this->aauth->get_menu1(); ?>

        </div>

    </div>

    <div class="main-content">

        <nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->

            <!-- Left links for user info navbar -->
            <ul class="user-info-menu left-links list-inline list-unstyled">

                <li class="hidden-sm hidden-xs">
                    <a href="#" data-toggle="sidebar">
                        <i class="fa-bars"></i>
                    </a>
                </li>

            </ul>


            <!-- Right links for user info navbar -->
            <ul class="user-info-menu right-links list-inline list-unstyled">
                <li class="dropdown user-profile">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url(); ?>assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                        <span>
								<?php if($this->session->has_userdata('user_name')){ echo $this->session->userdata('user_name'); }
                                ?>
                            <i class="fa-angle-down"></i>
							</span>
                    </a>

                    <ul class="dropdown-menu user-profile-menu list-unstyled">
                        <li class="last">
                            <a href="<?php echo base_url('admin/login/logout'); ?>">
                                <i class="fa-lock"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>



        <?php if(isset($main_content)) { $this->load->view($main_content); } ?>

        <!-- Main Footer -->
        <!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
        <!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
        <!-- Or class "fixed" to  always fix the footer to the end of page -->
        <footer class="main-footer sticky footer-type-1">

            <div class="footer-inner">

                <!-- Add your copyright text here -->
                <div class="footer-text">
                    <a href="">© 2018 All Rights Reserved. Designed and Developed by Appinion BD Limited.</a>
                </div>


                <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                <div class="go-up">

                    <a href="#" rel="go-top">
                        <i class="fa-angle-up"></i>
                    </a>

                </div>

            </div>

        </footer>
    </div>

</div>





<!-- Page Loading Overlay -->
<div class="page-loading-overlay">
    <div class="loader-2"></div>
</div>
<script src="<?= base_url()?>assets/js/dx_js/dx.all.js"></script>
<!-- Bottom Scripts -->
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/js/TweenMax.min.js"></script>
<script src="<?php echo base_url()?>assets/js/resizeable.js"></script>
<script src="<?php echo base_url()?>assets/js/joinable.js"></script>
<script src="<?php echo base_url()?>assets/js/xenon-api.js"></script>
<script src="<?php echo base_url()?>assets/js/xenon-toggles.js"></script>
<script src="<?php echo base_url()?>assets/js/datatables/js/jquery.dataTables.min.js"></script>


<!-- Imported scripts on this page -->
<script src="<?php echo base_url()?>assets/js/xenon-widgets.js"></script>
<script src="<?php echo base_url()?>assets/js/devexpress-web-14.1/js/globalize.min.js"></script>
<script src="<?php echo base_url()?>assets/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
<script src="<?php echo base_url()?>assets/js/toastr/toastr.min.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="<?php echo base_url()?>assets/js/xenon-custom.js"></script>



<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/select2/select2.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/multiselect/css/multi-select.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/datatables/dataTables.bootstrap.css">
<!--<link href="--><?php //echo base_url()?><!--assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">-->

<!-- Bottom Scripts -->
<script src="<?php echo base_url()?>assets/js/moment.min.js"></script>


<!-- Imported scripts on this page -->
<script src="<?php echo base_url()?>assets/js/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url()?>assets/js/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>assets/js/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url()?>assets/js/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url()?>assets/js/select2/select2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url()?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script src="<?php echo base_url()?>assets/js/tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url()?>assets/js/typeahead.bundle.js"></script>
<script src="<?php echo base_url()?>assets/js/handlebars.min.js"></script>
<script src="<?php echo base_url()?>assets/js/multiselect/js/jquery.multi-select.js"></script>


<script src="<?php echo base_url()?>assets/js/jquery-validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/js/inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url()?>assets/js/formwizard/jquery.bootstrap.wizard.min.js"></script>

<script src="<?php echo base_url()?>assets/js/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url()?>assets/js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
<script src="<?php echo base_url()?>assets/js/datatables/tabletools/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url()?>assets/js/rwd-table/js/rwd-table.min.js"></script>


<!-- JavaScripts plugins -->
<!--<script src="--><?php //echo base_url()?><!--assets/js/tables/jquery-datatable.js"></script>-->


<script src="<?php echo base_url()?>assets/js/exam_result_data/data.js"></script>
<script src="<?php echo base_url()?>assets/js/icheck/icheck.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/js/icheck/skins/all.css">


<!-- JavaScripts initializations and stuff -->
<script src="<?php echo base_url()?>assets/js/xenon-custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.dirtyforms.min.js"></script>


</body>
</html>