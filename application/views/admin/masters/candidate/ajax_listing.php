<?php //print_r($candidate);die();
foreach ($candidate as $candidate) { ?>
    <tr class="gradeX" id="row_<?php echo $candidate->UserID; ?>">
		 <?php 
         if($candidate->ProfilePic != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CANDIDATE_THUMB_UPLOAD_PATH.$candidate->ProfilePic))) {
                $path = site_url(CANDIDATE_THUMB_UPLOAD_PATH. $candidate->ProfilePic);
            }else {
                $path = site_url(DEFAULT_IMAGE);
            }
        ?> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/masters/candidate/details/'.$candidate->UserID);?>">
            <img alt="<?php echo $candidate->ProfilePic;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'>
        </td> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/masters/candidate/details/'.$candidate->UserID);?>"><?php echo $candidate->FirstName.' '.$candidate->LastName; ?></a>
        </td>
        <td><a href = "mailto:<?php $candidate->EmailID; ?>"><?php echo $candidate->EmailID; ?></a></td>
        <td><?php echo $candidate->MobileNo; ?></td>
        <td><?php echo $candidate->OTP; ?></td>
        <td><?php echo $candidate->CityName; ?></td>
        <td><?php echo ($candidate->Salary != "")?SalaryComma($candidate->Salary):""; ?></td>
        <td><?php echo $candidate->Gender; ?></td>
        <td><?php echo $candidate->Skills; ?></td>
        <td><?php echo $candidate->Designation; ?></td>
        <td><?php echo $candidate->IsExperience; ?></td>
        <td>
           <?php if($candidate->CVPath != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CV_UPLOAD_PATH.$candidate->CVPath))) { ?>
            <a href="<?php echo site_url(CV_UPLOAD_PATH.$candidate->CVPath); ?>" download><?php echo $candidate->CVName; ?>
            
            </a>
            <?php }else{echo '-';}?>
        </td>
		<?php
        if ($candidate->Status == ACTIVE) {
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
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status .' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $candidate->UserID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $candidate->UserID; ?>"></i>
			<i title="Active"  class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status .' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $candidate->UserID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
		<td class="action center action-box-th"> 
        
        <?php if(@$this->cur_module->is_edit == 1){?>

            <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/masters/candidate/edit/<?php echo $candidate->UserID; ?>" style="cursor:pointer;">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
            &nbsp;&nbsp;
        <?php } ?>
			<a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $candidate->UserID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   