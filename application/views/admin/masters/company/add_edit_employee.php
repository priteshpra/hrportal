<?php //print_r($_GET);die();?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/company/details/<?php echo $CompanyID;?>#all_employee"><strong><?php echo label('msg_lbl_title_employee')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/company/<?php echo $page_name; ?>" enctype="multipart/form-data">
                    <input type="Password" class="hide">
                    <input id="CompanyID" name="CompanyID" value="<?php echo @$employee->CompanyID; ?>" type="hidden"  />
                     <input id="UserID" name="UserID" value="<?php echo @$employee->UserID; ?>" type="hidden"  />
                    <div class="row">             
                      <div class="input-field col s12 m6">
                          <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_first_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                          <input id="FirstName" name="FirstName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$employee->FirstName; ?>"  maxlength="100" />
                          <label for="FirstName"><?php echo label('msg_lbl_first_name')?></label>
                      </div>
                      <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_last_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LastName" name="LastName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$employee->LastName; ?>"  maxlength="100" />
                            <label for="LastName"><?php echo label('msg_lbl_last_name')?></label>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="input-field col s12 m6">       
                          <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_email');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                          <input id="EmailID" name="EmailID" type="email" class="empty_validation_class" value="<?php echo @$employee->EmailID; ?>"  maxlength="250" <?php if(isset($employee->CompanyID)){echo "readonly";}?>/>
                          <label for="EmailID"><?php echo label('msg_lbl_email')?></label>
                      </div>
                      <div class="input-field col s12 m6">
                           <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_cellphone');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                          <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo @$employee->MobileNo; ?>"  maxlength="13"/>
                          <label for="MobileNo"><?php echo label('msg_lbl_cellphone')?></label>
                      </div>
                    </div>
                     <?php if(@$AddFlag == 1){?>
                    <div class="row">
                         <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_password');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <input id="Password" name="Password" type="password" class="empty_validation_class"  maxlength="100"/>
                            <label for="Password"><?php echo label('msg_lbl_password')?></label>
                         </div>
                         <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_password');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <input id="ConfirmPassword" name="ConfirmPassword" type="password" class="empty_validation_class"  maxlength="100" />
                            <label for="ConfirmPassword"><?php echo label('msg_lbl_confirm_password')?></label>
                         </div>
                    </div>
                    <?php }?> 
                    <div class="row">
                      <div class="input-field col s12 m6">     
                        <?php echo @$designation;?>
                      </div>
                    </div>
                       
                        <div class="input-field col s12 m12">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/company/details/<?php echo $CompanyID;?>#all_employee" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                </form>
            </div>
        </div>  
    </div>
</div>