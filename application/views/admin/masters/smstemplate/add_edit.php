<?php //echo pr($notificationmessages);exit;?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/smstemplate"><strong><?php echo label('msg_lbl_title_smstemplate')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/smstemplate/<?php echo $page_name; ?>">
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="Action" class="active"><?php echo label('msg_lbl_notificationaction')?></label>
							<select id="Action" name="Action" class="select-dropdown" style="width:100%;display:none">
								<option value="" selected="selected">Select Action</option>
								<option value='Add Job' <?php if(@$smstemplate->Action == 'Add Job'){echo 'selected';}?>> Add Job </option>
								<option value='Apply Job' <?php if(@$smstemplate->Action == 'Apply Job'){echo 'selected';}?>> Apply Job </option>
								
							</select>
                        </div>
                         <div class="input-field col s6">
							<label for="Role" class="active"><?php echo label('msg_lbl_role')?></label>
							<select id="Role" name="Role" class="select-dropdown" style="width:100%;display:none">
								<option value="" selected="selected">Select Role</option>
								<option value='Admin' <?php if(@$smstemplate->Role == 'Admin'){echo 'selected';}?>> Admin </option>
								<option value='Employee' <?php if(@$smstemplate->Role == 'Employee'){echo 'selected';}?>> Employee </option>
								<option value='Candidate' <?php if(@$smstemplate->Role == 'Candidate'){echo 'selected';}?>> Candidate </option>
								  
							</select>
						 </div>
						 <div class="input-field col s12">
							<textarea name="message" id="message" class="materialize-textarea empty_validation_class"  maxlength="1000"><?php echo @$smstemplate->message; ?></textarea>
                            <label for="Message">Message</label>
						</div>
						<div class="input-field col s12 m12">
						<?php if(@$smstemplate->SMSKeys != ''){ 
						echo $smstemplate->SMSKeys;	
						} ?>
						</div>
                    </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($smstemplate->Status) && @$smstemplate->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/smstemplate" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>

