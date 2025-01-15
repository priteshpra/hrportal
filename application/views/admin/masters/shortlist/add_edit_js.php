<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#FirstName').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>   
    var exp_val = $('input[name=IsExperience]:checked').val();
        if(exp_val == 'Experience'){
            
            $('#IfExperience').removeClass('hide');
            $('#ExperienceYear').addClass('empty_validation_class');
            $('#ExperienceMonth').addClass('empty_validation_class');
            $('#Salary').addClass('empty_validation_class');
            
        }else{
            $('#IfExperience').addClass('hide');
            $('#ExperienceYear').removeClass('empty_validation_class');
            $('#ExperienceMonth').removeClass('empty_validation_class');
            $('#Salary').removeClass('empty_validation_class');
        }

    // $('.datepicker1').pickadate({
    //     format : 'dd/mm/yyyy',
    //     formatSubmit: 'dd/mm/yyyy',
    //     max: true
    // }) 
})
    window.submitflag = 1;
    $('input[name=IsExperience]').on('change',function(){
        if($(this).val() == 'Experience'){
            $('#IfExperience').removeClass('hide');
            $('#ExperienceYear').addClass('empty_validation_class');
            $('#ExperienceMonth').addClass('empty_validation_class');
            $('#Salary').addClass('empty_validation_class');
            $('#Experience_id').val('');
            $('#Salary').val('');
            $('#ExperienceYear').val('');
            $('#ExperienceMonth').val('');
        }
        else{
            $('#IfExperience').addClass('hide');
            $('#ExperienceYear').removeClass('empty_validation_class');
            $('#ExperienceMonth').removeClass('empty_validation_class');
            $('#Salary').removeClass('empty_validation_class');
            //$('#IfSalary').css('display','none');
        }
    });
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
        var field_ids = ['VisaStatus'];
        var combo_box_error = "no";
        if($('#IsWorkPermit').prop('checked')){
            combo_box_error = checkComboBox(field_ids);     
        }
        if (error === 'yes' || combo_box_error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            var UserID = $('#UserID').val();
			var EmailID = $('#EmailID').val();
			var mob = $('#MobileNo').val();
        	var count = (mob.match(/0/g) || []).length;
			var cpass = $('#ConfirmPassword').val();
			if(!isEmail(EmailID)){
				alertify.error("<?php echo label('valid_email');?>");
				return false;
			}
			<?php if($page_name == 'add'){?>
			var pass = $('#iPassword').val();
			var flag = isPassword(pass);
            if(flag == 1){
                alertify.error("<?php echo label('password_8_32_long_min_1_char_spc_digit');?>");
                return false;
            }
			if(pass != cpass){
				alertify.error("<?php echo label('password_conf_not_macth');?>");
                return false;    
			}
			<?php }?>
			if(submitflag == 0){
				return false;
			}
			submitflag = 0;
			$.ajax({
            type:"post",
            url: "<?php echo base_url();?>admin/masters/company/emailmobileexist",
            data:{ email:EmailID,contact_no:mob,id:UserID},
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
                data: {},
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
    $(document).ready()
    {
        if(!$('#IsWorkPermit').prop('checked')){
            $("#VisaStatusDiv").addClass('hide');
        }
        else{
            $("#VisaStatusDiv").removeClass('hide');
        }

    }

    $('input[name=Gender]').on('change',function(){
        if($(this).val() == "Other"){
            $("#OtherGenderDiv").removeClass('hide');
        }else{
            $("#OtherGenderDiv").addClass('hide');
        }
    });
    $(document).on('click','#IsWorkPermit',function(){
        if($(this).prop('checked')){
            $("#VisaStatusDiv").removeClass('hide');
        }else{
            $('#VisaStatus').val('');
            $("#VisaStatusDiv").addClass('hide');
        }
    })
</script>