<?php //print_r($banner);die();?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/banner"><strong><?php echo label('msg_lbl_title_banner')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/banner/<?php echo $page_name; ?>" enctype="multipart/form-data">
                    <input id="BannerID" name="BannerID" value="<?php echo @$banner->BannerID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_bannertitle');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="BannerTitle" name="BannerTitle" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$banner->BannerTitle; ?>"  maxlength="50" />
                            <label for="BannerTitle"><?php echo label('msg_lbl_bannertitle')?></label>
                        </div>
                         <div class="input-field col s6">
							<a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_subtitle');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="SubTitle" name="SubTitle" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$banner->SubTitle; ?>"  maxlength="100" />
                            <label for="SubTitle"><?php echo label('msg_lbl_subtitle')?></label>
						 </div>
						 
                    </div>  
					<div class="row">
						<div class="input-field col s12 m12">
							<a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_sequence');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							<input id="Sequence" name="Sequence" type="text" maxlength="5" class="empty_validation_class NumberOnly" value="<?php echo @$banner->Sequence; ?>" />
                            <label for="Sequence"><?php echo label('msg_lbl_sequence')?></label>
						</div>
					</div>
					<?php  
				  if(isset($banner->ImageURL)&&$banner->ImageURL != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).BANNER_UPLOAD_PATH.$banner->ImageURL))) {
							$path = base_url(). BANNER_UPLOAD_PATH . $banner->ImageURL;
							$cross = "";
						 }
						 else
						 {
							$cross = "hide";
							$path =  $this->config->item('admin_assets').'img/noimage.gif';
						}
                   
					?> 
                    
					<div class="m-t-20">

						<label class="imageview-label">Website Banner, Enter only .jpg and .png formats and img size 150 * 150</label>
						<div class="row">
                        <div class="input-field m-t-0 col s12 m2 imageview1">
                            <img width="150" id="ImagePreivew" src='<?php echo $path; ?>'>
                            <a id="webviewcross" class="cross1 <?=$cross?>" data-img="ImagePreivew" data-file="userfile" data-edit="editImageURL"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                        </div>
                        <div class="file-field input-fieldcol col s12 m10 m-t-10">
                            <input tabindex="999" class="file-path validate empty_validation_class" type="text" id="editImageURL" name = "editImageURL" value="<?php echo @$banner->ImageURL; ?>" readonly/>
                            <div class="btn">
                                <span>File</span>
                                <input  accept="image/*" type="file" name="userfile" id="userfile" class="fileuploading" data-cross="webviewcross" data-img="ImagePreivew" data-edit="editImageURL"/>
                            </div>
                        </div>
                    </div>
					</div>
					
					<?php  
				 if(isset($banner->MobileURL)&&$banner->MobileURL != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).BANNER_MOBILE_UPLOAD_PATH.$banner->MobileURL))) {
                            $path = base_url(). BANNER_MOBILE_UPLOAD_PATH . $banner->MobileURL;
                            $cross = "";
						 }
						 else
						 {
							$cross = "hide";
							$path =  $this->config->item('admin_assets').'img/noimage.gif';
						}
                       // echo $path ; 
					
					?> 
                    
					<div class="m-t-20">

						<label class="imageview-label">Mobile Banner, Enter only .jpg and .png formats and img size 150 * 150</label>
						<div class="row">
                        <div class="input-field m-t-0 col s12 m2 imageview1">
                            <img width="150" id="ImagePreivew1" src='<?php echo $path; ?>'>
                            <a id="webviewcross" class="cross2 <?=$cross?>" data-img="ImagePreivew1" data-file="userfile1" data-edit="editMobileURL"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                        </div>
                        <div class="file-field input-fieldcol col s12 m10 m-t-10">
                            <input tabindex="999" class="file-path validate empty_validation_class" type="text" id="editMobileURL" name = "editMobileURL" value="<?php echo @$banner->MobileURL; ?>" readonly/>
                            <div class="btn">
                                <span>File</span>
                                <input  accept="image/*" type="file" name="userfile1" id="userfile1" class="fileuploading" data-cross="webviewcross" data-img="ImagePreivew1" data-edit="editMobileURL"/>
                            </div>
                        </div>
                    </div>
					</div>
					<div class="row">
						<div class="input-field col s6 ">
                            <label><?php echo label('msg_lbl_type');?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
							<input name="Type" type="radio" id="Job" value="Job" <?php echo ((isset($banner->Type) && @$banner->Type == 'Job') || !isset($banner->Type)) ? 'checked="checked"' : '' ;?>>
							<label for="Job"><?php echo label('msg_lbl_job');?></label>
							<input name="Type" type="radio" id="Company" value="Company" <?php echo ((isset($banner->Type) && @$banner->Type == 'Company')) ? 'checked="checked"' : '' ;?>>
							<label for="Company"><?php echo label('msg_lbl_company');?></label>
							
						</div>

						<div class="input-field col s6">
							<a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_redirecturl');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="RedirectURL" name="RedirectURL" type="text" class="" value="<?php echo @$banner->RedirectURL; ?>"  maxlength="250" />
                            <label for="RedirectURL"><?php echo label('msg_lbl_redirecturl')?></label>
							
						</div>
					</div>
					
                    <div class="row">
                        <div class="input-field col s4">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($banner->Status) && @$banner->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status">Status</label>     
                        </div>
                        <div class="input-field col s4">
                        <input type="checkbox" class=""  name="IsCreative" id="IsCreative"   
                            <?php
                            if (isset($banner->IsCreative) && @$banner->IsCreative == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="IsCreative"><?php echo label('msg_lbl_iscreative');?></label>
                        </div>
                     
                        <div class="input-field col s4">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" >Submit

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/banner" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>