<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#FirstName').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
})
    window.submitflag = 1;
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
        var field_ids = ['DesignationID'];
        var combo_box_error = checkComboBox(field_ids); 
        var email = $('#EmailID').val();
        var mob = $('#MobileNo').val();
        if (error === 'yes' || combo_box_error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
            var cpass = $('#ConfirmPassword').val();
            var pass = $('#Password').val();
            var flag = isPassword(pass);
            if(flag == 1){
                alertify.error("<?php echo label('password_8_32_long_min_1_char_spc_digit');?>");
                return false;
            }
            if(pass != cpass){
                alertify.error("<?php echo label('password_conf_not_macth');?>");
                return false;    
            }
            var count = (mob.match(/0/g) || []).length; 
            if(mob.length < 10 || mob.length > 13){
                    alertify.error("<?php echo label('cellphone_error');?>");
                    return false;
            }
            if(count == 13){
                alertify.error("<?php echo label('cellphone_error');?>");
                return false;
            }    
            <?php if(@$validation_check){?>
                    if(!isEmail(email)){
                        alertify.error("<?php echo label('valid_email');?>");
                        return false;
                    }
            <?php }?>
            var id = $('#UserID').val();
             if(submitflag == 0){
                return false;
            }
            $.ajax({
            type:"post",
            url: "<?php echo base_url();?>admin/masters/company/emailmobileexist",
            data:{ email:email,contact_no:mob,id:id},
                    success:function(data)
                    {
                        if (data == 1) 
                        {  
                            $('#button_submit').addClass('hide');
                            $('#button_submit_loading').removeClass('hide');
                            alertify.success("<?php echo label('please_wait');?>");
                            $('form').submit();
                        }
                        else 
                        {
                            alertify.error(data);
                            return false;
                        }  
                    }
                });
            return false;
            }
    });

	$(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>