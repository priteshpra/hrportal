<script>
    $(document).ready(function () {
        setTimeout(function(){ $('.select2_class .select-dropdown').first().click(); }, 1100);
        $(".select2_class").change(function(){
                $(".select2_class option:selected").val();
                $(".active").style("display", "none");
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
        var field_ids = ['QualificationID','Grade'];
        var error = checkValidations();
        var combo_box_error = checkComboBox(field_ids);
        if (error === 'yes' || combo_box_error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        } else
        {
           	$('#button_submit').addClass('hide');
			$('#button_submit_loading').removeClass('hide');
			alertify.success("<?php echo label('please_wait');?>");
			$('form').submit();
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