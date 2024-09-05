<script>
    $(document).ready(function () {
       setTimeout(function(){ $('#Year').focus(); }, 1100);
    <?php
    if (isset($this->session->userdata['posterror'])) {
        echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }?>
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>
            });

    $('#button_year_submit').on('click', function ()
    {
        var error = checkValidations();
        var yearduration = $('#YearDuration').val();
        var year = $('#Year').val();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        else
        {
            if(!isYear(year)){
              alertify.error("<?php echo label('msg_lbl_please_enter_year');?>");
            return false;
           }       
            if(!isYearDuration(yearduration)){
              alertify.error("<?php echo label('msg_lbl_please_enter_year_duration');?>");
            return false;
           }       
            $('#button_year_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("Please wait....");
            $('form').submit();

        }
    });
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_year_submit").click();
            return false;
        }
    });
    //End
</script>