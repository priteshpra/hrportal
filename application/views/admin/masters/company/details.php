<?php //pr($details);exit;
?>
<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/masters/company"); ?>"><?php echo label('msg_lbl_title_company') ?></a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
  <!--start container-->
  <div class="container">
    <div class="section">
      <div class="list-page-right" id="company-details-box">
        <div class="card-panel">
          <div class="row">
            <div class="row">
              <form method="post">
                <input id="UserID" name="UserID" value="<?php echo @$details->UserID; ?>" type="hidden" />
                <input id="CompanyID" name="CompanyID" value="<?php echo @$details->CompanyID; ?>" type="hidden" />
                <div class="col s12">
                  <h5><?php
                      $label = (@$details->Status == 0) ? " ( Deleted )" : "";
                      echo @$details->CompanyName . $label ?></h5>
                </div>
                <div class="col s12">
                  <div class="col s12">
                    <ul class="tabs company-details-tab-box">
                      <li class="tab col s6 m3"><a class="tabclick active" href="#details" title="Basic Details">Basic Details</a></li>
                      <li class="tab col s6 m3"><a id="alljobs" class="tabclick employee" data-div="all_employee" data-type="Employee" href="#all_employee" title="Employee">Employee</a></li>
                      <li class="tab col s6 m3"><a id="alljobs" class="tabclick alljobtab" data-div="all_job" data-type="All" href="#all_job" title="All Job">All Job</a></li>
                      <li class="tab col s6 m3"><a class="tabclick activejobstab" data-div="job_status" data-type="Active" id="activejobs" href="#job_status" title="Active Job">Active Job</a></li>
                      <li class="tab col s6 m3"><a class="tabclick recentjobstab" data-div="all_recent" data-type="RecentlyApplied" id="recentjobs" href="#all_recent" title="Recently Applied Job">Recently Applied Job</a></li>
                      <li class="tab col s6 m3"><a class="tabclick directinvitetab" data-div="direct_invite" data-type="Invited" id="directinvite" href="#direct_invite" title="Direct Invited Candidates">Direct Interview</a></li>
                      <li class="tab col s6 m3"><a class="tabclick hiredcandidatetab" data-div="hired_candidate" data-type="Hired" id="directinvite" href="#hired_candidate" title="Hired Candidates">Hired</a></li>
                      <li class="tab col s6 m3"><a class="tabclick declinedcandidatetab" data-div="declined_candidate" data-type="HiredDecline" id="directinvite" href="#declined_candidate" title="Declined Candidates">Declined</a></li>
                    </ul>
                  </div>
                </div>
                <!-- Company Details Start -->
                <div id="details" class="col s12">
                  <div class="col s12 m12 l12">
                    <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                      <li class="active">
                        <div class="collapsible-header active"><i class="mdi-action-account-circle"></i>Basic Details</div>
                        <div class="collapsible-body" style="display: none;">
                          <div class="padding15 clearfix">
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?= @$details->FirstName . ' ' . @$details->LastName ?>" readonly>
                              <label class="active">Full Name</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->EmailID ?>" readonly>
                              <label class="active">Email</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->MobileNo ?>" readonly>
                              <label class="active">Cell Phone</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->Address ?>" readonly>
                              <label class="active">Address</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->Designation ?>" readonly>
                              <label class="active">Designation</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->WebsiteURL ?>" readonly>
                              <label class="active">Website Url</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->FaceBookURL ?>" readonly>
                              <label class="active">Facebook Url</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->LinkedinURL ?>" readonly>
                              <label class="active">Linkedin Url</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->RegistrationType ?>" readonly>
                              <label class="active">Registration Type</label>
                            </div>
                            <?php
                            if (@$details->RegistrationType != "Regular") {
                              if (@$details->RegistrationType == "Facebook") {
                                $label = "Facebook ID";
                                $FID = @$details->FacebookID;
                              } else if (@$details->RegistrationType == "Google") {
                                $label = "Google ID";
                                $FID = @$details->GooglePlusID;
                              } else if (@$details->RegistrationType == "LinkedIn") {
                                $label = "LinkedIn ID";
                                $FID = @$details->LinkedInID;
                              } else if (@$details->RegistrationType == "Twitter") {
                                $label = "Twitter ID";
                                $FID = @$details->TwitterID;
                              } else if (@$details->RegistrationType == "Pinterest") {
                                $label = "Pinterest ID";
                                $FID = @$details->PinterestID;
                              } else {
                                $label = "";
                                $FID = "";
                              }


                            ?>
                              <div class="input-field col s12 m6">
                                <input type="text" value="<?php echo $FID; ?>" readonly>
                                <label class="active"><?php echo $label; ?></label>
                              </div>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- Company Details End -->
                <!-- Employee -->
                <div id="all_employee" class="col s12">
                  <div class="listing-page col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown" data-div="all_employee" data-type="Employee">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayemployee" type="radio" id="Allemployee" value="All" checked="checked" class="changeFilter" data-div="all_employee" data-type="Employee">
                              <label for="Allemployee">All</label>
                              <input name="data_displayemployee" type="radio" id="Filteremployee" value="Filter" class="changeFilter" data-div="all_employee" data-type="Employee">
                              <label for="Filteremployee">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <a class="btn-floating waves-effect waves-light grey right">
                                <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="all_employee" data-type="Employee" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>

                              <a href="<?php echo site_url("admin/masters/company/addemployee/$details->CompanyID"); ?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>

                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="row">
                                <div class="input-field col s12 m6">
                                  <input type="text" name="jobtitle" id="jobtitle">
                                  <label><?php echo label('msg_lbl_name') ?></label>
                                </div>

                              </div>

                              <div class="search_action_button">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="jobs_submit" name="jobs_submit" data-div="all_employee" data-type="Employee">Submit</button>
                                <a href="javascript:;" class="clear-all right" data-div="all_employee">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th><?php echo label('msg_lbl_name') ?></th>
                              <th><?php echo label('msg_lbl_designation') ?></th>
                              <th><?php echo label('msg_lbl_email') ?></th>
                              <th><?php echo label('msg_lbl_cellphone') ?></th>
                              <th class="actions center"><?php echo label('msg_lbl_notificationaction') ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div" data-div="all_employee" data-type="Employee"></div>
                    </div>
                  </div>
                </div>
                <!-- Employee -->
                <!-- All job Start -->
                <div id="all_job" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown" data-div="all_job" data-type="All">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayup" type="radio" id="Allup" value="All" checked="checked" class="changeFilter" data-div="all_job" data-type="All">
                              <label for="Allup">All</label>
                              <input name="data_displayup" type="radio" id="Filterup" value="Filter" class="changeFilter" data-div="all_job" data-type="All">
                              <label for="Filterup">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="all_job" data-type="All" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                                <!-- <a href="<?php echo site_url('admin/masters/company/add'); ?>" class="export-excel btn-floating m-l-5  right waves-effect waves-light white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a> -->
                                <a href="<?php echo site_url("admin/masters/jobpost/add/$details->CompanyID"); ?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="row">
                                <div class="input-field col s12 m6">
                                  <input type="text" name="jobtitle" id="jobtitle">
                                  <label><?php echo label('msg_lbl_jobtitle') ?></label>
                                </div>
                                <div class="input-field col s12 m6">
                                  <?php echo $designation; ?>
                                </div>
                              </div>

                              <div class="search_action_button">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="jobs_submit" name="jobs_submit" data-div="all_job" data-type="All">Submit</button>
                                <a href="javascript:;" class="clear-all right" data-div="all_job">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th><?php echo label('msg_lbl_jobtitle') ?></th>
                              <th><?php echo label('msg_lbl_industrytype') ?></th>
                              <th><?php echo label('msg_lbl_designation') ?></th>
                              <th><?php echo label('msg_lbl_natureofemployment') ?></th>
                              <th><?php echo label('msg_lbl_minexperiences') ?></th>
                              <th><?php echo label('msg_lbl_maxexperience') ?></th>
                              <th><?php echo label('msg_lbl_salary') . "(" . $config[0]->CurrencyCode . ")" ?></th>
                              <th><?php echo label('msg_lbl_websiteurl') ?></th>
                              <th><?php echo label('msg_lbl_cellphone') ?></th>
                              <th><?php echo label('msg_lbl_jobstatus') ?></th>
                              <th><?php echo label('msg_lbl_view'); ?></th>
                              <th><?php echo label('msg_lbl_applied'); ?></th>
                              <th><?php echo label('msg_lbl_interview'); ?></th>
                              <th><?php echo label('msg_lbl_shortlist'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div" data-div="all_job" data-type="All"></div>
                    </div>
                  </div>
                </div>
                <!-- All Job End -->
                <!-- All Active Job -->
                <div id="job_status" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown" data-div="job_status" data-type="Active">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayac" type="radio" id="All" value="All" checked="checked" class="changeFilter" data-div="job_status" data-type="Active">
                              <label for="All">All</label>
                              <input name="data_displayac" type="radio" id="Filter" value="Filter" class="changeFilter" data-div="job_status" data-type="Active">
                              <label for="Filter">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="job_status" data-type="Active" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                                <!--  <a href="<?php echo site_url('admin/masters/company/add'); ?>"  class="export-excel btn-floating m-l-5  right waves-effect waves-light white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a> -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="row">
                                <div class="input-field col s12 m6">
                                  <input type="text" name="jobtitle" id="jobtitle">
                                  <label><?php echo label('msg_lbl_jobtitle') ?></label>
                                </div>
                                <div class="input-field col s12 m6">
                                  <?php echo $designation; ?>
                                </div>
                              </div>

                              <div class="search_action_button">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="jobs_submit" name="jobs_submit" data-div="job_status" data-type="Active">Submit</button>
                                <a href="javascript:;" class="clear-all right" data-div="job_status">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th><?php echo label('msg_lbl_jobtitle') ?></th>
                              <th><?php echo label('msg_lbl_industrytype') ?></th>
                              <th><?php echo label('msg_lbl_designation') ?></th>
                              <th><?php echo label('msg_lbl_natureofemployment') ?></th>
                              <th><?php echo label('msg_lbl_minexperiences') ?></th>
                              <th><?php echo label('msg_lbl_maxexperience') ?></th>
                              <th><?php echo label('msg_lbl_salary') . "(" . $config[0]->CurrencyCode . ")" ?></th>
                              <th><?php echo label('msg_lbl_websiteurl') ?></th>
                              <th><?php echo label('msg_lbl_cellphone') ?></th>
                              <th><?php echo label('msg_lbl_jobstatus') ?></th>
                              <th><?php echo label('msg_lbl_view'); ?></th>
                              <th><?php echo label('msg_lbl_applied'); ?></th>
                              <th><?php echo label('msg_lbl_interview'); ?></th>
                              <th><?php echo label('msg_lbl_shortlist'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div" data-div="job_status" data-type="Active"></div>
                    </div>
                  </div>
                </div>
                <!-- All Active Job -->
                <!--All Recent Job Start-->
                <div id="all_recent" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown" data-div="all_recent" data-type="RecentlyApplied">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayrec" type="radio" id="Allrec" value="All" checked="checked" class="changeFilter" data-div="all_recent" data-type="RecentlyApplied">
                              <label for="Allrec">All</label>
                              <input name="data_displayrec" type="radio" id="Filterrec" value="Filter" class="changeFilter" data-div="all_recent" data-type="RecentlyApplied">
                              <label for="Filterrec">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="all_recent" data-type="RecentlyApplied" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                                <!--  <a href="<?php echo site_url('admin/masters/company/add'); ?>"  class="export-excel btn-floating m-l-5  right waves-effect waves-light white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a> -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="row">
                                <div class="input-field col s12 m6">
                                  <input type="text" name="jobtitle" id="jobtitle">
                                  <label><?php echo label('msg_lbl_jobtitle') ?></label>
                                </div>
                                <div class="input-field col s12 m6">
                                  <?php echo $designation; ?>
                                </div>
                              </div>

                              <div class="search_action_button">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="jobs_submit" name="jobs_submit" data-div="all_recent" data-type="RecentlyApplied">Submit</button>
                                <a href="javascript:;" class="clear-all right" data-div="all_recent">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th><?php echo label('msg_lbl_jobtitle') ?></th>
                              <th><?php echo label('msg_lbl_industrytype') ?></th>
                              <th><?php echo label('msg_lbl_designation') ?></th>
                              <th><?php echo label('msg_lbl_natureofemployment') ?></th>
                              <th><?php echo label('msg_lbl_minexperiences') ?></th>
                              <th><?php echo label('msg_lbl_maxexperience') ?></th>
                              <th><?php echo label('msg_lbl_salary') . "(" . $config[0]->CurrencyCode . ")" ?></th>
                              <th><?php echo label('msg_lbl_websiteurl') ?></th>
                              <th><?php echo label('msg_lbl_cellphone') ?></th>
                              <th><?php echo label('msg_lbl_jobstatus') ?></th>
                              <th><?php echo label('msg_lbl_view'); ?></th>
                              <th><?php echo label('msg_lbl_applied'); ?></th>
                              <th><?php echo label('msg_lbl_interview'); ?></th>
                              <th><?php echo label('msg_lbl_shortlist'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div" data-div="all_recent" data-type="RecentlyApplied"></div>
                    </div>
                  </div>
                </div>

                <!--All Recent Job End-->

                <!--Direct Invited Start-->
                <div id="direct_invite" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown" data-div="direct_invite" data-type="Invited">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayinvite" type="radio" id="AllInvite" value="All" checked="checked" class="changeFilter" data-div="direct_invite" data-type="Invited">
                              <label for="AllInvite">All</label>
                              <input name="data_displayinvite" type="radio" id="FilterInvite" value="Filter" class="changeFilter" data-div="direct_invite" data-type="Invited">
                              <label for="FilterInvite">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="direct_invite" data-type="Invited" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                                <!--  <a href="<?php echo site_url('admin/masters/company/add'); ?>"  class="export-excel btn-floating m-l-5  right waves-effect waves-light white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a> -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="input-field col s6 m6">
                                <?php
                                echo $Salary;
                                ?>
                              </div>
                              <div class="input-field col s6 m6">
                                <?php echo $designation; ?>
                              </div>
                              <div class="input-field col s6 m6">
                                <input type="text" name="Skills" id="Skills" maxlength="100" class="form-control LetterOnly">
                                <label name="Skills" class=""><?php echo label('msg_lbl_title_skill'); ?></label>
                              </div>

                              <div class="input-field col s6 m6">
                                <?php echo $Location; ?>
                              </div>
                              <div class="col s6 m6 ">

                                <input name="InterviewType" type="radio" id="invite" value="Invited" checked="checked" data-div="direct_invite" data-type="Invited">
                                <label for="invite">Invited</label>
                                <input name="InterviewType" type="radio" id="accept" value="Accept" data-div="direct_invite" data-type="Invited">
                                <label for="accept">Accept</label>
                                <input name="InterviewType" type="radio" id="decline" value="Decline" data-div="direct_invite" data-type="Invited">
                                <label for="decline">Decline</label> &nbsp;&nbsp;
                              </div>



                              <div class="search_action_button col s12 m6">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" data-div="direct_invite" data-type="Invited">Submit</button>
                                <a href="javascript:;" class="clear-all right" style="margin:8px 20px 0 0;" data-div="direct_invite">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_100"><?php echo label('msg_lbl_image'); ?></th>
                              <th class="width_200"><?php echo label('msg_lbl_name'); ?></th>
                              <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_skill'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_designation'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                              <th><?php echo label('msg_lbl_cv'); ?></th>
                              <th lass="width_100"><?php echo label('msg_lbl_status'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" data-div="direct_invite" data-type="Invited" class="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!--Direct Invite End-->

                <!--Hired Candidate Start-->
                <div id="hired_candidate" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown" data-div="hired_candidate" data-type="Hired">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayhired" type="radio" id="AllHired" value="All" checked="checked" class="changeFilter" data-div="hired_candidate" data-type="Hired">
                              <label for="AllHired">All</label>
                              <input name="data_displayhired" type="radio" id="FilterHired" value="Filter" class="changeFilter" data-div="hired_candidate" data-type="Hired">
                              <label for="FilterHired">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="hired_candidate" data-type="Hired" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                                <!--  <a href="<?php //echo site_url('admin/masters/company/add');
                                                ?>"  class="export-excel btn-floating m-l-5  right waves-effect waves-light white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a> -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="input-field col s6 m6">
                                <?php
                                echo @$Salary;
                                ?>
                              </div>
                              <div class="input-field col s6 m6">
                                <?php echo $designation; ?>
                              </div>
                              <div class="input-field col s6 m6">
                                <?php echo $Location; ?>
                              </div>

                              <div class="input-field col s6 m6">
                                <input type="text" name="Skills" id="Skills" maxlength="100" class="form-control LetterOnly">
                                <label name="Skills" class=""><?php echo label('msg_lbl_title_skill'); ?></label>
                              </div>
                              <div class="input-field col s6 m6"></div>
                              <div class="search_action_button col s12 m6">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" data-div="hired_candidate" data-type="Hired">Submit</button>
                                <a href="javascript:;" class="clear-all right" style="margin:8px 20px 0 0;" data-div="hired_candidate">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_100"><?php echo label('msg_lbl_image'); ?></th>
                              <th class="width_200"><?php echo label('msg_lbl_name'); ?></th>
                              <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_skill'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_position'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                              <th><?php echo label('msg_lbl_cv'); ?></th>
                              <th lass="width_100"><?php echo label('msg_lbl_status'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" data-div="hired_candidate" data-type="Hired" class="table_paging_div"></div>
                    </div>
                  </div>
                </div>

                <!--Hired candidate End-->

                <!--Declined candidate Start-->
                <div id="declined_candidate" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown" data-div="declined_candidate" data-type="HiredDecline">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displaydecline" type="radio" id="AllDecline" value="All" checked="checked" class="changeFilter" data-div="declined_candidate" data-type="HiredDecline">
                              <label for="AllDecline">All</label>
                              <input name="data_displaydecline" type="radio" id="FilterDecline" value="Filter" class="changeFilter" data-div="declined_candidate" data-type="HiredDecline">
                              <label for="FilterDecline">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="declined_candidate" data-type="HiredDecline" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                                <!--  <a href="<?php //echo site_url('admin/masters/company/add');
                                                ?>"  class="export-excel btn-floating m-l-5  right waves-effect waves-light white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a> -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="input-field col s6 m6">
                                <?php
                                echo @$Salary;
                                ?>
                              </div>

                              <div class="input-field col s6 m6">
                                <?php echo $designation; ?>
                              </div>

                              <div class="input-field col s6 m6">
                                <?php echo $Location; ?>
                              </div>

                              <div class="input-field col s6 m6">
                                <input type="text" name="Skills" id="Skills" maxlength="100" class="form-control LetterOnly">
                                <label name="Skills" class=""><?php echo label('msg_lbl_title_skill'); ?></label>
                              </div>

                              <div class="input-field col s6 m6"></div>


                              <div class="search_action_button col s12 m6">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" data-div="declined_candidate" data-type="HiredDecline">Submit</button>
                                <a href="javascript:;" class="clear-all right" style="margin:8px 20px 0 0;" data-div="declined_candidate">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_100"><?php echo label('msg_lbl_image'); ?></th>
                              <th class="width_200"><?php echo label('msg_lbl_name'); ?></th>
                              <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_skill'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_position'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                              <th><?php echo label('msg_lbl_cv'); ?></th>
                              <th lass="width_100"><?php echo label('msg_lbl_status'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" data-div="declined_candidate" data-type="HiredDecline" class="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!--Direct Invite End-->



            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div style="display:none;" class="cancel_popup modal-trigger" href="#modal-popup-box">Status</div>
  <!--start container-->
  <!--end container-->
</section>
<!-- END CONTENT -->
</form>