<label for="CityID" class="active"><?php echo label('msg_lbl_city');?></label>
<select id="CityID" name="CityID" class="select_materialize" style="width:100%;display: none;" >
    <?php
 //   if ($Selected == 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_select_city');?></option>
        <?php
 //   }
    foreach ($all_data as $key => $value) {
        if ($value->CityID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option id = "" value="<?php echo $value->CityID;?>" <?php echo $sel; ?> > <?php echo $value->CityName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>