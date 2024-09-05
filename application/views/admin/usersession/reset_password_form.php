<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="msapplication-tap-highlight" content="no" />
        <meta name="description" content="PettsClub" />
        <meta name="keywords" content="HairArtist" />
        <title>PettsClub</title>

        <!-- Favicons-->
        <link rel="icon" href="<?php echo $this->config->item('admin_assets'); ?>images/favicon/favicon-32x32.png" sizes="32x32" />
        <!-- Favicons-->
        <link rel="apple-touch-icon-precomposed" href="<?php echo $this->config->item('admin_assets'); ?>images/favicon/apple-touch-icon-152x152.png" />
        <!-- For iPhone -->
        <meta name="msapplication-TileColor" content="#26A2D5" />
        <meta name="msapplication-TileImage" content="<?php echo $this->config->item('admin_assets'); ?>images/favicon/mstile-144x144.png" />
        <!-- For Windows Phone -->
        <!-- CORE CSS-->

        <link href="<?php echo $this->config->item('admin_assets'); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <!-- Custome CSS-->    
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <!-- CSS for full screen (Layout-2)-->    
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/style-fullscreen.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection" />

        <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/prism.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <link href="<?php echo $this->config->item('admin_assets'); ?>js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <link href="<?php echo $this->config->item('admin_assets'); ?>css/common_css.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <style type="text/css">
            .lock-screen {
                background: url("") no-repeat fixed 0 0 / cover;
            }
        </style>
    </head>

    <body class="lock-screen">
        <!-- Start Page Loading -->
        <div id="loader-wrapper">
            <div id="loader"></div>        
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <!-- End Page Loading -->

        <div id="login-page" class="row">
            <div class="col s12 z-depth-4 card-panel">
                 
                <form class="reset-password-form" action="<?php echo $this->config->item('base_url'); ?>admin/usersession/postResetPassword" method="post">
                    
                    <div class="row">
                        <div class="input-field col s12 center">
                            <img src="<?php echo $this->config->item('admin_assets'); ?>images/logo.png" alt="" class="circle responsive-img valign profile-image-login" />
                            <p class="center login-form-text">PettsClub</p>
                        </div>
                    </div>
                    <?php
                    if ($user_id == 0) 
                    {
                        ?>
                        <div class="alert-box error"><span>error: </span>This link is expired </div>
                        <?php
                    }
                    else
                    {
                        ?>                    
                        
                        <?php
                        if (isset($this->session->userdata['reset_password_error'])) {
                            ?>
                            <div class="alert-box error"><span>error: </span><?php echo $this->session->flashdata('reset_password_error'); ?></div>	
                            <?php
                        }
                        ?>

                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="mdi-action-lock-outline prefix"></i>
                                <input id="password" type="password" name="password"/>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="mdi-action-lock-outline prefix"></i>
                                <input id="confirm_password" type="password" name="confirm_password"/>
                                <label for="confirm_password">Confirm Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                                <a class="btn waves-effect waves-light col s12 reset_password_button">RESET PASSWORD</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </form>
            </div>
        </div>
        <!-- ================================================
          Scripts
          ================================================ -->

        <!-- jQuery Library -->
        <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/jquery-1.11.2.min.js"></script>
        <!--materialize js-->
        <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/materialize.js"></script>
        <!--prism-->
        <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/prism.js"></script>


        <!--plugins.js - Some Specific JS codes for Plugin Settings-->
        <script type="text/javascript" src="<?php echo $this->config->item('admin_assets'); ?>js/plugins.js"></script>
        <script>
            $(document).ready(function ()
            {
                $('.reset_password_button').click(function ()
                {
                    $('.reset-password-form').submit()
                });
            });
        </script>
    </body>

</html>