<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/message"><strong><?php echo label('msg_lbl_title_message')?></strong></a>
            </h4>
            <form class="col s12" id="edit_message_form" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/message/<?php echo $page_name; ?>">
              <div class="row">    
                 <div class="input-field col s6">
                  <?php echo @$language;?>        
                </div>
                  <div class="input-field col s6">
                   <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_messagekey');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                  
                    <input id="MessageKey" name="MessageKey" value="<?php echo @$message->MessageKey; ?>" type="text"  maxlength="150" class="empty_validation_class"  />
                    <label for="MessageKey"><?php echo label('msg_lbl_messagekey')?></label>
                  </div>  
                </div>
                <div class="row">
                   <div class="input-field col s6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_message');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                       
                    <input id="Message" name="Message" value="<?php echo @$message->Message; ?>" type="text"  maxlength="250" class="empty_validation_class onlyletter"  />
                    <label for="Message"><?php echo label('msg_lbl_title_message')?></label>
                  </div>
                </div>
                 <div class="input-field col s6">     
                        <input   type="checkbox" class="" name="Status" id="Status" <?php if(isset($message->Status) && $message->Status == INACTIVE){echo "";}else{echo "checked='checked'";} ?>  />
                        <label for="Status"><?php echo label('msg_lbl_status');?></label>
                  </div>                   
              </div> 
              
              <div class="row">
                  <div class="input-field col s12">
                    <button class="btn waves-effect waves-light right message" type="submit" id="button_message_submit" name="button_message_submit" ><?php echo label('msg_lbl_submit');?>
                    </button>
                    <?php echo $loading_button; ?>
                    <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/message" class="right close-button">Cancel</a>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>