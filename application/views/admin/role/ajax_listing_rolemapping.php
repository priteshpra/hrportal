<?php 
    //pr($rolemapping);exit;
    foreach ($rolemapping as $rolemapping) {  ?>

        <tr id="row_<?php echo $rolemapping->RoleID; ?>">
            <td><?= ($rolemapping->RoleName != '') ? $rolemapping->RoleName : '-'; ?></td>
             <td><?=@$rolemapping->UserType; ?></td>
            <td><?=@$rolemapping->Name; ?></td>
            <td><?=@$rolemapping->Description; ?></td>
         
        </tr>
    <?php }
    ?>