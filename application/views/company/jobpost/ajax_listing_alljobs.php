<?php //print_r($href);
    foreach ($alljobs as $alljobs) {  ?>

        <tr id="row_<?php echo $alljobs->JobPostID; ?>">
            <td>
                <a class="txt-underline bold" href="<?php echo site_url('company/jobpost/details/'.$alljobs->JobPostID);?>"><?php echo $alljobs->JobTitle; ?></a>
            </td>
            <td><?=$alljobs->IndustryType; ?></td>
            <td><?=$alljobs->Designation; ?></td>
            <td><?=$alljobs->NatureOfEmployment; ?></td>
            <td><?php if(($alljobs->MinExperienceYear) == 0){
                $label = "Month";
                if($alljobs->MinExperienceMonth > 1){
                    $label = "Months";
                }
               echo $alljobs->MinExperienceMonth.' '.$label;
            } else{
                $ylabel = "Year";
                $mlabel = "Month";
                if($alljobs->MinExperienceYear > 1){
                    $ylabel = "Years";
                }
                if($alljobs->MinExperienceMonth > 1){
                    $mlabel = "Months";
                }
                if($alljobs->MinExperienceMonth == 0){
                    echo $alljobs->MinExperienceYear.' '.$ylabel;
                }else{
                    echo $alljobs->MinExperienceYear.' '.$ylabel.' '.$alljobs->MinExperienceMonth.' '.$mlabel;     
                }
               
            }?></td>
            <td><?php if(($alljobs->MaxExperienceYear) == 0){
                $label = "Month";
                if($alljobs->MaxExperienceMonth > 1){
                    $label = "Months";
                }
               echo $alljobs->MaxExperienceMonth.' '.$label;
            } else{
                $ylabel = "Year";
                $mlabel = "Month";
                if($alljobs->MaxExperienceYear > 1){
                    $ylabel = "Years";
                }
                if($alljobs->MaxExperienceMonth > 1){
                    $mlabel = "Months";
                }
                if($alljobs->MaxExperienceMonth == 0){
                    echo $alljobs->MaxExperienceYear.' '.$ylabel;
                }else{
                    echo $alljobs->MaxExperienceYear.' '.$ylabel.' '.$alljobs->MaxExperienceMonth.' '.$mlabel;     
                }
               
            }?></td> 
            <td><?php echo ($alljobs->MinSalary.'-'.$alljobs->MaxSalary != "")?SalaryComma($alljobs->MinSalary).'-'.SalaryComma($alljobs->MaxSalary):""; ?></td>
            <td><?=$alljobs->JobStatus; ?></td>   
            
            <?php
            if($alljobs->ViewCount == 0){
                $viewlabel="Not viewed yet";
            }else{
                if($alljobs->ViewCount == 1){
                    $viewlabel=$alljobs->ViewCount." Candidate viewed";
                }else{
                    $viewlabel=$alljobs->ViewCount." Candidates viewed";
                }
                
            }
            if($alljobs->ApplyCount == 0){
                $applylabel="Not applied yet";
            }else{
                if($alljobs->ApplyCount == 1){
                    $applylabel=$alljobs->ApplyCount." Candidate applied";
                }else{
                    $applylabel=$alljobs->ApplyCount." Candidates applied";
                }
            }
            if($alljobs->InviteCount == 0){
                $invitedlabel="Not Invited yet";
            }else{
                if($alljobs->InviteCount == 1){
                    $invitedlabel=$alljobs->InviteCount." Candidate Invited";
                }else{
                    $invitedlabel=$alljobs->InviteCount." Candidates Invited";
                }
            }
            if($alljobs->ShortListCount == 0){
                $shotlistedlabel="Not Shortlisted yet";
            }else{
                if($alljobs->ShortListCount == 1){
                    $shotlistedlabel=$alljobs->ShortListCount." Candidate Shortlisted";
                }else{
                    $shotlistedlabel=$alljobs->ShortListCount." Candidates Shortlisted";
                }
            }
                ?>
            <td class="action center action-box-th">
                <a href="<?php echo site_url('company/jobpost/details/'.$alljobs->JobPostID.'#view_job');?>" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo @$alljobs->JobPostID; ?>">
                    <i title="<?php echo $viewlabel;?>" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
                </a>
            </td>
            <td class="action center action-box-th">
                <a href="<?php echo site_url('company/jobpost/details/'.$alljobs->JobPostID.'#all_applied');?>" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo @$alljobs->JobPostID; ?>">
                    <i title="<?php echo $applylabel;?>" class="<?php echo APPLIED_ICON_CLASS; ?>"></i>
                </a>
            </td>
            <td class="action center action-box-th">
                <a href="<?php echo site_url('company/jobpost/details/'.$alljobs->JobPostID.'#all_invited');?>" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo @$alljobs->JobPostID; ?>">
                    <i title="<?php echo $invitedlabel;?>" class="<?php echo INTERVIEW_ICON_CLASS; ?>"></i>
                </a>
            </td>
            <td class="action center action-box-th">
                <a href="<?php echo site_url('company/jobpost/details/'.$alljobs->JobPostID.'#all_shortlisted');?>" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo @$alljobs->JobPostID; ?>">
                    <i title="<?php echo $shotlistedlabel;?>" class="<?php echo SHORTLIST_ICON_CLASS; ?>"></i>
                </a>
            </td>
            <td class="action center action-box-th"> 
                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>company/jobpost/edit/<?php echo $alljobs->JobPostID; ?>" style="cursor:pointer;">
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>"  data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                    </i>
                </a>
            </td> 
        </tr>
    <?php }
    ?>