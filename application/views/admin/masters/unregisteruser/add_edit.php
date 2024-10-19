<?php //print_r($candidate);exit;?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url('admin/masters/candidate');?>"><strong><?php echo label('msg_lbl_title_candidate')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/candidate/<?php echo $page_name; ?>" enctype= "multipart/form-data">
                    <input style="display: none;" type="password" />
                    <input id="cuid" name="cuid" value="<?php echo isset($candidate->CandidateID)?$candidate->CandidateID:0; ?>" type="hidden"  />
                    <input id="UserID" name="UserID" value="<?php echo @$candidate->UserID; ?>" type="hidden"  /> 
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_firstname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FirstName" name="FirstName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$candidate->FirstName; ?>"  maxlength="50" />
                            <label for="FirstName"><?php echo label('msg_lbl_firstname')?></label>
                        </div>
                         <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_lastname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LastName" name="LastName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$candidate->LastName; ?>"  maxlength="50" />
                            <label for="LastName"><?php echo label('msg_lbl_lastname')?></label>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="input-field col s6">
                            <?php if($page_name == 'add'){?>
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_email');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a><?php }?>
                            <input id="EmailID" name="EmailID" type="text" class="empty_validation_class" value="<?php echo @$candidate->EmailID; ?>"  maxlength="150" <?php if(isset($candidate->CandidateID)){echo 'readonly="readonly"'; }?>/>
                            <label for="EmailID"><?php echo label('msg_lbl_email')?></label>
                        </div>
                        <div class="input-field col s12 m6">
                           <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_cellphone');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                          <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo @$candidate->MobileNo; ?>"  maxlength="13"/>
                          <label for="MobileNo"><?php echo label('msg_lbl_cellphone')?></label>
                        </div>
                    </div>
                    <?php if($page_name == 'add'){?>
                    <div class="row">
                         <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_password');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <input id="iPassword" name="Password" type="password" class="empty_validation_class"  maxlength="100" />
                            <label for="Password"><?php echo label('msg_lbl_password')?></label>
                         </div>
                         <div class="input-field col s12 m6">
                             <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_password');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>  
                            <input id="ConfirmPassword" name="ConfirmPassword" type="password" class="empty_validation_class"  maxlength="100" />
                            <label for="ConfirmPassword"><?php echo label('msg_lbl_confirm_password')?></label>
                         </div>
                    </div>
                    <?php }?>
                    <div class="row">
                        <div class="input-field col s4">
                            <?= @$country;?>
                        </div>
                        <div class="input-field col s4" id="StateDiv">
                            <?= @$state;?>
                        </div>
                        <div class="input-field col s4" id="CityDiv">
                            <?= @$cities;?>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="input-field col s6" id="CityDiv">
                            <?php //= @$cities;?>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php //echo label('msg_lbl_please_select_pincode');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Pincode" name="Pincode" type="text" class=" NumberLetter InputCapital" value="<?php // echo @$candidate->Pincode; ?>"  maxlength="11" />
                            <label for="Pincode"><?php //echo label('msg_lbl_pincode')?></label>
                        </div>
                    </div> -->
                    <div class="row">
                         <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_address');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="Address" id="Address" maxlength="500" class="materialize-textarea "><?=@$candidate->Address?></textarea>
                            <label for="Address"><?php echo label('msg_lbl_address')?></label>
                         </div>
                         <div class="input-field col s6">
                            <?= @$profilestatus;?>
                         </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_statustext');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="StatusText" id="StatusText" maxlength="500" class="materialize-textarea"><?=@$candidate->StatusText?></textarea>
                            <label for="StatusText"><?php echo label('msg_lbl_tagline')?></label>
                        </div>
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_summary');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="ProfileSummary" id="ProfileSummary" maxlength="500" class="materialize-textarea"><?=@$candidate->ProfileSummary?></textarea>
                            <label for="ProfileSummary"><?php echo label('msg_lbl_summary')?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <?= @$year;?>
                        </div>
                        <div class="input-field col s6">
                            <?= @$Ethnicity;?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <?= @$JobType;?>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                         <div class="input-field col s6">
                            <label for="Gender"><?php echo label('msg_lbl_gender');?></label>
                            <br>

                            <input name="Gender" type="radio" value="Female" id="Female" <?php
                                if ((isset($candidate->Gender) && $candidate->Gender == FEMALE) || !isset($candidate->Gender)){echo "checked='checked'";}
                                ?> />
                            <label for="Female"><?php echo FEMALE;?></label>

                            <input name="Gender" type="radio" value="Other" id="Othergen" <?php
                                if (isset($candidate->Gender) && $candidate->Gender == OTHER){echo "checked='checked'";}
                                ?> />
                            <label for="Othergen"><?php echo OTHER;?></label>
                        </div>
                         <div id="OtherGenderDiv" class="input-field col s6 <?php echo (@$candidate->Gender == "Other")?"":"hide";?>">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_othergender');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="OtherGender" name="OtherGender" type="text" class="LetterOnly" value="<?php echo @$candidate->OtherGender; ?>"  maxlength="20" />
                            <label for="OtherGender"><?php echo label('msg_lbl_othergender')?></label>
                         </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="IsPhysicalChallenged" id="IsPhysicalChallenged"   
                            <?php
                            if (isset($candidate->IsPhysicalChallenged) && @$candidate->IsPhysicalChallenged == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="IsPhysicalChallenged">Physically Challenged?</label>     
                        </div>
                        <div class="col s6">
                            <label class="imageview-label">Upload only .jpeg, .png, .jpg, .doc, .docx, .xls, .xlsx, .pdf formats</label>
                            <div class="file-field input-fieldcol col s12">

                                <input tabindex="999" class="file-path" type="text" id="editCVPath" name = "editCVPath" value="<?php echo @$candidate->CVPath; ?>" readonly/>
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" name="cvfile" id="cvfile" class="fileuploading" data-type="CVFiles" data-cross="webviewcross" data-img="cvPreivew" data-edit="CVPath"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="IsWorkPermit" id="IsWorkPermit"   
                            <?php
                            if (isset($candidate->IsWorkPermit) && @$candidate->IsWorkPermit == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="IsWorkPermit">Work Permit</label>     
                        </div>
                        <div id="VisaStatusDiv" class="input-field col s6">
                            <?= $VisaStatus;?>
                        </div>
                    </div>
                    <?php  
                    if(isset($candidate->ProfilePic)&&$candidate->ProfilePic != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CANDIDATE_UPLOAD_PATH.$candidate->ProfilePic))) {
                        $path = site_url(CANDIDATE_UPLOAD_PATH . $candidate->ProfilePic);
                        $cross = "";
                    }else{
                        $cross = "hide";
                        $path =  site_url(DEFAULT_IMAGE);
                    }
                    ?> 
                    <div class="m-t-20">
                        <label class="imageview-label"><?php echo label('msg_lbl_imagemsg');?></label>
                        <div class="row">
                            <div class="input-field m-t-0 col s12 m2 imageview1">
                                <img width="150" id="ImagePreivew" src='<?php echo $path; ?>'>
                                <a id="webviewcross" class="cross1 <?=$cross?>" data-img="ImagePreivew" data-file="userfile" data-edit="editImageURL"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                            <div class="file-field input-fieldcol col s12 m10 m-t-10">
                                <input tabindex="999" class="file-path" type="text" id="editImageURL" name = "editImageURL" value="<?php echo @$candidate->ProfilePic; ?>" readonly/>
                                <div class="btn">
                                    <span>File</span>
                                    <input  accept="image/*" type="file" name="userfile" id="userfile" class="fileuploading" data-cross="webviewcross" data-img="ImagePreivew" data-edit="editImageURL"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                         <div class="input-field col s6">
                            <label for="IsWillingToRelocate"><?php echo label('msg_lbl_willingtorelocate');?></label>
                            <br>

                            <input name="IsWillingToRelocate" type="radio" value="1" id="yes" <?php
                                if ((isset($candidate->IsWillingToRelocate) && $candidate->IsWillingToRelocate == 1) || !isset($candidate->IsWillingToRelocate)){echo "checked='checked'";}
                                ?> />
                            <label for="yes"><?php echo "YES";?></label>

                            <input name="IsWillingToRelocate" type="radio" value="0" id="no" <?php
                                if (isset($candidate->IsWillingToRelocate) && $candidate->IsWillingToRelocate == 0){echo "checked='checked'";}
                                ?> />
                            <label for="no"><?php echo "NO";?></label>
                        </div>

                        <div class="input-field col s6">
                            <label for="HaveDrivingLicence"><?php echo label('msg_lbl_havedrivinglicencse');?></label>
                            <br>

                            <input name="HaveDrivingLicence" type="radio" value="1" id="yes" <?php
                                if ((isset($candidate->HaveDrivingLicence) && $candidate->HaveDrivingLicence == 1) || !isset($candidate->HaveDrivingLicence)){echo "checked='checked'";}
                                ?> />
                            <label for="yes"><?php echo "YES";?></label>

                            <input name="HaveDrivingLicence" type="radio" value="0" id="no" <?php
                                if (isset($candidate->HaveDrivingLicence) && $candidate->HaveDrivingLicence == 0){echo "checked='checked'";}
                                ?> />
                            <label for="no"><?php echo "NO";?></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($candidate->Status) && @$candidate->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" >Submit

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo base_url('admin/masters/candidate'); ?>" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>

