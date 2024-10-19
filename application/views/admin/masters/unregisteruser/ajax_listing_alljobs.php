<?php //print_r($jobpost);die();
foreach ($alljobs as $jobpost) { ?>
    <tr class="gradeX" id="row_<?php echo $jobpost->JobPostID; ?>">
        <td><a class="txt-underline bold" href="<?php echo site_url('admin/masters/jobpost/details/'.$jobpost->JobPostID);?>"><?php echo $jobpost->JobTitle; ?></a></td>
        <td><a class="txt-underline bold" href="<?php echo site_url('admin/masters/company/details/'.$jobpost->CompanyID)?>"><?php echo $jobpost->CompanyName; ?></a></td>
        <td><?php echo $jobpost->Designation; ?></td>
        <td><?php echo $jobpost->IndustryType; ?></td>
        
            <?php 
            $MinExperienceYear = '';
            $MinExperienceMonth = '';
            $MaxExperienceYear = '';
            $MaxExperienceMonth = '';
            $MinExperience = '0';
            $MaxExperience = '0';
            if(isset($jobpost->MinExperience) && $jobpost->MinExperience > 0){
                 $MinExperienceYear = round(bcdiv($jobpost->MinExperience, 12));
                 $MinExperienceMonth = $jobpost->MinExperience - ($MinExperienceYear*12);

                 $MinExperience = ($MinExperienceYear>0) ? $MinExperienceYear.(($MinExperienceYear==1) ? 'Year ' : 'Years ') : '';
                 $MinExperience = ($MinExperienceMonth>0) ? $MinExperience.$MinExperienceMonth.(($MinExperienceMonth==1) ? 'Month ' : 'Months ') : $MinExperience;
            }
            if(isset($jobpost->MaxExperience) && $jobpost->MaxExperience > 0){
                 $MaxExperienceYear = round(bcdiv($jobpost->MaxExperience, 12));
                 $MaxExperienceMonth = $jobpost->MaxExperience - ($MaxExperienceYear*12);
                 $MaxExperience = ($MaxExperienceYear>0) ? $MaxExperienceYear.(($MaxExperienceYear==1) ? 'Year ' :'Years ') : '';
                 $MaxExperience = ($MaxExperienceMonth>0) ? $MaxExperience.$MaxExperienceMonth.(($MaxExperienceMonth==1) ? 'Month ' : 'Months ' ) : $MaxExperience;
            }
            ?>

        <td><?php echo $MinExperience." - ".$MaxExperience; ?></td>
        <td><?php echo $jobpost->NatureOfEmployment; ?></td>
        <td><?php echo $jobpost->MinSalary."-".$jobpost->MaxSalary; ?></td>
        <td>
            <?php 
            $tmp = array();
            $arr = json_decode($jobpost->Skills);
            foreach ($arr as $key => $value) {
                $tmp[] = $value->Name;
            }
            echo implode(',',$tmp);
            ?>
        </td>
        <td><a href="<?php echo ReturnUrl($jobpost->WebsiteURL); ?>" target="_blank"><?php echo $jobpost->WebsiteURL; ?></a></td>
        <td><?php echo $jobpost->MobileNo; ?></td>
        <td><?php echo $jobpost->JobStatus; ?></td>
        <td><?php echo $jobpost->NoOfVacancies; ?></td>
        <?php
            if($jobpost->ViewCount == 0){
                $viewlabel="Not viewed yet";
            }else{
                if($jobpost->ViewCount == 1){
                    $viewlabel=$jobpost->ViewCount." Candidate viewed";
                }else{
                    $viewlabel=$jobpost->ViewCount." Candidates viewed";
                }
                
            }
            if($jobpost->ApplyCount == 0){
                $applylabel="Not applied yet";
            }else{
                if($jobpost->ApplyCount == 1){
                    $applylabel=$jobpost->ApplyCount." Candidate applied";
                }else{
                    $applylabel=$jobpost->ApplyCount." Candidates applied";
                }
            }
            if($jobpost->InviteCount == 0){
                $invitedlabel="Not Invited yet";
            }else{
                if($jobpost->InviteCount == 1){
                    $invitedlabel=$jobpost->InviteCount." Candidate Invited";
                }else{
                    $invitedlabel=$jobpost->InviteCount." Candidates Invited";
                }
            }
            if($jobpost->ShortListCount == 0){
                $shotlistedlabel="Not Shortlisted yet";
            }else{
                if($jobpost->ShortListCount == 1){
                    $shotlistedlabel=$jobpost->ShortListCount." Candidate Shortlisted";
                }else{
                    $shotlistedlabel=$jobpost->ShortListCount." Candidates Shortlisted";
                }
            }
        ?>
        <td class="action center action-box-th">
            <a href="<?php echo site_url('admin/masters/jobpost/details/'.$jobpost->JobPostID.'#view_job');?>" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo @$jobpost->JobPostID; ?>">
                <i title="<?php echo $viewlabel;?>" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>
        <td class="action center action-box-th">
            <a href="<?php echo site_url('admin/masters/jobpost/details/'.$jobpost->JobPostID.'#all_applied');?>" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo @$jobpost->JobPostID; ?>">
                <i title="<?php echo $applylabel;?>" class="<?php echo APPLIED_ICON_CLASS; ?>"></i>
            </a>
        </td>
        <td class="action center action-box-th">
            <a href="<?php echo site_url('admin/masters/jobpost/details/'.$jobpost->JobPostID.'#all_invited');?>" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo @$jobpost->JobPostID; ?>">
                <i title="<?php echo $invitedlabel;?>" class="<?php echo INTERVIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>
        <td class="action center action-box-th">
            <a href="<?php echo site_url('admin/masters/jobpost/details/'.$jobpost->JobPostID.'#all_shortlisted');?>" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo @$jobpost->JobPostID; ?>">
                <i title="<?php echo $shotlistedlabel;?>" class="<?php echo SHORTLIST_ICON_CLASS; ?>"></i>
            </a>
        </td> 
    </tr>
<?php } ?>   