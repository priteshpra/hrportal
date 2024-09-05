<?php //print_r($allcandidate);die();
    foreach ($allcandidate as $allcandidate) {  ?>
    <tr>
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/masters/candidate/details/'.$allcandidate->UserID);?>">
            <?php echo $allcandidate->FirstName.' '.$allcandidate->LastName; ?>
            </a>
        </td>
        <td><a href="mailto:<?php echo $allcandidate->EmailID; ?>" target="_blank"><?php echo $allcandidate->EmailID; ?></a></td>
        <td><?php echo $allcandidate->MobileNo; ?></td>
        <td><?php echo ($allcandidate->Skills == "")?" - ":$allcandidate->Skills; ?></td>
        <td><?php echo $allcandidate->CityName; ?></td>
        <td><?php echo $allcandidate->PermenantAddress; ?></td>
        <td><?php echo ($allcandidate->Salary == 0)?' - ':$allcandidate->Salary; ?></td>
        <td><?php echo date("m-d-Y",strtotime($allcandidate->DOB)); ?></td>
        <td><?php echo $allcandidate->Gender; ?></td>
        <td><?php if($allcandidate->IsPhysicalChallenged == '1'){echo 'Yes';}else{echo 'No';} ?></td>
        <td><?php echo $allcandidate->MaritualStatus; ?></td>
        <td><?php echo $allcandidate->IsExperience; ?></td>
        
        </tr>
    <?php }
    ?>  