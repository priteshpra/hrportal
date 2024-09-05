<?php //pr($video);exit;
foreach ($video as $video) { ?>
    <tr class="gradeX" id="row_<?php echo $video->VideoID; ?>">
        <?php   

          if(@$video->ImageURL != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).VIDEOURL_THUMB_UPLOAD_PATH.$video->ImageURL))) {
                    
                    $path = base_url().VIDEOURL_THUMB_UPLOAD_PATH . $video->ImageURL;
                 }
                 else
                 {
                    $path =  $this->config->item('admin_assets').'img/noimage.gif';
                }
           ?> 
           <?php   

          if(@$video->VideoURL != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).VIDEOURL_UPLOAD_PATH.$video->VideoURL))) {
                    $v_path = base_url().VIDEOURL_UPLOAD_PATH . $video->VideoURL;
                 } else {
                    $v_path =  '';
                }
           ?> 
        <td align="center">
            <img alt="<?php echo $video->ImageURL;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'></td> 
		<td align="center"><?php echo $video->VideoTitle; ?></td>
        <td align="center"><?php echo $video->FirstName; ?></td>
		<td align="center"><?php if($v_path!=''){ ?><a href="<?php echo $v_path;?>" target="_blank"><?php }else{ echo '<a href="#">'; } ?> <?php echo $video->VideoURL; ?></a></td>
        <td align="center"><?php 
                if($video->Flag == 0)
                    {echo "Free";}
                else{echo "Paid "."(".$video->Price.")";} 
            ?></td>
		<?php
        if ($video->Status == ACTIVE) {
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $video->VideoID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $video->VideoID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $video->VideoID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
		<td class="action center action-box-th"> 
        
        <?php if(@$this->cur_module->is_edit == 1){?>

            <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/masters/video/edit/<?php echo $video->VideoID; ?>/<?php echo $video->UserID; ?>" style="cursor:pointer;">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
            &nbsp;&nbsp;
        <?php } ?>
			<a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $video->VideoID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   