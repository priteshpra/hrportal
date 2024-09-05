<?php 
foreach ($message as $message) { ?>

    <tr id="row_<?php echo $message->MessageID; ?>">
        <td align="center"><?php echo $message->MessageKey; ?></td>
        <td align="center"><?php echo $message->Message; ?></td> 
        <td class="action center">
            <a href="<?php echo $this->config->item('base_url'); ?>admin/masters/message/edit/<?php echo $message->MessageID; ?>" style="cursor:pointer;" class="btn-floating waves-effect waves-light blue"><i title="Edit" class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;"></i>
            </a>
       
        </td>      
    </tr>
<?php }
?>




