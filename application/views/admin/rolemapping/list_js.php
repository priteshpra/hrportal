<script type="text/javascript">
    /* Global variables from footer.php : 
     - active_status_icon_class
     - inactive_status_icon_class
     - loading_status_icon_class
     - base_url
     */
    function export_excel() {

        $('form').submit();
    }

    window.current_page_size = 10;
    window.total_page = 1;
    function common_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/rolemapping/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                RoleName: $('#RoleName').val(),
                Name: $('#Name').val(),
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#role_table_body').html(obj.a);
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
    })

    $('#button_role_submit').on('click', function () {
        //alert('hiii');
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);

    })

    $('#select-dropdown').on('change', function () {
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);

    })

    $('#table_paging_div').on('click', '.pagination_buttons', function () {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp, page);
    })


    var field_name = ["RoleName"];
    $("#role_table_body").on('click', '.status_change', function ()
    {
        var tr_id = $(this).attr('data-role-id');
        var current_status = $(this).attr('data-icon-type');
        //console.log(current_status);
        $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-role-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type: "post",
            url: base_url + "admin/rolemapping/changeStatus",
            data: {id: id, status: status},
            success: function (data)
            {
                if (current_status === 'inactive')
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    alertify.success('<?php echo SUCCESS_ACTIVE_MESSEGE; ?>');

                } else
                {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                    alertify.success('<?php echo SUCCESS_INACTIVE_MESSEGE; ?>');

                }
            }
        })
    })
    $("#role_table_body").on('click', '.info', function(){ //$(".info").on('click', function () {
        var id = $(this).attr('data-role-id');
        var table_name = "ssse_admindetails";
        var field_name = "UserID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/month/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            { 
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })

    function changeFilter(filter_option = "") {

        if (filter_option == "Filter")
        {
            $(".ScrollStyle").show();
            $(".search_action").show();
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-up");
        } else {

            $("#RoleName").val('');
            $("#Name").val('');
            $(".ScrollStyle").hide();
            $(".search_action").hide();
            $("#button_role_submit").trigger("click");
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-down");

        }
    }
    function clearAllFilter() {
        $("#All").prop("checked", true)
        changeFilter('All');
        $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up")
        $("#display_action").addClass("mdi-hardware-keyboard-arrow-down");
    }
    function field_display() {
        var display_class = ($('#display_action').attr('class'));
        if (display_class == 'mdi-hardware-keyboard-arrow-down')
        {
            $("#Filter").prop("checked", true);
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-up");
        } else
        {
            $("#All").prop("checked", true);
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-up")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-down");
            changeFilter("All");
            return;
        }

        $(".ScrollStyle").toggle();
        $(".search_action").toggle();
    }
    function loadalbumBasedStates()
    {}
</script>