<script>
    
     $(document).ready(function () {
       setTimeout(function(){ $('#UOM').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>   

            });
/*Function For Buutoon click event */
     window.submitflag = 1;
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }
        else
        {
            var id = $('#cuid').val();
            var UOM = $('#UOM').val();
            if(submitflag == 0){
                return false;
            }
            submitflag = 0;
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/uom/checkDuplicate",
                data:{
                    table_name:'ssc_uom',
                    field_name:'UOM',
                    data_value:UOM,
                    ufield:'UOMID',
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
                        alertify.error("<?php echo label('uom_already_exists');?>");
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
    //End
</script>