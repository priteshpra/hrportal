<script>
    window.current_page_size = 10;
    window.total_page = 1;
    window.DesignationID = "";
    window.MinSalary = -1;
    window.MaxSalary = -1;
    window.CompanyID = $('#CompanyID').val();
    window.JobStatus = 'All';
    window.all_job = "";
    window.mydiv = '';
    window.salary = "";
    window.Status = '-1';
    function common_ajax (current_page_size, total_page,JobStatus) {
        $.ajax({
            type: "post",
            url: base_url + "company/jobpost/ajax_jobpost/" + current_page_size + "/" + total_page,
            data: {
                    JobStatus:JobStatus,
                    all_job:all_job,
                    CompanyID:CompanyID,
                    DesignationID:DesignationID,
                },
            success: function (data)
            {   
                    if(JobStatus ==  "All"){
                        mydiv="all_job";
                    }else if(JobStatus ==  "Active"){
                        mydiv="job_status";
                    }else if(JobStatus ==  "RecentlyApplied"){
                        mydiv="all_recent";
                    }
                var obj = JSON.parse(data);
                $('#'+mydiv+' #table_body').html(obj.a);

                $('#'+mydiv+' #table_paging_div').html(obj.b);
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
        $("#model_title").html("<?php echo label('msg_lbl_company');?>");
        common_ajax(current_page_size,total_page, "All");
        common_ajax(current_page_size,total_page, "Active");
        common_ajax(current_page_size,total_page, "RecentlyApplied");
    })

    $('.all_active_inactive').on('click', function () {
        mydiv = $(this).attr('data-div');
        var type = $(this).attr('data-type');
        salary = $('#'+mydiv+' .search_action #salary').val();
        all_job = $('#'+mydiv+' .search_action #jobtitle').val();
        var type = $(this).attr('data-type');
        DesignationID = $('#'+mydiv+' .search_action #DesignationID').val();
        common_ajax(current_page_size,total_page,type);
     })

    $('.tabclick').on('click', function () {
        mydiv = $(this).attr('data-div');
        type = $(this).attr('data-type');
        current_page_size = $('#'+mydiv+' #select-dropdown').val();
        all_job = $('#'+mydiv+' .search_action #jobtitle').val();
        DesignationID = $('#'+mydiv+' .search_action #DesignationID').val();
        common_ajax(current_page_size,total_page,type);    
    })

    $('.select-dropdown').on('change', function () {
        mydiv = $(this).attr('data-div');
        type = $(this).attr('data-type');
        current_page_size = $('#'+mydiv+' #select-dropdown').val();
    
        common_ajax(current_page_size,total_page,type);
        
    })
    $('.table_paging_div').on('click', '.pagination_buttons', function(){
        type = $(this).parents("#table_paging_div").attr('data-type');
        var page = $(this).attr('data-page-number');
    
        common_ajax(current_page_size,page,type);
        
    })

    $(document).on("click",".changeFilter",function(){
            var filter_option = $(this).val();
            var mydiv = $(this).attr('data-div');
            if(filter_option == "Filter"){ 
                setTimeout(function(){
                    $("#" + mydiv + " .search_action.card-panel input").first().focus();
                }, 500);
                $("#" + mydiv + " .search_action").show();
                $("#" + mydiv + " #display_action").removeClass("mdi-hardware-keyboard-arrow-down" )
                $("#" + mydiv + " #display_action").addClass( "mdi-hardware-keyboard-arrow-up" );
            }else{
                $("#" + mydiv + " .search_action").find("input[type=text], textarea").val("");
                $("#" + mydiv + " .search_action").find("select").val('').material_select();
                $('input[name="Status_search"][value="-1"]').prop("checked", true);
                $("#" + mydiv + " .search_action").hide();
                $("#" + mydiv + " button[type='button']").click();
                $("#" + mydiv + ' #display_action').removeClass("mdi-hardware-keyboard-arrow-up" )
                $("#" + mydiv + " #display_action").addClass( "mdi-hardware-keyboard-arrow-down" );
            }     
        });
    $(document).on("click",".filtercls",function(){
        var mydiv = $(this).attr('data-div');
        if($('#' + mydiv + ' #display_action').hasClass('mdi-hardware-keyboard-arrow-down')){
            $("#" + mydiv + " input[value='Filter']").click();
        }else{
            $("#" + mydiv + " input[value='All']").click();
        }
    });
    $(document).on("click",".clear-all",function(){
            var mydiv = $(this).attr('data-div');
            $("#" + mydiv + " .search_action").find("input[type=text],input[type=email],input[type=number],textarea").val("");
            $("#" + mydiv + " .search_action").find("select").val('').material_select();
            $("#" + mydiv + " input[value='All']").click();
        });


</script>


