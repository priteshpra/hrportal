<?php foreach ($year as $year) { ?>

    <tr id="row_<?php echo $year->id; ?>">   
        <td align="center"><?php echo $year->year; ?></td>
        <td align="center"><?php echo $year->yearDuration; ?></td>
        <?php
        if ($year->Status == ACTIVE) {
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
        <td class="action center">
            <i title="Inactive" class="<?php echo AINACTIVE_ICON_CLASS .  ' ' . @$status .' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-year-id="<?php echo $year->id; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="<?php echo LOADING_ICON_CLASS; ?> btn-floating waves-effect waves-light green hide" data-icon-type="loading" data-year-id="<?php echo $year->id; ?>"></i>
            <i title="Active" class="<?php echo AACTIVE_ICON_CLASS .  ' ' . @$status .' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-year-id="<?php echo $year->id; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>    
        <td class="action center">
            <?php if(@$this->cur_module->is_edit == 1){?>
            <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/year/edit/<?php echo $year->id; ?>" style="cursor:pointer;" class="btn-floating waves-effect waves-light blue"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;"></i>
            </a>
            &nbsp;&nbsp;
            <?php } ?>
            <a class="info bgglobal modal-trigger btn-floating waves-effect" href="#modal1" data-year-id="<?php echo $year->id; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>" style="width: 16px; height: 16px;"></i>
            </a>
        </td>      
    </tr>
<?php }
?>




