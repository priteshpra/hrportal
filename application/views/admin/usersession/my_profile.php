<?php //print_r($profile);exit();?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('my-profile'); ?>"><strong><?php echo label('msg_lbl_my_profile');?></strong></a>
            </h4>
            <form class="col s12" method="post" action="<?php echo $this->config->item('base_url'); ?>my-profile">
              <div class="row">     
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_first_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a> 
                  <input id="FirstName" type="text" class = "empty_validation_class LetterOnly" name="FirstName" maxlength="50" value="<?php echo @$profile->FirstName;?>" required="required" >
                  <label for="FirstName" class=""><?php echo label('msg_lbl_first_name');?></label>
                </div>
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_last_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="LastName" type="text"  maxlength="50" class = "empty_validation_class LetterOnly" name="LastName" value="<?php echo @$profile->LastName;?>">
                  <label for="LastName" class=""><?php echo label('msg_lbl_last_name');?></label>
                </div>
              </div> 
              <div class="row">
                <div class="input-field col s12 m6">
                                    
                  <input id="Email" type="email"  maxlength="255"  name="Email" value="<?php echo @$profile->EmailID;?>" readonly>
                          <label for="Email" class=""><?php echo label('msg_lbl_email');?></label>
                </div>
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_cellphone');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                  <input id="MobileNo" type="text"  class="empty_validation_class MobileNo"  name="MobileNo" value="<?php echo @$profile->MobileNo;?>" maxlength = "13">
                  <label for="MobileNo" class=""><?php echo label('msg_lbl_cellphone');?></label>
                </div> 
              </div>             
              <div class="row">
                  <div class="input-field col s12 m12">
                    <button class="btn waves-effect waves-light right district" type="submit" id="submit_button" name="submit_button" ><?php echo label('msg_lbl_submit');?>
                    </button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo $this->config->item('base_url'); ?>admin-dashboard" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>