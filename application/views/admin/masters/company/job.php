<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls  grey lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url('admin/masters/company/'); ?>"><?php echo label('msg_lbl_title_company')?></a></h5>
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
                <input id="JobPostID" name="JobPostID" value="<?php echo @$job->JobPostID; ?>" type="hidden"/>
              <div class="col s12">
                <h5><a href="<?php echo site_url('admin/masters/company/details/'.@$job->UserID.'#'.@$redirect); ?>"><?php echo @$job->JobTitle ;?></a></h5>
              </div>
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box">
                    <?php if($Type == 'view'){?>
                    <li class="tab col s6 m3"><a class="tabclick active" data-div="view_job" data-type = "View" id="viewjobs" href="#view_job" title="Viewed Job">Viewed Job</a></li>
    
                    <li class="tab col s6 m3"><a class="tabclick" data-div="applied_job" data-type = "Applied" id="appliedjobs" href="#applied_job" title="Applied Job">Applied Job</a></li>
                  <?php } else {?>
                  <li class="tab col s6 m3"><a class="tabclick" data-div="view_job" data-type = "View" id="viewjobs" href="#view_job" title="Viewed Job">View Job</a></li>
    
                    <li class="tab col s6 m3"><a class="tabclick active" data-div="applied_job" data-type = "Applied" id="appliedjobs" href="#applied_job" title="Applied Job">Applied Job</a></li>
                  <?php }?> 
                  </ul>
                </div>
              </div>          
              
             <!-- All Active Job -->
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
                            <input name="data_displayActive" type="radio" id="AllActive" value="All" checked="checked" class="changeFilter" data-div="view_job" data-type = "View">
                            <label for="AllActive">All</label>
                            <input name="data_displayActive" type="radio" id="FilterActive" value="Filter" class="changeFilter" data-div="view_job" data-type = "View">
                            <label for="FilterActive">Filter</label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">                  
                            <div class="right">
                              <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="view_job" data-type = "View" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                             <!--  <a href="<?php echo site_url('admin/masters/company/add');?>"  class="export-excel btn-floating m-l-5  right waves-effect waves-light white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a> -->
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
                                  <input type="text" name="Skill" id="Skill">
                                  <label><?php echo label('msg_lbl_title_skill')?></label>
                              </div>
                            </div>                          
                          <div class="search_action_button">
                            <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="jobs_submit" name="jobs_submit" data-div="view_job" data-type = "View">Submit</button>
                            <a href="javascript:;" class="clear-all right" data-div="view_job">Clear</a> 
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_name');?></th>
                              <th><?php echo label('msg_lbl_email');?></th>
                              <th><?php echo label('msg_lbl_cellphone');?></th>
                              <th><?php echo label('msg_lbl_title_skill');?></th>
                              <th><?php echo label('msg_lbl_city');?></th>
                              <th><?php echo label('msg_lbl_paddress');?></th>
                              <th><?php echo label('msg_lbl_salarygbp');?></th>
                              <th><?php echo label('msg_lbl_dob');?></th>
                              <th><?php echo label('msg_lbl_gender');?></th>
                              <th><?php echo label('msg_lbl_physicalchallenged');?></th>
                              <th><?php echo label('msg_lbl_maritualstatus');?></th>
                              <th><?php echo label('msg_lbl_isexperience');?></th>
                          </tr>
                        </thead>
                          <tbody class="table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div" class = "table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- All Active Job -->
              <!--All Recent Job Start-->
              <div id="applied_job" class="col s12">
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
                            <input name="data_displayRecent" type="radio" id="AllRecent" value="All" checked="checked" class="changeFilter" data-div="applied_job" data-type = "Applied">
                            <label for="AllRecent">All</label>
                            <input name="data_displayRecent" type="radio" id="FilterRecent" value="Filter" class="changeFilter" data-div="applied_job" data-type = "Applied">
                            <label for="FilterRecent">Filter</label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">                  
                            <div class="right">
                              <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="applied_job" data-type = "Applied" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                             <!--  <a href="<?php echo site_url('admin/masters/company/add');?>"  class="export-excel btn-floating m-l-5  right waves-effect waves-light white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a--> 
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
                                  <input type="text" name="Skill" id="Skill">
                                  <label><?php echo label('msg_lbl_title_skill')?></label>
                              </div>
                            </div>
                          
                          <div class="search_action_button">
                            <button class="all_active_inactive btn waves-effect waves-light right" type="button" id="jobs_submit" name="jobs_submit" data-div="applied_job" data-type = "Applied">Submit</button>
                            <a href="javascript:;" class="clear-all right" data-div="applied_job">Clear</a>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_name');?></th>
                              <th><?php echo label('msg_lbl_email');?></th>
                              <th><?php echo label('msg_lbl_cellphone');?></th>
                              <th><?php echo label('msg_lbl_title_skill');?></th>
                              <th><?php echo label('msg_lbl_city');?></th>
                              <th><?php echo label('msg_lbl_paddress');?></th>
                              <th><?php echo label('msg_lbl_salarygbp');?></th>
                              <th><?php echo label('msg_lbl_dob');?></th>
                              <th><?php echo label('msg_lbl_gender');?></th>
                              <th><?php echo label('msg_lbl_physicalchallenged');?></th>
                              <th><?php echo label('msg_lbl_maritualstatus');?></th>
                              <th><?php echo label('msg_lbl_isexperience');?></th>
                          </tr>
                        </thead>
                          <tbody class="table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div" class = "table_paging_div"></div>
                  </div>
                </div>
              </div>   
              <!--All Recent Job End--> 


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