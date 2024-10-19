<?php //print_r($jobpost);die();
foreach ($jobpost as $jobpost) {  ?>
    <tr class="gradeX" id="row_<?php echo $jobpost->JobPostID; ?>">
        <td><a class="txt-underline bold" href="<?php echo site_url('admin/masters/jobpost/details/' . $jobpost->JobPostID); ?>"><?php echo $jobpost->JobTitle; ?></a></td>
        <td><a class="txt-underline bold" href="<?php echo site_url('admin/masters/company/details/' . $jobpost->CompanyID) ?>"><?php echo $jobpost->CompanyName; ?></a></td>
        <td><?php echo $jobpost->Designation; ?></td>
        <td><?php echo $jobpost->IndustryType; ?></td>

        <?php
        $MinExperienceYear = '';
        $MinExperienceMonth = '';
        $MaxExperienceYear = '';
        $MaxExperienceMonth = '';
        $MinExperience = '0';
        $MaxExperience = '0';
        if (isset($jobpost->MinExperience) && $jobpost->MinExperience > 0) {
            $MinExperienceYear = round(bcdiv($jobpost->MinExperience, 12));
            $MinExperienceMonth = $jobpost->MinExperience - ($MinExperienceYear * 12);

            $MinExperience = ($MinExperienceYear > 0) ? $MinExperienceYear . (($MinExperienceYear == 1) ? 'Year ' : 'Years ') : '';
            $MinExperience = ($MinExperienceMonth > 0) ? $MinExperience . $MinExperienceMonth . (($MinExperienceMonth == 1) ? 'Month ' : 'Months ') : $MinExperience;
        }
        if (isset($jobpost->MaxExperience) && $jobpost->MaxExperience > 0) {
            $MaxExperienceYear = round(bcdiv($jobpost->MaxExperience, 12));
            $MaxExperienceMonth = $jobpost->MaxExperience - ($MaxExperienceYear * 12);
            $MaxExperience = ($MaxExperienceYear > 0) ? $MaxExperienceYear . (($MaxExperienceYear == 1) ? 'Year ' : 'Years ') : '';
            $MaxExperience = ($MaxExperienceMonth > 0) ? $MaxExperience . $MaxExperienceMonth . (($MaxExperienceMonth == 1) ? 'Month ' : 'Months ') : $MaxExperience;
        }
        $MinExperience = $jobpost->MinExperienceYears;
        $MaxExperience = $jobpost->MaxExperienceYears;
        ?>

        <td><?php echo $MinExperience . " - " . $MaxExperience; ?></td>
        <td><?php echo $jobpost->NatureOfEmployment; ?></td>
        <td><?php echo $jobpost->MinSalary . "-" . $jobpost->MaxSalary; ?></td>
        <td>
            <?php
            $tmp = array();
            $arr = json_decode($jobpost->Skills);
            foreach ($arr as $key => $value) {
                $tmp[] = $value->Name;
            }
            echo implode(',', $tmp);
            ?>
        </td>
        <td><a href="<?php echo ReturnUrl($jobpost->WebsiteURL); ?>" target="_blank"><?php echo $jobpost->WebsiteURL; ?></a></td>
        <td><?php echo $jobpost->MobileNo; ?></td>
        <td><?php echo $jobpost->JobStatus; ?></td>
        <td><?php echo $jobpost->NoOfVacancies; ?></td>
        <?php
        if ($jobpost->ViewCount == 0) {
            $viewlabel = "Not viewed yet";
        } else {
            if ($jobpost->ViewCount == 1) {
                $viewlabel = $jobpost->ViewCount . " Candidate viewed";
            } else {
                $viewlabel = $jobpost->ViewCount . " Candidates viewed";
            }
        }
        if ($jobpost->ApplyCount == 0) {
            $applylabel = "Not applied yet";
        } else {
            if ($jobpost->ApplyCount == 1) {
                $applylabel = $jobpost->ApplyCount . " Candidate applied";
            } else {
                $applylabel = $jobpost->ApplyCount . " Candidates applied";
            }
        }
        if ($jobpost->InviteCount == 0) {
            $invitedlabel = "Not Invited yet";
        } else {
            if ($jobpost->InviteCount == 1) {
                $invitedlabel = $jobpost->InviteCount . " Candidate Invited";
            } else {
                $invitedlabel = $jobpost->InviteCount . " Candidates Invited";
            }
        }
        if ($jobpost->ShortListCount == 0) {
            $shotlistedlabel = "Not Shortlisted yet";
        } else {
            if ($jobpost->ShortListCount == 1) {
                $shotlistedlabel = $jobpost->ShortListCount . " Candidate Shortlisted";
            } else {
                $shotlistedlabel = $jobpost->ShortListCount . " Candidates Shortlisted";
            }
        }
        ?>
        <td class="action center action-box-th">
            <a href="<?php echo site_url('admin/masters/jobpost/details/' . $jobpost->JobPostID . '#view_job'); ?>" class="modal-trigger btn-floating waves-effect waves-light black">
                <i title="<?php echo $viewlabel; ?>" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>
        <td class="action center action-box-th">
            <a href="<?php echo site_url('admin/masters/jobpost/details/' . $jobpost->JobPostID . '#all_applied'); ?>" class="modal-trigger btn-floating waves-effect waves-light black">
                <i title="<?php echo $applylabel; ?>" class="<?php echo APPLIED_ICON_CLASS; ?>"></i>
            </a>
        </td>
        <td class="action center action-box-th">
            <a href="<?php echo site_url('admin/masters/jobpost/details/' . $jobpost->JobPostID . '#all_invited'); ?>" class="modal-trigger btn-floating waves-effect waves-light black">
                <i title="<?php echo $invitedlabel; ?>" class="<?php echo INTERVIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>
        <td class="action center action-box-th">
            <a href="<?php echo site_url('admin/masters/jobpost/details/' . $jobpost->JobPostID . '#all_shortlisted'); ?>" class="info modal-trigger btn-floating waves-effect waves-light black">
                <i title="<?php echo $shotlistedlabel; ?>" class="<?php echo SHORTLIST_ICON_CLASS; ?>"></i>
            </a>
        </td>
        <?php
        if ($jobpost->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        if (@$this->cur_module->is_status == 1) {
            $status = CHANGE_STATUS;
        }
        ?>
        <td class="status action center status-box-th">
            <i title="Inactive" class="btn-floating waves-effect red darken-4 <?php echo AINACTIVE_ICON_CLASS . ' ' . @$status . ' '  . $inactive_icon_status; ?>" data-icon-type="inactive" data-id="<?php echo $jobpost->JobPostID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>
            <i title="Status" class="btn-floating waves-effect green accent-4 <?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $jobpost->JobPostID; ?>"></i>
            <i title="Active" class="btn-floating green accent-4 waves-effect <?php echo AACTIVE_ICON_CLASS . ' ' . @$status . ' ' . $active_icon_status; ?>" data-icon-type="active" data-id="<?php echo $jobpost->JobPostID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
        </td>
        <td class="action center action-box-th">

            <?php if (@$this->cur_module->is_edit == 1) { ?>

                <a class="btn-floating waves-effect waves-light blue m-r-5" href="<?php echo $this->config->item('base_url'); ?>admin/masters/jobpost/edit/<?php echo $jobpost->JobPostID; ?>" style="cursor:pointer;">
                    <i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;">
                    </i>
                </a>
                &nbsp;&nbsp;
            <?php } ?>
            <a href="javascript:void(0);" data-target="modal1" class="info modal-trigger btn-floating waves-effect waves-light black" data-id="<?php echo $jobpost->JobPostID; ?>">
                <i title="View" class="<?php echo VIEW_ICON_CLASS; ?>"></i>
            </a>
        </td>
    </tr>
<?php } ?>