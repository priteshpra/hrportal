<label for="SkillID" class="active"><?php echo label('msg_lbl_skill');?></label>

<select id="SkillID" name="SkillID" class="select_materialize" style="width:100%;display: none;" >
   
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_skill');?></option>
        <?php
    }
    else{?>
        <option value="">Select <?php echo label('msg_lbl_skill');?></option>
    <?php }
    foreach ($all_data as $key => $value) {
        if ($value->SkillID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->SkillID; ?>' <?php echo $sel; ?> > <?php echo $value->SkillName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>