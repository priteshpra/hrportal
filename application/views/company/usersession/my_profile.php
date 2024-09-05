<?php //print_r($profile);exit();?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo site_url('company-profile'); ?>"><strong><?php echo label('msg_lbl_my_profile');?></strong></a>
            </h4>
            <form class="col s12" method="post" action="<?php echo site_url('company-profile'); ?>" enctype="multipart/form-data">
              <div class="row">  
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_companyname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a> 
                  <input id="CompanyName" type="text" class = "empty_validation_class" name="CompanyName" maxlength="250" value="<?php echo @$profile->CompanyName;?>" required="required" >
                  <label for="CompanyName" class=""><?php echo label('msg_lbl_companyname');?></label>
                </div>   
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_first_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a> 
                  <input id="FirstName" type="text" class = "empty_validation_class LetterOnly" name="FirstName" maxlength="50" value="<?php echo @$profile->FirstName;?>" required="required" >
                  <label for="FirstName" class=""><?php echo label('msg_lbl_first_name');?></label>
                </div>
              </div> 
              <div class="row">
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_last_name');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                    <input id="LastName" type="text"  maxlength="50" class = "empty_validation_class LetterOnly" name="LastName" value="<?php echo @$profile->LastName;?>">
                  <label for="LastName" class=""><?php echo label('msg_lbl_last_name');?></label>
                </div>
                <div class="input-field col s12 m6">                    
                  <input id="Email" type="email"  maxlength="255"  name="Email" value="<?php echo @$profile->EmailID;?>" readonly>
                    <label for="Email" class=""><?php echo label('msg_lbl_email');?></label>
                </div>
              </div> 
              <div class="row">
                <div class="input-field col s12 m6">
                  <!-- <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_cellphone');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>   -->                   
                  <input id="MobileNo" type="text" class="empty_validation_class NumberOnly"  name="MobileNo" value="<?php echo @$profile->MobileNo;?>" maxlength = "13">
                  <label for="MobileNo" class=""><?php echo label('msg_lbl_cellphone');?></label>
                </div> 
                <div class="input-field col s12 m6">
                 <?php echo $designation;?>
                </div> 
              </div>
              <div class="row">
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_address');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>         
                  <textarea name="Address" id="Address" class="materialize-textarea empty_validation_class"><?php echo @$profile->Address; ?></textarea>
                  <label for="Address"><?php echo label('msg_lbl_address')?></label>
                </div>
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_statustext');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>         
                  <textarea name="StatusText" id="StatusText" class="materialize-textarea empty_validation_class"><?php echo @$profile->StatusText; ?></textarea>
                  <label for="StatusText"><?php echo label('msg_lbl_profileheadline')?></label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s4 m6">
                  <?php echo $country;?>
                </div> 
                <div class="input-field col s4 m6" id="StateDiv">
                  <?php echo $state;?>
                </div>
              </div>
              <div class="row"> 
                <div class="input-field col s4 m6" id="CityDiv">
                  <?php echo $city;?>
                </div> 
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_websiteurl');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                  <input id="WebsiteURL" type="text"  class="empty_validation_class"  name="WebsiteURL" value="<?php echo @$profile->WebsiteURL;?>" maxlength = "255">
                  <label for="WebsiteURL" class=""><?php echo label('msg_lbl_websiteurl');?></label>
                </div>
              </div>
              <div class="row"> 
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_websiteurl');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                  <input id="FacebookURL" type="text"  class="WebsiteURL"  name="FacebookURL" value="<?php echo @$profile->FaceBookURL;?>" maxlength = "255">
                  <label for="FacebookURL" class=""><?php echo label('msg_lbl_facebookurl');?></label>
                </div>
                <div class="input-field col s12 m6">
                  <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_websiteurl');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>                     
                  <input id="LinkedinURL" type="text"  class="WebsiteURL"  name="LinkedinURL" value="<?php echo @$profile->LinkedinURL;?>" maxlength = "255">
                  <label for="LinkedinURL" class=""><?php echo label('msg_lbl_linkedinurl');?></label>
                </div>
              </div>
              <?php  
              if(isset($profile->CompanyLogo)&&$profile->CompanyLogo != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).COMPANYLOGO_UPLOAD_PATH.$profile->CompanyLogo))) {
                $path = base_url(). COMPANYLOGO_UPLOAD_PATH . $profile->CompanyLogo;
                $cross = "";
              }else{
                $cross = "hide";
                $path =  $this->config->item('admin_assets').'img/noimage.gif';
              }
              ?> 
              <div class="m-t-20">
                  <label class="imageview-label">Enter only .jpg and .png formats and img size 150 * 150</label>
                  <div class="row">
                      <div class="input-field m-t-0 col s12 m2 imageview1">
                          <img width="150" id="ImagePreivew" src='<?php echo $path; ?>'>
                          <a id="webviewcross" class="cross1 <?=$cross?>" data-img="ImagePreivew" data-file="userfile" data-edit="editProfilePicture"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                      </div>
                      <div class="file-field input-fieldcol col s12 m10 m-t-10">
                          <input tabindex="999" class="file-path  empty_validation_class" type="text" id="editProfilePicture" name = "editProfilePicture" value='<?php echo @$profile->CompanyLogo; ?>' readonly/>
                          <div class="btn">
                              <span>File</span>
                              <input  accept="image/*" type="file" name="userfile" id="userfile" class="images" data-cross="webviewcross" data-img="ImagePreivew" data-edit="editProfilePicture"/>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m12">
                  <button class="btn waves-effect waves-light right district" type="submit" id="submit_button" name="submit_button" ><?php echo label('msg_lbl_submit');?>
                  </button>
                  <?php echo $loading_button; ?>
                  <a href="<?php echo $this->config->item('base_url'); ?>company-dashboard" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                </div>
              </div>
            </form>
        </div>
    </div>
</div>