<?php foreach ($month as $month) { ?>

    <tr id="row_<?php echo $month->id; ?>">   
        <td align="center"><?php echo $month->month; ?></td>
        <?php
        if ($month->Status == ACTIVE) {
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
            <i title="Inactive" class="<?php echo INACTIVE_ICON_CLASS .' ' . @$status . ' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-month-id="<?php echo $month->id; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="<?php echo LOADING_ICON_CLASS; ?> btn-floating waves-effect waves-light green hide" data-icon-type="loading" data-month-id="<?php echo $month->id; ?>"></i>
            <i title="Active" class="<?php echo ACTIVE_ICON_CLASS .' ' . @$status . ' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-month-id="<?php echo $month->id; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>    
        <td class="action center">
        <?php if(@$this->cur_module->is_edit == 1){?>
            <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/month/edit/<?php echo $month->id; ?>" style="cursor:pointer;" class="btn-floating waves-effect waves-light blue"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;"></i>
            </a>
            &nbsp;&nbsp;
        <?php } ?>
            <a class="info bgglobal modal-trigger btn-floating waves-effect" href="#modal1" data-month-id="<?php echo $month->id; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>" style="width: 16px; height: 16px;"></i>
            </a>
        </td>      
    </tr>
<?php }
?>




