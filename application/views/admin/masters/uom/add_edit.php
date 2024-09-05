<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/uom"><strong><?php echo label('msg_lbl_title_uom');?></strong></a>
            </h4>
            <form class="col s12" id="edit_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/uom/<?php echo $page; ?>">
            <input id="cuid" name="cuid" value="<?php echo isset($uom->UOMID)?$uom->UOMID:0; ?>" type="hidden"  /> 
              <div class="row">            
                  <div class="input-field col s12">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_uom');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                    <input id="UOM" name="UOM" value="<?php echo @$uom->UOM; ?>" type="text"  maxlength="50" class="onlyletter empty_validation_class" />
                    <label for="UOM"><?php echo label('msg_lbl_uom');?></label>
                  </div>
              </div>               
              <div class="row">
                  <div class="input-field col s12 m6">     
                        <input type="checkbox" class="" name="Status" id="Status" <?php if(isset($uom->Status) && $uom->Status == INACTIVE){echo "";}else{echo "checked='checked'";} ?>  />
                        <label for="Status"><?php echo label('msg_lbl_status');?></label>
                  </div>  
                  <div class="input-field col s12 m6">
                    <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>
                    </button>
                    <?php echo $loading_button; ?>
                    <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/uom" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>