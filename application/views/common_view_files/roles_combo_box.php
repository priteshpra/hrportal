<label for="RoleID" class="active"><?php echo label('msg_lbl_role');?></label>
<select id="RoleID" name="RoleID" class="select_materialize" style="width:100%;display: none;">
    <?php
    if ($Selected == 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_Select_Role');?></option>
        <?php
    }

    foreach ($all_roles as $key => $value) {
        if ($value->RoleID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option id = "" value="<?php echo $value->RoleID;?>" <?php echo $sel; ?> ><?php echo $value->RoleName; ?>
        </option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script> 