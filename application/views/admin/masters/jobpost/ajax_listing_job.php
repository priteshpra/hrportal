<?php //print_r($candidate);die();
foreach ($allcandidate as $candidate) { ?>
    <tr class="gradeX" id="row_<?php echo $candidate->UserID; ?>">
         <?php 
         if($candidate->ProfilePic != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CANDIDATE_THUMB_UPLOAD_PATH.$candidate->ProfilePic))) {
                $path = site_url(CANDIDATE_THUMB_UPLOAD_PATH. $candidate->ProfilePic);
            }else {
                $path = site_url(DEFAULT_IMAGE);
            }
        ?> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/masters/candidate/details/'.$candidate->UserID);?>">
            <img alt="<?php echo $candidate->ProfilePic;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'>
        </td> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/masters/candidate/details/'.$candidate->UserID);?>"><?php echo $candidate->FirstName.' '.$candidate->LastName; ?></a>
        </td>
        <td><a href = "mailto:<?php $candidate->EmailID; ?>"><?php echo $candidate->EmailID; ?></a></td>
        <td><?php echo $candidate->MobileNo; ?></td>
        <td><?php echo $candidate->CityName; ?></td>
        <td><?php echo ($candidate->Salary != "")?SalaryComma($candidate->Salary):""; ?></td>
        <td><?php echo $candidate->Gender; ?></td>
        <td><?php echo $candidate->Skills; ?></td>
        <td><?php echo $candidate->Designation; ?></td>
        <td><?php echo $candidate->IsExperience; ?></td>
        <td>
           <?php if($candidate->CVPath != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CV_UPLOAD_PATH.$candidate->CVPath))) { ?>
            <a href="<?php echo site_url(CV_UPLOAD_PATH.$candidate->CVPath); ?>" download><?php echo $candidate->CVName; ?>
            
            </a>
            <?php }else{echo '-';}?>
        </td>
    </tr>
<?php } ?>   