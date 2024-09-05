<?php //print_r($jobpost);die();?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>company/jobpost"><strong><?php echo label('msg_lbl_title_jobpost')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>company/jobpost/<?php echo $page_name; ?>" enctype="multipart/form-data">
                    <input id="JobPostID" name="JobPostID" value="<?php echo @$jobpost->JobPostID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_jobtitle');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="JobTitle" name="JobTitle" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$jobpost->JobTitle; ?>"  maxlength="100" />
                            <label for="JobTitle"><?php echo label('msg_lbl_jobtitle')?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <?php echo @$designation;?>
                        </div>
                    </div>  
                     <div class="row">
                         <div class="input-field col s12 m6">
                            <?php echo @$industrytype;?>
                         </div>
                         <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_noofvancancies');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="NoOfVacancies" name="NoOfVacancies" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$jobpost->NoOfVacancies; ?>"  maxlength="4" />
                            <label for="NoOfVacancies"><?php echo label('msg_lbl_noofvacancies')?></label>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col s12 m6 m-t-10">
                            <?php 
                            $MinExperienceYear = '';
                            $MinExperienceMonth = '';
                            $MaxExperienceYear = '';
                            $MaxExperienceMonth = '';
                            if(isset($jobpost->MinExperience) && $jobpost->MinExperience > 0){
                                 $MinExperienceYear = round(bcdiv($jobpost->MinExperience, 12));
                                 $MinExperienceMonth = $jobpost->MinExperience - ($MinExperienceYear*12);
                            }
                            if(isset($jobpost->MaxExperience) && $jobpost->MaxExperience > 0){
                                 $MaxExperienceYear = round(bcdiv($jobpost->MaxExperience, 12));
                                 $MaxExperienceMonth = $jobpost->MaxExperience - ($MaxExperienceYear*12);
                            }
                            ?>

                            
                            <!-- <label for="MinExperience"><?php echo label('msg_lbl_minexperience')?></label> -->
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_minexperience');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <div class="row">
                                <div class="input-field col s12">
                                     
                                    <!-- <label for="MinExperienceYear">Year</label> -->
                                    <input id="MinExperienceYear" name="MinExperienceYear" type="number" class="empty_validation_class NumberOnly" value="<?php echo $MinExperienceYear; ?>" min="0" max="10" />
                                    <label for="MinExperienceYear"><?php echo label('msg_lbl_minexperience')?></label>
                                </div>
                                
                            </div>
                        </div>
                       <div class=" col s12 m6">
                             
                            <!-- <label for="MaxExperience"><?php echo label('msg_lbl_maxexperience')?></label> -->
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_maxexperience');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <div class="row">
                                <div class="input-field col s12">
                                    
                                    <!-- <label for="MaxExperienceYear">Year</label> -->
                                    <input id="MaxExperienceYear" name="MaxExperienceYear" type="number" class="empty_validation_class NumberOnly" value="<?php echo $MaxExperienceYear; ?>"  min="0" max="10" />
                                    <label for="MaxExperienceYear"><?php echo label('msg_lbl_maxexperience')?></label>
                                </div>
                                
                            </div>
                         </div>
                    </div> 
                    <div class="row">
                     <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_minsalary');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MinSalary" name="MinSalary" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$jobpost->MinSalary; ?>"  maxlength="7" num-max-value="MaxSalary" />
                            <label for="MinSalary"><?php echo label('msg_lbl_minsalary'). " (". $config[0]->CurrencyCode.")"?></label>
                        </div> 
                     <div class="input-field col s12 m6">
                         <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_maxsalary');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                        <input id="MaxSalary" name="MaxSalary" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$jobpost->MaxSalary; ?>"  maxlength="7" num-min-value="MinSalary"/>
                        <label for="MaxSalary"><?php echo label('msg_lbl_maxsalary'). " (". $config[0]->CurrencyCode.")"?></label>
                     </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6" id="CountryDiv">
                            <?php echo $country;?>
                         </div>
                         <div class="input-field col s12 m6" id="StateDiv">
                            <?php echo $state;?>
                         </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6" id="CityDiv">
                            <?php echo $cities;?>
                         </div>
                         <div class="input-field col s12 m6">
                            <?php echo @$skills;?>
                         </div>
                    </div>
                    <div class = "row">
                        <div class="input-field search_label_radio col s12 m6">
                            <?php echo @$NatureOfEmployment;?>
                        </div>

                        <div class="input-field col s12 m6">
                            <?php echo @$DesiredCandidateProfile; ?>
                        </div>
                    </div>

                    <div class="row">
                      <div class="input-field col s12 m6">
                         <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_detailsofjob');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="DetailsOfProject" id="DetailsOfProject" class="materialize-textarea empty_validation_class"  maxlength="1000"><?php echo @$jobpost->DetailsOfJob; ?></textarea>
                            <label for="DetailsOfProject"><?php echo label('msg_lbl_description')?></label>
                        </div>
                        
                    </div> 
                    
                    <div class="row">
                        <div class="input-field col s12 m6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($jobpost->Status) && @$jobpost->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status"><?php echo label('msg_lbl_status');?></label>     
                        </div>
                        <div class="input-field col s12 m6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>company/jobpost" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>