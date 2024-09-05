<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/genders"><strong><?php echo label('msg_lbl_gender');?></strong></a>
            </h4>
            <form class="col s12" id="edit_genders_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/genders/<?php echo $page; ?>">
              <div class="row">            
                  <div class="input-field col s12 m6">
                  <input type="hidden" id="CurrentID" value="<?php echo (@$genders->genderId)?@$genders->genderIdgenderId:0;?>" />
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_gender');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                    <input id="Gender" name="Gender" value="<?php echo @$genders->gender; ?>" type="text"  maxlength="10" class="empty_validation_class onlyletter"   />
                    <label for="Gender"><?php echo label('msg_lbl_gender');?></label>
                  </div>  

                   <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_genderValue');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                    <input id="genderValue" name="genderValue" value="<?php echo @$genders->genderValue; ?>" type="text"  maxlength="1" class="empty_validation_class onlyletter"   />
                    <label for="genderValue"><?php echo label('msg_lbl_genderValue');?></label>
                  </div>

              </div> 
              
              <div class="row">
                  <div class="input-field col s12 m6">     
                        <input    type="checkbox" class="" name="Status" id="Status" <?php if(isset($genders->Status) && $genders->Status == INACTIVE){echo "";}else{echo "checked='checked'";} ?>   />
                        <label for="Status"><?php echo label('msg_lbl_status');?></label>
                  </div>  
                  <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right genders" type="submit" id="button_genders_submit" name="button_genders_submit"  ><?php echo label('msg_lbl_submit');?>
                    </button>
                    <?php echo $loading_button; ?>
                    <a   href="<?php echo $this->config->item('base_url'); ?>admin/masters/genders" class="right close-button"><?php echo label('msg_lbl_close');?></a>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>