<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/employeedetails"><strong><?php echo label('msg_lbl_title_employeedetails')?></strong>
                </a>
            </h4>        
            <div class="row">
            <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/employeedetails/<?php echo $page_name; ?>">

                <input id="UserID" name="UserID" class="hide" value="<?php echo @$employeedetails->UserID; ?>" />

                <div class="row">
                        <div class="input-field col s12 m3">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_first_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FirstName" name="FirstName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$employeedetails->FirstName; ?>"  maxlength="50" />
                            <label for="FirstName"><?php echo label('msg_lbl_first_name')?></label>
                        </div>
                         <div class="input-field col s12 m3">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_last_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LastName" name="LastName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$employeedetails->LastName; ?>"  maxlength="50" />
                            <label for="LastName"><?php echo label('msg_lbl_last_name')?></label>
                         </div>
                       <div class="input-field col s12 m6">
                            <?php if(!isset($employeedetails->UserID)){ ?>
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_email');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <?php }?>
                            <input id="EmailID" name="EmailID" type="email" class="empty_validation_class" value="<?php echo @$employeedetails->EmailID; ?>"  maxlength="255" <?php if(isset($employeedetails->UserID)){echo "readonly";}?>/>
                            <label for="EmailID"><?php echo label('msg_lbl_email')?></label>
                        </div>
                        <div class="input-field col s12 m6">
                          <?php if(!isset($employeedetails->UserID)){ ?>
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_password');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <input id="iPassword" name="Password" type="password" class="empty_validation_class" value="<?php echo @$employeedetails->Password; ?>"  maxlength="100" <?php if(isset($employeedetails->UserID)){echo "readonly";}?>/>
                            <label for="Password"><?php echo label('msg_lbl_password')?></label>
                            <?php }?>
                         </div>
                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_cellphone');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo @$employeedetails->MobileNo; ?>"  maxlength="13"/>
                            <label for="MobileNo"><?php echo label('msg_lbl_cellphone')?></label>
                       </div>
                 
                      <div class="input-field col s12 m12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_address');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="Address" id="Address" class="materialize-textarea empty_validation_class"><?php echo @$employeedetails->Address; ?></textarea>
                            <label for="Address"><?php echo label('msg_lbl_address')?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($employeedetails->Status) && @$employeedetails->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/employeedetails" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>