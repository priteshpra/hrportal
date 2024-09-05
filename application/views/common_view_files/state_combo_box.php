<label for="StateID" class="active"><?php echo label('msg_lbl_state');?></label>
<select id="StateID" name="StateID" class="select_materialize" onchange="loadCityBasedState();" style="width:100%;display: none;" >
    <?php
    if ($Selected === 0) {
        ?>
        <option value="" selected="selected"><?php echo label('msg_lbl_select_state');?></option>
        <?php
    }
    foreach ($all_data as $key => $value) {
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
    function loadCityBasedState(){
        if($("#CityDiv").length != 0){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>common/GetState/0/"+$('#StateID').val(),
                data: {},
                success: function (result){
                    $('#CityDiv').html(result);
                    $('#CityDiv').show();
                    $('#CityID').select2();
                },error: function (result){
                    console.log("error" + result);
                }
            });
        }
    }
</script>