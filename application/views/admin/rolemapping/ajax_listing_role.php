<?php foreach ($roles as $role) { ?>
    <tr class="gradeX" id="row_<?php echo $role->RoleID; ?>">

        <td align="center"><?php echo $role->FirstName . " " . $role->LastName; ?></td>
        <td><?php echo $role->RoleName; ?></td>


        <td class="center action">

            <a class="btn-floating waves-effect waves-light blue" href="<?php echo $this->config->item('base_url'); ?>admin/rolemapping/add/<?php echo $role->RoleID; ?>" style="cursor:pointer;">
                <i class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
            <!-- &nbsp;&nbsp;
            <a class="info bgglobal modal-trigger btn-floating waves-effect" href="#modal1" data-role-id="<?php echo $role->RoleID; ?>">
                <i class="<?php echo VIEW_ICON_CLASS; ?>" style="width: 16px; height: 16px;"></i>
            </a> -->
        </td>                                                                                                                                                                            
    </tr>
<?php } ?>   