<label for="QualificationID" class="active"><?php echo label('msg_lbl_qualification');?></label>

<select id="QualificationID" name="QualificationID" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_Select_qualification');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->QualificationID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->QualificationID; ?>' <?php echo $sel; ?> > <?php echo $value->Qualification; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>