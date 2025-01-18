<script type="text/javascript">
    $(document).ready(function() {

        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
    })
    window.current_page_size = 10;
    window.total_page = 1;
    window.Skills = '';
    window.Salary = '-1~-1';
    window.SortBy = 'Name';
    window.SortByOrder = 'ASC';
    window.Location = '';
    window.DesignationID = '';

    function common_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_listing/" + current_page_size + "/" + total_page,
            data: {
                Skills: Skills,
                Salary: Salary,
                SortBy: SortBy,
                SortByOrder: SortByOrder,
                Location: Location,
                DesignationID: DesignationID,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#table_body').html(obj.a);
                $('#table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }
    //---------pagiing and search----------//     
    $(document).ready(function() {
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_candidate'); ?>");
        common_ajax(current_page_size, total_page);
    })

    $('#button_submit').on('click', function() {
        Skills = $("#Skills").val();
        Salary = $("#Salary").val();
        Location = $("#Location").val();
        DesignationID = $("#DesignationID").val();
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);

    })

    $('#select-dropdown').on('change', function() {
        var temp = $('#select-dropdown').val();
        common_ajax(temp, total_page);

    })

    $('#table_paging_div').on('click', '.pagination_buttons', function() {
        var temp = $('#select-dropdown').val();
        var page = $(this).attr('data-page-number');
        common_ajax(temp, page);
    })

    $("#table_body").on('click', '.status_change', function() {
        var tr_id = $(this).attr('data-id');
        var current_status = $(this).attr('data-icon-type');
        //console.log(current_status);
        $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
        $('#row_' + tr_id).find('.' + loading_status_icon_class).removeClass('hide');

        var id = $(this).attr('data-id');
        var status = $(this).attr('data-new-status');

        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/changeStatus",
            data: {
                id: id,
                status: status
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (current_status === 'inactive') {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                } else {
                    $('#row_' + tr_id).find('.' + active_status_icon_class).addClass('hide');
                    $('#row_' + tr_id).find('.' + inactive_status_icon_class).removeClass('hide');
                    $('#row_' + tr_id).find('.' + loading_status_icon_class).addClass('hide');
                }
                alertify.success(obj.message);

            }
        })
    })

    $("#table_body").on('click', '.info', function() {
        var id = $(this).attr('data-id');
        var table_name = "ssc_candidate";
        var field_name = "UserID";
        if ($(this).attr('data-table') == 'project') {
            table_name = "ssc_user".$(this).attr('data-table');
            field_name = "UserProjectID";
        }
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/getRecordInfo",
            data: {
                id: id,
                table_name: table_name,
                field_name: field_name
            },
            success: function(data) {
                $("#record_info").html(data);
                $('.modal').openModal();
            }
        })
    })

    function LoadStatesBasedCountry() {

        if ($("#StateDiv").length != 0) {
            $.ajax({
                type: "POST",
                url: base_url + "common/GetStateBasedCombobox" + "/0/" + $('#CountryID').val(),
                data: {},
                success: function(result) {
                    $('#StateDiv').html(result);
                    $('#StateDiv').show();
                    $('#StateID').material_select();
                },
                error: function(result) {
                    console.log("error" + result);
                }
            });
        }
    }

    function LoadCitiesBasedStates() {
        if ($("#CityDiv").length != 0) {
            $.ajax({
                type: "POST",
                url: base_url + "common/GetCityBasedCombobox" + "/0/" + $('#StateID').val(),
                data: {
                    country: $('#StateID').val()
                },
                success: function(result) {
                    $('#CityDiv').html(result);
                    $('#CityDiv').show();
                    $('#CityID').material_select();
                },
                error: function(result) {
                    console.log("error" + result);
                }
            });
        }
    }
    $('.filter').on('click', function() {
        SortBy = $(this).attr('data-filter');
        $('.filter').removeClass('active');
        if ($(this).find('.up').hasClass('hide')) {
            $(this).find('.up').removeClass('hide');
            $(this).find('.down').addClass('hide');
            SortByOrder = "ASC";
        } else {
            $(this).find('.down').removeClass('hide');
            $(this).find('.up').addClass('hide');
            SortByOrder = "DESC";
        }
        $(this).addClass('active');
        common_ajax(current_page_size, total_page);

    });
</script>