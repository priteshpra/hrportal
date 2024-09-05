<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#VideoTitle').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
})
    window.submitflag = 1;
    $('#Flag').change(function(){
        if($(this).is(':checked')){
            $("#pricediv").addClass('hide');
            $("#Price").removeClass('empty_validation_class');
        }else{
            $("#pricediv").removeClass('hide');
            $("#Price").addClass('empty_validation_class');
        }
    });
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
		var field_ids = ['UserID'];
        var combo_box_error = checkComboBox(field_ids);	
        if (error === 'yes' || combo_box_error =='yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
            var id = $('#VideoID').val();
            var VideoTitle = $('#VideoTitle').val();
             if(submitflag == 0){
                return false;
            }
            if(!$("#Flag").is(':checked')){
                if($("#Price").val() <= 0){
                    alertify.error("<?php echo label('msg_lbl_please_enter_valid_price');?>");
                    return false;
                }
            }
            submitflag == 0;
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/video/checkDuplicate",
                data:{
                    table_name:'ssc_video',
                    field_name:'VideoTitle',
                    data_value:VideoTitle,
                    ufield:'VideoID',
                    ID:id,
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
                        alertify.error("<?php echo label('videotitle_already_exists');?>");
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