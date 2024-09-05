<script type="text/javascript">
    function export_excel() {

        $('form').submit();
    }
    window.current_page_size = 10;
    window.total_page = 1;
	window.ActivityDate = "";
	window.MethodName = "";
    function common_ajax(current_page_size, total_page)
    {
        $(".ScrollStyleDiv1").hide();
        $('#data-table-simple_info').hide();
		
        $.ajax({
            type: "post",
            url: base_url + "admin/configuration/errorlog/ajax_listing/" + 10 + "/" + 1,
            data: {
                MethodName: MethodName,
                ActivityDate: ActivityDate
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#errorlog_table_body').html(obj.a);

                $('#table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })

    }
    $(document).ready(function () {
        common_ajax(current_page_size, total_page);

        $('.datepicker1').pickadate({
        format : 'dd/mm/yyyy',
        formatSubmit: 'dd/mm/yyyy',
        max: true
    }) 
    })

    $('#button_submit').on('click', function () {
        MethodName = $('#MethodName').val();
		ActivityDate = $('#ActivityDate').val();
		var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);
    })

    $('#select-dropdown').on('change', function () {
        $.ajax({
            type: "post",
            url: base_url + "admin/configuration/errorlog/ajax_listing/" + $('#select-dropdown').val() + "/" + 1,
            data: {
                MethodName_search: $('#MethodName_search').val(),
                //Status_search:$('#Status_search').val()
                Status_search: $('input[name="Status_search"]:checked').val()
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#errorlog_table_body').html(obj.a);

                $('#table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })

    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        var page = $(this).attr('data-page-number');
         $.ajax({
            type: "post",
            url: base_url + "admin/configuration/errorlog/ajax_listing/" + $('#per_page_value').val() + "/" + page,
            data: {
                MethodName_search: $('#MethodName_search').val(),
                Status_search: $('input[name="Status_search"]:checked').val()
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#errorlog_table_body').html(obj.a);

                $('#table_paging_div').html(obj.b);
            },
            error: function (data)
            {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin');?>');
            }
        })
    })

    
</script>