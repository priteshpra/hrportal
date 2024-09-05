<script type="text/javascript">
   $('.datepickerval').pickadate({
        format: 'dd-mm-yyyy',
        min: new Date(),
    })
    $('.timep').clockpicker({
        placement: 'bottom',
        align: 'left',
        darktheme: false,
        autoclose: true,
        twelvehour: false
    });
    $('.timep').on('change', function() {
        $('.timeplabel').addClass('active');
    });
    window.current_page_size = 10;
    window.total_page = 1;
    window.Skills = '';
    window.JobStatus = 'All';
    window.JobPostID = $('#JobPostID').val();
    window.DesignationID = '';
    window.Salary = "-1~-1";
    window.SortBy = '';
    window.SortByOrder = '';
    window.mydiv = '';
    window.submitflag = 1;
    window.actionsubmitflag = 1;
    window.AID = "";
    window.AState = "";
    window.AAction = "";
    function common_ajax (current_page_size, total_page,JobStatus) {
        $.ajax({
            type: "post",
            url: base_url + "company/jobpost/ajax_jobtabs/" + current_page_size + "/" + total_page,
            data: {
                    Type : JobStatus,
                    Salary:Salary,
                    JobPostID:JobPostID,
                    DesignationID:DesignationID,
                    Skills:Skills,
                    JobStatus:JobStatus
            },success: function (data){   
                if(JobStatus == "View"){
                    mydiv="view_job";
                }else if(JobStatus == "Applied"){
                    mydiv="all_applied";
                }else if(JobStatus == "Shortlisted"){
                    mydiv="all_shortlisted";
                }else if(JobStatus == "Invited"){
                    mydiv="all_invited";
                }else if(JobStatus == "Accept"){
                    mydiv="all_accepted";
                }else if(JobStatus == "Decline"){
                    mydiv="all_declined";
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
       common_ajax(current_page_size,total_page,'View');
       common_ajax(current_page_size,total_page,"Applied");
       common_ajax(current_page_size,total_page,"Shortlisted");
       common_ajax(current_page_size,total_page,"Invited");
       common_ajax(current_page_size,total_page,"Accept");
       common_ajax(current_page_size,total_page,"Decline");
    })
    $('.all_active_inactive').on('click', function () {
        Salary = $('#'+mydiv+' .search_action #Salary').val();
        Skills = $('#'+mydiv+' .search_action #Skills').val();
        DesignationID = $('#'+mydiv+' .search_action #DesignationID').val();
        JobStatus = $(this).attr('data-type');
        current_page_size = $('#' + mydiv + ' #select-dropdown').val();
        common_ajax(current_page_size,total_page,JobStatus);
 
    })
     $('.tabclick').on('click', function () {
        mydiv = $(this).attr('data-div');
        JobStatus = $(this).attr('data-type');
        current_page_size = $('#'+mydiv+' #select-dropdown').val();
        common_ajax(current_page_size,total_page,JobStatus);
    
    })
    $('.select-dropdown').on('change', function () {
        current_page_size = $('#'+mydiv+' #select-dropdown').val();
        common_ajax(current_page_size,total_page,JobStatus);
    })
    $('.table_paging_div').on('click', '.pagination_buttons', function(){
        var page = $(this).attr('data-page-number');
        common_ajax(current_page_size,page,JobStatus);
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
    $('.filter').on('click', function () {
        SortBy = $(this).attr('data-filter');
        $('#' + mydiv +' .filter').removeClass('active');
        if($(this).find('.up').hasClass('hide')){
            $(this).find('.up').removeClass('hide');
            $(this).find('.down').addClass('hide');
            SortByOrder = "ASC";
        }else{
            $(this).find('.down').removeClass('hide');
            $(this).find('.up').addClass('hide');
            SortByOrder = "DESC";
        }
        $(this).addClass('active');
        common_ajax(current_page_size,total_page,JobStatus);

    });
    $(document).on('click',".interview_action",function(){
        var id = $(this).attr('data-id');
        $("#CandidateID").val(id);

        $('#interview_model').openModal();
    })
    $(document).on("click","#inte_button_submit",function(){
        var error = checkValidations('#interview_model');
        var field_ids = ['JobPostID'];
        var jobpostid = $("#JobPostID").val();
        var time = $("#InterviewTime").val() + ":00";
        var userDate = $("#InterviewDate").val();
        var from = userDate.split("-");
        var usertime = time.split(":");
        var DD = new Date();
        if (error === 'yes'){
            alertify.error("<?php echo label('required_field'); ?>");
            return false;
        }else{
            if(submitflag == 0){
                return false;
            }
            submitflag = 0;
            var convdate = from[2]+'-'+from[1]+'-'+from[0];
            var selecdate = new Date(from[2],(from[1]-1),from[0],usertime[0],usertime[1]);
            if(selecdate < DD){
                alertify.error('Please select future datetime');
                return false;
            }
            var jsonData = '{"method":"addCandidateInvitedByCompnay","body":{"CandidateUserID":"' + $("#CandidateID").val() +'","UserID":"'+ $("#CompanyUserID").val() +'","JobPostID":"'+ jobpostid +'","InterviewScheduledTime":"'+time+'","InterviewScheduledDate":"'+convdate+'"}}';
            $.ajax({
                type:"post",
                url: base_url + "api/service",
                data:jsonData,
                dataType: "json",
                success:function(data){
                  if(data.addCandidateInvitedByCompnay.Error == 200){
                      alertify.success(data.addCandidateInvitedByCompnay.Message);
                      $("#interview_model .modal-close").click();
                      $("#InterviewTime").val('');
                      $("#InterviewDate").val('');
                      $("#Inte_Direct").click();
                  }else{
                      alertify.error(data.addCandidateInvitedByCompnay.Message);
                  }
                },
            });
        }
        return false;
    });
    $(document).on("click",".action_model",function(){
        var id = $(this).attr('data-id');
        var action = $(this).attr('data-action');

        var state = $(this).attr('data-state');
        if(state == 6){
            $('#decline_model').openModal();
            AID=id;
            AState=state;
            AAction=action;
            return false;
        }
        ajax_action(id,state,action);
    });

    
    $(document).on("click","#Reason_button_submit",function(){
        var error = checkValidations("#decline_model");
        var error_combo = checkComboBox(['Reason']);
        if (error === 'yes' || error_combo === 'yes'){
            alertify.error("<?php echo label('required_field');?>");
            return false;
        }else{
            ajax_action(AID,AState,AAction);
        }
        return false;
    });

    function ajax_action(id,state,action){
        var reason = $("#Reason").val();
        if(reason == 0){
            reason = $("#OtherReason").val();
        }
        var jsonData = '{"method":"companyJobAction","body":{"CompanyJobActionID":"'+id+'","UserID":"'+ $("#CompanyUserID").val() +'","Action":"'+action+'","CurrentState":"'+state+'","Reason":"' + reason + '"}}';
        if(actionsubmitflag == 0){
            return false;
        }
        actionsubmitflag = 0;
        $.ajax({
                type:"post",
                url: base_url + "api/service",
                data:jsonData,
                dataType: "json",
                success:function(data){
                    actionsubmitflag = 1;
                    if(data.companyJobAction.Error == 200){
                        alertify.success(data.companyJobAction.Message);
                        $("#decline_model .modal-close").click();
                        $("#Reason").val('');
                    }else{
                        alertify.error(data.companyJobAction.Message);
                    }
                },
            });
    }
    $(document).on('change',"#Reason",function(){
        var val = $(this).val();
        if(val == 0){
            $("#OtherReasonDiv").removeClass("hide");
            $("#OtherReason").addClass("empty_validation_class");
        }else{
            $("#OtherReasonDiv").addClass("hide");
            $("#OtherReason").removeClass("empty_validation_class");
        }
    })
    $(document).on("click",".already_decline",function(){
        alertify.error('<?php echo label('already_declined');?>');
        return false;
    })
</script>