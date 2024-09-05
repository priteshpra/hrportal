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
        var email = $('#EmailID').val();
        var mob = $('#MobileNo').val();
        var count = (mob.match(/0/g) || []).length;
        var id = $('#UserID').val();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
            if(submitflag == 0){
                return false;
            }   
            submitflag == 0;
            
            <?php if($page_name == 'add'){?>

            var cpass = $('#ConfirmPassword').val();
            var pass = $('#iPassword').val();
            var flag = isPassword($('#iPassword').val());
            
            if(flag == 1){
                alertify.error("<?php echo label('password_8_32_long_min_1_char_spc_digit');?>");
                return false;
            }
            if(pass != cpass){
                alertify.error("<?php echo label('password_conf_not_macth');?>");
                return false;    
            }

            if(!isEmail(email)){
                alertify.error("<?php echo label('valid_email');?>");
                return false;
            }


            <?php }?>

            if(mob.length < 10 || mob.length > 13){
                    alertify.error("<?php echo label('cellphone_error');?>");
                    return false;
            }
            if(count == 13){
                alertify.error("<?php echo label('cellphone_error');?>");
                return false;
            }   
            $.ajax({
            type:"post",
            url: "<?php echo base_url();?>company/employeedetails/emailmobileexist",
            data:{ email:email,contact_no:mob,id:id},
                    success:function(data)
                    {
                        submitflag = 1;

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