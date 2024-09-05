<label for="LanguageID" class="active"><?php echo label('msg_lbl_language');?></label>

<select id="LanguageID" name="LanguageID" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_Select_Language');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
        if ($value->LanguageID === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->LanguageID; ?>' <?php echo $sel; ?> > <?php echo $value->Language; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>