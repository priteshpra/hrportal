<?php //print_r($candidate);die();
foreach ($candidate as $candidate) { ?>
    <tr class="gradeX" id="row_<?php echo $candidate->ID; ?>">
        <?php
        if ($candidate->ProfilePic != null && (file_exists(str_replace(array('\\', '/system'), array('/', ''), BASEPATH) . CANDIDATE_THUMB_UPLOAD_PATH . $candidate->ProfilePic))) {
            $path = site_url(CANDIDATE_THUMB_UPLOAD_PATH . $candidate->ProfilePic);
        } else {
            $path = site_url(DEFAULT_IMAGE);
        }
        ?>
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/masters/unregisteruser/details/' . $candidate->ID); ?>"><?php echo $candidate->FirstName . ' ' . $candidate->LastName; ?></a>
        </td>
        <td><a href="mailto:<?php $candidate->EmailID; ?>"><?php echo $candidate->EmailID; ?></a></td>
        <td><?php echo $candidate->ContactNumber; ?></td>
        <td>
            <?php
            if ($candidate->File != '') { ?>
                <a href="<?php echo 'https://unique-hr.com/assets/uploads/resume/' . $candidate->File; ?>" download><?php echo $candidate->File; ?>
                </a>
            <?php } else {
                echo '-';
            } ?>
        </td>
        <?php
        if ($candidate->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        if (@$this->cur_module->is_status == 1) {
            $status = CHANGE_STATUS;
        }
        ?>
        <td class="action center action-box-th">

            <?php if (@$this->cur_module->is_edit == 1) { ?>

                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/masters/unregisteruser/swap/<?php echo $candidate->ID; ?>" style="cursor:pointer;">
                    <i title="Convert to Candidate" class="fa fa-twitch" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?>
            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $candidate->ID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>
    </tr>
<?php } ?>