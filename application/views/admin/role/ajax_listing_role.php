<?php foreach ($roles as $role) { ?>
    <tr class="gradeX" id="row_<?php echo $role->RoleID; ?>">

        <td align="center"><a class="txt-underline bold" href="<?php echo site_url('admin/rolemapping/index/'.$role->RoleID);?>"><?php echo $role->RoleName; ?></a></td>

        <?php
        if ($role->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        ?>


<!--        <td class="center action">

            <i class="<?php echo INACTIVE_ICON_CLASS . ' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-role-id="<?php echo $role->RoleID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>

            <i class="<?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-role-id="<?php echo $role->RoleID; ?>"></i>

            <i class="<?php echo ACTIVE_ICON_CLASS . ' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-role-id="<?php echo $role->RoleID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
            <span style="display:none;"><?php echo $role->Status; ?></span> 
        </td>-->


        <td class="center action">

            <a class="btn-floating waves-effect waves-light blue" href="<?php echo $this->config->item('base_url'); ?>admin/role/edit/<?php echo $role->RoleID; ?>" style="cursor:pointer;">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
            &nbsp;&nbsp;
            <a class="info bgglobal modal-trigger btn-floating waves-effect" href="#modal1" data-role-id="<?php echo $role->RoleID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>" style="width: 16px; height: 16px;"></i>
            </a>
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   