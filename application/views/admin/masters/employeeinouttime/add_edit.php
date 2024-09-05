<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/employeeinouttime"><strong><?php echo label('msg_lbl_title_employeeinouttime')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addCountryForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/employeeinouttime/<?php echo $page_name; ?>">
                <div class="row">
                    <div class="input-field col s6">  
                        <?= $employee;?>
                     </div>
                     <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_InOutDate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="InOutDate" id="InOutDate" value="<?php echo isset($employeeinouttime->InOutDate) ? $employeeinouttime->InOutDate: '' ?>" value="" class="datepicker empty_validation_class">
                            <label name="InOutDate" class=""><?php echo label('msg_lbl_InOutDate')?></label>
                    </div>
                </div>
                <div class="row"> 
                    <div class="input-field col s6">
                         <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_InTime');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <div class="colm-three controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                          <input size="16" type="text" class="empty_validation_class number effect-1 datetime"  name="In_time" id="input_endtime" value="<?php echo isset($employeeinouttime->InTime) ? $employeeinouttime->InTime: '' ?>">
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"><i class="icon-th"></i></span>
                            <label for="input_endtime"><?php echo label('msg_lbl_InTime')?></label>
                        </div>
                    </div>   
                    <div class="input-field col s6"> 
                       <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_OutTime');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <div class="colm-three controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                          <input size="16" type="text" class="empty_validation_class number effect-1 datetime" name="Out_time" id="input_outtime" value="<?php echo isset($employeeinouttime->OutTime) ? $employeeinouttime->OutTime: '' ?>">
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"><i class="icon-th"></i></span>
                            <label for="input_outtime"><?php echo label('msg_lbl_OutTime')?></label>
                        </div>
                    </div>   
                </div>                      
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($employeeinouttime->Status) && @$employeeinouttime->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/employeeinouttime" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>