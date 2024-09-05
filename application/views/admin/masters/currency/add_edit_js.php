<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#CurrencyName').focus(); }, 1100);
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
            var id = $('#cuid').val();
			var CurrencyName = $('#CurrencyName').val();
			 
			$.ajax({
				type:"post",
				url: base_url + "admin/masters/currency/checkDuplicate",
				data:{id:id,CurrencyName:CurrencyName},
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
						
						alertify.error('Currency already exists.');
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