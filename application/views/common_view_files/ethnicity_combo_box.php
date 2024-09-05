<label for="EthnicityID" class="active"><?php echo label('msg_lbl_ethnicity');?></label>

<select id="EthnicityID" name="EthnicityID" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Ethnicity</option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->EthnicityID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->EthnicityID; ?>' <?php echo $sel; ?> > <?php echo $value->EthnicityName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>