<?php //pr($details);exit;?>
<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("company/jobpost"); ?>"><?php echo label('msg_lbl_title_candidate')?></a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
<!--start container-->
  <div class="container">
    <div class="section">
      <div class="list-page-right" id="jobpost-details-box">
        <div class="card-panel">  
          <div class="row">
            <div class="row">
             <form method="post">
                <input id="CompanyID" name="CompanyID" value="<?php echo @$details->CompanyID; ?>" type="hidden"/>
                <div class="col s12">
                  <div class="col s12">
                    <ul class="tabs jobpost-details-tab-box">
                     
                      <li class="tab col s6 m3"><a class="tabclick" data-div="allcandidate" data-type = "All" href="#allcandidate" title="All Candidate">All Candidate</a></li>

                      <li class="tab col s6 m3"><a class="tabclick" data-div="directinterview" data-type = "DirectInvited" href="#directinterview" title="Direct Interview">Direct Interview</a></li>

                      <li class="tab col s6 m3"><a class="tabclick" data-div="hired" data-type = "Hired" href="#hired" title="Hired">Hired</a></li>

                      <li class="tab col s6 m3"><a class="tabclick" data-div="decline" data-type = "HiredDecline" href="#decline" title="Decline">Decline</a></li>

                    </ul>
                  </div>
                </div>
                

                <!-- All Candidate Start -->
              <div id="allcandidate" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown" class="select-dropdown" data-div="allcandidate" data-type="All">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col m6 s12 center m-t-20">
                              <span><label><?php echo label('msg_lbl_data_display');?> :</label></span> &nbsp;&nbsp;
                              <input name="data_display_Candidate" type="radio" id="All_Candidate" value="All" data-div="allcandidate" class="changeFilter" checked="checked">
                              <label for="All_Candidate"><?php echo label('msg_lbl_all');?></label>
                              <input name="data_display_Candidate" type="radio" id="Filter_Candidate" value="Filter" data-div="allcandidate" class="changeFilter">
                              <label for="Filter_Candidate"><?php echo label('msg_lbl_filter');?></label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">
                              <a class="btn-floating waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="allcandidate" data-type = "All" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="col s12">
                        <div class="search_action card-panel" style="display:none;">                                
                          <h4 class="header"><strong> <?php echo label('msg_lbl_search_value');?> </strong></h4>
                          <div class="row m-b-0">
                              <div class="input-field col s12 m6">
                               <input type="text" name="Skills" id="Skills" maxlength="100" class="form-control LetterOnly">
                               <label name="Skills" class=""><?php echo label('msg_lbl_title_skill');?></label>
                              </div>
                                <div class="input-field col s12 m6">
                                    <?php 
                                    echo @$Designation;
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="input-field col s12 m6">
                                    <?php 
                                    echo @$Location;
                                    ?>
                                </div>
                            </div>
                          <button class="btn waves-effect waves-light right button_submit" type="button" data-div="allcandidate" data-type="All"><?php echo label('msg_lbl_submit');?>
                          </button>
                          &nbsp;&nbsp;&nbsp;
                          <a href="javascript:;" class="clear-all right" data-div="allcandidate" data-type="All" ><?php echo label('msg_lbl_clear_all');?>
                          </a> 
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_100"><?php echo label('msg_lbl_image');?></th>
                            <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name" data-div="allcandidate" data-type = "All">
                                    <?php echo label('msg_lbl_name');?>
                                <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                <i class="mdi-hardware-keyboard-arrow-up up "></i> 
                                </span>
                            </th>
                            <th class="width_250"><?php echo label('msg_lbl_email');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_cellphone');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_city');?></th>
                            <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary" data-div="allcandidate" data-type = "All">
                                    <?php echo label('msg_lbl_salary'). " (". @$config[0]->CurrencyCode.")";?>
                                <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                            </th>

                            <th class="width_80"><?php echo label('msg_lbl_gender');?></th>
                            <th class="width_80"><?php echo label('msg_lbl_skill');?></th>
                            <th class="width_80"><?php echo label('msg_lbl_designation');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_isexperience');?></th>
                            <th><?php echo label('msg_lbl_cv');?></th>
                            <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div" class="table_paging_div" data-div="allcandidate" data-type = "All"></div>
                  </div>
                </div>
              </div>    
              <!-- All Candidate End -->

              <!-- Direct Interview Job -->
              <div id="directinterview" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown" class="select-dropdown" data-div="directinterview" data-type = "DirectInvited">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col m6 s12 center m-t-20">
                              <span><label><?php echo label('msg_lbl_data_display');?> :</label></span> &nbsp;&nbsp;
                              <input name="data_display_Direct" type="radio" id="All_Direct" value="All" class="changeFilter" checked="checked" data-div="directinterview" >
                              <label for="All_Direct"><?php echo label('msg_lbl_all');?></label>
                              <input name="data_display_Direct" type="radio" id="Filter_Direct" value="Filter" class="changeFilter" data-div="directinterview" >
                              <label for="Filter_Direct"><?php echo label('msg_lbl_filter');?></label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">
                              <a class="btn-floating waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="directinterview" data-type = "DirectInvited" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="col s12">
                        <div class="search_action card-panel" style="display:none;">                                
                          <h4 class="header"><strong> <?php echo label('msg_lbl_search_value');?> </strong></h4>
                          <div class="row m-b-0">
                              <div class="input-field col s12 m6">
                               <input type="text" name="Skills" id="Skills" maxlength="100" class="form-control LetterOnly">
                               <label name="Skills" class=""><?php echo label('msg_lbl_title_skill');?></label>
                              </div>
                              <div class="input-field col s12 m6">
                                  <?php 
                                  echo @$Designation;
                                  ?>
                              </div>
                              <div class="clearfix"></div>
                              <div class="input-field col s12 m6">
                                  <?php 
                                  echo @$Location;
                                  ?>
                              </div>
                              <div class="input-field search_label_radio col s12 m6">
                                <input name="InterviewType" type="radio" id="Invited" value="Invited" checked="checked">
                                <label for="Invited"><?php echo label('msg_lbl_invited');?></label>
                                <input name="InterviewType" type="radio" id="Accepted" value="Accept">
                                <label for="Accepted"><?php echo label('msg_lbl_accept');?></label> 
                                <input name="InterviewType" type="radio" id="Decline" value="Decline">
                                <label for="Decline"><?php echo label('msg_lbl_decline');?></label>
                              </div>
                          </div>
                          <button class="btn waves-effect waves-light right button_submit" type="button" data-div="directinterview" data-type = "DirectInvited"><?php echo label('msg_lbl_submit');?>
                          </button>
                          &nbsp;&nbsp;&nbsp;
                          <a href="javascript:;" class="clear-all right" data-div="directinterview" data-type = "DirectInvited" ><?php echo label('msg_lbl_clear_all');?>
                          </a> 
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_100"><?php echo label('msg_lbl_image');?></th>
                            <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name" data-div="directinterview" data-type = "DirectInvited" >
                                    <?php echo label('msg_lbl_name');?>
                                <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                <i class="mdi-hardware-keyboard-arrow-up up "></i> 
                                </span>
                            </th>
                            <th class="width_250"><?php echo label('msg_lbl_email');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_cellphone');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_city');?></th>
                            <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary" data-div="directinterview" data-type = "DirectInvited" >
                                    <?php echo label('msg_lbl_salary'). " (". @$config[0]->CurrencyCode.")";?>
                                <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                            </th>

                            <th class="width_80"><?php echo label('msg_lbl_gender');?></th>
                            <th class="width_80"><?php echo label('msg_lbl_skill');?></th>
                            <th class="width_80"><?php echo label('msg_lbl_designation');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_isexperience');?></th>
                            <th><?php echo label('msg_lbl_cv');?></th>
                            <th><?php echo label('msg_lbl_datetime');?></th>
                            <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div" class="table_paging_div" data-div="all_job" data-type = "All"></div>
                  </div>
                </div>
              </div>
              <!-- Direct Interview Job -->

              <!--Hired Start-->
              <div id="hired" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown" class="select-dropdown" data-div="hired" data-type = "Hired">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col m6 s12 center m-t-20">
                              <span><label><?php echo label('msg_lbl_data_display');?> :</label></span> &nbsp;&nbsp;
                              <input name="data_display_Hired" type="radio" id="All_Hired" value="All" class="changeFilter" checked="checked" data-div="hired" >
                              <label for="All_Hired"><?php echo label('msg_lbl_all');?></label>
                              <input name="data_display_Hired" type="radio" id="Filter_Hired" value="Filter" class="changeFilter" data-div="hired" >
                              <label for="Filter_Hired"><?php echo label('msg_lbl_filter');?></label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">
                              <a class="btn-floating waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="hired" data-type = "Hired" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="col s12">
                        <div class="search_action card-panel" style="display:none;">                                
                          <h4 class="header"><strong> <?php echo label('msg_lbl_search_value');?> </strong></h4>
                          <div class="row m-b-0">
                              <div class="input-field col s12 m6">
                               <input type="text" name="Skills" id="Skills" maxlength="100" class="form-control LetterOnly">
                               <label name="Skills" class=""><?php echo label('msg_lbl_title_skill');?></label>
                              </div>
                              <div class="input-field col s12 m6">
                                  <?php 
                                  echo @$Designation;
                                  ?>
                              </div>
                              <div class="clearfix"></div>
                              <div class="input-field col s12 m6">
                                  <?php 
                                  echo @$Location;
                                  ?>
                              </div>
                              
                          </div>
                          <button class="btn waves-effect waves-light right button_submit" type="button" data-div="hired" data-type = "Hired" ><?php echo label('msg_lbl_submit');?>
                          </button>
                          &nbsp;&nbsp;&nbsp;
                          <a href="javascript:;" class="clear-all right" data-div="hired" data-type = "Hired" ><?php echo label('msg_lbl_clear_all');?>
                          </a> 
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_100"><?php echo label('msg_lbl_image');?></th>
                            <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name" data-div="hired" data-type = "Hired" >
                                    <?php echo label('msg_lbl_name');?>
                                <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                <i class="mdi-hardware-keyboard-arrow-up up "></i> 
                                </span>
                            </th>
                            <th class="width_250"><?php echo label('msg_lbl_email');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_cellphone');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_city');?></th>
                            <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary" data-div="hired" data-type = "Hired" >
                                    <?php echo label('msg_lbl_salary'). " (". @$config[0]->CurrencyCode.")";?>
                                <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                            </th>

                            <th class="width_80"><?php echo label('msg_lbl_gender');?></th>
                            <th class="width_80"><?php echo label('msg_lbl_skill');?></th>
                            <th class="width_80"><?php echo label('msg_lbl_designation');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_isexperience');?></th>
                            <th><?php echo label('msg_lbl_cv');?></th>
                            <th class="actions center"><?php echo label('msg_lbl_hiredfor');?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div" class="table_paging_div" data-div="hired" data-type="Hired"></div>
                  </div>
                </div>
              </div>    
              <!--Hired End--> 

              <!--decline Start-->
              <div id="decline" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown" class="select-dropdown" data-div="decline" data-type = "HiredDecline">
                              <option value="10" selected>10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                          <div class="col m6 s12 center m-t-20">
                              <span><label><?php echo label('msg_lbl_data_display');?> :</label></span> &nbsp;&nbsp;
                              <input name="data_display_Decline" type="radio" id="All_Decline" value="All" class="changeFilter" checked="checked" data-div="decline" >
                              <label for="All_Decline"><?php echo label('msg_lbl_all');?></label>
                              <input name="data_display_Decline" type="radio" id="Filter_Decline" value="Filter" class="changeFilter" data-div="decline" >
                              <label for="Filter_Decline"><?php echo label('msg_lbl_filter');?></label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">
                              <a class="btn-floating waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="decline" data-type = "HiredDecline" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="col s12">
                        <div class="search_action card-panel" style="display:none;">                                
                          <h4 class="header"><strong> <?php echo label('msg_lbl_search_value');?> </strong></h4>
                          <div class="row m-b-0">
                              <div class="input-field col s12 m6">
                               <input type="text" name="Skills" id="Skills" maxlength="100" class="form-control LetterOnly">
                               <label name="Skills" class=""><?php echo label('msg_lbl_title_skill');?></label>
                              </div>
                              <div class="input-field col s12 m6">
                                  <?php 
                                  echo @$Designation;
                                  ?>
                              </div>
                              <div class="clearfix"></div>
                              <div class="input-field col s12 m6">
                                  <?php 
                                  echo @$Location;
                                  ?>
                              </div>
                              
                          </div>
                          <button class="btn waves-effect waves-light right button_submit" type="button" data-div="decline" data-type = "HiredDecline" ><?php echo label('msg_lbl_submit');?>
                          </button>
                          &nbsp;&nbsp;&nbsp;
                          <a href="javascript:;" class="clear-all right" data-div="decline" data-type = "HiredDecline"><?php echo label('msg_lbl_clear_all');?>
                          </a> 
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="width_100"><?php echo label('msg_lbl_image');?></th>
                            <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name" data-div="decline" data-type = "HiredDecline" >
                                    <?php echo label('msg_lbl_name');?>
                                <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                <i class="mdi-hardware-keyboard-arrow-up up "></i> 
                                </span>
                            </th>
                            <th class="width_250"><?php echo label('msg_lbl_email');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_cellphone');?></th>
                            <th class="width_150"><?php echo label('msg_lbl_city');?></th>
                            <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary" data-div="decline" data-type = "HiredDecline" >
                                    <?php echo label('msg_lbl_salary'). " (". @$config[0]->CurrencyCode.")";?>
                                <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                            </th>

                            <th class="width_80"><?php echo label('msg_lbl_gender');?></th>
                            <th class="width_80"><?php echo label('msg_lbl_skill');?></th>
                            <th class="width_80"><?php echo label('msg_lbl_designation');?></th>
                            <th class="width_100"><?php echo label('msg_lbl_isexperience');?></th>
                            <th><?php echo label('msg_lbl_cv');?></th>
                            <th class="actions center"><?php echo label('msg_lbl_reason');?></th>
                          </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div" class="table_paging_div" data-div="decline" data-type = "HiredDecline"></div>
                  </div>
                </div>
              </div>    
              <!--decline End--> 

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END CONTENT -->
<!-- Start Modal Structure For Interview -->
<div class="admin-table-view-pop-up">
    <div id="interview_model" class="modal" style="max-height: 100%;min-height: 70%;">
        <div class="modal-footer gridhead1 bgglobal">                                                    
            <h4 id="model_title">Interview</h4>
            <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
        </div>
        <div class="modal-content">  
            <form>     
                <input type="hidden" id="CandidateID" name="CandidateID" />
                <input type="hidden" id="UserID" name="UserID" value="<?php echo $this->session->userdata['UserID'];?>" />
                <div class="col s12 m6 center m-t-20">
                    <input name="InterviewType" type="radio" id="Inte_Direct" value="Direct" checked="checked">
                    <label for="Inte_Direct">Direct</label>
                    <input name="InterviewType" type="radio" id="Inte_JobPost" value="JobPost">
                    <label for="Inte_JobPost">JobPost</label>
                </div>
                <div id="jobpost_div" class="col s12 m6 m-t-20 hide">
                    <?php echo @$JobPost?>
                </div>
                <div class="input-field col s6 m-t-20">
                    <input type="text" name="InterviewDate" id="InterviewDate" value="" class="datepickerval empty_validation_class">
                    <label for="InterviewDate">Date</label>
                </div>
                <div class="input-field col s6 m-t-20">
                     <label class="timeplabel" for="InterviewTime">Time</label>
                     <input id="InterviewTime" name="InterviewTime" class="timep empty_validation_class" value="" type="text">
                </div>
                <button class="btn waves-effect waves-light right" type="submit" id="inte_button_submit" name="inte_button_submit"><?php echo label('msg_lbl_submit');?></button>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Structure For Interview -->

