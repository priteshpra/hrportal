<label for="DepartmentID" class="active"><?php echo label('msg_lbl_department');?></label>

<select id="DepartmentID" name="DepartmentID" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Department</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->DepartmentID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->DepartmentID; ?>' <?php echo $sel; ?> > <?php echo $value->Department; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>