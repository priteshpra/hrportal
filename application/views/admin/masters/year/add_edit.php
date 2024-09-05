<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/year"><strong><?php echo label('msg_lbl_title_year');?></strong></a>
            </h4>
            <form class="col s12" id="edit_year_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/year/<?php echo $page; ?>">
              <div class="row">            
                  <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_yearonly');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                    <input id="Year" name="Year" value="<?php echo @$year->year; ?>" type="text"  maxlength="4" class="empty_validation_class NumberOnly"   />
                    <label for="Year"><?php echo label('msg_lbl_year');?></label>
                  </div>
                  <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_year_durationonly');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                    <input id="YearDuration" name="YearDuration" value="<?php echo @$year->yearDuration; ?>" type="text"  maxlength="10" class="empty_validation_class YearOnly"   />
                    <label for="Year"><?php echo label('msg_lbl_year_duration');?></label>
                  </div>
              </div> 
              
              <div class="row">
                  <div class="input-field col s12 m6">     
                        <input    type="checkbox" class="" name="Status" id="Status" <?php if(isset($year->Status) && $year->Status == INACTIVE){echo "";}else{echo "checked='checked'";} ?>   />
                        <label for="Status"><?php echo label('msg_lbl_status');?></label>
                  </div>  
                  <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right year" type="submit" id="button_year_submit" name="button_year_submit"  ><?php echo label('msg_lbl_submit');?>
                    </button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/year" class="right close-button"><?php echo label('msg_lbl_close');?></a>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>