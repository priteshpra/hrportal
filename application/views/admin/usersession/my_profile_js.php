<script>
        $(document).ready(function () {
       setTimeout(function(){ $('#FirstName').focus(); }, 1100);
    <?php
    if (isset($this->session->userdata['posterror'])) {
        echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
    }?>
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>
            });
    $("#submit_button").click(function (){
        var error = checkValidations();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            var mob = $('#MobileNo').val();
            if(mob.length < 10 || mob.length > 13){
                alertify.error("<?php echo label('mobile_length_valid'); ?>");
                return false;
            }
            var count = (mob.match(/0/g) || []).length; 
            if(count == 13){
                alertify.error("<?php echo label('cellphone_error');?>");
                return false;
            }
            else{
                $('#submit_button').addClass('hide');
                $('#button_submit_loading').removeClass('hide');
                alertify.success("<?php echo label('profile_update_successful');?>");
                 $('form').submit();
            }
        }
    });
 $(document).keypress(function (e) {
        if (e.which == 13) {
            $("#submit_button").click();
            return false;
        }
    });


</script>