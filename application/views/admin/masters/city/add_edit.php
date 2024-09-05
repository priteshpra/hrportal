<?php //print_r($cities);die();?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/city"><strong><?php echo label('msg_lbl_title_city')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addCityForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/city/<?php echo $page_name; ?>">
                    <input id="cid" name="cid" value="<?php echo @$cities->CityID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_city');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CityName" name="CityName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$cities->CityName; ?>"  maxlength="50" />
                            <label for="CityName"><?php echo label('msg_lbl_city')?></label>
                        </div>
                         <div class="input-field col s6">
							<?= $countries;?>
						 </div>
                        </div>
                    <div class="row">
						 <div class="input-field col s6" id="StateDiv">
							<?= $states;?>
						 </div>
                    </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($cities->Status) && @$cities->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/city" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>