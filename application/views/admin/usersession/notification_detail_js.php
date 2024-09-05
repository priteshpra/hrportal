<script>
    window.current_page_size = 10;
    window.total_page = 1;
    window.upcomingpage = 1;
    window.UserID = $('#UserID').val();

    function notification_ajax (current_page_size,total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/usersession/ajax_notification/"+ current_page_size + "/" + total_page,
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
                alert(data);
            }
        })
    }

    //---------pagiing and search----------//     

     $(document).ready(function () {
        $("#model_title").html("<?php echo label('msg_lbl_title_notificationmessages');?>");
        notification_ajax(current_page_size,total_page);

    })

    $('.select-dropdown').on('change', function () {
        var total_page = $('#select-dropdown').val();
        notification_ajax(total_page,upcomingpage);
    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        notification_ajax(temp,page);
    })

</script>