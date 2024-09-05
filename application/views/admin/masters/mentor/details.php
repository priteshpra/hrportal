<?php //pr($user_session);exit;?>
<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls ">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/masters/mentor"); ?>"><?php echo label('msg_lbl_title_mentor')?></a></h5>
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
              <div class="col s12 m-b-20">
                <div class="col s12">
                  <ul class="tabs details-tab-box" id="candidate_ul">
                    <li class="tab"><a class="active" href="#basicdetails" title="Basic Details">Basic Details</a></li>
                    <li class="tab"><a class="tabclick" href="#video_listing_page" title="Video">Video</a></li>
                    <li class="tab"><a class="tabclick" href="#video_purchese" title="Video Purchase details">Video Purchase details</a></li>
                  </ul>
                </div>
              </div>
              
              <!-- Basic Details Start -->
              <div id="basicdetails" class="col s12">
                <form class="col s12" id="editbasicForm" method="post">
                  <input type="hidden" name="cUserID" id = "cUserID" value="<?php echo @$details->UserID;?>">
                  <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                    <li class="active">
                      <div class="collapsible-header active"><i class="mdi-action-account-circle"></i>Basic Details</div>
                      <div class="collapsible-body" style="display: none;">
                        <div class="padding15 clearfix">
                          <?php if(isset($details->ProfilePicture) || $details->ProfilePicture!=''){?>
                          <div class="input-field col s12">
                            <?php if(@$mentor->ProfilePicture != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).MENTOR_THUMB_UPLOAD_PATH.$mentor->ProfilePicture))) {
                                $path = $this->config->item('assets') . "uploads/mentor/" . $mentor->ProfilePicture;
                            }else {
                                $path =  $this->config->item('admin_assets').'img/noimage.gif';
                            }
                            ?>  
                            <img src="<?php echo $path;?>" width="150px"/>
                            <!-- <label class="active"><?php //echo label('msg_lbl_image')?></label> -->
                          </div>
                          <?php } ?>

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
                            
                            <textarea name="StatusText" id="StatusText" class="materialize-textarea " readonly=""><?=@$details->StatusText?></textarea>
                            <label for="StatusText"><?php echo label('msg_lbl_statustext')?></label>
                          </div>

                          <div class="input-field col s6">
                            
                            <textarea name="BriefBio" id="BriefBio" class="materialize-textarea " readonly=""><?=@$details->BriefBio?></textarea>
                            <label for="BriefBio"><?php echo label('msg_lbl_briefbio')?></label>
                          </div>
                          <div class="input-field col s6">
                            <input id="CompanyName" name="CompanyName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$details->CompanyName; ?>"  maxlength="250"/>
                            <label for="CompanyName"><?php echo label('msg_lbl_companyname')?></label>
                          </div>
                          <div class="input-field col s6">
                            <input id="designation" name="designation" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$details->Designation; ?>"  maxlength="250"/>
                            <label for="designation"><?php echo label('msg_lbl_designation')?></label>
                          </div>
                          <div class="input-field col s6">
                            <input id="FaceboookURL" name="FaceboookURL" type="text" class="empty_validation_class" value="<?php echo @$details->FaceboookURL; ?>" maxlength="250" />
                            <label for="FaceboookURL"><?php echo label('msg_lbl_facebookurl')?></label>
                          </div>
                          <div class="input-field col s6">
                            <input id="TwitterURL" name="TwitterURL" type="text" class="empty_validation_class" value="<?php echo @$details->TwitterURL; ?>"  maxlength="250" />
                            <label for="TwitterURL"><?php echo label('msg_lbl_twitterurl')?></label>
                          </div>
                          <div class="input-field col s6">
                            <input id="LinkedinURL" name="LinkedinURL" type="text" class="empty_validation_class" value="<?php echo @$details->LinkedinURL; ?>" maxlength="250" />
                            <label for="LinkedinURL"><?php echo label('msg_lbl_linkedinurl')?></label>
                          </div>
                          <div class="input-field col s6">
                            <input id="PinterestURL" name="PinterestURL" type="text" class="empty_validation_class" value="<?php echo @$details->PinterestURL; ?>"  maxlength="250" />
                            <label for="PinterestURL"><?php echo label('msg_lbl_pinteresturl')?></label>
                          </div>


                        </div>
                      </div>
                    </li>
                  </ul>
                </form>
              </div>
              <!-- Basic Details End -->

              <!-- video Start -->
              <div id="video_listing_page"  class="listing-page col s12">
                <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            <div class="row m-b-0">
                                <div class="input-field col m2 s12">
                                    <select id="select-dropdown">
                                        <option value="10"  selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col m6 s12 center m-t-20">
                                    <span><label><?php echo label('msg_lbl_data_display');?> :</label></span> &nbsp;&nbsp;
                                      <input name="data_display" type="radio" id="All" value="All" onclick="return changeFilter(this.value);" checked="checked">
                                      <label for="All"><?php echo label('msg_lbl_all');?></label>
                                      <input name="data_display" type="radio" id="Filter" value="Filter" onclick="return changeFilter(this.value);">
                                      <label for="Filter"><?php echo label('msg_lbl_filter');?></label>  &nbsp;&nbsp;
                                </div>  
                                <div class="col s12 m4 right-align list-page-right-top-icon">
                                  <a class="btn-floating waves-effect waves-light grey right">
                                  <i id="display_action" onClick="field_display();" class="mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                                  <?php if(@$this->cur_module->is_export == 1){?>
                                  <a href="<?php echo site_url("admin/masters/video/export_to_excel/".$ID);?>" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                                  <?php }if(@$this->cur_module->is_insert == 1){?>
                                  <a href="<?php echo site_url("admin/masters/video/add/".$ID);?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                  <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col s12">
                          <div class="search_action card-panel" style="display:none;">                                
                            <h4 class="header"><strong> <?php echo label('msg_lbl_search_value');?> </strong></h4>
                            <div class="row m-b-0">
                                <div class="input-field col s12 m6">
                                  <input type="text" name="VideoTitle" id="VideoTitle" maxlength="100" class="form-control LetterOnly">
                                  <label name="VideoTitle" class=""><?php echo label('msg_lbl_video');?></label>
                                </div>
                                <div class="input-field col s12 m6 hide">
                                <?= $user;?>
                                </div>
                            </div>
                            <div class="row m-b-0">
                              <div class="input-field search_label_radio col s12 m6">
                                <div name="status" class="form-control search_div m-t-10 left"><?php echo label('msg_lbl_status');?></div>
                                <input name="Status_search" type="radio" id="All_Status_search" value="-1" checked="checked">
                                <label for="All_Status_search"><?php echo label('msg_lbl_all');?></label>
                                <input name="Status_search" type="radio" id="Active" value="1">
                                <label for="Active"><?php echo label('msg_lbl_active');?></label> 
                                <input name="Status_search" type="radio" id="InActive" value="0">
                                <label for="InActive"><?php echo label('msg_lbl_inactive');?></label>
                              </div>
                            </div>
                   
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit');?>
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <a href="javascript:;" class="clear-all right" onclick="return clearAllFilter();"><?php echo label('msg_lbl_clear_all');?>
                            </a> 
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="width_100"><?php echo label('msg_lbl_image');?></th>
                                    <th class="width_180"><?php echo label('msg_lbl_video');?></th>
                                    <th class="width_180"><?php echo label('msg_lbl_mentor');?></th>
                                    <th class="width_150"><?php echo label('msg_lbl_videourl');?></th>
                                    <th class="width_100"><?php echo label('msg_lbl_flag');?></th>
                                    <th class="actions center"><?php echo label('msg_lbl_status');?></th>
                                    <th class="actions center"><?php echo label('msg_lbl_action');?></th>
                                </tr>
                            </thead>

                            <tbody id="table_body">

                            </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div"></div>
                </div>
                <?php echo @$view_modal_popup; ?>
            </div>
          </div>
              <!-- video End -->
             
              <!-- Saved jobs Start -->
              <div id="video_purchese" class="listing-page col s12">
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
                            <span><label>Data Display :</label></span> &nbsp;&nbsp;
                            <input name="saveddata_displayup" type="radio" id="saveAll" value="All" checked="checked" class="changeFilter" data-div="video_purchese" onclick="$('#video_purchese .search_action').css('display','none');">
                            <label for="saveAll">All</label>
                            <input name="saveddata_displayup" type="radio" id="saveFilter" value="Filter" class="changeFilter" data-div="video_purchese" onclick="$('#video_purchese .search_action').css('display','block');">
                            <label for="saveFilter">Filter</label>  &nbsp;&nbsp;
                          </div>  
                          <div class="col s12 m4 right-align list-page-right-top-icon">                  
                            <div class="right">
                              <a class="btn-floating m-l-5 waves-effect waves-light grey right">
                              <i id="display_action" class="mdi-hardware-keyboard-arrow-down tooltipped filtercls" data-div="video_purchese" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>                              
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
                                 <?php // echo @$designation;?>

                  <input type="text" name="SearchText" id="SearchText" maxlength="100" class="form-control LetterOnly">
                  <label for="SearchText" class=""><?php echo label('msg_lbl_search_value');?></label>
                              </div>
                            </div>
                          </div>
                          <div class="search_action_button" style="padding-bottom:15px;">
                            <button class="btn waves-effect waves-light right" type="button" id="video_purchese_submit" name="video_purchese_submit">Submit</button>
                            <a href="javascript:;" class="clear-all right" data-div="video_purchese">Clear</a> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                          <tr>
                                <th class="width_100"><?php echo label('msg_lbl_image');?></th>
                                <th class="width_180"><?php echo label('msg_lbl_video');?></th>
                                <th class="width_180"><?php echo label('msg_lbl_name');?></th>
                                <!-- <th class="width_180"><?php echo label('msg_lbl_mentor');?></th> -->
                                <th class="width_150"><?php echo label('msg_lbl_videourl');?></th>
                                <th class="width_150"><?php echo label('msg_lbl_price');?></th>
                                <th class="width_180"><?php echo label('msg_lbl_payment_method');?></th>
                                <th class="width_100"><?php echo label('msg_lbl_status');?></th>
                                <th class="actions center"><?php echo label('msg_lbl_user_detail');?></th>
                                <!-- <th class="actions center"><?php echo label('msg_lbl_action');?></th> -->
                            </tr>
                        </thead>
                          <tbody id="video_purchese_table_body">
                          </tbody> 
                        </table>
                    </div>
                    <div id="video_purchese_table_paging_div"></div>
                  </div>
                </div>
              </div>
              <!-- saved jobs End -->

           
              <!-- Reports Start -->
              <!-- <div id="reports" class="col s12">
                <div class="col s12 m12 l12">
                  <div class="card-panel">
                    <div id="report_container">
                       Ajax report will come here 
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- Reports End -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!--start container-->
  <!--end container-->
</section>