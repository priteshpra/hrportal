<?php //print_r($allinvite);die();
foreach ($allinvite as $allinvite) { ?>
    <tr class="gradeX" id="row_<?php echo $allinvite->UserID; ?>">

    	<?php 
         if($allinvite->ProfilePicOrgName != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CANDIDATE_THUMB_UPLOAD_PATH.$allinvite->ProfilePicOrgName))) {
         	$path = site_url(CANDIDATE_THUMB_UPLOAD_PATH . $allinvite->ProfilePicOrgName);
            }else {
                $path =  site_url(DEFAULT_IMAGE);
            }
        ?> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/masters/candidate/details/'.$allinvite->UserID);?>">
                <img alt="<?php echo $allinvite->ProfilePic;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'>
            </a>
        </td> 
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/masters/candidate/details/'.$allinvite->UserID);?>"><?php echo $allinvite->FirstName.' '.$allinvite->LastName; ?></a>
        </td>
        <td><a href = "mailto:<?php $allinvite->EmailID; ?>"><?php echo $allinvite->EmailID; ?></a></td>
        <td><?php echo $allinvite->MobileNo; ?></td>
        <td><?php echo $allinvite->CityName; ?></td>
        <td><?php echo ($allinvite->Salary != "")?SalaryComma($allinvite->Salary):""; ?></td>
        <td><?php echo $allinvite->Gender; ?></td>
        <td><?php echo $allinvite->Skills; ?></td>
        <td><?php echo $allinvite->Designation; ?></td>
        <td><?php echo $allinvite->IsExperience; ?></td>
        <td> 
        <?php if($allinvite->CVPath != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).CV_UPLOAD_PATH.$allinvite->CVPath))) { ?>
            <a download href="<?php echo site_url(CV_UPLOAD_PATH.$candidate->CVPath);?>"><?php echo $candidate->CVName; ?></a>
            <?php }else{echo '-';}?>
        </td>
        <td><?php if($allinvite->CurrentState == '4'){
        	echo 'Invited';
        	}elseif($allinvite->CurrentState == '5'){
        	echo 'Accepted';
        	}elseif($allinvite->CurrentState == '6'){
        	echo 'Decline';
        	} ?></td>
                                 
    </tr>
<?php } ?>   