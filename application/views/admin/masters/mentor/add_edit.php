<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/mentor"><strong><?php echo label('msg_lbl_title_mentor')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/mentor/<?php echo $page_name; ?>" enctype="multipart/form-data">
                    <input type="password" class="hide">
                    <input id="MentorID" name="MentorID" value="<?php echo @$mentor->MentorID; ?>" type="hidden"  />
                    <input id="UserID" name="UserID" value="<?php echo @$mentor->UserID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_first_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FirstName" name="FirstName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$mentor->FirstName; ?>"  maxlength="50" />
                            <label for="FirstName"><?php echo label('msg_lbl_first_name')?></label>
                        </div>
                         <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_last_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LastName" name="LastName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$mentor->LastName; ?>"  maxlength="50" />
                            <label for="LastName"><?php echo label('msg_lbl_last_name')?></label>
                         </div>
                    </div>  
                    <div class="row">
                       <div class="input-field col s12 m6">
                            <?php if(!isset($mentor->MentorID)){ ?>
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_email');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <?php }?>
                            <input id="EmailID" name="EmailID" type="email" class="empty_validation_class" value="<?php echo @$mentor->EmailID; ?>"  maxlength="255" <?php if(isset($mentor->MentorID)){echo "readonly";}?>/>
                            <label for="EmailID"><?php echo label('msg_lbl_emailid')?></label>
                        </div>
                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_cellphone');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo @$mentor->MobileNo; ?>"  maxlength="13"/>
                            <label for="MobileNo"><?php echo label('msg_lbl_cellphone')?></label>
                       </div>
                        
                    </div>
                    <?php if(!isset($mentor->MentorID)){?>
                    <div class="row " >
                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_password');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <input id="Password" name="Password" type="password" class="empty_validation_class" maxlength="100"/>
                            <label for="Password"><?php echo label('msg_lbl_password')?></label>
                        </div>
                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_password');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <input id="CPassword" name="CPassword" type="password" class="empty_validation_class" maxlength="100"/>
                            <label for="Password"><?php echo label('msg_lbl_confirm_password')?></label>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_briefbio');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="BriefBio" id="BriefBio" class="materialize-textarea empty_validation_class"><?php echo @$mentor->BriefBio; ?></textarea>
                            <label for="BriefBio"><?php echo label('msg_lbl_briefbio')?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_statustext');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="StatusText" id="StatusText" class="materialize-textarea"><?php echo @$mentor->StatusText; ?></textarea>
                            <label for="StatusText"><?php echo label('msg_lbl_statustext')?></label>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php //echo label('msg_lbl_please_enter_companyname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CompanyName" name="CompanyName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$mentor->CompanyName; ?>"  maxlength="250"/>
                            <label for="CompanyName"><?php //echo label('msg_lbl_companyname')?></label>
                       </div>
                       <div class="input-field col s12 m6">
                            <?php //echo $Designation?>
                       </div>
                    </div> -->
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_facebookurl');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FaceboookURL" name="FaceboookURL" type="text" class="" value="<?php echo @$mentor->FaceboookURL; ?>" maxlength="250" />
                            <label for="FaceboookURL"><?php echo label('msg_lbl_facebookurl')?></label>
                        </div> 
                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_twitterURL');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="TwitterURL" name="TwitterURL" type="text" class="" value="<?php echo @$mentor->TwitterURL; ?>"  maxlength="250" />
                            <label for="TwitterURL"><?php echo label('msg_lbl_twitterurl')?></label>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_linkedinurl');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LinkedinURL" name="LinkedinURL" type="text" class="" value="<?php echo @$mentor->LinkedinURL; ?>" maxlength="250" />
                            <label for="LinkedinURL"><?php echo label('msg_lbl_linkedinurl')?></label>
                        </div> 
                        <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_pinteresturl');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="PinterestURL" name="PinterestURL" type="text" class="" value="<?php echo @$mentor->PinterestURL; ?>"  maxlength="250" />
                            <label for="PinterestURL"><?php echo label('msg_lbl_pinteresturl')?></label>
                        </div> 
                    </div>
                        <?php  
                      if(isset($mentor->ProfilePicture)&&$mentor->ProfilePicture != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).MENTOR_UPLOAD_PATH.$mentor->ProfilePicture))) {
                                $path = base_url(). MENTOR_UPLOAD_PATH . $mentor->ProfilePicture;
                                $cross = "";
                             }
                             else
                             {
                                $cross = "hide";
                                $path =  $this->config->item('admin_assets').'img/noimage.gif';
                            }
                        
                        ?> 
                        
                    <div class="m-t-20">
                        <label class="imageview-label"><?php echo label('msg_lbl_imagemsg');?></label>
                        <div class="row">
                            <div class="input-field m-t-0 col s12 m2 imageview1">
                                <img width="150" id="ImagePreivew" src='<?php echo $path; ?>'>
                                <a id="webviewcross" class="cross1 <?=$cross?>" data-img="ImagePreivew" data-file="userfile" data-edit="editProfilePicture"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                            <div class="file-field input-fieldcol col s12 m10 m-t-10">
                                <input tabindex="999" class="file-path" type="text" id="editProfilePicture" name = "editProfilePicture" value='<?php echo @$mentor->ProfilePicture; ?>' readonly/>
                                <div class="btn">
                                    <span>File</span>
                                    <input  accept="image/*" type="file" name="userfile" id="userfile" class="fileuploading" data-cross="webviewcross" data-img="ImagePreivew" data-edit="editProfilePicture"/>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>    
                    <div class="row">
                        <div class="input-field col s12 m6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($mentor->Status) && @$mentor->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/mentor" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>