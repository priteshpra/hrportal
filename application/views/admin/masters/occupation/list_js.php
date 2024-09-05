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
    function export_excel() {

        $('form').submit();
    }

    window.current_page_size = 10;
    window.total_page = 1;
    function common_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/occupation/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                Name: $('#Name').val(),
                Status_search: $('input[name="Status_search"]:checked').val()
            },
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('#occupation_table_body').html(obj.a);

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

    $('#button_occupation_submit').on('click', function () {
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


    var field_name = ["Name"];
    $("#occupation_table_body").on('click', '.status_change', function ()
    {
        var tr_id = $(this).attr('data-occupation-id');
        var current_status = $(this).attr('data-icon-type');
        //console.log(current_status);
        $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-occupation-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type: "post",
            url: base_url + "admin/masters/occupation/changeStatus",
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

    $("#occupation_table_body").on('click', '.info', function () { //$(".info").on('click', function () {
        var id = $(this).attr('data-occupation-id');
        var table_name = "sssf_occupation";
        var field_name = "OccupationID";
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/occupation/getRecordInfo",
            data: {id: id, table_name: table_name, field_name: field_name},
            success: function (data)
            {
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })

    $('.delete_floating_icon').on('click', function () {
        var multiple_checkbox_id = new Array();
        $("input:checkbox[name=Status]:checked").each(function () {
            multiple_checkbox_id.push($(this).attr('data-occupation-id'));
        });
        var ids = multiple_checkbox_id.join();
        var table_name = "ssh_occupation";
        var field_name = "occupationID";

        $.ajax({
            type: "post",
            url: base_url + "admin/masters/occupation/multipleChangeStatus",
            data: {ids: ids, table_name: table_name, field_name: field_name},
            success: function (data)
            {
                for (i = 0; i < multiple_checkbox_id.length; i++)
                {
                    $('#row_' + multiple_checkbox_id[i]).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_' + multiple_checkbox_id[i]).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + multiple_checkbox_id[i]).find('.' + loading_status_icon_class).addClass('hide');
                }
            }
        })
    })


    function changeFilter(filter_option = ""){

        if (filter_option == "Filter")
        {
            $(".ScrollStyle").show();
            $(".search_action").show();
            $('#display_action').removeClass("mdi-hardware-keyboard-arrow-down")
            $("#display_action").addClass("mdi-hardware-keyboard-arrow-up");
        } else {

            $("#Name").val('');
            $("#select2-occupationID-container").text('select occupation');
            // $("#Status_search").val('');
            $('input[name="Status_search"][value="-1"]').prop("checked", true);
            $(".ScrollStyle").hide();
            $(".search_action").hide();
            $("#button_occupation_submit").trigger("click");
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
            changeFilter("ALL");
            return;
        }

        $(".ScrollStyle").toggle();
        $(".search_action").toggle();
    }
    function loadoccupationBasedStates()
    {}
</script>