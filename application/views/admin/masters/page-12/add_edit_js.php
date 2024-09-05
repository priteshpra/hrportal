<script>
    $(document).ready(function () {
<?php
if (isset($this->session->userdata['posterror'])) {
    echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
}
?>
    });
    // Start : Submit Category validation -- Shaili Shah -- //
    function capitalize(textboxid, str) {
        // string with alteast one character
        //alert('hi');
        if (str && str.length >= 1)
        {
            var firstChar = str.charAt(0);
            var remainingStr = str.slice(1);
            str = firstChar.toUpperCase() + remainingStr;
        }
        document.getElementById(textboxid).value = str;
    }


    /*Function For Buutoon click event */

    $('#button_page_submit').on('click', function ()
    {
        var error = checkValidations();

        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
            $('#button_page_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("Please wait....");
            $('form').submit();
        }
    });
    //End

</script>