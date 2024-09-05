<label for="Salary" class="active">Salary</label>
<select id="Salary" name="Salary" class="select_materialize" style="width:100%;display: none;" >
        <?php
    foreach ($all_data as $value) {
        $salaryarray = explode('~',$value);
        $salary = $salaryarray[0];
        if($salaryarray[1] == -1 && $salaryarray[2] == -1) {
            $salary = "All";
        }
        $value = $salaryarray[1]. "~" . $salaryarray[2];
        ?>
        <option value='<?php echo ($salary == "All")?'':$value; ?>' <?php echo ($salary == "All")?' selected ':'';?> > <?php echo $salary; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
    
</script>
