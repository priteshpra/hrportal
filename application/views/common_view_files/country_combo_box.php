<label for="CountryID" class="active"><?php echo label('msg_lbl_country');?></label>
<select id="CountryID" name="CountryID" class="select_materialize" onchange="LoadStatesBasedCountry();" style="width:100%;display: none;" >
  <?php
   // if ($selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_select_country');?></option>
        <?php
  //  }
    foreach ($all_data as $key => $value) {
        if ($value->CountryID === $selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->CountryID; ?>' <?php echo $sel; ?> > <?php echo $value->CountryName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
    
</script>
