<?php 
    foreach ($following as $following) {  ?>

        <tr id="row_<?php echo $following->FollowID; ?>">
               <?php if(@$following->CompanyLogoOrgName != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).COMPANYLOGO_UPLOAD_PATH.$following->CompanyLogoOrgName))) {
                $path = site_url(COMPANYLOGO_UPLOAD_PATH.$following->CompanyLogoOrgName);
            }else {
                $path =  site_url(DEFAULT_IMAGE);
            }
       ?>  
            <td>
                <a class="txt-underline bold" href="<?php echo site_url('admin/masters/company/details/'.$following->CompanyID);?>">
                    <img alt="<?php echo $following->CompanyLogoOrgName;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'>
                </a>
            </td> 
            <td>
                <a class="txt-underline bold" href="<?php echo site_url('admin/masters/company/details/'.$following->CompanyID);?>">
                    <?=$following->CompanyName; ?>
                </a>
            </td>
            <td><?=$following->FirstName.' '.$following->LastName; ?></td>
            <td><a href="mailto:<?=$following->EmailID;?>"><?=$following->EmailID;?></a></td>
            <td><?=$following->MobileNo; ?></td>
            <td><?=$following->Designation; ?></td>
            <td>
                <a href="<?php echo ReturnUrl($following->WebsiteURL); ?>" target="_blank">
                    <?=$following->WebsiteURL; ?>
                </a>
            </td>
            <td><?=$following->Address; ?></td>
                     
        </tr>
    <?php }
    ?>