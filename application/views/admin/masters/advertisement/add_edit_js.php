<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#Title').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>  

    var exp_val = $('input[name=Type_t]:checked').val();
        if(exp_val == 'Text'){
           $("#editProfilePicture").removeClass('empty_validation_class');
           $("#ShortDescription").addClass('empty_validation_class');
           $('#ttext_desc').removeClass("hide"); // removeClass("hide");
           $('#timage_div').addClass("hide");  // addClass("hide")
        }else{
            $("#editProfilePicture").addClass('empty_validation_class');
            $("#ShortDescription").removeClass('empty_validation_class');
            $('#timage_div').removeClass("hide");
            $('#ttext_desc').addClass("hide");
            $('#ShortDescription').val('');
        }   
})
    window.submitflag = 1;
         $('input[name=Type_t]').on('change',function(){
            if($(this).val() == 'Text'){
                $("#editProfilePicture").removeClass('empty_validation_class');
                $("#ShortDescription").addClass('empty_validation_class');
                $('#ttext_desc').removeClass("hide"); // removeClass("hide");
                $('#timage_div').addClass("hide");  // addClass("hide")
                $('#webviewcross').click();
            }
            else{
                $("#editProfilePicture").addClass('empty_validation_class');
                $("#ShortDescription").removeClass('empty_validation_class');
                $('#timage_div').removeClass("hide");
                $('#ttext_desc').addClass("hide");
                $('#ShortDescription').val('');
            }
        });     
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
		var field_ids = ['CityID'];
        var website = $('#RedirectURL').val();
        var combo_box_error = checkComboBox(field_ids);	
        var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
        if (error === 'yes' || combo_box_error =='yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
            
            if(submitflag == 0){
                return false;
            }
            submitflag == 0;
            if(website.length!= 0){                 
                if(urlregex.test(website) == false){
                alertify.error("<?php echo label('enter_valid_redirecturl');?>");
                return false;
                }
            }
            $('#button_submit').addClass('hide');
            $('#button_submit_loading').removeClass('hide');
            alertify.success("<?php echo label('please_wait');?>");
            $('form').submit();
        }
        return false;
    });
	$(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>