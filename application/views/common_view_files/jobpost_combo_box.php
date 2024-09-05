<label for="JobPostID" class="active"><?php echo label('msg_lbl_jobpost');?></label>

<select id="JobPostID" name="JobPostID" class="select2_class" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo "Select ".label('msg_lbl_jobpost');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->JobPostID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->JobPostID; ?>' <?php echo $sel; ?> > <?php echo $value->JobTitle; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select2_class').material_select();
    });
</script>