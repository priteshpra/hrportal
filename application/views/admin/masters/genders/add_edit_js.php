<script>
    $(document).ready(function () {
       setTimeout(function(){ $('#Gender').focus(); }, 1100);
    <?php
    if (isset($this->session->userdata['posterror'])) {
        echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }?>
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>
            });
/*Function For Buutoon click event */

    $('#button_genders_submit').on('click', function ()
    {
        var error = checkValidations();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        else
          {
            $.ajax({
                type: "POST",   
                url: "<?php echo $this->config->item('base_url'); ?>Common/CheckDuplicate",
                data: {
                        table_name: 'ssse_genders',
                        field_name:'gender',
                        data_value:$("#Gender").val(),
                        ufield:'genderId',
                        ID:$("#CurrentID").val(),
                },success: function (data) 
                {    
                    var obj = JSON.parse(data);
                    if(obj.count > 0){
                        alertify.error('<?php echo label('gender_duplicate_name');?>');
                    }else{
                        $('#button_genders_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("Please wait....");
                        $('form').submit();
                    }
                }
            });
        }
    return false;
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_genders_submit").click();
            return false;
        }
    });
    //End
</script>