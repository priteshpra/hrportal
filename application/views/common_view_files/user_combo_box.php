<label for="UserID" class="active"><?php echo $Title;?></label>
<select id="UserID" name="UserID" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected == 0) {
        ?>
        <option value="" selected="selected"><?php echo label('select_user');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->UserID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->UserID; ?>' <?php echo $sel; ?> > <?php echo $value->FirstName.' '.$value->LastName ; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
    
</script>