<!-- Start Modal Structure For Reject -->
<div class="admin-table-view-pop-up">
    <div id="reject_model" class="modal" style="max-height: 100%;min-height: 70%;">
        <div class="modal-footer gridhead1 bgglobal">                                                    
            <h4 id="model_title">Reject</h4>
            <a class="waves-effect waves-green btn-flat modal-action modal-close" style="color:white">Close</a>
        </div>
        <div class="modal-content">  
            <form>     
                <input type="hidden" id="Action" name="Action" />
                <input type="hidden" id="CompanyJobActionID" name="CompanyJobActionID" />
                <input type="hidden" id="UserID" name="UserID" value="<?php echo $this->session->userdata['UserID'];?>" />
                <div id="reason_div" class="col s12 m6 m-t-20">
                    <?php echo @$Reason?>
                </div>
                <div id="otherreason_div" class="input-field col s6 m-t-20 hide">
                    <input type="text" name="OtherReason" id="OtherReason" value="" class="LetterOnly" maxlength="200">
                    <label for="OtherReason">Reason</label>
                </div>
                <button class="btn waves-effect waves-light right" type="submit" id="reject_button_submit" name="reject_button_submit"><?php echo label('msg_lbl_submit');?></button>
            </form>
        </div>
    </div>
</div>
<!-- Modal Structure -->