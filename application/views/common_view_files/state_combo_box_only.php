<label for="StateID" class="active">State</label>
<select id="StateID" name="StateID" class="select_materialize"  style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select State</option>
        <?php
    }
    foreach ($all_states as $key => $value) {
        if ($value->StateID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->StateID; ?>' <?php echo $sel; ?> > <?php echo $value->StateName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>