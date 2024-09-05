<?php //print_r($candidate);die();
foreach ($allcandidate as $candidate) { ?>
    <tr class="gradeX" id="row_<?php echo $candidate->CompanyJobActionID; ?>">
         <?php 
         if($candidate->ProfilePic != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CANDIDATE_THUMB_UPLOAD_PATH.$candidate->ProfilePic))) {
                $path = site_url(CANDIDATE_THUMB_UPLOAD_PATH. $candidate->ProfilePic);
            }else {
                $path = site_url(DEFAULT_IMAGE);
            }
        ?> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('company/candidate/details/'.$candidate->UserID);?>">
            <img alt="<?php echo $candidate->ProfilePic;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'>
        </td> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('company/candidate/details/'.$candidate->UserID);?>"><?php echo $candidate->FirstName.' '.$candidate->LastName; ?></a>
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
        <td>
        <?php 
            if(@$JobStatus == "View" || @$JobStatus == "Applied" || @$JobStatus == "Shortlisted"){
                ?>
            <a href="javascript:void(0);" class="interview_action modal-trigger" data-id="<?php echo $candidate->UserID; ?>">Interview</a>
        <?php
            }
            if(@$JobStatus == "View" || @$JobStatus == "Applied" ){
        ?>
            <a href="javascript:void(0);" class="action_model modal-trigger" data-id="<?php echo $candidate->CompanyJobActionID; ?>" data-state="5" data-action="Shortlisted">
                Shortlist
            </a>
        <?php 
            }
            $action_model = "action_model";
            $label = "Remove";
            if(@$JobStatus == "Applied" || @$JobStatus == "Shortlisted" || @$JobStatus == "Invited" || @$JobStatus == "Accept" ){
                if(@$JobStatus != "Shortlisted"){
                    if(@$JobStatus == "Invited"){
                        if($candidate->Invited == 3){
                            $action_model = "already_decline";
                        }
                        $label = "Reject";
                    }else{
                        $label = "Decline";
                    }
                    $JobStatus = "Invited";
                }
        ?>
            <a href="javascript:void(0);" class="<?php echo $action_model;?> modal-trigger" data-id="<?php echo $candidate->CompanyJobActionID; ?>" data-state="6" data-action="<?php echo $JobStatus;?>">
                <?php echo $label;?>
            </a>
        <?php } ?>
            
        </td>
    </tr>
<?php } ?>   