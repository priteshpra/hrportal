<?php foreach ($emailtemplate as $email_templates) { ?>

    <tr id="row_<?php echo $email_templates->EmailTemplateID; ?>">   
        <td align="center"><?php echo $email_templates->EmailTemplateTitle; ?></td> 
		<td align="center"><?php echo $email_templates->EmailSubject; ?></td> 		
        <?php
        if ($email_templates->Status == ACTIVE) {
            $inactive_icon_status = "hide";
            $active_icon_status = "";
        } else {
            $inactive_icon_status = "";
            $active_icon_status = "hide";
        }
        ?>
        <td class="center action">

            <i class="<?php echo INACTIVE_ICON_CLASS . ' ' . $inactive_icon_status; ?> btn-floating waves-effect waves-light red darken-4" data-icon-type="inactive" data-id="<?php echo $email_templates->EmailTemplateID; ?>" data-new-status="<?php echo ACTIVE; ?>"></i>

            <i class="<?php echo LOADING_ICON_CLASS; ?> hide" data-icon-type="loading" data-id="<?php echo $email_templates->EmailTemplateID; ?>"></i>

            <i class="<?php echo ACTIVE_ICON_CLASS . ' ' . $active_icon_status; ?> btn-floating waves-effect waves-light green accent-4" data-icon-type="active" data-id="<?php echo $email_templates->EmailTemplateID; ?>" data-new-status="<?php echo INACTIVE; ?>"></i>
            <span style="display:none;"><?php echo $email_templates->Status; ?></span> 

        </td>
        <td class="action center">
             <?php if(@$this->cur_module->is_edit == 1){?>
			<a href="<?php echo $this->config->item('base_url'); ?>admin/masters/emailtemplate/edit/<?php echo $email_templates->EmailTemplateID; ?>" style="cursor:pointer;" class="btn-floating waves-effect waves-light blue"><i class="<?php echo EDIT_ICON_CLASS; ?>" data-s="18" data-n="edit" data-c="#262926" data-hc="0" style="width: 16px; height: 16px;"></i>
            </a>
            &nbsp;&nbsp;
			 <?php }?>
            <a class="info bgglobal modal-trigger btn-floating waves-effect" href="#modal1" data-id="<?php echo $email_templates->EmailTemplateID; ?>">
                <i class="<?php echo VIEW_ICON_CLASS; ?>" style="width: 16px; height: 16px;"></i>
            </a>      
        </td>      
    </tr>
<?php }
?>




