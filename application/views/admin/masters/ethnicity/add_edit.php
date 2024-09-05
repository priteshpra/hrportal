<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/ethnicity"><strong><?php echo label('msg_lbl_ethnicity')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addEthnicityForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/ethnicity/<?php echo $page_name; ?>">
                    <input id="EthnicityID" name="EthnicityID" value="<?php echo @$ethnicity->EthnicityID; ?>" type="hidden"  />
                    <input style="display: none;" type="password" />
                    <div class="row">
                        <div class="input-field col s4">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_ethnicity');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="EthnicityName" name="EthnicityName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$ethnicity->EthnicityName; ?>"  maxlength="50" />
                            <label for="EthnicityName"><?php echo label('msg_lbl_select_ethnicity')?></label>
                        </div>
                        <div class="input-field col s4" id="Parent">
                            <?= @$Parent;?>
                        </div>
                        

                    </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($ethnicity->Status) && @$ethnicity->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" >Submit

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/ethnicity" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>