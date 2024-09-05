<?php 
    foreach ($employment as $employment) {  ?>

        <tr id="row_<?php echo $employment->UserEmployementID; ?>">
               
            <td><?=$employment->OrganizationOther; ?></td>
            <td><?=$employment->Designation; ?></td>
            <td><?php if($employment->IsPresent == 1){echo 'Yes';}else{echo '-';}; ?></td>

            <td><?php echo ($employment->StartDate != "")?GetDateInFormat($employment->StartDate):""; ?></td>
            <td><?php if($employment->IsPresent == 1){echo '-';}else{echo ($employment->EndDate != "")?GetDateInFormat($employment->EndDate):"";} ?></td>
        </tr>
    <?php }
    ?>