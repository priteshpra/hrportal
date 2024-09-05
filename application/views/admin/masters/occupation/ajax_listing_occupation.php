<?php foreach ($occupation as $occupation) { ?>
    <tr class="gradeX" id="row_<?php echo $occupation->OccupationID; ?>">

        <td align="center"><?php echo $occupation->Name; ?></td>

        <?php
        if ($occupation->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        ?>


        <td class="center action">

            <i class="<?php echo INACTIVE_ICON_CLASS . ' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-occupation-id="<?php echo $occupation->OccupationID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>

            <i class="<?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-occupation-id="<?php echo $occupation->OccupationID; ?>"></i>

            <i class="<?php echo ACTIVE_ICON_CLASS . ' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-occupation-id="<?php echo $occupation->OccupationID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
            <span style="display:none;"><?php echo $occupation->Status; ?></span> 
        </td>


        <td class="center action">

            <a class="btn-floating waves-effect waves-light blue" href="<?php echo $this->config->item('base_url'); ?>admin/masters/occupation/edit/<?php echo $occupation->OccupationID; ?>" style="cursor:pointer;">
                <i class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
            &nbsp;&nbsp;
            <a class="info bgglobal modal-trigger btn-floating waves-effect" href="#modal1" data-occupation-id="<?php echo $occupation->OccupationID; ?>" >
                <i class="<?php echo VIEW_ICON_CLASS; ?>" style="width: 16px; height: 16px;"></i>
            </a>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   