<script type="text/javascript">
    $(document).ready(function () {
    $("#motivationalquotes").focus();
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>   
})
    window.current_page_size = 10;
    window.total_page = 1;

    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/motivationalquotes/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);
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
        $("#model_title").html("<?php echo label('msg_lbl_motivationalquote');?>");
        common_ajax(current_page_size,total_page);
    })

    $('#select-dropdown').on('change', function () {
        var current_page_size = $('#select-dropdown').val();
        common_ajax(current_page_size,total_page);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
            var current_page_size = $('#select-dropdown').val();
        var total_page = $(this).attr('data-page-number');
        common_ajax(current_page_size,total_page);
    })

    $("#table_body").on('click', '.info', function(){ 
        var id = $(this).attr('data-id');
        var table_name = "ssc_motivationalquote";
        var field_name = "MotivationalQuoteID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/motivationalquotes/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })
    $("#table_body").on('click', '.status_change', function()
   {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
        //console.log(current_status);

        $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');
        
        $.ajax({
            type:"post",
            url: base_url + "admin/masters/motivationalquotes/changeStatus",
            data:{id:id,status:status},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if(current_status === 'inactive'){
                    $("#table_body").find('.' + active_status_icon_class).addClass('hide');
                    $("#table_body").find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }else{

                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }      
                    alertify.success(obj.message);
                     
            }
        })
    })
</script>