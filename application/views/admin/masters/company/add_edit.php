<?php //print_r($company);die();
?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/company"><strong><?php echo label('msg_lbl_title_company') ?></strong>
                </a>
            </h4>
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/company/<?php echo $page_name; ?>" enctype="multipart/form-data">
                    <input type="password" class="hide">
                    <input id="CompanyID" name="CompanyID" value="<?php echo @$company->CompanyID; ?>" type="hidden" />
                    <input id="UserID" name="UserID" value="<?php echo @$company->UserID; ?>" type="hidden" />
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_companyname'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CompanyName" name="CompanyName" type="text" class="empty_validation_class" value="<?php echo @$company->CompanyName; ?>" maxlength="250" />
                            <label for="CompanyName"><?php echo label('msg_lbl_company') ?></label>
                        </div>
                        <?php if (!isset($company->CompanyID)) { ?>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_first_name'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="FirstName" name="FirstName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$company->FirstName; ?>" maxlength="50" />
                                <label for="FirstName"><?php echo label('msg_lbl_first_name') ?></label>
                            </div>
                        <?php }
                        if (!isset($company->CompanyID)) { ?>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_last_name'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="LastName" name="LastName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$company->LastName; ?>" maxlength="50" />
                                <label for="LastName"><?php echo label('msg_lbl_last_name') ?></label>
                            </div>
                        <?php }
                        if (!isset($company->CompanyID)) { ?>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_cellphone'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="MobileNo" name="MobileNo" type="text" class="empty_validation_class MobileNo" value="<?php echo @$company->MobileNo; ?>" maxlength="13" />
                                <label for="MobileNo"><?php echo label('msg_lbl_cellphone') ?></label>
                            </div>
                        <?php }
                        if (!isset($company->CompanyID)) { ?>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_email'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="EmailID" name="EmailID" type="email" class="empty_validation_class" value="<?php echo @$company->EmailID; ?>" maxlength="255" <?php if (isset($company->CompanyID)) {
                                                                                                                                                                                echo "readonly";
                                                                                                                                                                            } ?> />
                                <label for="EmailID"><?php echo label('msg_lbl_email') ?></label>
                            </div>
                        <?php }
                        if (!isset($company->CompanyID)) { ?>
                            <div class="input-field col s12 m6">
                                <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_password'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                                <input id="Password" name="Password" type="password" class="" value="<?php echo @$company->Password; ?>" maxlength="100" <?php if (isset($company->CompanyID)) {
                                                                                                                                                                echo "readonly";
                                                                                                                                                            } ?> />
                                <label for="Password"><?php echo label('msg_lbl_password') ?></label>
                            </div>
                        <?php } ?>
                        <div class="input-field col s6 m6">
                            <?php echo @$country; ?>
                        </div>
                        <div class="input-field col s6 m6" id="StateDiv">
                            <?php echo @$state; ?>
                        </div>
                        <div class="input-field col s6 m6" id="CityDiv">
                            <?php echo @$cities; ?>
                        </div>
                        <?php if (!isset($company->CompanyID)) { ?>
                            <div class="input-field col s12 m6">
                                <?php echo @$designation; ?>
                            </div>
                        <?php } ?>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_statustext'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="StatusText" name="StatusText" type="text" class="empty_validation_class" value="<?php echo @$company->StatusText; ?>" maxlength="300" />
                            <label for="StatusText"><?php echo label('msg_lbl_profileheadline') ?></label>
                        </div>
                        <div class="input-field col s12 m6 hide">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_latitude'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Latitude" name="Latitude" type="text" class="AmountOnly" value="78945<?php //echo @$company->Latitude; 
                                                                                                            ?>" maxlength="20" />
                            <label for="Latitude"><?php echo label('msg_lbl_latitude') ?></label>
                        </div>
                        <div class="input-field col s12 m6 hide">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_longitude'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Longitude" name="Longitude" type="text" class="AmountOnly" value="7865<?php //echo @$company->Longitude; 
                                                                                                                ?>" maxlength="20" />
                            <label for="Longitude"><?php echo label('msg_lbl_longitude') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_websiteurl'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="WebsiteURL" name="WebsiteURL" type="text" class="empty_validation_class" value="<?php echo @$company->WebsiteURL; ?>" maxlength="255" />
                            <label for="WebsiteURL"><?php echo label('msg_lbl_websiteurl') ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_facebookurl'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="FaceBookURL" name="FaceBookURL" type="text" class="WebsiteURL" value="<?php echo @$company->FaceBookURL; ?>" maxlength="250" />
                            <label for="FaceBookURL"><?php echo label('msg_lbl_facebookurl') ?></label>
                        </div>

                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_linkedinurl'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="LinkedinURL" name="LinkedinURL" type="text" class="WebsiteURL" value="<?php echo @$company->LinkedinURL; ?>" maxlength="250" />
                            <label for="LinkedinURL"><?php echo label('msg_lbl_linkedinurl') ?></label>
                        </div>

                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_address'); ?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>

                            <textarea name="Address" id="Address" class="materialize-textarea empty_validation_class" maxlength="300"><?php echo @$company->Address; ?></textarea>
                            <label for="Address"><?php echo label('msg_lbl_address') ?></label>
                        </div>

                        <?php
                        if (isset($company->CompanyLogo) && $company->CompanyLogo != "" && (file_exists(str_replace(array('\\', '/system'), array('/', ''), BASEPATH) . COMPANYLOGO_UPLOAD_PATH . $company->CompanyLogo))) {
                            $path = base_url() . COMPANYLOGO_UPLOAD_PATH . $company->CompanyLogo;
                            $cross = "";
                        } else {
                            $cross = "hide";
                            $path =  $this->config->item('admin_assets') . 'img/noimage.gif';
                        }

                        ?>

                        <div class="m-t-20 col s12 m12">
                            <label class="imageview-label"><?php echo label('msg_lbl_imagemsg'); ?></label>
                            <div class="row">
                                <div class="input-field m-t-0 col s12 m2 imageview1">
                                    <img width="150" id="ImagePreivew" src='<?php echo $path; ?>'>
                                    <a id="webviewcross" class="cross1 <?= $cross ?>" data-img="ImagePreivew" data-file="userfile" data-edit="editProfilePicture"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                                </div>
                                <div class="file-field input-fieldcol col s12 m10 m-t-10">
                                    <input tabindex="999" class="file-path  empty_validation_class" type="text" id="editProfilePicture" name="editProfilePicture" value='<?php echo @$company->CompanyLogo; ?>' readonly />
                                    <div class="btn">
                                        <span>File</span>
                                        <input accept="image/*" type="file" name="userfile" id="userfile" class="fileuploading" data-cross="webviewcross" data-img="ImagePreivew" data-edit="editProfilePicture" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s12 m6">

                            <input type="checkbox" class="" name="Status" id="Status"
                                <?php
                                if (isset($company->Status) && @$company->Status == INACTIVE) {
                                    echo "";
                                } else {
                                    echo "checked='checked'";
                                }
                                ?>>
                            <label for="Status"><?php echo label('msg_lbl_status'); ?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit'); ?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/company" class="right close-button"><?php echo label('msg_lbl_cancel'); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>