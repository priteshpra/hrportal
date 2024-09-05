<?php 
    foreach ($qualification as $qualification) {  ?>

        <tr id="row_<?php echo $qualification->UserQualificationID; ?>">
               
            <td align="center"><?=$qualification->Qualification; ?></td>
            <td align="center"><?= $qualification->YearOfPassing; ?></td>
            <td align="center"><?= $qualification->University; ?></td>
            <td align="center"><?= $qualification->Grade; ?></td>
            <td align="center"><?php if($qualification->OtherGrade != null){ ?>
                <?php echo $qualification->OtherGrade; } else{echo '-';}?> 
            </td>
        </tr>
    <?php }
    ?>