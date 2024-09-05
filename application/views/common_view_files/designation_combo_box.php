<label for="DesignationID" class="active"><?php echo label('msg_lbl_position');?></label>

<select id="DesignationID" name="DesignationID" class="select_materialize" style="width:100%;display: none;" <?php echo ($MultiSelect == 1)?' multiple ':'';?> >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_designation');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->DesignationID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->DesignationID; ?>' <?php echo $sel; ?> > <?php echo $value->Designation; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>