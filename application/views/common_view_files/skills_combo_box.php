<label for="SkillID" class="active"><?php echo label('msg_lbl_skill');?></label>

<select id="SkillID" name="SkillID[]" multiple class="select_materialize" style="width:100%;display: none;" >
    <?php
    if (empty(@$Selected)) {
        ?>
        <option value="" disabled selected="selected">Select Skill</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if (in_array($value->SkillID,$Selected)) {
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