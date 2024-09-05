<label for="organizationId" class="active"><?php echo label('msg_lbl_organizationName');?></label>

<select id="organizationId" name="organizationId" class="select_materialize" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected">Select Organization Name</option>
        <?php
    }
    foreach ($all_organization as $key => $value) {
        if ($value->organizationId === $Selected) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
        ?>
        <option value='<?php echo $value->organizationId; ?>' <?php echo $sel; ?> > <?php echo $value->organizationName; ?></option>
        <?php
    }
    ?>
</select>
<script>
    $(document).ready(function () {
        $('select.select_materialize').material_select();
    });
</script>