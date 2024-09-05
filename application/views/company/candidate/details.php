<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls ">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("company/candidate"); ?>"><?php echo label('msg_lbl_title_candidate')?></a></h5>
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
                    <li class="tab"><a class="tabclick skilltab" href="#skill" title="Skill">Skill</a></li>
                    <li class="tab"><a class="tabclick employmenttab" href="#employment" title="Employment">Employment</a></li>
                    <li class="tab"><a class="tabclick projecttab" href="#project" title="Project">Project</a></li>
                    <li class="tab"><a class="tabclick qualificationtab" href="#qualification" title="Education">Education</a></li>
                    <li class="tab"><a class="tabclick certificatetab" href="#certificate" title="Certificate">Certificate</a></li>
                    <li class="tab"><a class="tabclick languagetab" href="#language" title="Language">Language</a></li>
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
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_skill')?></th>
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
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_organization')?></th>
                              <th><?php echo label('msg_lbl_designation')?></th>
                              <th><?php echo label('msg_lbl_ispresent')?></th>
                              <th><?php echo label('msg_lbl_startdate')?></th>
                              <th><?php echo label('msg_lbl_enddate')?></th>
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
                                 
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive vertical-align-top">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_projecttitle')?></th>
                              <th><?php echo label('msg_lbl_projectdescription')?></th>
                              <th><?php echo label('msg_lbl_client')?></th>
                              <th><?php echo label('msg_lbl_teamsize')?></th>
                              <th><?php echo label('msg_lbl_projectsite')?></th>
                              <th><?php echo label('msg_lbl_startedfrom')?></th>
                              <th><?php echo label('msg_lbl_workedtill')?></th>
                              <th><?php echo label('msg_lbl_natureofemployment')?></th>
                              <th><?php echo label('msg_lbl_designation')?></th>
                              <th><?php echo label('msg_lbl_designationdescription')?></th>
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
                                 
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_description')?></th>
                              <th><?php echo label('msg_lbl_year')?></th>
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
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_qualification'); ?></th>
                              <th><?php echo label('msg_lbl_yearofpassing'); ?></th>
                              <th><?php echo label('msg_lbl_university'); ?></th>
                              <th><?php echo label('msg_lbl_grade');?></th>
                              <th><?php echo "OtherGrade"; ?></th>
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

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <?php echo @$view_modal_popup; ?>