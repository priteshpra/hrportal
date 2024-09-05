<script type="text/javascript">

    function export_excel() {

        $('form').submit();
    }

    window.current_page_size = 10;
    window.total_page = 1;
	 window.ActivitylogName = '';
	 window.ActivityDate = '';

    function common_ajax(current_page_size, total_page)
    {
        $.ajax({
            type: "post",
            url: base_url + "admin/configuration/activitylog/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                ActivitylogName: ActivitylogName,
                ActivityDate: ActivityDate
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#customer_activitylog_table_body').html(obj.a);
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
        common_ajax(current_page_size, total_page);

        $('.datepicker1').pickadate({
        format : 'dd/mm/yyyy',
        formatSubmit: 'dd/mm/yyyy',
        max: true
    }) 
    })

    $('#button_submit').on('click', function () {
        ActivitylogName = $('#ActivitylogName').val();
        ActivityDate = $('#ActivityDate').val();
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);

    })

    $('#select-dropdown').on('change', function () {
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);

    })

    $(document).on('click', '#table_paging_div a.pagination_buttons', function () {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp, page);
    })
//---------/end pagiing and search----------//     


</script>