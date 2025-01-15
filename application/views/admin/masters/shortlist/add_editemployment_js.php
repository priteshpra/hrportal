<script>
    $(document).ready(function () {
         <?php if($page_name == 'addemployment'){?>
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
    if($('#IsPresent').is(':checked')){
		$('#EndDateDiv').addClass('hide');
        $('#EndDate').removeClass('empty_validation_class');
	}
	else{   
		$('#EndDateDiv').removeClass('hide');
        $('#EndDate').addClass('empty_validation_class');
	} 
    $('.datepicker1').pickadate({
        format : 'dd/mm/yyyy',
        formatSubmit: 'dd/mm/yyyy',
        max: true
    })     
})
    window.submitflag = 1;
    $('#button_submit').on('click', function ()
    {
        var startdate = $('#StartDate').val();
        var enddate = $('#EndDate').val();
        var error = checkValidations();
        var field_ids = ['DesignationID'];
   		var combo_box_error = checkComboBox(field_ids);
        if (error === 'yes' || combo_box_error === 'yes')
        {
            alertify.error("<?php echo label('required_field'); ?>");
            return false;

        } else
        {
            if(enddate != ""){
            if (startdate >= enddate){

                alertify.error("<?php echo label('startdate_greater_enddate'); ?>");
                return false;
            }}
           	$('#button_submit').addClass('hide');
			$('#button_submit_loading').removeClass('hide');
			alertify.success("<?php echo label('please_wait');?>");
			$('form').submit();
		}
		return false;
    });
    $('#IsPresent').on('change',function(){
    	if(this.checked !== false){
    		$('#EndDateDiv').addClass('hide');
            $('#EndDate').val('');
            $('#EndDate').removeClass('empty_validation_class');
    	}
    	else{
    		$('#EndDateDiv').removeClass('hide');
            $('#EndDate').addClass('empty_validation_class');
        }
    });
    
	$(document).keypress(function (e) {
        if (e.which == 13) {
            $("#button_submit").click();
            return false;
        }
    });
</script>