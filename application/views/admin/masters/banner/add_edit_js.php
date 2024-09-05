<script>
$(document).ready(function () {
    setTimeout(function(){ $('#BannerTitle').focus();  }, 1100);
   <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>     
    <?php if (isset($this->session->userdata['postsuccess'])) {
     echo "setTimeout(function(){ alertify.success('" . $this->session->userdata['postsuccess'] . " ')}, 2000);"; } 
    ?>     
});
 window.submitflag = 1;
	$('#button_submit').on('click', function ()
    {  
      var error = checkValidations();
		  var redirecturl = $('#RedirectURL').val();
		
      if(error === 'yes'){ 
        alertify.error("<?php echo label('required_field');?>");
        return false;
      }else{
            var val = $("input[name='Type']:checked").val();
			      var id = $('#BannerID').val();
            var Sequence = $('#Sequence').val();

              if(redirecturl != '' && !isUrlValid(redirecturl)){
                alertify.error("<?php echo label('enter_valid_redirecturl');?>");
                return false;
              }
             
               if(submitflag == 0){
                  return false;
              }
            submitflag == 0;
            $.ajax({
                type:"post",
                url: base_url + "admin/masters/area/checkDuplicate",
                data:{
                    table_name:'  ssc_banner',
                    field_name:'Sequence',
                    data_value:Sequence,
                    ufield:'BannerID',
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
                        alertify.error("<?php echo label('sequence_already_exists');?>");
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
