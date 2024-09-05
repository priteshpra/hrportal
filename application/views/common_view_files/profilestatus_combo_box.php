<label for="ProfileStatus" class="active"><?php echo label('msg_lbl_profilestatus');?></label>
<select id="ProfileStatus" name="ProfileStatus" class="select_materialize" style="width:100%;display: none;" >
        <option value="" disabled selected="selected">Select <?php echo label('msg_lbl_profilestatus');?></option>
        <?php
    $array = unserialize(STATUSTYPE_ARRAY);
        foreach ($array as $value) {
            $sel = "";
            if($value == $Selected){
                $sel = " selected='selected' ";
            }
        ?>
        <option value='<?php echo $value; ?>' <?php echo $sel;?> > <?php echo $value; ?></option>
        <?php
        }
        ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
    
</script>
