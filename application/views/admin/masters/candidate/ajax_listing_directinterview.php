<?php 
    foreach ($data_array as $data) {  ?>

        <tr id="row_<?php echo $data->CompanyJobActionID; ?>">
           <?php 
            if(@$data->CompanyLogoOrgName != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).COMPANYLOGO_THUMB_UPLOAD_PATH.$data->CompanyLogoOrgName))) {
                $path = site_url(COMPANYLOGO_THUMB_UPLOAD_PATH.$data->CompanyLogoOrgName);
            }else {
                $path =  site_url(DEFAULT_IMAGE);
            }
        ?>  
        <td>
            <a class="txt-underline bold" href="<?php echo site_url('admin/masters/company/details/'.$data->CompanyID);?>">
            <img alt="<?php echo $data->CompanyLogoOrgName;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'>
        </td> 
        <td> <a class="txt-underline bold" href="<?php echo site_url('admin/masters/company/details/'.$data->CompanyID);?>">
            <?php echo $data->CompanyName; ?></a>
        </td>
        <td><?php echo $data->FirstName.' '.$data->LastName; ?></td>
        <td><a href="mailto:<?php echo $data->EmailID; ?>"><?php echo $data->EmailID; ?></a></td>
        <td><?php echo $data->MobileNo; ?></td>
        <td><?php echo $data->Designation; ?></td>
        <td><a href="<?php echo ReturnUrl($data->WebsiteURL); ?>" target="_blank"><?php echo $data->WebsiteURL; ?></a></td>
        <td><?php echo $data->Address; ?></td>
            <td><?php if($data->CurrentState == '5'){
                    echo 'Accepted';
                }elseif($data->CurrentState == '6'){
                    echo 'Decline';
                }   
                else{
                    echo 'Invited';
                } ?>       
            </td>
                               
        </tr>
    <?php }
    ?>