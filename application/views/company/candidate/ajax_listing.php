<?php 
foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->UserID; ?>">
		 <?php 
         
         if($data->ProfilePicOrgName != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CANDIDATE_THUMB_UPLOAD_PATH.$data->ProfilePicOrgName))) {
                $path = site_url(CANDIDATE_THUMB_UPLOAD_PATH. $data->ProfilePicOrgName);
            }else {
                $path = site_url(DEFAULT_IMAGE);
            }
        ?> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('company/candidate/details/'.$data->UserID);?>">
            <img alt="<?php echo @$data->ProfilePicOrgName;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'>
        </td> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('company/candidate/details/'.$data->UserID);?>"><?php echo $data->FirstName.' '.$data->LastName; ?></a>
        </td>
        <td><a href = "mailto:<?php $data->EmailID; ?>"><?php echo $data->EmailID; ?></a></td>
        <td><?php echo $data->MobileNo; ?></td>
        <td><?php echo $data->CityName; ?></td>
        <td><?php echo ($data->Salary != "")?SalaryComma($data->Salary):""; ?></td>
        <td><?php echo $data->Gender; ?></td>
        <td><?php echo $data->Skills; ?></td>
        <td><?php echo $data->Designation; ?></td>
        <td><?php echo $data->IsExperience; ?></td>
        <td>
        
           <?php if($data->CVPathOrgName != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CV_UPLOAD_PATH.$data->CVPathOrgName))) { ?>
            <a href="<?php echo site_url(CV_UPLOAD_PATH.$data->CVPathOrgName); ?>" download><?php echo $data->CVName; ?>
            
            </a>
            <?php }else{echo '-';}?>
        </td>
        <?php 
        if($Type == "DirectInvited"){
            echo "<td>". $data->InterviewScheduled."</td>";
        }
        ?>
		<td class="action center action-box-th"> 

            <?php
            if($Type == "DirectInvited" && $InterviewType == "Invited"){
                    ?>
                <a href="javascript:void(0);" class="reject_action modal-trigger" data-type="Reject" data-id="<?php echo $data->CompanyJobActionID; ?>" data-action="Invited">
                Reject
                </a>
                <?php
            }else if($Type == "DirectInvited" && $InterviewType == "Accept"){
                ?>
                <a href="javascript:void(0);" class="reject_action modal-trigger" data-type="Reject" data-id="<?php echo $data->CompanyJobActionID; ?>" data-action="Accept">
                Reject
                </a>
                <a href="javascript:void(0);" class="hire_action modal-trigger" data-type="Hire" data-id="<?php echo $data->UserID; ?>">
                Hire
                </a>
                <?php
            }else if($Type == "HiredDecline"){
                echo $data->Reason;
            }else if($Type == "Hired"){
                echo $data->JobTitle;
            }else if($Type == "All"){
                ?>
                <a href="javascript:void(0);" class="interview_action modal-trigger" data-id="<?php echo $data->UserID; ?>">
                Interview
                </a>
                <?php
            }
            ?>
            
        </td>
    </tr>
<?php } ?>   