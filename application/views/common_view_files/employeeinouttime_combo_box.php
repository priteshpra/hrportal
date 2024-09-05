<label for="EmployeeID" class="active"><?php echo label('msg_lbl_employee');?></label>
<select id="EmployeeID" name="EmployeeID" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_select_employee');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->EmployeeID === $Selected) {
            $Selected = "selected=selected";
        } else {
            $Selected = "";
        }
        ?>
        <option value='<?php echo $value->EmployeeID; ?>' <?php echo $Selected; ?> > <?php echo $value->FirstName . ' ' . $value->LastName ; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
    
</script>
