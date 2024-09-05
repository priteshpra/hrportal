<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/country"><strong><?php echo label('msg_lbl_title_country')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/country/<?php echo $page_name; ?>">
                    <input id="CountryID" name="CountryID" value="<?php echo @$country->CountryID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s4">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_country_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CountryName" name="CountryName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$country->CountryName; ?>"  maxlength="50" />
                            <label for="CountryName"><?php echo label('msg_lbl_country')?></label>
                        </div>
                        

                    </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($country->Status) && @$country->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/country" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>