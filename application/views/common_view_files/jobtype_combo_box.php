<label for="JobType" class="active"><?php echo label('msg_lbl_employmenttype');?></label>
<select id="JobType" multiple name="JobType[]" class="select_materialize" style="width:100%;display: none;" >
        <option value="" disabled selected="selected">Select <?php echo label('msg_lbl_employmenttype');?></option>
        <?php
    $array = unserialize(JOBTYPE_ARRAY);
        foreach ($array as $value) {
            $sel = "";
            if(in_array($value,$Selected)){
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
