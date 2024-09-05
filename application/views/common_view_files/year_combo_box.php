<label for="Year" class="active"><?php echo $Label;?></label>
<select id="Year" name="Year" class="select_materialize" style="width:100%;display: none;" >
    
    <?php
    if ($Selected == 0) {
        ?>
        <option value="" selected="selected">Select Year</option>
        <?php
    }
    $year = date('Y');
        for($i=$year;$i >= $FromYear;$i--){
            $sel = "";
            if($i == $Selected){
                $sel = " selected='selected'";
            }
        ?>
        <option value='<?php echo $i; ?>' <?php echo $sel;?> > <?php echo $i; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
    
</script>
