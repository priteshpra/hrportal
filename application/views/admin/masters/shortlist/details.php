<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls ">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/masters/candidate"); ?>"><?php echo label('msg_lbl_title_candidate')?></a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
<!--start container-->
  <div class="container">
    <div class="section">
      <div class="list-page-right candidate-details-box" id="company-details-box">
        <div class="card-panel">  
          <div class="row">
            <div class="row">
              <div class="col s12">
                <h5><?php echo @$details->FirstName.' '.@$details->LastName ;?></h5>
              </div>
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box scrollbar" id="candidate_ul">
                    <li class="tab"><a class="active" href="#basicdetails" title="Basic Details">Basic Details</a></li>
                    <li class="tab"><a class="active" href="#otherdetails" title="Other Details">Other Details</a></li>
                    <?php if(@$details->RegistrationType == 'Regular'){?>
                    <li class="tab"><a class="tabclick" href="#change_password" title="Change Password">Change Password</a></li>
                    <?php }?>
                    <li class="tab"><a class="tabclick skilltab" href="#skill" title="Skill">Skill</a></li>
                    <li class="tab"><a class="tabclick employmenttab" href="#employment" title="Employment">Employment</a></li>
                    <li class="tab"><a class="tabclick projecttab" href="#project" title="Project">Project</a></li>
                    <li class="tab"><a class="tabclick qualificationtab" href="#qualification" title="Education">Education</a></li>
                    <li class="tab"><a class="tabclick certificatetab" href="#certificate" title="Certificate">Certificate</a></li>
                    <li class="tab"><a class="tabclick languagetab" href="#language" title="Language">Language</a></li>
                    <li class="tab"><a class="tabclick appliedjobs" href="#applied_job" title="Applied Jobs">Applied Jobs</a></li>
                    <li class="tab"><a class="tabclick savedjobs" href="#saved_job" title="Saved Jobs">Saved Job</a></li>
                    <li class="tab"><a class="tabclick followcompany" href="#follow_company" title="Following">Following</a></li>
                    <li class="tab"><a class="tabclick directinteview" href="#direct_inteview" title="Direct Interview">Direct Interview</a></li>
                    <li class="tab"><a class="tabclick jobpostinteview" href="#jobpost_inteview" title="Jobpost Interview">Jobpost Interview</a></li>
                  </ul>
                </div>
              </div>
              <!-- Basic Details Start -->
              <div id="basicdetails" class="col s12">
                <div class="col s12 m12 l12">
                <form class="col s12" id="editbasicForm" method="post">
                  <input type="hidden" name="cUserID" id = "cUserID" value="<?php echo @$details->UserID;?>">
                  <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                    <li class="active">
                      <div class="" style="">
                        <div class="padding15 clearfix">
                          <div class="input-field col s6">
                            
                            <input id="FirstName" name="FirstName" type="text" value="<?php echo @$details->FirstName; ?>"  readonly/>
                            <label class="active" for="FirstName"><?php echo label('msg_lbl_firstname')?></label>
                          </div>
                          <div class="input-field col s6">
                            
                            <input id="LastName" name="LastName" type="text" readonly="" value="<?php echo @$details->LastName; ?>"  />
                            <label class="active" for="LastName"><?php echo label('msg_lbl_lastname')?></label>
                          </div>
                          <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->EmailID?>" readonly>
                              <label class="active">Email Id</label>
                          </div>
                          <div class="input-field col s12 m6">
                            
                            <input id="MobileNo" name="MobileNo" type="text" readonly="" value="<?php echo @$details->MobileNo; ?>"  />
                            <label class="active" for="MobileNo"><?php echo label('msg_lbl_cellphone')?></label>
                          </div>
                          <div class="input-field col s6">
                                <input id="City" name="City" type="text" readonly="" value="<?php echo @$details->CityName; ?>"  />
                            <label class="active" for="City"><?php echo label('msg_lbl_city')?></label>
                          </div>
                          <div class="input-field col s6">
                              <input id="IsExperience" name="IsExperience" type="text" readonly="" value="<?php echo @$details->IsExperience; ?>"  />
                                <label class="active" for="IsExperience"><?php echo label('msg_lbl_isexperience')?></label>
                          </div>
                          <div id="IfExperience"  class="clearfix <?php if (isset($details->IsExperience) && $details->IsExperience == FRESHER){ echo "hide";  }?>">
                            <div class="input-field col s6" >
                          
                                <input id="Experience_id" name="Experience_id" type="text"  value="<?php if(@$details->Experience != 0 && @$details->Experience != -1){echo @$details->Experience;} ?>" readonly/>
                                <label class="active" for="Experience_id"><?php echo label('msg_lbl_experience')?></label>
                            </div>
                            <div class="input-field col s6" >
                                 
                                <input id="Salary" name="Salary" type="text" value="<?php echo @$details->Salary; ?>"  readonly/>
                                <label class="active" for="Salary"><?php echo label('msg_lbl_salary'). "(". $config[0]->CurrencyCode.")"?></label>
                            </div>
                          </div>
                          <div class="input-field col s6">
                            <textarea name="StatusText" id="StatusText" class="materialize-textarea " readonly=""><?=@$details->StatusText?></textarea>
                            <label for="StatusText"><?php echo label('msg_lbl_tagline')?></label>
                          </div>
                          <div class="input-field col s6">
                            <textarea name="ProfileStatus" id="ProfileStatus" class="materialize-textarea " readonly=""><?=@$details->ProfileStatus?></textarea>
                            <label for="ProfileStatus"><?php echo label('msg_lbl_profile_status')?></label>
                          </div>
                          <div class="input-field col s6" >
                                 
                                <input id="RegistrationType" name="RegistrationType" type="text" value="<?php echo @$details->RegistrationType; ?>"  readonly
                                />
                                <label class="active" for="RegistrationType"><?php echo label('msg_lbl_registrationtype')?></label>
                          </div>
                          <?php if(@$details->RegistrationType != 'Regular' && @$details->RegistrationType != ""){
                            if(@$details->RegistrationType == 'Facebook'){
                              $label = label('msg_lbl_facebook');
                              $value = @$details->FacebookID;
                            }
                            if(@$details->RegistrationType == 'Google'){
                              $label = label('msg_lbl_google');
                              $value = @$details->GooglePlusID;
                            }
                            if(@$details->RegistrationType == 'LinkedIn'){
                              $label = label('msg_lbl_linkedin');
                              $value = @$details->LinkedInID;
                            }
                            if(@$details->RegistrationType == 'Twitter'){
                              $label = label('msg_lbl_twitter');
                              $value = @$details->TwitterID;
                            }
                            if(@$details->RegistrationType == 'Pinterest'){
                              $label = label('msg_lbl_pinterest');
                              $value = @$details->PinterestID;
                            }

                          ?>
                          <div class="input-field col s6" >
                              <input id="" name="" type="text" value="<?php echo @$value; ?>" readonly/>
                              <label class="active" for="Salary"><?php echo @$label;?></label>
                            </div>
                          <?php }?>
                          <div class="input-field col s6" >
                                <input id="JobType" name="JobType" type="text" value="<?php echo @$details->JobType; ?>"  readonly
                                />
                                <label class="active" for="JobType"><?php echo label('msg_lbl_jobtype')?></label>
                          </div>

                        </div>
                      </div>
                    </li>
                  </ul>
                  </form>
                </div>
              </div>
              <!-- Basic Details End -->

              <!-- Other Details Start -->
              <div id="otherdetails" class="col s12">
                <div class="col s12 m12 l12">
                  <form class="col s12" id="editotherForm" method="post">
                    <input type="hidden" name="cUserID" value="<?php echo @$details->UserID;?>">
                    <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                      <li class="active">
                        <div>
                          <div class="padding15 clearfix">
                            <div class="input-field col s6">
                              <!-- <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_pincode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a> -->
                              <input id="Pincode" name="Pincode" type="text" class="empty_validation_class NumberOnly" value="<?php echo @$details->Pincode; ?>"  maxlength="6" readonly/>
                              <label class="active" for="Pincode"><?php echo label('msg_lbl_pincode')?></label>
                          </div>
                          <div class="input-field col s6">
                               <!-- <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_select_dob');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a> -->
                              <input type="text" name="Year" id="Year" value="<?php echo  @$details->BirthYear; ?>" readonly>
                              <label for="Year" class="active">Birth Year</label>
                          </div>
                          <div class="input-field col s6">
                            <input id="IsPhysicalChallenged" name="IsPhysicalChallenged" type="text" class="empty_validation_class " value =" <?php if ($details->IsPhysicalChallenged == 1) {
                              echo "Yes";
                            }else{
                              echo "No";
                            }
                            ?>" readonly/>
                            <label for="IsPhysicalChallenged">Physically Challenged</label>     
                          </div>
                          <div class="input-field col s6">
                            <input id="IsWorkPermit" name="IsWorkPermit" type="text" class="empty_validation_class " value =" <?php if ($details->IsWorkPermit == 1) {
                              echo "Yes";
                            }else{
                              echo "No";
                            }
                            ?>"  maxlength="6" readonly/>
                            <label for="IsWorkPermit">Work Permit</label>     
                          </div>
                          <div class="input-field col s6">
                            <input id="Gender" name="Gender" type="text" class="empty_validation_class " value="<?php echo @$details->Gender; ?>"  maxlength="6" readonly/>
                            <label for="Gender"><?php echo label('msg_lbl_gender');?></label>
                          </div>
                          <div class="input-field col s6">
                            <input id="EthnicityName" name="EthnicityName" type="text" class="empty_validation_class " value="<?php echo @$details->EthnicityName; ?>"  maxlength="6" readonly/>
                            <label for="EthnicityName"><?php echo label('msg_lbl_ethnicity');?></label>
                          </div>
                          <div class="input-field col s6">
                            <input id="VisaStatus" name="VisaStatus" type="text" class="empty_validation_class " value="<?php echo @$details->VisaStatus; ?>"  maxlength="6" readonly/>
                            <label for="VisaStatus"><?php echo label('msg_lbl_visastatus');?></label>
                          </div>
                          <?php 
                          if(@$details->Gender == OTHER){
                          ?>
                          <div class="input-field col s6">
                            <input id="OtherGender" name="OtherGender" type="text" class="empty_validation_class " value="<?php echo @$details->OtherGender; ?>"  maxlength="6" readonly/>
                            <label for="OtherGender"><?php echo label('msg_lbl_othergender');?></label>
                          </div>                          
                          <?php } ?>
                          <div class="input-field col s12">
                              <textarea name="Address" id="Address" maxlength="500" class="materialize-textarea empty_validation_class" readonly><?=@$details->Address?></textarea>
                              <label for="Address"><?php echo label('msg_lbl_address')?></label>
                          </div>
                            
                          <div class="input-field col s12 m-b-10 m-t-0">
                               <!--  <button class="btn waves-effect waves-light right" id="other_details_button" type="button">Submit
                                </button> -->
                               <br>
                               <br>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </form>
                </div>
              </div>
              <!-- Other Details End -->

              <?php if(@$details->RegistrationType == 'Regular'){?>
              <!-- Change Password Start -->
              <div id="change_password" class="col s12">
                <div class="col s12 m12 l12">
                    <form>
                      <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                        <div class="padding15 clearfix">
                          <div class="input-field col s12 m6">
                              <input type="password" name="new_password" id="new_password" maxlength="100">
                              <label class="active">New Password</label>
                          </div>
                          <div class="input-field col s12 m6">
                              <input type="password" name="confirm_password" id="confirm_password" maxlength="100">
                              <label class="active">Confirm Password</label>
                          </div>
                          <div class="input-field col s12 m-b-10 m-t-0">
                              <button class="btn waves-effect waves-light right" id="change_password_button" type="button">Submit
                                
                              </button>
                             <br>
                             <br>

                          </div>
                        </div>
                      </ul>
                    </form>
                </div>
              </div>
              <!-- Change Password End -->
              <?php }?>
              <!-- Applied jobs Start -->
              <div id="applied_job" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                         <!--  <div class="col m6 s12 center m-t-20">
                            <span><label>Data Display :</label></span> &nbsp;&nbsp;
                            <input name="data_displayup" type="radio" id="Allup" value="All" checked="checked" class="changeFilter" data-div="applied_job">
                            <label for="Allup">All</label>
                            <input name="data_displayup" type="radio" id="Filterup" value="Filter" class="changeFilter" data-div="applied_job">
                            <label for="Filterup">Filter</label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">                  
                            <div class="right">
                              <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="applied_job" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                              
                            </div>
                          </div> -->
                        </div>
                      </div>
                      <!-- <div class="col s12">
                        <div class="search_action card-panel" style="display:none;">                                
                          <h4 class="header m-b-0"><strong> Search</strong></h4>
                          <div class="row m-b-0">
                            <div class="row">
                              <div class="input-field col s12 m6">
                                  <?= @$designation;?>
                              </div>
                            </div>
                          </div>
                          <div class="search_action_button" style="padding-bottom:15px;">
                            <button class="btn waves-effect waves-light right" type="button" id="appliedjobs_submit" name="appliedjobs_submit">Submit</button>
                            <a href="javascript:;" class="clear-all right" data-div="applied_job">Clear</a> 
                          </div>
                        </div>
                      </div> -->
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_180"><?php echo label('msg_lbl_jobtitle');?></th>
                            <th class="width_180"><?php echo label('msg_lbl_company');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_designation');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_industrytype');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_experience');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_natureofemployment');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_salary') . "(". $config[0]->CurrencyCode.")";?></th>
                            <th class="width_100"><?php echo label('msg_lbl_title_skill');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_websiteurl')?></th>
                            <th class="width_100"><?php echo label('msg_lbl_cellphone')?></th>
                            <th class="width_60"><?php echo label('msg_lbl_jobstatus')?></th>
                            <th class="width_60"><?php echo label('msg_lbl_noofvacancies');?></th>
                            <th class="width_60"><?php echo label('msg_lbl_view');?></th>
                            <th class="width_60"><?php echo label('msg_lbl_applied');?></th>
                            <th class="width_60"><?php echo label('msg_lbl_interview');?></th>
                            <th class="width_60"><?php echo label('msg_lbl_shortlist');?></th>
                          </tr>
                        </thead>
                          <tbody id="appliedjobs_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="appliedjobs_table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- Applied jobs End -->
             
              <!-- Saved jobs Start -->
              <div id="saved_job" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected="">10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                         <!--  <div class="col m6 s12 center m-t-20">
                            <span><label>Data Display :</label></span> &nbsp;&nbsp;
                            <input name="saveddata_displayup" type="radio" id="saveAll" value="All" checked="checked" class="changeFilter" data-div="saved_job">
                            <label for="saveAll">All</label>
                            <input name="saveddata_displayup" type="radio" id="saveFilter" value="Filter" class="changeFilter" data-div="saved_job">
                            <label for="saveFilter">Filter</label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">                  
                            <div class="right">
                              <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="saved_job" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                              
                            </div>
                          </div> -->
                        </div>
                      </div>
                      <!-- <div class="col s12">
                        <div class="search_action card-panel" style="display:none;">                                
                          <h4 class="header m-b-0"><strong> Search</strong></h4>
                          <div class="row m-b-0">
                            <div class="row">
                              <div class="input-field col s12 m6">
                                 <?= @$designation;?>
                              </div>
                            </div>
                          </div>
                          <div class="search_action_button" style="padding-bottom:15px;">
                            <button class="btn waves-effect waves-light right" type="button" id="savedjobs_submit" name="savedjobs_submit">Submit</button>
                            <a href="javascript:;" class="clear-all right" data-div="saved_job">Clear</a> 
                          </div>
                        </div>
                      </div> -->
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th class="width_180"><?php echo label('msg_lbl_jobtitle');?></th>
                              <th class="width_180"><?php echo label('msg_lbl_company');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_designation');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_industrytype');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_experience');?></th>
                              <th class="width_150"><?php echo label('msg_lbl_natureofemployment');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_salary') . "(". $config[0]->CurrencyCode.")";?></th>
                              <th class="width_100"><?php echo label('msg_lbl_title_skill');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_websiteurl')?></th>
                              <th class="width_100"><?php echo label('msg_lbl_cellphone')?></th>
                              <th class="width_60"><?php echo label('msg_lbl_jobstatus')?></th>
                              <th class="width_60"><?php echo label('msg_lbl_noofvacancies');?></th>
                              <th class="width_60"><?php echo label('msg_lbl_view');?></th>
                              <th class="width_60"><?php echo label('msg_lbl_applied');?></th>
                              <th class="width_60"><?php echo label('msg_lbl_interview');?></th>
                              <th class="width_60"><?php echo label('msg_lbl_shortlist');?></th>
                             
                          </tr>
                        </thead>
                          <tbody id="savedjobs_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="savedjobs_table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- saved jobs End -->

              <!-- Follow company Start -->
              <div id="follow_company" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected="">10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="image-box-th width_100"><?php echo label('msg_lbl_image');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_company');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_name');?></th>
                            <th class="width_300"><?php echo label('msg_lbl_email');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_cellphone');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_designation');?></th>
                            <th class="width_250"><?php echo label('msg_lbl_websiteurl');?></th>
                            <th class="width_250"><?php echo label('msg_lbl_address');?></th>
                          </tr>
                        </thead>
                          <tbody id="followjobs_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="followjobs_table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- Follow company End -->

              <!-- Skill Start -->
              <div id="skill" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                               <div class="input-field col m2 s12">
                                    <select id="select-dropdown">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                 
                                <div class="col s12 m10 right-align list-page-right-top-icon">
                                    
                                    <?php if(@$this->cur_module->is_insert == 1){?>
                                    <a href="<?php echo base_url("admin/masters/candidate/addskill/".$details->UserID);?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_skill')?></th>
                            
                              <th class="actions center"><?php echo label('msg_lbl_status');?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action');?></th>                    
                          </tr>
                        </thead>
                          <tbody id="skill_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="skill_table_paging_div"></div>
                  </div>
                  
                </div>
              </div>
              <!-- Skill End -->

              <!-- Employment Start -->
              <div id="employment" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                               <div class="input-field col m2 s12">
                                    <select id="select-dropdown">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                 
                                <div class="col s12 m10 right-align list-page-right-top-icon">
                                    
                                    <?php if(@$this->cur_module->is_insert == 1){?>
                                    <a href="<?php echo base_url("admin/masters/candidate/addemployment/".$details->UserID);?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_organization')?></th>
                              <th><?php echo label('msg_lbl_designation')?></th>
                              <th><?php echo label('msg_lbl_location')?></th>
                              <th><?php echo label('msg_lbl_responsibilities')?></th>
                              <th><?php echo label('msg_lbl_ispresent')?></th>
                              <th><?php echo label('msg_lbl_startdate')?></th>
                              <th><?php echo label('msg_lbl_enddate')?></th>
                              <th class="actions center"><?php echo label('msg_lbl_status');?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action');?></th>                    
                          </tr>
                        </thead>
                          <tbody id="employment_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="employment_table_paging_div"></div>
                  </div>
                  
                </div>
              </div>
              <!-- Employment End -->

              <!-- Project Start -->
              <div id="project" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                               <div class="input-field col m2 s12">
                                    <select id="select-dropdown">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                 
                                <div class="col s12 m10 right-align list-page-right-top-icon">
                                    
                                    <?php if(@$this->cur_module->is_insert == 1){?>
                                    <a href="<?php echo base_url("admin/masters/candidate/addproject/".$details->UserID);?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive vertical-align-top">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_projecttitle')?></th>
                              <th><?php echo label('msg_lbl_projectdetails')?></th>
                              <th><?php echo label('msg_lbl_employer')?></th>
<!--                               <th><?php //echo label('msg_lbl_teamsize')?></th>
 -->                          <th><?php echo label('msg_lbl_achievements')?></th>
                             <!--  <th><?php //echo label('msg_lbl_startedfrom')?></th>
                              <th><?php //echo label('msg_lbl_workedtill')?></th>
                              <th><?php //echo label('msg_lbl_natureofemployment')?></th>
                              <th><?php //echo label('msg_lbl_designation')?></th>
                              <th><?php //echo label('msg_lbl_designationdescription')?></th> -->
                             <th class="actions center"><?php echo label('msg_lbl_status');?></th>
                            <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                              
                          </tr>
                        </thead>
                          <tbody id="project_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="project_table_paging_div"></div>
                  </div>
                  
                </div>
              </div>
              <!-- Project End -->

              <!-- Certificate Start -->
              <div id="certificate" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                               <div class="input-field col m2 s12">
                                    <select id="select-dropdown">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                 
                                <div class="col s12 m10 right-align list-page-right-top-icon">
                                    
                                    <?php if(@$this->cur_module->is_insert == 1){?>
                                    <a href="<?php echo base_url("admin/masters/candidate/addcertificate/".$details->UserID);?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_certificatename')?></th>
                              <th><?php echo label('msg_lbl_year')?></th>
                              <th class="actions center"><?php echo label('msg_lbl_status');?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                          </tr>
                        </thead>
                          <tbody id="certificate_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="certificate_table_paging_div"></div>
                  </div>
                  
                </div>
              </div>
              <!-- Certificate End -->

              <!-- Language Start -->
              <div id="language" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                               <div class="input-field col m2 s12">
                                    <select id="select-dropdown">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                 
                                <div class="col s12 m10 right-align list-page-right-top-icon">
                                    
                                    <?php if(@$this->cur_module->is_insert == 1){?>
                                    <a href="<?php echo base_url("admin/masters/candidate/addlanguage/".$details->UserID);?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_language')?></th>
                              <th><?php echo label('Proficiency')?></th>
                              <!-- <th><?php echo label('msg_lbl_iswrite')?></th>
                              <th><?php echo label('msg_lbl_isspeak')?></th> -->
                              <th class="actions center"><?php echo label('msg_lbl_status');?></th>
                <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                              
                          </tr>
                        </thead>
                          <tbody id="language_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="language_table_paging_div"></div>
                  </div>
                  
                </div>
              </div>
              <!-- Language End -->

               <!-- Education Start -->
              <div id="qualification" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                               <div class="input-field col m2 s12">
                                    <select id="select-dropdown">
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                 
                                <div class="col s12 m10 right-align list-page-right-top-icon">
                                    
                                    <?php if(@$this->cur_module->is_insert == 1){?>
                                    <a href="<?php echo base_url("admin/masters/candidate/addqualification/".$details->UserID);?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_qualification'); ?></th>
                              <th><?php echo label('msg_lbl_university'); ?></th>
                              <th><?php echo label('msg_lbl_course'); ?></th>
                              <th><?php echo label('msg_lbl_yearofpassing'); ?></th>
                              <th><?php echo label('msg_lbl_grade');?></th>
                              <th><?php echo "OtherGrade"; ?></th>
                              <th class="actions center"><?php echo label('msg_lbl_status');?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                              
                          </tr>
                        </thead>
                          <tbody id="qualification_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="qualification_table_paging_div"></div>
                  </div>
                  
                </div>
              </div>
              <!-- Education End -->

              <!-- Direct Interview Start -->
              <div id="direct_inteview" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected="">10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col m6 s12 center m-t-20">
                            <input name="direct_Action" type="radio" id="direct_invited" value="Invited" checked="checked" class="interview_radio">
                            <label for="direct_invited">Invited</label>
                            <input name="direct_Action" type="radio" id="direct_accepted" value="Accept" class="interview_radio">
                            <label for="direct_accepted">Accepted</label>
                            <input name="direct_Action" type="radio" id="direct_rejected" value="Reject" class="interview_radio">
                            <label for="direct_rejected">Declined</label>
                          </div> 
                        </div>  
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th class="image-box-th width_100"><?php echo label('msg_lbl_image');?></th>
                              <th class="width_150"><?php echo label('msg_lbl_company');?></th>
                              <th class="width_150"><?php echo label('msg_lbl_name');?></th>
                              <th class="width_300"><?php echo label('msg_lbl_email');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_cellphone');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_designation');?></th>
                              <th class="width_250"><?php echo label('msg_lbl_websiteurl');?></th>
                              <th class="width_250"><?php echo label('msg_lbl_address');?></th>
                              <th><?php echo label('msg_lbl_status')?></th>
                              
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- Direct Interview End -->
              <!-- JobPost Interview Start -->
              <div id="jobpost_inteview" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown">
                              <option value="10" selected="">10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col m6 s12 center m-t-20">
                            <input name="jobpost_action" type="radio" id="interview_invited" value="Invited" checked="checked" class="interview_radio">
                            <label for="interview_invited">Invited</label>
                            <input name="jobpost_action" type="radio" id="interview_accepted" value="Accept" class="interview_radio">
                            <label for="interview_accepted">Accepted</label>
                            <input name="jobpost_action" type="radio" id="interview_rejected" value="Reject" class="interview_radio">
                            <label for="interview_rejected">Declined</label>
                          </div> 
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th class="width_180"><?php echo label('msg_lbl_jobtitle');?></th>
                              <th class="width_180"><?php echo label('msg_lbl_company');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_designation');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_industrytype');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_experience');?></th>
                              <th class="width_150"><?php echo label('msg_lbl_natureofemployment');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_salary') . "(". $config[0]->CurrencyCode.")";?></th>
                              <th class="width_100"><?php echo label('msg_lbl_title_skill');?></th>
                              <th class="width_100"><?php echo label('msg_lbl_websiteurl')?></th>
                              <th class="width_100"><?php echo label('msg_lbl_cellphone')?></th>
                              <th class="width_60"><?php echo label('msg_lbl_jobstatus')?></th>
                              <th class="width_60"><?php echo label('msg_lbl_noofvacancies');?></th>
                              <th class="width_60"><?php echo label('msg_lbl_view');?></th>
                              <th class="width_60"><?php echo label('msg_lbl_applied');?></th>
                              <th class="width_60"><?php echo label('msg_lbl_interview');?></th>
                              <th class="width_60"><?php echo label('msg_lbl_shortlist');?></th>
                          </tr>
                        </thead>
                          <tbody id="table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- JobPost Interview End -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div style="display:none;" class="cancel_popup modal-trigger" href="#modal-popup-box">Status</div> 
  <form id="cancelform">
        <div id="modal-popup-box" class="modal">
          <div class="modal-content">
            <h4 class="header">Cancel Booking Description</h4>
            <div class="input-field col s12">
                <textarea id="cancel_message" name="message" class="materialize-textarea"></textarea>
               <input type="hidden" id="c_orderstatus" name="c_orderstatus">
               <input type="hidden" id="c_order_id" name="c_order_id">
                <label for="message" class="">Message</label>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
            <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close cancel_msg_btn">Submit</a>
          </div>
        </div>  
    </form>
  <!--start container-->
  <!--end container-->
</section>
<!-- END CONTENT -->
<div style="display:none;" class="reject_popup modal-trigger" href="#modal-reject-box">Status</div> 
    <form id="rejectform">
        <div id="modal-reject-box" class="modal">
          <div class="modal-content">
            <h4 class="header">Cancel Leave Request Reason</h4>
            <div class="input-field col s12">
                <textarea id="reject_message" class="materialize-textarea"></textarea>
                <input type="hidden" id="NLeaveStatus" name="LeaveStatus">
                <input type="hidden" id="LeaveRequestID" name="LeaveRequestID">
                <label for="reject_message" class="">Message</label>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close reject_cancel_msg_btn">Close</a>
            <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close reject_msg_btn">Submit</a>
          </div>
        </div>  
    </form>
    <?php echo @$view_modal_popup; ?>