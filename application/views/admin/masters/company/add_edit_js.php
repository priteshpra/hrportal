<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#CompanyName').focus(); }, 1100);
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
        var website = $('#WebsiteURL').val();
        var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
            if(website.length!= 0){                 
                if(urlregex.test(website) == false){
                alertify.error("<?php echo label('valid_website_url');?>");
                return false;
                }
            }
            <?php if($page_name == 'add'){?>
                var count = (mob.match(/0/g) || []).length; 
                if(mob.length < 10 || mob.length > 13){
                        alertify.error("<?php echo label('cellphone_error');?>");
                        return false;
                }
                if(count == 13){
                    alertify.error("<?php echo label('cellphone_error');?>");
                    return false;
                }    
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
function LoadStatesBasedCountry(){
         
        if($("#StateDiv").length != 0){
            $.ajax({
                type: "POST",
                url: base_url + "common/GetStateBasedCombobox"+"/0/"+$('#CountryID').val(),
                data: { },
                success: function (result){
                    $('#StateDiv').html(result);
                    $('#StateDiv').show();
                    $('#StateID').material_select();
                    LoadCitiesBasedStates();
                },error: function (result){
                    console.log("error" + result);
                }
            });
        }
    }
function LoadCitiesBasedStates(){
        if($("#CityDiv").length != 0){
            $.ajax({
                type: "POST",
                url: base_url + "common/GetCityBasedCombobox"+"/0/"+$('#StateID').val(),
                data: {country: $('#StateID').val()},
                success: function (result){
                    $('#CityDiv').html(result);
                    $('#CityDiv').show();
                    $('#CityID').material_select();
                },error: function (result){
                    console.log("error" + result);
                }
            });
        }
    }
	$(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>