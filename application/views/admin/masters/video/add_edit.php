<?php //print_r($video);die();?>
<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">

                <a href="<?php echo base_url() ?>admin/masters/mentor/details/<?php echo @$MentorUserrID; ?>#video_listing_page"><strong><?php echo label('msg_lbl_title_video')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/video/<?php echo $page_name; ?>" enctype="multipart/form-data">
                    <input id="VideoID" name="VideoID" value="<?php echo @$video->VideoID; ?>" type="hidden"  />
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_videotitle');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="VideoTitle" name="VideoTitle" type="text" class="empty_validation_class NumberLetterSpace" value="<?php echo @$video->VideoTitle; ?>"  maxlength="100" />
                            <label for="VideoTitle"><?php echo label('msg_lbl_video')?></label>
                        </div>
                         <div class="input-field col s12 m6 hide">
							<?= $user;?>
						 </div>
                    </div>
                    <div class="clearfix">
                        <label class="imageview-label">Enter only .mp4 formats</label>
                        <div class="">
                            <div class="file-field input-fieldcol col s12 m12 m-t-10">
                                <input tabindex="999" class="file-path empty_validation_class" type="text" id="editVideoURL" name = "editVideoURL" value='<?php echo @$video->VideoURL; ?>' readonly/>
                                <div class="btn">
                                    <span>Video</span>
                                    <input type="file" accept="image/*,video/*" name="userfile1" id="userfile1" class="video fileuploading" data-cross="webviewcross1" data-type="Video" data-img="VideoPreivew" data-edit="editVideoURL"/>
                                </div>
                            </div>
                        </div>
                   </div>  
                   <div class="row">  
                       <div class="input-field col s12 m6">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_description');?>"><i class="mdi-action-info"></i></a>
                            <textarea name="Description" id="Description" class="materialize-textarea empty_validation_class" maxlength="1000"><?php echo @$video->Description; ?></textarea>
                                <label for="Description" class=""><?php echo label('msg_lbl_description');?></label>
                        </div>
                        <div class="input-field col s12 m2">
                            <input type="checkbox" class=""  name="Flag" id="Flag"   
                            <?php
                            if (isset($video->Flag) && @$video->Flag == ACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Flag"><?php echo label('msg_lbl_flag');?></label> 
                        </div>
                        <div id="pricediv" class="input-field col s12 m4 <?php if((isset($video->Flag) && @$video->Flag == INACTIVE)||!isset($video->Flag)) echo "hide";?>">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_enter_price');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="Price" name="Price" type="text" class="AmountOnly" value="<?php echo @$video->Price; ?>"  maxlength="9" />
                            <label ID="pricelabel" for="Price" class="active"><?php echo label('msg_lbl_price'). " (". $config[0]->CurrencyCode.")"?></label>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="input-field col s4 m6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($video->Status) && @$video->Status == INACTIVE) {
                                echo "";
                            } else {
                                echo "checked='checked'";
                            }
                            ?>>
                            <label for="Status"><?php echo label('msg_lbl_status');?></label>     
                        </div>
                        <div class="input-field col s4 m6">
                            <button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit" ><?php echo label('msg_lbl_submit');?>

                            </button>
                            <?php echo $loading_button; ?>
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/mentor/details/<?php echo @$MentorUserrID;?>#video_listing_page" class="right close-button"><?php echo label('msg_lbl_cancel');?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>