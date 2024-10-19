<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls ">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/masters/candidate"); ?>"><?php echo label('msg_lbl_title_candidate') ?></a></h5>
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
                <h5><?php echo @$details->FirstName . ' ' . @$details->LastName; ?></h5>
              </div>
              <div class="col s12">
                <div class="col s12">
                  <ul class="tabs company-details-tab-box scrollbar" id="candidate_ul">
                    <li class="tab"><a class="active" href="#basicdetails" title="Basic Details">Basic Details</a></li>
                    <!-- <li class="tab"><a class="active" href="#otherdetails" title="Other Details">Other Details</a></li>
                    <?php if (@$details->RegistrationType == 'Regular') { ?>
                      <li class="tab"><a class="tabclick" href="#change_password" title="Change Password">Change Password</a></li>
                    <?php } ?>
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
                    <li class="tab"><a class="tabclick jobpostinteview" href="#jobpost_inteview" title="Jobpost Interview">Jobpost Interview</a></li> -->
                  </ul>
                </div>
              </div>
              <!-- Basic Details Start -->
              <div id="basicdetails" class="col s12">
                <div class="col s12 m12 l12">
                  <form class="col s12" id="editbasicForm" method="post">
                    <input type="hidden" name="cUserID" id="cUserID" value="<?php echo @$details->ID; ?>">
                    <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                      <li class="active">
                        <div class="" style="">
                          <div class="padding15 clearfix">
                            <div class="input-field col s6">

                              <input id="FirstName" name="FirstName" type="text" value="<?php echo @$details->FirstName; ?>" readonly />
                              <label class="active" for="FirstName"><?php echo label('msg_lbl_firstname') ?></label>
                            </div>
                            <div class="input-field col s6">

                              <input id="LastName" name="LastName" type="text" readonly="" value="<?php echo @$details->LastName; ?>" />
                              <label class="active" for="LastName"><?php echo label('msg_lbl_lastname') ?></label>
                            </div>
                            <div class="input-field col s12 m6">
                              <input type="text" value="<?php echo @$details->EmailID ?>" readonly>
                              <label class="active">Email Id</label>
                            </div>
                            <div class="input-field col s12 m6">

                              <input id="MobileNo" name="MobileNo" type="text" readonly="" value="<?php echo @$details->ContactNumber; ?>" />
                              <label class="active" for="MobileNo"><?php echo label('msg_lbl_cellphone') ?></label>
                            </div>
                            <div class="input-field col s6">
                              <input id="City" name="City" type="text" readonly="" value="<?php echo @$details->Descriptions; ?>" />
                              <label class="active" for="City">Descriptions</label>
                            </div>


                          </div>
                        </div>
                      </li>
                    </ul>
                  </form>
                </div>
              </div>
              <!-- Basic Details End -->


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