<?php //print_r($advertisement);die();?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/advertisement"><strong><?php echo label('msg_lbl_title_advertisement')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/advertisement/<?php echo $page_name;?>" enctype="multipart/form-data">
                    <input id="AdvertisementID" name="AdvertisementID" value="<?php echo @$advertisement->AdvertisementID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_title');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Title" name="Title" type="text" class="empty_validation_class" value="<?php echo @$advertisement->Title; ?>"  maxlength="255" />
                            <label for="Title"><?php echo label('msg_lbl_title')?></label>
                        </div>
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_redirecturl');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="RedirectURL" name="RedirectURL" type="text" class="empty_validation_class" value="<?php echo @$advertisement->RedirectURL; ?>"  maxlength="255" />
                            <label for="RedirectURL"><?php echo label('msg_lbl_redirecturl')?></label>
                        </div>
                    </div>                      
                    <div class="row">
                    <div class="input-field col s6">
                        <label for="Position"><?php echo label('msg_lbl_position');?></label>
                            <br>
                            <input name="Position" type="radio" value="Horizontal" id="Horizontal" checked='checked'<?php
                                if (isset($advertisement->Position) && $advertisement->Position == "Horizontal"){ echo "";}
                                else{ echo "checked='checked'";}?>/>
                            <label for="Horizontal"><?php echo label('msg_lbl_horizontal')?></label>


                             <input name="Position" type="radio" value="Vertical" id="Vertical" <?php
                                if (isset($advertisement->Position) && $advertisement->Position == "Vertical"){echo "checked='checked'";}
                                else{echo "";}?> />
                            <label for="Vertical"><?php echo label('msg_lbl_vertical')?></label>

                            <input name="Position" type="radio" value="Cover" id="Cover" <?php
                                if (isset($advertisement->Position) && $advertisement->Position == "Cover"){echo "checked='checked'";}
                                else{echo "";}?> />
                            <label for="Cover"><?php echo label('msg_lbl_cover')?></label>
                        </div>
                     <div class="input-field col s6">
                        <label for="Type_t"><?php echo label('msg_lbl_type');?></label>
                            <br>
                            <input name="Type_t" type="radio" value="Text" id="tText" <?php
                                if (isset($advertisement->Type) && $advertisement->Type == "Text"){ echo "checked='checked'";}
                                else{ echo "checked='checked'";}?>/>
                            <label for="tText"><?php echo label('msg_lbl_text');?></label>


                             <input name="Type_t" type="radio" value="Image" id="tImage" <?php
                                if (isset($advertisement->Type) && $advertisement->Type == "Image"){echo "checked='checked'";}
                                else{echo "";}?> />
                            <label for="tImage"><?php echo label('msg_lbl_image');?></label>
                        </div>
                    </div>    
                    <div class="row">
                        <div id = "ttext_desc" class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_shortdescription');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <textarea name="ShortDescription" id="ShortDescription" class="materialize-textarea"><?php echo @$advertisement->ShortDescription; ?></textarea>
                            <label for="Title"><?php echo label('msg_lbl_shortdescription')?></label>
                        </div>
                    <div id = "timage_div" >
                           <?php 
                            if(@$advertisement->Type == 'Image'){
                                  if(isset($advertisement->ImageURL)&&$advertisement->ImageURL != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).ADVERTISEMENT_UPLOAD_PATH.$advertisement->ImageURL))) {
                                            $path = base_url(). ADVERTISEMENT_UPLOAD_PATH . $advertisement->ImageURL;
                                            $cross = "";
                                         }
                                         else
                                         {
                                            $cross = "hide";
                                            $path =  $this->config->item('admin_assets').'img/noimage.gif';
                                        }
                                }
                                else{
                                    $cross = "hide";
                                    $path =  $this->config->item('admin_assets').'img/text.png';
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
                                <input tabindex="999" class="file-path" type="text" id="editProfilePicture" name = "editProfilePicture" value='<?php echo @$advertisement->ImageURL; ?>' readonly/>
                                <div class="btn">
                                    <span>File</span>
                                    <input  accept="image/*" type="file" name="userfile" id="userfile" class="fileuploading" data-cross="webviewcross" data-img="ImagePreivew" data-edit="editProfilePicture"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>                  
                    <div class="row">
                        <div class="input-field col s12 m6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                                if (isset($advertisement->Status) && @$advertisement->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/advertisement" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>