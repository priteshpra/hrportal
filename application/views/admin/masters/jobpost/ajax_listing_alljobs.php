<?php //print_r($allapplied);die();
foreach ($allapplied as $allapplied) { ?>
    <tr class="gradeX" id="row_<?php echo $allapplied->UserID; ?>">
        <td><?php echo $allapplied->FirstName.' '.$allapplied->LastName; ?></td>
        <td><?php echo $allapplied->MobileNo; ?></td>
        <td><?php echo $allapplied->EmailID; ?></td>
        <td><?php echo $allapplied->Gender; ?></td>                           
    </tr>
<?php } ?>   