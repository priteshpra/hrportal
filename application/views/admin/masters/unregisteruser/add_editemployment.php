<?php //print_r($employment);exit();?>

<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/masters/candidate/details/'. $CandidateID."#employment");?>"><strong><?php echo label('msg_lbl_title_employment')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/candidate/<?php echo $page_name; ?>/<?php echo $CandidateID;?>/<?php echo @$ID;?>" enctype= "multipart/form-data">
				 <input id="cuid" name="cuid" value="<?php echo isset($CandidateID)?$CandidateID:0; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s6">
                            <?= @$designation;?>
                        </div>
                         <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_organization');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Organization" name="Organization" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$employment->OrganizationOther; ?>"  maxlength="255" />
                            <label for="Organization"><?php echo label('msg_lbl_organization')?></label>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="input-field col s6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_responsibilities');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                             <textarea name="Responsibilities" id="Responsibilities" maxlength="500" class="materialize-textarea empty_validation_class"><?=@$employment->Responsibilities?></textarea>
                            <label name="Responsibilities" class=""><?php echo label('msg_lbl_responsibilities')?></label>
                        </div>
                        <div class="input-field col s6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_enter_location');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                             <textarea name="Location" id="Location" maxlength="500" class="materialize-textarea empty_validation_class"><?=@$employment->Location?></textarea>
                            <label name="Location" class=""><?php echo label('msg_lbl_location')?></label>
                        </div>
                    </div>
                   <div class="row">
                        <div class="input-field col s6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_startdate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="StartDate" id="StartDate" value="<?php echo isset($employment->StartDate) ? GetDateInFormat($employment->StartDate) : '' ?>" class="empty_validation_class datepicker1">
                            <label name="StartDate" class=""><?php echo label('msg_lbl_startdate')?></label>
                        </div>
                        <div class="col s6">
                            <div class="row m-b-0">
                                <div class="input-field col s6">
                                    <input type="checkbox" class=""  name="IsPresent" id="IsPresent"   
                                    <?php
                                    if (isset($employment->IsPresent) && @$employment->IsPresent == INACTIVE) {
                                        echo "";
                                    } else {
                                        if(!isset($employment->IsPresent)){
                                            echo "";
                                        }
                                        else{
                                        echo "checked='checked'";}
                                    }
                                    ?>>
                                    <label for="IsPresent"><?php echo label('msg_lbl_ispresent')?></label>  
                                </div>
                               
                                 <div class="input-field col s6" id="EndDateDiv">
                                    <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_enddate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                    <input type="text" name="EndDate" id="EndDate" value="<?php echo (@$employment->EndDate != '') ? GetDateInFormat(@$employment->EndDate) : '' ?>"  class="datepicker1">

                                     <!-- <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_enddate');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                    <input class="m-b-0" type="text" name="EndDate" id="EndDate" value="<?php //echo (isset($employment->EndDate) && $employment->EndDate != '1970-01-01') ? $employment->EndDate : '' ?>" class="datepicker "> -->
                                    <label name="EndDate" class=""><?php echo label('msg_lbl_enddate')?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($employment->Status) && @$employment->Status == INACTIVE) {
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
                            <a  href="<?php echo base_url('admin/masters/candidate/details/'. $CandidateID."#employment"); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>