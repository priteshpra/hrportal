<label for="Grade" class="active"><?php echo label('msg_lbl_grade');?></label>
<select id="Grade" name="Grade" class="select_materialize" style="width:100%;display: none;" >
    
    <?php
    if ($Selected == '') {
        ?>
        <option value="" selected="selected">Select <?php echo label('msg_lbl_grade');?></option>
        <?php
    }
    $array = unserialize(GRADE_ARRAY);
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
