<div class="section">
    <div class="container">
        <div class="card-panel col s12">
            <h4 class="header m-t-0">
                <a href="<?php echo base_url() ?>admin/masters/category"><strong><?php echo label('msg_lbl_title_category')?></strong>
                </a>
            </h4>        
            <div class="row">
                <form class="col s12" id="addStateForm" method="post" action="<?php echo $this->config->item('base_url'); ?>admin/masters/category/<?php echo $page_name; ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="input-field col s12">
                            <a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_categoryname');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
                            <input id="CategoryName" name="CategoryName" type="text" class="empty_validation_class LetterOnly" value="<?php echo @$category->CategoryName; ?>"  maxlength="50" />
                            <label for="CategoryName"><?php echo label('msg_lbl_categoryname')?></label>
                        </div>
                         <div class="input-field col s12">
							<a class="tooltipped a-tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo label('msg_lbl_please_select_description');?>"><i class="<?php echo INFO_ICON_CLASS; ?>"></i></a>
							<textarea name="Description" id="Description" maxlength="500" class="materialize-textarea empty_validation_class"><?=@$category->Description?></textarea>
							<label for="Description"><?php echo label('msg_lbl_description')?></label>
						 </div>
                    </div>  
					<?php  
				  if(isset($category->ImageURL)&&$category->ImageURL != "" && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CATEGORY_UPLOAD_PATH.$category->ImageURL))) {
							$path = base_url(). CATEGORY_UPLOAD_PATH . $category->ImageURL;
							$cross = "";
						 }
						 else
						 {
							$cross = "hide";
							$path =  $this->config->item('admin_assets').'img/noimage.gif';
						}
					
					?> 
                    
					<div class="m-t-20">

						<label class="imageview-label">Enter only .jpg and .png formats and img size 150 * 150</label>
						<div class="row">
                        <div class="input-field m-t-0 col s12 m2 imageview1">
                            <img width="150" id="ImagePreivew" src='<?php echo $path; ?>'>
                            <a id="webviewcross" class="cross1 <?=$cross?>" data-img="ImagePreivew" data-file="userfile" data-edit="editImageURL"><i id="cal" class="fa fa-times" aria-hidden="true"></i></a>
                        </div>
                        <div class="file-field input-fieldcol col s12 m10 m-t-10">
                            <input tabindex="999" class="file-path validate empty_validation_class" type="text" id="editImageURL" name = "editImageURL" value='<?php echo @$category->ImageURL; ?>' readonly/>
                            <div class="btn">
                                <span>File</span>
                                <input  accept="image/*" type="file" name="userfile" id="userfile" class="fileuploading" data-cross="webviewcross" data-img="ImagePreivew" data-edit="editImageURL"/>
                            </div>
                        </div>
                    </div>
					</div>
                    <div class="row">
                        <div class="input-field col s6">

                            <input type="checkbox" class=""  name="Status" id="Status"   
                            <?php
                            if (isset($category->Status) && @$category->Status == INACTIVE) {
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
                            <a  href="<?php echo $this->config->item('base_url'); ?>admin/masters/category" class="right close-button">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>