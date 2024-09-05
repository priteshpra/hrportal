<script>
    window.current_page_size = 10;
    window.total_page = 1;
    window.DesignationIDS = "";
    window.MinSalary = -1;
    window.MaxSalary = -1;
    window.CompanyID = $('#CompanyID').val();
    window.UserID = $('#UserID').val();
    window.JobStatus = 'All';
    window.all_job = "";
    window.mydiv = '';
    window.Salary = "-1~-1";
    window.Status = '-1';
    window.Skills = '';
    window.InterviewType = "Invited";

    function common_ajax(current_page_size, total_page, JobStatus) {
        current_page_size = (current_page_size) ? current_page_size : 10;
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/company/ajax_alljobs/" + current_page_size + "/" + total_page,
            data: {
                all_job: all_job,
                CompanyID: CompanyID,
                DesignationIDS: DesignationIDS,
                MinSalary: MinSalary,
                MaxSalary: MaxSalary,
                JobStatus: JobStatus
            },
            success: function(data) {
                if (JobStatus == "All") {
                    mydiv = "all_job";
                } else if (JobStatus == "Active") {
                    mydiv = "job_status";
                } else if (JobStatus == "RecentlyApplied") {
                    mydiv = "all_recent";
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

    function invite_ajax(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/company/ajax_directinvite/" + current_page_size + "/" + total_page,
            data: {
                Skills: Skills,
                Salary: Salary,
                UserID: UserID,
                DesignationIDS: DesignationIDS,
                InterviewType: $('input[name="InterviewType"]:checked').val(),
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (mydiv == "") {
                    mydiv = "direct_invite";
                }
                $('#' + mydiv + ' #table_body').html(obj.a);

                $('#' + mydiv + ' #table_paging_div').html(obj.b);
            },
            error: function(data) {
                alertify.error('<?php echo label('Something_went_wrong_contact_to_admin'); ?>');
            }
        })
    }

    function hired_ajax(current_page_size, total_page, type) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/company/ajax_hired/" + current_page_size + "/" + total_page + "/" + type,
            data: {
                Skills: Skills,
                Salary: Salary,
                UserID: UserID,
                DesignationIDS: DesignationIDS
            },
            success: function(data) {

                if (type == "Hired") {
                    mydiv = "hired_candidate";
                } else if (type == "HiredDecline") {
                    mydiv = "declined_candidate";
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

    function common_ajax_employee(current_page_size, total_page) {
        $.ajax({
            type: "post",
            url: base_url + "admin/masters/company/ajax_employee/" + current_page_size + "/" + total_page,
            data: {
                CompanyID: CompanyID,
                CompanyID: CompanyID,
                DesignationIDS: DesignationIDS,
                all_job: all_job,
                Status_search: Status
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
        $("#model_title").html("<?php echo label('msg_lbl_company'); ?>");
        invite_ajax(current_page_size, total_page);
        hired_ajax(current_page_size, total_page, "Hired");
        hired_ajax(current_page_size, total_page, "HiredDecline");
        common_ajax_employee(current_page_size, total_page);
        common_ajax(current_page_size, total_page, "All");
        common_ajax(current_page_size, total_page, "Active");
        common_ajax(current_page_size, total_page, "RecentlyApplied");


    })
    $('.all_active_inactive').on('click', function() {
        mydiv = $(this).attr('data-div');
        var type = $(this).attr('data-type');
        Salary = $('#' + mydiv + ' .search_action #Salary').val();
        all_job = $('#' + mydiv + ' .search_action #jobtitle').val();
        var type = $(this).attr('data-type');
        DesignationIDS = $('#' + mydiv + ' .search_action #DesignationID').val();
        //InterviewType = $('#'+mydiv+' .search_action input[name="InterviewType"]:checked').val();
        //CompanyID = $('#'+mydiv+' .search_action #CompanyID').val();
        CompanyID = $('#CompanyID').val();
        UserID = $('#UserID').val();
        Skills = $('#' + mydiv + ' .search_action #Skills').val();
        if (type == "Invited") {
            invite_ajax(current_page_size, total_page);
        } else if (type == "Employee") {
            common_ajax_employee(current_page_size, total_page);
        } else if (type == "Hired") {
            hired_ajax(current_page_size, total_page, type);
        } else if (type == "HiredDecline") {
            hired_ajax(current_page_size, total_page, type);

        } else {
            common_ajax(current_page_size, total_page, type);
        }
    })

    $('.tabclick').on('click', function() {
        mydiv = $(this).attr('data-div');
        type = $(this).attr('data-type');

        current_page_size = $('#' + mydiv + ' #select-dropdown').val();
        if (type == "Invited") {
            invite_ajax(current_page_size, total_page);
        } else if (type == "Employee") {
            common_ajax_employee(current_page_size, total_page);
        } else if (type == "Hired") {
            hired_ajax(current_page_size, total_page, type);
        } else if (type == "HiredDecline") {
            hired_ajax(current_page_size, total_page, type);

        } else {
            common_ajax(current_page_size, total_page, type);
        }
    })
    $('.select-dropdown').on('change', function() {
        mydiv = $(this).attr('data-div');
        type = $(this).attr('data-type');
        current_page_size = $('#' + mydiv + ' #select-dropdown').val();
        if (type == "Invited") {
            invite_ajax(current_page_size, total_page);
        } else if (type == "Employee") {
            common_ajax_employee(current_page_size, total_page);
        } else if (type == "Hired") {
            hired_ajax(current_page_size, total_page, type);
        } else if (type == "HiredDecline") {
            hired_ajax(current_page_size, total_page, type);

        } else {
            common_ajax(current_page_size, total_page, type);
        }
    })
    $('.table_paging_div').on('click', '.pagination_buttons', function() {
        type = $(this).parents("#table_paging_div").attr('data-type');
        var page = $(this).attr('data-page-number');
        if (type == "Invited") {
            invite_ajax(current_page_size, page);
        } else if (type == "Employee") {
            common_ajax_employee(current_page_size, page);
        } else if (type == "Hired") {
            hired_ajax(current_page_size, page, type);
        } else if (type == "HiredDecline") {
            hired_ajax(current_page_size, page, type);

        } else {
            common_ajax(current_page_size, page, type);
        }
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
        $("#" + mydiv + " input[value='Invited']").click();
    });
</script>