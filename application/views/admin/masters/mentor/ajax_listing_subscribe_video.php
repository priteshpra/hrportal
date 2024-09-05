<?php //pr($video);exit;
foreach ($video as $video) { ?>
    <tr class="gradeX" id="row_<?php echo $video->VideoSubscriptionID; ?>">
        <?php   
          if(@$video->ImageURLName != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).VIDEOURL_THUMB_UPLOAD_PATH.$video->ImageURLName))) {
            $path = site_url(VIDEOURL_THUMB_UPLOAD_PATH . $video->ImageURLName);
          }else{
            $path =  site_url(DEFAULT_IMAGE);
          }
          if(@$video->VideoURLName != null && (file_exists(str_replace(array('\\','/system'),array('/',''),BASEPATH).VIDEOURL_UPLOAD_PATH.$video->VideoURLName))) {
            $v_path = base_url().VIDEOURL_UPLOAD_PATH . $video->VideoURLName;
          } else {
            $v_path =  'javascript:void(0);';
          }
           ?> 
        <td>
            <img alt="<?php echo $video->ImageURLName;?>" id="ImagePreivew" src='<?php echo $path; ?>'  height='75' width='100'>
        </td> 
        <td><?php echo $video->VideoTitle; ?></td>
        <td>
          <a href="<?php echo site_url('admin/masters/candidate/details'.$video->UserID);?>">
            <?php echo $video->FirstName . ' ' . $video->LastName ; ?>
          </a>
        </td>
        <td>
          <a href="<?php echo $v_path;?>" target="_blank"><?php echo $video->VideoURLName; ?></a></td>
        <td><?php 
                if($video->Flag == 1)
                    {echo "Free";}
                else{echo "Paid "."(". $video->Currency. " " .$video->Price.")";} 
            ?></td>
		
		<td>
            <?php echo $video->PaymentMethod; ?>
        </td>
		
        <td class="action center action-box-th">
            <?php echo $video->SubscriptionStatus; ?>
        </td>

        <td class="action center action-box-th">
            <?php echo $video->EmailID.' | '. $video->MobileNo; ?>
        </td>   
        <!-- <td>
            <td><?php echo $video->Response; ?></td>
        </td>   -->                                                                                                                                                                      
    </tr>
<?php } ?>   