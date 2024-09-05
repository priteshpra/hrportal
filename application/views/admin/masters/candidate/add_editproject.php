<?php //echo $page_name.$project->CandidateID;exit;?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/masters/candidate/details/'. $CandidateID . "#project");?>"><strong><?php echo label('msg_lbl_title_project')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/candidate/<?php echo $page_name; ?>/<?php echo $CandidateID;?>/<?php echo @$ID;?>" enctype= "multipart/form-data">
				 <input id="cuid" name="cuid" value="<?php echo isset($CandidateID)?$CandidateID:0; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_projecttitle');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="ProjectTitle" name="ProjectTitle" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$project->ProjectTitle; ?>"  maxlength="250" />
                            <label for="ProjectTitle"><?php echo label('msg_lbl_projecttitle')?></label>
                        </div>
                         <div class="input-field col s12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_projectdetails');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="ProjectDescription" id="ProjectDescription" maxlength="500" class="materialize-textarea empty_validation_class"><?=@$project->ProjectDescription?></textarea>
                            <label for="ProjectDescription"><?php echo label('msg_lbl_projectdetails')?></label>
                         </div>
                    </div> 
                   <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_employer');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Client" name="Client" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$project->Client; ?>"  maxlength="255" />
                            <label for="Client"><?php echo label('msg_lbl_employer')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_achievements');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="Achievements" id="Achievements" maxlength="500" class="materialize-textarea empty_validation_class"><?=@$project->Achievements?></textarea>
                            <label for="Achievements"><?php echo label('msg_lbl_achievements')?></label>
                        </div>
                        <!-- <div class="input-field col s6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php //echo label('msg_lbl_select_startedfrom');?>"><i class="<?php //echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="StartedFrom" id="StartedFrom" value="<?php //echo (@$project->StartedFrom != '') ? GetDateInFormat(@$project->StartedFrom) : '' ?>" class="empty_validation_class datepicker1 ">
                            <label name="StartedFrom" class=""><?php //echo label('msg_lbl_startedfrom')?></label>
                        </div> -->
                    </div>
                    <!-- <div class="row">
                         <div class="input-field col s6" id="EndDateDiv">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php //echo label('msg_lbl_select_workedtill');?>"><i class="<?php //echo INFO_ICON_CLASS; ?>"></i></a>
                            <input type="text" name="WorkedTill" id="WorkedTill" value="<?php //echo (@$project->WorkedTill != '') ? GetDateInFormat(@$project->WorkedTill) : '' ?>" class="empty_validation_class datepicker1 ">
                            <label name="WorkedTill" class=""><?php //echo label('msg_lbl_workedtill')?></label>
                        </div>
                        <div class="input-field col s6">
                            <label for="ProjectSite"><?php //echo label('msg_lbl_projectsite');?></label>
                            <br>
                            <input name="ProjectSite" type="radio" value="On Site" id="On Site" checked='checked'<?php
                               // if (isset($project->ProjectSite) && $project->ProjectSite == "On Site"){ echo "";}
                               // else{ echo "checked='checked'";}?>/>
                            <label for="On Site">On Site</label>


                            <input name="ProjectSite" type="radio" value="Off Site" id="Off Site" <?php
                               // if (isset($project->ProjectSite) && $project->ProjectSite == "Off Site"){echo "checked='checked'";}
                               // else{echo "";}?> />
                            <label for="Off Site">Off Site</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <?php //echo @$NatureOfEmployment; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php //echo label('msg_lbl_please_select_teamsize');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="TeamSize" name="TeamSize" type="text" class="empty_validation_class NumberOnly" value="<?php //echo @$project->TeamSize; ?>"  maxlength="10" />
                            <label for="TeamSize"><?php //echo label('msg_lbl_teamsize')?></label>
                        </div>
                        <div class="input-field col s6">
                            <?php // echo @$designation;?>
                        </div>
                         
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php //echo label('msg_lbl_please_select_designationdescription');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="DesignationDescription" id="DesignationDescription" maxlength="500" class="materialize-textarea empty_validation_class"><?php // =@$project->DesignationDescription?></textarea>
                            <label for="DesignationDescription"><?php // echo label('msg_lbl_designationdescription')?></label>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($project->Status) && @$project->Status == INACTIVE) {
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
                            <a  href="<?php echo base_url('admin/masters/candidate/details/'.$CandidateID. "#project"); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>