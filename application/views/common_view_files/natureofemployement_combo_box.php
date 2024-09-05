<label for="NatureOfEmployment" class="active">Employment Type</label>
<select id="NatureOfEmployment" name="NatureOfEmployment" class="select_materialize" style="width:100%;display: none;" >
        <?php
        if($Selected == ""){
            ?>
            <option value="" selected="selected">Select Employement Type</option>
        <?php
        }
    foreach ($all_data as $value) {
        $sel = "";
        if($Selected == $value) {
            $sel = " selected='selected'";
        }
        ?>
        <option value='<?php echo $value; ?>' <?php echo $sel;?> ><?php echo $value; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
    
</script>
