<script>
    $(document).ready(function () {
         <?php if($page_name == 'addskill'){?>
            setTimeout(function(){ $('.select2_class .select-dropdown').first().click(); }, 1100);
            $(".select2_class").change(function(){
                $(".select2_class option:selected").val();
                $(".active").style("display", "none");
            });
        <?php
       }?>
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
        var field_ids = ['SkillID'];
   		var combo_box_error = checkComboBox(field_ids);
        if (error === 'yes' || combo_box_error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/candidate/CheckDuplicateDouble",
                data:{
                    table_name:'ssc_userskill',
                    field_name:'SkillID',
                    data_value:$('#SkillID').val(),
                    field_name1:'UserID',
                    data_value1:$('#UserID').val(),
                    ufield:'UserSkillID',
                    ID:$('#UserSkillID').val(),
                    },
              success:function(data)
                {
                    submitflag = 1;
                    var obj = JSON.parse(data);

                    if(obj.result == 'Success'){
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('form').submit();
                        
                    }else{
                        alertify.error("<?php echo label('skill_already_exists');?>");
                        return false;
                    }           
                }
            });

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