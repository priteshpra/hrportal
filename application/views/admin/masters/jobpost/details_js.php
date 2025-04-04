<script type="text/javascript">
    $(document).ready(function() {

        <?php if (isset($this->session->userdata['posterror'])) {
            echo "setTimeout(function(){ alertify.error('" . $this->session->userdata['posterror'] . " ')}, 2000);";
        }
        ?>
    })
    window.current_page_size = 10;
    window.total_page = 1;
    window.upcomingpage = 1;
    window.DesignationID = '';
    window.UserID = $('#UserID').val();
    window.ID = $('#JobPostID').val();
    window.JobStatus = 'All';
    window.salary = "-1~-1";
    window.Skills = '';
    window.mydiv = '';

    function common_ajax(current_page_size, total_page, JobStatus) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/jobpost/ajax_jobtabs/" + current_page_size + "/" + total_page + "/" + JobStatus,
            data: {
                salary: salary,
                UserID: UserID,
                ID: ID,
                DesignationID: DesignationID,
                Skills: Skills,
                JobStatus: JobStatus
            },
            success: function(data) {
                if (JobStatus == "View") {
                    mydiv = "view_job";
                } else if (JobStatus == "Applied") {
                    mydiv = "all_applied";
                } else if (JobStatus == "Shortlisted") {
                    mydiv = "all_shortlisted";
                } else if (JobStatus == "Invited") {
                    mydiv = "all_invited";
                } else if (JobStatus == "Accept") {
                    mydiv = "all_accepted";
                } else if (JobStatus == "Decline") {
                    mydiv = "all_declined";
                }
                var obj = JSON.parse(data);
                $('#' + mydiv + ' #table_body').html(obj.a);

                $('#' + mydiv + ' #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })

    }

    function myFunction(UserID) {
        var DesignationIDs = DesignationID; //$("#DesignationID").val();
        var Location = ''; //$("#Location").val();
        var Skillss = ''; //$("#Skillss").val();
        var jobSearchText = $("#jobSearchText").val();
        var jobID = $("#jobID").val();
        // CompanyEmployeeUserID = $("#CompanyEmployeeUserID").val();
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/candidate/ajax_listingshort/" + current_page_size + "/" + total_page,
            data: {
                Skills: Skillss,
                Salary: salary,
                Location: Location,
                DesignationID: DesignationIDs,
                jobSearchText: jobSearchText,
                jobID: jobID,
                CompanyEmployeeUserID: UserID
            },
            success: function(data) {
                var objs = JSON.parse(data);
                $('#table_bodyshort').html(objs.a);
                $('#table_paging_divshort').html(objs.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function actionButton(status, UserID, JobId, CompanyEmployeeUserID) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/masters/jobpost/upsertCompanyJobAction/" + status + '/' + UserID + '/' + JobId + '/' + CompanyEmployeeUserID,
            data: {
                UserID: UserID
            },
            success: function(result) {
                location.reload();
            },
            error: function(result) {
                console.log("error" + result);
            }
        });
    }
    //---------pagiing and search----------//     
    $(document).ready(function() {
        $('#data-table-simple_info').hide();
        $("#model_title").html("<?php echo label('msg_lbl_company'); ?>");
        common_ajax(current_page_size, total_page, 'View');
        common_ajax(current_page_size, total_page, "Applied");
        common_ajax(current_page_size, total_page, "Shortlisted");
        myFunction(UserID);
        common_ajax(current_page_size, total_page, "Invited");
        common_ajax(current_page_size, total_page, "Accept");
        common_ajax(current_page_size, total_page, "Decline");
    })
    $('.all_active_inactive').on('click', function() {
        salary = $('#' + mydiv + ' .search_action #Salary').val();
        JobStatus = $(this).attr('data-type');
        current_page_size = $('#' + mydiv + ' #select-dropdown').val();
        common_ajax(current_page_size, total_page, JobStatus);

    })
    $('.tabclick').on('click', function() {
        mydiv = $(this).attr('data-div');
        JobStatus = $(this).attr('data-type');
        current_page_size = $('#' + mydiv + ' #select-dropdown').val();
        common_ajax(current_page_size, total_page, JobStatus);

    })
    $('.select-dropdown').on('change', function() {
        current_page_size = $('#' + mydiv + ' #select-dropdown').val();
        common_ajax(current_page_size, total_page, JobStatus);
    })
    $('.table_paging_div').on('click', '.pagination_buttons', function() {
        var page = $(this).attr('data-page-number');
        common_ajax(current_page_size, page, JobStatus);
    })
    $('.all_active_inactives').on('click', function() {
        salary = $('#' + mydiv + ' .search_action #Salary').val();
        JobStatus = $(this).attr('data-type');
        Skills = $("#Skillss").val();
        DesignationID = $("#DesignationID").val();
        var temp = $('#select-dropdown').val();
        current_page_size = $('#' + mydiv + ' #select-dropdown').val();
        common_ajax(current_page_size, total_page);
        myFunction(UserID);

    })
    $(document).on("click", ".changeFilter", function() {
        var filter_option = $(this).val();
        var mydiv = $(this).attr('data-div');
        if (filter_option == "Filter") {
            setTimeout(function() {
                $("#" + mydiv + " .search_action.card-panel input").first().focus();
            }, 500);
            $("#" + mydiv + " .search_action").show();
            $("#" + mydiv + " #display_action").removeClass("mdi-hardware-keyboard-arrow-down")
            $("#" + mydiv + " #display_action").addClass("mdi-hardware-keyboard-arrow-up");
        } else {
            $("#" + mydiv + " .search_action").find("input[type=text], textarea").val("");
            $("#" + mydiv + " .search_action").find("select").val('').material_select();
            $('input[name="Status_search"][value="-1"]').prop("checked", true);
            $("#" + mydiv + " .search_action").hide();
            $("#" + mydiv + " button[type='button']").click();
            $("#" + mydiv + ' #display_action').removeClass("mdi-hardware-keyboard-arrow-up")
            $("#" + mydiv + " #display_action").addClass("mdi-hardware-keyboard-arrow-down");
        }
    });
    $(document).on("click", ".filtercls", function() {
        var mydiv = $(this).attr('data-div');
        if ($('#' + mydiv + ' #display_action').hasClass('mdi-hardware-keyboard-arrow-down')) {
            $("#" + mydiv + " input[value='Filter']").click();
        } else {
            $("#" + mydiv + " input[value='All']").click();
        }
    });
    $(document).on("click", ".clear-all", function() {
        var mydiv = $(this).attr('data-div');
        $("#" + mydiv + " .search_action").find("input[type=text],input[type=email],input[type=number],textarea").val("");
        $("#" + mydiv + " .search_action").find("select").val('').material_select();
        $("#" + mydiv + " input[value='All']").click();
    });
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
        common_ajax(current_page_size, total_page, JobStatus);

    });
</script>