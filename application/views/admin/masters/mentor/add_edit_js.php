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
        var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
            var facebook = $("#FaceboookURL").val();
            var twitter = $("#TwitterURL").val();
            var linkedin = $("#LinkedinURL").val();
            var pinterest = $("#PinterestURL").val();
            
            <?php if($page_name == 'add'){?>
            var newp = $('#Password').val();
            var confirm = $("#CPassword").val();
            if(!isEmail(email)){
                alertify.error("<?php echo label('valid_email');?>");
                return false;
            }
            var flag = isPassword($('#Password').val());
            if(flag == 1){
                alertify.error("<?php echo label('password_8_32_long_min_1_char_spc_digit');?>");
                return false;
            }
            if(newp != confirm){
                alertify.error("<?php echo label('password_conf_not_macth');?>");    
                return false;
            }
            if(facebook.length!= 0){                 
                if(urlregex.test(facebook) == false){
                alertify.error("<?php echo label('valid_facebook_url');?>");
                return false;
                }
            }
            if(twitter.length!= 0){                 
                if(urlregex.test(twitter) == false){
                alertify.error("<?php echo label('valid_twitter_url');?>");
                return false;
                }
            }
            if(linkedin.length!= 0){                 
                if(urlregex.test(linkedin) == false){
                alertify.error("<?php echo label('valid_linkedin_url');?>");
                return false;
                }
            }
            if(pinterest.length!= 0){                 
                if(urlregex.test(pinterest) == false){
                alertify.error("<?php echo label('valid_pinterest_url');?>");
                return false;
                }
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
            if(submitflag == 0){
                return false;
            }   
            submitflag == 0;
            $.ajax({
            type:"post",
            url: "<?php echo base_url();?>admin/masters/company/emailmobileexist",
            data:{ email:email,contact_no:mob,id:id},
                    success:function(data)
                    {
                        submitflag == 1;
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