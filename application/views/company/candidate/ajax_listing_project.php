<?php 
    foreach ($project as $project) {  ?>

        <tr id="row_<?php echo $project->UserProjectID; ?>">
               
            <td><?=$project->ProjectTitle; ?></td>
            <td><?=$project->ProjectDescription; ?></td>
            <td><?=$project->Client; ?></td>
            <td><?=$project->TeamSize; ?></td>
            <td><?=$project->ProjectSite ?></td>
            <td><?php echo ($project->StartedFrom != "")?GetDateInFormat($project->StartedFrom):""; ?></td>
            <td><?php echo ($project->WorkedTill != "")?GetDateInFormat($project->WorkedTill):""; ?></td>
            <td><?=$project->NatureOfEmployement;?></td>
            <td><?=$project->Designation; ?></td>
            <td><?=$project->DesignationDescription; ?></td>
        </tr>
    <?php }
    ?>