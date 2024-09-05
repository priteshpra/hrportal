<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/month"><strong><?php echo label('msg_lbl_title_month');?></strong></a>
            </h4>
            <form class="col s12" id="edit_month_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/month/<?php echo $page; ?>">
              <div class="row">            
                  <div class="input-field col s6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_month_tooltip');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                    <input id="Month" name="Month" value="<?php echo @$month->month; ?>" type="text"  maxlength="15" class="empty_validation_class onlyletter"    />
                    <label for="Month"><?php echo label('msg_lbl_month');?></label>
                  </div>
              </div> 
              
              <div class="row">
                  <div class="input-field col s12 m6">     
                        <input     type="checkbox" class="" name="Status" id="Status" <?php if(isset($month->Status) && $month->Status == INACTIVE){echo "";}else{echo "checked='checked'";} ?>    />
                        <label for="Status"><?php echo label('msg_lbl_status');?></label>
                  </div>  
                  <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right month" type="submit" id="button_month_submit" name="button_month_submit"   ><?php echo label('msg_lbl_submit');?>
                    </button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/month" class="right close-button"><?php echo label('msg_lbl_close');?></a>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>