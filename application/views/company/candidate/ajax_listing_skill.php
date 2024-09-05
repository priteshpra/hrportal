<?php 
    foreach ($skill as $skill) {  ?>

        <tr id="row_<?php echo $skill->UserSkillID; ?>">
               
            <td><?=$skill->SkillName; ?></td>
        </tr>
    <?php }
    ?>