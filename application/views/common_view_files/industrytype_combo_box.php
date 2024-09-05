<label for="IndustryTypeID" class="active"><?php echo label('msg_lbl_sector');?></label>


<select id="IndustryTypeID" name="IndustryTypeID" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_select_sector');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->IndustryTypeID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->IndustryTypeID; ?>' <?php echo $sel; ?> > <?php echo $value->IndustryType;?></option>
      
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>