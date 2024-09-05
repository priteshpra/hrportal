<script>
    $(document).ready(function () {
       setTimeout(function(){ $('#Month').focus(); }, 1100);
    <?php
    if (isset($this->session->userdata['posterror'])) {
        echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }?>
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>
            });
/*Function For Buutoon click event */

    $('#button_month_submit').on('click', function ()
    {
        var error = checkValidations();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        else
        {
            $('#button_month_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("Please wait....");
            $('form').submit();
        }
    });
      $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_month_submit").click();
            return false;
        }
    });
    //End
</script>