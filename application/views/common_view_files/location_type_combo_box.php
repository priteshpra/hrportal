<label for="locationtypeId" class="active"><?php echo label('msg_lbl_location');?></label>
<?php //pr($all_locationtype); echo $Selected;exit();?>
<select id="locationtypeId" name="locationtypeId" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_location_select');?></option>
        <?php
    }
    foreach ($all_locationtype as $key => $value) {
        if ($value->locationtypeId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->locationtypeId; ?>' <?php echo $sel; ?> > <?php echo $value->locationType; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>