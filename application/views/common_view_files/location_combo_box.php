<label for="Location" class="active">Location</label>
<select id="Location" name="Location"  multiple class="select_materialize" style="width:100%;display: none;" >
    <option value="" selected="selected">Select Location</option>
    <?php
        foreach ($all_data as $key => $value) {
        ?>
        <option value='<?php echo $value->CityID; ?>'> <?php echo $value->CityName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
    
</script>
