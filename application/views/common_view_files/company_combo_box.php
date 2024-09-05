<label for="CompanyID" class="active"><?php echo label('msg_lbl_company');?></label>


<select id="CompanyID" name="CompanyID" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected == 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_select_company');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->CompanyID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->CompanyID; ?>' <?php echo $sel; ?> > <?php echo $value->CompanyName; ?></option>
      
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>