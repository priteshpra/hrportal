<script>
    $(document).ready(function () {
        setTimeout(function(){ $('.select2_class .select-dropdown').first().click(); }, 1100);
        $(".select2_class").change(function(){
                $(".select2_class option:selected").val();
                $(".active").hide();
            });
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
        var field_ids = ['LanguageID'];
        var error = checkValidations();
        var combo_box_error = checkComboBox(field_ids);
        if (error === 'yes' || combo_box_error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
           	// var IsRead = $('#IsRead').is(':checked');
            // var IsWrite = $('#IsWrite').is(':checked');
            // var IsSpeak = $('#IsSpeak').is(':checked');
            // //if(IsRead)
            var id = $('#ULid').val();
            var cuid = $('#cuid').val();
            var Proficiency = $('#Proficiency').val();
            // if(IsRead == false && IsWrite == false && IsSpeak == false){
            //     alertify.error("<?php echo label('select_one_lang');?>");
            //     return false;
            // }
            if(submitflag == 0){
                  return false;
              }
            submitflag == 0;
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/candidate/CheckDuplicateDouble",
                data:{
                    table_name:'ssc_userlanguage',
                    field_name:'LanguageID',
                    data_value:Proficiency,
                    field_name1:'UserID',
                    data_value1: cuid, 
                    ufield:'UserLanguageID',
                    ID:id
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
                        alertify.error("<?php echo label('language_already_exists');?>");
                        return false;
                    }      
                },
                error:function(data){
                    alert("error");
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