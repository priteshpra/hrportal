    
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="<?php echo label('msg_lbl_site_title_name');?>">
        <meta name="keywords" content="<?php echo label('msg_lbl_site_title_name');?>">
        <title><?php echo label('msg_lbl_site_title_name');?></title>

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
                            <li class="no-hover"><a href="#" tabindex="997" data-activates="slide-out" class="menu-sidebar-collapse btn-floating btn-flat btn-medium waves-effect waves-light cyan"><i class="mdi-navigation-menu" ></i></a></li>
                            <li><h1 class="logo-wrapper"><a tabindex="998" href="<?php echo site_url(); ?>" class="brand-logo darken-1"><!-- <img src="<?php echo $this->config->item('admin_assets'); ?>img/logo.png"> --> <span class="logo-text"><?php echo label('msg_lbl_site_title_name');?></span></a> </h1></li>
                        </ul>
                        <ul class="right hide-on-med-and-down">                        
                            <li><a tabindex='999' href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i title="Fullscreen" class="mdi-action-settings-overscan"></i></a>
                            </li>                        
                            <!-- <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light"><i class="mdi-social-notifications"></i></a>
                            </li> -->
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
                                    <h3 class="user-h3"><?php echo substr($this->current_session['FirstName'], 0, 1); ?></h3>
                                </div>
                                <div class="col col s8 m8 l8 p-0">
                                    <ul id="profile-dropdown" class="dropdown-content">
                                        <input type="hidden" id="CurrentUserID" name="CurrentUserID" value="<?php echo $this->current_session['UserID'];?>">
                                        <li><a href="<?php echo $this->config->item('base_url'); ?>company-profile"><i class="mdi-action-face-unlock"></i>My Profile</a>
                                        </li>
                                        <li><a href="<?php echo $this->config->item('base_url'); ?>company-change-password"><i class="mdi-communication-vpn-key"></i>Change Password</a>
                                        </li>
                                        <li><a href="javascript:void(0)" id="DeleteAccount"><i class="mdi-action-delete"></i> Delete Account</a>
                                        <li><a href="<?php echo $this->config->item('base_url'); ?>company-logout"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                        </li>
                                    </ul>

                                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><p class="wrap_content_header"><?php echo $this->current_session['FirstName']; ?></p><i class="mdi-navigation-arrow-drop-down right"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>company-dashboard" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                        </li>

                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                 <?php $var=$this->session->userdata['IsOwner']; 
                                if($var == 1){?>
                                <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>company-employee" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Employee </a>
                                </li>
                                <?php }?>

                                <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>company/jobpost" class="waves-effect waves-cyan"><i class="mdi-action-trending-up"></i> Job Post </a>
                                </li>
                                <li class="bold"><a href="<?php echo $this->config->item('base_url'); ?>company/Candidate" class="waves-effect waves-cyan"><i class="mdi-maps-local-library"></i> Candidate </a>
                                </li>
                                <li class="no-padding">
                                    <ul class="collapsible collapsible-accordion">
                                        <li class="bold"><a  class="collapsible-header  waves-effect waves-indigo"><i class="mdi-content-archive"></i>Reports</a>
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
                