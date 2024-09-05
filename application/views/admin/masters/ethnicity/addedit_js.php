<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#EthnicityName').focus(); }, 1100);
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
})
    
    $('#button_submit').on('click', function ()
    {
        var error = checkValidations();
        if (error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
             var id = $('#EthnicityID').val();
             var EthnicityName = $('#EthnicityName').val();
             
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/ethnicity/checkDuplicate",
                data:{id:id,EthnicityName:EthnicityName},
                success:function(data)
                {
                    if(data == 0)
                    {
                        
                        $('#button_submit').addClass('hide');
                        $('#button_submit_loading').removeClass('hide');
                        alertify.success("<?php echo label('please_wait');?>");
                        $('form').submit();
                        
                    }
                    else
                    {
                        
                        alertify.error('Ethnicity already exists.');
                        return false;
                    }           
                }
            });


        }
        return false;
    });


    // function LoadEthnicityParent(){
       
    //     if($("#Parent").length != 0){
    //         $.ajax({
    //             type: "POST",
    //             url: base_url + "common/GetEthnicityParentCombobox"+"/0/"+$('#EthnicityID').val(),
    //             data: { },
    //             success: function (result){
    //                 $('#Parent').html(result);
    //                 $('#Parent').show();
    //                 $('#Parent').material_select();
    //             },error: function (result){
    //                 console.log("error" + result);
    //             }
    //         });
    //     }
    // }
	$(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>