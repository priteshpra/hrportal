<?php foreach ($category as $category) { ?>
    <tr class="gradeX" id="row_<?php echo $category->CategoryID; ?>">
		<?php   //echo file_exists(str_replace('/system','',BASEPATH).CATEGORY_UPLOAD_PATH.$category->ImageURL);exit;
		  if(@$category->ImageURL != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CATEGORY_UPLOAD_PATH.$category->ImageURL))) {
					
					$path = base_url().CATEGORY_UPLOAD_PATH . $category->ImageURL;
				 }
				 else
				 {
					$path =  $this->config->item('admin_assets').'img/noimage.gif';
				}
		   ?> 
			 <td align="center"><img alt="<?php echo $category->ImageURL;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'></td> 
		   <td align="center"><?php echo $category->CategoryName; ?></td>
		   <td align="center"><?php echo $category->Description; ?></td>
		<?php
        if ($category->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        if(@$this->cur_module->is_status == 1){
            $status = CHANGE_STATUS;
        }
        ?>
		<td class="status action center status-box-th">
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $category->CategoryID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $category->CategoryID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $category->CategoryID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
		<td class="action center action-box-th"> 
        
        <?php if(@$this->cur_module->is_edit == 1){?>

            <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/masters/category/edit/<?php echo $category->CategoryID; ?>" style="cursor:pointer;">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
            &nbsp;&nbsp;
        <?php } ?>
			<a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $category->CategoryID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   