<div class="section">
<div class="container">
    <div class="card-panel card-panel-box">
        <h4 class="header">
            <a href="<?php echo $this->config->item('base_url'); ?>change-password"><strong><?php echo label('msg_lbl_change_password');?></strong></a>
        </h4>
        <div class="row">
            <form class="col s12 change_password_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/usersession/postChangePassword">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="current_password" class="empty_validation_class" name="current_password" type="password" maxlength = "32">
                        <label for="current_password"><?php echo label('msg_lbl_current_password');?></label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="new_password" class="empty_validation_class" name="new_password"  type="password" maxlength = "32">
                        <label for="new_password"><?php echo label('msg_lbl_new_password');?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="confirm_password" class="empty_validation_class" name="confirm_password"  type="password" maxlength = "32">
                        <label for="confirm_password"><?php echo label('msg_lbl_confirm_password');?></label>
                    </div>
                </div>
                <div class="row">

                        <div class="input-field col s12">
                            <button id="submit_button" class="submit_button btn right" type="button" name="submit_button"><?php echo label('msg_lbl_submit');?></button>
                            <a class="right close-button" href="<?php echo site_url('admin-dashboard')?>"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                </div>
            </form>
        </div>  
    </div>
    </div>
</div>
