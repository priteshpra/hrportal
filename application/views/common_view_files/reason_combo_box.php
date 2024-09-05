<label for="Reason" class="active">Reason</label>
<select id="Reason" name="Reason" class="select_materialize" style="width:100%;display: none;" >
        <?php
        $first_flag =0;
        $other = 2;
    foreach ($all_data as $value) {
        if($value == "Other - Please state"){
            $other = 1;
        }
        ?>
        <option value='<?php 
                        switch ($other) {
                        case 0:
                            echo $value;
                            break;
                        case 1:
                            echo '0';
                            break;
                        case 2:
                            echo '';
                            break;
                    } ?>'><?php echo $value; ?></option>
        <?php
        $other = 0;
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
    
</script>
