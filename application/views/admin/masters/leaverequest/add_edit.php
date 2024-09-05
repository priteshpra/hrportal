<?php //print_r($leaverequest);exit;?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/leaverequest"><strong><?php echo label('msg_lbl_title_leaverequest')?></strong>
                </a>
            </h4>        
            <div class="row">
            <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/leaverequest/<?php echo $page_name; ?>">
                <div class="row">
                        <div class="input-field col s6">
                           <?=@$employee?>
                        </div>
                                                
                        <div class="input-field col s6">
                           <?=@$user?>
                        </div>
                </div>   
               
                 <div class="row">
                   <?php  if(isset($leaverequest->LeaveStartDate)){
                   $str_explode=explode(" ",$leaverequest->LeaveStartDate);
                    $date = $str_explode[0]; 
                    $time = $str_explode[1];}
                   //print_r($str_explode);die();?>
                    <div class="input-field col s6">
                         <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_LeaveStartDate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input type="text" name="LeaveStartDate" id="LeaveStartDate" value="<?php echo isset($leaverequest->LeaveStartDate) ? $date : '' ?>" value="" class="empty_validation_class datepicker ">
                        <label name="LeaveStartDate" class=""><?php echo label('msg_lbl_LeaveStartDate');?></label>
                    </div>
                    <div class="input-field col s6">
                         <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_StartTime');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <div class="colm-three controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                          <input size="16" type="text" class="empty_validation_class number effect-1 datetime"  name="In_time" id="input_endtime" value="<?php echo isset($leaverequest->LeaveStartDate) ? $time: '' ?>">
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"><i class="icon-th"></i></span>
                            <label for="input_endtime"><?php echo label('msg_lbl_StartTime')?></label>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <?php if(isset($leaverequest->LeaveEndDate)){
                    $str_explode=explode(" ",$leaverequest->LeaveEndDate);
                    $date = $str_explode[0]; 
                    $time = $str_explode[1]; }
                   // print_r($str_explode);die();?>  
                    <div class="input-field col s6">
                        <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_LeaveEndDate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input type="text" name="LeaveEndDate" id="LeaveEndDate" value="<?php echo isset($leaverequest->LeaveEndDate) ? $date : '' ?>" value="" class="empty_validation_class datepicker ">
                        <label name="LeaveEndDate" class=""><?php echo label('msg_lbl_LeaveEndDate');?></label>
                    </div>
                     <div class="input-field col s6"> 
                       <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_EndTime');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <div class="colm-three controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                          <input size="16" type="text" class="empty_validation_class number effect-1 datetime" name="End_time" id="input_outtime" value="<?php echo isset($leaverequest->LeaveEndDate) ? $time: '' ?>">
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"><i class="icon-th"></i></span>
                            <label for="input_outtime"><?php echo label('msg_lbl_EndTime')?></label>
                        </div>
                    </div>   
                 </div>
                 <div class="row">
                  <div class="input-field col s12 m6">
                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_LeaveDays');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                    <input id="LeaveDays" name="LeaveDays" value="<?php echo @$leaverequest->LeaveDays; ?>" type="text"  maxlength="5" class="AmountOnly empty_validation_class" />
                    <label for="LeaveDays"><?php echo label('msg_lbl_LeaveDays');?></label>
                  </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                   <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('enter_valid_LeaveReason');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <textarea name="LeaveReason" id="LeaveReason" class="materialize-textarea" maxlength="500"><?php echo@$leaverequest->LeaveReason;?></textarea>
                            <label for="LeaveReason"><?php echo label('msg_lbl_LeaveReason');?></label>
                        </div>      
                </div>
                  <div class="row">
                    <div class="input-field col s4">
                        <br>
                        <label for="TypeOfLeave"><?php echo label('msg_lbl_TypeOfLeave');?></label>

                        <br>
                        <input name="TypeOfLeave" type="radio" value="PL" id="PL" checked='checked'<?php
                            if (isset($leaverequest->TypeOfLeave) && $leaverequest->TypeOfLeave == "PL"){ echo "";}
                            else{ echo "checked='checked'";}?>/>
                        <label for="PL">PL</label>


                        <input name="TypeOfLeave" type="radio" value="SL" id="SL" <?php
                            if (isset($leaverequest->TypeOfLeave) && $leaverequest->TypeOfLeave == "SL"){echo "checked='checked'";}
                            else{echo "";}?> />
                        <label for="SL">SL</label>

                        <input name="TypeOfLeave" type="radio" value="EL" id="EL" <?php
                            if (isset($leaverequest->TypeOfLeave) && $leaverequest->TypeOfLeave == "EL"){echo "checked='checked'";}
                            else{echo "";}?> />
                        <label for="EL">EL</label>
					</div>
					<div class="input-field col s4">
                        <br>
                        <label for="Leave"><?php echo label('msg_lbl_Leave');?></label>

                        <br>
						<input name="Leave" type="radio" value="HalfDay" id="HalfDay" <?php
                            if (isset($leaverequest->LeaveHalfs) && ($leaverequest->LeaveHalfs == "1sthalf" || $leaverequest->LeaveHalfs == "2ndhalf")){ echo "checked='checked'";}
                            else{ echo '';}?>/>
                        <label for="HalfDay">Half Day Leave</label>
						
						<input name="Leave" type="radio" value="FullDay" id="FullDay" checked='checked'<?php
                            if (isset($leaverequest->LeaveHalfs) && $leaverequest->LeaveHalfs == "FullDay"){ echo "checked='checked'";}
                            else{ echo "";}?>/>
                        <label for="FullDay">Full Day Leave</label>
                    </div>
					
					<div class="input-field col s4" <?php if (isset($leaverequest->LeaveHalfs) && ($leaverequest->LeaveHalfs == "1sthalf" || $leaverequest->LeaveHalfs == "2ndhalf")){ echo '';}else{echo 'style=display:none';}?> id="leave_halfs">
                        <br>
                        <label for="LeaveHalfs"><?php echo label('msg_lbl_LeaveHalfs');?></label>

                        <br>
						<input name="LeaveHalfs" type="radio" value="1sthalf" id="1sthalf" checked='checked'<?php
                            if (isset($leaverequest->LeaveHalfs) && $leaverequest->LeaveHalfs == "1sthalf"){ echo "checked='checked'";}
                            else{ echo "";}?>/>
                        <label for="1sthalf">1st Half Leave</label>
						
						<input name="LeaveHalfs" type="radio" value="2ndhalf" id="2ndhalf" <?php
                            if (isset($leaverequest->LeaveHalfs) && $leaverequest->LeaveHalfs == "2ndhalf"){ echo "checked='checked'";}
                            else{ echo "";}?>/>
                        <label for="2ndhalf">2nd Half Leave</label>
                    </div>
					
                    <div class="input-field col s4">
                        <br>
                        <label for="LeaveStatus"><?php echo label('msg_lbl_LeaveStatus');?></label>

                        <br>
                        <input name="LeaveStatus" type="radio" value="Pending" id="Pending" checked='checked'<?php
                            if (isset($leaverequest->LeaveStatus) && $leaverequest->LeaveStatus == "Pending"){ echo "";}
                            else{ echo "checked='checked'";}?>/>
                        <label for="Pending">Pending</label>


                        <input name="LeaveStatus" type="radio" value="Approved" id="Approved" <?php
                            if (isset($leaverequest->LeaveStatus) && $leaverequest->LeaveStatus == "Approved"){echo "checked='checked'";}
                            else{echo "";}?> />
                        <label for="Approved">Approved</label>

                        <input name="LeaveStatus" type="radio" value="Disapproved" id="Disapproved" <?php
                            if (isset($leaverequest->LeaveStatus) && $leaverequest->LeaveStatus == "Disapproved"){echo "checked='checked'";}
                            else{echo "";}?> />
                        <label for="Disapproved">Disapproved</label>
                    </div>

                </div>
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($leaverequest->Status) && @$leaverequest->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status"><?php echo label('msg_lbl_status');?></label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/leaverequest" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>