<?php //print_r($employee);die();
    foreach ($employee as $employee) {  ?>
    <tr class="gradeX" id="row_<?php echo $employee->UserID; ?>">
        <td><?php echo $employee->FirstName.' '.$employee->LastName; ?>
        </td>
        <td><?php echo $employee->Designation; ?></td>
        <td><a href="mailto:<?php echo $employee->EmailID; ?>" target="_blank"><?php echo $employee->EmailID; ?></a></td>
        <td><?php echo $employee->MobileNo; ?></td>
        <td class="action center action-box-th">
         <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/masters/company/editemployee/<?php echo $employee->UserID; ?>" style="cursor:pointer;">
                <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                </i>
            </a>
        </td>
        </tr>
    <?php }
    ?>  