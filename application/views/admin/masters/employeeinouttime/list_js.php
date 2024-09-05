<script type="text/javascript">
   $(document).ready(function () {
        
    <?php if (isset($this->session->userdata['posterror'])) {
     echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);"; } 
    ?>   
})
    window.current_page_size = 10;
    window.total_page = 1;
   /* window.In_time = '';
    window.Out_time ='';*/
    window.EmployeeID = -1;
    //window.InOutDate = '0000-00-00';
    window.Status = '-1';
    function common_ajax (current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/employeeinouttime/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                    EmployeeID:EmployeeID,
                   /* In_time: In_time,
                    Out_time:Out_time,  
                    InOutDate:InOutDate,*/
                    Status_search: Status
                },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#employeeinouttime_table_body').html(obj.a);

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
		$("#model_title").html("<?php echo label('msg_lbl_title_employeeinouttime');?>");
        common_ajax(current_page_size,total_page);
    })

    $('#button_submit').on('click', function () {
       EmployeeID =  $('#EmployeeID').val();  
     /*  Out_time =  $('#Out_time').val();  
       In_time =  $('#In_time').val();  
       InOutDate =  $('#InOutDate').val();  */
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


var field_name = ["EmployeeID"];
     $("#employeeinouttime_table_body").on('click', '.status_change', function(){
        
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type'); 
       
    $('#row_'+tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');
        
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type:"post",
            url: base_url + "admin/masters/employeeinouttime/changeStatus",
            data:{id:id,status:status},
            success:function(data)
            {
                var obj = JSON.parse(data);
                if((current_status === 'inactive' && obj.result == "success") || (obj.result == "error" && current_status === 'active'))
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                else
                {
                    $('#row_'+ tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_'+ tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');

                }           
                alertify.success(obj.message);
            }
        })
    })

    $("#employeeinouttime_table_body").on('click', '.info', function(){ //$(".info").on('click', function () {
        var id = $(this).attr('data-id');
        var table_name = "ssc_employeeinouttime";
        var field_name = "EmployeeInOutID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/employeeinouttime/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })
</script>