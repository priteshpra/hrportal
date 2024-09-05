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
    window.submitflag = 1;
    $("#submit_button").click(function (){
        var error = checkValidations();
        var field_ids = ['CityID','StateID','CountryID','DesignationID'];
        var combo_box_error = checkComboBox(field_ids); 
        var email = $('#Email').val();
        var mob = $('#MobileNo').val();
        var website = $('#WebsiteURL').val();
        var facebook = $('#FacebookURL').val();
        var linkedin = $('#LinkedinURL').val();
        var count = (mob.match(/0/g) || []).length; 
        var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
        if (error === 'yes' || combo_box_error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            if(website.length!= 0){                 
                if(urlregex.test(website) == false){
                alertify.error("<?php echo label('valid_website_url');?>");
                return false;
                }
            }
            if(facebook.length!= 0){                 
                if(urlregex.test(facebook) == false){
                alertify.error("<?php echo label('valid_facebook_url');?>");
                return false;
                }
            }
            if(linkedin.length!= 0){                 
                if(urlregex.test(linkedin) == false){
                alertify.error("<?php echo label('valid_linkedin_url');?>");
                return false;
                }
            }
            if(mob.length < 10 || mob.length > 13){
                    alertify.error("<?php echo label('cellphone_error');?>");
                    return false;
            }
            if(count == 10){
                alertify.error("<?php echo label('cellphone_error');?>");
                return false;
            }    
            if(!isEmail(email)){
                alertify.error("<?php echo label('valid_email');?>");
                return false;
            }
            if(submitflag == 0){
                  return false;
            }
            submitflag == 0;
            $.ajax({
                type: "POST",
                url: base_url + "company/usersession/CheckMobile",
                data: { 
                    MobileNo:$('#MobileNo').val(),
                },
                success: function (result){
                    submitflag = 1;
                    if(result == 1){
                        $('#submit_button').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        $('form').submit();
                    }else{
                        alertify.error(result);
                    }
                },error: function (result){
                    console.log("error" + result);
                }
            });
        }
        return false;
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
            $("#submit_button").click();
            return false;
        }
    });


</script>