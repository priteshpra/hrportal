<script type="text/javascript">
   $(document).ready(function () {
        
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>   
})
    /* Global variables from footer.php : 
     - active_status_icon_class
     - inactive_status_icon_class
     - loading_status_icon_class
     - base_url
     */
    $(document).ready(function () {
        
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>   
})
    window.MessageKey = '';
    window.Message = '';
    window.LanguageID = '-1';
    window.Status = '-1';
    window.current_page_size = 10;
    window.total_page = 1;
    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/message/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    MessageKey:MessageKey,  
                    Message:Message,
                    LanguageID:LanguageID,
                    Status_search:Status
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#message_table_body').html(obj.a);

                $('#table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    }
    //---------pagiing and search----------//     
    $(document).ready(function () {
        $('#data-table-simple_info').hide();
		$("#model_title").html("<?php echo label('msg_lbl_message');?>");
        common_ajax(current_page_size,total_page);
    })

    $('#button_message_submit').on('click', function () {
        MessageKey =  $('#MessageKey').val();
        Message =  $('#Message').val();
        LanguageID =  $('#LanguageID').val();
        Status = $('input[name="Status_search"]:checked').val();
        var temp = $('#select-dropdown').val();
        common_ajax(temp,total_page);

    })

    $('#select-dropdown').on('change', function () {
        var temp = $('#select-dropdown').val();
        common_ajax(temp,total_page);

    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp,page);
    })


 var field_name = ["MessageName"]; 
   $("#message_table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-message-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);
        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-message-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type:"post",
            url: base_url + "admin/masters/message/changeStatus",
            data:{id:id,status:status},
            success:function(data)
            {
                if(current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    alertify.success('<?php echo SUCCESS_ACTIVE_MESSEGE;?>');

                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    alertify.success('<?php echo SUCCESS_INACTIVE_MESSEGE;?>');

                }           
            }
        })
    })

   

  
     function loadmessageBasedStates()
     {}
</script>