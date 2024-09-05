<?php 
foreach ($data_array as $data) { ?>
    <tr class="gradeX" id="row_<?php echo $data->JobPostID; ?>">
        <td><a class="txt-underline bold" href="<?php echo site_url('admin/masters/jobpost/details/'.$data->JobPostID);?>"><?php echo $data->JobTitle; ?></a></td>
        <td><a class="txt-underline bold" href="<?php echo site_url('admin/masters/company/details/'.$data->UserID)?>"><?php echo $data->CompanyName; ?></a></td>
		<td><?php echo $data->Designation; ?></td>
        <td><?php echo $data->CityName; ?></td>
        <td><?php echo $data->IndustryType; ?></td>
            <?php 
            $MinExperienceYear = '';
            $MinExperienceMonth = '';
            $MaxExperienceYear = '';
            $MaxExperienceMonth = '';
            $MinExperience = '0';
            $MaxExperience = '0';
            if(isset($data->MinExperience) && $data->MinExperience > 0){
                 $MinExperienceYear = round(bcdiv($data->MinExperience, 12));
                 $MinExperienceMonth = $data->MinExperience - ($MinExperienceYear*12);

                 $MinExperience = ($MinExperienceYear>0) ? $MinExperienceYear.(($MinExperienceYear==1) ? 'Year ' : 'Years ') : '';
                 $MinExperience = ($MinExperienceMonth>0) ? $MinExperience.$MinExperienceMonth.(($MinExperienceMonth==1) ? 'Month ' : 'Months ') : $MinExperience;
            }
            if(isset($data->MaxExperience) && $data->MaxExperience > 0){
                 $MaxExperienceYear = round(bcdiv($data->MaxExperience, 12));
                 $MaxExperienceMonth = $data->MaxExperience - ($MaxExperienceYear*12);
                 $MaxExperience = ($MaxExperienceYear>0) ? $MaxExperienceYear.(($MaxExperienceYear==1) ? 'Year ' :'Years ') : '';
                 $MaxExperience = ($MaxExperienceMonth>0) ? $MaxExperience.$MaxExperienceMonth.(($MaxExperienceMonth==1) ? 'Month ' : 'Months ' ) : $MaxExperience;
            }
            ?>

        <td><?php echo $MinExperience." - ".$MaxExperience; ?></td>
        <td><?php echo $data->MinSalary."-".$data->MaxSalary; ?></td>
        <td><?php echo $data->NatureOfEmployment; ?></td>
        <td><?php echo $data->NoOfVacancies; ?></td>
    </tr>
<?php } ?>   