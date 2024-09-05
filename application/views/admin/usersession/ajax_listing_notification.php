<?php //print_r($allinvite);die();
foreach ($notify as $notify) { ?>
    <tr class="gradeX" id="row_<?php echo $notify->UserID; ?>">
        <td><?php echo $notify->NotificationID; ?></td>
        <td><?php echo $notify->UserID; ?></td>
        <td><?php echo $notify->Description; ?></td>
        <td><?php echo $notify->TypeID; ?></td>
        <td><?php echo $notify->CreatedBy; ?></td>
        <td><?php echo $notify->CreatedDate; ?></td>
        <td><?php echo $notify->ActionType; ?></td>
    </tr>
<?php } ?>   