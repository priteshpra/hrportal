<?php //pr($details);exit;?>
<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("company/jobpost"); ?>"><?php echo label('msg_lbl_title_jobpost')?></a></h5>
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
               <!--  <input id="JobPostID" name="JobPostID" value="<?php //echo @$details->JobPostID; ?>" type="hidden"/> -->
                <div class="col s6">
                  <h5><?php echo @$details->CompanyName;?></h5>
                </div>
                <div class="col s6">
                  <a href="<?php echo site_url("company/jobpost/add");?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                </div>
                <div class="col s12">
                  <div class="col s12">
                    <ul class="tabs jobpost-details-tab-box">
                     
                      <li class="tab col s6 m3"><a id="alljobs" class="tabclick alljobtab" data-div="all_job" data-type = "All" href="#all_job" title="All Job">All Job</a></li>

                      <li class="tab col s6 m3"><a class="tabclick activejobstab" data-div="job_status" data-type = "Active" id="activejobs" href="#job_status" title="Active Job">Active Job</a></li>

                      <li class="tab col s6 m3"><a class="tabclick recentjobstab" data-div="all_recent" data-type = "RecentlyApplied" id="recentjobs" href="#all_recent" title="Recently Applied Job">Recently Applied Job</a></li>

                    </ul>
                  </div>
                </div>
                

                <!-- All job Start -->
              <div id="all_job" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown" class="select-dropdown" data-div="all_job" data-type = "All">
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
                              <th><?php echo label('msg_lbl_jobtitle')?></th>
                              <th><?php echo label('msg_lbl_industrytype')?></th>
                              <th><?php echo label('msg_lbl_position')?></th>
                              <th><?php echo label('msg_lbl_employmenttype')?></th>
                              <th><?php echo label('msg_lbl_minexperiences')?></th>
                              <th><?php echo label('msg_lbl_maxexperience')?></th>
                              <th><?php echo label('msg_lbl_salary'). "(". $config[0]->CurrencyCode.")"?></th>
                              <th><?php echo label('msg_lbl_jobstatus')?></th>
                              <th><?php echo label('msg_lbl_view');?></th>
                              <th><?php echo label('msg_lbl_applied');?></th>
                              <th><?php echo label('msg_lbl_interview');?></th>
                              <th><?php echo label('msg_lbl_shortlist');?></th>
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
              <!-- All Job End -->

              <!-- All Active Job -->
              <div id="job_status" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div class="row">
                      <div class="col s12">
                        <div class="row m-b-0">
                          <div class="input-field col m2 s12">
                            <select id="select-dropdown" class="select-dropdown" data-div="job_status" data-type = "Active">
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
                              <th><?php echo label('msg_lbl_jobtitle')?></th>
                              <th><?php echo label('msg_lbl_industrytype')?></th>
                              <th><?php echo label('msg_lbl_designation')?></th>
                              <th><?php echo label('msg_lbl_natureofemployment')?></th>
                              <th><?php echo label('msg_lbl_minexperiences')?></th>
                              <th><?php echo label('msg_lbl_maxexperience')?></th>
                              <th><?php echo label('msg_lbl_salary'). "(". $config[0]->CurrencyCode.")"?></th>
                              <th><?php echo label('msg_lbl_jobstatus')?></th>
                              <th><?php echo label('msg_lbl_view');?></th>
                              <th><?php echo label('msg_lbl_applied');?></th>
                              <th><?php echo label('msg_lbl_interview');?></th>
                              <th><?php echo label('msg_lbl_shortlist');?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                          </tr>
                        </thead>
                          <tbody id="table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div" class = "table_paging_div" data-div="job_status" data-type = "Active"></div>
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
                            <select id="select-dropdown" class="select-dropdown" data-div="all_recent" data-type = "RecentlyApplied">
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
                      <table id="data-table-row-grouping" class="display" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                              <th><?php echo label('msg_lbl_jobtitle')?></th>
                              <th><?php echo label('msg_lbl_industrytype')?></th>
                              <th><?php echo label('msg_lbl_designation')?></th>
                              <th><?php echo label('msg_lbl_natureofemployment')?></th>
                              <th><?php echo label('msg_lbl_minexperiences')?></th>
                              <th><?php echo label('msg_lbl_maxexperience')?></th>
                              <th><?php echo label('msg_lbl_salary'). "(". $config[0]->CurrencyCode.")"?></th>
                              <th><?php echo label('msg_lbl_jobstatus')?></th>
                              <th><?php echo label('msg_lbl_view');?></th>
                              <th><?php echo label('msg_lbl_applied');?></th>
                              <th><?php echo label('msg_lbl_interview');?></th>
                              <th><?php echo label('msg_lbl_shortlist');?></th>
                              <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                          </tr>
                        </thead>
                          <tbody id="table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div" class = "table_paging_div" data-div="all_recent" data-type = "RecentlyApplied"></div>
                  </div>
                </div>
              </div>    
              <!--All Recent Job End--> 

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END CONTENT -->
