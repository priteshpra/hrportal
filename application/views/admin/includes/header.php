<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="<?php echo label('msg_lbl_site_title_name'); ?>">
    <meta name="keywords" content="<?php echo label('msg_lbl_site_title_name'); ?>">
    <title><?php echo label('msg_lbl_site_title_name'); ?></title>

    <!-- Favicons-->
    <link rel="icon" href="<?php echo $this->config->item('admin_assets'); ?>img/login-logo.png" sizes="32x32">
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/font-awesome.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <!-- Favicons-->
    <!-- CORE CSS-->
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.clockpicker.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- CSS for full screen (Layout-2)-->
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/style-fullscreen.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?php echo $this->config->item('admin_assets'); ?>css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- alertify CSS -->
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.core.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/alertify.default.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>css/select2.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/morris-chart/morris.css" />
    <!-- jQuery Library -->
    <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/jquery-1.11.2.min.js"></script>

</head>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="cyan">
                <div class="nav-wrapper">

                    <ul class="left">
                        <li class="no-hover"><a href="#" tabindex="997" data-activates="slide-out" class="menu-sidebar-collapse btn-floating btn-flat btn-medium waves-effect waves-light cyan"><i class="mdi-navigation-menu"></i></a></li>
                        <li>
                            <h1 class="logo-wrapper"><a tabindex="998" href="<?php echo site_url(); ?>" class="brand-logo darken-1"><img src="<?php echo $this->config->item('admin_assets'); ?>img/logo.png"> <!-- <span class="logo-text"><?php echo label('msg_lbl_site_title_name'); ?></span> --></a> </h1>
                        </li>
                    </ul>
                    <ul class="right hide-on-med-and-down">
                        <li><a tabindex='999' href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i title="Fullscreen" class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="<?php echo $this->config->item('base_url'); ?>admin/usersession/notification" class="waves-effect waves-block waves-light"><i class="mdi-social-notifications"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <!-- END HEADER -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">

            <!-- START LEFT SIDEBAR NAV-->
            <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav leftside-navigation">
                    <li class="user-details cyan darken-2">
                        <div class="row">
                            <div class="col col s4 m4 l4">
                                <h3 class="user-h3"><?php echo substr($this->session->userdata['FirstName'], 0, 1); ?></h3>
                            </div>
                            <div class="col col s8 m8 l8 p-0">
                                <ul id="profile-dropdown" class="dropdown-content">
                                    <li><a href="<?php echo $this->config->item('base_url'); ?>my-profile"><i class="mdi-action-face-unlock"></i>My Profile</a>
                                    </li>
                                    <li><a href="<?php echo $this->config->item('base_url'); ?>admin/role"><i class="mdi-action-input"></i>Roles</a>
                                    </li>
                                    <!--  <li><a href="<?php echo $this->config->item('base_url'); ?>admin/rolemapping"><i class="mdi-action-list"></i>Roles Mapping</a>
                                        </li> -->
                                    <li><a href="<?php echo $this->config->item('base_url'); ?>change-password"><i class="mdi-communication-vpn-key"></i>Change Password</a>
                                    </li>
                                    <li><a href="<?php echo $this->config->item('base_url'); ?>logout"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                    </li>
                                </ul>

                                <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">
                                    <p class="wrap_content_header"><?php echo $this->session->userdata['FirstName']; ?></p><i class="mdi-navigation-arrow-drop-down right"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>admin-dashboard" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <?php if (in_array("1", $this->module_data)) { ?>
                                <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-account-circle"></i>Masters</a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <?php if (in_array("33", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/advertisement">
                                                        Advertisement
                                                    </a></li>
                                            <?php }
                                            if (in_array("5", $this->module_data)) { ?>
                                                <li class="hide"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/area">
                                                        Area
                                                    </a></li>
                                            <?php }
                                            if (in_array("17", $this->module_data)) { ?>
                                                <li class="hide"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/banner">
                                                        Banner
                                                    </a></li>
                                            <?php }
                                            if (in_array("13", $this->module_data)) { ?>
                                                <li class="hide"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/category">
                                                        Category
                                                    </a></li>
                                            <?php }
                                            if (in_array("3", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/City">City</a></li>
                                            <?php }
                                            if (in_array("16", $this->module_data)) { ?>
                                                <li class="wrap_content_header"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/cms">
                                                        Content Management System
                                                    </a></li>
                                            <?php }
                                            if (in_array("2", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/country">
                                                        Country
                                                    </a></li>
                                            <?php }
                                            if (in_array("11", $this->module_data)) { ?>
                                                <li class="hide"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/currency">
                                                        Currency
                                                    </a></li>
                                            <?php }
                                            /*if(in_array("16",$this->module_data)){?>
                                                <li class="wrap_content_header"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/department">
                                                   Department
                                                </a></li>
                                            <?php }*/
                                            if (in_array("26", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/designation">
                                                        Position</a></li>
                                            <?php }
                                            if (in_array("25", $this->module_data)) { ?>
                                                <!-- <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/education">
                                                        Education
                                                    </a></li> -->
                                            <?php }
                                            if (in_array("10", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/emailtemplate">
                                                        Email Template
                                                    </a></li>
                                            <?php }
                                            if (in_array("15", $this->module_data)) { ?>
                                                <li class="hide"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/employeeinouttime">
                                                        Employee InOut Time
                                                    </a></li>
                                            <?php }
                                            if (in_array("15", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/industrytype">
                                                        Sector
                                                    </a></li>

                                            <?php }
                                            if (in_array("18", $this->module_data)) { ?>
                                                <li class="hide"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/leaverequest">
                                                        Leave Request
                                                    </a></li>

                                            <?php }
                                            if (in_array("18", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/message">
                                                        Message
                                                    </a></li>
                                            <?php }
                                            if (in_array("34", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/Motivationalquotes">
                                                        Motivational quotes
                                                    </a></li>
                                            <?php }
                                            if (in_array("14", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/pagemaster">
                                                        Page Master
                                                    </a></li>
                                            <?php }

                                            if (in_array("20", $this->module_data)) { ?>
                                                <li class="hide"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/smstemplate">SMS Template</a></li>
                                            <?php }

                                            if (in_array("21", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/skill">
                                                        Skill
                                                    </a></li>
                                            <?php }

                                            if (in_array("4", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/state">State</a></li>
                                            <?php }
                                            /*
                                            if(in_array("30",$this->module_data)){?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/uom">
                                                    Unit of Measurment
                                                </a></li>
                                            <?php } */
                                            if (in_array("34", $this->module_data)) { ?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/ethnicity">Ethnicity</a></li>
                                            <?php }

                                            /*
                                            if(in_array("23",$this->module_data)){?>
                                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/video">
                                                    Video
                                                </a></li>
                                            <?php }*/ ?>
                                        </ul>
                                    </div>
                                </li>
                            <?php }
                            if (in_array("6", $this->module_data)) { ?>
                                <li class="no-padding">
                                    <ul class="collapsible collapsible-accordion">
                                        <li class="bold"><a class="collapsible-header  waves-effect waves-indigo"><i class="mdi-action-settings"></i>Configuration</a>
                                            <div class="collapsible-body">
                                                <ul>
                                                    <?php if (in_array("7", $this->module_data)) { ?>
                                                        <li><a href="<?php echo $this->config->item('base_url'); ?>admin/configuration/activitylog">Admin Activity Log</a></li>
                                                    <?php }
                                                    if (in_array("8", $this->module_data)) { ?>
                                                        <li><a href="<?php echo $this->config->item('base_url'); ?>admin/configuration/config">Configuration</a></li>
                                                    <?php }
                                                    if (in_array("9", $this->module_data)) { ?>
                                                        <li><a href="<?php echo $this->config->item('base_url'); ?>admin/configuration/errorlog">Error Log</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                            <?php }
                            if (in_array("32", $this->module_data)) { ?>
                                <li class="no-padding">
                                    <ul class="collapsible collapsible-accordion">
                                        <li class="bold"><a class="collapsible-header  waves-effect waves-indigo"><i class="mdi-social-person"></i>User</a>
                                            <div class="collapsible-body">
                                                <ul>
                                                    <?php
                                                    if (in_array("31", $this->module_data)) { ?>
                                                        <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/candidate">
                                                                Candidate
                                                            </a></li>

                                                    <?php }
                                                    if (in_array("24", $this->module_data)) { ?>
                                                        <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/company">
                                                                Company
                                                            </a></li>
                                                    <?php }
                                                    if (in_array("24", $this->module_data)) { ?>
                                                        <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/employeedetails">
                                                                Employee
                                                            </a></li>
                                                    <?php }
                                                    //if (in_array("22", $this->module_data)) { 
                                                    ?>
                                                    <!-- <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/mentor">
                                                                Mentor
                                                            </a></li> -->
                                                    <?php //} 
                                                    ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            <?php }
                            if (in_array("29", $this->module_data)) { ?>
                                <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/Jobpost">
                                        <i class="mdi-action-trending-up"></i>Job Post
                                    </a></li>
                            <?php } ?>
                            <li><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/Unregisteruser">
                                    <i class="mdi-action-trending-up"></i>Un-Register Users
                                </a>
                            </li>
                            <li class="no-padding">
                                <ul class="collapsible collapsible-accordion">
                                    <li class="bold"><a class="collapsible-header  waves-effect waves-indigo"><i class="mdi-content-archive"></i>Reports</a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li><a href="#">Report 1</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

            </aside>
            <!-- END LEFT SIDEBAR NAV-->