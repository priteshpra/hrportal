<?php //pr($details);exit;
?>
<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/masters/jobpost"); ?>"><?php echo label('msg_lbl_title_jobpost') ?></a></h5>
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
                <input id="UserID" name="UserID" value="<?php echo @$details->UserID; ?>" type="hidden" />
                <input id="JobPostID" name="JobPostID" value="<?php echo @$details->JobPostID; ?>" type="hidden" />
                <div class="col s12">
                  <h5><?php echo @$details->JobTitle; ?></h5>
                </div>
                <div class="col s12">
                  <div class="col s12">
                    <ul class="tabs jobpost-details-tab-box">
                      <li class="tab col s6 m3"><a class="tabclick active" href="#detailsjob" title="Basic Details">Basic Details</a></li>

                      <li class="tab col s6 m3"><a class="tabclick" data-div="view_job" data-type="View" id="view" href="#view_job" title="Viewed Job">Viewed Job</a></li>

                      <li class="tab col s6 m3"><a class="tabclick" data-div="all_applied" data-type="Applied" id="applied" href="#all_applied" title="Applied Job">Applied Job</a></li>

                      <li class="tab col s6 m3"><a class="tabclick" data-div="all_shortlisted" data-type="Shortlisted" id="shortlisted" href="#all_shortlisted" title="Shortlisted">Shortlisted</a></li>

                      <li class="tab col s6 m3"><a class="tabclick" data-div="all_invited" data-type="Invited" id="invited" href="#all_invited" title="Invited">Interview</a></li>

                      <li class="tab col s6 m3"><a class="tabclick" data-div="all_accepted" data-type="Accept" id="accepted" href="#all_accepted" title="Accepted">Accepted</a></li>

                      <li class="tab col s6 m3"><a class="tabclick" data-div="all_declined" data-type="Decline" id="declined" href="#all_declined" title="Declined">Declined</a></li>

                    </ul>
                  </div>
                </div>
                <!-- Jobpost Details Start -->
                <div id="detailsjob" class="col s12">
                  <div class="col s12 m12 l12">
                    <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                      <li class="active">
                        <div class="collapsible-header active"><i class="mdi-action-account-circle"></i>Basic Details</div>
                        <div class="collapsible-body" style="display: none;">
                          <div class="padding15 clearfix">
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?= @$details->JobTitle ?>" readonly>
                              <label class="active">Job Title</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->Location ?>" readonly>
                              <label class="active">Location</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->NatureOfEmployment ?>" readonly>
                              <label class="active">Nature of Employment</label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->NoOfVacancies ?>" readonly>
                              <label class="active">No of Vacancies</label>
                            </div>
                            <div class="input-field col s6">
                              <input id="Designation" name="Designation" type="text" readonly="" value="<?php echo @$details->Designation; ?>" />
                              <label class="active" for="Designation"><?php echo label('msg_lbl_designation') ?></label>
                            </div>
                            <div class="input-field col s6">
                              <input id="CityName" name="CityName" type="text" readonly="" value="<?php echo @$details->CityName; ?>" />
                              <label class="active" for="CityName"><?php echo label('msg_lbl_city') ?></label>
                            </div>
                            <div class="input-field col s6">
                              <input id="IndustryType" name="IndustryType" type="text" readonly="" value="<?php echo @$details->IndustryType; ?>" />
                              <label class="active" for="IndustryType"><?php echo label('msg_lbl_industrytype') ?></label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->MinExperience ?>" readonly>
                              <label class="active"><?php echo label('msg_lbl_minexperience') ?></label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->MaxExperience ?>" readonly>
                              <label class="active"><?php echo label('msg_lbl_maxexperience') ?></label>
                            </div>

                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->MinSalary ?>" readonly>
                              <label class="active"><?php echo label('msg_lbl_minsalary') . "(" . $config[0]->CurrencyCode . ")" ?></label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->MaxSalary ?>" readonly>
                              <label class="active"><?php echo label('msg_lbl_maxsalary') . "(" . $config[0]->CurrencyCode . ")" ?></label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->JobStatus ?>" readonly>
                              <label class="active"><?php echo label('msg_lbl_jobstatus') ?></label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->DetailsOfJob ?>" readonly>
                              <label class="active"><?php echo label('msg_lbl_detailsofjob') ?></label>
                            </div>

                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- Jobpost Details End -->
                <!-- All Viewed Job -->
                <div id="view_job" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayview" type="radio" id="All" value="All" checked="checked" class="changeFilter" data-div="view_job" data-type="View">
                              <label for="All">All</label>
                              <input name="data_displayview" type="radio" id="Filter" value="Filter" class="changeFilter" data-div="view_job" data-type="View">
                              <label for="Filter">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="view_job" data-type="View" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="input-field col s6 m6">
                                <?php echo $Salary; ?>
                              </div>
                              <div class="search_action_button col s6 m6">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" data-div="view_job" data-type="View">Submit</button>
                                <a href="javascript:;" class="clear-all right" style="margin:8px 20px 0 0;" data-div="view_job">Clear</a>
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
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name">
                                  <?php echo label('msg_lbl_name'); ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>
                              <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary">
                                  <?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>

                              <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_skill'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_designation'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                              <th><?php echo label('msg_lbl_cv'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!-- All Viewed Job -->
                <!-- All Applied Job -->
                <div id="all_applied" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayapply" type="radio" id="Allapply" value="All" checked="checked" class="changeFilter" data-div="all_applied" data-type="Applied">
                              <label for="Allapply">All</label>
                              <input name="data_displayapply" type="radio" id="Filterapply" value="Filter" class="changeFilter" data-div="all_applied" data-type="Applied">
                              <label for="Filterapply">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="all_applied" data-type="Applied" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="input-field col s6 m6">
                                <?php echo $Salary; ?>
                              </div>
                              <div class="search_action_button col s6 m6">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" data-div="all_applied" data-type="View">Submit</button>
                                <a href="javascript:;" class="clear-all right" style="margin:8px 20px 0 0;" data-div="all_applied">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_100"><?php echo label('msg_lbl_image'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name">
                                  <?php echo label('msg_lbl_name'); ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>
                              <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary">
                                  <?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>

                              <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_skill'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_designation'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                              <th><?php echo label('msg_lbl_cv'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!-- All Applied Job -->
                <!-- All Shortlisted Job -->
                <style>
                  .modal {
                    max-height: auto;
                    width: 100%;
                    top: 15%;
                  }
                </style>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
                <div id="all_shortlisted" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayshortlisted" type="radio" id="Allshortlisted" value="All" checked="checked" class="changeFilter" data-div="all_shortlisted" data-type="Shortlisted">
                              <label for="Allshortlisted">All</label>
                              <input name="data_displayshortlisted" type="radio" id="Filtershortlisted" value="Filter" class="changeFilter" data-div="all_shortlisted" data-type="Shortlisted">
                              <label for="Filtershortlisted">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="all_shortlisted" data-type="Shortlisted" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                                &nbsp;&nbsp;
                              </div>&nbsp;&nbsp;
                              <a data-bs-toggle="modal" data-bs-target="#tableModal" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="input-field col s6 m6">
                                <?php echo $Salary; ?>
                              </div>
                              <div class="search_action_button col s6 m6">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" data-div="all_shortlisted" data-type="Shortlisted">Submit</button>
                                <a href="javascript:;" class="clear-all right" style="margin:8px 20px 0 0;" data-div="all_shortlisted">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_100"><?php echo label('msg_lbl_image'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name">
                                  <?php echo label('msg_lbl_name'); ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>
                              <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary">
                                  <?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>

                              <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_skill'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_designation'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                              <th><?php echo label('msg_lbl_cv'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div"></div>
                      <!-- Bootstrap Modal -->
                      <div class="modal fade" id="tableModal" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
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
                                    <input type="hidden" name="jobSearchText" id="jobSearchText" value="<?php echo @$details->JobTitle ?>" />
                                    <input type="hidden" name="jobID" id="jobID" value="<?php echo @$details->JobPostID ?>" />
                                    <input type="hidden" name="CompanyEmployeeUserID" id="CompanyEmployeeUserID" value="<?php echo @$details->CompanyEmployeeUserID ?>" />
                                    <div class="col m6 s12 center m-t-20">
                                      <span><label><?php echo label('msg_lbl_data_display'); ?> :</label></span> &nbsp;&nbsp;
                                      <input name="data_display" type="radio" id="Alls" value="All" onclick="return changeFilter(this.value);" checked="checked">
                                      <label for="Alls"><?php echo label('msg_lbl_all'); ?></label>
                                      <input name="data_display" type="radio" id="Filters" value="Filter" onclick="return changeFilter(this.value);">
                                      <label for="Filters"><?php echo label('msg_lbl_filter'); ?></label> &nbsp;&nbsp;

                                    </div>
                                    <div class="col s12 m4 right-align list-page-right-top-icon">
                                      <a class="btn-floating waves-effect waves-light grey right">
                                        <i id="display_action" onClick="field_display();" class="mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>

                                    </div>
                                  </div>
                                </div>
                                <div class="col s12">
                                  <div class="search_action card-panel" style="display:none;">
                                    <h4 class="header"><strong> <?php echo label('msg_lbl_search_value'); ?> </strong></h4>
                                    <div class="row m-b-0">
                                      <div class="input-field col s12 m6">
                                        <input type="text" name="Skills" id="Skillss" maxlength="100" class="form-control LetterOnly">
                                        <label name="Skills" class=""><?php echo label('msg_lbl_title_skill'); ?></label>
                                      </div>
                                      <div class="input-field col s12 m6">
                                        <?php
                                        echo @$Salary;
                                        ?>
                                      </div>
                                      <div class="input-field col s12 m6">
                                        <?php
                                        echo @$Designation;
                                        ?>
                                      </div>
                                    </div>
                                    <button class="btn waves-effect waves-light right all_active_inactives" type="button" id="button_submits" name="button_submit"><?php echo label('msg_lbl_submit'); ?>
                                    </button>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="javascript:;" class="clear-all right" onclick="return clearAllFilter();"><?php echo label('msg_lbl_clear_all'); ?>
                                    </a>
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <!-- Place your table here -->
                              <div class="table-responsive">
                                <table id="data-table-row-grouping" class="display" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th class="width_100"><?php echo label('msg_lbl_image'); ?></th>
                                      <th class="width_200">
                                        <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name">
                                          <?php echo label('msg_lbl_name'); ?>
                                          <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                          <i class="mdi-hardware-keyboard-arrow-up up"></i>
                                        </span>
                                      </th>
                                      <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                                      <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                                      <th class="width_150"><?php echo label('msg_lbl_otp'); ?></th>
                                      <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                                      <th class="width_200">
                                        <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary">
                                          <?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?>
                                          <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                          <i class="mdi-hardware-keyboard-arrow-up up"></i>
                                        </span>
                                      </th>
                                      <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                                      <th class="width_80"><?php echo label('msg_lbl_skill'); ?></th>
                                      <th class="width_80"><?php echo label('msg_lbl_designation'); ?></th>
                                      <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                                      <th><?php echo label('msg_lbl_cv'); ?></th>
                                      <th class="actions center"><?php echo label('msg_lbl_status'); ?></th>
                                      <th class="actions center"><?php echo label('msg_lbl_action'); ?></th>
                                    </tr>
                                  </thead>
                                  <tbody id="table_bodyshort">
                                  </tbody>
                                </table>
                              </div>
                              <div id="table_paging_divshort"></div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- All Shortlisted Job -->
                <!-- All Invited Job -->
                <div id="all_invited" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayinvited" type="radio" id="Allinvited" value="All" checked="checked" class="changeFilter" data-div="all_invited" data-type="Invited">
                              <label for="Allinvited">All</label>
                              <input name="data_displayinvited" type="radio" id="Filterinvited" value="Filter" class="changeFilter" data-div="all_invited" data-type="Invited">
                              <label for="Filterinvited">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="all_invited" data-type="Invited" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="input-field col s6 m6">
                                <?php echo $Salary; ?>
                              </div>
                              <div class="search_action_button col s6 m6">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" data-div="all_invited" data-type="Invited">Submit</button>
                                <a href="javascript:;" class="clear-all right" style="margin:8px 20px 0 0;" data-div="all_invited">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_100"><?php echo label('msg_lbl_image'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name">
                                  <?php echo label('msg_lbl_name'); ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>
                              <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary">
                                  <?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>

                              <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_skill'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_designation'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                              <th><?php echo label('msg_lbl_cv'); ?></th>

                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!-- All Invited Job -->
                <!-- All Accepted Job -->
                <div id="all_accepted" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displayacceptedjob" type="radio" id="Allacceptedjob" value="All" checked="checked" class="changeFilter" data-div="all_accepted" data-type="Accept">
                              <label for="Allacceptedjob">All</label>
                              <input name="data_displayacceptedjob" type="radio" id="Filteracceptedjob" value="Filter" class="changeFilter" data-div="all_accepted" data-type="Accept">
                              <label for="Filteracceptedjob">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="all_accepted" data-type="Accept" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="input-field col s6 m6">
                                <?php echo $Salary; ?>
                              </div>
                              <div class="search_action_button col s6 m6">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" data-div="all_accepted" data-type="Accept">Submit</button>
                                <a href="javascript:;" class="clear-all right" style="margin:8px 20px 0 0;" data-div="all_accepted">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_100"><?php echo label('msg_lbl_image'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name">
                                  <?php echo label('msg_lbl_name'); ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>
                              <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary">
                                  <?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>

                              <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_skill'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_designation'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                              <th><?php echo label('msg_lbl_cv'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!-- All Accepted Job -->
                <!-- All Declined Job -->
                <div id="all_declined" class="col s12">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <div class="row">
                        <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                              </select>
                            </div>
                            <div class="col m6 s12 center m-t-20">
                              <span><label>Data Display :</label></span> &nbsp;&nbsp;
                              <input name="data_displaydeclined" type="radio" id="Alldeclined" value="All" checked="checked" class="changeFilter" data-div="all_declined" data-type="Decline">
                              <label for="Alldeclined">All</label>
                              <input name="data_displaydeclined" type="radio" id="Filterdeclined" value="Filter" class="changeFilter" data-div="all_declined" data-type="Decline">
                              <label for="Filterdeclined">Filter</label> &nbsp;&nbsp;
                            </div>
                            <div class="col s12 m4 right-align list-page-right-top-icon">
                              <div class="right">
                                <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                                  <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="all_declined" data-type="Decline" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">
                            <h4 class="header m-b-0"><strong> Search</strong></h4>
                            <div class="row m-b-0">
                              <div class="input-field col s6 m6">
                                <?php echo $Salary; ?>
                              </div>
                              <div class="search_action_button col s6 m6">
                                <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" data-div="all_declined" data-type="Decline">Submit</button>
                                <a href="javascript:;" class="clear-all right" style="margin:8px 20px 0 0;" data-div="all_declined">Clear</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="width_100"><?php echo label('msg_lbl_image'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter active" data-filter="Name">
                                  <?php echo label('msg_lbl_name'); ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>
                              <th class="width_250"><?php echo label('msg_lbl_email'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_cellphone'); ?></th>
                              <th class="width_150"><?php echo label('msg_lbl_city'); ?></th>
                              <th class="width_200">
                                <span style="cursor: pointer;" href="javascript:void(0)" class="filter" data-filter="Salary">
                                  <?php echo label('msg_lbl_salary') . " (" . $config[0]->CurrencyCode . ")"; ?>
                                  <i class="mdi-hardware-keyboard-arrow-down down hide"></i>
                                  <i class="mdi-hardware-keyboard-arrow-up up "></i>
                                </span>
                              </th>

                              <th class="width_80"><?php echo label('msg_lbl_gender'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_skill'); ?></th>
                              <th class="width_80"><?php echo label('msg_lbl_designation'); ?></th>
                              <th class="width_100"><?php echo label('msg_lbl_isexperience'); ?></th>
                              <th><?php echo label('msg_lbl_cv'); ?></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                          </tbody>
                        </table>
                      </div>
                      <div id="table_paging_div" class="table_paging_div"></div>
                    </div>
                  </div>
                </div>
                <!-- All Declined Job -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END CONTENT -->