<label for="Location" class="active">Location</label>
<select id="Location" name="Location"  multiple class="select2_class" style="width:100%;display: none;" >
    <option value="" selected="selected">Select Location</option>
    <?php
        foreach ($all_data as $key => $value) {
        ?>
        <optgroup label='<?php echo $value->StateName; ?>'>
        <?php 
            if(!empty($value->cities)){
                foreach ($value->cities as $key => $d_v) {
                    ?>
                    <option value="<?php echo $d_v['CityID'];?>"><?php echo $d_v['CityName'];?></option>
                <?php
                }
            }
        ?>
        </optgroup>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select2_class').select2();
    });
    
</script>
